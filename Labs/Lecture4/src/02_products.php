<?php
// 02_products.php
// 2.11 (Mảng) — Mảng nhiều chiều: products + render bảng + tổng + sort

$products = [
  ["name" => "Rice Cooker", "price" => 120, "qty" => 2],
  ["name" => "Electric Kettle", "price" => 45,  "qty" => 1],
  ["name" => "Blender", "price" => 80, "qty" => 3],
];

// Tính amount
$items = array_map(function($p) {
  $p["amount"] = $p["price"] * $p["qty"];
  return $p;
}, $products);

// Tổng tiền
$total = array_reduce($items, fn($sum, $p) => $sum + $p["amount"], 0);

// Amount lớn nhất
$maxItem = $items[0];
foreach ($items as $p) if ($p["amount"] > $maxItem["amount"]) $maxItem = $p;

// Sort theo price giảm dần
$sortedByPriceDesc = $items;
usort($sortedByPriceDesc, fn($a, $b) => $b["price"] <=> $a["price"]);

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Lecture4 - Products</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 18px; }
    table { border-collapse: collapse; width: 860px; max-width: 100%; }
    th, td { border: 1px solid #ddd; padding: 10px 12px; }
    th { background: #f5f7fb; text-align: left; }
    tfoot td { font-weight: bold; }
    .note { margin-top: 14px; padding: 10px 12px; border:1px solid #eee; border-radius: 10px; max-width: 860px; }
    code { background:#f4f4f4; padding:2px 6px; border-radius:4px; }
  </style>
</head>
<body>
  <h2>Buổi 4 — 2.11 (Mảng): Danh sách sản phẩm</h2>

  <table>
    <thead>
      <tr>
        <th>STT</th><th>Name</th><th>Price ($)</th><th>Qty</th><th>Amount ($)</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $i => $p): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= h($p["name"]) ?></td>
          <td><?= h($p["price"]) ?></td>
          <td><?= h($p["qty"]) ?></td>
          <td><?= h($p["amount"]) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4">Tổng tiền</td>
        <td><?= h($total) ?></td>
      </tr>
    </tfoot>
  </table>

  <div class="note">
    <p><b>Amount lớn nhất:</b> <code><?= h($maxItem["name"]) ?></code> (<?= h($maxItem["amount"]) ?>)</p>
    <p><b>Sort theo price giảm dần:</b></p>
    <ul>
      <?php foreach ($sortedByPriceDesc as $p): ?>
        <li><?= h($p["name"]) ?> — price: <?= h($p["price"]) ?> — qty: <?= h($p["qty"]) ?></li>
      <?php endforeach; ?>
    </ul>
    <p>Hàm dùng: <code>array_map</code>, <code>array_reduce</code>, <code>usort</code>.</p>
  </div>
</body>
</html>
