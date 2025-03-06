<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sb-admin.min.css') }}">
    <link rel="stylesheet" href="https://naramizaru.github.io/fa-pro/css/all.min.css">
    @stack('css')
    <title>Lovify | @yield('title')</title>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('template-dashboard.template.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" style="background-color: #f7f0f0">
                @include('template-dashboard.template.navbar')
                <div class="container-fluid pb-10" style="min-height: 100vh; background-color: #f7f0f0;">
                    @yield('content')
                </div>
            </div>

            @include('template-dashboard.template.footer')
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery-easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "<span style='color: #3D0A05;'>Berhasil!</span>",
                    html: "<span style='color: #000;'>{{ session('success') }}</span>",
                    icon: "success",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#3D0A05"
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "<span style='color: #3D0A05;'>Failed!</span>",
                    html: "<span style='color: #000;'>{{ session('error') }}</span>",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#3D0A05"
                });
            });
        </script>
    @endif

    @stack('js')
</body>

</html>
