param(
    [int]$Users = 6,
    [int]$RequestsPerUser = 10,
    [string]$BaseUrl = "http://localhost"
)

Write-Host "====== STRESS TEST INICIO ======" -ForegroundColor Cyan
Write-Host "Usuarios: $Users | Requests por usuario: $RequestsPerUser" -ForegroundColor Yellow
Write-Host "URL: $BaseUrl" -ForegroundColor Yellow
Write-Host ""

$Endpoints = @(
    "/cajibio/",
    "/cajibio/index.php",
    "/cajibio/index.php/CHome",
    "/cajibio/index.php/CPaciente",
    "/cajibio/index.php/CCita",
    "/cajibio/index.php/CFactura"
)

$Jobs = @()
$StartTime = Get-Date

# Crear jobs en paralelo
for ($user = 1; $user -le $Users; $user++) {
    $Job = Start-Job -ScriptBlock {
        param($UserId, $Endpoints, $BaseUrl, $Requests)
        
        $Success = 0
        $Errors = 0
        
        for ($i = 1; $i -le $Requests; $i++) {
            $Endpoint = $Endpoints | Get-Random
            $Url = "$BaseUrl$Endpoint"
            
            try {
                $Response = Invoke-WebRequest -Uri $Url -TimeoutSec 10 -UseBasicParsing -ErrorAction Stop
                $Success++
                Write-Output "USER$UserId OK: $($Response.StatusCode)"
            } catch {
                $Errors++
                Write-Output "USER$UserId ERROR: $($_.Exception.Message)"
            }
            
            Start-Sleep -Milliseconds 50
        }
        
        Write-Output "USER$UserId DONE: $Success OK, $Errors FAIL"
    } -ArgumentList $user, $Endpoints, $BaseUrl, $RequestsPerUser
    
    $Jobs += $Job
}

Write-Host "Esperando a que terminen todos los usuarios..." -ForegroundColor Cyan

# Esperar todos los jobs correctamente
Get-Job | Wait-Job
$AllOutput = Get-Job | Receive-Job

Write-Host ""
Write-Host "====== RESULTADOS ======" -ForegroundColor Green

$SuccessCount = 0
$ErrorCount = 0

foreach ($Line in $AllOutput) {
    if ($Line -match "OK") {
        Write-Host $Line -ForegroundColor Green
        $SuccessCount++
    } elseif ($Line -match "ERROR") {
        Write-Host $Line -ForegroundColor Red
        $ErrorCount++
    } elseif ($Line -match "DONE") {
        Write-Host $Line -ForegroundColor Yellow
    }
}

$EndTime = Get-Date
$Duration = ($EndTime - $StartTime).TotalSeconds
$TotalRequests = $Users * $RequestsPerUser

Write-Host ""
Write-Host "====== ESTADISTICAS ======" -ForegroundColor Cyan
Write-Host "Total Requests: $TotalRequests"
Write-Host "Exitosos: $SuccessCount"
Write-Host "Errores: $ErrorCount"
Write-Host "Tiempo Total: $([Math]::Round($Duration, 2)) seg"
if ($Duration -gt 0) {
    $RPS = [Math]::Round($TotalRequests / $Duration, 2)
    Write-Host "Requests/seg: $RPS"
}
Write-Host "========================" -ForegroundColor Cyan

# Limpiar jobs
Get-Job | Remove-Job -Force
