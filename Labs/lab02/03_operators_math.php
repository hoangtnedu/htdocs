<?php
// 03_operators_math.php - Phép toán số học + printf/number_format
$a=7; $b=3;
$add=$a+$b; $sub=$a-$b; $mul=$a*$b; $div=$a/$b; $mod=$a%$b; $pow=$a**$b;
$price = 1250000.5;
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><title>03 - Operators</title></head><body>
<h2>03 - Phép toán số học</h2>
<ul>
<li><?php echo "$a + $b = $add"; ?></li>
<li><?php echo "$a - $b = $sub"; ?></li>
<li><?php echo "$a * $b = $mul"; ?></li>
<li><?php echo "$a / $b = $div"; ?></li>
<li><?php echo "$a % $b = $mod"; ?></li>
<li><?php echo "$a ** $b = $pow"; ?></li>
</ul>

<h3>printf() định dạng</h3>
<?php
printf("<p>Chia (2 chữ số thập phân): %.2f</p>", $div);
printf("<p>Giá: %s VND</p>", number_format($price, 0, ",", "."));
?>
<p><a href="index.php">← Về menu</a></p>
</body></html>
