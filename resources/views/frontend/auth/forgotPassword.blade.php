@extends('frontend.layouts.forgot')

@section('content')


<section class="forgot">

    <div class="container">

        <div class="forgot-body bg-grd-1">

            <div class="forgot__title">{{ _('Recuperación de contraseña') }}</div>


            <div class="forgot-preloader">
                <img width="80" height="80" src="{{ asset('images/icons/circles-anim.svg') }}" alt="">
            </div>

            <div class="forgot-success">
                <span class="forgot-success__title">
                    {{ __('Hemos enviado un enlace para cambiar la contraseña a tu correo electrónico.') }}
                </span>
                <span class="forgot-success-group">
                    <span class="forgot-success__text">{{ __('¡Importante! ') }}</span>
                    <span class="forgot-success__text">{{ __('El enlace es válido por 10 minutos.') }}</span>
                </span>
            </div>



            <form id=forgot-form class="forgot-form modal-form" method="POST" action="{{ route('forgot.password.post') }}">

                @csrf

                <div class="modal-form-box">
                    <div class="modal-form-group">
                        <span class="forgot-form__text">
                            {{ __('Ingresa tu correo electrónico.') }}
                        </span>
                        <span class="forgot-form__text">
                            {{ __('Te enviaremos un enlace para recuperar tu contraseña.') }}
                        </span>
                    </div>
                    <div class="modal-form-group">
                        <label class="modal-form__label" for="email-forgot">Email:</label>
                        <input id="email-forgot" class="modal-form__input" type="text" placeholder="example@gmail.com" autocomplete="off" name="email">
                    </div>
                </div>


                <div class="message-errors"></div>


                <button type="button" class="forgot-form__btn btn-1 btn-send">

                    {{ __('Obtener enlace') }}

                </button>
            </form>
        </div>

    </div>
</section>

@endsection