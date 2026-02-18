<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <img width="140" height="62" class="footer-logo" src="{{ asset('images/logo.svg') }}" alt="logo">
            <ul class="footer-menu">
                <li class="footer-menu__item">
                    <a class="footer-menu__link {{ active_link('home') }}" href="{{ route('home') }}">{{ __('header.links.home') }}</a>
                </li>
                <li class="footer-menu__item">
                    <a class="footer-menu__link {{ active_link('services') }}" href="{{ route('services') }}">{{ __('header.links.services') }}</a>
                </li>
                <li class="footer-menu__item">
                    <a class="footer-menu__link {{ active_link('blog') }}" href="{{ route('blog') }}">{{ __('header.links.blog') }}</a>
                </li>
                <li class="footer-menu__item">
                    <a class="footer-menu__link {{ active_link('about') }}" href="{{ route('about') }}">{{ __('header.links.about') }}</a>
                </li>
                <li class="footer-menu__item">
                    <a class="footer-menu__link {{ active_link('contacts') }}" href="{{ route('contacts') }}">{{ __('header.links.contacts') }}</a>
                </li>
            </ul>

            @if (auth('web')->user())

            <a class="example__link btn-1" href="{{ route('services') }}">
                Ver ranking

            </a>

            @else

            <button class="footer__btn btn-1 modal-btn" type="button" data-target="sign-up">
                Registrarse

            </button>

            @endif



        </div>
        <p class="copyright">
            © Todos los derechos reservados 2024
        </p>
    </div>
</footer>