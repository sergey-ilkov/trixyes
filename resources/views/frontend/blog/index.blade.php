@extends('frontend.layouts.base')


@once

@push('css')

<link rel="preload" as="image" href="{{ asset('images/blog/hero.jpg') }}" />

@endpush

@endonce

@section('content')




{{-- ? blog-hero --}}
<section class="blog-hero">
    <div class="container">

        <div class="blog-hero__inner">

            <div class="blog-hero__content">
                <h1 class="blog-hero__title">
                    Regístrate y recibe ofertas personalizadas
                </h1>
                <p class="blog-hero__desc">
                    de servicios de préstamos seleccionadas por nuestros algoritmos especialmente para ti:

                </p>
                <ul class="blog-hero__list">
                    <li class="blog-hero__item">
                        tendremos en cuenta el Ranking T del servicio de crédito

                    </li>
                    <li class="blog-hero__item">
                        tendremos en cuenta los descuentos máximos disponibles

                    </li>
                    <li class="blog-hero__item">
                        tendremos en cuenta el historial de tus solicitudes de crédito anteriores

                    </li>
                </ul>

                @if (!auth('web')->user())

                <div class="blog-hero__actions">
                    <button class="blog-hero__btn btn-1 modal-btn" type="button" data-target="sign-up">
                        Registrarse
                    </button>

                    <a class="blog-hero__link btn-2" href="{{ route('about') }}">
                        Quiénes somos

                    </a>
                </div>


                @endif

            </div>

            <div class="blog-hero__image">
                <img width="643" height="403" class="blog-hero__img" src="{{ asset('images/blog/hero.jpg') }}" alt="">
            </div>

            <span class="blog-hero-decor-1 decor-grd-1"></span>
            <span class="blog-hero-decor-2 decor-grd-2"></span>

        </div>

    </div>
</section>




{{-- ? blog-content --}}
<section class="blog-content">
    <div class="container">
        <div class="blog-content__inner">
            <div class="blog">
                <h2 class="blog__title title-h2">
                    BLOG
                </h2>

                @if ($posts->isEmpty())

                <p class="info-text">No hay noticias todavía</p>

                @else

                <div class="blog__items">

                    @foreach ($posts as $post)

                    <div class="blog__item bg-grd-1">

                        <div class="blog__item-wrap">
                            <a class="blog__item-link-img" href="{{ route('article', $post->slug) }}">
                                <picture>
                                    <source media="(max-width: 600px)" srcset="{{ asset('storage/' . $post->image_min ) }}">
                                    <img class="blog__item-img lazy" src="{{ asset('images/loading.png') }}" data-src="{{ asset('storage/' . $post->image ) }}" alt="{{ $post->alt_image }}">
                                </picture>

                            </a>
                        </div>


                        <div class="blog__item-content">
                            <h3 class="blog__item-title">
                                <a class="blog__item-link-title" href="{{ route('article', $post->slug) }}">

                                    {{ $post->title }}

                                </a>
                            </h3>
                            <div class="blog__item-desc">

                                {!! $post->description !!}

                            </div>

                            <a class="blog__item-link btn-1" href="{{ route('article', $post->slug) }}">
                                Leer
                            </a>

                            <span class="blog__item-info">

                                {{ $post->created_at->format('d.m.Y') }}
                                ({{ $post->views }} visitas)

                            </span>
                        </div>
                    </div>

                    @endforeach

                </div>




                {{-- ? pagination --}}
                @if (method_exists($posts, 'links') && $posts->nextPageUrl() || $posts->previousPageUrl())


                <div class="blog-pagination">

                    @if ($posts->previousPageUrl())

                    <a class="blog-pagination__link" href="{{ $posts->previousPageUrl() }}">
                        <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.5" y="0.5" width="51" height="51" rx="25.5" transform="matrix(-1 0 0 1 51 0)" stroke="currentColor" />
                            <path d="M30 14L17.5 26.5L30 39" stroke="white" />
                        </svg>
                    </a>

                    @else

                    <span>
                        <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.5" y="0.5" width="51" height="51" rx="25.5" transform="matrix(-1 0 0 1 51 0)" stroke="currentColor" />
                            <path d="M30 14L17.5 26.5L30 39" stroke="white" />
                        </svg>
                    </span>

                    @endif


                    <div class="pagination-info">
                        @if ($posts->nextPageUrl())

                        {{ $posts->currentPage() * $posts->count() }}

                        @else

                        {{ $posts->total() }}

                        @endif

                        /

                        {{ $posts->total() }}

                    </div>

                    @if ($posts->nextPageUrl())

                    <a class="blog-pagination__link" href="{{ $posts->nextPageUrl() }}">
                        <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" y="0.5" width="51" height="51" rx="25.5" stroke="currentColor" />
                            <path d="M22 14L34.5 26.5L22 39" stroke="white" />
                        </svg>
                    </a>

                    @else

                    <span>
                        <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" y="0.5" width="51" height="51" rx="25.5" stroke="currentColor" />
                            <path d="M22 14L34.5 26.5L22 39" stroke="white" />
                        </svg>
                    </span>

                    @endif



                </div>


                @endif


                @endif


            </div>



            <div id="top-services" class="top-services">
                <h2 class="top-services__title title-h2">
                    TOP 10 SERVICIOS
                </h2>



                @if (!$services || $services->isEmpty())

                <p class="info-text">
                    Aún no hay servicios
                </p>

                @else

                <div class="top-services__items">


                    @foreach ($services as $service)


                    <div class="top-services__item 
                    
                    @if ($loop->iteration <= 3)
                        {{ 'active' }}                        
                    @endif
                    
                    bg-grd-1">

                        <div class="top-services__col">
                            <span class="top-services__item-num">#{{ $loop->iteration }}</span>
                        </div>
                        <div class="top-services__col">
                            <img class="top-services__item-img lazy" src="{{ asset('images/loading.png') }}" data-src="{{ asset('storage/' . $service->icon ) }}" alt="Логотип {{ $service->name }}">
                            <span class="top-services__item-title">"{{ $service->name }}"</span>
                        </div>
                        <div class="top-services__col">

                            <div class="top-services-stars" data-points="{{ $service->vote_rating }}"></div>

                            <span class="top-services__item-rating">({{ $service->vote_count }} votos)</span>
                        </div>
                        <div class="top-services__col">
                            <div class="top-services-chart" data-percent="{{ $service->pivot->rating }}"></div>
                            {{-- <div class="top-services-chart" data-percent="{{ $service->rating }}"></div> --}}
                        </div>
                        <div class="top-services__col">
                            <a class="top-services__item-link btn-1" href="{{ route('services') }}">Ver más</a>
                        </div>
                    </div>


                    @endforeach


                </div>



                @endif


            </div>
        </div>
    </div>
</section>




@endsection