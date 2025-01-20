const swiperone = new Swiper('.swiperone', {
    // Optional parameters
    direction: 'vertical',
    loop: true,
    autoplay: {
        delay: 0, // Durasi antar slide (dalam milidetik)
        disableOnInteraction: false, // Tetap autoplay meskipun ada interaksi pengguna
      },
      speed:2000,

      // Menampilkan 3 slide sekaligus
      slidesPerView: 3, // Jumlah slide yang ditampilkan
      spaceBetween: 10, // Jarak antar slide dalam piksel

    // Optional parameters
    direction: 'vertical',
    loop: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });

const swipertwo = new Swiper('.swipertwo', {
    // Optional parameters
    direction: 'vertical',
    loop: true,
    autoplay: {
        delay: 0, // Durasi antar slide (dalam milidetik)
        reverseDirection: true, // Memutar arah autoplay
        disableOnInteraction: false, // Tetap autoplay meskipun ada interaksi pengguna
      },
      speed:2000,

      // Menampilkan 3 slide sekaligus
      slidesPerView: 3, // Jumlah slide yang ditampilkan
      spaceBetween: 10, // Jarak antar slide dalam piksel

    // Optional parameters
    direction: 'vertical',
    loop: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });
