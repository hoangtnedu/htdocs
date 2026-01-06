<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$products = [
  ['id' => 101, 'name' => 'Electric Kettle (Auto Shutoff)', 'price' => 39.99],
  ['id' => 102, 'name' => 'Blender (Easy Grip)', 'price' => 59.50],
  ['id' => 103, 'name' => 'Air Fryer (Simple Dial)', 'price' => 89.00],
  ['id' => 104, 'name' => 'Rice Cooker (One Touch)', 'price' => 45.00],
  ['id' => 105, 'name' => 'Microwave (Large Buttons)', 'price' => 119.00],
];

require_once __DIR__ . '/includes/header.php';
?>
<div class="card">
  <h1>Products</h1>
  <p><small class="muted">Danh sách sản phẩm demo (không dùng DB). Nhấn Add để thêm vào giỏ (session).</small></p>

  <table class="table">
    <thead>
      <tr>
        <th>ID</th><th>Tên</th><th>Giá</th><th></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $p): ?>
      <tr>
        <td><?= (int)$p['id'] ?></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td>$<?= number_format((float)$p['price'], 2) ?></td>
        <td><a class="btn" href="add_to_cart.php?id=<?= (int)$p['id'] ?>">Add</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <a class="btn secondary" href="cart.php">Go to Cart</a>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
