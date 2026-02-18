{{-- ? modals window --}}
{{-- ? modal history auth --}}
{{-- ? auth('web')->user() = Auth::guard('web')->user() --}}
@if (auth('web')->user())

<div id="history" class="modal">
    <div class="modal-body bg-grd-1">
        <div class="modal__title">
            Historial de créditos
        </div>

        <div class="modal-body-history">

            <div class="preloader-modal-body-history"></div>

            <div class="modal-history__items">


            </div>

        </div>

        <button class="modal__btn-close btn-1" type="button">Cerrar</button>
    </div>
</div>

@else

{{-- ? modal sign-in --}}
<div id="sign-in" class="modal">
    <div class="modal-body bg-grd-1">

        <div class="modal-preloader"></div>

        <div class="modal__title">Iniciar sesión</div>
        <form class="modal-form" action="{{ route('user.login') }}">

            <div class="modal-form-box">
                <div class="modal-form-group">
                    <label class="modal-form__label" for="email-sign-in">Email:</label>
                    <input id="email-sign-in" class="modal-form__input" type="text" placeholder="example@gmail.com" autocomplete="off" name="email">
                </div>

                <div class="modal-form-group">

                    <label class="modal-form__label" for="password-sign-in">Contraseña:</label>
                    <div class="modal-form-group-pass">
                        <span id="pass-btn-sign-in" class="pass-btn">
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

                        <input id="password-sign-in" class="modal-form__input" type="password" placeholder="••••••••" autocomplete="off" name="password">
                    </div>
                </div>

            </div>


            <div class="message-errors"></div>

            <button id="btn-sign-in" type="button" class="modal-form__btn btn-1 btn-send">Entrar</button>
        </form>

        <div class="modal-form-group">
            <button id="modal-btn-forgot" class="modal-btn-forgot" type="button" data-target="forgot-password">
                {{ __('Recuperar contraseña') }}
            </button>
            {{-- <a class="modal-form__link form__link" href="{{ route('forgot.password') }}" target="_blank">{{ __('Відновити пароль') }}</a> --}}

        </div>




    </div>
</div>

{{-- ? modal forgot-password --}}
<div id="forgot-password" class="modal">

    <div class="modal-body bg-grd-1">

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



        <form id="forgot-password-form" class="forgot-form modal-form" method="POST" action="{{ route('forgot.password.post') }}">


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

{{-- ? modal sign-up --}}
<div id="sign-up" class="modal">
    <div class="modal-body bg-grd-1">

        <div class="modal-preloader">
            <span id="message-success" class="message-success"></span>
        </div>

        <div class="modal__title">Registro</div>
        <p class="modal__subtitle">
            Regístrate y descubre los mejores códigos promocionales en servicios de crédito

        </p>

        <form class="modal-form" action="{{ route('user.register') }}">

            <div class="modal-form-box">
                <div class="modal-form-row">
                    <div class="modal-form-group">
                        <label class="modal-form__label" for="user-name">Nombre:</label>
                        <input id="user-name" class="modal-form__input" type="text" placeholder="Nombre" autocomplete="off" name="name">
                    </div>
                    <div class="modal-form-group">
                        <label class="modal-form__label" for="user-surname">Apellido:</label>
                        <input id="user-surname" class="modal-form__input" type="text" placeholder="Apellido" autocomplete="off" name="surname">
                    </div>
                </div>
                <div class="modal-form-row">
                    <div class="modal-form-group">
                        <label class="modal-form__label" for="birthday">Fecha de nacimiento:</label>
                        <input id="birthday" class="modal-form__input" type="date" autocomplete="off" name="birthday">

                    </div>
                    <div class="modal-form-group">
                        <label class="modal-form__label" for="phone-sign-up">Número de teléfono:</label>
                        <div class="modal-form-group-phone">
                            <span id="phone-code-sign-up" class="phone-code" data-phone-code="+34">+34</span>
                            <input id="phone-sign-up" class="modal-form__input modal-form__input-phone" type="text" placeholder="000 000 00 00" autocomplete="off" name="phone">
                        </div>

                    </div>
                </div>


                <div class="modal-form-row">
                    <div class="modal-form-group">
                        <label class="modal-form__label" for="email-sign-up">Email:</label>
                        <input id="email-sign-up" class="modal-form__input" type="email" placeholder="example@gmail.com" autocomplete="off" name="email">

                    </div>
                    <div class="modal-form-group">


                        <label class="modal-form__label" for="password-sign-up">Crea una contraseña:</label>
                        <div class="modal-form-group-pass">

                            <span id="pass-btn" class="pass-btn">
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

                            <input id="password-sign-up" class="modal-form__input" type="password" placeholder="••••••••" autocomplete="off" name="password">
                        </div>
                        <span class="modal-form-text-group">
                            <span class="modal-form-text">* mínimo 8 caracteres</span>
                            <span class="modal-form-text">* la primera letra debe ser mayúscula</span>
                        </span>

                    </div>
                </div>

                <div class="modal-form-group">
                    <button type="button" class="modal-form__btn btn-1 btn-confirm-email">Confirmar correo electrónico</button>
                </div>

                <div class="code-confirm-box">
                    <div id="code-preloader" class="code-preloader">
                        <svg class="svg-email" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M136.045 118.149H44.8314C37.684 118.149 31.8687 112.334 31.8687 105.187V88.4583C31.8687 87.095 32.9734 85.9886 34.3384 85.9886C35.7033 85.9886 36.8081 87.095 36.8081 88.4583V105.187C36.8081 109.611 40.4073 113.21 44.8314 113.21H136.045C140.469 113.21 144.068 109.609 144.068 105.187V44.6454C144.068 40.2213 140.467 36.622 136.045 36.622H44.8314C40.4073 36.622 36.8081 40.2213 36.8081 44.6454V61.1728C36.8081 62.5377 35.7033 63.6425 34.3384 63.6425C32.9734 63.6425 31.8687 62.5377 31.8687 61.1728V44.6454C31.8687 37.498 37.684 31.6826 44.8314 31.6826H136.045C143.192 31.6826 149.008 37.498 149.008 44.6454V105.187C149.008 112.334 143.192 118.149 136.045 118.149Z" fill="currentColor"></path>
                            <path d="M105.758 74.916L133.297 49.6523C134.301 48.7303 134.369 47.1678 133.449 46.1618C132.527 45.1574 130.966 45.0916 129.96 46.0119L90.4374 82.2692L50.9185 46.0119C49.9125 45.0916 48.3517 45.1574 47.428 46.1618C46.5059 47.1661 46.5735 48.7303 47.5778 49.6523L75.1169 74.916L47.5778 100.181C46.5735 101.105 46.5059 102.666 47.428 103.67C47.9153 104.202 48.5805 104.47 49.249 104.47C49.845 104.47 50.4443 104.255 50.9185 103.82L78.7705 78.2666L88.7679 87.4391C89.2388 87.8722 89.8381 88.0895 90.4374 88.0895C91.0368 88.0895 91.6361 87.8722 92.107 87.4391L102.106 78.2666L129.96 103.82C130.434 104.255 131.032 104.47 131.629 104.47C132.296 104.47 132.963 104.202 133.449 103.67C134.371 102.666 134.303 101.103 133.297 100.181L105.758 74.916Z" fill="currentColor"></path>
                            <path d="M42.6828 77.3857H13.2371C11.8721 77.3857 10.7673 76.2809 10.7673 74.916C10.7673 73.551 11.8721 72.4462 13.2371 72.4462H42.6844C44.0494 72.4462 45.1542 73.551 45.1542 74.916C45.1542 76.2809 44.0477 77.3857 42.6828 77.3857Z" fill="currentColor"></path>
                            <path d="M21.4003 60.124H3.29395C1.92901 60.124 0.824219 59.0192 0.824219 57.6542C0.824219 56.2893 1.92901 55.1845 3.29395 55.1845H21.4003C22.7653 55.1845 23.8701 56.2893 23.8701 57.6542C23.8701 59.0192 22.7653 60.124 21.4003 60.124Z" fill="currentColor"></path>
                            <path d="M21.4003 94.6474H8.05884C6.6939 94.6474 5.58911 93.541 5.58911 92.1777C5.58911 90.8144 6.6939 89.708 8.05884 89.708H21.4019C22.7669 89.708 23.8717 90.8144 23.8717 92.1777C23.8717 93.541 22.7652 94.6474 21.4003 94.6474Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <div id="code-confirm-group" class="modal-form-group">
                        <label class="modal-form__label" for="code-confirm">
                            Ingresa el código de confirmación que enviamos a tu correo electrónico:*
                        </label>
                        <input id="code-confirm" class="modal-form__input" type="text" placeholder="0000" autocomplete="off" name="code">
                    </div>

                </div>

            </div>

            <div id="message-errors" class="message-errors"></div>

            <button id="btn-sign-up" type="button" class="modal-form__btn btn-1 btn-send">
                Registrarse

            </button>

        </form>

    </div>
</div>


@endif


{{-- ? modal messages --}}
<div id="messages" class="modal">
    <div class="modal-body bg-grd-1">
        <span class="message-text"></span>
    </div>
</div>