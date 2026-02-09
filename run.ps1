# Script PowerShell pour lancer le serveur PHP de développement
# Démarre le serveur depuis le dossier public

$publicPath = Join-Path $PSScriptRoot "public"
$port = 8080

Write-Host "Démarrage du serveur PHP..." -ForegroundColor Green
Write-Host "URL: http://localhost:$port" -ForegroundColor Cyan
Write-Host "Appuyez sur Ctrl+C pour arrêter le serveur" -ForegroundColor Yellow
Write-Host ""

Set-Location $publicPath
php -S localhost:$port
