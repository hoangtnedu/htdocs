<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/flash.php';
$flash = get_flash();
$user = current_user();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lab05 - Session & Cookie</title>
  <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
  <div class="container">
    <div class="card" style="margin-bottom:14px;">
      <nav>
        <a href="index.php"><strong>Lab05</strong></a>
        <?php if ($user): ?>
          <a href="dashboard.php">Dashboard</a>
          <a href="profile.php">Profile</a>
          <a href="products.php">Products</a>
          <a href="cart.php">Cart</a>
          <form action="logout.php" method="post" style="margin:0;">
            <?php require_once __DIR__ . '/csrf.php'; ?>
            <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
            <button class="danger" type="submit">Logout</button>
          </form>
          <span style="margin-left:auto;">
            <small class="muted">Xin chào, <strong><?= htmlspecialchars($user['full_name']) ?></strong> (<?= htmlspecialchars($user['role']) ?>)</small>
          </span>
        <?php else: ?>
          <a href="login.php">Login</a>
          <span style="margin-left:auto;"><small class="muted">Chưa đăng nhập</small></span>
        <?php endif; ?>
      </nav>
    </div>

    <?php if ($flash): ?>
      <div class="alert <?= htmlspecialchars($flash['type']) ?>">
        <?= htmlspecialchars($flash['message']) ?>
      </div>
    <?php endif; ?>
