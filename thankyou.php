<?php
session_start();

// Дані із сесії (встановлені в post.php)
$user_size    = $_SESSION['user_size'] ?? 'Не вказано';
$product_name = $_SESSION['product_name'] ?? 'Товар';
$phone        = $_SESSION['phone'] ?? '';

// 🔹 Очищаємо телефон
$clean_phone = preg_replace('/[^0-9]/', '', $phone);

// 🔹 Якщо номер у форматі 0671234567 → перетворюємо в 380671234567
if (preg_match('/^0\d{9}$/', $clean_phone)) {
    $clean_phone = '38' . $clean_phone;
}

// 🔹 Хешуємо телефон для Meta
$hashed_phone = hash('sha256', $clean_phone);

// Унікальний ID події
$eventId = 'order_' . uniqid();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
<meta charset="UTF-8">
<title>Дякуємо за замовлення!</title>

<style>
body {
  font-family: Arial, sans-serif;
  background:#f9f9f9;
  height:100vh;
  margin:0;
  display:flex;
  justify-content:center;
  align-items:center;
}
.thankyou-box{
  background:#fff;
  padding:40px;
  border-radius:12px;
  text-align:center;
  box-shadow:0 6px 16px rgba(0,0,0,.1);
  max-width: 420px;
  width:90%;
}
.thankyou-box h1{
  margin-bottom:16px;
  color:#4CAF50;
}
.thankyou-box p{
  font-size:1.2rem;
  margin-bottom:18px;
}
.thankyou-box a{
  display:inline-block;
  padding:12px 24px;
  background:#4CAF50;
  color:#fff;
  text-decoration:none;
  border-radius:8px;
  font-size:1rem;
}
.thankyou-box a:hover{
  background:#43a047;
}
</style>

<!-- 🔹 Meta Pixel Base -->
<script>
!function(f,b,e,v,n,t,s)
{
if(f.fbq)return;
n=f.fbq=function(){
n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)
};
if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];
t=b.createElement(e);t.async=!0;t.src=v;
s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)
}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '1085155453320864', {
  ph: '<?php echo $hashed_phone; ?>'
});

fbq('track','PageView');
</script>

<!-- ✅ PURCHASE -->
<script>
(function sendEvents(){

  const eventId = "<?php echo $eventId; ?>";

  if(typeof fbq === "undefined"){
      setTimeout(sendEvents, 300);
      return;
  }

  // Захист від дублювання
  if(sessionStorage.getItem('purchase_sent')) return;

  // ✅ Purchase
  fbq('track', 'Purchase', {
    content_name: <?php echo json_encode($product_name); ?>,
content_category: "Жіночі джинси",
content_ids: [<?php echo json_encode($product_name); ?>],
user_size: <?php echo json_encode($user_size); ?>
  }, { eventID: eventId });

  sessionStorage.setItem('purchase_sent','1');

  console.log('✅ Purchase відправлено', eventId);

})();
</script>

</head>
<body>

<div class="thankyou-box">
  <h1>✅ Ваше замовлення прийнято!</h1>

  <p><b>Товар:</b> <?php echo htmlspecialchars($product_name); ?></p>

  <p><b>Розмір:</b> <?php echo htmlspecialchars($user_size); ?></p>

  <p>Ми зв'яжемося з вами найближчим часом.</p>

  <a href="/">⬅ Повернутися на головну</a>
</div>

</body>
</html>