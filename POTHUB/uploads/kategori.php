<?php
include '../includes/functions.php';

// Ambil kategori dari URL (misalnya, ?kategori=Sayuran)
$selectedCategory = $_GET['kategori'] ?? null;
$plants = getPlantsByCategory($selectedCategory);
$categories = getUniqueCategories();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Tanaman - POTHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light" style="display: flex; flex-direction: column; min-height: 100vh;">
    <?php include 'navbar.php'; ?>
    <main style="flex: 1;">
        <div class="container my-5">
        <h1 class="text-center text-success mb-4">Kategori Tanaman</h1>
        <p class="text-center mb-5">Pilih kategori untuk melihat tanaman spesifik. Jelajahi berbagai jenis tanaman!</p>
        
        <!-- Filter Kategori -->
        <div class="d-flex justify-content-center mb-4">
            <a href="kategori.php" class="btn btn-outline-success me-2">Semua</a>
            <?php
            foreach ($categories as $cat) {
                $active = ($selectedCategory == $cat['kategori']) ? 'btn-success' : 'btn-outline-success';
                $kategori_encoded = urlencode($cat['kategori']);
                $kategori_safe = htmlspecialchars($cat['kategori']);
                echo '<a href="kategori.php?kategori=' . $kategori_encoded . '" class="btn ' . $active . ' me-2">' . $kategori_safe . '</a>';
            }
            ?>
        </div>
        
        <div class="row">
            <?php
            if (empty($plants)) {
                echo '<div class="col-12"><p class="text-center text-muted">Tidak ada tanaman di kategori ini.</p></div>';
            } else {
                foreach ($plants as $plant) {
                    $gambar = ($plant['gambar'] ?: '../assets/images/placeholder.jpg');
                    $nama = htmlspecialchars($plant['nama_tanaman']);
                    $deskripsi = htmlspecialchars(substr($plant['deskripsi'], 0, 100));
                    echo '<div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="' . htmlspecialchars($gambar) . '" class="card-img-top" alt="' . $nama . '">
                                <div class="card-body">
                                    <h5 class="card-title text-success">' . $nama . '</h5>
                                    <p class="card-text text-muted">' . $deskripsi . '...</p>
                                    <a href="plant-detail.php?id=' . $plant['id'] . '" class="btn btn-success">Baca Lebih Lanjut</a>
                                </div>
                            </div>
                          </div>';
                }
            }
            ?>
        </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>