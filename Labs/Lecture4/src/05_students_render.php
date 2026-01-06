<?php
// 05_students_render.php
// 2.14 (OOP) — Mảng đối tượng Student + render bảng

require_once __DIR__ . "/oop/Student.php";

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }

$list = [
  new Student("SV001", "An", 3.3),
  new Student("SV002", "Bình", 2.7),
  new Student("SV003", "Chi", 2.2),
  new Student("SV004", "Dũng", 3.8),
];

$avg = array_sum(array_map(fn($st) => $st->getGpa(), $list)) / count($list);

$counts = ["Giỏi" => 0, "Khá" => 0, "Trung bình" => 0];
foreach ($list as $st) $counts[$st->rank()]++;
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Lecture4 - Student OOP</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 18px; }
    table { border-collapse: collapse; width: 860px; max-width: 100%; }
    th, td { border: 1px solid #ddd; padding: 10px 12px; }
    th { background: #f5f7fb; text-align: left; }
    .note { margin-top: 14px; padding: 10px 12px; border:1px solid #eee; border-radius: 10px; max-width: 860px; }
    code { background:#f4f4f4; padding:2px 6px; border-radius:4px; }
  </style>
</head>
<body>
  <h2>Buổi 4 — 2.14 (OOP): Student + Render</h2>

  <table>
    <thead>
      <tr><th>STT</th><th>ID</th><th>Name</th><th>GPA</th><th>Rank</th></tr>
    </thead>
    <tbody>
      <?php foreach ($list as $i => $st): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= h($st->getId()) ?></td>
          <td><?= h($st->getName()) ?></td>
          <td><?= number_format($st->getGpa(), 2) ?></td>
          <td><?= h($st->rank()) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="note">
    <p>GPA trung bình lớp: <code><?= number_format($avg, 2) ?></code></p>
    <p>Thống kê xếp loại:</p>
    <ul>
      <li>Giỏi: <?= $counts["Giỏi"] ?></li>
      <li>Khá: <?= $counts["Khá"] ?></li>
      <li>Trung bình: <?= $counts["Trung bình"] ?></li>
    </ul>
  </div>
</body>
</html>
