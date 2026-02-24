@extends('frontend.layouts.base')


@once

@push('css')

<link rel="preload" as="image" href="{{ asset('images/home/hero.webp') }}" />

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

{{-- ? hero --}}
<section class="hero">
    <div class="container">
        <div class="hero__inner">
            <div class="hero-content">
                <h1 class="hero__title title-h1">
                    Hacemos los préstamos
                    <br>
                    <span class="accent-color">
                        más accesibles
                        y económicos
                    </span>
                </h1>




                <ul class="hero__list">
                    <li class="hero__item">
                        Ranking de préstamos en línea
                    </li>
                    <li class="hero__item">
                        Aprovecha promociones y ahorra
                    </li>
                    <li class="hero__item">
                        Alta probabilidad de ser aprobado
                    </li>
                </ul>


                @if (auth('web')->user())

                <a class="example__link btn-1" href="{{ route('services') }}">
                    Ver ranking

                </a>

                @else

                <button class="hero__btn btn-1 modal-btn" type="button" data-target="sign-up">
                    Registrarse

                </button>

                @endif



            </div>
            <img width="533" height="533" class="hero__img" src="{{ asset('images/home/hero.webp') }}" alt="Niña se registra en Trixy">
            <span class="hero-decor-1 decor-grd-1"></span>
            <span class="hero-decor-2 decor-grd-2"></span>
        </div>
    </div>
</section>

{{-- ? examples-services --}}


<section class="examples-services">
    <div class="container">
        <div class="examples">
            <div class="example example-1">
                <div class="example-box bg-grd-1">
                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/kueski.svg') }}" alt="Logo Kueski">
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
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/vivus.svg') }}" alt="Logo Vivus">
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
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/dineria.svg') }}" alt="Logo Dineria">
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
                            <div class="example-service-chart__box">
                                <span class="example-service-chart">9.5</span>
                                <span class="example-service-chart__name">T-ranking</span>
                            </div>

                        </div>
                        <div class="example-service__col">
                            <span class="example-service__btn">Consigue tu préstamo</span>
                        </div>
                    </div>
                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/kubofinanciero.svg') }}" alt="Logo Kubofinanciero">
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
                <div class="example-content">
                    <h2 class="example__title title-h2">
                        <span class="accent-color"> T-ranking</span>
                        <br>
                        de préstamos en línea
                    </h2>
                    <div class="example-desc">
                        <p class="example__text">
                            Elige el préstamo que mejor
                            <br>
                            se adapte a tus necesidades
                        </p>
                    </div>

                    <a class="example__link btn-1" href="{{ route('services') }}">Ver ranking</a>

                </div>

                <div class="example-1__decor-1 decor-grd-1"></div>
                <div class="example-1__decor-2 decor-grd-1"></div>

            </div>



            <div class="example example-2">
                <div class="example-content">
                    <h2 class="example__title title-h2">
                        <span class="accent-color">El T-Ranking</span> se actualiza constantemente con IA en función de
                    </h2>
                </div>

                <div class="example-scheme">

                    <div class="example-scheme__box">
                        <span class="example-scheme__box-rating">9.5</span>
                        <span class="example-scheme__box__name">T-ranking</span>
                    </div>


                    <div class="example-scheme__items">
                        <div class="example-scheme__item bg-grd-1">
                            <span class="example-scheme__item-icon"></span>
                            <span>
                                Tasa de aprobación del servicio
                            </span>
                        </div>
                        <div class="example-scheme__item bg-grd-1">
                            <span class="example-scheme__item-icon"></span>
                            <span>
                                Costo del préstamo (intereses)
                            </span>
                        </div>
                        <div class="example-scheme__item bg-grd-1">
                            <span class="example-scheme__item-icon"></span>
                            <span>
                                Popularidad del servicio
                            </span>
                        </div>
                        <div class="example-scheme__item bg-grd-1">
                            <span class="example-scheme__item-icon"></span>
                            <span>
                                Opiniones reales sobre la empresa
                            </span>
                        </div>
                        <div class="example-scheme__item bg-grd-1">
                            <span class="example-scheme__item-icon"></span>
                            <span>
                                Tiempo de aprobación
                            </span>
                        </div>
                    </div>
                </div>

                <div class="example-2__decor-1 decor-grd-1"></div>
                <div class="example-2__decor-2 decor-grd-1"></div>

            </div>



            <div class="example example-3">

                <div class="example-box bg-grd-1">

                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/kueski.svg') }}" alt="Logo Kueski">
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
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/vivus.svg') }}" alt="Logo Vivus">
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
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/dineria.svg') }}" alt="Logo Dineria">
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
                            <div class="example-service-chart__box">
                                <span class="example-service-chart">9.5</span>
                                <span class="example-service-chart__name">T-Aprobación</span>
                            </div>

                        </div>
                        <div class="example-service__col">
                            <span class="example-service__btn">Consigue tu préstamo</span>
                        </div>
                    </div>
                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/kubofinanciero.svg') }}" alt="Logo Kubofinanciero">
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

                <div class="example-content">
                    <h2 class="example__title title-h2">
                        <span class="accent-color"> T-Aprobación</span>
                        <br>
                        Más posibilidades

                        <span class="accent-color">de aprobación</span>
                    </h2>
                    <div class="example-desc">

                        <p class="example__text">
                            Solicita en los servicios con

                            <br>
                            mayor aprobación de solicitudes

                            <br>
                            (según el ranking de T-Aprobación)

                        </p>
                    </div>
                    <a class="example__link btn-1" href="{{ route('services') }}">Ver ranking</a>
                </div>

                <div class="example-3__decor-1 decor-grd-2"></div>
                <div class="example-3__decor-2 decor-grd-1"></div>

            </div>




            <div class="example example-4">

                <div class="example-box bg-grd-1">

                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/kueski.svg') }}" alt="Logo Kueski">
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
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/vivus.svg') }}" alt="Logo Vivus">
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
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/dineria.svg') }}" alt="Logo Dineria">
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
                            <div class="example-service-chart__box">
                                <span class="example-service-chart">9.5</span>
                                <span class="example-service-chart__name">T-Costo</span>
                            </div>

                        </div>
                        <div class="example-service__col">
                            <span class="example-service__btn">Consigue tu préstamo</span>
                        </div>
                    </div>
                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/kubofinanciero.svg') }}" alt="Logo Kubofinanciero">
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

                <div class="example-content">
                    <h2 class="example__title title-h2">
                        <span class="accent-color"> T-Costo</span>
                        <br>
                        Préstamos

                        <span class="accent-color">sin intereses</span>
                    </h2>
                    <div class="example-desc">

                        <p class="example__text">
                            Solicita en los servicios
                            <br>
                            con la tasa más baja
                            <br>
                            (según el ranking de T-Costo)
                        </p>
                    </div>
                    <a class="example__link btn-1" href="{{ route('services') }}">Ver ranking</a>
                </div>

                <div class="example-4__decor-1 decor-grd-1"></div>
                <div class="example-4__decor-2 decor-grd-1"></div>

            </div>




            <div class="example example-5">

                <div class="example-box bg-grd-1">

                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/kueski.svg') }}" alt="Logo Kueski">
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
                    <div class="example-service example-service-column">
                        <div class="example-service-top">
                            <div class="example-service__col">
                                <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/dineria.svg') }}" alt="Logo Dineria">
                                <span class="example-service__title">“Dineria”</span>
                            </div>
                            <div class="example-service__col">
                                <ul class="example-service__list">
                                    <li class="example-service__item"><span>Desde 0.01% </span> - Interés al día</li>
                                    <li class="example-service__item"><span>30 días</span> - de plazo</li>
                                    <li class="example-service__item"><span>$10,000</span> - $10,000 máx.</li>
                                </ul>
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

                        <div class="example-service-promocode">
                            <div class="example-service-promocode__row">
                                <span class="example-service-promocode__col">Código promocional:</span>
                                <span class="example-service-promocode__col">TRY100</span>
                            </div>
                            <div class="example-service-promocode__row">
                                <span class="example-service-promocode__col">Descuento con código:</span>
                                <span class="example-service-promocode__col">50%</span>
                            </div>
                        </div>


                    </div>
                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/vivus.svg') }}" alt="Logo Vivus">
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



                </div>

                <div class="example-content">
                    <h2 class="example__title title-h2">
                        Códigos promocionales con

                        <br>
                        <span class="accent-color">hasta 70% de descuento</span>
                    </h2>
                    <div class="example-desc">

                        <p class="example__text">
                            Regístrate y descubre

                            <br>
                            los mejores códigos promocionales

                        </p>
                    </div>

                    @if (auth('web')->user())

                    <a class="example__link btn-1" href="{{ route('services') }}">Ver ranking</a>

                    @else

                    <button class="example__btn btn-1 modal-btn" type="button" data-target="sign-up">Registrarse</button>

                    @endif


                </div>

                <div class="example-5__decor-1 decor-grd-2"></div>
                <div class="example-5__decor-2 decor-grd-1"></div>

            </div>




            <div class="example example-6">

                <div class="example-box">

                    <p class="example-box__text">
                        En cambio, usas el código
                        <br>


                        <span class="accent-color">promocional de Trixy</span>
                        y ahorras
                        <span class="accent-color">150 pesos</span>
                    </p>
                    <div class="example-box__items">
                        <div class="example-box__item">
                            <span>Código promo</span>
                            <span>+86$</span>
                        </div>
                        <div class="example-box__item">
                            <span>Código promo</span>
                            <span>+120$</span>
                        </div>
                        <div class="example-box__item">
                            <span>Código promo</span>
                            <span>+258$</span>
                        </div>
                    </div>


                </div>

                <div class="example-content">
                    <h2 class="example__title title-h2">
                        Ejemplo de reducción del costo

                        <br>
                        del préstamo gracias a un

                        <br>
                        código promocional

                    </h2>
                    <div class="example-desc">

                        <p class="example__text">
                            Necesitas

                            <span class="color-white">$2,000 pesos</span>
                            hasta tu próximo pago (15 días).

                        </p>
                        <p class="example__text">
                            Sin código promocional, pagarás en promedio

                            <span class="color-red">300 pesos más</span>
                            que con el código
                        </p>
                    </div>

                    @if (auth('web')->user())

                    <a class="example__link btn-1" href="{{ route('services') }}">Ver ranking</a>

                    @else

                    <button class="example__btn btn-1 modal-btn" type="button" data-target="sign-up">Registrarse</button>

                    @endif

                </div>

                <div class="example-6__decor-1 decor-grd-2"></div>

            </div>





            <div class="example example-7">

                <div class="example-box">

                    <div id="services-slider" class="services-slider swiper">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="services-slider__item">
                                    <img width="160" height="80" class="services-slider__item-img lazy" data-src="{{ asset('images/services/kueski.svg') }}" alt="Logo Kueski">
                                    <span class="services-slider__item-title">Kueski</span>
                                    <span class="services-slider__item-btn">Cambiar</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="services-slider__item">
                                    <img width="160" height="80" class="services-slider__item-img lazy" data-src="{{ asset('images/services/vivus.svg') }}" alt="Logo Vivus">
                                    <span class="services-slider__item-title">Vivus</span>
                                    <span class="services-slider__item-btn">Cambiar</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="services-slider__item">
                                    <img width="160" height="80" class="services-slider__item-img lazy" data-src="{{ asset('images/services/dineria.svg') }}" alt="Logo Dineria">
                                    <span class="services-slider__item-title">Dineria</span>
                                    <span class="services-slider__item-btn">Cambiar</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="services-slider__item">
                                    <img width="160" height="80" class="services-slider__item-img lazy" data-src="{{ asset('images/services/kubofinanciero.svg') }}" alt="Logo Kubofinanciero">
                                    <span class="services-slider__item-title">Kubofinanciero</span>
                                    <span class="services-slider__item-btn">Cambiar</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="services-slider__item">
                                    <img width="160" height="80" class="services-slider__item-img lazy" data-src="{{ asset('images/services/clicredito.svg') }}" alt="Logo Clicredito">
                                    <span class="services-slider__item-title">Clicredito</span>
                                    <span class="services-slider__item-btn">Cambiar</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="services-slider__item">
                                    <img width="160" height="80" class="services-slider__item-img lazy" data-src="{{ asset('images/services/dineromon.svg') }}" alt="Logo Dineromon">
                                    <span class="services-slider__item-title">Dineromon</span>
                                    <span class="services-slider__item-btn">Cambiar</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="services-slider__item">
                                    <img width="160" height="80" class="services-slider__item-img lazy" data-src="{{ asset('images/services/lanu.svg') }}" alt="Logo Lanu">
                                    <span class="services-slider__item-title">Lanu</span>
                                    <span class="services-slider__item-btn">Cambiar</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="services-slider__item">
                                    <img width="160" height="80" class="services-slider__item-img lazy" data-src="{{ asset('images/services/turbopeso.svg') }}" alt="Logo Turbopeso">
                                    <span class="services-slider__item-title">Turbopeso</span>
                                    <span class="services-slider__item-btn">Cambiar</span>
                                </div>
                            </div>



                        </div>

                        <div class="swiper-pagination swiper-pagination-services"></div>

                    </div>

                </div>

                <div class="example-content">

                    <h2 class="example__title title-h2">
                        <span class="accent-color">Cambiar</span>
                        servicios
                        <br>
                        de préstamos

                    </h2>
                    <div class="example-desc">

                        <p class="example__text">
                            Recordaremos dónde ya solicitaste un préstamo y te mostraremos nuevos para que elijas el mejor

                        </p>
                    </div>

                    @if (auth('web')->user())

                    <a class="example__link btn-1" href="{{ route('services') }}">Ver ranking</a>

                    @else

                    <button class="example__btn btn-1 modal-btn" type="button" data-target="sign-up">Registrarse</button>

                    @endif

                </div>

                <div class="example-7__decor-1 decor-grd-1"></div>

            </div>



            <div class="example example-8">

                <div class="example-box bg-grd-1">

                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/kueski.svg') }}" alt="Logo Kueski">
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
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/vivus.svg') }}" alt="Logo Vivus">
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
                    <div class="example-service example-service-column">
                        <div class="example-service-top">

                            <div class="example-service__col">
                                <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/dineria.svg') }}" alt="Logo Dineria">
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
                                <span class="example-service__btn-2">Consigue tu préstamo</span>
                            </div>
                        </div>
                        <div class="example-newbtn-wrapper">
                            <div class="example-newbtn">
                                <span class="example-newbtn-icon"></span>
                                <span>Ocultar</span>
                            </div>
                            <span class="example-newbtn-decor"></span>
                        </div>

                    </div>

                </div>

                <div class="example-content">
                    <h2 class="example__title title-h2">
                        <span class="accent-color">Oculta los servicios</span>
                        <br>
                        que no te funcionaron
                    </h2>
                    <div class="example-desc">

                        <p class="example__text">
                            Para no tenerlos en cuenta
                            <br>
                            en el futuro
                        </p>
                    </div>

                    @if (auth('web')->user())

                    <a class="example__link btn-1" href="{{ route('services') }}">Ver ranking</a>

                    @else

                    <button class="example__btn btn-1 modal-btn" type="button" data-target="sign-up">Registrarse</button>

                    @endif

                </div>

                <div class="example-8__decor-1 decor-grd-1"></div>


            </div>



            <div class="example example-9">

                <div class="example-box bg-grd-1">

                    <div class="example-service">
                        <div class="example-service__col">
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/kueski.svg') }}" alt="Logo Kueski">
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
                            <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/vivus.svg') }}" alt="Logo Vivus">
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
                    <div class="example-service example-service-column">
                        <div class="example-service-top">

                            <div class="example-service__col">
                                <img width="160" height="80" class="example-service__logo lazy" data-src="{{ asset('images/services/dineria.svg') }}" alt="Logo Dineria">
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
                                <span class="example-service__btn-2">Consigue tu préstamo</span>
                            </div>
                        </div>
                        <div class="example-newbtn-wrapper">
                            <div class="example-newbtn">
                                <span class="example-newbtn-icon"></span>
                                <span>Historial</span>
                            </div>
                            <span class="example-newbtn-decor"></span>
                        </div>

                    </div>

                    <div class="example-modal bg-grd-1">
                        <span class="example-modal__title">Historial</span>
                        <div class="example-modal__items">
                            <div class="example-modal__item">
                                <span class="example-modal__item-col">Acción</span>
                                <span class="example-modal__item-col">Fecha</span>
                            </div>
                            <div class="example-modal__item">
                                <span class="example-modal__item-col">Solicitud de préstamo (aprobada)</span>
                                <span class="example-modal__item-col">10.12.2024</span>
                            </div>
                            <div class="example-modal__item">
                                <span class="example-modal__item-col">Ocultaste el servicio</span>
                                <span class="example-modal__item-col">10.12.2024</span>
                            </div>
                            <div class="example-modal__item">
                                <span class="example-modal__item-col">Activaste el servicio</span>
                                <span class="example-modal__item-col">10.12.2024</span>
                            </div>
                            <div class="example-modal__item">
                                <span class="example-modal__item-col">Solicitud de préstamo (en revisión)</span>
                                <span class="example-modal__item-col">10.12.2024</span>
                            </div>
                        </div>

                        <span class="example-modal__btn">Cerrar</span>
                    </div>

                </div>

                <div class="example-content">
                    <h2 class="example__title title-h2">
                        Historial

                        <span class="accent-color">de actividad</span>
                    </h2>
                    <div class="example-desc">

                        <p class="example__text">
                            Consulta el historial de interacción

                            <br>
                            con cada servicio de préstamos para no olvidar nada

                        </p>
                    </div>

                    @if (auth('web')->user())

                    <a class="example__link btn-1" href="{{ route('services') }}">Ver ranking</a>

                    @else

                    <button class="example__btn btn-1 modal-btn" type="button" data-target="sign-up">Registrarse</button>

                    @endif

                </div>

                <div class="example-9__decor-1 decor-grd-1"></div>

            </div>


        </div>

    </div>
</section>



{{-- ? why --}}
<section class="why">
    <div class="container">
        <h2 class="why__title title-h2">
            Por qué
            <span class="accent-color">elegir</span>
            TRIXY
        </h2>
        <div class="why__items">
            <div class="why__item bg-grd-1">
                <span class="why__item-icon"></span>
                <h3 class="why__item-title">
                    Ranking de servicios — T-Ranking
                </h3>
                <p class="why__item-text">
                    Analizamos constantemente el costo, la tasa de aprobación y la facilidad de uso de los servicios que te ofrecemos

                </p>
            </div>
            <div class="why__item bg-grd-1">
                <span class="why__item-icon"></span>
                <h3 class="why__item-title">
                    Ahorro de dinero
                </h3>
                <p class="why__item-text">
                    Paga menos intereses usando códigos promocionales

                </p>
            </div>
            <div class="why__item bg-grd-1">
                <span class="why__item-icon"></span>
                <h3 class="why__item-title">
                    Códigos promocionales exclusivos

                </h3>
                <p class="why__item-text">
                    Al registrarte en el servicio obtienes acceso a códigos promocionales exclusivos que no están disponibles públicamente

                </p>
            </div>
            <div class="why__item bg-grd-1">
                <span class="why__item-icon"></span>
                <h3 class="why__item-title">
                    Todos los servicios en un solo lugar

                </h3>
                <p class="why__item-text">
                    Reunimos para ti los mejores servicios de préstamos en un solo lugar para que no pierdas tiempo buscándolos y analizándolos

                </p>
            </div>
            <div class="why__item bg-grd-1">
                <span class="why__item-icon"></span>
                <h3 class="why__item-title">
                    Ofertas personalizadas

                </h3>
                <p class="why__item-text">
                    En tu cuenta personal te mostraremos las mejores opciones de préstamos según tu historial crediticio y tus beneficios

                </p>
            </div>
            <div class="why__item bg-grd-1">
                <span class="why__item-icon"></span>
                <h3 class="why__item-title">
                    Tu historial

                </h3>
                <p class="why__item-text">
                    Consulta el historial de tus solicitudes a servicios de préstamos para entender tus posibilidades de acudir a otros

                </p>
            </div>
        </div>
    </div>
</section>


{{-- ? reviews --}}

@include('frontend.includes.reviews')




{{-- ? why --}}
@include('frontend.includes.faq')



{{-- ? slider posts --}}

@include('frontend.includes.slider-posts')



{{-- ? info-section --}}

@include('frontend.includes.info-section')


@endsection