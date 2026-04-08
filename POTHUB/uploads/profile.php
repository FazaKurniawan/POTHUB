<?php include '../includes/functions.php';
protectUserPage(); // Pastikan user sudah login
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - POTHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light" style="display: flex; flex-direction: column; min-height: 100vh;">
    <?php include 'navbar.php'; ?>
    
    <main style="flex: 1;">
        <a href="user-dashboard.php" class="btn btn-outline-success mb-4">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-user-circle"></i> Profil Saya</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3 text-center">
                                <div style="font-size: 80px; color: #28a745;">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h3 class="text-success"><?php echo htmlspecialchars($_SESSION['nama']); ?></h3>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($_SESSION['email']); ?>
                                </p>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-badge"></i> Role: <span class="badge bg-success"><?php echo ucfirst($_SESSION['role']); ?></span>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-success mb-3">Informasi Akun</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Nama:</strong></td>
                                        <td><?php echo htmlspecialchars($_SESSION['nama']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td><?php echo htmlspecialchars($_SESSION['email']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Role:</strong></td>
                                        <td><?php echo ucfirst($_SESSION['role']); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-success mb-3">Aksi</h5>
                                <button class="btn btn-primary btn-sm w-100 mb-2" disabled>
                                    <i class="fas fa-edit"></i> Edit Profil (Segera Hadir)
                                </button>
                                <button class="btn btn-warning btn-sm w-100 mb-2" disabled>
                                    <i class="fas fa-key"></i> Ubah Password (Segera Hadir)
                                </button>
                                <a href="logout.php" class="btn btn-danger btn-sm w-100">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </div>

                        <hr>

                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle"></i> <strong>Catatan:</strong>
                            Fitur edit profil dan ubah password akan segera tersedia. 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>
