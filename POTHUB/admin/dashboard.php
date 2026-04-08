<?php include '../includes/functions.php';
protectAdminPage();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - POTHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        * {
            box-sizing: border-box;
        }
        
        html {
            width: 100%;
            height: 100%;
            overflow-x: hidden;
        }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }
        
        main {
            flex: 1;
            width: 100vw;
            max-width: 100%;
            overflow-x: hidden;
            padding: 20px 0;
        }
        
        .dashboard-container {
            max-width: 900px;
            margin: 0 auto;
            width: calc(100% - 20px);
            padding: 0 10px;
        }
        
        .admin-header {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .btn-add-plant {
            margin-bottom: 15px;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
        }
        
        .plants-card {
            border-radius: 10px;
            border: none;
            overflow: hidden;
            width: 100%;
            max-width: 100%;
        }
        
        .plants-card .card-header {
            border-radius: 10px 10px 0 0;
            padding: 12px 10px;
            font-weight: 600;
            font-size: 0.95rem;
            overflow: hidden;
        }
        
        .card-body {
            padding: 0;
            overflow: hidden;
        }
        
        .table-responsive {
            width: 100%;
            max-width: 100%;
            overflow: auto;
        }
        
        .table {
            margin-bottom: 0;
            font-size: 0.85rem;
            width: 100%;
            max-width: 100%;
        }
        
        .table thead {
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .table tbody tr {
            vertical-align: middle;
            height: auto;
        }
        
        .table tbody tr:hover {
            background-color: #f8fff8;
        }
        
        .table td, .table th {
            padding: 8px 6px;
            word-break: break-word;
            overflow: hidden;
        }
        
        .btn-action {
            padding: 4px 8px;
            font-size: 0.75rem;
            margin-right: 2px;
            margin-bottom: 2px;
            border-radius: 4px;
            white-space: nowrap;
            display: inline-block;
        }
        
        .badge {
            padding: 5px 8px;
            font-size: 0.85rem;
            border-radius: 15px;
            display: inline-block;
        }
        
        .img-thumbnail-plant {
            border-radius: 6px;
            object-fit: cover;
            border: 2px solid #e0e0e0;
            max-width: 55px;
            height: 55px;
        }
        
        @media (max-width: 992px) {
            main {
                padding: 20px 5px;
            }
            
            .dashboard-container {
                padding: 0 10px;
            }
            
            .admin-header {
                padding: 15px;
                margin-bottom: 20px;
            }
            
            .admin-header h1 {
                font-size: 1.6rem !important;
            }
        }
        
        @media (max-width: 768px) {
            main {
                padding: 15px 5px;
            }
            
            .dashboard-container {
                max-width: 100%;
                padding: 0 5px;
            }
            
            .admin-header h1 {
                font-size: 1.4rem !important;
            }
            
            .admin-header p {
                font-size: 0.85rem !important;
            }
            
            .table {
                font-size: 0.75rem;
            }
            
            .btn-action {
                padding: 3px 6px;
                font-size: 0.65rem;
            }
            
            .img-thumbnail-plant {
                max-width: 40px;
                height: 40px;
            }
        }
    </style>
<body class="bg-light">
    <?php include '../uploads/navbar.php'; ?>
    <main>
        <div class="dashboard-container">
            <div style="margin-bottom: 25px;">
                <div>
                    <div class="card border-0 shadow-sm admin-header" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white;">
                        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                            <div style="flex: 1; min-width: 250px;">
                                <h1 class="mb-2" style="color: white !important; font-weight: 700; font-size: 1.9rem; margin: 0;">
                                    <i class="fas fa-cogs" style="color: white !important; margin-right: 10px;"></i>Admin Dashboard 
                                </h1>
                                <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: 0.95rem;">
                                    <i class="fas fa-leaf"></i> Kelola semua data tanaman di POTHUB
                                </p>
                            </div>
                            <div style="text-align: right;">
                                <span class="badge bg-white text-success" style="padding: 8px 12px; font-size: 0.9rem;">
                                    <i class="fas fa-shield-alt"></i> Admin Terverifikasi
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <a href="add_plant.php" class="btn btn-success btn-add-plant shadow-sm">
                    <i class="fas fa-plus-circle"></i> Tambah Tanaman Baru
                </a>
            </div>
            
            <div>
                <div class="card shadow-sm plants-card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-list-ul"></i> Daftar Tanaman
                        </h5>
                    </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm">
                                    <thead class="table-success">
                                        <tr>
                                            <th style="width: 5%;">ID</th>
                                            <th style="width: 25%;">Nama Tanaman</th>
                                            <th style="width: 15%;">Kategori</th>
                                            <th style="width: 15%;">Gambar</th>
                                            <th style="width: 40%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $plants = getPlants();
                                        if (count($plants) > 0) {
                                            foreach ($plants as $plant) {
                                                $img = $plant['gambar'] ? '<img src="' . htmlspecialchars($plant['gambar']) . '" width="50" height="50" class="img-thumbnail-plant">' : '<span class="badge bg-secondary">Tidak ada</span>';
                                                echo "<tr>
                                                        <td><strong>" . htmlspecialchars($plant['id']) . "</strong></td>
                                                        <td><strong>" . htmlspecialchars($plant['nama_tanaman']) . "</strong></td>
                                                        <td><span class='badge bg-info text-white'>" . htmlspecialchars($plant['kategori']) . "</span></td>
                                                        <td class='text-center'>" . $img . "</td>
                                                        <td>
                                                            <a href='edit_plant.php?id=" . htmlspecialchars($plant['id']) . "' class='btn btn-warning btn-action'>
                                                                <i class='fas fa-edit'></i> Edit
                                                            </a>
                                                            <a href='delete_plant.php?id=" . htmlspecialchars($plant['id']) . "' class='btn btn-danger btn-action' onclick='return confirm(\"Hapus tanaman ini? Tindakan tidak dapat dibatalkan!\")'>
                                                                <i class='fas fa-trash-alt'></i> Hapus
                                                            </a>
                                                        </td>
                                                      </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center text-muted py-5'><i class='fas fa-inbox'></i> Belum ada tanaman. <a href='add_plant.php'>Tambah tanaman sekarang</a></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include '../uploads/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>