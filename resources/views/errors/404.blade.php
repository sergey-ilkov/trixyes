<!DOCTYPE html>
<html lang="{{app()->currentLocale()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Página no encontrada</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') . '?v=' . rand(10, 1000) }}">

</head>

<body>
    <div class="wrapper">

        <header class="header">
            <div class="container">
                <div class="header__inner">

                    <a class="header-logo" href="{{ route('home') }}">
                        <img width="100" height="23" class="header-logo__img" src="{{ asset('images/logo.svg') }}" alt="logo">
                    </a>

                </div>
            </div>
        </header>

        <section class="section-error">
            <div class="section-error-code">
                404
            </div>
            <div class="section-error-message">
                Esta página no existe

            </div>
            <a class="section-error-link" href="{{ route('home') }}">
                Volver a la página principal
            </a>
        </section>
    </div>
</body>

</html>