<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

ensure_session_started();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    set_flash('error', 'Update cart phải dùng POST.');
    header('Location: cart.php');
    exit;
}

$qtyMap = $_POST['qty'] ?? [];
if (!is_array($qtyMap)) $qtyMap = [];

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

foreach ($qtyMap as $id => $qty) {
    $id = (int)$id;
    $qty = (int)$qty;

    if ($qty <= 0) {
        unset($_SESSION['cart'][$id]);
    } else {
        $_SESSION['cart'][$id] = $qty;
    }
}

set_flash('success', 'Đã cập nhật giỏ hàng.');
header('Location: cart.php');
exit;
