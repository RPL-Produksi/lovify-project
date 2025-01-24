<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://naramizaru.github.io/awesome-2.0/css/all.css">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/master.css')}}">
    <title>Lovify | @yield('title')</title>
    @yield('css')
</head>
<body class=" bg-black">
    @yield('content')
</body>
@yield('js')
</html>
