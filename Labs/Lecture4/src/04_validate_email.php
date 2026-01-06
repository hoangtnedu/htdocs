<?php
// 04_validate_email.php
// 2.12 (Chuỗi) — Validate email (GET)

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }

$email = $_GET["email"] ?? "";
$email = trim($email);

$errors = [];
if ($email === "") {
  $errors[] = "Email không được để trống.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Email không hợp lệ.";
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Lecture4 - Validate Email</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 18px; }
    input { width: 520px; max-width: 100%; padding: 8px; }
    button { padding: 8px 12px; }
    .ok { padding: 10px 12px; border: 1px solid #d7f1d7; background: #f3fff3; border-radius: 10px; max-width: 820px; }
    .err { padding: 10px 12px; border: 1px solid #ffd0d0; background: #fff5f5; border-radius: 10px; max-width: 820px; }
    code { background:#f4f4f4; padding:2px 6px; border-radius:4px; }
  </style>
</head>
<body>
  <h2>Buổi 4 — 2.12 (Chuỗi): Validate Email</h2>

  <form method="get">
    <label>Email:</label><br>
    <input name="email" value="<?= h($_GET["email"] ?? "test@gmail.com") ?>">
    <button type="submit">Check</button>
  </form>

  <div style="margin-top: 14px;">
    <?php if (count($errors) > 0): ?>
      <div class="err">
        <b>Lỗi:</b>
        <ul>
          <?php foreach ($errors as $e): ?>
            <li><?= h($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php else: ?>
      <div class="ok">
        ✅ Email hợp lệ: <code><?= h($email) ?></code>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
