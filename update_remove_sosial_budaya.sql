-- Script untuk menghapus atau mengupdate data fasilitas dengan type 'sosial_budaya'
-- Bisa dijalankan di database jika ada data dengan kategori tersebut

-- Option 1: Hapus semua data dengan type sosial_budaya
-- DELETE FROM fasilitas WHERE type = 'sosial_budaya';

-- Option 2: Ubah ke kategori lain (misalnya ekonomi)
-- UPDATE fasilitas SET type = 'ekonomi' WHERE type = 'sosial_budaya';

-- Option 3: Cek berapa banyak data sosial_budaya yang ada
-- SELECT COUNT(*) as jumlah_sosial_budaya FROM fasilitas WHERE type = 'sosial_budaya';

-- Option 4: Lihat semua data sosial_budaya sebelum dihapus
-- SELECT * FROM fasilitas WHERE type = 'sosial_budaya';
