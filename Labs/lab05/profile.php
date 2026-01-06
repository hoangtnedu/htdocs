<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$user = current_user();

require_once __DIR__ . '/includes/header.php';
?>
<div class="card">
  <h1>Profile</h1>
  <table class="table">
    <tr><th>Username</th><td><?= htmlspecialchars($user['username']) ?></td></tr>
    <tr><th>Full name</th><td><?= htmlspecialchars($user['full_name']) ?></td></tr>
    <tr><th>Role</th><td><?= htmlspecialchars($user['role']) ?></td></tr>
  </table>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
