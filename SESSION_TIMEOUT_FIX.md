# SESSION TIMEOUT FIX - DESA DIGITAL

## Masalah yang Diselesaikan
User mengalami logout otomatis setelah 2 jam tidak aktif (idle), yang menyebabkan munculnya error 403/404 ketika membuka tab yang sudah lama tidak digunakan.

## Solusi yang Diimplementasikan

### 1. Perpanjangan Session Lifetime
- **File**: `.env`
- **Perubahan**: `SESSION_LIFETIME` dari 120 menit menjadi 480 menit (8 jam)
- **File**: `config/session.php`
- **Perubahan**: Default session lifetime menjadi 480 menit

### 2. Middleware Session Keep-Alive
- **File**: `app/Http/Middleware/SessionKeepAlive.php` (BARU)
- **Fungsi**: 
  - Auto-regenerate session setiap 30 menit untuk user yang login
  - Update timestamp aktivitas terakhir
  - Handle redirect yang lebih user-friendly untuk session expired

### 3. Route Session Keep-Alive
- **File**: `routes/web.php`
- **Penambahan**: Route POST `/session/keep-alive` untuk refresh session via AJAX

### 4. JavaScript Auto Session Refresh
- **File**: `resources/views/layouts/app.blade.php`
- **File**: `resources/views/layouts/admin.blade.php`
- **Fungsi**:
  - Auto refresh session setiap 30 menit
  - Refresh session saat user kembali aktif (window focus)
  - Refresh session saat ada aktivitas user (click, keypress, scroll, mousemove)
  - Warning dialog sebelum session expired

### 5. Improved Authentication Middleware
- **File**: `app/Http/Middleware/Authenticate.php`
- **Perubahan**: 
  - Better handling untuk AJAX requests
  - Flash message yang informatif
  - JSON response untuk AJAX requests

### 6. CSRF Token Support
- **File**: `resources/views/layouts/app.blade.php`
- **File**: `resources/views/layouts/admin.blade.php`
- **Penambahan**: Meta tag CSRF token untuk AJAX requests

## Cara Kerja

1. **Session Lifetime**: Session sekarang berlangsung 8 jam sejak login terakhir
2. **Auto Refresh**: JavaScript akan otomatis refresh session setiap 30 menit
3. **Activity Detection**: Session di-refresh saat user berinteraksi dengan halaman
4. **Warning System**: User akan mendapat peringatan sebelum session expired
5. **Graceful Handling**: Error 403/404 akan di-redirect ke halaman login dengan pesan yang jelas

## Testing

Untuk menguji fitur ini:

1. Login ke admin dashboard
2. Biarkan tab terbuka tanpa aktivitas selama 30 menit
3. Check console browser - seharusnya ada log "Session refreshed successfully"
4. Pindah ke tab lain selama 1+ jam, kemudian kembali - session seharusnya masih aktif
5. Biarkan tanpa aktivitas selama 8+ jam - user akan logout otomatis

## File yang Dimodifikasi

1. `.env` - Session lifetime
2. `config/session.php` - Default session config
3. `app/Http/Middleware/SessionKeepAlive.php` - NEW
4. `app/Http/Kernel.php` - Register middleware
5. `routes/web.php` - Keep-alive route
6. `resources/views/layouts/app.blade.php` - CSRF + JS
7. `resources/views/layouts/admin.blade.php` - CSRF + JS
8. `app/Http/Middleware/Authenticate.php` - Better error handling

## Catatan

- Pastikan PHP versi sudah sesuai requirement (>= 8.2.0)
- Jalankan `php artisan config:clear` setelah perubahan
- Session menggunakan database driver, pastikan table sessions sudah ada
