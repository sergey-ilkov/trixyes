@extends('frontend.layouts.forgot')

@section('content')


<section class="forgot">

    <div class="container">

        <div class="forgot-body bg-grd-1">

            <div class="forgot__title">{{ __('Cambio de contraseña') }}</div>


            <div class="forgot-preloader">
                <img width="80" height="80" src="{{ asset('images/icons/circles-anim.svg') }}" alt="">
            </div>

            <div class="forgot-success">
                <span class="forgot-success__title">
                    {{ __('¡La contraseña se cambió correctamente!') }}
                </span>
                <span class="forgot-success__text">

                </span>
                <a class="form__link" href="{{ route('home') }}">
                    {{ __('Ir a la página principal') }}
                </a>
            </div>

            <form id="reset-password-form" class="forgot-form modal-form" method="POST" action="{{ route('reset.password.post') }}">



                <input id="token-forgot" type="hidden" name="token_forgot" value="{{ $token }}">





                <div class="modal-form-box">
                    <div class="modal-form-group">
                        <span class="forgot-form__text">

                            {{ __('Ingresa tu nueva contraseña.') }}

                        </span>
                    </div>




                    <div class="modal-form-group">
                        <label class="modal-form__label" for="password-forgot">Nueva contraseña:</label>
                        <div class="modal-form-group-pass">
                            <span class="pass-btn">
                                <span class="pass-btn-icon pass-btn-icon-hidden">
                                    <svg width="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </span>
                                <span class="pass-btn-icon pass-btn-icon-show">
                                    <svg width="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </span>
                            </span>

                            {{-- <input id="password-forgot" class="modal-form__input" type="password" placeholder="••••••••" autocomplete="off" name="password"> --}}
                            <input id="password-forgot" class="modal-form__input" type="password" placeholder="" autocomplete="off" name="password">

                        </div>
                        <span class="modal-form-text-group">
                            <span class="modal-form-text"> * mínimo 8 caracteres</span>
                            <span class="modal-form-text"> * la primera letra debe ser mayúscula</span>
                        </span>
                    </div>


                </div>


                <div class="message-errors"></div>


                <button type="button" class="forgot-form__btn btn-1 btn-send">

                    {{ __('Cambiar contraseña') }}

                </button>
            </form>
        </div>

    </div>
</section>

@endsection