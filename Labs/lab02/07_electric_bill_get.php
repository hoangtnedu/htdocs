<?php
// 07_electric_bill_get.php - Tính tiền điện GET (3 bậc minh họa)
// URL mẫu: 07_electric_bill_get.php?kwh=120
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }

$kwhRaw = $_GET["kwh"] ?? null;
$error=""; $kwh=null;

$rate1=1500; $rate2=2000; $rate3=2500;
$cost1=$cost2=$cost3=0; $total=0;

if($kwhRaw===null){
  $error="Thiếu tham số kwh. Hãy dùng URL mẫu.";
}else{
  $kwh=(float)$kwhRaw;
  if($kwh<0) $error="kwh phải >= 0.";
  else{
    $b1=min($kwh,50);
    $b2=min(max($kwh-50,0),50);
    $b3=max($kwh-100,0);

    $cost1=$b1*$rate1;
    $cost2=$b2*$rate2;
    $cost3=$b3*$rate3;
    $total=$cost1+$cost2+$cost3;
  }
}
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><title>07 - Electric Bill GET</title></head><body>
<h2>07 - Tính tiền điện (GET)</h2>
<?php if($error): ?>
  <p style="color:crimson;"><b>Lỗi:</b> <?php echo h($error); ?></p>
  <p>URL mẫu: <code>07_electric_bill_get.php?kwh=120</code></p>
<?php else: ?>
  <p>Số điện tiêu thụ: <b><?php echo h($kwh); ?></b> kWh</p>
  <h3>Chi tiết theo bậc</h3>
  <ul>
    <li>Bậc 1 (0–50): <?php echo number_format($cost1,0,",","."); ?> VND</li>
    <li>Bậc 2 (51–100): <?php echo number_format($cost2,0,",","."); ?> VND</li>
    <li>Bậc 3 (>100): <?php echo number_format($cost3,0,",","."); ?> VND</li>
  </ul>
  <hr>
  <p><b>Tổng tiền:</b> <?php echo number_format($total,0,",","."); ?> VND</p>
<?php endif; ?>
<p><a href="index.php">← Về menu</a></p>
</body></html>
