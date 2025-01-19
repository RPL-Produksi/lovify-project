@extends('template.master')
@section('title', 'Home')
@include('components.navbar')
@section('content')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    @include('pages.client.landing_page.hero')
    @include('pages.client.landing_page.service')
    @include('pages.client.landing_page.about')
    @include('pages.client.landing_page.planning')

@endsection

<style>
    .hero-section {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url({{ asset('/asset/image/wedding_placeholder2_bg.jpg') }});
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0.4;
        z-index: -1;
    }

    h1, h3, a, p, h4 {
        font-family: 'IBM Plex Serif', serif;
    }

    .book-btn:hover {
        background-color: white !important;
        color: black;
        transition: 0.3s;
    }

    .service-section {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .text-redlue {
        color: #3D0A05;
    }

    .border-redlue {
        border: solid #3D0A05 2px;
    }

    .about-section {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .about-image {
        width: 400px;
        height: 400px;
        object-fit: cover
    }

    .plannings-section {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .planning-card {
        position: relative;
        height: 360px;
        width: 500px;
        background-image: url({{ asset('asset/image/catering_placeholder.jpg') }});
        background-size: cover;
        background-position: center;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(61, 10, 5, 1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(61, 10, 5, 1);
        box-shadow: 0px 0px 10px 0px rgba(61, 10, 5, 1);
        border-radius: 10px;
        overflow: hidden;
    }

    .planning-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .planning-card>* {
        position: relative;
        z-index: 2;
    }

    .btn-plan-card:hover {
        background-color: white !important;
        color: black !important;
        border: #3D0A05 solid 2px;
        transition: 0.2s;
    }

    .calculator-card {
        -webkit-box-shadow: 0px 0px 10px 0px rgba(61, 10, 5, 1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(61, 10, 5, 1);
        box-shadow: 0px 0px 10px 0px rgba(61, 10, 5, 1);
    }
</style>
