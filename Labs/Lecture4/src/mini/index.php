<?php
// src/mini/index.php
// 2.15 (Thực hành) — Student Manager Mini
// POST: nhập chuỗi "SV001-An-3.2;SV002-Binh-2.6;SV003-Chi-3.5"
// Parse -> Student[] -> render + filter + sort + thống kê

require_once __DIR__ . "/../oop/Student.php";

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }

function parseStudentsFromString(string $raw): array {
  $raw = trim($raw);
  if ($raw === "") return [];

  $records = explode(";", $raw);
  $students = [];

  foreach ($records as $rec) {
    $rec = trim($rec);
    if ($rec === "") continue;

    $parts = explode("-", $rec);
    if (count($parts) !== 3) continue;

    $id = trim($parts[0]);
    $name = trim($parts[1]);
    $gpaStr = trim($parts[2]);

    if ($id === "" || $name === "") continue;
    if (!is_numeric($gpaStr)) continue;

    $students[] = new Student($id, $name, (float)$gpaStr);
  }
  return $students;
}

function classStats(array $list): array {
  if (count($list) === 0) {
    return ["avg" => 0, "max" => null, "min" => null, "counts" => ["Giỏi"=>0,"Khá"=>0,"Trung bình"=>0]];
  }

  $gpas = array_map(fn($st) => $st->getGpa(), $list);
  $avg = array_sum($gpas) / count($gpas);

  $counts = ["Giỏi" => 0, "Khá" => 0, "Trung bình" => 0];
  foreach ($list as $st) $counts[$st->rank()]++;

  return ["avg" => $avg, "max" => max($gpas), "min" => min($gpas), "counts" => $counts];
}

$defaultRaw = "SV001-An-3.2;SV002-Binh-2.6;SV003-Chi-3.5;SV004-Dung-3.8";
$raw = $_POST["raw"] ?? $defaultRaw;

$threshold = $_POST["threshold"] ?? "";
$thresholdVal = (trim($threshold) !== "" && is_numeric($threshold)) ? (float)$threshold : null;

$doSortDesc = isset($_POST["sort_desc"]);

$list = parseStudentsFromString($raw);
$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST" && count($list) === 0) {
  $errors[] = "Không parse được dữ liệu. Kiểm tra định dạng: SV001-An-3.2;SV002-Binh-2.6";
}

if ($thresholdVal !== null) {
  $list = array_values(array_filter($list, fn($st) => $st->getGpa() >= $thresholdVal));
}

if ($doSortDesc) {
  usort($list, fn($a, $b) => $b->getGpa() <=> $a->getGpa());
}

$stats = classStats($list);
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Lecture4 - Student Manager Mini</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 18px; }
    textarea { width: 980px; max-width: 100%; height: 90px; padding: 10px; }
    input[type="text"] { padding: 8px; width: 220px; }
    button { padding: 9px 14px; }
    table { border-collapse: collapse; width: 980px; max-width: 100%; margin-top: 14px; }
    th, td { border: 1px solid #ddd; padding: 10px 12px; }
    th { background: #f5f7fb; text-align: left; }
    .row { margin: 10px 0; }
    .err { padding: 10px 12px; border: 1px solid #ffd0d0; background: #fff5f5; border-radius: 10px; max-width: 980px; }
    .box { padding: 10px 12px; border: 1px solid #eee; border-radius: 10px; max-width: 980px; margin-top: 12px; }
    code { background:#f4f4f4; padding:2px 6px; border-radius:4px; }
    label { display: inline-block; min-width: 220px; }
  </style>
</head>
<body>
  <h2>Buổi 4 — 2.15 (Thực hành): Student Manager Mini</h2>

  <form method="post">
    <div class="row">
      <label>Chuỗi dữ liệu sinh viên:</label><br>
      <textarea name="raw"><?= h($raw) ?></textarea>
      <div><small>Định dạng: <code>SV001-An-3.2;SV002-Binh-2.6;SV003-Chi-3.5</code></small></div>
    </div>

    <div class="row">
      <label>Lọc GPA >= (để trống nếu không lọc):</label>
      <input type="text" name="threshold" value="<?= h($threshold) ?>">
    </div>

    <div class="row">
      <label>Sắp xếp GPA giảm dần:</label>
      <input type="checkbox" name="sort_desc" <?= $doSortDesc ? "checked" : "" ?>>
    </div>

    <button type="submit">Parse & Show</button>
  </form>

  <?php if (count($errors) > 0): ?>
    <div class="err" style="margin-top: 12px;">
      <b>Lỗi:</b>
      <ul>
        <?php foreach ($errors as $e): ?>
          <li><?= h($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <div class="box">
    <p><b>Số sinh viên:</b> <?= count($list) ?></p>
    <p>
      <b>AVG:</b> <code><?= number_format($stats["avg"], 2) ?></code>
      &nbsp;|&nbsp; <b>Max:</b> <code><?= $stats["max"] !== null ? number_format($stats["max"], 2) : "-" ?></code>
      &nbsp;|&nbsp; <b>Min:</b> <code><?= $stats["min"] !== null ? number_format($stats["min"], 2) : "-" ?></code>
    </p>
    <p><b>Rank:</b>
      Giỏi: <?= $stats["counts"]["Giỏi"] ?> —
      Khá: <?= $stats["counts"]["Khá"] ?> —
      Trung bình: <?= $stats["counts"]["Trung bình"] ?>
    </p>
  </div>

  <table>
    <thead>
      <tr><th>STT</th><th>ID</th><th>Name</th><th>GPA</th><th>Rank</th></tr>
    </thead>
    <tbody>
      <?php if (count($list) === 0): ?>
        <tr><td colspan="5"><i>Không có dữ liệu để hiển thị.</i></td></tr>
      <?php else: ?>
        <?php foreach ($list as $i => $st): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= h($st->getId()) ?></td>
            <td><?= h($st->getName()) ?></td>
            <td><?= number_format($st->getGpa(), 2) ?></td>
            <td><?= h($st->rank()) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
