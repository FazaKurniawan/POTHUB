<?php
include '../includes/functions.php';
protectAdminPage(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_tanaman'] ?? '';
    $kategori = $_POST['kategori'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $cara_tanam = $_POST['cara_tanam'] ?? '';
    $gambar = uploadImage($_FILES['gambar'] ?? []);
    if (addPlant($nama, $kategori, $deskripsi, $cara_tanam, $gambar)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Gagal menambah tanaman.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tanaman - POTHUB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <?php include '../uploads/navbar.php'; ?>
    <div class="container my-5">
        <h1 class="text-center text-success">Tambah Tanaman Baru</h1>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>"; ?>
        <form id="plantForm" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="nama_tanaman" class="form-label">Nama Tanaman</label>
                <input type="text" class="form-control" id="nama_tanaman" name="nama_tanaman" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="cara_tanam" class="form-label">Cara Tanam</label>
                <textarea class="form-control" id="cara_tanam" name="cara_tanam" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Tanaman</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah Tanaman</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <?php include '../uploads/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>