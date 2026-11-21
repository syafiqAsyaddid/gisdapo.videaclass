@echo off
title Menjalankan Aplikasi Sebaran Sekolah
echo ========================================================
echo   Menjalankan Aplikasi Satuan Data Sebaran Sekolah
echo ========================================================
echo.

:: 1. Cek apakah MySQL sudah berjalan di port 3306
netstat -ano | findstr 3306 >nul
if %errorlevel% neq 0 (
    echo [1/3] Menjalankan MySQL XAMPP...
    if exist "D:\xampp\mysql_start.bat" (
        start "" /min "D:\xampp\mysql_start.bat"
        timeout /t 3 /nobreak >nul
    ) else (
        echo PERINGATAN: Pastikan MySQL sudah dijalankan lewat XAMPP Control Panel.
    )
) else (
    echo [1/3] MySQL sudah aktif di port 3306.
)

:: 2. Buka browser otomatis
echo [2/3] Membuka browser ke http://127.0.0.1:8000...
start "" "http://127.0.0.1:8000"

:: 3. Jalankan server Laravel
echo [3/3] Menjalankan Laravel Development Server...
echo.
echo Server aktif! Jangan tutup jendela ini selama menggunakan web.
echo Tekan Ctrl + C untuk mematikan server.
echo.

if exist "D:\xampp\php\php.exe" (
    "D:\xampp\php\php.exe" artisan serve --host=127.0.0.1 --port=8000
) else (
    php artisan serve --host=127.0.0.1 --port=8000
)

pause
