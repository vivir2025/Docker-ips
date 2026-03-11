# ==================================================
# Script de inicio para Docker - Sistema IPS
# ==================================================
# Este script prepara y levanta todos los contenedores

Write-Host "====================================" -ForegroundColor Cyan
Write-Host "  Sistema Cajibío - Inicio Docker  " -ForegroundColor Cyan
Write-Host "====================================" -ForegroundColor Cyan
Write-Host ""

# Verificar si Docker está instalado
try {
    $dockerVersion = docker --version
    Write-Host "✅ Docker detectado: $dockerVersion" -ForegroundColor Green
} catch {
    Write-Host "❌ ERROR: Docker no está instalado o no está en el PATH" -ForegroundColor Red
    Write-Host "   Instala Docker Desktop desde: https://www.docker.com/products/docker-desktop" -ForegroundColor Yellow
    exit 1
}

# Verificar si Docker está corriendo
$dockerInfo = docker info 2>&1
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ ERROR: Docker no está corriendo" -ForegroundColor Red
    Write-Host "   Inicia Docker Desktop e intenta nuevamente" -ForegroundColor Yellow
    exit 1
}

Write-Host ""
Write-Host "📋 Preparando archivos SQL de inicialización..." -ForegroundColor Yellow

# Copiar archivos SQL del proyecto al directorio de inicialización
if (Test-Path "TABLAS_SINCRONIZACION.sql") {
    Copy-Item "TABLAS_SINCRONIZACION.sql" "docker\mysql\init\02-tablas-sincronizacion.sql" -Force
    Write-Host "✅ Copiado: TABLAS_SINCRONIZACION.sql" -ForegroundColor Green
}

if (Test-Path "TRIGGERS_SINCRONIZACION_CORREGIDO.sql") {
    Copy-Item "TRIGGERS_SINCRONIZACION_CORREGIDO.sql" "docker\mysql\init\03-triggers.sql" -Force
    Write-Host "✅ Copiado: TRIGGERS_SINCRONIZACION_CORREGIDO.sql" -ForegroundColor Green
}

# Verificar si existe el dump de la base de datos
if (-not (Test-Path "docker\mysql\init\01-schema.sql")) {
    Write-Host ""
    Write-Host "⚠️  ADVERTENCIA: No se encontró el dump de la base de datos" -ForegroundColor Yellow
    Write-Host "   Archivo: docker\mysql\init\01-schema.sql" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "   Por favor, exporta tu base de datos actual siguiendo las instrucciones en:" -ForegroundColor Yellow
    Write-Host "   docker\mysql\init\README.md" -ForegroundColor Cyan
    Write-Host ""
    $continue = Read-Host "¿Deseas continuar de todos modos? (s/n)"
    if ($continue -ne "s" -and $continue -ne "S") {
        Write-Host "❌ Operación cancelada" -ForegroundColor Red
        exit 1
    }
}

Write-Host ""
Write-Host "🚀 Iniciando contenedores Docker..." -ForegroundColor Yellow
Write-Host ""

# Construir e iniciar contenedores
docker-compose up -d --build

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "====================================" -ForegroundColor Green
    Write-Host "  ✅ DOCKER INICIADO EXITOSAMENTE  " -ForegroundColor Green
    Write-Host "====================================" -ForegroundColor Green
    Write-Host ""
    Write-Host "🌐 Accede a las aplicaciones en:" -ForegroundColor Cyan
    Write-Host "   Selector de Municipios: http://localhost/" -ForegroundColor White
    Write-Host "   Cajibío: http://localhost/cajibio/" -ForegroundColor White
    Write-Host "   phpMyAdmin: http://localhost:8080/" -ForegroundColor White
    Write-Host ""
    Write-Host "📋 Para iniciar otros municipios:" -ForegroundColor Yellow
    Write-Host "   cd ..\piendamo ; .\start.ps1" -ForegroundColor White
    Write-Host "   cd ..\morales ; .\start.ps1" -ForegroundColor White
    Write-Host ""
    Write-Host "📊 Ver estado de contenedores:" -ForegroundColor Yellow
    Write-Host "   docker-compose ps" -ForegroundColor White
    Write-Host ""
    Write-Host "📋 Ver logs:" -ForegroundColor Yellow
    Write-Host "   docker-compose logs -f" -ForegroundColor White
    Write-Host ""
    Write-Host "🛑 Detener contenedores:" -ForegroundColor Yellow
    Write-Host "   .\stop.ps1" -ForegroundColor White
    Write-Host ""
} else {
    Write-Host ""
    Write-Host "❌ ERROR: Hubo un problema al iniciar Docker" -ForegroundColor Red
    Write-Host "   Revisa los mensajes de error anteriores" -ForegroundColor Yellow
    Write-Host ""
    exit 1
}
