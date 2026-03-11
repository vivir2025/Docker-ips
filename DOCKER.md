# 🐳 Sistema IPS Multi-Municipio - Dockerizado

Sistema de gestión IPS para múltiples municipios en contenedores Docker con PHP 8.0, Apache, MySQL 8.0 y phpMyAdmin.

## 🏛️ Arquitectura

Este proyecto utiliza una **arquitectura de red compartida** donde:

- **Cajibío** actúa como **hub principal** que contiene:
  - 🗄️ MySQL (base de datos compartida)
  - 🛠️ phpMyAdmin (administración de BD)
  - 🌐 Nginx (proxy reverso para todos los municipios)
  
- **Otros municipios** (Piéndamo, Morales, etc.) son aplicaciones independientes que:
  - Se conectan a la red compartida
  - Son accesibles a través del proxy Nginx
  - Cada uno tiene su propio contenedor PHP/Apache

### 📊 Diagrama de Arquitectura

```
┌─────────────────────────────────────────────┐
│           Red: ips_ips_network              │
├─────────────────────────────────────────────┤
│                                             │
│  ┌────────┐  ┌────────┐  ┌────────┐       │
│  │ MySQL  │  │  PMA   │  │ Nginx  │◄─────┼── Puerto 80
│  │  :3306 │  │  :8080 │  │  :80   │       │
│  └────────┘  └────────┘  └───┬────┘       │
│                               │            │
│       ┌───────────────────────┼────────┐   │
│       ▼                       ▼        ▼   │
│  ┌─────────┐  ┌──────────┐  ┌─────────┐  │
│  │Cajibío  │  │ Piéndamo │  │ Morales │  │
│  │   App   │  │   App    │  │   App   │  │
│  └─────────┘  └──────────┘  └─────────┘  │
│                                             │
└─────────────────────────────────────────────┘
```

### 🔗 Acceso por Subdirectorios

| Municipio | URL | Contenedor |
|-----------|-----|------------|
| **Selector** | http://localhost/ | nginx (página de inicio) |
| **Cajibío** | http://localhost/cajibio/ | cajibio_app |
| **Piéndamo** | http://localhost/piendamo/ | piendamo_app |
| **Morales** | http://localhost/morales/ | morales_app |
| **phpMyAdmin** | http://localhost:8080/ | ips_phpmyadmin |

## 📋 Requisitos Previos

- **Docker Desktop** instalado y corriendo
  - Descarga desde: https://www.docker.com/products/docker-desktop
- Windows 10/11 con WSL2 habilitado (para Docker)

## 🚀 Inicio Rápido

### 1️⃣ Exportar tu base de datos actual

Antes de la primera ejecución, necesitas exportar tu base de datos de XAMPP:

**Opción A - Usando phpMyAdmin:**
1. Abre http://localhost/phpmyadmin/ en XAMPP
2. Selecciona la base de datos `ips`
3. Ve a la pestaña "Exportar"
4. Haz clic en "Continuar"
5. Guarda como: `docker/mysql/init/01-schema.sql`

**Opción B - Usando línea de comandos:**
```powershell
C:\xampp\mysql\bin\mysqldump.exe -u root -p ips > docker\mysql\init\01-schema.sql
```

📖 Más detalles en: `docker/mysql/init/README.md`

### 2️⃣ Configurar variables de entorno (Opcional)

Si quieres cambiar las contraseñas por defecto, edita el archivo `.env`:

```env
MYSQL_ROOT_PASSWORD=tu_password_root
MYSQL_USER=ips_user
MYSQL_PASSWORD=tu_password
```

### 3️⃣ Iniciar el Sistema

**⚠️ IMPORTANTE: Siempre iniciar en este orden:**

**Paso 1: Iniciar Cajibío (Hub Principal)**
```powershell
cd C:\docker\cajibio
.\start.ps1
```

Esto iniciará:
- ✅ MySQL (base de datos compartida)
- ✅ phpMyAdmin
- ✅ Nginx (proxy reverso)
- ✅ Aplicación Cajibío

**Paso 2: Iniciar otros municipios**

Una vez que Cajibío esté corriendo, inicia los demás:

```powershell
# Piéndamo
cd C:\docker\piendamo
.\start.ps1

# Morales
cd C:\docker\morales
.\start.ps1
```

## 🌐 Acceso a las Aplicaciones

Una vez todo iniciado:

| Servicio | URL | Puerto |
|----------|-----|--------|
| **Selector de Municipios** | http://localhost/ | 80 |
| **Cajibío** | http://localhost/cajibio/ | 80 |
| **Piéndamo** | http://localhost/piendamo/ | 80 |
| **Morales** | http://localhost/morales/ | 80 |
| **phpMyAdmin** | http://localhost:8080/ | 8080 |

## 🛠️ Comandos Útiles

### ▶️ Iniciar el sistema completo

```powershell
# 1. Iniciar Cajibío (hub principal)
cd C:\docker\cajibio
.\start.ps1

# 2. Iniciar otros municipios
cd ..\piendamo; .\start.ps1
cd ..\morales; .\start.ps1
```

### ⏹️ Detener el sistema completo

**⚠️ IMPORTANTE: Detener en orden inverso**

```powershell
# 1. Detener municipios primero
cd C:\docker\morales
.\stop.ps1

cd C:\docker\piendamo
.\stop.ps1

# 2. Detener Cajibío al final (cierra MySQL y Nginx)
cd C:\docker\cajibio
.\stop.ps1
```

### Ver estado de contenedores
```powershell
docker-compose ps
```

### Ver logs en tiempo real
```powershell
# Todos los servicios
docker-compose logs -f

# Solo la aplicación
docker-compose logs -f app

# Solo MySQL
docker-compose logs -f db
```

### Reiniciar un servicio específico
```powershell
docker-compose restart app
```

### Acceder a la terminal de un contenedor
```powershell
# Contenedor de la aplicación
docker-compose exec app bash

# Contenedor de MySQL
docker-compose exec db bash
```

### Ejecutar comandos SQL directamente
```powershell
docker-compose exec db mysql -u ips_user -p ips
```

### Ver tablas de la base de datos
```powershell
docker-compose exec db mysql -u ips_user -p ips -e "SHOW TABLES;"
```

## 🔧 Solución de Problemas

### El puerto 80 ya está en uso
Asegúrate de que XAMPP esté detenido:
```powershell
# Detener servicios de XAMPP
net stop Apache2.4
net stop MySQL
```

### Los contenedores no inician
```powershell
# Ver logs detallados
docker-compose logs

# Reconstruir desde cero
docker-compose down -v
.\start.ps1
```

### Cambios en el código no se reflejan
El código está montado como volumen, los cambios deberían verse inmediatamente. Si no:
```powershell
docker-compose restart app
```

### Problemas de permisos en uploads/logs
```powershell
docker-compose exec app chown -R www-data:www-data /var/www/html/uploads
docker-compose exec app chown -R www-data:www-data /var/www/html/application/logs
```

### Resetear completamente (eliminar datos)
```powershell
# ⚠️ CUIDADO: Esto eliminará la base de datos
docker-compose down -v
.\start.ps1
```

## 📁 Estructura de Archivos Docker

```
ips/
├── docker/
│   ├── mysql/
│   │   └── init/              # Scripts SQL de inicialización
│   │       ├── 00-init.sql    # Crea la BD
│   │       ├── 01-schema.sql  # Tu dump (debes crearlo)
│   │       ├── 02-*.sql       # Tablas adicionales (auto)
│   │       └── 03-*.sql       # Triggers (auto)
│   ├── nginx/
│   │   ├── nginx.conf         # Config principal Nginx
│   │   └── default.conf       # Reverse proxy config
│   └── scripts/
│       └── point.sh      # Script de inicio del contenedor
├── Dockerfile                 # Imagen PHP/Apache
├── docker-compose.yml         # Orquestación de servicios
├── .env                       # Variables de entorno
├── start.ps1                  # Script de inicio
└── stop.ps1                   # Script de detención
```

## 🐳 Servicios Docker

| Servicio | Contenedor | Función |
|----------|-----------|---------|
| **nginx** | ips_nginx | Reverse proxy (puerto 80) |
| **app** | ips_app | PHP 8.0 + Apache |
| **db** | ips_mysql | MySQL 8.0 |
| **phpmyadmin** | ips_phpmyadmin | Interfaz web para MySQL |

## 💾 Persistencia de Datos

Los siguientes datos persisten entre reinicios:

- ✅ Base de datos MySQL (volumen Docker: `mysql_data`)
- ✅ Archivos subidos en `/uploads`
- ✅ Logs de aplicación en `/application/logs`

## 🔄 Actualizar la Aplicación

Los cambios en el código son inmediatos (hot reload). Para cambios en configuración:

```powershell
docker-compose restart app
```

Para cambios en Dockerfile o docker-compose.yml:

```powershell
docker-compose down
docker-compose up -d --build
```

## 📝 Notas Importantes

- ⚠️ La configuración de base de datos se cambia automáticamente a Docker al iniciar
- 💾 Los datos de MySQL persisten en volúmenes Docker (no se pierden al reiniciar)
- 🔒 Cambia las contraseñas en `.env` para producción
- 🚫 El archivo `.env` está en `.gitignore` (no se sube a Git)

## 🆘 Soporte

Si encuentras problemas:

1. Revisa los logs: `docker-compose logs`
2. Verifica que Docker esté corriendo
3. Asegúrate de que el puerto 80 esté libre
4. Revisa la documentación en `docker/mysql/init/README.md`

---

**¡Listo para desarrollar! 🚀**
