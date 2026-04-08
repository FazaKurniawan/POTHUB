<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah file dipanggil dari folder admin
$isAdminPath = strpos($_SERVER['PHP_SELF'], 'admin') !== false;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- LOGO -->
        <a class="navbar-brand text-success fw-bold d-flex align-items-center gap-2"
           href="<?= $isAdminPath ? '../uploads/index.php' : 'index.php'; ?>">
            <img src="<?= $isAdminPath ? '../assets/Image/logo.png' : '../assets/Image/logo.png'; ?>"
                 alt="POTHUB Logo" style="height:40px;">
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAV -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <!-- SEARCH -->
                <li class="nav-item me-3">
                    <div id="searchContainer" class="d-flex align-items-center gap-2">
                        <button type="button" id="searchToggle" class="btn btn-link p-0">
                            <img src="<?= $isAdminPath ? '../assets/Image/searchbar.png' : '../assets/Image/searchbar.png'; ?>"
                                 alt="Search" style="height:30px;">
                        </button>

                        <form method="GET"
                              action="<?= $isAdminPath ? '../uploads/index.php' : 'index.php'; ?>"
                              id="searchForm" style="display:none;">
                            <input type="text" class="form-control"
                                   name="search"
                                   id="searchInput"
                                   placeholder="Cari tanaman..."
                                   style="width:200px;border-radius:20px;">
                        </form>
                    </div>
                </li>

                <!-- MENU UTAMA -->
                <li class="nav-item">
                    <a class="nav-link text-dark"
                       href="<?= $isAdminPath ? '../uploads/index.php' : 'index.php'; ?>">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark"
                       href="<?= $isAdminPath ? '../uploads/kategori.php' : 'kategori.php'; ?>">
                        Tanaman
                    </a>
                </li>

                <!-- LOGIN / USER -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php
                        $nama_user = htmlspecialchars($_SESSION['nama']);
                        $role = $_SESSION['role'];
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark"
                           href="#"
                           id="userDropdown"
                           role="button"
                           data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>
                            <?= $nama_user ?> (<?= ucfirst($role) ?>)
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if ($role === 'admin'): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item"
                                       href="<?= $isAdminPath ? 'dashboard.php' : '../admin/dashboard.php'; ?>">
                                        <i class="fas fa-cogs"></i> Panel Admin
                                    </a>
                                </li>
                            <?php endif; ?>

                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger"
                                   href="<?= $isAdminPath ? '../uploads/logout.php' : 'logout.php'; ?>">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark"
                           href="<?= $isAdminPath ? '../uploads/login.php' : 'login.php'; ?>">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<!-- SEARCH SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('searchToggle');
    const form = document.getElementById('searchForm');
    const input = document.getElementById('searchInput');

    toggle.addEventListener('click', function (e) {
        e.preventDefault();
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
        input.focus();
    });

    document.addEventListener('click', function (e) {
        if (!toggle.contains(e.target) && !form.contains(e.target)) {
            form.style.display = 'none';
        }
    });
});
</script>
