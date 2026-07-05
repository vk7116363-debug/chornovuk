<section class="store-block" id="catalog">

<h2 class="store-title"><strong>🛍Наші товари</strong></h2>
<!-- КНОПКА ОЧИСТКИ КЕШУ (ПРИХОВАНИЙ ТРИГЕР) -->
<div id="cacheAdminBlock" style="display:none; text-align:center; margin:20px 0;">

  <button id="clearCacheBtn" class="cache-refresh-btn">
    🔄 Оновити каталог
  </button>

  <div id="cacheStatus" class="cache-status"></div>

</div>

<style>
/* кнопка */
.cache-refresh-btn{
  padding:10px 20px;
  background:#111;
  color:#fff;
  border:none;
  border-radius:8px;
  font-weight:700;
  cursor:pointer;
  transition:.2s;
}

.cache-refresh-btn:hover{
  background:#000;
  transform:translateY(-2px);
}

/* статус */
.cache-status{
  margin-top:8px;
  font-size:13px;
  color:#666;
}
</style>

<script>
/* ========================================== */
/*   ПРИХОВАНИЙ ТРИГЕР + ОЧИСТКА КЕШУ         */
/* ========================================== */

(function(){

  const SECRET_KEY = "00000"; // 🔥 зміни ключ

  const title = document.querySelector('.store-title');
  const block = document.getElementById('cacheAdminBlock');
  const btn = document.getElementById('clearCacheBtn');
  const status = document.getElementById('cacheStatus');

  if (!title || !btn) return;

  let clickCount = 0;
  let timer = null;

  /* === ТРИГЕР: 3 кліки по заголовку === */
  title.addEventListener('click', function(){

    clickCount++;

    if (clickCount === 1) {
      timer = setTimeout(() => {
        clickCount = 0;
      }, 800); // час для серії кліків
    }

    if (clickCount === 3) {
      clearTimeout(timer);
      clickCount = 0;

      block.style.display = 'block';
    }

  });

  /* === ОЧИСТКА КЕШУ === */
  btn.addEventListener('click', function(){

    btn.disabled = true;
    status.textContent = "Оновлення...";

    fetch('/clear-cache.php?key=' + SECRET_KEY)
      .then(res => res.text())
     .then(() => {
  status.textContent = "✅ Каталог оновлено";

        setTimeout(() => {
          location.reload();
        }, 800);

      })
      .catch(() => {
        status.textContent = "❌ Помилка";
        btn.disabled = false;
      });

  });

})();
</script>
  <div class="store-grid">
   

<?php
/* ========================================================= */
/*      КЕШ КАТАЛОГУ НА ОСНОВІ ЗМІНИ JSON (SAFE B)          */
/* ========================================================= */

$jsonFile  = __DIR__ . '/products.json';
$cacheDir  = __DIR__ . '/cache';
$cacheFile = $cacheDir . '/catalog.cache.html';

/* --- створюємо папку cache якщо її немає --- */
if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

/* --- перевірка чи потрібно перебудовувати кеш --- */
$rebuildCache = true;

if (file_exists($cacheFile)) {
    if (filemtime($cacheFile) >= filemtime($jsonFile)) {
        $rebuildCache = false;
    }
}

if (!$rebuildCache) {

    readfile($cacheFile);

} else {

    $products = json_decode(file_get_contents($jsonFile), true);

    usort($products, function($a, $b) {

        $aSale = !empty($a['sale']) ? 1 : 0;
        $bSale = !empty($b['sale']) ? 1 : 0;

        if ($aSale === $bSale) return 0;

        return $bSale <=> $aSale;
    });

    ob_start();

    foreach ($products as $product):
?>

<!-- PRODUCT CARD -->
<div class="product-card"
     data-category="<?= htmlspecialchars($product['category']) ?>"
     data-product="<?= htmlspecialchars($product['displayName']) ?>"
     data-popup-name="<?= htmlspecialchars($product['name']) ?>"
     data-price="<?= htmlspecialchars($product['price']) ?>"
     data-model="<?= htmlspecialchars($product['model']) ?>"
     data-sale="<?= (!empty($product['sale']) && $product['sale'] === true) ? 'true' : 'false' ?>"
     data-video-id="<?= htmlspecialchars($product['videoId']) ?>"
     data-gallery='<?= htmlspecialchars(json_encode($product["gallery"] ?? []), ENT_QUOTES, "UTF-8") ?>'
     data-sizes="<?= htmlspecialchars($product['sizes']) ?>"
     data-desc-list="<?= htmlspecialchars($product['descList']) ?>"
     data-desc-text="<?= htmlspecialchars($product['descText']) ?>"
     data-preorder="<?= !empty($product['preorder']) ? 'true' : 'false' ?>"
     data-preorder-text="<?= htmlspecialchars($product['preorderText'] ?? '') ?>"
>

  <div class="product-video" aria-hidden="true">

  <?php if (!empty($product['badge'])): ?>
    <div class="product-badge">
      <?= htmlspecialchars($product['badge']) ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($product['image'])): ?>

    <img src="<?= htmlspecialchars($product['image']) ?>"
         loading="lazy"
         alt="<?= htmlspecialchars($product['displayName']) ?>">

  <?php elseif (!empty($product['videoId'])): ?>

    <img src="https://img.youtube.com/vi/<?= htmlspecialchars($product['videoId']) ?>/maxresdefault.jpg"
         onerror="this.src='https://img.youtube.com/vi/<?= htmlspecialchars($product['videoId']) ?>/hqdefault.jpg'"
         loading="lazy"
         alt="<?= htmlspecialchars($product['displayName']) ?>">

    <div class="product-play" aria-hidden="true"></div>

  <?php endif; ?>

</div>

  <div class="product-price">

<?php if (isset($product['sale']) && $product['sale'] === true && isset($product['oldPrice'])): ?>

  <span class="old-price">
    <?= htmlspecialchars($product['oldPrice']) ?> грн
  </span>

  <span class="sale-price">
    <?= htmlspecialchars($product['price']) ?> грн
  </span>

<?php else: ?>

  <?= htmlspecialchars($product['price']) ?> грн

<?php endif; ?>

</div>

  <div class="product-name">
    <?= htmlspecialchars($product['displayName']) ?>
  </div>

  <button class="product-details-btn"
          type="button"
          aria-haspopup="dialog"
          data-product="<?= htmlspecialchars($product['displayName']) ?>"
          data-price="<?= htmlspecialchars($product['price']) ?>"
          data-model="<?= htmlspecialchars($product['model']) ?>">
    Детальніше
  </button>

</div>

<?php
    endforeach;

    $html = ob_get_clean();

    file_put_contents($cacheFile, $html);

    echo $html;
}
?>

   </div>

   <div class="load-more-wrapper">
     <button id="loadMoreBtn" class="load-more-btn">
       Показати ще
     </button>
   </div>

<style>
.load-more-wrapper{
  text-align:center;
  margin:30px 0 10px;
}

.load-more-btn{
  padding:12px 28px;
  background:#111;
  color:#fff;
  border:none;
  border-radius:8px;
  font-weight:700;
  cursor:pointer;
  transition:.2s ease;
}

.load-more-btn:hover{
  background:#000;
  transform:translateY(-2px);
}
</style>

</section>