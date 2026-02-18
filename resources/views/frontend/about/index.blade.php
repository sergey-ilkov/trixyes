@extends('frontend.layouts.base')


@once

@push('css')

{{--
<link rel="preload" as="image" href="{{ asset('images/home/hero.webp') }}" /> --}}

{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css"> --}}
<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">


@endpush



@push('js')

{{-- <script data-src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js" defer></script> --}}
<script src="{{ asset('js/swiper-bundle.min.js') }}" defer></script>

@endpush


@endonce


@section('content')


{{-- ? about-hero --}}
<section class="about-hero">
    <div class="container">

        <div class="about-hero__items">
            <div class="about-hero__item">
                <h1 class="about-hero__title">
                    <span class="accent-color">Trixy –</span>
                    Hacemos los préstamos más accesibles

                </h1>
            </div>

            <div class="about-hero__item">
                <p class="about-hero__subtitle title-decor">
                    QUIÉNES SOMOS

                </p>

                <div class="about-hero-content">
                    <p class="about-hero__text">
                        Trixy es un equipo de entusiastas que, por experiencia propia, sabe lo difícil que puede ser obtener un crédito justo cuando más lo necesitas.
                    </p>
                    <p class="about-hero__text">
                        También entendemos lo difícil que es pagar un crédito cuando los intereses son altos.

                    </p>

                </div>

            </div>

            <span class="about-hero-decor-1 decor-grd-1"></span>
            <span class="about-hero-decor-2 decor-grd-2"></span>

        </div>

    </div>
</section>

{{-- ? mission --}}
<section class="mission">
    <div class="container">
        <div class="mission__items">

            <div class="mission__item">
                <h2 class="mission__item__title title-decor">
                    Nuestra misión

                </h2>
                <p class="mission__text">
                    Brindar a las personas la posibilidad de usar créditos libremente sin el riesgo de caer en una dependencia por los altos intereses.

                </p>
            </div>
            <div class="mission__item">
                <div class="mission-content">
                    <span class="mission-content__title">
                        Para ayudarte, desarrollamos un servicio que:

                    </span>
                    <ul class="mission-list">
                        <li class="mission-list__item">
                            Permite aumentar significativamente las probabilidades de obtener un crédito cuando lo necesitas

                        </li>
                        <li class="mission-list__item">
                            Proporciona información objetiva sobre los servicios de crédito con las mejores condiciones para ti.

                        </li>
                    </ul>
                </div>

                <div class="mission-image">
                    <img width="648" height="552" class="mission__img lazy" src="{{ asset('images/loading.png') }}" data-src="{{ asset('images/about/mission.webp') }}" alt="">
                </div>

            </div>



            <span class="mission-decor-1 decor-grd-1"></span>
            <span class="mission-decor-2 decor-grd-1"></span>
        </div>
    </div>
</section>

{{-- ? reviews --}}

@include('frontend.includes.reviews')




@endsection