<?php
require_once __DIR__ . '/session.php';

function csrf_token(): string {
    ensure_session_started();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf'];
}

function csrf_validate(?string $token): bool {
    ensure_session_started();
    if (empty($_SESSION['csrf']) || empty($token)) return false;
    return hash_equals($_SESSION['csrf'], $token);
}
