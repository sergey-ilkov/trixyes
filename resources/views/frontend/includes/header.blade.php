
<header class="header">
    <div class="container">
        <div class="header__inner">

            <a class="header-logo" href="{{ route('home') }}">
                <img width="100" height="23" class="header-logo__img" src="{{ asset('images/logo.svg') }}" alt="logo">
            </a>


            {{-- ? languages  start--}}
           
            {{-- <div style="display: flex; gap:20px; padding:0 20px;">

                @foreach ( \App\Helpers\Langs::LOCALES as $locale)

                               
                   @if ($locale == app()->getLocale())
                       <span style="color:#65F967; font-weight: 500; ">{{ $locale }}</span>
                   @else

                   @if (request()->is('blog/*') || request()->is('*/blog/*'))
                   
                   <span  style="color:#bcbcbc; ">{{ $locale }}</span>
                   @else
                       
                   <a href="{{ getUrlLanguage($locale) }}" style="color:#bcbcbc; ">{{ $locale }}</a>
                   @endif

                   @endif
                  
                @endforeach
           
            </div> --}}
            {{-- ? languages end --}}

            <nav id="nav-menu" class="nav-menu">
                <ul class="header-menu">
                    <li class="header-menu__item">
                        <a class="header-menu__link {{ active_link('home') }}" href="{{ route('home') }}">{{ __('header.links.home') }}</a>
                    </li>
                    <li class="header-menu__item">
                        <a class="header-menu__link {{ active_link('services') }}" href="{{ route('services') }}">{{ __('header.links.services') }}</a>
                    </li>
                    <li class="header-menu__item">
                        <a class="header-menu__link {{ active_link('blog') }}" href="{{ route('blog') }}">{{ __('header.links.blog') }}</a>
                    </li>
                    <li class="header-menu__item">
                        <a class="header-menu__link {{ active_link('about') }}" href="{{ route('about') }}">{{ __('header.links.about') }}</a>
                    </li>
                    <li class="header-menu__item">
                        <a class="header-menu__link {{ active_link('contacts') }}" href="{{ route('contacts') }}">{{ __('header.links.contacts') }}</a>
                    </li>
                </ul>

                @if (!auth('web')->user())

                <div class="header__buttons">
                    <button class="header-btn header-btn-1 modal-btn" type="button" data-target="sign-up">{{ __('header.buttons.registration') }}</button>
                    <button class="header-btn header-btn-2 modal-btn" type="button" data-target="sign-in">{{ __('header.buttons.login') }}</button>
                </div>

                @endif

            </nav>

            @if (auth('web')->user())

            <div id="user-auth" class="user-auth">
                <button class="user-auth__btn" type="button">
                    {{ mb_substr(auth('web')->user()->name, 0, 1) }}
                </button>
                <div class="user-menu">
                    <button class="user-menu__btn-close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="user-menu-top">
                        <span class="user-auth__avatar">
                            {{ mb_substr(auth('web')->user()->name, 0, 1) }}
                        </span>
                        <span class="user-auth__name">
                            {{ auth('web')->user()->name }}
                            {{ auth('web')->user()->surname }}
                        </span>
                    </div>
                    <a class="user-auth__logout" href="{{ route('user.logout') }}">
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                            <path
                                d="M2 2.75C2 1.784 2.784 1 3.75 1h2.5a.75.75 0 0 1 0 1.5h-2.5a.25.25 0 0 0-.25.25v10.5c0 .138.112.25.25.25h2.5a.75.75 0 0 1 0 1.5h-2.5A1.75 1.75 0 0 1 2 13.25Zm10.44 4.5-1.97-1.97a.749.749 0 0 1 .326-1.275.749.749 0 0 1 .734.215l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.749.749 0 0 1-1.275-.326.749.749 0 0 1 .215-.734l1.97-1.97H6.75a.75.75 0 0 1 0-1.5Z">
                            </path>
                        </svg>
                        вийти
                    </a>
                </div>
            </div>

            @endif

            <button id="burger-menu" class="burger-menu" type="button">
                <span></span>
            </button>


        </div>
    </div>
</header>