<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

require_once __DIR__ . '/includes/header.php';
$user = current_user();
?>
<div class="card">
  <h1>Dashboard</h1>
  <p>Chào <strong><?= htmlspecialchars($user['full_name']) ?></strong>!</p>
  <p>Vai trò: <strong><?= htmlspecialchars($user['role']) ?></strong></p>

  <div class="row" style="margin-top:12px;">
    <div class="card">
      <h3>Bài 3 – Remember me</h3>
      <p><small class="muted">
        Nếu bạn tick Remember me khi đăng nhập:
        <br>- Cookie <span class="kbd">remember_username</span> giúp tự điền username.
        <br>- Cookie <span class="kbd">remember_token</span> giúp auto-login (dữ liệu lưu ở <span class="kbd">data/tokens.json</span>).
      </small></p>
      <a class="btn" href="login.php">Xem lại trang Login</a>
    </div>
    <div class="card">
      <h3>Bài 5 – Cart</h3>
      <p><small class="muted">Đi tới Products để thêm sản phẩm vào giỏ, rồi xem Cart để update/remove/clear.</small></p>
      <a class="btn" href="products.php">Products</a>
      <a class="btn secondary" href="cart.php">Cart</a>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
