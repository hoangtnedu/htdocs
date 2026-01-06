<?php
// 01_arrays_demo.php
// 2.11 (Mảng) — Demo: mảng điểm + thống kê (avg, filter, max/min, sort)

$scores = [8.5, 7.0, 9.25, 6.5, 8.0];

// Tính trung bình
$avg = array_sum($scores) / count($scores);

// Lọc điểm >= 8
$high = array_filter($scores, fn($x) => $x >= 8.0);

// Max / Min
$max = max($scores);
$min = min($scores);

// Sort tăng/giảm (copy để không làm mất dữ liệu gốc)
$sortedAsc = $scores;  sort($sortedAsc);
$sortedDesc = $scores; rsort($sortedDesc);
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Lecture4 - Demo Mảng</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 18px; }
    code { background:#f4f4f4; padding:2px 6px; border-radius:4px; }
    ul { line-height: 1.8; }
    .box { border:1px solid #ddd; padding:12px 14px; border-radius:10px; max-width: 820px; }
  </style>
</head>
<body>
  <h2>Buổi 4 — 2.11 (Mảng): Demo mảng điểm</h2>

  <div class="box">
    <ul>
      <li>Mảng điểm: <code><?= htmlspecialchars(json_encode($scores, JSON_UNESCAPED_UNICODE)) ?></code></li>
      <li>AVG: <code><?= number_format($avg, 2) ?></code></li>
      <li>Số điểm &ge; 8: <code><?= count($high) ?></code>
          (<?= htmlspecialchars(json_encode(array_values($high))) ?>)</li>
      <li>Max: <code><?= $max ?></code> — Min: <code><?= $min ?></code></li>
      <li>Tăng dần: <code><?= htmlspecialchars(json_encode($sortedAsc)) ?></code></li>
      <li>Giảm dần: <code><?= htmlspecialchars(json_encode($sortedDesc)) ?></code></li>
    </ul>
  </div>

  <p>Hàm dùng: <code>array_sum</code>, <code>count</code>, <code>array_filter</code>, <code>sort</code>, <code>rsort</code>.</p>
</body>
</html>
