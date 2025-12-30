<?php
// /c:/xampp/htdocs/Labs/Lab01/hello.php
$person = [
    'name' => 'Trần Nguyên Hoàng',
    'title' => 'Lập trình viên PHP',
    'email' => 'hoangtn@eaut.edu.vn',
    'phone' => '+84 912 345 678',
    'dob' => '1995-07-15',
    'address' => 'Hà Nội, Việt Nam',
    'bio' => 'Đam mê xây dựng ứng dụng web sạch, hiệu quả và dễ bảo trì.',
    'skills' => [
        'PHP' => 90,
        'HTML/CSS' => 85,
        'JavaScript' => 75,
        'MySQL' => 80,
    ],
];

function ageFromDob($dob) {
    $dobObj = new DateTime($dob);
    $now = new DateTime();
    return $now->diff($dobObj)->y;
}

function initials($name) {
    $parts = preg_split('/\s+/', trim($name));
    $init = '';
    foreach ($parts as $p) $init .= mb_substr($p, 0, 1);
    return mb_strtoupper(mb_substr($init, 0, 2));
}

$age = ageFromDob($person['dob']);
$initials = initials($person['name']);
?>
<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Thông tin cá nhân - <?= htmlspecialchars($person['name']) ?></title>
<style>
    :root{--bg:#f4f7fb;--card:#fff;--accent:#2563eb;--muted:#6b7280}
    body{font-family:Inter,ui-sans-serif,system-ui,Segoe UI,Helvetica,Arial;background:var(--bg);margin:0;display:flex;align-items:center;justify-content:center;height:100vh}
    .card{background:var(--card);width:920px;max-width:95%;border-radius:12px;box-shadow:0 10px 30px rgba(20,30,60,.08);display:flex;overflow:hidden}
    .side{background:linear-gradient(180deg,var(--accent),#1e40af);color:#fff;padding:36px 28px;width:320px;flex-shrink:0}
    .avatar{width:96px;height:96px;border-radius:50%;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:28px;margin-bottom:18px}
    .name{font-size:20px;font-weight:700}
    .title{font-size:13px;opacity:.9;margin-top:6px}
    .muted{color:rgba(255,255,255,.85);font-size:14px;margin-top:14px}
    .content{padding:28px 36px;flex:1}
    .row{display:flex;gap:12px;align-items:center;margin-bottom:12px}
    .label{width:110px;color:var(--muted);font-size:13px}
    .value{font-weight:600}
    .bio{margin:8px 0 18px;color:#374151}
    .skills{margin-top:10px}
    .skill{margin-bottom:12px}
    .bar{height:10px;background:#e6eefc;border-radius:999px;overflow:hidden}
    .fill{height:100%;background:linear-gradient(90deg,var(--accent),#4f46e5);border-radius:999px}
    footer{margin-top:18px;color:var(--muted);font-size:13px}
    @media(max-width:720px){.card{flex-direction:column}.side{width:100%;display:flex;align-items:center;text-align:center}.content{padding:20px}}
</style>
</head>
<body>
<div class="card" role="region" aria-label="Thông tin cá nhân">
    <aside class="side">
        <div class="avatar" aria-hidden="true"><?= htmlspecialchars($initials) ?></div>
        <div class="name"><?= htmlspecialchars($person['name']) ?></div>
        <div class="title"><?= htmlspecialchars($person['title']) ?></div>
        <div class="muted">Tuổi: <?= $age ?> • <?= htmlspecialchars($person['address']) ?></div>
        <footer>Liên hệ: <?= htmlspecialchars($person['email']) ?> • <?= htmlspecialchars($person['phone']) ?></footer>
    </aside>
    <main class="content">
        <div class="row">
            <div class="label">Giới thiệu</div>
            <div class="value bio"><?= htmlspecialchars($person['bio']) ?></div>
        </div>

        <div class="row">
            <div class="label">Ngày sinh</div>
            <div class="value"><?= htmlspecialchars($person['dob']) ?></div>
        </div>

        <div class="row">
            <div class="label">Kỹ năng</div>
            <div class="value skills" style="width:100%">
                <?php foreach ($person['skills'] as $skill => $percent): ?>
                    <div class="skill" aria-label="<?= htmlspecialchars($skill) ?> <?= $percent ?>%">
                        <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:6px">
                            <strong><?= htmlspecialchars($skill) ?></strong><span style="color:var(--muted)"><?= $percent ?>%</span>
                        </div>
                        <div class="bar"><div class="fill" style="width:<?= intval($percent) ?>%"></div></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</div>
</body>
</html>