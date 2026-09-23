$exclude = @('.git', 'node_modules', 'anmat_production.zip')
$items = Get-ChildItem -Path "d:\websites\anmat.ly" -Force | Where-Object { $exclude -notcontains $_.Name } | Select-Object -ExpandProperty FullName
Write-Host "Zipping $( $items.Count ) items..."
Compress-Archive -Path $items -DestinationPath "d:\websites\anmat_production.zip" -Force
$size = (Get-Item "d:\websites\anmat_production.zip").Length / 1MB
Write-Host "Created d:\websites\anmat_production.zip successfully! Size: $([math]::Round($size, 2)) MB"
