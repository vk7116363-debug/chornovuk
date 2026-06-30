<!-- ========================================================= -->
<!--      УНІВЕРСАЛЬНИЙ POPUP: ВІДЕО + РОЗМІРИ + ОПИС          -->
<!-- ========================================================= -->
<script>
/* ========================================================= */
/*   POPUP З ЛОКАЛЬНОЮ ОБРОБКОЮ !size + [red] (SAFE STEP 2) */
/* ========================================================= */

(function(){

  const FORM_SIZE_ID = 'sizeInput';
  const FORM_USER_SIZE_ID = 'userSizeInput';
  const FORM_SECTION_ID = 'formSection';

  const popup = document.getElementById("universalPopup");
  const popupCloseTop = document.getElementById("universalPopupClose");
  const popupCloseBottom = document.getElementById("universalCloseBottom");

  const popupVideo = document.getElementById("universalVideo");
  const popupTitle = document.getElementById("universalTitle");
  const popupSizeGrid = document.getElementById("universalSizeGrid");
  const popupDescList = document.getElementById("universalDescList");
  const popupDescText = document.getElementById("universalDescText");

function openUniversalPopup(card) {

  /* 🔥 ФІКС: popup бере name, а не displayName */
  const title = card.dataset.popupName || card.dataset.product || "Товар";

  const videoId = card.dataset.videoId || "";
  const sizes = getRealSizes(card);
  const basePrice = card.dataset.price || "";
  const descList = card.dataset.descList || "";
  const descText = card.dataset.descText || "";

  /* ========================= */
  /*   GALLERY DATA (SAFE)     */
  /* ========================= */
  let gallery = [];

  try {
    gallery = JSON.parse(card.dataset.gallery || "[]");
  } catch(e) {
    gallery = [];
  }

  popupVideo.innerHTML = `
    <iframe src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0"
            allow="autoplay; encrypted-media"
            allowfullscreen></iframe>
  `;

  /* ========================= */
  /*   POPUP GALLERY (SAFE)    */
  /* ========================= */
  const popupGallery = document.getElementById("popupGallery");
  const popupGalleryMainImage = document.getElementById("popupGalleryMainImage");
  const popupGalleryThumbs = document.getElementById("popupGalleryThumbs");

 if (popupGallery && popupGalleryMainImage && popupGalleryThumbs) {

  popupGalleryThumbs.innerHTML = "";

  const prevBtn = popupGallery.querySelector(".popup-gallery-prev");
  const nextBtn = popupGallery.querySelector(".popup-gallery-next");

  let currentIndex = 0;
  let touchStartX = 0;

  function showImage(index) {

    if (!gallery[index]) return;

    currentIndex = index;

    popupGalleryMainImage.classList.add("fade-out");

    setTimeout(() => {

      popupGalleryMainImage.src = gallery[index];

      popupGalleryMainImage.classList.remove("fade-out");

    }, 150);

    popupGalleryThumbs
      .querySelectorAll("img")
      .forEach(img => img.classList.remove("active"));

    const activeThumb =
      popupGalleryThumbs.querySelector(`img[data-index="${index}"]`);

    if (activeThumb) {

      activeThumb.classList.add("active");

      activeThumb.scrollIntoView({
        behavior: "smooth",
        block: "nearest",
        inline: "center"
      });
    }
  }

  if (Array.isArray(gallery) && gallery.length > 0) {

    popupGallery.style.display = "block";

    popupGalleryMainImage.src = gallery[0];

    gallery.forEach((photo, index) => {

      const thumb = document.createElement("img");

      thumb.src = photo;
      thumb.dataset.full = photo;
      thumb.dataset.index = index;

      thumb.loading = "lazy";

      if (index === 0) {
        thumb.classList.add("active");
      }

      thumb.addEventListener("click", () => {
        showImage(index);
      });

      popupGalleryThumbs.appendChild(thumb);
    });

    if (prevBtn) {

      prevBtn.onclick = () => {

        let newIndex = currentIndex - 1;

        if (newIndex < 0) {
          newIndex = gallery.length - 1;
        }

        showImage(newIndex);
      };
    }

    if (nextBtn) {

      nextBtn.onclick = () => {

        let newIndex = currentIndex + 1;

        if (newIndex >= gallery.length) {
          newIndex = 0;
        }

        showImage(newIndex);
      };
    }

    popupGalleryMainImage.ontouchstart = (e) => {

      if (!e.touches || !e.touches[0]) return;

      touchStartX = e.touches[0].clientX;
    };

    popupGalleryMainImage.ontouchend = (e) => {

      if (!e.changedTouches || !e.changedTouches[0]) return;

      const touchEndX = e.changedTouches[0].clientX;

      if (touchEndX - touchStartX > 50) {

        let newIndex = currentIndex - 1;

        if (newIndex < 0) {
          newIndex = gallery.length - 1;
        }

        showImage(newIndex);

      } else if (touchStartX - touchEndX > 50) {

        let newIndex = currentIndex + 1;

        if (newIndex >= gallery.length) {
          newIndex = 0;
        }

        showImage(newIndex);
      }
    };

  } else {

    popupGallery.style.display = "none";
  }
}

  popupTitle.textContent = title;

  const subtitle = document.querySelector(".popup-subtitle");
  if (subtitle) {
    subtitle.classList.add("attention-text");
  }

  popupSizeGrid.innerHTML = "";

  if (sizes.trim() !== "") {

    const sizeItems = sizes.split(";").filter(Boolean);

    sizeItems.forEach(item => {

      const parts = item.split("|");

      let label = parts[0] || "";
      const waist = parts[1] || "";
      const hips = parts[2] || "";
      const sizePrice = parts[3] ? parts[3].trim() : basePrice;

      const isDisabled = label.startsWith("!");
      if (isDisabled) {
        label = label.replace(/^!/, "");
      }

      const el = document.createElement("button");
      el.type = "button";
      el.className = "popup-size-card";

      if (isDisabled) {
        el.classList.add("is-disabled");
        el.disabled = true;
      }

      const isDifferent = String(sizePrice) !== String(basePrice);

      el.innerHTML = `
        <h4>${label}</h4>
        <p>
          ${waist ? "Талія: " + waist + " см" : ""}
          ${waist && hips ? " · " : ""}
          ${hips ? "Бедра: " + hips + " см" : ""}
        </p>
        <div class="size-price ${isDifferent ? 'is-different' : ''}">
          ${sizePrice} грн
        </div>
      `;

      if (!isDisabled) {
        el.addEventListener("click", () => {

          const sizeInput = document.getElementById(FORM_SIZE_ID);
          const userSizeInput = document.getElementById(FORM_USER_SIZE_ID);

          if (sizeInput) sizeInput.value = label;
          if (userSizeInput) userSizeInput.value = label;

          const modelInput = document.getElementById("modelInput");
          if (modelInput) modelInput.value = card.dataset.model || "";

          addToCart(card.dataset.product, label, sizePrice, card.dataset.model);

          closeUniversalPopup();

          const formSection = document.getElementById(FORM_SECTION_ID);
          if (formSection) {
            formSection.scrollIntoView({ behavior: "smooth" });
          }
        });
      }

      popupSizeGrid.appendChild(el);
    });

    popupSizeGrid.classList.add("attention");

    setTimeout(() => {
      popupSizeGrid.classList.remove("attention");
    }, 900);
  }

  popupDescList.innerHTML = "";

  if (descList.trim() !== "") {

    descList.split(";").forEach(text => {

      let cleanText = text.trim();

      const li = document.createElement("li");

      if (cleanText.startsWith("[red]")) {
        cleanText = cleanText.replace(/^\[red\]/,'').trim();
        li.classList.add("popup-desc-red");
      }

      li.textContent = cleanText;

      popupDescList.appendChild(li);
    });
  }

  popupDescText.innerHTML = "";

  if (descText.trim() !== "") {

    descText.split(";").forEach(text => {

      const div = document.createElement("div");

      div.textContent = text.trim();

      popupDescText.appendChild(div);
    });
  }

  popup.setAttribute("aria-hidden", "false");
}

function closeUniversalPopup() {

  popup.setAttribute("aria-hidden", "true");

  popupVideo.innerHTML = "";

  /* ========================= */
  /*   GALLERY CLEANUP         */
  /* ========================= */
  const popupGallery = document.getElementById("popupGallery");
  const popupGalleryMainImage = document.getElementById("popupGalleryMainImage");
  const popupGalleryThumbs = document.getElementById("popupGalleryThumbs");

  if (popupGallery) {
    popupGallery.style.display = "none";
  }

  if (popupGalleryMainImage) {
    popupGalleryMainImage.src = "";
  }

  if (popupGalleryThumbs) {
    popupGalleryThumbs.innerHTML = "";
  }

  popupSizeGrid.innerHTML = "";
  popupDescList.innerHTML = "";
  popupDescText.innerHTML = "";
}

  popupCloseTop.addEventListener("click", closeUniversalPopup);
  popupCloseBottom.addEventListener("click", closeUniversalPopup);

  popup.addEventListener("click", (e) => {
    if (e.target === popup) closeUniversalPopup();
  });

  document.addEventListener("keydown", function(e){
    if (e.key === "Escape" && popup.getAttribute("aria-hidden") === "false")
      closeUniversalPopup();
  });

  document.querySelectorAll(".product-video").forEach(video => {
    video.addEventListener("click", function () {
      const card = this.closest(".product-card");
      openUniversalPopup(card);
    });
  });

  document.querySelectorAll(".product-details-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      const card = this.closest(".product-card");
      openUniversalPopup(card);
    });
  });

})();
</script>
<style>
/* базова ціна */
.size-price{
  margin-top:4px;
  font-size:0.95rem;
  font-weight:900;
  color:#2e2e2e;
}

/* якщо ціна відрізняється від базової */
.size-price.is-different{
  color:#d60000;
}

/* === ПІДСВІТКА СІТКИ РОЗМІРІВ === */
.popup-size-grid.attention{
  animation: gridGlow 0.9s ease-in-out;
}

/* мʼякий glow */
@keyframes gridGlow{
  0%{
    box-shadow: 0 0 0 rgba(255,204,0,0);
    transform: scale(1);
  }
  50%{
    box-shadow: 0 0 18px rgba(255,204,0,0.6);
    transform: scale(1.02);
  }
  100%{
    box-shadow: 0 0 0 rgba(255,204,0,0);
    transform: scale(1);
  }
}

</style>
<!-- ============================================== -->
<!--   SIZE DISABLE PATCH (!size = закінчився)      -->
<!--   SAFE: не змінює твій основний popup          -->
<!-- ============================================== -->

<style>
/* ============================================== */
/*   ВИМКНЕНИЙ РОЗМІР — ЧІТКИЙ DISABLED           */
/* ============================================== */


.popup-size-card.is-disabled{
  opacity:.5;
  filter:grayscale(100%);
  cursor:not-allowed;
  position:relative;
  pointer-events:none;

  /* 🔥 ГОЛОВНИЙ ФІКС — місце під бейдж */
  padding-bottom:22px;
}

/* напис завжди видимий */
.popup-size-card.is-disabled::after{
  content:"Закінчився";
  position:absolute;
  left:6px;
  right:6px;
  bottom:6px;

  font-size:10px;
  font-weight:700;
  text-align:center;

  background:#e74c3c;
  color:#fff;
  padding:3px 6px;
  border-radius:6px;

  line-height:1.1;
}

</style>



<!-- ============================================== -->
<!--   RED TEXT PATCH ДЛЯ data-desc-list            -->
<!-- ============================================== -->

<style>
/* червоний пункт списку */
.popup-desc-red{
  color:#e53935;
  font-weight:700;
}
</style>





<!-- ========================== -->
<!--         ПЕРЕВАГИ           -->
<!-- ========================== -->
<section class="section advantages" id="about">

  <h2>Чому саме у нас?</h2>

  <div class="features">
    <div class="feature">✔ 🔥 <strong>Досвід та надійність</strong> – продаємо джинси вже понад 5 років</div>
    <div class="feature">✔ 🔥 <strong>Довіра клієнтів</strong> – більше ніж 50 000 реальних відгуків</div>
    <div class="feature">✔ 🔥 <strong>Якість понад усе</strong> – працюємо лише з перевіреними виробниками</div>
    <div class="feature">✔ 🔥 <strong>Зручний обмін та повернення</strong> – покупки без ризику</div>
     <div class="feature"><a href="obmin-povernennya.html"><strong> Умови обміну і повернення </strong></a></div>
  </div>

</section>

<style>
/* =============================== */
/*        ПЕРЕВАГИ                 */
/*   стиль як product-advantages   */
/* =============================== */

/* Локально стискаємо відступ зверху */
.section.advantages {
  margin-top: 24px;
  padding-top: 0 !important;
}

/* Заголовок */
.advantages h2 {
  font-size: 2rem;
  font-weight: 800;
  text-align: center;
  margin: 0 0 24px;
  letter-spacing: 0.3px;
  color: #111;
}

/* Контейнер */
.advantages .features {
  display: flex;
  flex-direction: column;
  gap: 14px;
  max-width: 800px;
  margin: 0 auto;
}

/* Картка */
.advantages .feature {
  font-size: 1.2rem;
  font-weight: 600;
  color: #333;
  background: #ffffff;
  padding: 14px 20px;
  border-radius: 14px;
  box-shadow:
    0 4px 10px rgba(0, 0, 0, 0.08),
    0 1px 2px rgba(0, 0, 0, 0.05);
}

/* ❗ Без CSS-галочок */
.advantages .feature::before {
  display: none;
}
/* ================= CTA BUTTON — ОБМІН (LIGHT) ================= */
.feature{
  text-align:center; /* центр блоку */
}

.feature a{
  display:inline-block;
  padding:14px 26px;
  border-radius:12px;
  background:#65664a;
  color:#111 !important;
  text-decoration:none;
  font-weight:700;
  letter-spacing:.3px;
  border:1px solid #e9e9e9;

  /* біла обводка тексту */
  text-shadow:
    -1px -1px 0 #fff,
     1px -1px 0 #fff,
    -1px  1px 0 #fff,
     1px  1px 0 #fff;

  /* світло-сіра м’яка тінь */
  box-shadow:0 10px 24px rgba(0,0,0,.08);

  transition:all .25s ease;
  position:relative;

  /* легка пульсація */
  animation:mriyaPulseLight 2.4s ease-in-out infinite;
}

/* hover — преміум підйом */
.feature a:hover{
  transform:translateY(-2px);
  box-shadow:0 16px 34px rgba(0,0,0,.12);
}
/* м’яка світла пульсація */
@keyframes mriyaPulseLight{
  0%{
    box-shadow:0 10px 24px rgba(0,0,0,.08);
  }
  50%{
    box-shadow:0 12px 30px rgba(0,0,0,.14);
  }
  100%{
    box-shadow:0 10px 24px rgba(0,0,0,.08);
  }
}

/* мобілка */
@media (max-width:768px){
  .feature a{
    padding:13px 20px;
    font-size:14px;
  }
}
/* =============================== */
/*        МОБІЛЬНА ВЕРСІЯ          */
/* =============================== */
@media (max-width: 768px) {

  .section.advantages {
    margin-top: 16px;
  }

  .advantages h2 {
    font-size: 1.6rem;
    margin-bottom: 18px;
  }

  .advantages .features {
    gap: 10px;
    padding: 0 12px;
  }

  .advantages .feature {
    font-size: 1.05rem;
    padding: 12px 14px;
    line-height: 1.35;
    border-radius: 12px;
  }
}
</style>




<!-- 🔹 ФОТОВІДГУКИ -->
<section class="reviews">
  <h2>📸 Фотовідгуки</h2>

  <!-- Галерея з автоперемиканням, оптимізацією та без автоскролу -->
<div class="custom-gallery" style="width:100%; max-width:1000px; margin:20px auto; font-family:Arial,sans-serif;">
  <style>
    .custom-gallery .main-image-container {
      position: relative;
      height: 60vh;
      overflow: hidden;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      background: #f0f0f0;
      touch-action: pan-y;
    }
    .custom-gallery .main-image-container img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      border-radius: 15px;
      transition: opacity 0.3s, transform 0.3s;
      opacity: 1;
    }
    .custom-gallery .main-image-container img.fade-out {
      opacity: 0;
    }
    .custom-gallery .main-image-container img:hover {
      transform: scale(1.02);
    }
    @media (min-width: 1024px) {
      .custom-gallery .main-image-container {
        height: min(90vh, 900px);
      }
    }

    .custom-gallery .nav-button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0,0,0,0.5);
      color: #fff;
      border: none;
      font-size: 2rem;
      padding: 0.3em 0.6em;
      cursor: pointer;
      z-index: 10;
      border-radius: 50%;
      transition: background 0.3s;
    }
    .custom-gallery .nav-button:hover {
      background: rgba(0,0,0,0.8);
    }
    .custom-gallery .nav-left { left: 10px; }
    .custom-gallery .nav-right { right: 10px; }

    .custom-gallery .gallery-thumbs {
      display: flex;
      overflow-x: auto;
      margin-top: 15px;
      padding-bottom: 10px;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
    }
    .custom-gallery .gallery-thumbs img {
      width: auto;
      max-height: 60px;
      margin-right: 8px;
      cursor: pointer;
      border-radius: 10px;
      border: 2px solid transparent;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      transition: border 0.2s, transform 0.2s, box-shadow 0.2s, filter 0.2s;
      flex-shrink: 0;
    }
    .custom-gallery .gallery-thumbs img:hover {
      transform: scale(1.1);
    }
    .custom-gallery .gallery-thumbs img.active {
      border-color: #007BFF;
      transform: scale(1.05);
      box-shadow: 0 6px 18px rgba(0,0,0,0.25);
      filter: brightness(1.1);
    }
    .custom-gallery .gallery-thumbs::-webkit-scrollbar {
      display: none;
    }
  </style>

  <div class="main-image-container">
    <button class="nav-button nav-left">&#10094;</button>
    <img id="customMainImage" src="images/Vidhuk1.webp" alt="Головне фото" loading="lazy">
    <button class="nav-button nav-right">&#10095;</button>
  </div>

  <div class="gallery-thumbs" id="customThumbnails">
    <img src="images/Vidhuk1.webp" loading="lazy" data-full="images/Vidhuk1.webp" class="active" />
    <img src="images/Vidhuk2.webp" loading="lazy" data-full="images/Vidhuk2.webp" />
    <img src="images/Vidhuk3.webp" loading="lazy" data-full="images/Vidhuk3.webp" />
    <img src="images/Vidhuk4.webp" loading="lazy" data-full="images/Vidhuk4.webp" />
    <img src="images/Vidhuk5.webp" loading="lazy" data-full="images/Vidhuk5.webp" />
    <img src="images/Vidhuk6.webp" loading="lazy" data-full="images/Vidhuk6.webp" />
    <img src="images/Vidhuk7.webp" loading="lazy" data-full="images/Vidhuk7.webp" />
    <img src="images/Vidhuk8.webp" loading="lazy" data-full="images/Vidhuk8.webp" />
    <img src="images/Vidhuk9.webp" loading="lazy" data-full="images/Vidhuk9.webp" />
    <img src="images/Vidhuk10.webp" loading="lazy" data-full="images/Vidhuk10.webp" />
    <img src="images/Vidhuk11.webp" loading="lazy" data-full="images/Vidhuk11.webp" />
    <img src="images/Vidhuk12.webp" loading="lazy" data-full="images/Vidhuk12.webp" />
    <img src="images/Vidhuk13.webp" loading="lazy" data-full="images/Vidhuk13.webp" />
    <img src="images/Vidhuk14.webp" loading="lazy" data-full="images/Vidhuk14.webp" />
    <img src="images/Vidhuk15.webp" loading="lazy" data-full="images/Vidhuk15.webp" />
    <img src="images/Vidhuk16.webp" loading="lazy" data-full="images/Vidhuk16.webp" />
    <img src="images/Vidhuk17.webp" loading="lazy" data-full="images/Vidhuk17.webp" />
    <img src="images/2MOMDEKOR .webp" loading="lazy" data-full="images/2MOMDEKOR .webp" />
    <img src="images/3MOMDEKOR .webp" loading="lazy" data-full="images/3MOMDEKOR .webp" />
    <img src="images/4MOMDEKOR .webp" loading="lazy" data-full="images/4MOMDEKOR .webp" />
    <img src="images/K2.webp" loading="lazy" data-full="images/K2.webp" />
    <img src="images/K3.webp" loading="lazy" data-full="images/K3.webp" />
    <img src="images/K4.webp" loading="lazy" data-full="images/K4.webp" />
    <img src="images/K5.webp" loading="lazy" data-full="images/K5.webp" />
    <img src="images/K6.webp" loading="lazy" data-full="images/K6.webp" />
    <img src="images/K7.webp" loading="lazy" data-full="images/K7.webp" />
    <img src="images/K8.webp" loading="lazy" data-full="images/K8.webp" />
    <img src="images/K9.webp" loading="lazy" data-full="images/K9.webp" />
    <img src="images/K10.webp" loading="lazy" data-full="images/K10.webp" />
    <img src="images/K11.webp" loading="lazy" data-full="images/K11.webp" />
    <img src="images/K12.webp" loading="lazy" data-full="images/K12.webp" />
    <img src="images/K13.webp" loading="lazy" data-full="images/K13.webp" />
    <img src="images/K14.webp" loading="lazy" data-full="images/K14.webp" />
    <img src="images/K15.webp" loading="lazy" data-full="images/K15.webp" />
    <img src="images/K16.webp" loading="lazy" data-full="images/K16.webp" />
    <img src="images/K17.webp" loading="lazy" data-full="images/K17.webp" />
  </div>

  <script>
    (function() {
      const mainImage = document.getElementById('customMainImage');
      const thumbnails = document.querySelectorAll('#customThumbnails img');
      const leftBtn = document.querySelector('.custom-gallery .nav-left');
      const rightBtn = document.querySelector('.custom-gallery .nav-right');

      let currentIndex = 0;
      let galleryVisible = false;

      // Ледаче підвантаження великого фото
      function loadFullImage(img) {
        const full = img.dataset.full;
        if (mainImage.src !== full) {
          mainImage.src = full;
        }
      }

      function showImage(index, auto = false) {
        const thumbnail = thumbnails[index];
        mainImage.classList.add('fade-out');

        setTimeout(() => {
          loadFullImage(thumbnail);
          mainImage.classList.remove('fade-out');
        }, 200);

        thumbnails.forEach(img => img.classList.remove('active'));
        thumbnail.classList.add('active');
        currentIndex = index;

        // Прокрутка тільки вручну
        if (!auto) {
          thumbnail.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
      }

      thumbnails.forEach((thumb, idx) => {
        thumb.addEventListener('click', () => showImage(idx));
      });

      leftBtn.addEventListener('click', () => {
        let newIndex = currentIndex - 1;
        if (newIndex < 0) newIndex = thumbnails.length - 1;
        showImage(newIndex);
      });

      rightBtn.addEventListener('click', () => {
        let newIndex = currentIndex + 1;
        if (newIndex >= thumbnails.length) newIndex = 0;
        showImage(newIndex);
      });

      // Свайп для мобільних
      let startX = 0;
      mainImage.addEventListener('touchstart', e => startX = e.touches[0].clientX);
      mainImage.addEventListener('touchend', e => {
        let endX = e.changedTouches[0].clientX;
        if (endX - startX > 50) leftBtn.click();
        else if (startX - endX > 50) rightBtn.click();
      });

      // Перевірка — чи видно галерею
      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          galleryVisible = entry.isIntersecting;
        });
      }, { threshold: 0.3 });

     const container = document.querySelector('.main-image-container');
if (container) {
  observer.observe(container);
}
      // Автоперемикання тільки коли видно галерею
      // setInterval(() => {
      //   if (!galleryVisible) return;

      //   let newIndex = currentIndex + 1;
      //   if (newIndex >= thumbnails.length) newIndex = 0;
      //   showImage(newIndex, true);
      // }, 7000);
    })();
  </script>
</div>


  <div class="slider">
    <button class="prev">❮</button>

    <div class="slides">
      <img alt="Відгук 1" loading="lazy" src="images/ВІдгук 1.webp"/>
      <img alt="Відгук 2" loading="lazy" src="images/ВІдгук2.webp"/>
      <img alt="Відгук 3" loading="lazy" src="images/ВІдгук3.webp"/>
      <img alt="Відгук 4" loading="lazy" src="images/ВІдгук4.webp"/>
      <img alt="Відгук 5" loading="lazy" src="images/ВІдгук5.webp"/>
      <img alt="Відгук 6" loading="lazy" src="images/ВІдгук6.webp"/>
      <img alt="Відгук 7" loading="lazy" src="images/ВІдгук7.webp"/>
      <img alt="Відгук 8" loading="lazy" src="images/ВІдгук8.webp"/>
      <img alt="Відгук 9" loading="lazy" src="images/ВІдгук9.webp"/>
      <img alt="Відгук 10" loading="lazy" src="images/ВІдгук10.webp"/>
    </div>

    <button class="next">❯</button>
  </div>
</section>

<style>
/* ===================== */
/* 🔹 ФОТОВІДГУКИ        */
/* ===================== */

.reviews {
  background: linear-gradient(135deg, #f9f9f9, #ececec);
  padding: 40px 20px;
  border-radius: 16px;
  box-shadow: 0 6px 16px rgba(0,0,0,0.08);
  max-width: 1000px;
  margin: 40px auto;
  text-align: center;
}

.reviews h2 {
  font-size: 1.8rem;
  margin-bottom: 20px;
  color: #2c2c2c;
}

.slider {
  position: relative;
  overflow: hidden;
}

.slides {
  display: flex;
  transition: transform 0.5s ease;
}

.slides img {
  min-width: 100%;
  max-width: 100%;
  border-radius: 16px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  object-fit: cover;
}

/* Кнопки */
.prev,
.next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255,87,34,0.8);
  color: #fff;
  border: none;
  padding: 12px 16px;
  border-radius: 50%;
  cursor: pointer;
  font-size: 20px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.prev { left: 10px; }
.next { right: 10px; }

.prev:hover,
.next:hover {
  background: #e64a19;
}

/* ПК – показує по 3 фото */
@media (min-width: 768px) {
  .slides img {
    min-width: 33.33%;
    max-width: 33.33%;
  }
}


</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelector(".slides");
  const images = document.querySelectorAll(".slides img");
  const prev = document.querySelector(".prev");
  const next = document.querySelector(".next");

  let index = 0;

  function showSlide() {
    const slideWidth = images[0].clientWidth;
    slides.style.transform = `translateX(${-index * slideWidth}px)`;
  }

  function nextSlide() {
    index = (index + 1) % images.length;
    showSlide();
  }

  function prevSlide() {
    index = (index - 1 + images.length) % images.length;
    showSlide();
  }

  next.addEventListener("click", () => {
    nextSlide();
    resetAutoSlide();
  });

  prev.addEventListener("click", () => {
    prevSlide();
    resetAutoSlide();
  });

  window.addEventListener("resize", showSlide);

  /* Автоперегортання */
  let autoSlide = setInterval(nextSlide, 3000);

  function resetAutoSlide() {
    clearInterval(autoSlide);
    autoSlide = setInterval(nextSlide, 3000);
  }
});
</script>

<!-- 🔹 СОЦМЕРЕЖІ -->
<section class="social-widgets">
  <h2>🌐 Наші соцмережі</h2>
  <p>✅ «Хочеш бачити більше? Клікай і читай відгуки та новини»</p>

  <div class="social-icons">
    <a class="social-card" href="https://www.instagram.com/mriya_jeans?igsh=MTQxZXByeWQ4OWVjbQ==" target="_blank" rel="noopener">
      <span class="label">Instagram</span>
      <img alt="Instagram 1" loading="lazy" src="images/photo_3 інстар1.webp">
    </a>

    <a class="social-card" href="https://www.instagram.com/mriya_jeans_?igsh=MWRkcXF0b29jbWhqbQ==" target="_blank" rel="noopener">
      <span class="label">Instagram</span>
      <img alt="Instagram 2" loading="lazy" src="images/photo_2_Інстаграм 2.webp">
    </a>

    <a class="social-card" href="https://www.facebook.com/share/16debzFRUq/?mibextid=wwXIfr" target="_blank" rel="noopener">
      <span class="label">Facebook</span>
      <img alt="Facebook" loading="lazy" src="images/photo_1 Faceb.webp">
    </a>
  </div>
</section>

<style>
/* =============================== */
/* 🔹 СОЦМЕРЕЖІ                    */
/* =============================== */

.social-widgets {
  background: linear-gradient(135deg, #f9f9f9, #ececec);
  padding: 30px 15px;
  border-radius: 16px;
  box-shadow: 0 6px 16px rgba(0,0,0,0.08);
  max-width: 1000px;
  margin: 30px auto;
  text-align: center;
}

.social-widgets h2 {
  font-size: 1.6rem;
  margin-bottom: 8px;
  color: #2c2c2c;
}

.social-widgets p {
  font-size: 0.95rem;
  margin-bottom: 20px;
  color: #444;
}

/* 🔥 РІВНОМІРНА СІТКА */
.social-icons {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 15px;
}

/* Картка */
.social-card {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.12);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.social-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.social-card .label {
  position: absolute;
  top: 8px;
  left: 8px;
  background: rgba(0,0,0,0.6);
  color: #fff;
  font-size: 0.9rem;
  padding: 4px 8px;
  border-radius: 6px;
  font-weight: 600;
}

.social-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 22px rgba(0,0,0,0.2);
}

/* 📱 МОБІЛЬНА */
@media (max-width: 768px) {
  .social-icons {
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
  }

  .social-widgets {
    padding: 20px 10px;
    margin: 20px auto;
  }

  .social-widgets h2 {
    font-size: 1.3rem;
  }

  .social-widgets p {
    font-size: 0.85rem;
    margin-bottom: 15px;
  }

  .social-card .label {
    font-size: 0.7rem;
    padding: 3px 6px;
  }
}
</style>



<section class="order">
  <h2 class="title"><span>Як замовити</span></h2>
  <div class="order--list">
    <div class="order--item">
      <div class="icon-wrapper">
        <img src="images/order_steps__step1_icon.png" alt="Крок 1">
      </div>
      <h4>Заявка</h4>
      <p>Залишаєте заявку на сайті</p>
    </div>
    <div class="order--item">
      <div class="icon-wrapper">
        <img src="images/order_steps__step2_icon.png" alt="Крок 2">
      </div>
      <h4>Дзвінок</h4>
      <p>Наш менеджер уточнить деталі замовлення</p>
    </div>
    <div class="order--item">
      <div class="icon-wrapper">
        <img src="images/order_steps__step3_icon.png" alt="Крок 3">
      </div>
      <h4>Відправка</h4>
      <p>Доставляємо ваш товар на протязі<br>1-2 дні</p>
    </div>
    <div class="order--item">
      <div class="icon-wrapper">
        <img src="images/order_steps__step4_icon.png" alt="Крок 4">
      </div>
      <h4>Отримання</h4>
      <p>Оплачуєте при отриманні на пошті, або на реквізити ФОП</p>
    </div>
  </div>
</section>

<style>
.order {
  max-width: 1200px;
  margin: 4rem auto;
  padding: 0 1rem;
  text-align: center;
}

.order .title {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 3rem;
}

.order .title span {
  color: #6b705c; /* акцент */
}

.order--list {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 2rem;
  position: relative;
}

.order--list::before {
  content: '';
  position: absolute;
  top: 50px;
  left: 5%;
  width: 90%;
  height: 4px;
  background: #e0e0e0;
  z-index: 0;
  border-radius: 2px;
}

.order--item {
  background: #fff;
  border-radius: 1.5rem;
  padding: 2rem 1.5rem;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  flex: 1 1 220px;
  max-width: 260px;
  position: relative;
  z-index: 1;
}

.order--item:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

.icon-wrapper {
  width: 80px;
  height: 80px;
  margin: 0 auto 1.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f5f5f5;
  border-radius: 50%;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.order--item img {
  max-width: 50%;
  height: auto;
}

.order--item h4 {
  font-size: 1.3rem;
  font-weight: 600;
  margin-bottom: 0.8rem;
  color: #333;
}

.order--item p {
  font-size: 1rem;
  color: #666;
  line-height: 1.5;
}

/* ==============================
   ORDER — MOBILE ONLY
   ============================== */
@media (max-width: 768px) {

  .order--list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    justify-items: stretch;
    position: relative;
  }

  .order--list::before {
    display: none;
  }

  .order--item {
    width: auto;
    max-width: none;
    padding: 1.2rem 0.8rem;
    border-radius: 1.3rem;
    position: relative;
    box-shadow:
      0 6px 14px rgba(0,0,0,0.08),
      0 2px 6px rgba(0,0,0,0.04);
  }

  .icon-wrapper {
    width: 50px;
    height: 50px;
    margin-bottom: 0.8rem;
  }

  .order--item h4 {
    font-size: 1rem;
    margin-bottom: 0.4rem;
  }

  .order--item p {
    font-size: 0.85rem;
    line-height: 1.3;
  }

  .order .title {
    font-size: 1.4rem;
    margin-bottom: 2rem;
  }

  /* ➜ стрілки */
  .order--item:nth-child(1)::after,
  .order--item:nth-child(3)::after {
    content: "➜";
    position: absolute;
    top: 50%;
    right: -18px;
    transform: translateY(-50%);
    font-size: 22px;
    color: #bbb;
    pointer-events: none;
  }

  .order--item:nth-child(2)::after {
    content: "↓";
    position: absolute;
    bottom: -26px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 22px;
    color: #bbb;
    pointer-events: none;
  }

  .order--item:nth-child(4)::after {
    content: none;
  }
}

</style>

<!-- ========================== -->
<!--        КОШИК ВИБОРУ        -->
<!-- ========================== -->
<div id="cartBox" class="cart-box">
  <h3 class="cart-title">👜 Ваш вибір</h3>

  <div id="cartSummary" class="cart-summary"></div>

  <div id="cartItems" class="cart-items"></div>
  <div id="cartEmpty" class="cart-empty">Нічого не вибрано</div>
</div>

<style>
/* =============================== */
/*            КОШИК                */
/* =============================== */
.cart-box {
  background: #ffffff;
  border-radius: 14px;
  padding: 16px 18px;
  margin: 40px auto;
  max-width: 680px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.06);
  font-family: Inter, system-ui, Arial;
}

.cart-title {
  font-size: 20px;
  font-weight: 800;
  text-align: center;
  margin-bottom: 10px;
}

.cart-empty {
  text-align: center;
  padding: 14px 0;
  font-weight: 600;
  color: #777;
}

.cart-items {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.cart-item {
  background: #fff;
  border-radius: 12px;
  padding: 12px;
  box-shadow: 0 4px 14px rgba(0,0,0,0.08);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.cart-item-info {
  font-size: 15px;
  font-weight: 700;
  color: #333;
}

.cart-item-remove {
  background: #ff5c5c;
  color: #fff;
  border: none;
  border-radius: 50px;
  padding: 6px 14px;
  font-size: 13px;
  cursor: pointer;
  font-weight: 700;
  transition: 0.18s ease;
  line-height: 1;
}

.cart-item-remove:hover {
  background: #e04444;
  transform: translateY(-1px);
}

@media (max-width: 460px) {
  .cart-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 6px;
  }

  .cart-item-remove {
    width: 100%;
    text-align: center;
  }
}

.cart-summary {
  text-align: center;
  font-size: 17px;
  font-weight: 900;
  margin-top: 14px;
  padding: 10px 0;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.06);
}
</style>

<script>
/* ========================================================= */
/*                  МОДУЛЬ КОШИКА (SAFE)                     */
/* ========================================================= */

let cart = [];

/* ДОДАТИ В КОШИК */
function addToCart(productName, size, price, modelCode) {
  const existing = cart.find(item => item.model === modelCode);

  if (existing) {
    existing.size = size;
  } else {
    cart.push({
      name: productName,
      size: size,
      price: price,
      model: modelCode
    });
  }

  updateCartUI();
  updateCommentField();
  updateOrderSource();
}

/* ВИДАЛИТИ З КОШИКА */
function removeFromCart(modelCode) {
  cart = cart.filter(item => item.model !== modelCode);
  updateCartUI();
  updateCommentField();
  updateOrderSource();
}

/* ОНОВИТИ UI КОШИКА */
function updateCartUI() {
  const itemsBox = document.getElementById("cartItems");
  const emptyBox = document.getElementById("cartEmpty");
  const summaryBox = document.getElementById("cartSummary");

  itemsBox.innerHTML = "";
  summaryBox.textContent = "";

  if (!cart.length) {
    emptyBox.style.display = "block";
    return;
  }

  emptyBox.style.display = "none";

  cart.forEach(item => {
    const div = document.createElement("div");
    div.className = "cart-item";

    div.innerHTML = `
      <div class="cart-item-info">
        👖 ${item.name} / ${item.size} / ${item.price} грн
      </div>
      <button class="cart-item-remove" onclick="removeFromCart('${item.model}')">
        Видалити
      </button>
    `;

    itemsBox.appendChild(div);
  });

  const total = cart.reduce((sum, item) => sum + Number(item.price), 0);
  summaryBox.textContent = total > 0 ? `Загальна сума: ${total} грн` : "";
}

/* user_comment ДЛЯ CRM */
function updateCommentField() {
  const commentField = document.querySelector("textarea[name='user_comment'], input[name='user_comment']");
  if (!commentField) return;

  commentField.value = cart
    .map(item => `${item.name} / ${item.size} / ${item.price} грн / ${item.model}`)
    .join("; ");
}

/* order_source */
function updateOrderSource() {
  const orderSource = document.getElementById("orderSource");
  if (!orderSource) return;

  const headerProduct = document.getElementById("sizeInput")?.value || "";

  if (cart.length === 0) {
    orderSource.value = "header";
  } else if (cart.length > 0 && headerProduct !== "") {
    orderSource.value = "both";
  } else {
    orderSource.value = "catalog";
  }
}
</script>
<script>
/* ========================================================= */
/*   SESSION STORAGE ДЛЯ КОШИКА (SAFE, ТІЛЬКИ НА СЕСІЮ)     */
/* ========================================================= */

(function(){

  const STORAGE_KEY = "mriya_cart_session";

  /* --- зберігаємо кошик у sessionStorage --- */
  function saveCartToSession() {
    try {
      sessionStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
    } catch (e) {
      console.warn("SessionStorage недоступний", e);
    }
  }

  /* --- відновлюємо кошик при завантаженні --- */
  function restoreCartFromSession() {
    try {
      const saved = sessionStorage.getItem(STORAGE_KEY);
      if (saved) {
        const parsed = JSON.parse(saved);
        if (Array.isArray(parsed)) {
          cart = parsed;
          updateCartUI();
          updateCommentField();
          updateOrderSource();
        }
      }
    } catch (e) {
      console.warn("Помилка відновлення sessionStorage", e);
    }
  }

  /* --- перехоплюємо оновлення кошика --- */
  const originalUpdateCartUI = updateCartUI;

  updateCartUI = function() {
    originalUpdateCartUI();
    saveCartToSession();
  };

  /* --- відновлюємо одразу після завантаження --- */
  document.addEventListener("DOMContentLoaded", function(){
    restoreCartFromSession();
  });

})();
</script>

<!-- 🔹 Сучасна форма -->
<section class="form-section" id="formSection">
  <h2 class="form-title">Залиш заявку тут – ми передзвонимо за 5 хвилин.</h2>
  <p id="chosenSizeText" class="chosen-size"></p>

  <form action="post.php" method="post" class="modern-form">

    <!-- Ім’я -->
    <div class="input-icon">
      <span class="icon">👤</span>
      <input name="name" placeholder="Ваше ім’я" required type="text">
    </div>

    <!-- Телефон -->
    <div class="input-icon">
      <span class="icon">📞</span>
      <input name="phone" placeholder="Ваш телефон" required type="tel">
    </div>

    <!-- Розмір -->
    <div class="input-icon">
      <span class="icon">👖</span>
      <textarea id="userSizeInput" 
          name="user_size" 
          placeholder="Ваш розмір або коментар до замовлення" 
          required></textarea>
    </div>

    <!-- ================== ПРИХОВАНІ ПОЛЯ (hidden) ================== -->

    <input type="hidden" name="city" value="">
    <input type="hidden" name="nova_poshta" value="">

    <!-- Передзвонити (за замовчуванням = Так) -->
    <input type="hidden" name="call_back" value="Так">

<!-- Місто -->
    <!-- <div class="input-icon">
      <span class="icon">🏙️</span>
      <input name="city" placeholder="Місто" type="text">
    </div>
 -->
    <!-- Відділення НП -->
  <!--   <div class="input-icon">
      <span class="icon">📦</span>
      <input name="nova_poshta" placeholder="Відділення Нової пошти" type="text">
    </div> -->

    <!-- Передзвонити -->
    <!-- <div class="callback-block">
      <p class="callback-title">📲 Передзвонити Вам?</p>
      <div class="callback-options">
        <label class="callback-option">
          <input type="radio" name="call_back" value="Так">
          <span class="custom-box"></span> Так
        </label>
        <label class="callback-option">
          <input type="radio" name="call_back" value="Ні">
          <span class="custom-box"></span> Ні
        </label>
      </div>
    </div> -->

    <!-- Hidden -->
    <input name="product_name" type="hidden" value=":">
    <input id="sizeInput" name="size" type="hidden">

    <!-- 🔥 ДОДАНО: ОСНОВНИЙ ТОВАР САЙТУ (ТУТ МІНЯЄШ ВРУЧНУ!) -->
    <!-- ❗ ЦЕ НЕ ЗАЛЕЖИТЬ ВІД ВИБОРУ КЛІЄНТА — ЛИШЕ ВІД САЙТУ -->
    <!-- ❗ ТУТ ВСТАВЛЯЄШ НАЗВУ ГОЛОВНОГО ТОВАРУ, ЯКИЙ У ТЕБЕ В ХЕДЕРІ -->
    <input type="hidden" name="header_product" value=" Магазин ">

    <!-- 🔥 ДОДАНО ДЛЯ КОШИКА + CRM -->
    <input type="hidden" name="user_comment" id="userComment">

    <!-- 🔥 НОВЕ: СУМА КОШИКА ДЛЯ CRM -->
    <!-- Якщо 0 → у PHP буде "Консультація" -->
    <input type="hidden" name="cart_total" id="cartTotal" value="0">

    <!-- 🔥 order_source: header / catalog / both -->
    <input type="hidden" name="order_source" id="orderSource" value="header">

    <!-- 🔥 НАЗВА САЙТУ (МІНЯЄШ ВРУЧНУ ПІД КОЖЕН САЙТ) -->
    <input type="hidden" name="site_name" value="Magazin">

    <!-- Кнопка -->
    <button type="submit" class="submit-btn">Надіслати</button>

  </form>
</section>

<script>
/* ====================================== */
/*  ОНОВЛЕННЯ СУМИ КОШИКА ДЛЯ CRM (SAFE) */
/* ====================================== */

/* Функція записує загальну суму кошика у hidden поле */
function updateCartTotalField() {

  const totalField = document.getElementById("cartTotal");
  if (!totalField) return;

  if (typeof cart === "undefined") {
    totalField.value = 0;
    return;
  }

  const total = cart.reduce((sum, item) => sum + Number(item.price), 0);
  totalField.value = total > 0 ? total : 0;
}

/* Акуратно підключаємо до існуючого updateCartUI */
if (typeof updateCartUI === "function") {

  const originalUpdateCartUI = updateCartUI;

  updateCartUI = function() {
    originalUpdateCartUI();
    updateCartTotalField();
  };

}
</script>



<style>

  .input-icon textarea{
  border:none;
  outline:none;
  flex:1;
  font-size:1rem;
  resize:none;
  min-height:40px;
  font-family:inherit;
}
.form-section{
  background:linear-gradient(135deg,#ffecd2,#fcb69f);
  padding:2rem;
  border-radius:1.5rem;
  max-width:400px;
  margin:2rem auto;
  box-shadow:0 8px 20px rgba(0,0,0,.15)
}

.form-title{
  text-align:center;
  font-size:1.4rem;
  margin-bottom:1rem;
  font-weight:700
}

.chosen-size{
  text-align:center;
  color:#ff5722;
  font-weight:500;
  display:none;
  margin-bottom:12px
}

.modern-form{display:flex;flex-direction:column;gap:1rem}

.input-icon{
  display:flex;
  align-items:center;
  background:#fff;
  border-radius:.75rem;
  padding:.75rem 1rem;
  box-shadow:0 2px 6px rgba(0,0,0,.05)
}

.input-icon span{margin-right:.5rem;font-size:1.2rem}

.input-icon input{
  border:none;
  outline:none;
  flex:1;
  font-size:1rem
}

.submit-btn{
  background:#ff5722;
  color:#fff;
  border:none;
  padding:.8rem;
  border-radius:.75rem;
  font-size:1rem;
  font-weight:600;
  cursor:pointer
}

.submit-btn:disabled{opacity:.7}

.callback-block{margin-top:.5rem;text-align:center}
.callback-title{font-weight:600;margin-bottom:.5rem}
.callback-options{display:flex;justify-content:center;gap:1.5rem}

.callback-option{
  display:flex;
  align-items:center;
  gap:.4rem;
  cursor:pointer
}

.callback-option input{display:none}

.custom-box{
  width:18px;
  height:18px;
  border:2px solid #333;
  border-radius:4px;
  position:relative
}

.callback-option input:checked+.custom-box::after{
  content:"✔";
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-55%);
  font-size:14px;
  color:#4CAF50
}
</style>


<script>
document.addEventListener("DOMContentLoaded", () => {

  const radios = document.querySelectorAll('input[name="size"]');
  const hiddenSizeInput = document.getElementById("sizeInput");
  const userSizeInput = document.getElementById("userSizeInput");
  const chosenSizeText = document.getElementById("chosenSizeText");
  const formSection = document.getElementById("formSection");
  const form = document.querySelector(".modern-form");
  const submitBtn = form ? form.querySelector(".submit-btn") : null;

  // 🔹 Скрол + підстановка після вибору розміру
  radios.forEach((radio) => {
    radio.addEventListener("change", () => {

      const sizeValue = radio.value;

      if (hiddenSizeInput) hiddenSizeInput.value = sizeValue;
      if (userSizeInput) userSizeInput.value = sizeValue;

      if (chosenSizeText) {
        chosenSizeText.textContent = `Ви обрали розмір: ${sizeValue}`;
        chosenSizeText.style.display = "block";
      }

      if (formSection) {
        const offsetTop =
          formSection.getBoundingClientRect().top + window.scrollY - 20;

        window.scrollTo({
          top: offsetTop,
          behavior: "smooth"
        });
      }

    });
  });

  // 🔹 GET параметри (product / code / size)
  const urlParams = new URLSearchParams(window.location.search);
  const product = urlParams.get("product");
  const code = urlParams.get("code");
  const size = urlParams.get("size");

  if (product && code && size) {

    const productInput = document.querySelector('input[name="product_name"]');

    if (chosenSizeText) {
      chosenSizeText.textContent = `Ви обрали: ${product} (Модель №${code}), розмір: ${size}`;
      chosenSizeText.style.display = "block";
    }

    if (userSizeInput) userSizeInput.value = size;
    if (hiddenSizeInput) hiddenSizeInput.value = size;
    if (productInput) {
      productInput.value = `${product} (Модель №${code})`;
    }

    const newURL = window.location.origin + window.location.pathname;
    window.history.replaceState({}, document.title, newURL);

    window.addEventListener("load", () => {
      setTimeout(() => {
        if (formSection) {
          const offsetTop =
            formSection.getBoundingClientRect().top + window.scrollY - 20;

          window.scrollTo({
            top: offsetTop,
            behavior: "smooth"
          });
        }
      }, 200);
    });
  }

  // 🔹 Анімація кнопки submit
  if (form && submitBtn) {
    form.addEventListener("submit", () => {
      submitBtn.disabled = true;
      submitBtn.innerHTML = "Надсилаємо…";
    });
  }

});
</script>


<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".modern-form");
  if (!form) return;

  // Функція для читання cookie
  function getCookie(name) {
      let value = "; " + document.cookie;
      let parts = value.split("; " + name + "=");
      if (parts.length === 2) return parts.pop().split(";").shift();
      return null;
  }

  form.addEventListener("submit", function() {
      const fbc = getCookie("_fbc");
      const fbp = getCookie("_fbp");

      if (fbc) {
          let inputFbc = document.createElement("input");
          inputFbc.type = "hidden";
          inputFbc.name = "_fbc";
          inputFbc.value = fbc;
          form.appendChild(inputFbc);
      }

      if (fbp) {
          let inputFbp = document.createElement("input");
          inputFbp.type = "hidden";
          inputFbp.name = "_fbp";
          inputFbp.value = fbp;
          form.appendChild(inputFbp);
      }
  });
});
</script>

<!-- 🔹 CTA: Кнопка в Instagram -->
<section class="cta-instagram"id="cta-instagram">
  <h2>Або замовляй зараз у нашому Instagram магазині</h2>

  <a class="insta-btn"
     href="https://www.instagram.com/mriya_jeans?igsh=MTQxZXByeWQ4OWVjbQ=="
     target="_blank"
     rel="noopener">
     
    <!-- Іконка Instagram (SVG) -->
    <svg class="insta-icon"
         fill="currentColor"
         width="22"
         height="22"
         viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg"
         aria-hidden="true">
      <path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.9.3 2.4.5.6.2 1 .5 1.5 1 .4.4.8.9 1 1.5.2.5.4 1.2.5 2.4.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.9-.5 2.4-.2.6-.5 1-1 1.5-.4.4-.9.8-1.5 1-.5.2-1.2.4-2.4.5-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.9-.3-2.4-.5-.6-.2-1-.5-1.5-1-.4-.4-.8-.9-1-1.5-.2-.5-.4-1.2-.5-2.4-.1-1.3-.1-1.7-.1-4.9s0-3.6.1-4.9c.1-1.2.3-1.9.5-2.4.2-.6.5-1 1-1.5.4-.4.9-.8 1.5-1 .5-.2 1.2-.4 2.4-.5 1.3-.1 1.7-.1 4.9-.1z"/>
      <path d="M12 5.8a6.2 6.2 0 100 12.4A6.2 6.2 0 0012 5.8zm0 10.2a4 4 0 110-8 4 4 0 010 8zm6.4-11.9a1.4 1.4 0 100 2.8 1.4 1.4 0 000-2.8z"/>
    </svg>

    Перейти в Instagram
  </a>
</section>

<style>
/* =============================== */
/* 🔹 CTA INSTAGRAM                */
/* =============================== */

.cta-instagram {
  text-align: center;
  padding: 40px 20px;
  margin: 40px auto;
  max-width: 900px;
}

.cta-instagram {
  text-align: center;
  padding: 40px 20px;
  margin: 40px auto;
  max-width: 900px;

  /* ✅ ПОВЕРНЕНИЙ ФОН */
  background: linear-gradient(135deg, #f9f9f9, #ececec);
  border-radius: 16px;
  box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}


.insta-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;

  background: linear-gradient(135deg, #ff512f, #dd2476);
  color: #fff;
  text-decoration: none;

  padding: 14px 24px;
  border-radius: 999px;
  font-size: 1.1rem;
  font-weight: 700;

  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.insta-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 26px rgba(0,0,0,0.25);
}

.insta-icon {
  flex-shrink: 0;
}

/* 📱 Мобільна */
@media (max-width: 600px) {
  .cta-instagram h2 {
    font-size: 1.4rem;
  }

  .insta-btn {
    font-size: 1rem;
    padding: 12px 20px;
  }


</style>

<!-- 🔹 Компактний блок контактів з миготливою кнопкою Viber -->
<section class="contact-section compact" id="contacts">

  <h2>📞 Ви завжди можете зв’язатися з нами у зручний для вас час, зателефонувавши або написавши нам у Viber чи Instagram. ✅</h2>
  <p class="contact-subtitle">Ми завжди на зв’язку — це наша перевага 💎</p>
  
 <div class="contact-cards">

  <!-- Анастасія -->
  <a href="tel:+380963627958">
    <div class="contact-card">
      <div class="icon">📱</div>
      <div class="info">
        <p><strong>+38(096)362-79-58</strong></p>       
        <span>Анастасія</span>        
      </div>
    </div>
  </a>
  <a href="viber://chat?number=+380963627958" class="viber-btn" target="_blank">Написати у Viber</a>

  <!-- Богдана -->
  <a href="tel:+380938345758">
    <div class="contact-card">
      <div class="icon">📱</div>
      <div class="info">
        <p><strong>+38(093)834-57-58</strong></p>
        <span>Богдана</span> 
      </div>
    </div>
    </a>
    <a href="viber://chat?number=+380938345758" class="viber-btn" target="_blank">Написати у Viber</a>
  

  <!-- Мирослава -->
  <a href="tel:+380680418198">
    <div class="contact-card">
      <div class="icon">📱</div>
      <div class="info">
        <p><strong>+38(068)041-81-98</strong></p>
        <span>Мирослава</span>
      </div>
    </div>
  </a>

  <!-- Viber -->
 <!--  <div class="contact-card viber">
    <div class="icon">💬</div>
    <div class="info">
      <p><strong>Viber</strong></p>
     <a href="viber://chat?number=+380680418198" class="viber-btn" target="_blank">Написати у Viber</a>
    </div>
  </div> -->

</div>
</section>

<style>

a{
  text-decoration: none;

}

.contact-section.compact {
  max-width: 700px;
  margin: 20px auto;
  padding: 10px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 3px 12px rgba(0,0,0,0.08);
  text-align: center;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.contact-section.compact h2 {
  font-size: 1.4rem;
  color: #333;
  margin-bottom: 5px;
}

.contact-section.compact .contact-subtitle {
  color: #666;
  font-size: 0.85rem;
  margin-bottom: 10px;
}

.contact-cards {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.contact-card {
  display: flex;
  flex-direction: column;
  align-items: center; 
  justify-content: center;
  background: #f9f9f9;
  border-radius: 8px;
  padding: 4px 8px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  transition: transform 0.2s, box-shadow 0.2s;
  text-align: center;
  line-height: 1.1;
}

.contact-card:hover {
  transform: translateY(-1px);
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.contact-card .icon {
  font-size: 1.2rem;
  margin-bottom: 2px;
}

.contact-card .info p {
  margin: 0;
  font-size: 0.95rem;
  font-weight: bold;
  color: #222;
}

.contact-card .info span {
  font-size: 0.75rem;
  color: #555;
}

/* Viber акцент */
.contact-card.viber {
  background: #e6f2ff;
}

.contact-card.viber .icon {
  color: #7d3cff;
}

/* 🔹 Кнопка Viber по центру та миготлива */
.viber-btn {
  display: block;
  margin: 4px auto 0 auto;
  padding: 5px 12px;
  background-color: #7d3cff;
  color: #fff;
  font-weight: bold;
  font-size: 0.85rem;
  border-radius: 6px;
  text-decoration: none;
  animation: viberBlink 4s infinite;
}

.viber-btn:hover {
  background-color: #5a1ed9;
}

@keyframes viberBlink {
  0%, 50%, 100% { opacity: 1; }
  25%, 75% { opacity: 0.3; }
}

/* 🔹 Адаптив для мобільних */
@media(max-width: 600px) {
  .contact-section.compact {
    padding: 8px;
  }
  .contact-card {
    padding: 3px 6px;
  }
  .contact-card .icon {
    font-size: 1.1rem;
  }
  .contact-card .info p {
    font-size: 0.9rem;
  }
  .contact-card .info span {
    font-size: 0.7rem;
  }
  .viber-btn {
    font-size: 0.8rem;
    padding: 4px 10px;
  }

  /* 🔹 Заголовок займає ширину екрану, менше по висоті */
  .contact-section.compact h2 {
    font-size: 1rem;
    line-height: 1.1;
    text-align: center;
    word-wrap: break-word;
    font-weight: 700;
  }
}

</style>



<!-- 🔹 Варіанти оплати -->
<div class="paymentOptions">
  <h2><b>Варіанти оплати</b></h2>
  <p>
    <b>
      Для вашої зручності є два варіанти оплати.
      Оплата на реквізити ФОП або накладний платіж Новою Поштою.
    </b>
  </p>
  <img alt="Варіанти оплати" loading="lazy" src="images/paymen.webp"/>
</div>

<style>
/* 🔹 Варіанти оплати */
.paymentOptions {
  text-align: center;
  margin: 40px auto;
  max-width: 900px;
}

.paymentOptions h2 {
  font-size: 22px;
  margin-bottom: 10px;
}

.paymentOptions p {
  font-size: 15px;
  margin-bottom: 20px;
}

.paymentOptions img {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
}

</style>
<!-- ================= MRIYA — Обмін та повернення ================= -->
<!-- ================= MRIYA — Обмін та повернення (compact + full text) ================= -->

<style>
.mr-wrap{
  max-width:980px;
  margin:50px auto;
  padding:0 16px 60px;
}

.mr-hero-block{
  background:#111;
  color:#fff;
  border-radius:16px;
  padding:32px 20px;
  text-align:center;
  box-shadow:0 10px 30px rgba(0,0,0,.15);
}

.mr-hero-block h1{
  margin:0 0 8px;
  font-size:30px;
  letter-spacing:.3px;
}

.mr-hero-block p{
  margin:0;
  opacity:.85;
  font-size:14px;
}

.mr-grid{
  margin-top:24px;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:14px;
}

.mr-card{
  background:#fff;
  border-radius:14px;
  padding:18px;
  box-shadow:0 6px 18px rgba(0,0,0,.05);
  border:1px solid #f0f0f0;
  font-size:14px;
  line-height:1.55;
}

.mr-card h2{
  margin:0 0 10px;
  font-size:16px;
}

.mr-card ul{
  padding-left:18px;
  margin:8px 0;
}

.mr-note{
  margin-top:14px;
  background:#fff8e6;
  border-radius:10px;
  padding:12px;
  font-weight:600;
  font-size:13px;
}

.mr-process{
  margin-top:22px;
  background:#fff;
  border-radius:16px;
  padding:20px;
  box-shadow:0 6px 18px rgba(0,0,0,.05);
}

.mr-process-title{
  text-align:center;
  margin:0 0 14px;
  font-size:18px;
  font-weight:700;
}

.mr-steps{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:10px;
}

.mr-step{
  background:#f9fafc;
  border-radius:12px;
  padding:12px;
  text-align:center;
  border:1px solid #f0f0f0;
  font-size:13px;
  line-height:1.4;
}

.mr-step img{
  width:40px;
  height:40px;
  object-fit:contain;
  margin-bottom:6px;
}

.mr-step-small{
  font-size:11px;
  opacity:.65;
  margin-top:3px;
}

.mr-footer{
  margin-top:22px;
  text-align:center;
  font-weight:600;
  font-size:14px;
  line-height:1.6;
}

/* === Мобільна версія — 2 колонки компактно === */
@media (max-width:768px){

  .mr-hero-block{
    padding:24px 16px;
  }

  .mr-hero-block h1{
    font-size:22px;
  }

  .mr-grid{
    gap:10px;
  }

  .mr-card{
    padding:14px;
    font-size:13px;
  }

  .mr-card h2{
    font-size:14px;
  }

  .mr-steps{
    grid-template-columns:1fr 1fr 1fr;
    gap:8px;
  }

  .mr-step{
    padding:10px 6px;
    font-size:12px;
  }

  .mr-step img{
    width:34px;
    height:34px;
  }

  .mr-footer{
    font-size:13px;
  }
}
</style>


<div class="mr-wrap">

  <div class="mr-hero-block">
    <h1>Обмін та повернення</h1>
    <p>MRIYA JEANS — завжди на зв’язку та готові допомогти ❤️</p>
  </div>

  <div class="mr-grid">

    <div class="mr-card">
      <h2>📦 Умови обміну та повернення</h2>
      <p>Товар належної якості можна обміняти або повернути протягом <b>14 днів</b> (не враховуючи день покупки).</p>
      <ul>
        <li>відсутні сліди носіння;</li>
        <li>збережено товарний вигляд;</li>
        <li>є оригінальні ярлики та упаковка.</li>
      </ul>
      <p><b>Важливо:</b> Повернення здійснюється за тією ж адресою.</p>
    </div>

    <div class="mr-card">
      <h2>🚚 Хто оплачує доставку</h2>
      <p>Вартість доставки при поверненні або обміні оплачує покупець.</p>
      <p><b>Виняток:</b> виробничий брак або пересорт — у цьому випадку доставку оплачуємо ми.</p>
      <div class="mr-note">
        У разі відмови від посилки передплата не повертається, оскільки покриває витрати транспортної компанії.
      </div>
    </div>

  </div>

  <div class="mr-card" style="margin-top:16px;">
    <h2>💬 Важливо перед поверненням</h2>
    <p>Перед оформленням обміну або повернення <b>обов’язково зв’яжіться з нашим менеджером</b>. Ми підкажемо найвигідніший спосіб, щоб ви не переплачували зайві комісії та доставки.</p>
    <p>Також ви можете скористатися послугою <b>«Легке повернення» Нової пошти</b> — це допоможе уникнути зайвих витрат і передплат.</p>
  </div>

  <div class="mr-process">
    <div class="mr-process-title">🔄 Процес повернення</div>

    <div class="mr-steps">

      <div class="mr-step">
        <img loading="lazy" src="https://cdn-icons-png.flaticon.com/512/1828/1828919.png" alt="">
        <div><b>1. Зв’яжіться з менеджером</b></div>
        <div class="mr-step-small">отримайте бланк повернення</div>
      </div>

      <div class="mr-step">
        <img loading="lazy" src="https://cdn-icons-png.flaticon.com/512/1048/1048314.png" alt="">
        <div><b>2. Надішліть товар</b></div>
        <div class="mr-step-small">за інструкцією менеджера</div>
      </div>

      <div class="mr-step">
        <img loading="lazy" src="https://cdn-icons-png.flaticon.com/512/3135/3135706.png" alt="">
        <div><b>3. Отримайте кошти</b></div>
        <div class="mr-step-small">до 5 робочих днів</div>
      </div>

    </div>
  </div>

  <div class="mr-footer">
    Ми на ринку вже понад <b>6 років</b>, завжди відкриті до діалогу, швидко виходимо на зв’язок та допомагаємо з обмінами ❤️  
    <br>
    Наша мета — щоб ви залишились задоволені покупкою.
  </div>

</div>
<!-- ====================================== -->
<!--        PREMIUM FOOTER MRIYA            -->
<!-- ====================================== -->

<footer class="footer_section premium-footer" itemscope itemtype="http://schema.org/Organization">

  <div class="footer-inner">

    <!-- 🔹 ЛОГО -->
    <div class="footer-brand">
      <img src="images/logo-header.png" alt="MRIYA JEANS" class="footer-logo">
      <div class="footer-brand-text">MRIYA JEANS</div>
    </div>

    <!-- 🔹 ВЕРХ: 2 КОЛОНКИ -->
    <div class="footer-extra">

      <!-- ліва -->
      <div class="footer-col">
        <h3 class="footer-col-title">Інформація</h3>

        <a href="#about">Про нас</a>
        <a href="#contacts">Зв'язок з нами</a>
        <a href="dostavka.html">Доставка та оплата</a>
        <a href="obmin-povernennya.html">Обмін та повернення</a>
        <a href="../oferta.html">Договір оферти</a>
      </div>

      <!-- права -->
      <div class="footer-col">

        <h3 class="footer-col-title">Зв'яжіться з нами</h3>

        <a href="tel:+380680418198" class="footer-contact-row">
          <span class="fc-circle fc-phone">📞</span>
          <span>+38 068 041 81 98</span>
        </a>

        <a href="viber://chat?number=%2B380680418198" class="footer-contact-row">
  <span class="fc-circle fc-viber">
    <svg viewBox="0 0 24 24" width="20" height="20">
      <path fill="#fff" d="M16.39 13.36c-.29-.15-1.7-.84-1.96-.94-.26-.1-.45-.15-.64.15-.19.29-.74.94-.91 1.13-.17.19-.34.22-.63.07-.29-.15-1.23-.45-2.34-1.44-.86-.77-1.44-1.72-1.61-2.01-.17-.29-.02-.45.13-.6.13-.13.29-.34.44-.51.15-.17.2-.29.29-.49.1-.19.05-.37-.02-.51-.07-.15-.64-1.54-.88-2.11-.23-.55-.47-.48-.64-.49h-.55c-.19 0-.49.07-.74.34-.26.26-.99.97-.99 2.36s1.01 2.73 1.15 2.92c.15.19 1.99 3.04 4.82 4.27.67.29 1.19.46 1.6.59.67.21 1.27.18 1.75.11.53-.08 1.7-.69 1.94-1.36.24-.67.24-1.25.17-1.36-.07-.11-.26-.18-.55-.33z"/>
    </svg>
  </span>
  <span>Viber</span>
</a>

        <a href="mailto:mriyajeans@gmail.com" class="footer-contact-row">
          <span class="fc-circle fc-mail">✉️</span>
          <span>mriyajeans@gmail.com</span>
        </a>

       <a href="https://www.instagram.com/mriya_jeans" target="_blank" class="footer-contact-row">
  <span class="fc-circle fc-ig">
    <svg viewBox="0 0 24 24" width="20" height="20">
      <path fill="#fff" d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5A3.75 3.75 0 0020 16.25v-8.5A3.75 3.75 0 0016.25 4h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6zm4.75-2.88a1.13 1.13 0 110 2.26 1.13 1.13 0 010-2.26z"/>
    </svg>
  </span>
  <span>Instagram</span>
</a>
      </div>

    </div> <!-- ❗ ОСЬ ЧОГО НЕ ВИСТАЧАЛО — ЗАКРИТТЯ GRID -->

    <!-- 🔹 НИЗ: КОНТАКТИ (ЦЕНТР) -->
    <div class="footer-bottom">

      <h2 class="footer-title">Контакти</h2>

     <!--  <address class="footer-address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
        <p>
          <span itemprop="addressRegion">Вінницька область</span>,
          <span itemprop="addressLocality">с. Чернівці</span>,
          <span itemprop="streetAddress">24100</span>
        </p>
      </address> -->

      <div class="footer-info">
        <p>ФОП:</p>
        <p itemprop="name"><b>Кучківська Мирослава Володимирівна</b></p>

        <p>ЄДРПОУ:</p>
        <p><b itemprop="identifier">3552005823 УКРАЇНА</b></p>
      </div>

      <div class="footer_links">
        <a href="confidentiality.html" rel="nofollow" target="_blank">Політика конфіденційності</a>
        <span class="footer-sep">|</span>
        <a href="../oferta.html" rel="nofollow" target="_blank">Договір-оферта</a>
      </div>

      <div class="footer-copy">
        © 2026 MRIYA JEANS. Всі права захищені.
      </div>

    </div>

  </div>
</footer>
<style>
/* ====================================== */
/*        PREMIUM FOOTER MRIYA            */
/* ====================================== */

.premium-footer{
  background:#1f1f21;
  color:#e8e8e8;
  padding:60px 20px 40px;
  text-align:center;
  border-top:1px solid rgba(255,255,255,0.06);
}

.footer-inner{
  max-width:900px;
  margin:0 auto;
}

/* ================= LOGO ================= */

.footer-brand{
  margin-bottom:28px;
}

.footer-logo{
  width:72px;
  display:block;
  margin:0 auto 10px;
}

.footer-brand-text{
  font-weight:700;
  letter-spacing:2px;
  font-size:14px;
  color:#fff;
}

/* ====================================== */
/*        FOOTER GRID — PREMIUM           */
/* ====================================== */

.footer-extra{
  margin:40px auto 0;
  padding-top:28px;
  border-top:1px solid rgba(255,255,255,0.08);

  display:grid;

  /* ⭐ ДЕСКТОП — роз’їзд по краях */
  grid-template-columns:1fr 1fr;
  gap:60px;

  max-width:900px;
  width:100%;

  position:relative;
}

/* ⭐ Ліва колонка — до лівого краю */
.footer-col:first-child{
  align-items:flex-start;
  text-align:left;
  justify-self:start;
}

/* ⭐ Права колонка — до правого краю */
.footer-col:last-child{
  align-items:flex-start;
  text-align:left;
  justify-self:end;
}
/* вертикальний divider */

@media (min-width:769px){
  .footer-extra::after{
    content:"";
    position:absolute;
    left:50%;
    top:10px;
    bottom:10px;
    width:1px;
    background:rgba(255,255,255,0.08);
  }
}

/* ================= COLUMNS ================= */

.footer-col{
  display:flex;
  flex-direction:column;
  gap:12px;
  align-items:flex-start;
  text-align:left;
}

.footer-col-title{
  color:#fff;
  font-size:16px;
  font-weight:700;
  margin-bottom:6px;
}

.footer-col a{
  color:#bdbdbd;
  text-decoration:none;
  font-size:14px;
  transition:.2s;
}

.footer-col a:hover{
  color:#fff;
}
/* ====================================== */
/*   AIR FIX — ліва колонка Інформація    */
/* ====================================== */

.footer-col:first-child{
  gap:18px; /* було ~12 → стало повітряніше */
}

/* трохи більший відступ під заголовком */
.footer-col:first-child .footer-col-title{
  margin-bottom:12px;
}

/* мобілка — ще трохи повітря */
@media (max-width:768px){
  .footer-col:first-child{
    gap:16px;
  }
}
/* ====================================== */
/*        CONTACT ROWS                    */
/* ====================================== */

.footer-contact-row{
  display:flex;
  align-items:center;
  gap:14px;
  text-decoration:none;
  color:#e6e6e6;
  font-size:14px;
  transition:.2s ease;

  width:100%;
  max-width:260px;
}

.footer-contact-row:hover{
  color:#ffffff;
  transform: translateX(3px);
}

/* круглі іконки */

.fc-circle{
  width:42px;
  height:42px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:18px;
  flex-shrink:0;
}

/* брендові кольори */

.fc-phone{ background:#2f6df6; }
.fc-viber{ background:#7b4cff; }
.fc-mail{ background:#ff9f2f; }
.fc-ig{ background:linear-gradient(135deg,#ff512f,#dd2476,#7b4cff); }

/* ====================================== */
/*      FOOTER BOTTOM (Контакти)          */
/* ====================================== */

.footer-bottom{
  margin-top:64px; /* ⭐ великий повітряний відступ */
  padding-top:28px;
  border-top:1px solid rgba(255,255,255,0.06);
}

.footer-title{
  font-size:20px;
  margin-bottom:18px;
  color:#fff;
}

.footer-address{
  color:#bdbdbd;
  margin-bottom:18px;
  font-style:normal;
}

.footer-info p{
  margin:6px 0;
  color:#d6d6d6;
}

.footer_links{
  margin-top:22px;
  font-size:13px;
}

.footer_links a{
  color:#cfcfcf;
  text-decoration:none;
}

.footer_links a:hover{
  color:#fff;
}

.footer-sep{
  margin:0 6px;
  opacity:.4;
}

.footer-copy{
  margin-top:26px;
  font-size:12px;
  color:#9a9a9a;
}

/* ====================================== */
/*              MOBILE CLEAN              */
/* ====================================== */

@media (max-width:768px){

  .footer-logo{
    width:64px;
  }

  .footer-extra{
    grid-template-columns:1fr 1fr;
    gap:24px;
    max-width:520px;
  }

  .footer-col{
    align-items:flex-start;
    text-align:left;
  }

  .fc-circle{
    width:38px;
    height:38px;
    font-size:16px;
  }

  .footer-contact-row{
    gap:12px;
    min-height:44px;
  }

  .footer-bottom{
    margin:56px auto 0;
    padding-top:28px;
    border-top:1px solid rgba(255,255,255,0.06);
    max-width:520px;
    text-align:center;
  }
}
</style>




<!-- 🔹 Фіксована кнопка "Замовити зараз" --> 
<a class="fixed-btn" href="#formSection">Отримати консультацію</a>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.querySelector(".fixed-btn");
  if (btn) {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      setTimeout(() => {
        const form = document.querySelector("#formSection");
        if (form) {
          const offsetTop =
            form.getBoundingClientRect().top + window.scrollY - 20;
          window.scrollTo({
            top: offsetTop,
            behavior: "smooth"
          });
        }
      }, 150);
    });
  }
});
</script>

<!-- 🔹 ЛОГІКА ПОКАЗУ / ХОВАННЯ КНОПКИ -->
<script>
window.addEventListener("scroll", () => {
  const form = document.querySelector("#formSection");
  const btn = document.querySelector(".fixed-btn");
  if (!form || !btn) return;

  const rect = form.getBoundingClientRect();

  const formInView =
    rect.top < window.innerHeight - 100 &&
    rect.bottom > 100;

  btn.style.display = formInView ? "none" : "inline-block";
});
</script>



<!-- 🔹 CSS для фіксованої кнопки та скролу до форми -->
<style>
.fixed-btn {
  position: fixed;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #ff4500;
  color: #fff;
  padding: 14px 24px;
  border-radius: 50px;
  font-weight: bold;
  text-decoration: none;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  z-index: 9999;
  display: inline-block;

  /* 🔥 FIX МОБІЛЬНОГО ПЕРЕНОСУ */
  white-space: nowrap;
  font-size: 14px;
  max-width: 90vw;
}

.fixed-btn:hover {
  transform: translateX(-50%) translateY(-3px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.25);
}


</style>

<!-- ---------------- ІЗОЛЬОВАНИЙ ФІЛЬТР + LOAD MORE ---------------- -->
<script>
document.addEventListener("DOMContentLoaded", function(){

  /* === ІЗОЛЯЦІЯ КАТАЛОГУ === */
  const grid = document.querySelector(".store-grid");
  if (!grid) return;

  const state = {
    filter: "all",
    limit: 20
  };

  const step = 20;

  /* БЕРЕМО КАРТКИ ТІЛЬКИ ВСЕРЕДИНІ КАТАЛОГУ */
 const cards = Array.from(document.querySelectorAll(".store-grid .product-card"));
  const buttons = document.querySelectorAll(".filter-btn");
  const loadMoreBtn = document.getElementById("loadMoreBtn");

  function matchesFilter(card) {
    const category = card.dataset.category || "";
    const isSale = card.dataset.sale === "true";

    if (state.filter === "all") return true;
    if (state.filter === "sale") return isSale;

    return category.includes(state.filter);
  }

  function updateCatalog() {

    const filtered = cards.filter(matchesFilter);

    cards.forEach(card => {
      card.classList.add("product-hidden");
    });

    filtered.forEach((card, index) => {
      if (index < state.limit) {
        card.classList.remove("product-hidden");
      }
    });

    if (loadMoreBtn) {
      if (state.limit >= filtered.length) {
        loadMoreBtn.style.display = "none";
      } else {
        loadMoreBtn.style.display = "inline-block";
      }
    }
  }

  /* === ФІЛЬТР === */
  buttons.forEach(btn => {
    btn.addEventListener("click", function(){

      buttons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");

      state.filter = btn.dataset.filter;
      state.limit = step;

      updateCatalog();
    });
  });

  /* === LOAD MORE === */
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", function(){
      state.limit += step;
      updateCatalog();
    });
  }

  /* === СТАРТ === */
  updateCatalog();

});
</script>

<style>
.product-hidden {
  display: none;
}
</style>

<script>

console.log("GOOGLE STOCK START");

let STOCK_DATA = [];

fetch("/stock-api.php")
  .then(r => r.json())
  .then(data => {
    STOCK_DATA = data;
    console.log("Stock loaded:", STOCK_DATA.length);
  })
  .catch(err => console.error("Google Stock Error:", err));

function getRealSizes(card){

  const sizes = card.dataset.sizes || "";

  if (!sizes || STOCK_DATA.length === 0) {
    return sizes;
  }

  const model = (card.dataset.model || "").trim();

  return sizes.split(";").map(item => {

    const parts = item.split("|");
    const size = (parts[0] || "").replace(/^!/, "").trim();

    const stockItem = STOCK_DATA.find(x =>
      String(x.model).trim() === model &&
      String(x.size).trim() === size
    );

    if (stockItem && Number(stockItem.stock) <= 0) {
      parts[0] = "!" + size;
    }

    return parts.join("|");

  }).join(";");

}

</script>

</body>
</html>