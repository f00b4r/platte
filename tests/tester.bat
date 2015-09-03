@echo off
%CD%\..\vendor\bin\tester.bat %CD%\cases -s -j 40 -log %CD%\tester.log -c %CD%\php-win.ini %*
rmdir %CD%\tmp /Q /S
