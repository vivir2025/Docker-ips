#!/bin/bash
set -e

echo "🚀 Iniciando contenedor de aplicación Cajibío..."

# Esperar a que la base de datos esté lista
echo "⏳ Esperando a que MySQL esté disponible..."
while ! nc -z db 3306; do
  sleep 1
done
echo "✅ MySQL está listo!"

# La configuración de database.php ya usa variables de entorno de Docker
echo "📝 Configuración de base de datos lista (usando variables de entorno)"

# Asegurar que los directorios tengan los permisos correctos
echo "🔐 Configurando permisos..."

# Directorio de uploads
if [ -d /var/www/html/uploads ]; then
    chown -R www-data:www-data /var/www/html/uploads
    chmod -R 775 /var/www/html/uploads
    echo "✅ Permisos de uploads configurados"
fi

# Directorio de logs
if [ -d /var/www/html/application/logs ]; then
    chown -R www-data:www-data /var/www/html/application/logs
    chmod -R 775 /var/www/html/application/logs
    echo "✅ Permisos de logs configurados"
fi

# Directorio de cache
if [ -d /var/www/html/application/cache ]; then
    chown -R www-data:www-data /var/www/html/application/cache
    chmod -R 775 /var/www/html/application/cache
    echo "✅ Permisos de cache configurados"
fi

# Directorio de sesiones
if [ -d /var/www/html/application/sessions ]; then
    chown -R www-data:www-data /var/www/html/application/sessions
    chmod -R 775 /var/www/html/application/sessions
    echo "✅ Permisos de sesiones configurados"
fi

echo "🎉 Contenedor configurado exitosamente!"
echo "🌐 Aplicación Cajibío disponible en: http://localhost/"
echo "🗃️  phpMyAdmin disponible en: http://localhost:8080/"

# Ejecutar el comando proporcionado (apache2-foreground)
exec "$@"
