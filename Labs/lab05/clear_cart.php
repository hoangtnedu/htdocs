<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

ensure_session_started();
unset($_SESSION['cart']);

set_flash('info', 'Đã xóa toàn bộ giỏ hàng.');
header('Location: cart.php');
exit;
