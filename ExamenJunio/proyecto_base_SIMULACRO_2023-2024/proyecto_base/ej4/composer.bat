@echo OFF
:: in case DelayedExpansion is on and a path contains ! 
set XDEBUG_MODE=off
setlocal DISABLEDELAYEDEXPANSION
php.bat "%~dp0composer.phar" %*