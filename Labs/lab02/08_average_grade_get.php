<?php
// 08_average_grade_get.php - Tính điểm trung bình GET
// URL mẫu: 08_average_grade_get.php?s1=7.5&s2=8&s3=6.5
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }

$s1=$_GET["s1"]??null; $s2=$_GET["s2"]??null; $s3=$_GET["s3"]??null;
$error=""; $avg=null;

if($s1===null || $s2===null || $s3===null){
  $error="Thiếu tham số. Hãy dùng URL mẫu.";
}else{
  $n1=(float)$s1; $n2=(float)$s2; $n3=(float)$s3;
  foreach([$n1,$n2,$n3] as $v){
    if($v<0 || $v>10){ $error="Điểm phải nằm trong [0..10]."; break; }
  }
  if(!$error) $avg=($n1+$n2+$n3)/3;
}
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><title>08 - Average Grade GET</title></head><body>
<h2>08 - Tính điểm trung bình (GET)</h2>
<?php if($error): ?>
  <p style="color:crimson;"><b>Lỗi:</b> <?php echo h($error); ?></p>
  <p>URL mẫu: <code>08_average_grade_get.php?s1=7.5&s2=8&s3=6.5</code></p>
<?php else: ?>
  <p>s1 = <b><?php echo h($s1); ?></b></p>
  <p>s2 = <b><?php echo h($s2); ?></b></p>
  <p>s3 = <b><?php echo h($s3); ?></b></p>
  <hr>
  <p><b>Điểm trung bình:</b> <?php printf("%.2f",$avg); ?></p>
<?php endif; ?>
<p><a href="index.php">← Về menu</a></p>
</body></html>
