@extends('frontend.layouts.base')

@once

@push('css')

{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css"> --}}
<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

@endpush



@push('js')

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js" defer></script> --}}
<script src="{{ asset('js/swiper-bundle.min.js') }}" defer></script>
@endpush


@endonce




@section('content')


{{-- ? services-hero --}}
<section class="services-hero">
    <div class="container">
        <div class="services-hero__inner">
            <div class="services-hero-content">
                <h1 class="services-hero__title title-h1">
                    <span class="accent-color">Elige los mejores servicios </span>
                    <br>
                    Obtén descuentos

                    <br>
                    Aprovecha las oportunidades

                </h1>

                @if (!auth('web')->user())

                <div class="services-hero__actions">
                    <button class="services-hero__btn btn-1 modal-btn" type="button" data-target="sign-up">Registrarse</button>

                    <a class="services-hero__link btn-2" href="{{ route('about') }}">Quiénes somos</a>
                </div>


                @endif




            </div>

            <div class="services-hero-example">
                <div class="example-box bg-grd-1">
                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo" src="{{ asset('images/services/kueski.svg') }}" alt="Logo Kueski">
                            <span class="example-service__title">“Kueski”</span>
                        </div>
                        <div class="example-service__col">
                            <ul class="example-service__list">
                                <li class="example-service__item"><span>Desde 0.01% </span> - Interés al día</li>
                                <li class="example-service__item"><span>30 días</span> - de plazo</li>
                                <li class="example-service__item"><span>$10,000</span> - $10,000 máx.</li>
                            </ul>
                            <span class="example-service__btn-show">Ver más</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service__stars"></span>
                            <span class="example-service__rating">(<span>2427</span> votos)</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service-chart">8.9</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service__btn">Consigue tu préstamo</span>
                        </div>
                    </div>
                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo" src="{{ asset('images/services/vivus.svg') }}" alt="Logo Vivus">
                            <span class="example-service__title">“Vivus”</span>
                        </div>
                        <div class="example-service__col">
                            <ul class="example-service__list">
                                <li class="example-service__item"><span>Desde 0.01% </span> - Interés al día</li>
                                <li class="example-service__item"><span>30 días</span> - de plazo</li>
                                <li class="example-service__item"><span>$10,000</span> - $10,000 máx.</li>
                            </ul>
                            <span class="example-service__btn-show">Ver más</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service__stars"></span>
                            <span class="example-service__rating">(<span>2427</span> votos)</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service-chart">8.2</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service__btn">Consigue tu préstamo</span>
                        </div>
                    </div>
                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo" src="{{ asset('images/services/dineria.svg') }}" alt="Logo Dineria">
                            <span class="example-service__title">“Dineria”</span>
                        </div>
                        <div class="example-service__col">
                            <ul class="example-service__list">
                                <li class="example-service__item"><span>Desde 0.01% </span> - Interés al día</li>
                                <li class="example-service__item"><span>30 días</span> - de plazo</li>
                                <li class="example-service__item"><span>$10,000</span> - $10,000 máx.</li>
                            </ul>
                            <span class="example-service__btn-show">Ver más</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service__stars"></span>
                            <span class="example-service__rating">(<span>2427</span> votos)</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service-chart">9.5</span>

                        </div>
                        <div class="example-service__col">
                            <span class="example-service__btn">Consigue tu préstamo</span>
                        </div>
                    </div>
                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo" src="{{ asset('images/services/kubofinanciero.svg') }}" alt="Logo Kubofinanciero">
                            <span class="example-service__title">“Kubofinanciero”</span>
                        </div>
                        <div class="example-service__col">
                            <ul class="example-service__list">
                                <li class="example-service__item"><span>Desde 0.01% </span> - Interés al día</li>
                                <li class="example-service__item"><span>30 días</span> - de plazo</li>
                                <li class="example-service__item"><span>$10,000</span> - $10,000 máx.</li>
                            </ul>
                            <span class="example-service__btn-show">Ver más</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service__stars"></span>
                            <span class="example-service__rating">(<span>2427</span> votos)</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service-chart">9.2</span>
                        </div>
                        <div class="example-service__col">
                            <span class="example-service__btn">Consigue tu préstamo</span>
                        </div>
                    </div>
                </div>
            </div>

            <span class="services-hero-1 decor-grd-1"></span>
            <span class="services-hero-2 decor-grd-2"></span>
        </div>
    </div>
</section>





{{-- ? services --}}
<section id="services" class="services">

    <div class="services-preloader">
        <span class="services-preloader-text">Carga de datos...</span>
        <span class="services-preloader-svg"></span>
    </div>

    <div class="container">


        <div id="services-tabs" class="services-tabs">

            <div class="services-tabs__buttons">


                {{-- ? db --}}
                @foreach ($categories as $category)

                <button class="services-tabs__btn" type="button">{{ $category->name }}</button>

                @endforeach
                {{-- ? db --}}

                @if (auth('web')->user())

                <button class="services-tabs__btn" type="button">
                    Historial de créditos
                </button>

                @endif

            </div>

            <div class="services-tabs__content">


                {{-- ? db --}}
                @foreach ($categories as $category)

                <div class="services-accordion">
                    <button class="services-accordion__btn" type="button">
                        <span>{{ $category->name }}</span>
                        <svg viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L7 7L13 1" stroke="currentColor" />
                        </svg>
                    </button>
                    <div class="services-tabs__panel">
                        <div class="services-tabs__panel-top">
                            <h2 class="services-tabs__panel-title">{{ $category->title }}</h2>

                            <div class="services-tabs__list">

                                {{-- <li class="services-tabs__item">{{ $category->description }}</li> --}}
                                {!! $category->description !!}
                            </div>
                        </div>
                        <p class="services-tabs__panel-subtitle">Ranking de servicios de préstamos</p>


                        <div class="credit-services" data-category="{{ $category->slug}}"></div>

                    </div>
                </div>

                @endforeach
                {{-- ? db --}}


                @if (auth('web')->user())

                <div class="services-accordion">
                    <button class="services-accordion__btn" type="button">
                        <span>Historia de crédito</span>
                        <svg viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L7 7L13 1" stroke="currentColor" />
                        </svg>
                    </button>
                    <div class="services-tabs__panel">
                        <div class="services-tabs__panel-top">
                            <h2 class="services-tabs__panel-title">
                                Para mostrar correctamente el historial de aplicaciones, es necesario:
                            </h2>


                            <ul class="services-tabs__list">
                                <li class="services-tabs__item">
                                    Entrar a la cuenta personal de Trixy
                                </li>
                                <li class="services-tabs__item">
                                    Elija un servicio de préstamo y haga clic en el botón "Obtenga su préstamo"
                                </li>
                                <li class="services-tabs__item">
                                    Se abrirá el sitio web del servicio de crédito seleccionado.
                                </li>
                                <li class="services-tabs__item">
                                    solicitar un préstamo.
                                </li>
                            </ul>

                            <p class="services-tabs__text">
                                Recibimos información automáticamente de los servicios de crédito en pocas horas.
                            </p>

                        </div>


                    </div>
                </div>

                @endif


            </div>

        </div>




    </div>
</section>

{{-- ? why --}}
@include('frontend.includes.faq')



{{-- ? slider posts --}}

@include('frontend.includes.slider-posts')


{{-- ? info-section --}}

@include('frontend.includes.info-section')

@endsection