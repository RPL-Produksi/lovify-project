<nav class="navbar bg-white md:bg-transparent text-white fixed top-0 left-0 w-full z-10 md:py-3 text-nowrap text-center">
    @guest
        <div class="xl:px-40 px-2 md:px-10">
            <div class="flex items-center h-16 lg:p-0 p-2 justify-between">
                <!-- Logo -->
                <div class="flex-shrink-0 md:grid" hidden>
                    <img id="navbar-logo" src="{{ asset('asset/image/LovifyWhite-NoBg.png') }}" alt="">
                </div>
                <div class="flex-shrink-0 md:hidden">
                    <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" id="navbar-logo" alt="">
                </div>
                <!-- Menu Items -->
                <div class="hidden md:flex space-x-12">
                    <a href="{{ route('client.home') }}" class="font-light relative overflow-hidden group">
                        Home
                        <span
                            class="absolute left-0 bottom-0 bg-white transition-all duration-300 group-hover:w-full
                        {{ request()->routeIs('client.home') ? 'w-full' : 'w-0' }}"
                            style="height: 1px;"></span>
                    </a>
                    <a href="{{ route('article') }}" class="font-light relative overflow-hidden group">
                        Article
                        <span class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full"
                            style="height: 1px;"></span>
                    </a>
                    <a href="{{ route('aboutUs') }}" class="font-light relative overflow-hidden group">
                        About Us
                        <span class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full"
                            style="height: 1px;"></span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('login') }}" class="font-light text-white rounded-3xl px-7 py-3 login-btn"
                        style="background-color: #3D0A05">Login</a>
                </div>

                <div class="md:hidden">
                    <button class="text-rose-950 focus:outline-none menu-button" id="menu-button">
                        <i class="fa-solid fa-bars text-rose-950"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="md:hidden hidden pb-10" id="mobile-menu">
            <a href="{{ route('client.home') }}" class="block px-4 py-2 hover:bg-rose-950 hover:text-white">Home</a>
            <a href="{{ route('aboutUs') }}" class="block px-4 py-2 hover:bg-rose-950 hover:text-white">About</a>
            <a href="{{ route('article') }}" class="block px-4 py-2 hover:bg-rose-950 hover:text-white">Articles</a>
            <div class="space-x-6 mt-5">
                <a href="{{ route('login') }}" class="font-light text-white rounded-3xl px-7 py-3 login-btn"
                    style="background-color: #3D0A05">Login</a>
            </div>
        </div>
    @endguest

    @auth
        @if ($user->role == 'client')
            <div class="xl:px-40 px-2 md:px-10">
                <div class="flex items-center h-16 lg:p-0 p-2 justify-between">
                    <!-- Logo -->
                    <div class="flex-shrink-0 md:grid" hidden>
                        <img id="navbar-logo" src="{{ asset('asset/image/LovifyWhite-NoBg.png') }}" alt="">
                    </div>
                    <div class="flex-shrink-0 md:hidden">
                        <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" id="navbar-logo" alt="">
                    </div>
                    <!-- Menu Items -->
                    <div class="hidden md:flex space-x-12">
                        <a href="{{ route('client.home') }}" class="font-light relative overflow-hidden group">
                            Home
                            <span
                                class="absolute left-0 bottom-0 bg-white transition-all duration-300 group-hover:w-full
                        {{ request()->routeIs('client.home') ? 'w-full' : 'w-0' }}"
                                style="height: 1px;"></span>
                        </a>
                        <a href="{{ route('article') }}" class="font-light relative overflow-hidden group">
                            Article
                            <span
                                class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full"
                                style="height: 1px;"></span>
                        </a>
                        <a href="{{ route('aboutUs') }}" class="font-light relative overflow-hidden group">
                            About Us
                            <span
                                class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full"
                                style="height: 1px;"></span>
                        </a>
                        <a href="#" class="font-light relative overflow-hidden group">
                            My Plannings
                            <span
                                class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full"
                                style="height: 1px;"></span>
                        </a>
                    </div>

                    <div class="hidden md:flex space-x-6 relative group">
                        <div class="flex">
                            <div class="flex items-center mr-3">
                                <p>Hello, {{ $user->username }}<i class="fa-solid fa-caret-down ml-2"></i></p>
                            </div>

                            <a class="relative overflow-hidden group inline-block">
                                @if (is_null($user->avatar))
                                <img src="{{ asset('asset/image/ix_user-profile-filled.png') }}" class="rounded-full w-14" alt="">
                                @else
                                <img src="{{ $user->avatar }}" class="rounded-full w-14" alt="">
                                @endif
                            </a>
                        </div>
                        <div
                            class="absolute left-16 top-full mt-6 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible transition-all duration-300 group-hover:opacity-100 group-hover:visible transform -translate-x-1/2">
                            <a href="{{ route('profile') }}"
                                class="block text-start text-rose-950 px-4 py-2 hover:bg-gray-200 hover:rounded-t-lg"><i
                                    class="fa-solid fa-user mr-2"></i>Profile</a>
                            <hr>
                            <form action="{{ route('be.logout') }}" method="POST">
                                @csrf
                                <button href="#"
                                    class="w-full text-start text-rose-950 px-4 py-2 hover:bg-gray-200 hover:rounded-b-lg"><i
                                        class="fa-solid fa-right-from-bracket mr-2"></i>Logout</button>
                            </form>
                        </div>
                    </div>


                    <div class="md:hidden">
                        <button class="text-rose-950 hover:text-white focus:outline-none menu-button" id="menu-button">
                            <div class="flex">
                                <a class="relative overflow-hidden group inline-block">
                                    @if (is_null($user->avatar))
                                        <img src="{{ asset('asset/image/ix_user-profile-filled.png') }}"
                                            class="rounded-full w-12" alt="">
                                    @else
                                        <img src="{{ $user->avatar }}" class="rounded-full w-12" alt="">
                                    @endif
                                </a>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <div class="md:hidden hidden" id="mobile-menu">
                <a href="{{ route('client.home') }}" class="block px-4 py-2 hover:bg-rose-950 hover:text-white">Home</a>
                <a href="{{ route('aboutUs') }}" class="block px-4 py-2 hover:bg-rose-950 hover:text-white">About</a>
                <a href="{{ route('article') }}" class="block px-4 py-2 hover:bg-rose-950 hover:text-white">Articles</a>
                <a href="#" class="block px-4 py-2 hover:bg-rose-950 hover:text-white">My Plannings</a>
                <hr class="my-">
                <a href="{{ route('profile') }}"
                    class="block text-center text-rose-950 px-4 py-2 hover:bg-gray-200 hover:rounded-t-lg"><i
                        class="fa-solid fa-user mr-2"></i>Profile</a>
                <form action="{{ route('be.logout') }}" method="POST">
                    @csrf
                    <button href="#"
                        class="w-full text-center text-rose-950 px-4 py-2 hover:bg-gray-200 hover:rounded-b-lg"><i
                            class="fa-solid fa-right-from-bracket mr-2"></i>Logout</button>
                </form>
            </div>
        @endif
    @endauth

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

    function toggleDropdown(event) {
        event.preventDefault();
        const dropdown = document.getElementById('dropdown');
        dropdown.classList.toggle('opacity-100');
        dropdown.classList.toggle('visible');
    }
</script>
