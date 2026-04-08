<?php include '../includes/functions.php';
protectUserPage(); // Pastikan user sudah login
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - POTHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Compact User Dashboard */
        main {
            padding: 15px;
            max-width: 1100px;
            margin: 0 auto;
        }
        
        /* Welcome Card */
        .card {
            margin-bottom: 15px !important;
        }
        
        main .row:first-child .card {
            border-radius: 8px !important;
        }
        
        main .row:first-child .card-body {
            padding: 12px 15px !important;
        }
        
        main .row:first-child h1 {
            font-size: 1.3rem !important;
            margin: 0 !important;
        }
        
        main .row:first-child p {
            font-size: 0.9rem !important;
            margin: 3px 0 !important;
        }
        
        /* Menu Dashboard Cards */
        main > .row.g-3 {
            margin-bottom: 30px !important;
            gap: 12px !important;
        }
        
        main > .row.g-3 .col-md-3 {
            padding: 6px !important;
        }
        
        main > .row.g-3 .card {
            border-radius: 8px !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
        }
        
        main > .row.g-3 .card-body {
            padding: 15px 10px !important;
        }
        
        main > .row.g-3 i.fa-3x {
            font-size: 2.2rem !important;
            margin-bottom: 10px !important;
        }
        
        main > .row.g-3 .card-title {
            font-size: 0.95rem !important;
            margin-bottom: 6px !important;
            font-weight: 600;
        }
        
        main > .row.g-3 .card-text {
            font-size: 0.8rem !important;
            margin-bottom: 8px !important;
        }
        
        main > .row.g-3 .btn {
            padding: 5px 12px !important;
            font-size: 0.8rem !important;
            border-radius: 5px !important;
        }
        
        /* Tanaman Terbaru Section */
        main > .mt-5:last-of-type h2 {
            font-size: 1.3rem !important;
            margin-bottom: 15px !important;
        }
        
        main > .mt-5:last-of-type .col-md-4 {
            padding: 8px !important;
            margin-bottom: 0 !important;
        }
        
        main > .mt-5:last-of-type .card {
            border-radius: 8px !important;
            overflow: hidden;
        }
        
        main > .mt-5:last-of-type .card-img-top {
            height: 150px !important;
        }
        
        main > .mt-5:last-of-type .card-body {
            padding: 10px !important;
        }
        
        main > .mt-5:last-of-type .card-title {
            font-size: 0.95rem !important;
            margin-bottom: 5px !important;
        }
        
        main > .mt-5:last-of-type .card-text {
            font-size: 0.8rem !important;
            margin-bottom: 8px !important;
        }
        
        main > .mt-5:last-of-type .btn {
            padding: 5px 10px !important;
            font-size: 0.75rem !important;
        }
        
        /* Info Alert */
        main > .mt-5:last-child .alert {
            padding: 10px 12px !important;
            margin-top: 15px !important;
            font-size: 0.9rem !important;
        }
    </style>
</head>
<body class="bg-light" style="display: flex; flex-direction: column; min-height: 100vh;">
    <?php include 'navbar.php'; ?>
    
    <main style="flex: 1;">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm bg-white" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white;">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h1 class="card-title mb-1" style="color: white !important; font-size: 1.3rem;">
                                    <i class="fas fa-user-circle" style="color: white !important;"></i> Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?>!
                                </h1>
                                <p class="card-text mb-0" style="color: white !important; font-size: 0.9rem;">
                                    <i class="fas fa-envelope" style="color: white !important;"></i> <?php echo htmlspecialchars($_SESSION['email']); ?>
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <a href="logout.php" class="btn btn-light btn-sm" style="padding: 5px 12px; font-size: 0.8rem;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Dashboard -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body" style="padding: 15px 10px;">
                        <i class="fas fa-leaf text-success mb-2" style="font-size: 2.2rem;"></i>
                        <h5 class="card-title" style="font-size: 0.95rem; margin: 6px 0;">Jelajahi Tanaman</h5>
                        <p class="card-text text-muted" style="font-size: 0.8rem; margin-bottom: 8px;">Pelajari berbagai jenis tanaman</p>
                        <a href="index.php" class="btn btn-success btn-sm" style="padding: 5px 12px; font-size: 0.8rem;">
                            <i class="fas fa-eye"></i> Lihat Semua
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body" style="padding: 15px 10px;">
                        <i class="fas fa-book text-info mb-2" style="font-size: 2.2rem;"></i>
                        <h5 class="card-title" style="font-size: 0.95rem; margin: 6px 0;">Tutorial</h5>
                        <p class="card-text text-muted" style="font-size: 0.8rem; margin-bottom: 8px;">Panduan budidaya tanaman</p>
                        <a href="tutorial.php" class="btn btn-info btn-sm" style="padding: 5px 12px; font-size: 0.8rem;">
                            <i class="fas fa-play"></i> Mulai
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body" style="padding: 15px 10px;">
                        <i class="fas fa-list text-warning mb-2" style="font-size: 2.2rem;"></i>
                        <h5 class="card-title" style="font-size: 0.95rem; margin: 6px 0;">Kategori</h5>
                        <p class="card-text text-muted" style="font-size: 0.8rem; margin-bottom: 8px;">Jelajahi berdasarkan kategori</p>
                        <a href="kategori.php" class="btn btn-warning btn-sm" style="padding: 5px 12px; font-size: 0.8rem;">
                            <i class="fas fa-tags"></i> Lihat
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body" style="padding: 15px 10px;">
                        <i class="fas fa-cog text-secondary mb-2" style="font-size: 2.2rem;"></i>
                        <h5 class="card-title" style="font-size: 0.95rem; margin: 6px 0;">Profil</h5>
                        <p class="card-text text-muted" style="font-size: 0.8rem; margin-bottom: 8px;">Kelola akun Anda</p>
                        <a href="profile.php" class="btn btn-secondary btn-sm" style="padding: 5px 12px; font-size: 0.8rem;">
                            <i class="fas fa-edit"></i> Ubah
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tanaman Terbaru -->
        <div class="mt-4">
            <h2 class="text-success mb-3" style="font-size: 1.3rem;">
                <i class="fas fa-star"></i> Tanaman Terbaru
            </h2>
            <div class="row">
                <?php
                $plants = getPlants();
                $count = 0;
                foreach ($plants as $plant) {
                    if ($count >= 6) break;
                    $count++;
                    
                    $gambar = ($plant['gambar'] ?: '../assets/images/placeholder.jpg');
                    $nama = htmlspecialchars($plant['nama_tanaman']);
                    $deskripsi = htmlspecialchars(substr($plant['deskripsi'], 0, 80));
                    echo '<div class="col-md-4 mb-3" style="padding: 8px;">
                            <div class="card h-100 shadow-sm border-0" style="border-radius: 8px; overflow: hidden;">
                                <img src="' . htmlspecialchars($gambar) . '" class="card-img-top" alt="' . $nama . '" style="height: 150px; object-fit: cover;">
                                <div class="card-body" style="padding: 10px;">
                                    <h5 class="card-title text-success" style="font-size: 0.95rem; margin-bottom: 5px;">' . $nama . '</h5>
                                    <p class="card-text text-muted" style="font-size: 0.8rem; margin-bottom: 8px;">' . $deskripsi . '...</p>
                                    <a href="plant-detail.php?id=' . $plant['id'] . '" class="btn btn-success btn-sm w-100" style="padding: 5px 10px; font-size: 0.75rem;">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="mt-4 pt-3 border-top">
            <div class="alert alert-info" role="alert" style="padding: 10px 12px; margin: 0; font-size: 0.9rem;">
                <i class="fas fa-info-circle"></i> <strong>Tips:</strong> 
                Gunakan fitur pencarian untuk menemukan tanaman yang Anda cari dengan lebih cepat. 
                Baca deskripsi lengkap dan cara tanam untuk setiap tanaman.
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>
