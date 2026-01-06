<?php
// 03_string_parse.php
// 2.12 (Chuỗi) — GET ?names=An,Binh,  Chi, ,Dung
// explode -> trim -> remove empty -> render

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }

$raw = $_GET["names"] ?? "";
$raw = trim($raw);

$names = [];
if ($raw !== "") {
  $parts = explode(",", $raw);
  $parts = array_map("trim", $parts);
  $names = array_values(array_filter($parts, fn($x) => $x !== ""));
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Lecture4 - String Parse</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 18px; }
    .box { border: 1px solid #ddd; padding: 12px 14px; border-radius: 10px; max-width: 820px; }
    input { width: 680px; max-width: 100%; padding: 8px; }
    button { padding: 8px 12px; }
    code { background:#f4f4f4; padding:2px 6px; border-radius:4px; }
  </style>
</head>
<body>
  <h2>Buổi 4 — 2.12 (Chuỗi): Tách danh sách tên</h2>

  <form method="get">
    <label>Nhập names (phân tách bằng dấu phẩy):</label><br>
    <input name="names" value="<?= h($_GET["names"] ?? "An, Binh,  Chi, ,Dung") ?>">
    <button type="submit">Parse</button>
  </form>

  <div class="box" style="margin-top: 14px;">
    <p>Chuỗi gốc: <code><?= h($raw) ?></code></p>
    <p>Số tên hợp lệ: <b><?= count($names) ?></b></p>

    <?php if (count($names) > 0): ?>
      <ol>
        <?php foreach ($names as $n): ?>
          <li><?= h($n) ?></li>
        <?php endforeach; ?>
      </ol>
    <?php else: ?>
      <p><i>Chưa có dữ liệu hợp lệ.</i></p>
    <?php endif; ?>
  </div>

  <p>Hàm dùng: <code>trim</code>, <code>explode</code>, <code>array_map</code>, <code>array_filter</code>.</p>
</body>
</html>
