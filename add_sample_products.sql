-- Insert sample products dengan koordinat untuk testing integrasi map
INSERT INTO products (name_product, category, owner, contact, description, image, status, latitude, longitude, created_at, updated_at) VALUES
('Padi Organik Wonokarang', 'pertanian', 'Kelompok Tani Maju Jaya', '081234567890', 'Padi organik ditanam tanpa bahan kimia, kualitas premium hasil panen desa.', 'padi.jpg', 'active', -7.4125000, 112.5195000, NOW(), NOW()),
('Bunga Mawar Merah Premium', 'budidaya-bunga', 'Sari Bunga Florist', '082345678901', 'Bunga mawar segar hasil budidaya lokal, cocok untuk dekorasi & hadiah.', 'mawar.jpg', 'active', -7.4140000, 112.5210000, NOW(), NOW()),
('Sayur Kangkung Segar', 'pertanian', 'Pak Slamet', '083456789012', 'Kangkung segar dipetik langsung dari kebun setiap pagi.', 'kangkung.jpg', 'active', -7.4135000, 112.5205000, NOW(), NOW()),
('Bunga Melati Putih', 'budidaya-bunga', 'Bu Sari Melati', '084567890123', 'Bunga melati putih wangi untuk keperluan upacara dan dekorasi.', 'melati.jpg', 'active', -7.4130000, 112.5220000, NOW(), NOW()),
('Cabai Rawit Merah', 'pertanian', 'Kelompok Tani Sejahtera', '085678901234', 'Cabai rawit merah pedas berkualitas tinggi dari kebun organik.', 'cabai.jpg', 'active', -7.4138000, 112.5200000, NOW(), NOW());
