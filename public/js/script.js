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

  document.querySelectorAll('img').forEach(img => {
    img.addEventListener('contextmenu', function(e) {
      e.preventDefault();
    });
  });

//   var div = document.getElementById('InNum');
//   var display = 1;
//   function hideshow()
//   {
//         if(display == 1)
//         {
//             div.style.display = 'block';
//             display = 0;
//         }
//         else
//         {
//             div.style.display = 'none';
//             display = 1;
//         }
//   }
function hideshow() {
    // Sembunyikan semua elemen input tambahan
    document.querySelectorAll('.box-input-pax').forEach(el => el.style.display = 'none');

    // Tampilkan elemen yang sesuai dengan radio button yang dipilih
    const selected = document.querySelector('input[name="group1"]:checked');
    if (selected) {
        const inputBox = document.getElementById(`InNum${selected.value}`);
        if (inputBox) inputBox.style.display = 'block';
    }
}
