<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/products_data.php';
require_login();

ensure_session_started();

$id = (int)($_GET['id'] ?? 0);
$products = products_map();

if (!isset($products[$id])) {
    set_flash('error', 'Sản phẩm không tồn tại.');
    header('Location: products.php');
    exit;
}

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (!isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id] = 0;

$_SESSION['cart'][$id] += 1;

set_flash('success', 'Đã thêm vào giỏ hàng.');
header('Location: cart.php');
exit;
