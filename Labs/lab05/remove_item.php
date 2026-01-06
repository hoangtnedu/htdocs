<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

ensure_session_started();

$id = (int)($_GET['id'] ?? 0);
if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
    set_flash('info', 'Đã xóa sản phẩm khỏi giỏ.');
} else {
    set_flash('error', 'Sản phẩm không có trong giỏ.');
}

header('Location: cart.php');
exit;
