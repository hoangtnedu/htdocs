<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/users.php';
require_once __DIR__ . '/flash.php';
require_once __DIR__ . '/token_store.php';

function current_user(): ?array {
    ensure_session_started();
    return $_SESSION['user'] ?? null;
}

function is_logged_in(): bool {
    ensure_session_started();
    return !empty($_SESSION['auth']) && !empty($_SESSION['user']);
}

function login_user(array $user): void {
    ensure_session_started();
    // Chống session fixation
    session_regenerate_id(true);
    $_SESSION['auth'] = true;
    $_SESSION['user'] = [
        'username' => $user['username'],
        'role' => $user['role'] ?? 'user',
        'full_name' => $user['full_name'] ?? $user['username'],
    ];
}

function attempt_login(string $username, string $password): bool {
    $users = get_users();
    if (!isset($users[$username])) return false;
    $user = $users[$username];
    if (!password_verify($password, $user['password_hash'])) return false;
    login_user($user);
    return true;
}

function remember_username_cookie_set(string $username): void {
    setcookie('remember_username', $username, [
        'expires' => time() + 60*60*24*7,
        'path' => '/',
        'httponly' => false,
        'samesite' => 'Lax',
    ]);
}

function remember_token_cookie_set(string $token): void {
    setcookie('remember_token', $token, [
        'expires' => time() + 60*60*24*7,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

function clear_remember_cookies(): void {
    setcookie('remember_username', '', time() - 3600, '/');
    setcookie('remember_token', '', time() - 3600, '/');
}

function try_auto_login_from_cookie(): void {
    if (is_logged_in()) return;

    $token = $_COOKIE['remember_token'] ?? null;
    if (!$token) return;

    $username = find_username_by_token($token);
    if (!$username) return;

    $users = get_users();
    if (!isset($users[$username])) return;

    login_user($users[$username]);
}

function require_login(): void {
    ensure_session_started();
    try_auto_login_from_cookie();

    if (!is_logged_in()) {
        set_flash('error', 'Bạn cần đăng nhập để truy cập trang này.');
        header('Location: login.php');
        exit;
    }
}
