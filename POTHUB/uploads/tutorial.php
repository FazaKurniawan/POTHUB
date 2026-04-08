<?php include '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial Tanam Menanam - POTHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light" style="display: flex; flex-direction: column; min-height: 100vh;">
    <?php include 'navbar.php'; ?>
    <main style="flex: 1;">
        <div class="container my-5">
        <h1 class="text-center text-success mb-4">Tutorial Budidaya Tanaman</h1>
        <p class="text-center mb-5">Pelajari langkah-langkah mudah budidaya tanaman untuk pemula. Klik card untuk detail tutorial!</p>
        
        <div class="row">
            <?php
            $plants = getPlants(); // Ambil semua tanaman sebagai tutorial
                foreach ($plants as $plant) {
                $gambar = ($plant['gambar'] ?: '../assets/images/placeholder.jpg');
                $nama = htmlspecialchars($plant['nama_tanaman']);
                $deskripsi = htmlspecialchars(substr($plant['deskripsi'], 0, 100));
                $cara_tanam = htmlspecialchars(substr($plant['cara_tanam'], 0, 100));
                echo '<div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="' . htmlspecialchars($gambar) . '" class="card-img-top" alt="' . $nama . '">
                            <div class="card-body">
                                <h5 class="card-title text-success">' . $nama . '</h5>
                                <p class="card-text text-muted">' . $deskripsi . '...</p>
                                <p class="card-text"><strong>Cara Tanam:</strong> ' . $cara_tanam . '...</p>
                                <a href="plant-detail.php?id=' . $plant['id'] . '" class="btn btn-success">Lihat Tutorial Lengkap</a>
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