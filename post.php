<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';
require 'assets/PHPMailer/src/Exception.php';

// --------------------------
// Дані з форми
// --------------------------
$name       = htmlspecialchars($_POST['name'] ?? '');
$phone      = htmlspecialchars($_POST['phone'] ?? '');
$user_size  = htmlspecialchars($_POST['user_size'] ?? 'Не вказано');
$city       = htmlspecialchars($_POST['city'] ?? 'Не вказано');
$nova       = htmlspecialchars($_POST['nova_poshta'] ?? 'Не вказано');
$call_back  = htmlspecialchars($_POST['call_back'] ?? 'Не вказано');
$chosen     = htmlspecialchars($_POST['user_comment'] ?? 'Не обрано');
$page_size  = htmlspecialchars($_POST['size'] ?? 'Не вказано');

/* ------------------------------------ */
/*   ДИНАМІЧНА ЦІНА З КОШИКА (SAFE)    */
/* ------------------------------------ */

$product   = "Магазин";
$lp_crm_id = 30;

/* Отримуємо суму кошика */
$cart_total = isset($_POST['cart_total']) ? $_POST['cart_total'] : 0;

/* Примусово приводимо до числа */
$cart_total = (int)trim($cart_total);

/* Якщо є товари */
if ($cart_total > 0) {
    $price = $cart_total;
} else {
    $price = "Консультація";
}
// --------------------------
// Масив товарів
// --------------------------
$products_list = [
    [
        'product_id' => $lp_crm_id,
        'price'      => (string)$price,
        'count'      => '1',
        'subs' => [
            ['sub_id' => $lp_crm_id, 'count' => '1']
        ]
    ]
];

$order_id = uniqid('', true);

$products = urlencode(serialize($products_list));
$sender   = urlencode(serialize($_SERVER));

// --------------------------
// Коментар ДЛЯ CRM (в один рядок, у твоєму порядку)
// --------------------------

$page_size = !empty($page_size) ? $page_size : 'Не обрано';

$chosen = !empty($chosen) && $chosen !== 'Не обрано'
    ? $chosen
    : 'Не обрано';

$model = '';

if ($chosen === 'Не обрано') {
    $model = htmlspecialchars($_POST['model'] ?? '');
}

$site_name = htmlspecialchars($_POST['site_name'] ?? 'Не вказано');

$comment_final =
    " $product; " .
    "/Розмір: $user_size; ";

if (!empty($model)) {
    $comment_final .= "/Модель: $model; ";
}

$comment_final .=
    "/Ціна: $price грн; " .
    "Сайт: $site_name; " .
    "Товар із магазину: $chosen; " .
    "Місто: $city; " .
    "Відділення: $nova; " .
    "Передзвонити: $call_back; " .
    "Імʼя: $name; " .
    "Телефон: $phone;";

// --------------------------
// Дані для CRM
// --------------------------
$crm_data = [
    'key'          => 'f68c9ee35c72bcb82c1cb85ca4634a93',
    'order_id'    => $order_id,
    'country'     => 'UA',
    'office'      => '1',
    'products'    => $products,
    'bayer_name'  => $name,
    'phone'       => $phone,
    'email'       => '',
    'comment'     => $comment_final,
    'notification'=> '',
    'delivery'    => '',
    'delivery_adress'=> '',
    'payment'     => '',
    'sender'      => $sender,
    'ignore_duplicate' => 1
];

// --------------------------
// Відправка до CRM
// --------------------------
$curl = curl_init('http://rarechin.lp-crm.biz/api/addNewOrder.html');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $crm_data);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$crm_response = curl_exec($curl);
curl_close($curl);

if(!$crm_response){
    echo json_encode(['status'=>'error','message'=>'CRM error']);
    exit;
}

// --------------------------
// Email повідомлення
// --------------------------
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host     = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vk7116363@vitmarket.online';
    $mail->Password = 'Lenina128@';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port     = 465;
    $mail->CharSet  = 'UTF-8';

    $mail->setFrom('vk7116363@vitmarket.online', 'Mriya Jeans');
    $mail->addAddress('mriyajeans@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = "Нове замовлення: $product";
 $mail->Body = "
<h2>Дані замовлення</h2>

<table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse; width:100%;'>

<tr><th align='left'>Основний товар</th><td>$product</td></tr>

<tr><th align='left'>Розмір (основний)</th><td>$user_size</td></tr>
<tr><th align='left'>Модель</th><td>$model</td></tr>

<tr><th align='left'>Ціна</th><td>{$price} грн</td></tr>

<tr><th align='left'>Сайт</th><td>$site_name</td></tr>

<tr><th align='left'>Товар із магазину</th><td>$chosen</td></tr>

<tr><th align='left'>Місто</th><td>$city</td></tr>

<tr><th align='left'>Відділення НП</th><td>$nova</td></tr>

<tr><th align='left'>Передзвонити</th><td>$call_back</td></tr>

<tr><th align='left'>Імʼя</th><td>$name</td></tr>

<tr><th align='left'>Телефон</th><td>$phone</td></tr>

</table>
";



    $mail->send();

   // --------------------------------------------
// ДАНІ ДЛЯ СТОРІНКИ ДЯКУЮ (THANKYOU)
// --------------------------------------------

$last_product = $product; // товар з хедера (за замовчуванням)

// Якщо замовлення з каталогу — беремо останній товар з кошика
if (!empty($chosen) && $chosen !== 'Не обрано') {

    // chosen формат:
    // "Какао MOM FIT / XL / 1200 грн / M5811; Чорні MOM FIT / L / 1200 грн / M5811"

    $items = explode(";", $chosen);
    $last = trim(end($items)); // беремо останній товар

    // Беремо тільки назву (до першого слеша)
    $parts = explode("/", $last);
    $last_product = trim($parts[0]);
}

// ✔ Записуємо в сесію
$_SESSION['user_size']     = $user_size;
$_SESSION['product_name']  = $last_product;
$_SESSION['phone'] = $phone;
    header("Location: thankyou.php");
    exit();

} catch (Exception $e) {
    echo "Mail error: {$mail->ErrorInfo}";
}
