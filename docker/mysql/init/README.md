# Inicialización de Base de Datos MySQL

Este directorio contiene los scripts SQL que se ejecutarán automáticamente cuando se cree el contenedor MySQL por primera vez.

## ⚠️ IMPORTANTE: Exportar tu base de datos actual

Antes de iniciar Docker, necesitas exportar tu base de datos actual de XAMPP:

### Opción 1: Usando phpMyAdmin (Recomendado)
1. Abre phpMyAdmin en XAMPP: http://localhost/phpmyadmin/
2. Selecciona la base de datos `ips` en el panel izquierdo
3. Haz clic en la pestaña "Exportar"
4. Selecciona "Rápido" y formato "SQL"
5. Haz clic en "Continuar"
6. Guarda el archivo como `01-schema.sql` en este directorio

### Opción 2: Usando mysqldump desde línea de comandos
```bash
# Desde la carpeta raíz del proyecto
cd C:\xampp\htdocs\ips

# Exportar la base de datos
C:\xampp\mysql\bin\mysqldump.exe -u root -p ips > docker\mysql\init\01-schema.sql
```

## 📋 Orden de ejecución

Los archivos SQL se ejecutan en orden alfabético:

1. **00-init.sql** - Crea la base de datos `ips` con charset UTF-8 ✅ (Ya existe)
2. **01-schema.sql** - Tu dump completo de la base de datos ⚠️ (Debes crearlo)
3. **02-tablas-sincronizacion.sql** - Tablas de sincronización (se copia automáticamente)
4. **03-triggers.sql** - Triggers de sincronización (se copia automáticamente)

## 🚀 Los archivos SQL del proyecto ya están configurados

Los archivos `TABLAS_SINCRONIZACION.sql` y `TRIGGERS_SINCRONIZACION_CORREGIDO.sql` de la raíz del proyecto se copiarán automáticamente con los prefijos `02-` y `03-` cuando ejecutes el script de inicio.

## ✅ Verificación

Después de iniciar Docker, puedes verificar que todo se importó correctamente:

```bash
# Ver las tablas importadas
docker-compose exec db mysql -u ips_user -p ips -e "SHOW TABLES;"

# O usando phpMyAdmin
# Accede a: http://localhost/phpmyadmin/
```
