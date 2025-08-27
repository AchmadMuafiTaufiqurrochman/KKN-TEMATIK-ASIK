# Testing Guide - Perbaikan Peta Fasilitas

## Yang Diperbaiki:

### 1. ✅ Total Kategori (Fixed: 4 kategori)
**Sebelum**: Menampilkan 5 kategori
**Sesudah**: Menampilkan 4 kategori (Pelayanan Publik, Pendidikan, Kesehatan, Ekonomi)

**Perubahan**:
- Model `Fasilitas.php`: Method `getTypesWithCounts()` hanya menghitung 4 kategori yang valid
- View `locations.blade.php`: Hardcode angka 4 untuk total kategori

### 2. ✅ Koordinat Tersimpan Otomatis (Fixed)
**Sebelum**: Koordinat tidak tersimpan di input form
**Sesudah**: Koordinat otomatis terisi ketika klik peta

**Perubahan**:
- Tambah fungsi `openAddLocationModalWithCoordinates()` khusus untuk handle klik peta
- Perbaiki timing: Modal dibuka dulu, baru koordinat diisi dengan delay
- Tambah logging untuk debugging

## Cara Testing:

### Test 1: Total Kategori
1. Buka halaman admin fasilitas
2. Lihat card "Kategori" - harus menampilkan angka **4**

### Test 2: Koordinat dari Klik Peta
1. Buka halaman admin fasilitas  
2. Klik pada area kosong di peta preview
3. Modal "Tambah Fasilitas" harus terbuka
4. Input Latitude dan Longitude harus terisi otomatis
5. Notifikasi hijau harus muncul menampilkan koordinat

### Expected Results:
- ✅ Total kategori: 4
- ✅ Klik peta → Modal terbuka
- ✅ Input lat/lng terisi otomatis
- ✅ Notifikasi koordinat muncul
- ✅ Console log menampilkan koordinat

### Debugging:
Jika koordinat tidak terisi:
1. Buka Developer Tools (F12)
2. Lihat tab Console 
3. Harus ada log: "Map clicked at: [lat], [lng]"
4. Harus ada log: "Opening modal with coordinates: [lat], [lng]"
5. Harus ada log: "Coordinates set in form: [lat], [lng]"

### Files Modified:
1. `app/Models/Fasilitas.php` - Method getTypesWithCounts()
2. `resources/views/admin/locations.blade.php` - Hardcode total kategori + fungsi baru
3. `public/js/admin-map.js` - Perbaikan event handler klik peta
