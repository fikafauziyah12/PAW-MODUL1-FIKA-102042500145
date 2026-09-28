<?php
// Membuat seluruh data produk disimpan menggunakan array PHP
// Membuat 6 produk yang berbeda yang menjual berbagai perangkat dan aksesoris teknologi
$produk_list = [
    [
        "nama" => "Monitor 24 Inch",
        "kategori" => "Monitor",
        "harga" => 1800000,
        "stok" => 4
    ],
    [
        "nama" => "Laptop Asus Vivobook",
        "kategori" => "Laptop",
        "harga" => 8500000,
        "stok" => 3
    ],
    [
        "nama" => "ACER Mouse Wireless",
        "kategori" => "Aksesoris",
        "harga" => 150000,
        "stok" => 12
    ],
    [
        "nama" => "Keyboard Mechanical RGB",
        "kategori" => "Aksesoris",
        "harga" => 1250000,
        "stok" => 0 // Menguji status Stok Habis
    ],
    [
        "nama" => "SSD NVMe 1TB Fast",
        "kategori" => "Penyimpanan",
        "harga" => 1100000,
        "stok" => 7
    ],
    [
        "nama" => "Earphone TWS Bass",
        "kategori" => "Audio",
        "harga" => 350000,
        "stok" => 5
    ]
];

// Menghitung jumlah seluruh produk secara otomatis berdasarkan data yang tersimpan
$total_produk = count($produk_list);

// Fungsi pembantu untuk format mata uang Rupiah 
function formatRupiah($angka) {
    return "Rp" . number_format($angka, 0, ',', '.');
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Responsive layout sederhana -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Menamai website Cia Store -->
    <title>Cia Store - Katalog Produk</title>
    
    <!-- Menyambungkan kode ke file CSS eksternal -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
    <header>
        <div class="navbar">
            <div class="logo">Cia Store</div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-banner">
            <p class="sub">Cia Store</p>
            <h1>Simple Tech Store.</h1>
            <p class="desc">Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
            <a href="#katalog" class="btn-hero">Lihat Produk</a>
        </div>
    </section>

    <!-- Bagian Utama / Katalog -->
    <main class="katalog-section" id="katalog">
        <div class="katalog-header">
            <h2>Katalog Produk</h2>
            <!-- Menampilkan total produk otomatis -->
            <div class="total-info">Total Produk: <?php echo $total_produk; ?></div>
        </div>

        <div class="grid-container">
            <?php 
            /* Menggunakan PERULANGAN PHP untuk menampilkan data produk */
            foreach ($produk_list as $produk) {
                
                // --- PROSES TANTANGAN (CHALLENGE DISKON 10%) ---
                // Harga setelah diskon dihitung menggunakan operasi aritmatika PHP
                $mendapat_diskon = false;
                $harga_final = $produk['harga'];
                $persentase_diskon = "";

                if ($produk['harga'] >= 1000000) {
                    $mendapat_diskon = true;
                    $persentase_diskon = "DISKON 10%";
                    $harga_final = $produk['harga'] * 0.90; // Potongan 10%
                }
                
                // Menggunakan PERCABANGAN PHP untuk menentukan status berdasarkan stok
                if ($produk['stok'] > 0) {
                    $status_stok = "Tersedia";
                    $badge_class = "badge-tersedia";
                    // Produk tersedia memiliki tombol aktif
                    $button_html = '<button class="btn-beli">Beli Sekarang</button>';
                } else {
                    $status_stok = "Stok Habis";
                    $badge_class = "badge-habis";
                    // Apabila stok habis, tombol dinonaktifkan
                    $button_html = '<button class="btn-beli btn-disabled" disabled>Stok Habis</button>';
                }
            ?>
                <div class="card">
                    <div>
                        <!-- Informasi kategori & bonus diskon -->
                        <div class="card-tag">
                            <?php echo htmlspecialchars($produk['kategori']); ?>
                            <?php if ($mendapat_diskon): ?>
                                <span class="diskon-badge"><?php echo $persentase_diskon; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Informasi nama produk -->
                        <h3 class="card-title"><?php echo htmlspecialchars($produk['nama']); ?></h3>
                        
                        <!-- Informasi harga (Ketentuan 10 format Rupiah & Challenge harga coret) -->
                        <div class="price-container">
                            <?php if ($mendapat_diskon): ?>
                                <span class="normal-price"><?php echo formatRupiah($produk['harga']); ?></span>
                            <?php endif; ?>
                            <span class="final-price"><?php echo formatRupiah($harga_final); ?></span>
                        </div>
                    </div>

                    <div>
                        <!-- Informasi Jumlah stok -->
                        <div class="stock-container">
                            <span class="stock-text">Stok: <?php echo $produk['stok']; ?></span>
                            <span class="badge <?php echo $badge_class; ?>"><?php echo $status_stok; ?></span>
                        </div>

                        <!-- Tombol beli dinamis -->
                        <?php echo $button_html; ?>
                    </div>
                </div>
            <?php 
            } // Akhir dari perulangan foreach 
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Cia Store. All rights reserved.</p>
    </footer>

</body>
</html>
