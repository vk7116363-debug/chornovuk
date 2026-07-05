<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <meta name="facebook-domain-verification" content="mwms68w1kx7mat40vdh5vhmt31qv3q" />

  <!-- Meta Pixel (тимчасово залишаємо як є) -->
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '1085155453320864');
     fbq('track', 'PageView');
  </script>

  <!-- PRELOAD HERO -->
  <link rel="preload" as="image" href="images/MOMFITBANER_banner.webp" fetchpriority="high"/>

  <!-- SEO MRIYA -->
  <title>MRIYA JEANS — жіночі джинси великих розмірів</title>

  <!-- --------------------------------------------Іконка на посилані у браузері ------------------------------------ -->
  <link rel="icon" type="image/png" href="favicon.png">
  
  <link rel="apple-touch-icon" href="favicon.png">
<!-- ---------------------------------------------------------------------------------------------------------------- -->

  <meta name="description"
        content="MRIYA JEANS — жіночі джинси великих розмірів. Ідеальна посадка, швидка доставка Новою Поштою, обмін та повернення без ризику."/>

  <meta property="og:title" content="MRIYA JEANS — жіночі джинси великих розмірів"/>
  <meta property="og:description" content="Ідеальна посадка, швидка доставка, обмін та повернення без ризику."/>
  <meta property="og:image" content="https://vitmarket.online/images/og-banner-1200x630.jpg"/>
  <meta property="og:type" content="website"/>

  <meta name="twitter:card" content="summary_large_image"/>

  <style>
    /* ================= БАЗА МАГАЗИНУ ================= */

    body{
      margin:0;
      font-family: Inter, system-ui, Arial, sans-serif;
      background:#ffffff;
      color:#222;
    }

    a{ color:inherit; }

    /* ================= HEADER MRIYA ================= */

    .mriya-header{
      position:sticky;
      top:0;
      z-index:10000;

      display:flex;
      align-items:center;
      justify-content:space-between;

      padding:12px 18px;
      background:#ffffff;
      border-bottom:1px solid #eee;
      box-shadow:0 2px 10px rgba(0,0,0,0.04);
    }

    .mriya-logo img{
      height:42px;
      width:auto;
      display:block;
    }

    .mriya-nav{
      display:flex;
      gap:26px;
    }

    .mriya-nav a{
      text-decoration:none;
      font-weight:600;
      font-size:15px;
      transition:.2s;
    }

    .mriya-nav a:hover{
      opacity:.6;
    }

    .mriya-cart{
      font-size:20px;
      cursor:pointer;
      transition:.2s;
    }

    .mriya-cart:hover{
      transform:scale(1.1);
    }

    @media (max-width:768px){
      .mriya-nav{ gap:16px; }
      .mriya-nav a{ font-size:14px; }
      .mriya-logo img{ height:36px; }
    }

    /* ================= HERO МАГАЗИНУ ================= */

    .hero{
      position:relative;
      width:100%;
      overflow:hidden;
    }

    .hero img{
      width:100%;
      height:75vh;
      object-fit:cover;
      display:block;
    }

    .hero-content{
      position:absolute;
      inset:0;
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:center;
      text-align:center;
      background:rgba(0,0,0,0.25);
      color:#fff;
      padding:20px;
    }

    .hero-title{
      font-size:32px;
      font-weight:800;
      margin-bottom:12px;
    }

    .hero-btn{
      background:#ffffff;
      color:#000;
      padding:12px 22px;
      border-radius:8px;
      font-weight:700;
      text-decoration:none;
      transition:.2s;
    }

    .hero-btn:hover{
      transform:translateY(-2px);
    }

    @media (max-width:768px){
      .hero img{ height:90vh; }
      .hero-title{ font-size:24px; }
    }
  </style>
</head>

<body>


<!-- ================= HEADER MRIYA PREMIUM ================= -->
<header class="mriya-header">

  <!-- Логотип -->
  <div class="mriya-logo">
    <img src="images/logo-header.png" alt="MRIYA JEANS">
  </div>

  <!-- Меню -->
  <nav class="mriya-nav">
    <a href="#catalog">Каталог</a>
    <a href="#about">Про нас</a>
    <a href="#contacts">Контакти</a>
  </nav>

  <!-- Кошик -->
  <div class="mriya-cart" id="scrollToCart" aria-label="Перейти до кошика">
    👜
  </div>

</header>


<!-- ====================================== -->
<!--        СКРОЛ ДО КОШИКА З ХЕДЕРА        -->
<!--        SAFE: без впливу на CRM для скролу корзини із хедера         -->
<!-- ====================================== -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const cartBtn = document.getElementById("scrollToCart");
  const cartBox = document.getElementById("cartBox");

  if (!cartBtn || !cartBox) return;

  cartBtn.addEventListener("click", function () {
    cartBox.scrollIntoView({
      behavior: "smooth",
      block: "start"
    });
  });
});
</script>

<!-- ====================================== -->
<!--              HERO MRIYA                -->
<!--     Комбінований бренд + товар         -->
<!-- ====================================== -->

<section class="hero">

  <img src="images/MOMFITBANER_banner.webp" alt="Жіночі джинси MRIYA" class="hero-img">

  <div class="hero-overlay">
    <div class="hero-content">

      <div class="hero-brand">MRIYA JEANS</div>

      <h1 class="hero-title">
        Джинси, які сідають ідеально<br>навіть на Plus Size
      </h1>

      <a href="#store" class="hero-btn">Перейти в каталог</a>

    </div>
  </div>

</section>

<style>
/* ================= HEADER MRIYA PREMIUM ================= */

.mriya-header{
  position: sticky;
  top: 0;
  z-index: 10000;

  display: flex;
  align-items: center;
  justify-content: space-between;

  padding: 10px 20px;

  background: rgba(255,255,255,0.92);
  backdrop-filter: blur(8px);

  border-bottom: 1px solid rgba(0,0,0,0.06);
  box-shadow: 0 4px 14px rgba(0,0,0,0.04);
}

/* ЛОГО */
.mriya-logo img{
  height: 40px;
  width: auto;
  display: block;
  transition: transform .25s ease;
}

.mriya-logo img:hover{
  transform: scale(1.04);
}

/* МЕНЮ */
.mriya-nav{
  display: flex;
  gap: 28px;
}

.mriya-nav a{
  text-decoration: none;
  color: #222;
  font-weight: 600;
  font-size: 15px;
  position: relative;
  transition: .2s ease;
}

/* Преміум underline */
.mriya-nav a::after{
  content: "";
  position: absolute;
  left: 0;
  bottom: -4px;
  width: 0%;
  height: 2px;
  background: #000;
  transition: width .25s ease;
}

.mriya-nav a:hover::after{
  width: 100%;
}

/* КОШИК */
.mriya-cart{
  font-size: 20px;
  cursor: pointer;

  width: 38px;
  height: 38px;

  display: flex;
  align-items: center;
  justify-content: center;

  border-radius: 50%;
  background: #f5f5f5;

  transition: .2s ease;
}

.mriya-cart:hover{
  background: #ececec;
  transform: scale(1.08);
}

/* ================= MOBILE ================= */
@media (max-width:768px){

  /* робимо банер вузькою полоскою */
  .hero img{
    height: 300px;        /* висота полоски */
    width: 100%;
    object-fit: cover;    /* обрізає верх/низ як на ПК */
    object-position: center;
  }

  .hero-title{
    font-size: 22px;
  }

}

/* ====================================== */
/*      HERO TEXT — PREMIUM READABLE      */
/* ====================================== */

.hero-overlay{
  background: none; /* прибрали затемнення повністю */
}


/* ================= HERO TEXT — FASHION PREMIUM ================= */

/* бренд MRIYA JEANS */
.hero-brand{
  font-size: 12px;
  letter-spacing: 4px;
  margin-bottom: 14px;

  color: #ffffff;
  font-weight: 600;

  /* м’яка дорога тінь */
  text-shadow:
    0 2px 10px rgba(0,0,0,0.55),
    0 0 2px rgba(0,0,0,0.4);

  opacity: 0.95;
}

/* головний заголовок */
.hero-title{
  font-size: 40px;
  font-weight: 900;
  line-height: 1.2;
  margin-bottom: 22px;

  color: #ffffff;

  /* premium-читабельність як у fashion-брендів */
  text-shadow:
    0 4px 18px rgba(0,0,0,0.65),
    0 2px 6px rgba(0,0,0,0.45);
}

/* мобільна */
@media (max-width:768px){
  .hero-title{
    font-size: 26px;
  }

  .hero-brand{
    font-size: 11px;
    letter-spacing: 3px;
  }
}


/* кнопка */
.hero-btn{
  background: rgba(255,255,255,0.92);
  backdrop-filter: blur(6px);

  border-radius: 10px;
  padding: 14px 26px;

  font-weight: 800;
  letter-spacing: 0.2px;

  box-shadow: 0 8px 24px rgba(0,0,0,0.25);
}

/* hover кнопки */
.hero-btn:hover{
  transform: translateY(-2px);
  background: #ffffff;
}

/* ================= MOBILE ================= */

@media (max-width:768px){

  .hero-title{
    font-size: 24px;
  }

}

/* ====================================== */
/*        HERO ANIMATION PREMIUM          */
/* ====================================== */

/* початковий стан */
.hero-brand,
.hero-title,
.hero-btn{
  opacity: 0;
  transform: translateY(20px);
}

/* анімації */
.hero-brand{
  animation: heroFade 0.8s ease forwards;
  animation-delay: 0.2s;
}

.hero-title{
  animation: heroFade 0.9s ease forwards;
  animation-delay: 0.4s;
}

.hero-btn{
  animation: heroFade 0.9s ease forwards;
  animation-delay: 0.65s;
}

/* keyframes */
@keyframes heroFade{
  to{
    opacity: 1;
    transform: translateY(0);
  }
}

/* ====================================== */
/*        HERO IMAGE ZOOM PREMIUM         */
/* ====================================== */

/* початковий стан */
.hero-img{
  transform: scale(1.06);
  animation: heroZoom 1.6s ease-out forwards;
}

/* плавний наїзд */
@keyframes heroZoom{
  to{
    transform: scale(1);
  }
}



</style>




<!-- ====================================== -->
<!--        ВХІД У КАТАЛОГ MRIYA            -->
<!--        Преміум мінімалістичний          -->
<!-- ====================================== -->

<section class="catalog-entry" id="catalog">

  <div class="catalog-entry-inner">

    <h2 class="catalog-entry-title">
      Джинси Plus Size, які створені для комфорту
    </h2>

    <p class="catalog-entry-subtitle">
      Обирай свою модель серед перевірених фасонів MRIYA
    </p>

    <a href="#store" class="catalog-entry-btn">
      Перейти в каталог
    </a>

  </div>

</section>

<style>
/* ================= ВХІД У КАТАЛОГ ================= */

.catalog-entry{
  padding: 70px 16px;
  background: #ffffff;
  text-align: center;
}

/* контейнер */
.catalog-entry-inner{
  max-width: 720px;
  margin: 0 auto;
}

/* заголовок */
.catalog-entry-title{
  font-size: 32px;
  font-weight: 800;
  line-height: 1.3;
  margin-bottom: 16px;
  color: #111;
}

/* підзаголовок */
.catalog-entry-subtitle{
  font-size: 16px;
  color: #666;
  margin-bottom: 28px;
}

/* кнопка */
.catalog-entry-btn{
  display: inline-block;
  padding: 14px 32px;
  background: #111;
  color: #fff;
  text-decoration: none;
  font-weight: 700;
  border-radius: 8px;
  transition: 0.2s ease;
}

.catalog-entry-btn:hover{
  background: #000;
  transform: translateY(-2px);
}

/* ================= MOBILE ================= */

@media (max-width:768px){

  .catalog-entry{
    padding: 50px 16px;
  }

  .catalog-entry-title{
    font-size: 24px;
  }

  .catalog-entry-subtitle{
    font-size: 14px;
  }

  .catalog-entry-btn{
    padding: 12px 26px;
    font-size: 14px;
  }
}
</style>



<!-- ====================================== -->
<!--          FLASH SALE BLOCK              -->
<!-- ====================================== -->
<section class="flash-sale-section" id="flashSale">

  <div class="flash-sale-header">
    <h2>🔥 Flash Sale — обмежена пропозиція</h2>
    <div class="flash-timer" id="flashTimer"></div>
  </div>

  <div class="flash-sale-grid">

    <!-- ================= MODEL 599 ================= -->
    <div class="product-card"
         data-category="mom"
         data-product="Коричневі MOM FIT — трендовий колір сезону!"
         data-price="899"
         data-model="599"
         data-video-id="1lfu_UDdfLU"
         data-sizes="L|74-84|98-106;"
         data-desc-list="Висока посадка;Актуальний модний фасон; Пояс у комплекті (може відрізнятися залежно від партії);📦 Відправка щодня Новою Поштою;💳 50 000+ відгуків;⏱ Швидка обробка замовлень;🔄 Обмін і повернення"
         data-desc-text="✔ М'яка та приємна до тіла тканина; ✔ Чудово підкреслюють силует; ✔ Якісний крій"
         data-sale="true">

      <div class="product-video">
        <img src="https://img.youtube.com/vi/1lfu_UDdfLU/maxresdefault.jpg"
             onerror="this.src='https://img.youtube.com/vi/1lfu_UDdfLU/hqdefault.jpg'">
        <div class="product-play"></div>
      </div>

      <div class="product-price">
        <span class="old-price">1200 грн</span>
        <span class="sale-price">899 грн</span>
      </div>

      <div class="product-name">Коричневі MOM FIT</div>

      <button class="product-details-btn"
              type="button"
              aria-haspopup="dialog">
        Детальніше
      </button>
    </div>

    <!-- ================= MODEL 521Ч ================= -->
    <div class="product-card"
         data-category="mom"
         data-product="Чорні MOM FIT"
         data-price="899"
         data-model="521Ч"
         data-video-id="kalIPZfUwSc"
         data-sizes="L|80-88|100-106;"
         data-desc-list="Висока посадка;Актуальний модний фасон; Пояс у комплекті (може відрізнятися залежно від партії);📦 Відправка щодня Новою Поштою;💳 50 000+ відгуків;⏱ Швидка обробка замовлень;🔄 Обмін і повернення"
         data-desc-text="✔ М'яка та приємна до тіла тканина; ✔ Чудово підкреслюють силует; ✔ Якісний крій"
         data-sale="true">

      <div class="product-video">
        <img src="https://img.youtube.com/vi/kalIPZfUwSc/maxresdefault.jpg"
             onerror="this.src='https://img.youtube.com/vi/kalIPZfUwSc/hqdefault.jpg'">
        <div class="product-play"></div>
      </div>

      <div class="product-price">
        <span class="old-price">1299 грн</span>
        <span class="sale-price">899 грн</span>
      </div>

      <div class="product-name">Чорні MOM FIT</div>

      <button class="product-details-btn"
              type="button"
              aria-haspopup="dialog">
        Детальніше
      </button>
    </div>

     <!-- ================= MODEL 1127 ================= -->
    <div class="product-card"
         data-category="mom"
         data-product="Plus Size, який виглядає акуратно !"
         data-price="899"
         data-model="1127"
         data-video-id="GKWka9fzL8k"
         data-sizes="L|76-82|98-104;"
         data-desc-list="Висока посадка;Актуальний модний фасон; Пояс у комплекті (може відрізнятися залежно від партії);📦 Відправка щодня Новою Поштою;💳 50 000+ відгуків;⏱ Швидка обробка замовлень;🔄 Обмін і повернення"
         data-desc-text="✔ М'яка та приємна до тіла тканина; ✔ Чудово підкреслюють силует; ✔ Якісний крій"
         data-sale="true">

      <div class="product-video">
    <img src="gallery/1127hero-preview.webp"
         loading="lazy"
         alt="Світло-блакитні Mom Fit">
    <div class="product-play"></div>
</div>

      <div class="product-price">
        <span class="old-price">1299 грн</span>
        <span class="sale-price">899 грн</span>
      </div>

      <div class="product-name">Світло-блакитні Mom Fit</div>

      <button class="product-details-btn"
              type="button"
              aria-haspopup="dialog">
        Детальніше
      </button>
    </div>

    <!-- ================= MODEL 3139 ================= -->
    <div class="product-card"
         data-category="mom"
         data-product="Жіночі джинси Mom Fit з декоративним орнаментом💙"
         data-price="899"
         data-model="3139"
         data-video-id="oMBCpOXO5lQ"
         data-sizes="L|80-86|100-106;"
         data-desc-list="Висока посадка;Актуальний модний фасон; 📦 Відправка щодня Новою Поштою;💳 50 000+ відгуків;⏱ Швидка обробка замовлень;🔄 Обмін і повернення"
         data-desc-text="✔ М'яка та приємна до тіла тканина; ✔ Чудово підкреслюють силует; ✔ Якісний крій"
         data-sale="true">

       <div class="product-video">
    <img src="gallery/3MOMDEKOR .webp"
         loading="lazy"
         alt="Світло-блакитні Mom Fit">
    <div class="product-play"></div>
</div>

      <div class="product-price">
        <span class="old-price">1350 грн</span>
        <span class="sale-price">899 грн</span>
      </div>

      <div class="product-name">Світлі Mom Fit з характером на літо☀️</div>

      <button class="product-details-btn"
              type="button"
              aria-haspopup="dialog">
        Детальніше
      </button>
    </div>

  </div>
</section>

<style>
/* Контейнер Flash Sale */
.flash-sale-section{
  max-width:800px;
  margin:15px auto;
  padding:0 16px;
}

/* Заголовок */
.flash-sale-header{
  text-align:center;
  margin-bottom:20px;
}

.flash-sale-header h2{
  font-size:24px;
  font-weight:800;
}

.flash-timer{
  font-size:18px;
  font-weight:700;
  margin-top:8px;
  color:#d60000;
}

/* ОКРЕМА сітка для Flash Sale */
.flash-sale-grid{
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:16px;
}

/* 📱 МОБІЛЬНА — ТЕЖ 2 В РЯД */
@media (max-width:768px){
  .flash-sale-grid{
    grid-template-columns:repeat(2,1fr);
  }
}
</style>
<!-- ====================================== -->
<!--          FLASH TIMER LOGIC             -->
<!-- ====================================== -->

<style>
/* =============================== */
/*        СТИЛЬ ТАЙМЕРА           */
/* =============================== */
.flash-timer{
  display:flex;
  justify-content:center;
  align-items:center;
  gap:10px;
  margin-top:10px;
  flex-wrap:wrap;
  font-weight:600;
}

.flash-timer-text{
  font-size:16px;
  color:#d60000; /* ЧЕРВОНИЙ */
}

.flash-timer-numbers{
  display:flex;
  gap:6px;
}

.flash-timer-box{
  background:#f1f1f1;
  padding:6px 10px;
  border-radius:6px;
  font-size:14px;
  font-weight:700;
  color:#d60000; /* ЧЕРВОНИЙ */
  min-width:42px;
  text-align:center;
  box-shadow:0 2px 6px rgba(0,0,0,0.05);
}
</style>

<script>
/* ====================================== */
/*          FLASH TIMER LOGIC             */
/* ====================================== */

(function(){

  const timerEl = document.getElementById("flashTimer");

  /* ВСТАВ СВОЮ ДАТУ ЗАВЕРШЕННЯ ТУТ */
  let endDate = new Date("2026-06-28T23:59:59");

  function updateTimer(){

    const now = new Date();

    if(now > endDate){
      endDate = new Date(now.getTime() + 3*24*60*60*1000);
    }

    const diff = endDate - now;

    const d = Math.floor(diff/(1000*60*60*24));
    const h = Math.floor((diff/(1000*60*60))%24);
    const m = Math.floor((diff/(1000*60))%60);
    const s = Math.floor((diff/1000)%60);

    timerEl.innerHTML = `
      <div class="flash-timer">
        <div class="flash-timer-text">⏳ До завершення:</div>
        <div class="flash-timer-numbers">
          <div class="flash-timer-box">${d}д</div>
          <div class="flash-timer-box">${h}г</div>
          <div class="flash-timer-box">${m}хв</div>
          <div class="flash-timer-box">${s}с</div>
        </div>
      </div>
    `;

  }

  setInterval(updateTimer,1000);
  updateTimer();

})();
</script>


                                                                <!-- Блок ШАХРАЇ -->
<style>
  .safety-warning-section {
    max-width: 800px;
    margin: 20px auto;
    padding: 0 16px;
    font-family: sans-serif;
  }

  .safety-container {
    background: #fff;
    border: 2px solid #d60000; /* Червона рамка для привернення уваги */
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }

  .safety-image-wrapper {
    width: 100%;
    line-height: 0; /* Прибирає зайві відступи під фото */
  }

  .safety-image-wrapper img {
    width: 100%;
    height: auto;
    display: block;
  }

  /* Невеличка анімація пульсації для рамки, щоб виділити блок */
  @keyframes border-pulse {
    0% { border-color: #d60000; }
    50% { border-color: #ff8080; }
    100% { border-color: #d60000; }
  }

  .safety-container {
    animation: border-pulse 2s infinite;
  }

  /* Адаптація для мобільних */
  @media (max-width: 768px) {
    .safety-warning-section {
      margin: 10px auto;
    }
  }
</style>

<section class="safety-warning-section">
  <div class="safety-container">
    <div class="safety-image-wrapper">
      <img src="images/CHAHRAI.webp" alt="Офіційне попередження Mriya Jeans" loading="lazy">
    </div>
  </div>
</section>


<!-- ====================================== -->
<!--        ФІЛЬТР КАТЕГОРІЙ МАГАЗИНУ       -->
<!--        SAFE: підтримка кількох категорій -->
<!-- ====================================== -->

<section class="store-filter" id="store">

  <div class="store-filter-buttons">

    <button class="filter-btn active" data-filter="all">Всі</button>
    <button class="filter-btn" data-filter="skinny">Skinny</button>
    <button class="filter-btn" data-filter="mom">Mom Fit</button>
    <button class="filter-btn" data-filter="warm">Утеплені</button>
    <button class="filter-btn" data-filter="balloon">Balloon Fit</button>
    <button class="filter-btn" data-filter="shorts">Шорти</button>
    <button class="filter-btn" data-filter="other">Інше</button>
    <button class="filter-btn filter-sale" data-filter="sale">
  Акційні <span class="sale-badge">SALE</span>
</button>

  </div>

</section>

<style>
/* ================= ФІЛЬТР КАТЕГОРІЙ ================= */

html {
  scroll-behavior: smooth;
}

.store-filter{
  padding: 30px 16px 0;
  text-align: center;
  background: #fff;
}

.store-filter-buttons{
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  justify-content: center;
  max-width: 900px;
  margin: 0 auto 18px;
}

/* кнопка */
.filter-btn{
  padding: 10px 16px;
  border: 1px solid #ddd;
  background: #fff;
  cursor: pointer;
  border-radius: 8px;
  font-weight: 700;
  transition: 0.2s ease;
}

/* hover */
.filter-btn:hover{
  background: #f5f5f5;
}

/* активна */
.filter-btn.active{
  background: #111;
  color: #fff;
  border-color: #111;
}

/* мобільна адаптація */
@media (max-width:768px){
  .filter-btn{
    padding: 9px 14px;
    font-size: 14px;
  }
}

/* ================= SALE BADGE В КНОПЦІ ================= */

.filter-sale{
  position: relative;
}

/* сам бейдж */
.sale-badge{
  display: inline-block;
  margin-left: 6px;
  padding: 2px 6px;

  font-size: 10px;
  font-weight: 800;
  letter-spacing: 0.5px;

  color: #fff;
  background: #d60000;

  border-radius: 4px;

  animation: salePulseBtn 1.8s ease-in-out infinite;
}

/* мʼяка пульсація */
@keyframes salePulseBtn{
  0%   { transform: scale(1); }
  50%  { transform: scale(1.08); }
  100% { transform: scale(1); }
}

</style>



<!-- ====================================== -->
<!--   ЄДИНИЙ POPUP: ВІДЕО + ІНФОРМАЦІЯ     -->
<!-- ====================================== -->
<div class="popup" id="universalPopup" aria-hidden="true">
  <div class="universal-popup-box">

    <!-- ✕ КНОПКА ЗАКРИТИ ЗВЕРХУ -->
    <button class="popup-close-top" id="universalPopupClose">✕</button>

    <!-- Відео -->
   <div id="universalVideo"></div>

   <h3 id="universalTitle"></h3>

<!-- POPUP GALLERY -->
<div class="popup-gallery" id="popupGallery" style="display:none;">

  <div class="popup-gallery-main">

    <button
      class="popup-gallery-nav popup-gallery-prev"
      type="button"
    >
      &#10094;
    </button>

    <img
      id="popupGalleryMainImage"
      class="popup-gallery-main-image"
      src=""
      alt="Фото товару"
      loading="lazy"
    >

    <button
      class="popup-gallery-nav popup-gallery-next"
      type="button"
    >
      &#10095;
    </button>

  </div>

  <div
    class="popup-gallery-thumbs"
    id="popupGalleryThumbs"
  ></div>

</div>


<p class="popup-subtitle">
  Натискай на свій розмір і додавай товар у кошик 🛒
</p>

<div class="popup-size-grid" id="universalSizeGrid"></div>

<div id="popupPreorderBox" style="display:none;"></div>

<div class="popup-description">
  <ul class="popup-desc-list" id="universalDescList"></ul>
  <div class="popup-desc-text" id="universalDescText"></div>
</div>

<!-- Кнопка Закрити знизу -->
<button class="popup-close popup-close-bottom" id="universalCloseBottom">
  Закрити
</button>

</div>
</div>


<!-- Hidden для CRM -->
<input type="hidden" id="modelInput" name="model" value="">



<!-- =============== СТИЛІ =============== -->
<style>
                          /*-------------стилі перекреслина ціна--------- */
  .old-price{
  text-decoration: line-through;
  color: #888;
  margin-right: 6px;
  font-size: 14px;
}

.sale-price{
  color: #d60000;
  font-weight: 900;
  font-size: 18px;
}
               /*Анімація ціни*/
/*.sale-price{
  animation: salePulse 1.6s ease-in-out infinite;  
}*/
                         /*---------кінець перекреслиної ціни-------*/
.store-title{
  font-family:
    "Apple Color Emoji",
    "Segoe UI Emoji",
    "Noto Color Emoji",
    "Twemoji Mozilla",
    sans-serif;
}

/* Контейнер */
.store-block {
  max-width:1200px;
  margin:60px auto;
  padding:0 16px;
  font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
}

/* Заголовок */
.store-title {
  font-size:20px;
  margin-bottom:18px;
  text-align:center;
  font-weight:800;
}

/* Підзаголовок у popup */
#universalTitle{
  text-align:center;
}

.popup-subtitle {
  margin: 6px 0 14px;
  font-size: 0.9rem;
  font-weight: 500;
  color: #666;
  text-align: center;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;
}
/* === ПУЛЬСАЦІЯ ПІДКАЗКИ ~15 СЕК === */
.popup-subtitle.attention-text{
  animation: subtitlePulse 2.2s ease-in-out 7;
}

@keyframes subtitlePulse{
  0%   { transform: scale(1);    opacity: 0.85; }
  50%  { transform: scale(1.04); opacity: 1; }
  100% { transform: scale(1);    opacity: 0.85; }
}
/* Грід */

/* ОСНОВНА СІТКА */
.store-grid {
  display: grid;
  gap: 16px;
  grid-template-columns: repeat(2, 1fr); /* мобільна база */
}

/* ≥768px */
@media (min-width: 768px){
  .store-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* ≥992px */
@media (min-width: 992px){
  .store-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* ≥1200px */
@media (min-width: 1200px){
  .store-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* ≥1360px — 5 колонок */
@media (min-width: 1360px){
  .store-grid {
    grid-template-columns: repeat(5, 1fr);
  }
}

/* Картка */
.product-card{
  text-align:center;
  background:#fff;
  border-radius:12px;
  padding:10px;
  box-shadow:0 6px 18px rgba(0,0,0,0.06);

  /* ⭐ КЛЮЧ ДО ВИРІВНЮВАННЯ */
  display:flex;
  flex-direction:column;
}
/* Прев'ю */
.product-video {
  position:relative;
  border-radius:10px;
  overflow:hidden;
  cursor:pointer;
  aspect-ratio:16/9;
  margin-bottom:10px;
  background:#f2f2f2;
}
.product-video img {
  width:100%; height:100%; object-fit:cover;
}

/* Play */
.product-play {
  position:absolute; inset:0;
  display:flex; justify-content:center; align-items:center;
  pointer-events:none;
}
/* ============================= */
/*   МЕНША PLAY-КНОПКА           */
/* ============================= */
.product-play::after {
  content: '';
  width: 20px;        /* було 36px */
  height: 20px;
  background: rgba(255,87,34,0.55);
  border-radius: 50%;
  box-shadow: 0 4px 10px rgba(0,0,0,0.18);
}

.product-play::before {
  content: '';
  position: absolute;
  left: 50%;
  top: 50%;
  border-left: 5px solid #fff;   /* було 11px */
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  transform: translate(-35%, -50%);
}


/* Текст */
.product-price { font-size:18px; font-weight:800; margin:6px 0 2px; }
.product-name  { font-size:13px; font-weight:700; margin-bottom:8px; }

/* Кнопка */
.product-details-btn {
  width:100%; padding:10px 14px; margin-top:8px;
  background:#65664a; color:#fff; border:none;
  border-radius:6px; font-weight:700; cursor:pointer;
  transition:.14s;
}
.product-details-btn:hover { transform:translateY(-2px); background:#51523f; }


/* POPUP */
.popup { display:none; position:fixed; inset:0;
  background:rgba(0,0,0,0.6);
  z-index:99999;
  align-items:center; justify-content:center; padding:20px;
}
.popup[aria-hidden="false"] { display:flex; }



/* Сітка розмірів */
.popup-size-grid {
  display:grid;
  grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
  gap:8px; margin-top:12px;
}

 
/*.popup-size-card h4 { margin:0; font-size:14px; font-weight:900; }
.popup-size-card p { margin:0; font-size:12px; font-weight:700; }
*/
/* Опис у popup */
.popup-description { margin-top:16px; text-align:left; }

/* UL li */
.popup-desc-list li {
  padding:6px 10px;
  font-size:14px;
  border-radius:4px;
}
.popup-desc-list li:nth-child(odd){ background:#fff; }
.popup-desc-list li:nth-child(even){ background:#eaeaea; }
.popup-desc-list li:hover{ background:#f0f0f0; }

/* DIV */
.popup-desc-text > div {
  padding:8px 10px;
  margin-top:4px;
  font-size:14px;
  border-radius:4px;
}
.popup-desc-text > div:nth-child(odd){ background:#fff; }
.popup-desc-text > div:nth-child(even){ background:#eaeaea; }
.popup-desc-text > div:hover{ background:#f0f0f0; }




.popup-size-card {
  background: #fff6cc;          /* світло-жовтий */
  border: 1.4px solid #ffdf80;  /* мʼяка жовта рамка */

  border-radius:8px;
  cursor:pointer;

  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;

  padding:6px 6px;         /* трішки менше, ніж у size-card */
  min-height:58px;         /* компактна висота */
  box-sizing:border-box;

  font-size:0.86rem;
  font-weight:bold;

  transition:0.25s;
}

/* Заголовок всередині */
.popup-size-card h4 {
  margin:3px 0;
  font-size:1rem;
  font-weight:900;
  color:#333;
  line-height:1.2;
}

/* Опис (талия/бедра) */
.popup-size-card p {
  margin:2px 0;
  font-size:0.78rem;
  font-weight:bold;
  color:#333;
  line-height:1.2;
  text-align:center;
}

/* Hover — стиль як у твоїй сітці */
.popup-size-card:hover {
  background:#fffae6;
  border-color:#ffcc00;
  transform:scale(1.03);
}

/* ============================= */
/* POPUP — кнопка Закрити        */
/* Стиль як "Детальніше"         */
/* ============================= */
.popup-close {
  margin-top:12px;
  padding:10px 14px;
  background:#65664a;
  color:#fff;
  border:none;
  border-radius:6px;
  cursor:pointer;
  font-weight:700;
  transition:0.14s;
}
.popup-close:hover {
  background:#51523f;
}

/* ============================= */
/* ПІДСВІТКА ІНСТРУКЦІЇ В POPUP */
/* ============================= */
/*
.popup-subtitle {
  margin: 6px 0 14px;
  font-size: 0.95rem;
  font-weight: 600;
  color: #444;
  text-align: center;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;

  /* мʼяка анімація для привертання уваги */
  /*animation: subtitlePulse 2.2s ease-in-out infinite;
}*/

/* мʼяка пульсація */
/*@keyframes subtitlePulse {

  0% {
    transform: scale(1);
    opacity: 0.85;
  }

  50% {
    transform: scale(1.04);
    opacity: 1;
  }

  100% {
    transform: scale(1);
    opacity: 0.85;
  }

}
*/
/* ============================= */
/* Адаптація для мобільних       */
/* ============================= */
@media (max-width:460px) {
  .popup-size-grid {
    grid-template-columns: repeat(2, 1fr);
    gap:6px;
  }

  .popup-size-card {
    min-height:52px;
    padding:5px 5px;
  }

  .popup-size-card h4 {
    font-size:0.95rem;
  }
  .popup-size-card p {
    font-size:0.75rem;
  }
}



/* ================================= */
/*   POPUP — КНОПКА ✕ ЗВЕРХУ         */
/* ================================= */
.popup-close-top {
  position: sticky;
  top: 0;
  right: 0;
  margin-left: auto;
  display: block;

  background: #fff;
  border: none;
  border-radius: 50%;
  width: 32px;
  height: 32px;

  font-size: 18px;
  font-weight: bold;
  line-height: 32px;

  cursor: pointer;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

/* ================================= */
/*   POPUP — ВМІСТ ПРОКРУЧУВАНИЙ     */
/* ================================= */
.universal-popup-box {
  max-height: 90vh;
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
  padding: 16px;
  background: #fff;
  border-radius: 12px;
}

/* ================================= */
/*   POPUP — КНОПКА ЗАКРИТИ ЗНИЗУ     */
/* ================================= */
.popup-close-bottom {
  display: block;
  margin: 20px auto 0; /* В центрі */
  background:#65664a;
  color:#fff;
  border:none;
  border-radius:6px;
  padding:10px 18px;
  font-weight:700;
}

/* ===================================== */
/*   ВІДЕО У POPUP — АДАПТИВ + ВЕЛИКЕ     */
/* ===================================== */

#universalVideo iframe {
  width: 100% !important;
  max-width: 100% !important;

  height: 58vw;             /* адаптив для мобільних */
  max-height: 500px;        /* ВЕЛИКЕ відео на ПК, як ти хочеш */

  border-radius: 12px;
  display: block;
}

/* Для дуже маленьких екранів (мобільних) — робимо трохи менше */
@media (max-width: 480px) {
  #universalVideo iframe {
    width: 100% !important;

    /* Відео займає половину висоти екрана */
    height: 50vh !important;

    max-height: none; /* дає можливість реально зайняти 50vh */
  }
}
/* ====================================== */
/*           POPUP GALLERY                */
/* ====================================== */

.popup-gallery{
  margin-top:14px;
}

.popup-gallery-main{
  position:relative;
  border-radius:12px;
  overflow:hidden;
  background:#f3f3f3;
}

.popup-gallery-main-image{
  width:100%;
  display:block;
  border-radius:12px;

  aspect-ratio: 3 / 4;

  object-fit:contain;
  background:#f5f5f5;

  max-height:95vh;

  transition:opacity .25s ease;
}

@media (max-width:768px){
  .popup-gallery-main-image{
    max-height:none;
  }
}
.popup-gallery-main-image.fade-out{
  opacity:0;
}

.popup-gallery-nav{
  position:absolute;
  top:50%;
  transform:translateY(-50%);

  width:36px;
  height:36px;

  border:none;
  border-radius:50%;

  background:rgba(0,0,0,.45);
  color:#fff;

  font-size:20px;
  font-weight:700;

  cursor:pointer;
  z-index:5;

  transition:.2s;
}

.popup-gallery-nav:hover{
  background:rgba(0,0,0,.75);
}

.popup-gallery-prev{
  left:10px;
}

.popup-gallery-next{
  right:10px;
}

.popup-gallery-thumbs{
  display:flex;
  gap:8px;

  overflow-x:auto;

  margin-top:10px;
  padding-bottom:6px;

  -webkit-overflow-scrolling:touch;
}

.popup-gallery-thumbs::-webkit-scrollbar{
  display:none;
}

.popup-gallery-thumbs img{
  width:64px;
  height:84px;

  object-fit:cover;

  border-radius:10px;

  border:2px solid transparent;

  cursor:pointer;

  flex-shrink:0;

  transition:.2s;
}

.popup-gallery-thumbs img.active{
  border-color:#65664a;
  transform:scale(1.05);
}

.popup-gallery-thumbs img:hover{
  transform:scale(1.05);
}
/* ===================================================== */
/*   ВЕРСІЯ 3 — OPTIMAL FASHION PREVIEW (3/5)            */
/* ===================================================== */

.product-video {
  aspect-ratio: 3 / 5 !important;   /* 🔥 НАЙКРАЩИЙ ВАРІАНТ ДЛЯ ДЖИНСІВ */
  background: #f2f2f2;
  border-radius: 12px;
  overflow: hidden;
  position: relative;
}

/* Превʼю YouTube у vertical fashion-стилі */
.product-video img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;

  /* показує верх джинсів, де найважливіше */
  object-position: center top !important;

  display: block;
}

/*   ХОВАЄ КНОПКУ ПЛЕЙ НА КАРТКАХ І ВИГЛЯДАЄ ВСЕ ЯК ФОТО  */

/* Ховаємо play-іконку у картках, де фото і на відео теж*/
/*  display: none !important;
}*/

/* ============================= */
/*        SALE ЦІНА              */
/* ============================= */

.product-card[data-sale="true"] .product-price {
  color: #d60000;
  font-weight: 900;
  animation: salePulse 1.6s ease-in-out infinite;
}

/* Мʼяка пульсація — не дратує */
@keyframes salePulse {
  0% {
    transform: scale(1);
    text-shadow: 0 0 0 rgba(214,0,0,0.0);
  }
  50% {
    transform: scale(1.05);
    text-shadow: 0 0 10px rgba(214,0,0,0.35);
  }
  100% {
    transform: scale(1);
    text-shadow: 0 0 0 rgba(214,0,0,0.0);
  }
}

/* ================= ХІТ-БЕЙДЖ ================= */

.product-badge{
  position:absolute;
  top:10px;
  left:10px;

  background: linear-gradient(135deg,#ff512f,#dd2476);
  color:#fff;

  font-size:8px;          /* було 11px → стало трохи менше */
  font-weight:700;
  letter-spacing:.4px;     /* трішки м’якше */
  text-transform:uppercase;

  padding:4px 10px;        /* пропорційно менший */
  border-radius:20px;

  box-shadow:0 6px 16px rgba(0,0,0,.25);
}


</style>

<!-- ====================================== -->
<!--        PREMIUM HOVER КАРТОК            -->
<!--        SAFE: тільки CSS                -->
<!-- ====================================== -->

<style>
/* Плавність для всієї картки */
.product-card{
  transition: transform 0.22s ease, box-shadow 0.22s ease;
}

/* Мʼякий підйом + глибша тінь */
.product-card:hover{
  transform: translateY(-6px);
  box-shadow: 0 14px 32px rgba(0,0,0,0.12);
}

/* Плавність для превʼю */
.product-video img{
  transition: transform 0.35s ease;
}

/* Ледь помітне збільшення фото */
.product-card:hover .product-video img{
  transform: scale(1.04);
}

/* Щоб збільшення не ламало рамки */
.product-video{
  overflow: hidden;
}
</style>
<style>
/* кнопка завжди внизу картки */
.product-details-btn{
  margin-top:auto;
}

/*.store-grid {
  display: grid !important;
  grid-template-columns: repeat(6, 1fr) !important;
  gap: 16px;
}*/
</style>
