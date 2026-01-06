<?php
function ensure_session_started(): void {
    if (session_status() === PHP_SESSION_NONE) {
        // Bảo mật session cơ bản
        ini_set('session.use_strict_mode', '1');
        ini_set('session.cookie_httponly', '1');
        // Nếu chạy HTTPS có thể bật secure:
        // ini_set('session.cookie_secure', '1');
        session_start();
    }
}
