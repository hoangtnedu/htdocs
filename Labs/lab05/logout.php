<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/csrf.php';

ensure_session_started();
try_auto_login_from_cookie();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    set_flash('error', 'Logout phải dùng POST.');
    header('Location: dashboard.php');
    exit;
}

$token = $_POST['csrf'] ?? null;
if (!csrf_validate($token)) {
    set_flash('error', 'CSRF token không hợp lệ. Không thể logout.');
    header('Location: dashboard.php');
    exit;
}

$user = current_user();
if ($user) {
    delete_tokens_for_user($user['username']);
}

// Xóa session
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Xóa cookie remember
clear_remember_cookies();

set_flash('info', 'Bạn đã đăng xuất.');
header('Location: login.php');
exit;
