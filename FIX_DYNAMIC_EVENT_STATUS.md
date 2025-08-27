# Fix: Dynamic Event Status Calculation

## Masalah
Status "Akan Dimulai" dan "Selesai" pada berita/video tidak berubah secara otomatis berdasarkan tanggal. Jika suatu acara dijadwalkan untuk tanggal 17 Agustus dan dibuat pada tanggal 16 Agustus, maka tag akan tetap menampilkan "Akan Dimulai" meskipun tanggal sudah lewat.

## Solusi
1. **Mengubah `is_finished` menjadi accessor dinamis** di Model Video yang menghitung status berdasarkan perbandingan tanggal saat ini dengan `started_at`
2. **Menghapus kolom `is_finished` dari database** karena sekarang dihitung secara real-time
3. **Memperbarui controller** agar tidak lagi menyimpan nilai statis `is_finished`

## Perubahan File

### 1. `app/Models/Video.php`
- Menambahkan accessor `getIsFinishedAttribute()` yang menghitung status secara dinamis
- Menghapus `is_finished` dari `$fillable` dan `$casts`

### 2. `app/Http/Controllers/Admin/AdminVideoController.php`
- Menghapus baris yang menetapkan `is_finished` saat store dan update

### 3. `resources/views/admin/videos.blade.php`
- Menghapus pengecekan `isset($video->is_finished)` karena accessor selalu mengembalikan nilai

### 4. `database/migrations/2025_08_16_000000_remove_is_finished_from_videos_table.php`
- Migration untuk menghapus kolom `is_finished` dari tabel videos

## Logika Baru
```php
public function getIsFinishedAttribute()
{
    // Jika tidak ada tanggal mulai, dianggap belum selesai
    if (!$this->started_at) {
        return false;
    }
    
    // Bandingkan tanggal sekarang dengan tanggal mulai acara
    return now()->greaterThan($this->started_at);
}
```

## Testing
Status "Akan Dimulai" / "Selesai" sekarang akan berubah secara otomatis berdasarkan tanggal sistem:
- Jika `started_at` > tanggal sekarang → "Akan Dimulai"
- Jika `started_at` ≤ tanggal sekarang → "Selesai"
- Jika `started_at` null → "Akan Dimulai"
