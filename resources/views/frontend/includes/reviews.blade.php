<section class="reviews">
    <div class="container">
        <h2 class="reviews__title title-h2">Por qué la gente confía en TRIXY</h2>

        @if ($reviews->isEmpty())

        <p class="info-text">Aún no hay reseñas</p>

        @else

        <div id="reviews-slider" class="reviews-slider swiper">
            <div class="swiper-wrapper">


                @foreach ( $reviews as $review )

                <div class="swiper-slide">
                    <div class="reviews__item">
                        <div class="reviews__item-top">
                            <span class="reviews__item-initials">

                                {{ mb_substr($review->name, 0, 1) }}

                            </span>
                            <span class="reviews__item-name">

                                {{ $review->name }}
                                {{ $review->surname }}

                            </span>
                        </div>

                        <div class="reviews__item-rating">

                            @for ($i = 0; $i < 5; $i++) @if ($i < $review->rating)

                                <span class="reviews__item-star active"></span>

                                @else

                                <span class="reviews__item-star"></span>

                                @endif

                                @endfor



                        </div>
                        <div class="reviews__item-text">

                            {!! $review->text !!}

                        </div>
                    </div>
                </div>

                @endforeach


            </div>

            <div class="swiper-pagination swiper-pagination-reviews"></div>
        </div>

        @endif

    </div>

</section>