# Iniciar Cajibio (Hub principal)
docker-compose up -d --build
Write-Host ""
Write-Host "✅ Cajibío iniciado" -ForegroundColor Green
Write-Host "   http://localhost/" -ForegroundColor Cyan
Write-Host "   http://localhost/cajibio/" -ForegroundColor Cyan
Write-Host "   phpMyAdmin: http://localhost:8080/" -ForegroundColor Yellow
