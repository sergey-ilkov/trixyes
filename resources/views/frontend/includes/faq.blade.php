<section class="faq">
    <div class="container">
        <h2 class="faq__title title-h2">Preguntas frecuentes (FAQ)</h2>



        <div id="faq-accordion" class="faq__items">



            @foreach (__('faq') as $faq)

            <div class="faq__item">
                <button class="faq-item__btn" type="button">

                    {{ $faq['question'] }}

                    <span class="faq-item__btn-icon"></span>
                </button>

                <div class="faq-item-content">

                    @isset($faq['answer']['text'])

                    @foreach ($faq['answer']['text'] as $text)
                    <p class="faq-item__text">
                        {{ $text }}
                    </p>
                    @endforeach

                    @endisset

                    @isset($faq['answer']['ul'])
                    <ul>
                        @foreach ($faq['answer']['ul'] as $item)

                        <li>{{ $item }}</li>

                        @endforeach
                    </ul>
                    @endisset

                    @isset($faq['answer']['ol'])
                    <ol>
                        @foreach ($faq['answer']['ol'] as $item)

                        <li>{{ $item }}</li>

                        @endforeach
                    </ol>
                    @endisset

                    @isset($faq['answer']['text2'])

                    @foreach ($faq['answer']['text2'] as $text)
                    <p class="faq-item__text">
                        {{ $text }}
                    </p>
                    @endforeach

                    @endisset

                </div>
            </div>

            @endforeach



        </div>
        <div class="faq-decor decor-grd-1"></div>
    </div>
</section>