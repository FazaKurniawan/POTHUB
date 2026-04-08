<?php include '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - POTHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .register-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .register-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .register-header h1 {
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
        }
        .register-header p {
            margin: 10px 0 0 0;
            font-size: 0.95rem;
        }
        .register-body {
            padding: 40px;
        }
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            margin-top: 10px;
        }
        .btn-register:hover {
            background: linear-gradient(135deg, #218838 0%, #1aa179 100%);
            color: white;
        }
        .alert {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: #28a745;
            text-decoration: none;
            font-weight: 600;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
        .input-group-text {
            background-color: #f8fff8;
            border-color: #ddd;
        }
        footer {
            background: rgba(0, 0, 0, 0.1);
            color: white;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-container" style="max-width: 450px; width: 100%; margin: 20px;">
        <div class="register-header">
                <img src="../assets/Image/logo.png" alt="POTHUB Logo" style="height: 60px; width: auto; margin-bottom: 10px;">
                <p>Daftar Akun Baru</p>
        </div>
        <div class="register-body">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nama = $_POST['nama'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                $confirm_password = $_POST['confirm_password'] ?? '';
                
                // Validasi password cocok
                if ($password !== $confirm_password) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> Password tidak cocok!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                } else {
                    $result = registerUser($nama, $email, $password, 'user');
                    
                    if ($result['status']) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> ' . $result['message'] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>';
                        echo '<script>setTimeout(() => { window.location.href = "login.php"; }, 2000);</script>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i> ' . $result['message'] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>';
                    }
                }
            }
            ?>

            <form method="POST">
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter" required minlength="6">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Ulangi password Anda" required minlength="6">
                    </div>
                </div>

                <button type="submit" class="btn btn-register btn-success w-100">
                    <i class="fas fa-user-plus"></i> Daftar Akun
                </button>
            </form>

            <div class="back-link">
                <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
            </div>
        </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
