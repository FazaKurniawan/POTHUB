<?php include '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POTHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .login-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .login-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
        }
        .login-header p {
            margin: 10px 0 0 0;
            font-size: 0.95rem;
        }
        .login-body {
            padding: 40px;
        }
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            margin-top: 10px;
        }
        .btn-login:hover {
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
    <div class="login-wrapper">
        <div class="login-container" style="max-width: 450px; width: 100%; margin: 20px;">
            <div class="login-header">
                <h1 style="margin: 0; font-size: 2.5rem; font-weight: bold;">POTHUB</h1>
                <p>Platform Edukasi Budidaya Tanaman</p>
            </div>

            <div class="login-body">
                <!-- Admin Login (Only Admin) -->
                <div style="margin-top: 30px;">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
                        $email = $_POST['admin_email'] ?? '';
                        $password = $_POST['admin_password'] ?? '';
                        
                        $result = loginUser($email, $password, 'admin');
                        
                        if ($result['status']) {
                            // Redirect langsung ke dashboard admin
                            header("Location: ../admin/dashboard.php");
                            exit;
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> ' . $result['message'] . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                  </div>';
                        }
                    }
                    ?>

                            <form method="POST">
                                <div class="form-group">
                                    <label class="form-label" for="admin-email">Email Admin</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="admin-email" name="admin_email" placeholder="Masukkan email admin" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="admin-password">Password Admin</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="admin-password" name="admin_password" placeholder="Masukkan password admin" required>
                                    </div>
                                </div>

                                <button type="submit" name="admin_login" class="btn btn-login btn-success w-100">
                                    <i class="fas fa-sign-in-alt"></i> Masuk Sebagai Admin
                                </button>
                            </form>

                            <div class="back-link">
                                <p><a href="index.php"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
