<?php include '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POTHUB - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light" style="display: flex; flex-direction: column; min-height: 100vh;">
    <?php include 'navbar.php'; ?>
    <main style="flex: 1;">
        <div class="container my-5">
            <?php
            $search_query = $_GET['search'] ?? '';
            if ($search_query) {
                echo '<h1 class="text-center text-success mb-4">Hasil Pencarian: "' . htmlspecialchars($search_query) . '"</h1>';
            } else {
                echo '<h1 class="text-center text-success mb-4">Selamat Datang di POTHUB</h1>';
                echo '<p class="text-center mb-5">Platform edukasi budidaya tanaman untuk pemula. Jelajahi tutorial dan kategori tanaman!</p>';
            }
            ?>
        
        <div class="row">
            <?php
            if ($search_query) {
                // Search plants by name
                $search_term = '%' . $search_query . '%';
                global $conn;
                $stmt = $conn->prepare("SELECT * FROM plants WHERE nama_tanaman LIKE ? OR deskripsi LIKE ?");
                $stmt->bind_param("ss", $search_term, $search_term);
                $stmt->execute();
                $plants = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                
                if (empty($plants)) {
                    echo '<div class="col-12"><div class="alert alert-info text-center"><i class="fas fa-info-circle"></i> Tidak ada tanaman yang ditemukan. Coba pencarian lain.</div></div>';
                }
            } else {
                $plants = getPlants();
            }
            
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
            ?>
        </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>