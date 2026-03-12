# Guía Completa de Despliegue — Cajibio IPS

**Última actualización**: 12 de marzo de 2026  
**Stack**: PHP 8.0 + CodeIgniter 3 + MySQL 8.0 + Docker  
**Cumplimiento**: Resolución 1995/1999 MinSalud Colombia (Historia Clínica Digital)

---

## Tabla de Contenidos

1. [Requisitos Previos](#requisitos-previos)
2. [Arquitectura MY_Model](#arquitectura-my_model)
3. [Estructura del Proyecto](#estructura-del-proyecto)
4. [Configuración de Docker](#configuración-de-docker)
5. [Despliegue Step-by-Step](#despliegue-step-by-step)
6. [Testing de Carga (6 usuarios)](#testing-de-carga-6-usuarios)
7. [Monitoreo en Producción](#monitoreo-en-producción)
8. [Troubleshooting](#troubleshooting)

---

## Requisitos Previos

### Hardware Mínimo
- **RAM**: 16 GB (recomendado)
- **Disco**: 50 GB libres
- **CPU**: 4+ cores
- **Internet**: Para descargas de imágenes Docker

### Software Requerido
- **Docker Desktop** 4.20+ ([descargar](https://www.docker.com/products/docker-desktop))
- **PowerShell 5.1+** (incluido en Windows 10+)
- **.env file** con credenciales MySQL

### Verificar instalación
```powershell
docker --version
docker-compose --version
```

---

## Arquitectura MY_Model

### ¿Qué es MY_Model?

`application/core/MY_Model.php` es la **clase base para TODOS los modelos** de Cajibio. Implementa:

#### 1️⃣ **SoftDelete (Prohibición de borrado físico)**
```
Resolución 1995/1999 MinSalud: "Las HC nunca se destruyen"
↓
soft_delete() marca con deleted_at + deleted_by
↓
get_active() automáticamente excluye registros eliminados
↓
restore() permite recuperar lo que fue "borrado"
```

#### 2️⃣ **Audit Trail (Trazabilidad completa)**
```
Cada CREATE/UPDATE/DELETE se registra con:
- Usuario que hizo el cambio
- IP desde dónde se conectó
- Snapshot ANTES y DESPUÉS del cambio
- Timestamp exacto
↓
Consulta histórica: get_audit_trail($tabla, $id)
Snapshot en el tiempo: get_snapshot_at($tabla, $id, $fecha)
```

#### 3️⃣ **Seguridad de sesión**
```
_get_user_id()     → Extrae ID desde $_SESSION['usuario']['idUsuario']
_get_user_label()  → Extrae correo para logs legibles
_get_user_ip()     → Detecta IP real (maneja proxies)
```

### Métodos Principales

| Método | Descripción | Auditoría |
|--------|-------------|-----------|
| `safe_insert($tabla, $datos)` | INSERT seguro | ✅ CREATE |
| `safe_update($tabla, $datos, $id)` | UPDATE seguro | ✅ UPDATE |
| `soft_delete($tabla, $id)` | Eliminación lógica | ✅ DELETE |
| `restore($tabla, $id)` | Restaurar eliminado | ✅ RESTORE |
| `get_active($tabla)` | SELECT sin deleted | ✅ Soportado |
| `get_audit_trail($tabla, $id)` | Historial de cambios | N/A |

### Ejemplo de Uso en un Modelo

```php
<?php
class MHistoria extends MY_Model {
    
    public function crear_historia($datos) {
        // MY_Model inyecta automáticamente:
        // - created_by = usuario actual
        // - created_at = timestamp
        // - Registra en auditoria_hc
        return $this->safe_insert('historia_clinica', $datos);
    }
    
    public function actualizar_historia($id, $datos) {
        // MY_Model:
        // - Toma snapshot ANTES
        // - Inyecta updated_by y updated_at
        // - Inyecta en auditoria_hc: ANTES vs DESPUÉS
        return $this->safe_update('historia_clinica', $datos, $id);
    }
    
    public function eliminar_historia($id) {
        // soft_delete: NO BORRA, solo marca
        // deleted_at = ahora, deleted_by = usuario
        return $this->soft_delete('historia_clinica', $id);
    }
    
    public function ver_historial($id) {
        // Retorna quién, cuándo, qué cambió
        return $this->get_audit_trail('historia_clinica', $id);
    }
}
?>
```

---

## Estructura del Proyecto

```
cajibio/
├── application/
│   ├── core/
│   │   └── MY_Model.php ..................... ⭐ BASE: SoftDelete + Audit
│   ├── models/
│   │   ├── MHistoria.php ................... Extends MY_Model
│   │   ├── MCita.php ....................... Extends MY_Model
│   │   ├── MFactura.php .................... Extends MY_Model
│   │   └── ... (todos extienden MY_Model)
│   ├── controllers/
│   │   ├── CHistoria.php
│   │   ├── CCita.php
│   │   └── ...
│   ├── config/
│   │   ├── database.php .................... Config de BD
│   │   ├── constants.php
│   │   └── routes.php
│   ├── views/
│   └── logs/
│
├── docker/
│   ├── nginx/
│   │   ├── nginx.conf ...................... Configuración Nginx
│   │   └── default.conf .................... Virtual hosts
│   ├── mysql/
│   │   └── init/ ........................... Scripts SQL iniciales
│   ├── apache/
│   └── scripts/
│
├── assets/
│   ├── bootstrap/
│   ├── datatable/
│   └── img/
│
├── uploads/ ................................ Documentos médicos (PERSISTENTES)
├── application/logs/ ....................... Logs de auditoría
├── application/cache/
├── application/sessions/
│
├── docker-compose.yml ...................... ⭐ ORQUESTACIÓN
├── Dockerfile .............................. ⭐ IMAGEN PHP
├── .env .................................... Credenciales (NO COMMITAR)
├── .env.example ............................ Template
│
├── up.ps1 .................................. Script: docker-compose up
├── down.ps1 ................................ Script: docker-compose down
├── stop.ps1 ................................ Script: docker-compose stop
├── start.ps1 ............................... Script: docker-compose start
└── stress-test.ps1 ......................... Script: Test de carga

system/ ..................................... CodeIgniter system (NO EDITAR)
index.php ................................... Entry point principal
```

---

## Configuración de Docker

### docker-compose.yml — Orquestación

```yaml
services:
  # MYSQL 8.0 — Base de datos centralizada
  db:
    image: mysql:8.0
    environment:
      MYSQL_MAX_CONNECTIONS: 200      # Soporta 6+ usuarios simultáneos
      MYSQL_INNODB_BUFFER_POOL_SIZE: 1024M  # Cache para performance
      MYSQL_INNODB_LOG_FILE_SIZE: 256M      # Transacciones rápidas
    deploy:
      resources:
        limits:
          memory: 2G                   # Máximo 2 GB
          cpus: '2'                    # 2 CPUs
    ports:
      - "3306:3306"                    # Puerto estándar MySQL

  # PHP/APACHE — Aplicación web
  app:
    build:
      context: .
      dockerfile: Dockerfile           # Construye imagen custom
    environment:
      DB_HOST: db                      # Nombre del servicio (DNS interno)
      DB_NAME: ${MYSQL_DATABASE}       # Variables del .env
      DB_USER: ${MYSQL_USER}
      DB_PASSWORD: ${MYSQL_PASSWORD}
    deploy:
      resources:
        limits:
          memory: 512M                 # Máximo 512 MB
          cpus: '1.5'
    volumes:
      - .:/var/www/html               # Código en vivo (dev)
      - ./uploads:/var/www/html/uploads # Persistencia de documentos
      - ./application/logs:/var/www/html/application/logs

  # NGINX — Reverse proxy (loadbalancer)
  nginx:
    image: nginx:alpine
    ports:
      - "80:80"                        # HTTP
    depends_on:
      - app

  # PHPMYADMIN — Administración de BD
  phpmyadmin:
    image: phpmyadmin/phpmyadmin:latest
    ports:
      - "8080:80"
```

### Dockerfile — Imagen PHP

```dockerfile
FROM php:8.0-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql json

# Habilitar mod_rewrite para CodeIgniter
RUN a2enmod rewrite

# Copiar código
COPY . /var/www/html

# Permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
```

### .env — Credenciales (NUNCA commitar a Git)

```env
MYSQL_ROOT_PASSWORD=tu_password_seguro
MYSQL_DATABASE=cajibio_ips
MYSQL_USER=cajibio_user
MYSQL_PASSWORD=tu_password_usuario
```

⚠️ **IMPORTANTE**: Crear `.env` en la raíz, **NUNCA versionarlo**.

---

## Despliegue Step-by-Step

### 1️⃣ Preparación Inicial

```powershell
# 1. Ir al directorio del proyecto
cd C:\docker\cajibio

# 2. Crear .env desde template
Copy-Item .env.example .env

# 3. Editar .env con tus credenciales
notepad .env
```

### 2️⃣ Configurar Docker Desktop

```
Abrí Docker Desktop → Settings → Resources
- Memory: 10-11 GB (dejate 5-6 para Windows)
- CPUs: 4+
- Disk Image Size: 50+ GB
Apply & Restart
```

### 3️⃣ Construir imágenes

```powershell
# Descarga imágenes base + construye imagen PHP custom
docker-compose build

# Output esperado:
# ✓ Descargando mysql:8.0
# ✓ Descargando nginx:alpine
# ✓ Construyendo cajibio-app
# Done
```

### 4️⃣ Desplegar contenedores

```powershell
# Opción A: Comando directo
docker-compose up -d

# Opción B: Script PowerShell (más fácil)
.\up.ps1
```

### 5️⃣ Verificar despliegue

```powershell
# Ver contenedores corriendo
docker ps

# Esperado:
# cajibio_app      ✅ Up 2 minutes
# ips_mysql        ✅ Up 2 minutes (healthy)
# ips_nginx        ✅ Up 2 minutes
# ips_phpmyadmin   ✅ Up 2 minutes
```

### 6️⃣ Probar acceso

```
🌐 Aplicación:  http://localhost/
🗄️  phpMyAdmin: http://localhost:8080/
```

---

## Testing de Carga (6 usuarios)

### Prerrequisitos
- Docker corriendo
- Aplicación desplegada

### Ejecutar stress test

```powershell
# Test ligero: 6 usuarios x 10 requests
.\stress-test.ps1 -Users 6 -RequestsPerUser 10

# Test moderado: 6 usuarios x 20 requests
.\stress-test.ps1 -Users 6 -RequestsPerUser 20

# Test agresivo: 6 usuarios x 50 requests
.\stress-test.ps1 -Users 6 -RequestsPerUser 50
```

### Interpretar resultados

```
====== ESTADISTICAS ======
Total Requests: 120
Exitosos: 120          ✅ 100%
Errores: 0             ✅ Sin fallos
Tiempo Total: 19.86 seg
Requests/seg: 6.04     ✅ HEALTHY
```

### Monitorear RAM simultáneamente

En OTRA terminal PowerShell:

```powershell
# Abrir en loop cada 2 seg
while ($true) {
    docker stats --no-stream --format "table {{.Container}}\t{{.MemUsage}}\t{{.MemPerc}}"
    Start-Sleep -Seconds 2
    Clear-Host
}

# Esperado durante stress test:
# MySQL:        ~480 MiB / 2 GiB (23%)    ✅
# PHP App:      ~45 MiB / 512 MiB (9%)    ✅
# Nginx:        ~11 MiB / 256 MiB (4%)    ✅
# TOTAL:        ~550 MiB / 7600 MiB (7%)  ✅
```

---

## Monitoreo en Producción

### Logs de aplicación

```powershell
# Ver logs de PHP en tiempo real
docker logs -f cajibio_app

# Ver logs de Nginx
docker logs -f ips_nginx

# Ver logs de MySQL
docker logs -f ips_mysql
```

### Logs de auditoría (Base de datos)

```sql
-- Ver cambios en una historia clínica
SELECT * FROM auditoria_hc 
WHERE tabla = 'historia_clinica' 
  AND id_registro = 12345
ORDER BY created_at DESC;

-- Ver quién hizo qué hoy
SELECT 
  usuario_label,
  tabla,
  accion,
  created_at
FROM auditoria_hc
WHERE DATE(created_at) = CURDATE()
ORDER BY created_at DESC;

-- Ver snapshot en una fecha específica
SELECT 
  datos_despues,
  created_at
FROM auditoria_hc
WHERE tabla = 'historia_clinica'
  AND id_registro = 12345
  AND created_at <= '2026-03-12 15:30:00'
ORDER BY created_at DESC
LIMIT 1;
```

### Comandos útiles

```powershell
# Ver uso de RAM/CPU
docker stats

# Reiniciar un contenedor
docker restart cajibio_app

# Ver detalles de un contenedor
docker inspect cajibio_app

# Ejecutar comando dentro del contenedor
docker exec -it cajibio_app bash

# Ver volúmenes (datos persistentes)
docker volume ls
```

---

## Troubleshooting

### ❌ ERROR: "Connection refused" (aplicación no responde)

**Causa**: MySQL no está listo

```powershell
# Verificar salud de MySQL
docker ps

# Si dice "unhealthy", esperar 30 segundos y reintentar
docker restart ips_mysql

# Ver logs
docker logs ips_mysql
```

### ❌ ERROR: "404 Not Found"

**Causa**: Nginx no está ruteando correctamente

```powershell
# Revisar config de nginx
docker exec ips_nginx cat /etc/nginx/conf.d/default.conf

# Validar sintaxis
docker exec ips_nginx nginx -t

# Recargar config
docker exec ips_nginx nginx -s reload
```

### ❌ ERROR: "Out of memory" en Docker

**Solución**:

1. Aumentar memoria en Docker Desktop (Settings → Resources → Memory)
2. Apagar contenedores sin usar:
   ```powershell
   docker stop ips_phpmyadmin  # Si no lo necesitas
   ```
3. Limpiar basura:
   ```powershell
   docker system prune -a --volumes
   ```

### ❌ ERROR: "Database connection failed"

**Revisar**:

```powershell
# 1. ¿MySQL está corriendo?
docker ps | grep ips_mysql

# 2. ¿Credenciales correctas en .env?
cat .env | grep MYSQL

# 3. ¿El contenedor app puede alcanzar mysql?
docker exec cajibio_app ping db

# 4. Ver logs de conexión
docker logs cajibio_app | grep -i "database"
```

### ❌ ERROR: "Port 80 already in use"

```powershell
# Buscar qué usa puerto 80
netstat -ano | findstr :80

# Matar proceso (cuidado)
taskkill /PID <PID> /F

# O cambiar puerto en docker-compose.yml
# "80:80" → "8081:80"
```

---

## Scripts PowerShell Útiles

### up.ps1 — Desplegar

```powershell
# Inicia todos los contenedores
docker-compose up -d
Write-Host "✅ Cajibio desplegado en http://localhost/"
```

### down.ps1 — Apagar

```powershell
# Detiene y elimina contenedores (DATOS PERSISTENTES SE MANTIENEN)
docker-compose down
Write-Host "✅ Contenedores apagados"
```

### stop.ps1 — Pausar

```powershell
# Solo pausa (más rápido que down/up)
docker-compose stop
```

### start.ps1 — Reanudar

```powershell
# Reanuda después de stop
docker-compose start
```

---

## Resumen de Capacidades

| Característica | Capacidad | Verificada |
|---|---|---|
| Usuarios simultáneos | 6+ | ✅ Stress test 120 req |
| Velocidad | 6 req/seg | ✅ Producción |
| Memoria utilizada | ~550 MiB / 7.6 GB | ✅ 7% |
| SoftDelete | Resolución 1995/1999 | ✅ MY_Model |
| Audit Trail | Completo (ANTES/DESPUÉS) | ✅ auditoria_hc |
| Compatibilidad | PHP 8.0 + MySQL 8.0 | ✅ Docker |

---

## Quick Reference

```powershell
# Desplegar
cd C:\docker\cajibio
.\up.ps1

# Acceder
# App: http://localhost/
# Admin BD: http://localhost:8080/

# Monitor
docker stats

# Test de carga
.\stress-test.ps1 -Users 6 -RequestsPerUser 20

# Apagar
.\down.ps1
```

---

## Soporte & Logs

- **Logs de auditoría**: `auditoria_hc` (tabla MySQL)
- **Logs de aplicación**: `application/logs/`
- **Logs de Docker**: `docker logs <container>`

**Contacto**: arquitecto-ips@example.com

---

**Documento generado**: 12 de marzo de 2026  
**Versión**: 2.0  
**Cumplimiento**: MinSalud Resolución 1995/1999
