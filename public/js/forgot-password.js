let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);



const email_reg = /\S+@\S+\.\S+/;

function checkEmail(data) {
    return email_reg.test(data);
}

function checkPassword(str, len = 8) {

    if (str.length >= len && str[0] === str[0].toUpperCase()) {
        return true;
    }

    return false;
}

class ResetPassword {
    constructor(form) {

        this.form = form;
        this.inputs = this.form.querySelectorAll('input');

        this.preloader = document.querySelector('.forgot-preloader');
        this.forgotSuccess = document.querySelector('.forgot-success');
        this.messageError = this.form.querySelector('.message-errors');
        this.currentFormGroup = null;

        this.btnShowPass = this.form.querySelector('.pass-btn');

        this.btnSend = this.form.querySelector('.btn-send');

        this.inputPassword = this.form.querySelector('#password-forgot');

        this.token = document.querySelector('[name="csrf-token"]');
        this.tokenForgot = document.querySelector('#token-forgot');

        this.value = null;

        this.flagSend = false;
        this.objSendData = {};
        this.url = this.form.getAttribute('action');
        this.objData = null;

        this.init();
    }
    init() {

        this.defaultForm();
        this.events();
    }
    defaultForm() {

        this.preloader.style.display = 'none';
        this.forgotSuccess.style.display = 'none';

        this.messageError.style.display = 'none';
        this.messageError.innerHTML = '';

        this.currentFormGroup = this.inputPassword.parentNode;
        this.currentFormGroup.classList.remove('error');


    }

    events() {
        this.form.addEventListener('submit', e => {
            e.preventDefault();
        });

        this.value = this.inputPassword.value.trim();
        this.currentFormGroup = this.inputPassword.parentNode;

        if (checkPassword(this.value)) {
            this.currentFormGroup.classList.remove('error');
            this.currentFormGroup.classList.add('valid');
        } else {
            this.currentFormGroup.classList.remove('valid');
        }

        this.btnShowPass.addEventListener('click', () => {

            this.btnShowPass.classList.toggle('show');
            const input = this.btnShowPass.parentNode.querySelector('input');
            if (this.btnShowPass.closest('.show')) {
                input.setAttribute('type', 'text');
            } else {
                input.setAttribute('type', 'password');

            }

        });


        this.btnSend.addEventListener('click', () => {
            this.validation();

            if (this.flagSend) {
                this.defaultForm();
                this.preloader.style.display = 'flex';
                this.getFormData();
                this.send();
            }
        })
    }
    validation() {

        this.flagSend = true;

        this.value = this.inputPassword.value.trim();
        this.currentFormGroup = this.inputPassword.parentNode;

        if (checkPassword(this.value)) {
            this.currentFormGroup.classList.remove('error');
            this.currentFormGroup.classList.add('valid');
        } else {
            this.flagSend = false;
            this.currentFormGroup.classList.remove('valid');
            this.currentFormGroup.classList.add('error');
        }
    }

    getFormData() {

        this.objSendData = {};

        this.objSendData[this.inputPassword.name] = this.inputPassword.value;
        this.objSendData[this.tokenForgot.name] = this.tokenForgot.value;

        if (this.token) {
            this.objSendData['_token'] = this.token.getAttribute('content');
        }

    }

    resSuccess() {
        if (this.objData['forgot']) {
            this.preloader.style.display = 'none';
            this.form.style.display = 'none';
            this.forgotSuccess.style.display = 'flex';
        }
    }


    resError() {

        if (this.objData['status'] == 429 || this.objData['status'] == 419 || this.objData['status'] == 422) {

            this.preloader.style.display = 'none';

            this.messageError.innerHTML = '';
            this.messageError.innerHTML = this.objData.message;
            this.messageError.style.display = 'flex';

            return;
        }

        this.errors = this.objData['errors'];

        if (this.errors) {
            this.html = '';
            for (const key in this.errors) {
                this.html += `<span>${this.errors[key]}</span>`;
            }

            this.messageError.innerHTML = this.html;
            this.preloader.style.display = 'none';
            this.messageError.style.display = 'flex';

            this.currentFormGroup = this.inputPassword.parentNode;
            this.currentFormGroup.classList.remove('valid');
            this.currentFormGroup.classList.add('error');

        }

        this.messageError.style.display = 'flex';
    }


    send() {
        if (this.flagSend) {

            this.flagSend = false;

            this.objData = null;

            const options = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(this.objSendData)

            };

            fetch(this.url, options)
                .then(async response => {
                    if (!response.ok) {
                        if (response.status === 422) {
                            const errorData = await response.json();
                            throw { status: 422, errors: errorData };
                        } else {
                            if (response.status === 419) {
                                const errorData = await response.json();
                                throw { status: 419, errors: errorData };
                            }
                            if (response.status === 429) {
                                const errorData = await response.json();
                                throw { status: 429, errors: errorData };
                            }
                            throw new Error(`HTTP error, status = ${response.status}`);
                        }
                    }

                    return response.json();
                })
                .then(result => {

                    this.objData = result;

                    if (result.status == 'ok') {
                        this.resSuccess();
                    } else {
                        this.resError();

                    }

                    this.flagSend = true;

                })
                .catch(error => {


                    if (error.status === 419 || error.status === 429 || error.status === 422) {
                        this.objData = {
                            'status': error.status,
                            'message': error.errors.message,
                        }

                        this.resError();
                    }

                    console.error('Fetch error:', error);

                    this.flagSend = true;
                });
        }
    }
}

const forgotForm = document.querySelector('#reset-password-form');
if (forgotForm) {
    new ResetPassword(forgotForm);
}