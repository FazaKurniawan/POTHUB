<?php
include 'config.php';


function uploadImage($file) {
    if (empty($file) || empty($file["name"])) {
        return false;
    }
    
    $targetDir = "../uploads/images/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    
    $targetFile = $targetDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
   
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return false;
    }
    
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;
    }
    return false;
}


function getPlants() {
    global $conn;
    $result = $conn->query("SELECT * FROM plants");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getPlantById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM plants WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function addPlant($nama, $kategori, $deskripsi, $cara_tanam, $gambar) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO plants (nama_tanaman, kategori, deskripsi, cara_tanam, gambar) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $kategori, $deskripsi, $cara_tanam, $gambar);
    return $stmt->execute();
}

function updatePlant($id, $nama, $kategori, $deskripsi, $cara_tanam, $gambar) {
    global $conn;
    $stmt = $conn->prepare("UPDATE plants SET nama_tanaman=?, kategori=?, deskripsi=?, cara_tanam=?, gambar=? WHERE id=?");
    $stmt->bind_param("sssssi", $nama, $kategori, $deskripsi, $cara_tanam, $gambar, $id);
    return $stmt->execute();
}

function deletePlant($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM plants WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}


function getPlantsByCategory($kategori = null) {
    global $conn;
    if ($kategori) {
        $stmt = $conn->prepare("SELECT * FROM plants WHERE kategori = ?");
        $stmt->bind_param("s", $kategori);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } else {
        return getPlants(); 
    }
}


function getUniqueCategories() {
    global $conn;
    $result = $conn->query("SELECT DISTINCT kategori FROM plants");
    return $result->fetch_all(MYSQLI_ASSOC);
}



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Helper: cek apakah user sudah login
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Helper: cek apakah user adalah admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}


function loginUser($email, $password, $role) {
    global $conn;
    
   
    if (empty($email) || empty($password)) {
        return ['status' => false, 'message' => 'Email dan password tidak boleh kosong'];
    }
    
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!$user) {
        
        if ($role === 'user') {
            return ['status' => false, 'message' => 'Email tidak ditemukan. Silakan daftar terlebih dahulu di <a href="../uploads/register.php">halaman registrasi</a>.'];
        }
        return ['status' => false, 'message' => 'Email atau role tidak ditemukan'];
    }
    
    
    if ($password === $user['password']) {
       
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nama'] = $user['nama'];
        
        return ['status' => true, 'message' => 'Login berhasil'];
    } else {
        return ['status' => false, 'message' => 'Password salah'];
    }
}

//logout
function logoutUser() {
    session_destroy();
    header("Location: ../uploads/index.php");
    exit;
}


function isUserRole() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'user';
}

// Fungsi untuk protect halaman admin
function protectAdminPage() {
    if (!isUserLoggedIn() || !isAdmin()) {
        header("Location: ../uploads/login.php");
        exit;
    }

}


?>