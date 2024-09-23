-- Mencari Tgl_Penjualan, id_penjualan dan Nama Pelanggan untuk tampilan penjualan
SELECT penjual.tanggal, penjual.id_penjualan, pelanggan.nama_pelanggan FROM penjual JOIN pelanggan on pelanggan.id_pelanggan=penjual.id_penjualan;

-- Menampilkan detailSELECT penjual.tanggal, penjual.id_penjualan, pelanggan.nama_pelanggan FROM penjual JOIN pelanggan on pelanggan.id_pelanggan=penjual.id_penjualan; penjualan dengan data: id_penjualan, tgl_penjualan, nama_pelanggan, nama_barang, jumlah_barang, harga_barang, subtotal
SELECT pnj.tanggal, pnj.id_penjualan, png.nama_pelanggan, brg.nama_barang, dpnj.jumlah, brg.harga
    FROM penjual AS pnj
        JOIN pelanggan AS png ON png.id_pelanggan=pnj.id_pelanggan
        JOIN detail_penjualan AS dpnj ON pnj.id_penjualan=dpnj.id_penjualan 
        JOIN barang AS brg ON dpnj.id_barang=brg.id_barang
    WHERE pnj.id_penjualan=1