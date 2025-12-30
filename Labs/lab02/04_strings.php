<?php
// 04_strings.php - Nối chuỗi + nháy đơn/kép
$name="Minh";
$g1 = "Xin chào $name"; // nháy kép: có nội suy
$g2 = 'Xin chào $name'; // nháy đơn: không nội suy
$msg = "Hôm nay học PHP";
$msg .= " - Buổi 2";
$msg .= " (Biến, kiểu dữ liệu, phép toán)";
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><title>04 - Strings</title></head><body>
<h2>04 - Chuỗi trong PHP</h2>
<p><b>Nháy kép:</b> <?php echo $g1; ?></p>
<p><b>Nháy đơn:</b> <?php echo $g2; ?></p>
<h3>Nối chuỗi và gán nối (.=)</h3>
<p><?php echo $msg; ?></p>
<h3>Tạo HTML bằng chuỗi</h3>
<?php
$html="<ul>";
$html.="<li>echo/print</li>";
$html.="<li>var_dump</li>";
$html.="<li>toán tử .</li>";
$html.="</ul>";
echo $html;
?>
<p><a href="index.php">← Về menu</a></p>
</body></html>
