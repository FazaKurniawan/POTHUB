<?php
include '../includes/functions.php';
protectAdminPage();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: dashboard.php');
    exit;
}


if (deletePlant($id)) {
    header('Location: dashboard.php?message=deleted');
    exit;
} else {
    header('Location: dashboard.php?error=delete_failed');
    exit;
}
?>