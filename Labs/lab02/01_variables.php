<?php
// 01_variables.php - Biến + echo/print + var_dump
$name = "Nguyễn Văn A";
$yearOfBirth = 2004;
$currentYear = (int)date("Y");
$age = $currentYear - $yearOfBirth;

$school = "EAUT";
$course = "IT3220 - Lập trình web với PHP";
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><title>01 - Variables</title></head><body>
<h2>01 - Biến trong PHP</h2>
<?php
echo "<p><b>Họ tên:</b> $name</p>";
echo "<p><b>Năm sinh:</b> $yearOfBirth</p>";
echo "<p><b>Tuổi (ước tính):</b> $age</p>";
echo "<p><b>Học phần:</b> " . $course . "</p>";
print "<p><b>Trường:</b> " . $school . "</p>";
echo "<hr><h3>Debug (var_dump)</h3>";
var_dump($name); echo "<br>"; var_dump($age);
?>
<p><a href="index.php">← Về menu</a></p>
</body></html>
