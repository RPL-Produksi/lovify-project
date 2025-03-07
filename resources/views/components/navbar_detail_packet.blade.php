<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<nav class="navbar bg-transparent text-white fixed top-0 left-0 w-full z-10 md:py-3 text-nowrap text-center">
    <div class="xl:px-40 px-2 md:px-10">
        <div class="flex items-center h-16 lg:p-0 p-2 justify-between">

            <!-- Menu Items -->
            <div class="hidden md:flex relative group">
                <!-- Trigger Dropdown -->
                <a href="#" class="font-light relative overflow-hidden group inline-block">
                    Other Package
                    <span class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full" style="height: 1px;"></span>
                </a>

                <!-- Dropdown Menu -->
                <div class="absolute left-0 top-full mt-1 w-48 bg-white text-black rounded-md shadow-lg opacity-0 invisible transition-all duration-300 group-hover:opacity-100 group-hover:visible">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Package 1</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Package 2</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Package 3</a>
                </div>
            </div>

             <!-- Logo -->
             <div class="flex-shrink-0 md:pl-6">
                <img src="{{ asset('asset/image/LovifyWhite-NoBg.png') }}" alt="" id="navbar-logo">
            </div>

            <div class="hidden md:flex space-x-6">
                <a href="{{ route('login') }}" class="font-light text-white rounded-3xl px-7 py-3 login-btn" style="background-color: #3D0A05">Book Now</a>
            </div>

            <div class="md:hidden">
                <button class="text-gray-300 hover:text-white focus:outline-none menu-button" id="menu-button">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="md:hidden hidden" id="mobile-menu">
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">Home</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">About</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">Services</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">Contact</a>
    </div>
</nav>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
     AOS.init();
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    const navbar = document.querySelector('.navbar');
    const menuButtonn = document.querySelector('.menu-button');
    const navbarLogo = document.getElementById('navbar-logo'); // Add this line
    const spans = document.querySelectorAll('.group span'); // Ambil semua span garis bawah

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
            menuButtonn.classList.add('scrolled');
            // Change image source when scrolling down
            navbarLogo.src = "{{ asset('asset/image/Lovify-NoBg.png') }}"; // Update the image source

            // Ubah warna span menjadi hitam saat scroll
            spans.forEach(span => {
                span.style.backgroundColor = '#3D0A05';
            });

        } else {
            navbar.classList.remove('scrolled');
            menuButtonn.classList.remove('scrolled');
            // Revert back to the original image when scrolling back up
            navbarLogo.src = "{{ asset('asset/image/LovifyWhite-NoBg.png') }}"; // Revert the image source

            // Ubah warna span kembali menjadi putih saat kembali ke atas
            spans.forEach(span => {
                span.style.backgroundColor = 'white';
            });
        }
    });
</script>
