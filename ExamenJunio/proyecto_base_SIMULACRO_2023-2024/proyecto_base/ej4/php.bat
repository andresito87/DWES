@echo off
SET php_path=C:\xampp\php

if not exist "%php_path%\php.exe" (
    echo No se pudo encontrar PHP en %php_path%
    echo Por favor, asegurese de que XAMPP esta instalado en C:\xampp o actualice este script con la ruta correcta.
    pause
    exit
)

echo %PATH% | findstr /C:"%php_path%" > nul || (
    SET "PATH=%php_path%;%PATH%"
)

php.exe %*