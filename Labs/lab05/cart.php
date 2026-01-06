<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/products_data.php';
require_login();

ensure_session_started();
$cart = $_SESSION['cart'] ?? [];
$products = products_map();

$items = [];
$total = 0.0;

foreach ($cart as $id => $qty) {
    $id = (int)$id;
    $qty = (int)$qty;
    if ($qty <= 0) continue;
    if (!isset($products[$id])) continue;

    $p = $products[$id];
    $line = $p['price'] * $qty;
    $total += $line;

    $items[] = [
        'id' => $id,
        'name' => $p['name'],
        'price' => $p['price'],
        'qty' => $qty,
        'line' => $line
    ];
}

require_once __DIR__ . '/includes/header.php';
?>
<div class="card">
  <h1>Cart</h1>

  <?php if (empty($items)): ?>
    <p>Giỏ hàng đang trống. <a href="products.php">Thêm sản phẩm</a></p>
  <?php else: ?>

    <form method="post" action="update_cart.php">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th><th>Sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Thành tiền</th><th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $it): ?>
            <tr>
              <td><?= (int)$it['id'] ?></td>
              <td><?= htmlspecialchars($it['name']) ?></td>
              <td>$<?= number_format((float)$it['price'], 2) ?></td>
              <td style="max-width:160px;">
                <input type="number" min="0" name="qty[<?= (int)$it['id'] ?>]" value="<?= (int)$it['qty'] ?>">
                <small class="muted">0 = xóa</small>
              </td>
              <td>$<?= number_format((float)$it['line'], 2) ?></td>
              <td><a class="btn danger" href="remove_item.php?id=<?= (int)$it['id'] ?>">Remove</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <p><strong>Tổng:</strong> $<?= number_format((float)$total, 2) ?></p>

      <button type="submit">Update cart</button>
      <a class="btn secondary" href="products.php">Add more</a>
      <a class="btn danger" href="clear_cart.php">Clear cart</a>
    </form>
  <?php endif; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
