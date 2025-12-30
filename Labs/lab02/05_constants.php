<?php
// 05_constants.php - Hằng define/const + ví dụ
define("SITE_NAME","IT3220 PHP Lab");
const PI = 3.1415926535;
const VAT_RATE = 0.08;

$radius=7;
$area = PI*$radius*$radius;

$price=250000; // VND
$total = $price + ($price*VAT_RATE);
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><title>05 - Constants</title></head><body>
<h2>05 - Hằng (Constants)</h2>
<p><b>SITE_NAME:</b> <?php echo SITE_NAME; ?></p>
<p><b>PI:</b> <?php echo PI; ?></p>

<h3>Ví dụ 1: Diện tích hình tròn</h3>
<p>r = <?php echo $radius; ?></p>
<p>S = PI * r^2 = <?php echo $area; ?></p>

<h3>Ví dụ 2: Tính giá có VAT</h3>
<p>Giá gốc: <?php echo number_format($price,0,",","."); ?> VND</p>
<p>VAT: <?php echo (VAT_RATE*100); ?>%</p>
<p>Tổng: <?php echo number_format($total,0,",","."); ?> VND</p>

<p><a href="index.php">← Về menu</a></p>
</body></html>
