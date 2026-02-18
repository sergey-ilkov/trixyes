<!DOCTYPE html>
<html lang="{{app()->currentLocale()}}">

<head>

    {{-- @include('frontend.includes.head') --}}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('seo.' . $page . '.title') }}</title>
    <meta name="description" content="{{ __('seo.' . $page . '.desc') }}">
    <meta name="image" content="{{ asset('images/favicons/favicon-32x32.png') }}">
    

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">


        
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <noscript>

        <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    
    </noscript>


    @stack('css')

   
    <link rel="stylesheet" href="{{ asset('css/style.css') . '?v=' . rand(10, 1000) }}">



    @stack('js')

    <script src="{{ asset('js/forgot-password.js') . '?v=' . rand(10, 1000)  }}" defer></script>

</head>

<body>

    <div class="wrapper page-{{ $page }}">

        {{-- @include('frontend.includes.header') --}}

        <header class="header">
            <div class="container">
                <div class="header__inner">

                    <a class="header-logo" href="{{ route('home') }}">
                        <img width="100" height="23" class="header-logo__img" src="{{ asset('images/logo.svg') }}" alt="logo">
                    </a>          

                </div>
            </div>
        </header>

        <main class="main">

            @yield('content')

        </main>

        {{-- @include('frontend.includes.footer') --}}

    </div>


    {{-- @include('frontend.includes.modals') --}}


</body>

</html>
