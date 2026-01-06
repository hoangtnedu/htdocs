<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/csrf.php';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

$errors = [];
$username = $_COOKIE['remember_username'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedToken = $_POST['csrf'] ?? null;
    if (!csrf_validate($postedToken)) {
        $errors[] = 'CSRF token không hợp lệ. Vui lòng thử lại.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $remember = isset($_POST['remember']);

        if ($username === '' || $password === '') {
            $errors[] = 'Vui lòng nhập đầy đủ username và password.';
        } else {
            if (attempt_login($username, $password)) {
                set_flash('success', 'Đăng nhập thành công!');
                // Remember username (tối thiểu)
                if ($remember) {
                    remember_username_cookie_set($username);

                    // Remember token (nâng cấp – auto login)
                    $token = bin2hex(random_bytes(24));
                    save_remember_token($username, $token, 60*60*24*7);
                    remember_token_cookie_set($token);
                }
                header('Location: dashboard.php');
                exit;
            } else {
                $errors[] = 'Sai username hoặc password.';
            }
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="row">
  <div class="card">
    <h2>Đăng nhập</h2>

    <?php if (!empty($errors)): ?>
      <div class="alert error">
        <ul style="margin:0; padding-left:18px;">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post">
      <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">

      <label>Username</label>
      <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" placeholder="vd: admin">

      <label>Password</label>
      <input type="password" name="password" placeholder="vd: admin123">

      <label style="display:flex; gap:10px; align-items:center; font-weight: normal;">
        <input type="checkbox" name="remember" value="1">
        Remember me (lưu username + token 7 ngày)
      </label>

      <button type="submit">Login</button>
    </form>

    <p><small class="muted">
      Demo accounts: <span class="kbd">admin/admin123</span>, <span class="kbd">student/student123</span>, <span class="kbd">user/user123</span>
    </small></p>
  </div>

  <div class="card">
    <h2>Gợi ý cho sinh viên</h2>
    <ul style="margin:0; padding-left:18px;">
      <li>Đăng nhập sai phải báo lỗi (không crash)</li>
      <li>Trang Dashboard phải được bảo vệ bằng session</li>
      <li>Logout dùng POST + CSRF</li>
      <li>Remember me: không lưu password trong cookie</li>
      <li>Giỏ hàng lưu bằng session</li>
    </ul>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
