<nav class=" bg-transparent text-white fixed top-0 left-0 w-full z-10 py-5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="#" class="text-2xl font-light">Lovify</a>
            </div>
            <!-- Menu Items -->
            <div class="hidden md:flex space-x-12">
                <a href="#" class="font-light relative overflow-hidden group">
                    Home
                    <span class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full" style="height: 0.5"></span>
                </a>
                <a href="#" class="font-light relative overflow-hidden group">
                    Packets
                    <span class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full" style="height: 0.5"></span>
                </a>
                <a href="#" class="font-light relative overflow-hidden group">
                    Vendors
                    <span class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full" style="height: 0.5"></span>
                </a>
                <a href="#" class="font-light relative overflow-hidden group">
                    About Us
                    <span class="absolute left-0 bottom-0 w-0 bg-white transition-all duration-300 group-hover:w-full" style="height: 0.5"></span>
                </a>
            </div>
            
            <div class="hidden md:flex space-x-6">
                <a href="#" class="font-light text-white rounded-3xl px-7 py-3 login-btn" style="background-color: #3D0A05">Login</a>
            </div>
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button class="text-gray-300 hover:text-white focus:outline-none" id="menu-button">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div class="md:hidden hidden" id="mobile-menu">
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">Home</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">About</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">Services</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">Contact</a>
    </div>
</nav>

<script>
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>

<style>
    .login-btn:hover {
        background-color: white !important;
        color: black;
        transition: 0.3s;
    }
</style>
