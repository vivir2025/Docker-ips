# ==================================================
# Script de detención para Docker - Sistema IPS
# ==================================================
# Este script detiene todos los contenedores de forma segura

Write-Host "======================================" -ForegroundColor Cyan
Write-Host " Sistema Cajibío - Detener Docker   " -ForegroundColor Cyan
Write-Host "======================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "🛑 Deteniendo contenedores Docker..." -ForegroundColor Yellow
Write-Host ""

# Detener contenedores
docker-compose down

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "✅ Contenedores detenidos exitosamente" -ForegroundColor Green
    Write-Host ""
    Write-Host "💡 Nota: Los datos de la base de datos se mantienen en un volumen Docker" -ForegroundColor Yellow
    Write-Host "   Para eliminar también los datos, ejecuta:" -ForegroundColor Yellow
    Write-Host "   docker-compose down -v" -ForegroundColor White
    Write-Host ""
} else {
    Write-Host ""
    Write-Host "❌ ERROR: Hubo un problema al detener Docker" -ForegroundColor Red
    Write-Host ""
    exit 1
}
