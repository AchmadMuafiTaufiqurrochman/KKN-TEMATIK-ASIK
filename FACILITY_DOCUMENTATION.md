# Dokumentasi Perubahan Sistem Lokasi ke Fasilitas Desa

## Perubahan Yang Dilakukan

### 1. Database Changes
- **Migration**: `2025_08_13_000001_add_facility_fields_to_map_locations_table.php`
  - Mengubah enum `type` dari 4 kategori lama ke 5 kategori fasilitas desa baru
  - Menambah kolom: `opening_hours`, `pic_name`, `contact`

### 2. Model Updates
- **MapLocation.php**:
  - Update `$fillable` untuk menambahkan field baru
  - Update `getTypeTextAttribute()` untuk kategori fasilitas desa
  - Update `getTypeColorAttribute()` dengan warna yang sesuai
  - Tambah method `isOpenToday()` untuk mengecek jam operasional
  - Tambah method `getTypesWithCounts()` untuk statistik

### 3. Controller Updates
- **AdminLocationController.php**:
  - Update validasi untuk menerima kategori dan field baru
  - Update statistik dengan menambah "open_today"
  - Tambah method `edit()` untuk AJAX edit
  - Update pesan success menjadi "fasilitas" 

- **MapController.php**:
  - Update statistik kategori menggunakan groupBy

### 4. View Updates
- **admin/locations.blade.php**:
  - Update title dan header menjadi "Fasilitas Desa"
  - Update statistik cards (5 cards dengan "Buka Hari Ini")
  - Update tabel dengan kolom baru: Jam Operasional, Penanggung Jawab, Kontak
  - Update modal form dengan field baru
  - Update icons sesuai kategori fasilitas
  - Tambah JavaScript untuk auto-populate jam operasional
  - Update tooltip map dengan informasi lengkap

### 5. Routes
- Tambah route `GET /admin/locations/{mapLocation}/edit` untuk AJAX edit

### 6. Seeder
- **FacilitySeeder.php**: Data contoh 8 fasilitas desa dengan kategori lengkap

## Kategori Fasilitas Desa

1. **Pelayanan Publik & Pemerintah** (`pelayanan_publik`)
   - Warna: Biru
   - Icon: building-2
   - Contoh: Kantor Desa, Kantor Camat

2. **Pendidikan** (`pendidikan`)
   - Warna: Hijau
   - Icon: graduation-cap
   - Contoh: SD, SMP, Perpustakaan

3. **Kesehatan** (`kesehatan`)
   - Warna: Merah
   - Icon: heart-pulse
   - Contoh: Puskesmas, Posyandu, Klinik

4. **Ekonomi** (`ekonomi`)
   - Warna: Kuning
   - Icon: store
   - Contoh: Pasar, UMKM, Toko

5. **Sosial & Budaya** (`sosial_budaya`)
   - Warna: Ungu
   - Icon: users
   - Contoh: Balai Desa, Sanggar Seni, Masjid

## Field Baru

- **opening_hours**: Jam operasional fasilitas
- **pic_name**: Nama penanggung jawab fasilitas
- **contact**: Nomor telepon atau email kontak

## Fitur Baru

1. **Auto-populate jam operasional**: Saat memilih kategori, form otomatis mengisi jam operasional default
2. **Statistik "Buka Hari Ini"**: Menghitung fasilitas yang buka pada hari ini berdasarkan jam operasional
3. **Tooltip yang informatif**: Menampilkan jam operasional dan penanggung jawab pada map
4. **AJAX Edit**: Form edit yang dapat mengambil data existing via AJAX

## Cara Menjalankan

1. Jalankan migration: `php artisan migrate`
2. (Opsional) Jalankan seeder: `php artisan db:seed --class=FacilitySeeder`
3. Sistem siap digunakan dengan fitur fasilitas desa yang lengkap

## Catatan

- Data lama dengan kategori `balai`, `pertanian`, `bunga`, `posyandu` perlu dimigrasi manual ke kategori baru
- Pastikan semua validasi controller sudah menggunakan kategori baru
- Field baru bersifat nullable, sehingga tidak akan error pada data existing
