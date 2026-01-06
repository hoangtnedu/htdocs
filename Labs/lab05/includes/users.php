<?php
// Danh sách user demo: mật khẩu đã hash bằng password_hash (PASSWORD_DEFAULT).
// KHÔNG lưu mật khẩu dạng rõ trong code.

function get_users(): array {
    return [
        'admin' => [
            'username' => 'admin',
            'password_hash' => '$2y$10$hJ3kj/WXGmAdpP.a7jvfM.h5nlRtxYJXoMGLvmSs3QFOnYIXgJOCO',
            'role' => 'admin',
            'full_name' => 'Administrator',
        ],
        'student' => [
            'username' => 'student',
            'password_hash' => '$2y$10$mi9no6entT8SLyqir5RIPuMKH1dBIW2J2MIUcKry4P6zIVg6Z2NG.',
            'role' => 'user',
            'full_name' => 'Student Demo',
        ],
        'user' => [
            'username' => 'user',
            'password_hash' => '$2y$10$kpSnOK5O4U7b/SLeBDAJOuRsTcLpm1bwHyi3aOBMng0YfWGQMsobG',
            'role' => 'user',
            'full_name' => 'User Demo',
        ],
    ];
}
