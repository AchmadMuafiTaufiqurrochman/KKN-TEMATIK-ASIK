-- Insert test data for village facilities di sekitar Desa Wonokarang yang tepat
INSERT INTO map_locations (name, description, type, latitude, longitude, opening_hours, pic_name, contact, status, created_at, updated_at) VALUES
('Balai Desa Wonokarang', 'Kantor pelayanan administrasi desa dan tempat pertemuan warga', 'pelayanan_publik', -7.4129785, 112.5208843, '08:00-16:00', 'Pak Lurah', '081234567890', 'active', NOW(), NOW()),
('SDN Wonokarang 1', 'Sekolah Dasar Negeri untuk pendidikan anak-anak desa', 'pendidikan', -7.4135, 112.5215, '07:00-12:00', 'Ibu Kepala Sekolah', '081234567891', 'active', NOW(), NOW()),
('Puskesmas Pembantu Wonokarang', 'Fasilitas kesehatan untuk pelayanan dasar masyarakat', 'kesehatan', -7.4125, 112.5200, '08:00-15:00', 'Bidan Desa', '081234567892', 'active', NOW(), NOW()),
('Pasar Desa Wonokarang', 'Pusat perdagangan dan ekonomi masyarakat desa', 'ekonomi', -7.4140, 112.5220, '06:00-18:00', 'Ketua Paguyuban Pedagang', '081234567893', 'active', NOW(), NOW()),
('Sanggar Budaya Wonokarang', 'Tempat kegiatan seni dan budaya masyarakat', 'sosial_budaya', -7.4132, 112.5205, '19:00-21:00', 'Ketua Karang Taruna', '081234567894', 'active', NOW(), NOW()),
('TK Dharma Wanita Wonokarang', 'Taman Kanak-kanak untuk pendidikan usia dini', 'pendidikan', -7.4138, 112.5225, '07:30-11:30', 'Ibu Guru TK', '081234567895', 'active', NOW(), NOW()),
('Posyandu Melati', 'Pos pelayanan terpadu untuk ibu dan anak', 'kesehatan', -7.4127, 112.5195, 'Setiap Kamis 09:00-12:00', 'Kader Posyandu', '081234567896', 'active', NOW(), NOW()),
('Toko Sembako Berkah', 'Toko kebutuhan sehari-hari masyarakat', 'ekonomi', -7.4133, 112.5210, '06:00-21:00', 'Pemilik Toko', '081234567897', 'active', NOW(), NOW());
