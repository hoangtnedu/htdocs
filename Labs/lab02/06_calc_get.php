<?php
// 06_calc_get.php - Máy tính GET
// URL mẫu: 06_calc_get.php?a=10&b=3&op=add   (op: add|sub|mul|div)
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }

$a = $_GET["a"] ?? null;
$b = $_GET["b"] ?? null;
$op= $_GET["op"] ?? null;

$error=""; $result=null;

if($a===null || $b===null || $op===null){
  $error="Thiếu tham số. Hãy dùng URL mẫu.";
}else{
  $aNum=(float)$a; $bNum=(float)$b;
  switch($op){
    case "add": $result=$aNum+$bNum; break;
    case "sub": $result=$aNum-$bNum; break;
    case "mul": $result=$aNum*$bNum; break;
    case "div":
      if($bNum==0) $error="Không thể chia cho 0.";
      else $result=$aNum/$bNum;
      break;
    default: $error="op không hợp lệ (add|sub|mul|div)";
  }
}
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><title>06 - Calculator GET</title></head><body>
<h2>06 - Máy tính 2 số (GET)</h2>
<?php if($error): ?>
  <p style="color:crimson;"><b>Lỗi:</b> <?php echo h($error); ?></p>
  <p>URL mẫu: <code>06_calc_get.php?a=10&b=3&op=add</code></p>
<?php else: ?>
  <p>a = <b><?php echo h($a); ?></b></p>
  <p>b = <b><?php echo h($b); ?></b></p>
  <p>op = <b><?php echo h($op); ?></b></p>
  <hr>
  <p>Kết quả: <b><?php echo $result; ?></b></p>
<?php endif; ?>
<p><a href="index.php">← Về menu</a></p>
</body></html>
