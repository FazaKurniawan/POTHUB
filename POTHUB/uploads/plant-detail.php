<?php include '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tanaman - POTHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .detail-section {
            background-color: #f8fff8;
            border-left: 4px solid #28a745;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .detail-image {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-back {
            margin-bottom: 20px;
        }
        .section-title {
            color: #28a745;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        .plant-title {
            color: #28a745;
            font-weight: bold;
            font-size: 2rem;
        }
    </style>
</head>
<body class="bg-light" style="display: flex; flex-direction: column; min-height: 100vh;">
    <?php include 'navbar.php'; ?>
    <main style="flex: 1;">
    
    <div class="container my-5">
        <a href="index.php" class="btn btn-outline-success btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>

        <?php
        // Cek apakah ID tanaman dikirim melalui URL
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo '<div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i> Tanaman tidak ditemukan!
                  </div>';
            exit;
        }

        $id = intval($_GET['id']);
        $plant = getPlantById($id);

        if (!$plant) {
            echo '<div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i> Data tanaman tidak ditemukan!
                  </div>';
            exit;
        }

        $gambar = ($plant['gambar'] ?: '../assets/images/placeholder.jpg');
        $nama = htmlspecialchars($plant['nama_tanaman']);
        $kategori = htmlspecialchars($plant['kategori']);
        $deskripsi = htmlspecialchars($plant['deskripsi']);
        $cara_tanam = htmlspecialchars($plant['cara_tanam']);
        ?>

        <div class="row">
            <!-- Kolom Gambar -->
            <div class="col-md-5 mb-4">
                <img src="<?php echo htmlspecialchars($gambar); ?>" alt="<?php echo $nama; ?>" class="detail-image">
                <div class="mt-3">
                    <span class="badge bg-success">Kategori: <?php echo $kategori; ?></span>
                </div>
            </div>

            <!-- Kolom Informasi -->
            <div class="col-md-7">
                <h1 class="plant-title mb-3"><?php echo $nama; ?></h1>

                <!-- Deskripsi -->
                <div class="detail-section">
                    <h3 class="section-title">
                        <i class="fas fa-leaf"></i> Deskripsi
                    </h3>
                    <p class="text-justify"><?php echo nl2br($deskripsi); ?></p>
                </div>

                <!-- Cara Tanam -->
                <div class="detail-section">
                    <h3 class="section-title">
                        <i class="fas fa-seedling"></i> Cara Tanam
                    </h3>
                    <p class="text-justify"><?php echo nl2br($cara_tanam); ?></p>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-4">
                    <a href="index.php" class="btn btn-success me-2">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                    <a href="kategori.php?kategori=<?php echo urlencode($kategori); ?>" class="btn btn-outline-success">
                        <i class="fas fa-list"></i> Lihat Kategori <?php echo $kategori; ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tanaman Serupa -->
        <div class="mt-5 pt-4 border-top">
            <h3 class="text-success mb-4">
                <i class="fas fa-heart"></i> Tanaman Serupa
            </h3>
            <div class="row">
                <?php
                $related = getPlantsByCategory($kategori);
                $count = 0;
                foreach ($related as $relatedPlant) {
                    // Skip tanaman yang sama
                    if ($relatedPlant['id'] == $id) {
                        continue;
                    }
                    if ($count >= 3) {
                        break;
                    }
                    $count++;

                    $relGambar = ($relatedPlant['gambar'] ?: '../assets/images/placeholder.jpg');
                    $relNama = htmlspecialchars($relatedPlant['nama_tanaman']);
                    $relDeskripsi = htmlspecialchars(substr($relatedPlant['deskripsi'], 0, 80));
                    echo '<div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="' . htmlspecialchars($relGambar) . '" class="card-img-top" alt="' . $relNama . '">
                                <div class="card-body">
                                    <h5 class="card-title text-success">' . $relNama . '</h5>
                                    <p class="card-text text-muted text-truncate">' . $relDeskripsi . '...</p>
                                    <a href="plant-detail.php?id=' . $relatedPlant['id'] . '" class="btn btn-success btn-sm">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>';
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
