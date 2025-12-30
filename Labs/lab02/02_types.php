<?php
// 02_types.php - Kiểu dữ liệu + kiểm tra kiểu
$a = 10; $b = 3.14; $c = "Hello PHP"; $d = true; $e = null;
$s1 = "10"; $s2 = 10;
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><title>02 - Types</title></head><body>
<h2>02 - Kiểu dữ liệu & kiểm tra kiểu</h2>

<h3>1) var_dump()</h3>
<pre><?php var_dump($a,$b,$c,$d,$e); ?></pre>

<h3>2) gettype() và is_*</h3>
<p>gettype($b) = <?php echo gettype($b); ?></p>
<p>is_int($a) = <?php echo is_int($a) ? "true":"false"; ?></p>
<p>is_string($c) = <?php echo is_string($c) ? "true":"false"; ?></p>

<h3>3) So sánh == và ===</h3>
<p>"10" == 10 : <?php echo ($s1 == $s2) ? "true":"false"; ?></p>
<p>"10" === 10 : <?php echo ($s1 === $s2) ? "true":"false"; ?></p>

<h3>4) isset() và empty()</h3>
<p>isset($x) (chưa khai báo) = <?php echo isset($x) ? "true":"false"; ?></p>
<?php $y=""; $z=0; ?>
<p>empty($y) với $y="" : <?php echo empty($y) ? "true":"false"; ?></p>
<p>empty($z) với $z=0 : <?php echo empty($z) ? "true":"false"; ?></p>

<p><a href="index.php">← Về menu</a></p>
</body></html>
