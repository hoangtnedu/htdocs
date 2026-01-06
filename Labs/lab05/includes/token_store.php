<?php
// Lưu token vào file JSON để demo remember-me (không dùng DB).
// File: data/tokens.json  (mảng các record)

function tokens_path(): string {
    return dirname(__DIR__) . '/data/tokens.json';
}

function read_tokens(): array {
    $path = tokens_path();
    if (!file_exists($path)) return [];
    $json = file_get_contents($path);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

function write_tokens(array $tokens): void {
    $path = tokens_path();
    $dir = dirname($path);
    if (!is_dir($dir)) mkdir($dir, 0777, true);

    $fp = fopen($path, 'c+');
    if ($fp === false) return;

    // lock để tránh ghi đè khi nhiều request
    flock($fp, LOCK_EX);
    ftruncate($fp, 0);
    fwrite($fp, json_encode($tokens, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
}

function purge_expired_tokens(array $tokens): array {
    $now = time();
    return array_values(array_filter($tokens, function($t) use ($now) {
        return isset($t['expires_at']) && $t['expires_at'] > $now;
    }));
}

function save_remember_token(string $username, string $token, int $ttl_seconds = 604800): void {
    $tokens = purge_expired_tokens(read_tokens());
    $tokens[] = [
        'username' => $username,
        // lưu hash của token, không lưu token thô
        'token_hash' => hash('sha256', $token),
        'expires_at' => time() + $ttl_seconds,
    ];
    write_tokens($tokens);
}

function find_username_by_token(string $token): ?string {
    $tokens = purge_expired_tokens(read_tokens());
    $needle = hash('sha256', $token);
    foreach ($tokens as $t) {
        if (!empty($t['token_hash']) && hash_equals($t['token_hash'], $needle)) {
            return $t['username'] ?? null;
        }
    }
    // đồng thời dọn rác
    write_tokens($tokens);
    return null;
}

function delete_tokens_for_user(string $username): void {
    $tokens = purge_expired_tokens(read_tokens());
    $tokens = array_values(array_filter($tokens, fn($t) => ($t['username'] ?? '') !== $username));
    write_tokens($tokens);
}
