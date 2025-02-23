<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://naramizaru.github.io/fa-pro/css/all.min.css">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <title>Lovify | @yield('title')</title>
    @stack('css')
</head>

<body style="background-color: black">
    @yield('content')
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK",
                customClass: {
                    popup: "rounded-lg shadow-lg",
                    title: "text-lg font-bold text-rose-950",
                    confirmButton: "bg-rose-950 text-white px-4 py-2 rounded-md hover:bg-rose-950",
                },
                buttonsStyling: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
                customClass: {
                    popup: "rounded-lg shadow-lg",
                    title: "text-lg font-bold text-rose-950",
                    confirmButton: "bg-rose-950 text-white px-4 py-2 rounded-md hover:bg-rose-950",
                },
                buttonsStyling: false
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            let errorMessages = `{!! implode('<br>', $errors->all()) !!}`;

            Swal.fire({
                title: "Validation Error!",
                html: errorMessages,
                icon: "error",
                confirmButtonText: "OK",
                customClass: {
                    popup: "rounded-lg shadow-lg",
                    title: "text-lg font-bold text-red-600",
                    confirmButton: "bg-rose text-white px-4 py-2 rounded-md hover:bg-red-700",
                },
                buttonsStyling: false
            });
        </script>
    @endif
    @stack('js')
</body>

</html>
