<section class="section-slider-posts">
    <div class="container">


        <h2 class="section-slider-posts__title title-h2">Descubre más sobre los préstamos</h2>

        @if ($posts->isEmpty())
        <p class="info-text">Aún no hay artículos para el control deslizante.</p>
        @else



        <div id="slider-posts" class="slider-posts swiper">

            <div class="swiper-wrapper">


                @foreach ($posts as $post)

                <div class="swiper-slide">

                    <div class="slider-post__item">


                        <div class="slider-post__item-image">
                            <a href="{{ route('article', $post->slug) }}" class="slider-post__img-link">

                                <img class="lazy" src="{{ asset('images/loading.png') }}" data-src="{{ asset('storage/' . $post->image_min) }}" alt="{{ $post->alt_image }}">
                            </a>
                        </div>

                        <div class="slider-post__content">

                            <div class="slider-post__content-text">


                                <h3 class="slider-post__item-title">{{ $post->title }}</h3>


                                <div class="slider-post__item-desc">{!! $post->description !!}</div>

                            </div>


                            <a href="{{ route('article', $post->slug) }}" class="slider-post__item-link">Leer más</a>
                        </div>


                    </div>
                </div>


                @endforeach

            </div>

            <div class="slider-posts-buttons">
                <div class="slider-posts-btn-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>


                </div>

                <div class="slider-posts-btn-next">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>

                </div>
            </div>

        </div>

        @endif



    </div>
</section>