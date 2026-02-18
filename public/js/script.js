let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);




const pageHome = document.querySelector('.page-home');
const pageServices = document.querySelector('.page-services');
const pageAbout = document.querySelector('.page-about');
const pageBlog = document.querySelector('.page-blog');
const pageContacts = document.querySelector('.page-contacts');

window.addEventListener('DOMContentLoaded', () => {

})

let timerId = null;

window.addEventListener('load', () => {


    if (pageHome) {
        initSliderServices();
        initSliderReviews();
        initAccordionFaq();
        initSliderPosts();
    }
    if (pageServices) {
        initAccordionFaq();
        initSliderPosts();

        initCreditServices();
    }

    if (pageAbout) {
        initSliderReviews();
    }
    if (pageBlog) {
        initTopServices();
    }

    if (pageContacts) {
        initAccordionFaq();
        initSliderPosts();

        timerId = setTimeout(() => {
            clearTimeout(timerId);
            initMap();
        }, 1000)
    }



    initImageObserver();
})







// ? burger-menu
const wrapper = document.querySelector('.wrapper');
const body = document.querySelector('body');
const header = document.querySelector('.header');
const navMenu = document.querySelector('#nav-menu');
const burgerMenu = document.querySelector('#burger-menu');

const tokenCsrf = document.querySelector('[name="csrf-token"]').getAttribute('content');

if (burgerMenu) {
    burgerMenu.addEventListener('click', () => {
        let width1 = wrapper.offsetWidth;


        navMenu.classList.toggle('open');
        body.classList.toggle('fixed');

        burgerMenu.classList.toggle('active');


        let width2 = wrapper.offsetWidth;
        let margin = width2 - width1;
        if (navMenu.classList.contains('open')) {
            correctionWrapper(margin);
        } else {
            correctionWrapper();
        }
    })
}


function correctionWrapper(margin = 0) {
    wrapper.style.marginRight = margin + 'px';
}

function scrollToElement(el, height = 0) {
    let offsetPositon = el.getBoundingClientRect().top - height;
    window.scrollBy({
        top: offsetPositon,
        behavior: 'smooth',
    });
}


// ? user-auth
const divUserAuth = document.querySelector('#user-auth');

const btnUserAuth = document.querySelector('.user-auth__btn');
const btnUserMuneClose = document.querySelector('.user-menu__btn-close');
const divUserMenu = document.querySelector('.user-menu');

if (divUserAuth) {

    btnUserAuth.addEventListener('click', () => {

        let width1 = wrapper.offsetWidth;

        divUserMenu.classList.add('open');
        body.classList.add('fixed');

        let width2 = wrapper.offsetWidth;
        let margin = width2 - width1;
        correctionWrapper(margin);


    })

    btnUserMuneClose.addEventListener('click', () => {
        divUserMenu.classList.remove('open');
        body.classList.remove('fixed');
        correctionWrapper();
    })
}

window.addEventListener('click', (e) => {
    if (navMenu && burgerMenu && body) {

        if (navMenu.classList.contains('open') && !e.target.closest('.nav-menu') && !e.target.closest('.burger-menu')) {
            burgerMenu.classList.remove('active');
            navMenu.classList.remove('open');
            body.classList.remove('fixed');

            correctionWrapper();
        }
    }

    if (divUserMenu && body) {

        if (divUserMenu && divUserMenu.classList.contains('open') && !e.target.closest('.user-menu') && !e.target.closest('.user-auth__btn')) {
            divUserMenu.classList.remove('open');
            body.classList.remove('fixed');
            correctionWrapper();

        }
    }

});


function initSliderServices() {

    const divServicesSlider = document.querySelector('#services-slider');
    if (divServicesSlider) {
        new Swiper(divServicesSlider, {
            speed: 1800,
            slidesPerView: 3,
            autoplay: {
                delay: 2000,
            },

            pagination: {
                el: '.swiper-pagination-services',
                type: 'bullets',
                clickable: true,
            },
            breakpoints: {
                320: {

                    spaceBetween: 20
                },
                480: {

                    spaceBetween: 20
                },
                640: {
                    spaceBetween: 30
                }
            }
        });
    }
}


function initSliderReviews() {

    const divReviewsSlider = document.querySelector('#reviews-slider');
    if (divReviewsSlider) {
        new Swiper(divReviewsSlider, {
            speed: 1000,
            slidesPerView: 1,

            pagination: {
                el: '.swiper-pagination-reviews',
                type: 'bullets',
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                800: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                1100: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            }
        })
    }
}

function initSliderPosts() {

    const divPostssSlider = document.querySelector('#slider-posts');
    if (divPostssSlider) {
        new Swiper(divPostssSlider, {
            speed: 800,
            slidesPerView: 1,
            // Navigation arrows
            navigation: {
                nextEl: '.slider-posts-btn-next',
                prevEl: '.slider-posts-btn-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                800: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                1100: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            }
        })
    }
}


class Accordion {
    constructor(divAccordion, userOptions = {}) {
        this.divAccordion = divAccordion;
        this.openClass = 'open';
        this.currentIndex = 0;
        this.options = {
            accordion: '.accordion-item',
            button: '.accordion-btn',
            content: '.accordion-content',
            speed: 200,
            firstOpen: false,
            animation: true,
        }
        Object.assign(this.options, userOptions);
        this.accordionItems = this.divAccordion.querySelectorAll(this.options.accordion);
        this.accordionButtons = this.divAccordion.querySelectorAll(this.options.button);
        this.accordionContents = this.divAccordion.querySelectorAll(this.options.content);
        this.init();
    }

    init() {
        if (this.accordionItems.length == 0 || this.accordionButtons.length == 0 || this.accordionContents.length == 0) {
            return console.error('Error: Accordion initialization error');
        }

        this.divAccordion.style.setProperty('--duration', `${this.options.speed / 1000}s`);

        if (this.options.firstOpen) {
            this.open();
        }

        this.events();
    }

    events() {
        this.accordionButtons.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                this.currentIndex = index;
                this.actions();
            })
        });
    }

    actions() {
        this.accordionItems[this.currentIndex].classList.contains(this.openClass) ? this.close() : this.open();
    }

    open() {
        this.accordionItems[this.currentIndex].classList.add(this.openClass);
        if (this.options.animation) {
            this.accordionContents[this.currentIndex].style.maxHeight = this.accordionContents[this.currentIndex].scrollHeight + 'px';
        }
    }

    close() {
        this.accordionItems[this.currentIndex].classList.remove(this.openClass);
        if (this.options.animation) {

            this.accordionContents[this.currentIndex].style.maxHeight = null;
        }
    }
}


function initAccordionFaq() {
    const dicFaqAccordion = document.querySelector('#faq-accordion');
    if (dicFaqAccordion) {

        const options = {
            accordion: '.faq__item',
            button: '.faq-item__btn',
            content: '.faq-item-content',
            speed: 100
        }

        new Accordion(dicFaqAccordion, options);
    }
}


class Tabs {
    constructor(tabs, options) {
        this.tabs = tabs;

        this.options = {
            buttons: '.services-tabs__btn',
            panel: '.services-tabs__panel',
            classActive: 'active',
        }
        Object.assign(this.options, options);

        this.tabsBtns = this.tabs.querySelectorAll(this.options.buttons);
        this.tabsPanels = this.tabs.querySelectorAll(this.options.panel);
        this.currentIndex = 0;
        this.oldIndex = 0;
        this.init();
    }

    init() {

        if (this.tabsBtns.length != this.tabsPanels.length) {
            return;
        }

        this.tabsBtns.forEach((el, i) => {
            el.classList.remove(this.options.classActive);
        })

        this.tabsPanels.forEach((el, i) => {
            el.classList.remove(this.options.classActive);
        })

        this.tabsBtns[0].classList.add(this.options.classActive);
        this.tabsPanels[0].classList.add(this.options.classActive);

        this.events();
    }

    events() {
        this.tabsBtns.forEach((btn, i) => {
            btn.addEventListener('click', () => {
                if (this.currentIndex != i) {
                    this.switchTabs(i, this.currentIndex);
                }
            })
        })
    }
    switchTabs(index, oldIndex) {

        this.tabsBtns[oldIndex].classList.remove(this.options.classActive);
        this.tabsBtns[index].classList.add(this.options.classActive);

        this.tabsPanels[oldIndex].classList.remove(this.options.classActive);
        this.tabsPanels[index].classList.add(this.options.classActive);

        this.currentIndex = index;
        this.oldIndex = oldIndex

    }
}


// ? images lazy load
const imageObserver = new IntersectionObserver(
    (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.src = entry.target.dataset.src;
                observer.unobserve(entry.target);
            }
        });
    }, {
    rootMargin: "500px 0px 0px"
}
);



function initImageObserver() {

    const lazyLoadImages = document.querySelectorAll('img.lazy');

    if (lazyLoadImages.length > 0) {
        lazyLoadImages.forEach(image => {
            if (image.getAttribute('data-src')) {
                imageObserver.observe(image)
            }
        }
        );
    }
}

function initMap() {
    const map = document.querySelector('#contacts-map');
    if (map) {
        const src = map.getAttribute('data-src');
        map.src = src;

    }
}




function initTopServices() {
    const divTopServices = document.querySelector('#top-services');
    if (divTopServices) {
        const starsItems = divTopServices.querySelectorAll('.top-services-stars');
        starsItems.forEach(item => {
            const point = Number(item.getAttribute('data-points'));
            if (point) {
                const html = createStarsHtml(point);
                item.innerHTML = html;
            } else {
                // console.log('Error: is not number data-points', item);
            }
        });

        const chartItems = divTopServices.querySelectorAll('.top-services-chart');
        chartItems.forEach(item => {
            const percent = Number.parseFloat(item.getAttribute('data-percent'));

            if (percent) {
                const html = createChartSvg(percent);
                item.innerHTML = html;

            } else {
                // console.log('Error: is not number data-percent', item);

            }
        })
    }
}



const divModalSignIn = document.querySelector('#sign-in');
const divModalSignUp = document.querySelector('#sign-up');
const divModalHistory = document.querySelector('#history');


let wrapperWidth1 = null;
let wrapperWidth2 = null;
let wrapperMargin = null;

function openModal(modal) {

    wrapperWidth1 = wrapper.offsetWidth;

    body.classList.add('fixed');
    modal.classList.add('open');

    wrapperWidth2 = wrapper.offsetWidth;
    wrapperMargin = wrapperWidth2 - wrapperWidth1;

    if (navMenu && navMenu.classList.contains('open')) {
        navMenu.classList.remove('open');
        burgerMenu.classList.remove('active');
    } else {
        correctionWrapper(wrapperMargin);
    }


    burgerMenu.style.zIndex = 0;
}

function closeModal(modal) {

    body.classList.remove('fixed');
    modal.classList.remove('open');
    correctionWrapper();

    burgerMenu.style.zIndex = 120;

}


function checkPhone(inputValue, len) {
    // let value = inputValue.replace(/[^\d+]/g, '');
    let value = inputValue.replace(/[^\d]/g, '');
    // ? max len 10
    if (value.length > len) {
        value = value.slice(0, len);
    }

    return value;
}


const curentYear = new Date().getFullYear();
function checkDate(data) {
    const arrData = data.split('-');

    let res = true;
    if (arrData[0] < 1900 || arrData[0] > curentYear - 18) {
        res = false;
    }

    return res;
}


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



class SignUp {
    constructor(modal, buttons, modalSignIn) {
        this.modal = modal;
        this.buttons = buttons;

        this.modalSignIn = modalSignIn;

        this.btnSignUp = this.modal.querySelector('.btn-send');
        this.btnConfirmEmail = this.modal.querySelector('.btn-confirm-email');

        this.inputs = this.modal.querySelectorAll('input');

        this.currentFormGroup = null;

        this.value = null;

        this.flagSend = true;

        this.flagConfirm = false;

        this.currentRequest = null;

        this.flagValid = false;

        this.objSendData = null;

        this.codePreloader = this.modal.querySelector('#code-preloader');
        this.codeConfirmGroup = this.modal.querySelector('#code-confirm-group');
        this.messageErrors = this.modal.querySelector('#message-errors');
        this.messageSuccess = this.modal.querySelector('#message-success');

        this.html = '';
        this.errors = null;

        this.modalPreloader = this.modal.querySelector('.modal-preloader');

        this.modalForm = this.modal.querySelector('.modal-form');


        this.objData = null;

        this.url = this.modalForm.getAttribute('action');

        this.timerId = null;
        this.time = 1000;

        this.modalMessage = document.querySelector('#messages');
        this.modalMessageText = this.modalMessage.querySelector('.message-text');

        this.validCode = 4;
        this.validPhone = 10;
        this.validPass = 8;

        this.divPhoneCode = this.modal.querySelector('#phone-code-sign-up');

        this.btnShowPass = this.modal.querySelector('#pass-btn');
        this.inputPass = this.modal.querySelector('#password-sign-up');

        this.init();

    }

    init() {
        if (!this.modal || !this.btnSignUp || !this.inputs.length < 0 || !this.btnConfirmEmail) return;


        this.defaultForm();

        this.events();
    }

    defaultForm() {
        this.btnSignUp.style.display = 'none';
        this.codePreloader.style.display = 'none';
        this.codeConfirmGroup.style.display = 'none';

        this.modalPreloader.style.display = 'none';
        this.modalPreloader.classList.remove('success');
        this.modalPreloader.style.opacity = 0.8;

        this.messageErrors.style.display = 'none';
        this.messageErrors.innerHTML = '';

        this.messageSuccess.innerHTML = '';


        this.btnConfirmEmail.setAttribute('disabled', '');

        this.inputs.forEach(input => {
            this.currentFormGroup = input.parentNode;
            this.currentFormGroup.classList.remove('valid');
            this.currentFormGroup.classList.remove('error');
        })
    }

    events() {
        this.modalForm.addEventListener('submit', e => {
            e.preventDefault();
        });
        // ? modal open / close
        this.buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                openModal(this.modal);
            })
        })
        this.modal.addEventListener('click', e => {
            if (e.target.closest('.modal__btn-close') || this.modal.classList.contains('open') && !e.target.closest('.modal-body')) {
                closeModal(this.modal);

            }
        })

        // ? modal open / close END

        this.inputs.forEach(input => {
            input.addEventListener('input', () => {

                if (input.name === 'email') {
                    this.validationEmail(input);
                } else {
                    this.validation();

                }

            })
        })

        this.btnConfirmEmail.addEventListener('click', () => {
            if (this.flagConfirm && this.flagSend) {

                this.messageErrors.style.display = 'none';
                this.messageErrors.innerHTML = '';

                this.codePreloader.style.display = 'block';

                this.btnConfirmEmail.setAttribute('disabled', '');

                this.currentRequest = 'email-confirm';
                this.formObjSendData();
                this.send();

                this.btnSignUp.removeAttribute('disabled', '');
            }
        })
        this.btnSignUp.addEventListener('click', () => {

            this.validationSend();

            if (this.flagValid && this.flagSend) {

                this.messageErrors.style.display = 'none';
                this.messageErrors.innerHTML = '';

                this.modalPreloader.style.display = 'flex';

                this.btnSignUp.setAttribute('disabled', '');

                this.currentRequest = 'sign-up';
                this.formObjSendData();
                this.send();
            }
        })

        this.modalMessage.addEventListener('click', e => {
            if (e.target.closest('.modal__btn-close') || this.modalMessage.classList.contains('open') && !e.target.closest('.modal-body')) {
                closeModal(this.modalMessage);
            }
        })

        this.btnShowPass.addEventListener('click', () => {
            this.btnShowPass.classList.toggle('show');
            if (this.btnShowPass.closest('.show')) {
                this.inputPass.setAttribute('type', 'text');
            } else {
                this.inputPass.setAttribute('type', 'password');

            }
        })
    }

    validationEmail(input) {

        this.flagConfirm = true;
        this.value = input.value;
        this.currentFormGroup = input.parentNode;
        if (checkEmail(this.value)) {
            this.flagConfirm = true;
            this.currentFormGroup.classList.add('valid');
            this.btnConfirmEmail.removeAttribute('disabled');
            this.currentFormGroup.classList.remove('error');
        } else {
            this.flagConfirm = false;
            this.currentFormGroup.classList.remove('valid');
            this.btnConfirmEmail.setAttribute('disabled', '');
        }
    }

    validation() {

        this.flagValid = true;

        this.inputs.forEach(input => {

            this.value = input.value.trim();
            this.currentFormGroup = input.parentNode;

            if (input.name === 'birthday') {
                if (checkDate(this.value)) {
                    this.currentFormGroup.classList.add('valid');
                    this.currentFormGroup.classList.remove('error');
                } else {
                    this.flagValid = false;
                    this.currentFormGroup.classList.remove('valid');

                }
            } else if (input.name === 'phone') {
                this.value = checkPhone(this.value, this.validPhone);
                input.value = this.value;
                if (this.value.length == this.validPhone) {
                    this.currentFormGroup.classList.add('valid');
                    this.currentFormGroup.classList.remove('error');
                } else {
                    this.flagValid = false;
                    this.currentFormGroup.classList.remove('valid');
                }
            } else if (input.name === 'email') {
                if (!checkEmail(this.value)) {
                    this.flagValid = false;
                }
            } else if (input.name === 'password') {

                if (checkPassword(this.value, this.validPass)) {
                    this.currentFormGroup.classList.add('valid');
                    this.currentFormGroup.classList.remove('error');
                } else {

                    this.flagValid = false;
                    this.currentFormGroup.classList.remove('valid');
                }
            } else if (input.name === 'code') {
                if (this.value.length === this.validCode) {
                    this.currentFormGroup.classList.add('valid');
                    this.currentFormGroup.classList.remove('error');
                } else {
                    this.flagValid = false;
                    this.currentFormGroup.classList.remove('valid');
                }

            } else {
                if (this.value.length >= 3) {
                    this.currentFormGroup.classList.add('valid');
                } else {
                    this.flagValid = false;
                    this.currentFormGroup.classList.remove('valid');
                }
            }

        })

        // if (this.flagValid) {
        //     this.btnSignUp.removeAttribute('disabled');
        // } else {
        //     this.btnSignUp.setAttribute('disabled', '');
        // }

    }

    validationSend() {

        this.flagValid = true;

        this.inputs.forEach(input => {

            this.value = input.value.trim();
            this.currentFormGroup = input.parentNode;

            if (input.name === 'birthday') {
                if (!checkDate(this.value)) {
                    this.flagValid = false;
                    this.currentFormGroup.classList.add('error');
                }
            } else if (input.name === 'phone') {
                this.value = checkPhone(this.value, this.validPhone);
                input.value = this.value;
                if (this.value.length != this.validPhone) {
                    this.flagValid = false;
                    this.currentFormGroup.classList.add('error');
                }
            } else if (input.name === 'email') {
                if (!checkEmail(this.value)) {
                    this.currentFormGroup.classList.add('error');
                }
            } else if (input.name === 'password') {
                if (!checkPassword(this.value, this.validPass)) {
                    this.flagValid = false;
                    this.currentFormGroup.classList.add('error');
                }
            } else if (input.name === 'code') {
                if (this.value.length != this.validCode) {
                    this.flagValid = false;
                    this.currentFormGroup.classList.add('error');
                }
            } else {
                if (this.value.length < 3) {
                    this.flagValid = false;
                    this.currentFormGroup.classList.add('error');
                }
            }

        })

    }

    formObjSendData() {
        this.objSendData = {};

        this.tempData = {};

        this.inputs.forEach(input => {
            let value = input.value.trim();

            if (input.getAttribute('name') == 'phone') {
                value = this.divPhoneCode.getAttribute('data-phone-code') + value;
            }

            this.tempData[input.getAttribute('name')] = value;
        })




        if (this.currentRequest === 'email-confirm') {
            this.objSendData['email'] = this.tempData['email'];
            this.objSendData['action'] = 'email-confirm';
        }

        if (this.currentRequest === 'sign-up') {
            Object.assign(this.objSendData, this.tempData);
            this.objSendData['action'] = 'sign-up';
        }

        if (tokenCsrf) {
            this.objSendData['_token'] = tokenCsrf;
        }
    }

    resSuccess() {


        if (this.currentRequest === 'email-confirm') {
            this.btnSignUp.style.display = 'flex';
            this.codePreloader.style.display = 'none';
            this.codeConfirmGroup.style.display = 'flex';
        }

        if (this.currentRequest === 'sign-up') {

            this.modalPreloader.classList.add('success');
            this.modalPreloader.style.opacity = 1;
            this.messageSuccess.innerHTML = this.objData['message'];

            if (this.objData['auth']) {

                this.timerId = setTimeout(() => {

                    clearTimeout(this.timerId);

                    window.location.reload();

                    // closeModal(this.modal);
                    // openModal(this.modalSignIn);

                    // this.defaultForm();
                    // this.modalForm.reset();
                }, this.time)
            }



        }

    }
    resError() {



        if (this.objData['status'] == 429) {


            this.messageErrors.innerHTML = this.objData.message;
            this.codePreloader.style.display = 'none';
            this.messageErrors.style.display = 'flex';

            this.modalPreloader.style.display = 'none';

            return;
        }


        if (this.objData['status'] == 419) {
            this.modalMessageText.innerHTML = this.objData.message;
            closeModal(this.modal);
            openModal(this.modalMessage);

            return;
        }

        if (this.objData['status'] == 422) {


            this.errors = this.objData['errors'];


            this.html = '';
            for (const key in this.errors) {

                this.errors[key].forEach(error => {
                    this.html += `<span>${error}</span>`;
                })
            }




            this.messageErrors.innerHTML = this.html;

            this.codePreloader.style.display = 'none';
            this.messageErrors.style.display = 'flex';

            this.modalPreloader.style.display = 'none';

            this.codeConfirmGroup.style.display = 'none';
            this.btnSignUp.style.display = 'none';


            this.inputs.forEach(input => {
                const name = input.name;
                if (this.errors[name]) {
                    this.currentFormGroup = input.parentNode;
                    this.currentFormGroup.classList.remove('valid');
                    this.currentFormGroup.classList.add('error');
                }
            })

            return;
        }


        this.errors = this.objData['errors'];

        if (this.errors) {
            this.html = '';
            for (const key in this.errors) {
                this.html += `<span>${this.errors[key]}</span>`;
            }

            this.messageErrors.innerHTML = this.html;
            this.modalPreloader.style.display = 'none';
            this.codePreloader.style.display = 'none';
            this.messageErrors.style.display = 'flex';

            this.inputs.forEach(input => {
                const name = input.name;
                if (this.errors[name]) {
                    this.currentFormGroup = input.parentNode;
                    this.currentFormGroup.classList.remove('valid');
                    this.currentFormGroup.classList.add('error');
                }
            })
        }

        if (this.currentRequest === 'email-confirm' && this.errors['send-email']) {

            this.btnConfirmEmail.removeAttribute('disabled');

        }

        if (this.currentRequest === 'sign-up') {

            const input = this.modal.querySelector('[name="code"]');
            input.value = '';
            this.currentFormGroup = input.parentNode;
            this.currentFormGroup.classList.remove('error');

            this.btnConfirmEmail.removeAttribute('disabled');

            this.codeConfirmGroup.style.display = 'none';
        }
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

                        this.objData = error.errors;
                        this.objData['status'] = error.status;

                        this.resError();
                    }


                    console.error('Fetch error:', error);

                    this.flagSend = true;
                });

        }
    }
}

const btnsModalSignUp = document.querySelectorAll('[data-target="sign-up"]');

if (divModalSignUp && btnsModalSignUp.length > 0, divModalSignIn) {
    new SignUp(divModalSignUp, btnsModalSignUp, divModalSignIn);
}



// ? SignIn

class SignIn {
    constructor(modal, buttons) {
        this.modal = modal;
        this.buttons = buttons;

        this.inputEmail = this.modal.querySelector('#email-sign-in');
        this.inputPass = this.modal.querySelector('#password-sign-in');
        this.btnShowPass = this.modal.querySelector('#pass-btn-sign-in');
        this.btnSignIn = this.modal.querySelector('#btn-sign-in');


        this.messageErrors = this.modal.querySelector('.message-errors');

        this.currentFormGroup = null;

        this.value = null;
        this.flagSend = false;

        this.objSendData = null;

        this.modalForm = this.modal.querySelector('.modal-form');



        this.objData = null;

        this.url = this.modalForm.getAttribute('action');

        this.modalMessage = document.querySelector('#messages');
        this.modalMessageText = this.modalMessage.querySelector('.message-text');

        this.inputs = this.modal.querySelectorAll('input');

        this.action = null;

        this.modalPreloader = this.modal.querySelector('.modal-preloader');

        this.init();
    }
    init() {
        if (!this.modal || !this.inputEmail || !this.inputPass) return;



        this.defaultForm();

        this.events();
    }

    defaultForm() {

        this.messageErrors.style.display = 'none';
        this.messageErrors.innerHTML = '';

        this.inputs.forEach(input => {

            this.currentFormGroup = input.parentNode;

            this.currentFormGroup.classList.remove('error');
        })

    }

    events() {

        this.modalForm.addEventListener('submit', e => {
            e.preventDefault();
        });

        this.buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                openModal(this.modal);
            })
        })
        this.modal.addEventListener('click', e => {
            if (e.target.closest('.modal__btn-close') || this.modal.classList.contains('open') && !e.target.closest('.modal-body')) {
                closeModal(this.modal);
            }
        })



        this.btnShowPass.addEventListener('click', () => {
            this.btnShowPass.classList.toggle('show');
            if (this.btnShowPass.closest('.show')) {
                this.inputPass.setAttribute('type', 'text');
            } else {
                this.inputPass.setAttribute('type', 'password');

            }
        })


        this.modalMessage.addEventListener('click', e => {
            if (e.target.closest('.modal__btn-close') || this.modalMessage.classList.contains('open') && !e.target.closest('.modal-body')) {
                closeModal(this.modalMessage);
            }
        })

        this.btnSignIn.addEventListener('click', () => {

            this.validationSend();

            if (this.flagSend) {
                this.modalPreloader.style.display = 'flex';

                this.action = 'sign-in';
                this.formObjSendData();
                this.send();

            }

        })

        this.inputs.forEach(input => {

            input.addEventListener('input', () => {
                this.value = input.value.trim();
                this.currentFormGroup = input.parentNode;

                if (input.name === 'email') {
                    if (checkEmail(this.value)) {

                        this.currentFormGroup.classList.remove('error');
                    }
                } else if (input.name === 'password') {
                    if (this.value.length > 0) {

                        this.currentFormGroup.classList.remove('error');
                    }
                }

            })
        })

    }


    validationSend() {

        this.flagSend = true;

        this.inputs.forEach(input => {

            this.value = input.value.trim();
            this.currentFormGroup = input.parentNode;

            if (input.name === 'email') {
                if (!checkEmail(this.value)) {
                    this.flagSend = false;
                    this.currentFormGroup.classList.add('error');
                }
            } else if (input.name === 'password') {
                if (this.value.length == 0) {
                    this.flagSend = false;
                    this.currentFormGroup.classList.add('error');
                }
            }
        })
    }

    formObjSendData() {

        this.objSendData = {};

        this.objSendData['action'] = this.action;

        this.objSendData['email'] = this.inputEmail.value;
        this.objSendData['password'] = this.inputPass.value;

        if (tokenCsrf) {
            this.objSendData['_token'] = tokenCsrf;
        }

    }


    resSuccess() {
        if (this.objData['auth']) {

            location.reload();
        }


    }
    resError() {

        this.modalPreloader.style.display = 'none';

        if (this.objData['status'] == 429) {

            this.messageErrors.innerHTML = this.objData.message;

            this.messageErrors.style.display = 'flex';
            this.messageInfo.style.display = 'none';



            return;
        }

        if (this.objData['status'] == 419) {
            this.modalMessageText.innerHTML = this.objData.message;
            closeModal(this.modal);
            openModal(this.modalMessage);

            return;
        }

        if (this.objData['status'] == 422) {

            this.errors = this.objData['errors'];

            this.html = '';
            for (const key in this.errors) {

                this.errors[key].forEach(error => {
                    this.html += `<span>${error}</span>`;
                })
            }

            this.messageErrors.innerHTML = this.html;

            this.messageErrors.style.display = 'flex';

            this.modalPreloader.style.display = 'none';

            this.inputs.forEach(input => {
                const name = input.name;
                if (this.errors[name]) {
                    this.currentFormGroup = input.parentNode;
                    this.currentFormGroup.classList.remove('valid');
                    this.currentFormGroup.classList.add('error');
                }
            })

            return;
        }

        this.errors = this.objData['errors'];


        this.inputs.forEach(input => {
            this.currentFormGroup = input.parentNode;
            this.currentFormGroup.classList.add('error');
        })

        this.messageErrors.innerHTML = this.objData['errors']['message'];
        this.messageErrors.style.display = 'flex';

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

                        this.objData = error.errors;
                        this.objData['status'] = error.status;

                        this.resError();
                    }

                    console.error('Fetch error:', error);

                    this.flagSend = true;
                });

        }
    }

}



const btnsModalSignIn = document.querySelectorAll('[data-target="sign-in"]');

if (divModalSignIn && btnsModalSignIn.length > 0) {
    new SignIn(divModalSignIn, btnsModalSignIn);
}


function createStarsHtml(point) {

    let html = '';
    let star = point / 2;

    for (let i = 0; i < 5; i++) {
        if (star >= 1) {
            html += '<span class="credit-service__star star-fill"></span>';
        } else if (star == 0.5) {
            html += '<span class="credit-service__star star-fill-half"></span>';
        } else {
            html += '<span class="credit-service__star star"></span>';
        }
        star--;
    }

    return html;
}


function addSvgGrdHtml() {
    const svgGrd = `
        <svg width="0" height="0" class="svg-grd" viewBox="0 0 88 88">
             <defs>
                <linearGradient id="chart-grd-01" x1="-11" y1="-17" x2="35.5" y2="97" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#5856D1"></stop>
                    <stop offset="1" stop-color="#9906EA"></stop>
                </linearGradient>
             </defs>
        </svg>
    `;

    body.insertAdjacentHTML('beforeend', svgGrd);
}

function createChartSvg(dataPercent) {

    const percent = dataPercent * 10;
    const dasharray = Math.ceil(2 * 3.14 * 41);
    const dashoffset = dasharray - Math.ceil((dasharray - 6) * percent / 100);

    const html = `
        <svg width="88" height="88" class='svg-service-chart' viewBox="0 0 88 88">
            <circle cx='44' cy='44' r='41'></circle>
            <circle cx='44' cy='44' r='41' style="--dasharray:${dasharray}; --dashoffset: ${dashoffset};" stroke="url(#chart-grd-01)"></circle>
        </svg>  
        <span>${Number(dataPercent).toFixed(1)}</span>                
    `;

    return html;
}




class CreditServices {
    constructor(divServices) {
        this.divServices = divServices;
        this.modalSignIn = document.querySelector('#sign-in');
        this.modalHistory = document.querySelector('#history');

        this.divModalHistoryBody = null;
        this.divModalHistoryContent = null;

        this.options = {
            classShow: 'show',
            classHidden: 'hidden',
            breakpoints: 600,
        }


        this.divServicesTabs = this.divServices.querySelector('#services-tabs');

        this.creditServicesItems = this.divServices.querySelectorAll('.credit-services');

        this.servicesItems = null;
        this.btnsServiceHidden = null;


        this.objData = null;
        this.message = '';


        this.userAuth = false;


        this.currentPromocode = null;


        this.url = location.href;

        this.objSendData = null;

        this.flagSend = true;


        this.actions = {
            'get-services': 'get-services',
            'get-services-category': 'get-services-category',
            'hidden-service': 'hidden-service',
            'active-service': 'active-service',
            'get-credit': 'get-credit',
        };

        this.currentRequest = this.actions["get-services"];


        this.html = '';

        this.timerId = null;

        this.objServicesData = null;
        this.translations = null;

        this.divCurrentCategory = null;
        this.divCurrentPaginationInfo = null;
        this.divCurrentServicesItems = null;

        this.currentCategory = null;
        this.currentOffset = null;

        this.currentBtnPrev = null;
        this.currentBtnNext = null;

        this.accardionDetails = null;
        this.accardionDetailsBtn = null;
        this.accardionDetailsContent = null;

        this.currentBtnPromocodeCopy = null;
        this.currentBtnHistory = null;

        this.currentService = null;
        this.currentServiceId = null;

        this.modalMessage = document.querySelector('#messages');
        this.modalMessageText = this.modalMessage.querySelector('.message-text');

        this.init();

    }

    init() {
        if (!this.divServicesTabs) {
            return;
        }

        this.getServices();

        this.initTabsAccordion();
        this.events();

    }

    initTabsAccordion() {
        if (window.innerWidth > this.options.breakpoints) {
            new Tabs(this.divServicesTabs, {
                buttons: '.services-tabs__btn',
                panel: '.services-tabs__panel',
                classActive: 'active',
            });
        } else {
            new Accordion(this.divServicesTabs, {
                accordion: '.services-accordion',
                button: '.services-accordion__btn',
                content: '.services-tabs__panel',
                speed: 400,
                firstOpen: true,
                animation: false,
            });


        }
    }


    events() {

        if (this.modalHistory) {
            this.modalHistory.addEventListener('click', e => {

                if (e.target.closest('.modal__btn-close') || this.modalHistory.classList.contains('open') && !e.target.closest('.modal-body')) {
                    closeModal(this.modalHistory);
                }
            })

            this.divModalHistoryBody = this.modalHistory.querySelector('.modal-body-history');
            this.divModalHistoryContent = this.modalHistory.querySelector('.modal-history__items');
        }

        this.divServices.style.setProperty('--duration', `${200 / 1000}s`);

        this.divServices.addEventListener('click', (e) => {


            this.currentService = e.target.closest('.credit-service');
            if (this.currentService) {

                this.currentServiceId = this.currentService.getAttribute('data-service-id');
            }

            if (e.target.closest('.btn-details')) {

                this.accardionDetailsBtn = e.target.closest('.btn-details');
                this.accardionDetails = this.accardionDetailsBtn.closest('.credit-service-box__accordion');
                this.accardionDetailsContent = this.accardionDetails.querySelector('.credit-service-box__list-hidden');

                if (this.accardionDetails.classList.contains('open')) {
                    this.accardionDetails.classList.remove('open');
                    this.accardionDetailsContent.style.maxHeight = null;
                } else {
                    this.accardionDetails.classList.add('open');
                    this.accardionDetailsContent.style.maxHeight = this.accardionDetailsContent.scrollHeight + 'px';
                }
            }



            if (e.target.closest('.btn-promocode')) {

                openModal(divModalSignIn);
            }
            if (e.target.closest('.btn-promocode-copy')) {


                this.currentBtnPromocodeCopy = e.target.closest('.btn-promocode-copy');

                this.currentPromocode = this.currentBtnPromocodeCopy.parentNode.querySelector('.promocode-text').textContent;
                navigator.clipboard.writeText(this.currentPromocode);

                this.currentBtnPromocodeCopy.classList.add('anim');
                this.timerId = setTimeout(() => {
                    clearTimeout(this.timerId);
                    this.currentBtnPromocodeCopy.classList.remove('anim');
                }, 500);

            }
            if (e.target.closest('.btn-hidden')) {

                this.currentBtnHidden = e.target.closest('.btn-hidden')

                this.currentServiceItems = this.divServices.querySelectorAll(`[data-service-id="${this.currentServiceId}"]`);
                // console.log(this.currentServiceItems);

                // ? current services all hiiden/active
                if (this.currentService.closest('.hidden')) {

                    this.currentServiceItems.forEach(item => {
                        item.classList.remove('hidden');
                    })
                    this.currentRequest = this.actions['active-service'];

                } else {

                    this.currentServiceItems.forEach(item => {
                        item.classList.add('hidden');
                    })
                    this.currentRequest = this.actions['hidden-service'];
                }

                // ? if user: send data else: 
                if (this.userAuth) {
                    this.sendAction();
                } else {
                    this.saveServiceLocaleStorage(this.currentServiceId);
                }
            }

            if (e.target.closest('.btn-history')) {
                this.currentBtnHistory = e.target.closest('.btn-history');

                if (this.userAuth) {

                    this.setCurrentCategory(this.currentBtnHistory);
                    this.addHistoryContent();

                    openModal(this.modalHistory);

                } else {
                    openModal(this.modalSignIn);
                }
            }

            if (e.target.closest('.service-link')) {
                this.currentRequest = this.actions['get-credit'];

                if (this.userAuth) {
                    this.sendAction();
                }
            }

            // ? prevBtn
            if (e.target.closest('.pagination__btn-prev')) {

                this.currentBtnPrev = e.target.closest('.pagination__btn-prev');
                this.setCurrentCategory(this.currentBtnPrev);
                this.prevServices();

            }
            // ? nextBtn
            if (e.target.closest('.pagination__btn-next')) {

                this.currentBtnNext = e.target.closest('.pagination__btn-next');
                this.setCurrentCategory(this.currentBtnNext);
                this.nextServices();
            }

        })


        this.modalMessage.addEventListener('click', e => {
            if (e.target.closest('.modal__btn-close') || this.modalMessage.classList.contains('open') && !e.target.closest('.modal-body')) {
                closeModal(this.modalMessage);
            }
        })
    }

    saveServiceLocaleStorage(id) {


        let currentId = Number(id);

        // ? save info localestorage
        this.servicesLS = localStorage.getItem('services');

        if (this.servicesLS) {
            this.servicesLS = JSON.parse(this.servicesLS);
        }

        if (this.servicesLS && Array.isArray(this.servicesLS) && this.servicesLS.length != 0) {


            if (this.currentRequest == this.actions['hidden-service']) {
                this.servicesLS.push(currentId);
            }

            if (this.currentRequest == this.actions['active-service']) {
                const index = this.servicesLS.indexOf(currentId);
                if (index != -1) {
                    this.servicesLS.splice(index, 1);
                }
            }
        } else {
            this.servicesLS = [currentId];

        }


        localStorage.setItem('services', JSON.stringify(this.servicesLS));
    }

    addHistoryContent() {


        this.divModalHistoryBody.classList.remove('show');

        this.html = '';

        this.html = `
            <div class="modal-history__item">               
                <span>${this.translations.action}</span>
                <span>${this.translations.date}</span>
            </div>
        `;

        this.divModalHistoryContent.innerHTML = this.html;

        const services = this.objServicesData[this.currentCategory]['data'];
        if (services && services.length > 0) {
            services.forEach(service => {
                if (service.id == this.currentServiceId) {

                    if (service.histories && service.histories.length > 0) {
                        service.histories.forEach(data => {

                            this.html += createHistoryHtml(data);
                        })

                    } else {
                        this.html += `
                            <div class="modal-history__item">                             
                                <span>${this.translations.no_history}</span>
                            </div>
                        `;
                    }
                }
            })
        }

        this.divModalHistoryContent.innerHTML = this.html;
        this.divModalHistoryBody.classList.add('show');

    }

    sendAction() {

        this.formDefaultObjSendData();

        this.objSendData['service_id'] = this.currentServiceId;

        this.send();

    }

    setCurrentCategory(btn) {
        this.divCurrentCategory = btn.closest('.credit-services');
        if (this.divCurrentCategory) {
            this.currentCategory = this.divCurrentCategory.getAttribute('data-category');
        }
    }

    prevServices() {

        if (this.objServicesData[this.currentCategory]['current_page'] > 1) {
            this.currentOffset = this.objServicesData[this.currentCategory]['offset'] - 1;
            this.getServicesCategory();
        }
    }

    nextServices() {

        if (this.objServicesData[this.currentCategory]['current_page'] < this.objServicesData[this.currentCategory]['last_page']) {
            this.currentOffset = this.objServicesData[this.currentCategory]['offset'] + 1;
            this.getServicesCategory();
        }
    }

    showServicesAll() {
        this.timerId = setTimeout(() => {
            this.divServices.classList.add(this.options.classShow);
        }, 500);
    }

    hiddenCategory() {
        this.divCurrentCategory.classList.add('hidden');
    }
    showCategory() {
        this.timerId = setTimeout(() => {
            this.divCurrentCategory.classList.remove('hidden');
        }, 500);
    }

    getServicesCategory() {

        this.hiddenCategory();
        scrollToElement(this.divCurrentCategory, 100);

        this.currentRequest = this.actions['get-services-category'];
        this.formDefaultObjSendData();


        this.objSendData['slug'] = this.currentCategory;
        this.objSendData['offset'] = this.currentOffset;


        this.send();
    }

    getServices() {

        this.currentRequest = this.actions['get-services'];
        this.formDefaultObjSendData();


        this.send();
    }


    formDefaultObjSendData() {

        this.objSendData = {};

        this.objSendData['action'] = this.currentRequest;

        if (tokenCsrf) {
            this.objSendData['_token'] = tokenCsrf;
        }

    }

    getServiceLocaleStorage() {
        let services = localStorage.getItem('services');

        if (services) {
            services = JSON.parse(services);
            if (Array.isArray(services) && services.length != 0) {

                return services;
            }
        }

        return false;

    }

    addHtml() {

        addSvgGrdHtml();


        if (this.creditServicesItems.length > 0) {


            this.creditServicesItems.forEach(service => {

                const category = service.getAttribute('data-category');


                const dataServices = this.objServicesData[category]['data'];
                if (dataServices && dataServices.length > 0) {

                    this.html = '';
                    this.html = '<div class="credit-services-preloader"></div>';
                    this.html += '<div class="credit-services__items">';

                    this.servicesLS = this.getServiceLocaleStorage();

                    dataServices.forEach(data => {
                        if (this.servicesLS && this.servicesLS.indexOf(data.id) != -1) {

                            this.html += createServiceHtml(data, this.translations, this.userAuth, true);
                        } else {

                            this.html += createServiceHtml(data, this.translations, this.userAuth);
                        }
                    })

                    this.html += '</div>';

                    if (this.objServicesData[category]['current_page'] < this.objServicesData[category]['last_page']) {
                        const valuePagination = `${this.objServicesData[category]['to']} / ${this.objServicesData[category]['total']}`;
                        this.html += createPaginationHtml(valuePagination);
                    }

                    service.innerHTML = this.html;

                } else {
                    // service.innerHTML = 'Сервісів немає'; 
                    service.innerHTML = this.translations.no_services;


                }

            })
        }
    }


    addNewServicesHtml() {

        this.divCurrentServicesItems = this.divCurrentCategory.querySelector('.credit-services__items');

        const dataServices = this.objServicesData[this.currentCategory]['data'];

        if (dataServices && dataServices.length > 0) {

            this.html = '';

            this.servicesLS = this.getServiceLocaleStorage();

            dataServices.forEach(data => {
                if (this.servicesLS && this.servicesLS.indexOf(data.id) != -1) {

                    this.html += createServiceHtml(data, this.translations, this.userAuth, true);
                } else {

                    this.html += createServiceHtml(data, this.translations, this.userAuth);
                }
            })

            this.divCurrentServicesItems.innerHTML = this.html;

        }
    }

    setPagination() {

        this.divCurrentPaginationInfo = this.divCurrentCategory.querySelector('.pagination-info');

        this.currentBtnPrev = this.divCurrentCategory.querySelector('.pagination__btn-prev');
        this.currentBtnNext = this.divCurrentCategory.querySelector('.pagination__btn-next');

        if (this.objServicesData[this.currentCategory]['current_page'] > 1) {

            this.currentBtnPrev.removeAttribute('disabled');
        } else {
            this.currentBtnPrev.setAttribute('disabled', true);
        }

        if (this.objServicesData[this.currentCategory]['current_page'] < this.objServicesData[this.currentCategory]['last_page']) {
            this.currentBtnNext.removeAttribute('disabled');
        } else {
            this.currentBtnNext.setAttribute('disabled', true);
        }

        this.divCurrentPaginationInfo.innerHTML = `${this.objServicesData[this.currentCategory]['to']} / ${this.objServicesData[this.currentCategory]['total']}`;

    }


    resSuccess() {

        this.translations = this.objData['translations'];

        if (this.currentRequest == 'get-services') {

            this.userAuth = this.objData.auth;

            this.objServicesData = this.objData['data'];

            this.addHtml();

            this.showServicesAll();

        }


        if (this.currentRequest == 'get-services-category') {

            delete this.objData['status'];

            this.objServicesData[this.currentCategory] = this.objData;

            this.addNewServicesHtml();

            this.setPagination();

            this.showCategory();

        }


    }

    resError() {


        if (this.objData['status'] == 419 || this.objData['status'] == 429) {
            this.modalMessageText.innerHTML = this.objData.message;
            openModal(this.modalMessage);

            return;
        }


        if (this.objData['errors']) {
            let html = '';

            for (const key in this.objData.errors) {
                html += this.objData.errors[key] + '<br>';

                console.error(this.objData.errors[key]);
            }

            this.modalMessageText.innerHTML = html;
            openModal(this.modalMessage);
        }
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


                    if (error.status === 419 || error.status === 429) {
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


function initCreditServices() {
    const divServices = document.querySelector('#services');
    if (divServices) {
        new CreditServices(divServices);
    }
}


function createHistoryHtml(data) {

    const html = `        
        <div class="modal-history__item">
            <span>${data.name}</span>
            <span>${data.updated_at}</span>
        </div>
    `;

    return html;
}


function createPaginationHtml(paginate) {

    const html = `
        <div class="credit-services-pagination">
            <button class="pagination__btn pagination__btn-prev" type="button" disabled>
                <svg width="15" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 1L1.5 13.5L14 26" stroke="currentColor" />
                </svg>
            </button>
            <span class="pagination-info">${paginate}</span>
            <button class="pagination__btn pagination__btn-next" type="button">
                <svg width="15" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L13.5 13.5L1 26" stroke="currentColor" />
                </svg>
            </button>
        </div>
    `;

    return html;

}

const lang = document.documentElement.lang;


function createServiceHtml(data, translations, auth = false, serviceHidden = false) {





    const starsHtml = createStarsHtml(data.vote_rating);
    const chartHtml = createChartSvg(data.rating);

    let html = '';

    if (auth) {
        if (data.isHidden) {
            html += `<div class="credit-service bg-grd-1 hidden" data-service-id="${data.id}">`;
        } else {
            html += `<div class="credit-service bg-grd-1" data-service-id="${data.id}">`;
        }
    } else {
        if (serviceHidden) {
            html += `<div class="credit-service bg-grd-1 hidden" data-service-id="${data.id}">`;
        } else {
            html += `<div class="credit-service bg-grd-1" data-service-id="${data.id}">`;
        }
    }

    html += `
        
            <div class="credit-service__col">
                <img class="credit-service__logo" src="${data.icon}" alt="${data.alt_image}">
                <span class="credit-service__title">${data.name}</span>
            </div>
            <div class="credit-service__col">
                <ul class="credit-service__list">
                    <li class="credit-service__item">
                        <span>${translations.from} ${data.interest}% </span>- ${translations.rate_per_day}
                    </li>
                    <li class="credit-service__item">
                        <span>${translations.to} ${data.term} ${translations.days} </span>- ${translations.max_term}
                    </li>
                    <li class="credit-service__item">
                        <span>${translations.to} ${data.amount.toLocaleString(lang)} ${translations.currency} </span>- ${translations.max_amount}
                    </li>
                </ul>
            </div>
            <div class="credit-service__col">
                <div class="credit-service-stars">${starsHtml}</div>
                <span class="credit-service__rating">(${data.vote_count} ${translations.votes})</span>
            </div>
            <div class="credit-service__col">
                <div class="credit-service-chart">${chartHtml}</div>
            </div>
            <div class="credit-service__col">
                <a class="credit-service__link btn-1 service-link" target="_blank" href="${data.url}">${translations.get_loan}</a>
            </div>
            <div class="credit-service__col">
                <div class="credit-service-box">
                    <ul class="credit-service-box__list credit-service-box__list-show">
    `;

    if (auth) {
        if (data.promo_code) {
            html += `
                            <li class="credit-service-box__item">
                                <span class="credit-service-box__col">
                                    <span>${translations.promo_code}:</span>
                                    <span class="credit-service__decor-line"></span>                                                                   
                                </span>
                                <div class="pomocode-box">
                                    <span class="promocode-text">${data.promo_code}</span>
                                    <span class="promocode-btn-copy btn-promocode-copy">
                                        <span class="promocode-btn-copy-text">${translations.copied}!</span>
                                        <svg viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.2488 5.83317C12.2418 4.56442 12.1858 3.87725 11.7372 3.42925C11.2251 2.9165 10.3997 2.9165 8.75 2.9165H7C5.35033 2.9165 4.52492 2.9165 4.01275 3.42925C3.5 3.94142 3.5 4.76684 3.5 6.4165V9.33317C3.5 10.9828 3.5 11.8083 4.01275 12.3204C4.52492 12.8332 5.35033 12.8332 7 12.8332H8.75C10.3997 12.8332 11.2251 12.8332 11.7372 12.3204C12.25 11.8083 12.25 10.9828 12.25 9.33317V8.74984"
                                                stroke="currentColor" stroke-width="0.875"
                                                stroke-linecap="round" />
                                            <path
                                                d="M1.75 5.83317V9.33317C1.75 9.7973 1.93437 10.2424 2.26256 10.5706C2.59075 10.8988 3.03587 11.0832 3.5 11.0832M10.5 2.9165C10.5 2.45238 10.3156 2.00726 9.98744 1.67907C9.65925 1.35088 9.21413 1.1665 8.75 1.1665H6.41667C4.21692 1.1665 3.11675 1.1665 2.43367 1.85017C2.05217 2.23109 1.88358 2.7415 1.8095 3.49984"
                                                stroke="currentColor" stroke-width="0.875"
                                                stroke-linecap="round" />
                                        </svg>
                                    </span>
                                </div>                                                              
                            </li>
            `;
        } else {
            html += `
                <li class="credit-service-box__item">
                    <span class="credit-service-box__col">
                        <span>${translations.promo_code}:</span>
                        <span class="credit-service__decor-line"></span>                                                                   
                    </span>
                    <div class="pomocode-box">
                        
                    </div>                                                              
                </li>
            `;

        }

    } else {


        if (data.promo_code) {

            let promoCode = auth ? `${data.promo_code}%` : data.promo_code;

            html += `
                <li class="credit-service-box__item">
                    <span class="credit-service-box__col">
                        <span>${translations.promo_code}:</span>
                        <span class="credit-service__promocode color-white fw-600">${promoCode}</span>
                    </span>
                    <button class="credit-service__btn-promocode btn-promocode" type="button">
                        ${translations.open}
                    </button>                            
                </li>
            `;

        } else {
            html += `
                <li class="credit-service-box__item">
                    <span class="credit-service-box__col">
                        <span>${translations.promo_code}:</span>
                        <span class="credit-service__promocode color-white fw-600"></span>
                    </span>                                            
                </li>
            `;

        }


    }

    let promoDiscount = '';
    if (data.promo_discount) {
        promoDiscount = `${data.promo_discount}%`;
    }
    html += `      
                        <li class="credit-service-box__item">
                            <span class="credit-service-box__col">
                                <span>${translations.discount_promo_code}</span>
                                <span class="credit-service__decor-line"></span>
                            </span>
                            <span class="credit-service-box__col color-white fw-500">${promoDiscount}</span>
                        </li>
                    </ul>
                    <div class="credit-service-box__accordion">
                        <ul class="credit-service-box__list credit-service-box__list-hidden">
                            <li class="credit-service-box__item">
                                <span class="credit-service-box__col">
                                    <span>${translations.license}:</span>
                                    <span class="credit-service__decor-line"></span>
                                </span>
                                <span class="credit-service-box__col">${data.license}</span>
                            </li>
                            <li class="credit-service-box__item">
                                <span class="credit-service-box__col">
                                    <span>${translations.legal_entity}:</span>
                                    <span class="credit-service__decor-line"></span>
                                </span>
                                <span class="credit-service-box__col">${data.comp_name}</span>
                            </li>
                            <li class="credit-service-box__item">
                                <span class="credit-service-box__col">
                                    <span>E-mail:</span>
                                    <span class="credit-service__decor-line"></span>
                                </span>
                                <span class="credit-service-box__col">${data.email}</span>
                            </li>
                            <li class="credit-service-box__item">
                                <span class="credit-service-box__col">
                                    <span>${translations.address}:</span>
                                    <span class="credit-service__decor-line"></span>
                                </span>
                                <span class="credit-service-box__col">${data.address}</span>
                            </li>
                            <li class="credit-service-box__item">
                                <span class="credit-service-box__col">
                                    <span>${translations.phone}:</span>
                                    <span class="credit-service__decor-line"></span>
                                </span>
                                <span class="credit-service-box__col">${data.phone}</span>
                            </li>
                        </ul>
                        <button class="credit-service-box__btn btn-details" type="button">
                            <span class="credit-service-box__btn-wrapper">
                                <span class="credit-service-box__btn-text-show">${translations.more_details}</span>
                                <span class="credit-service-box__btn-text-hidden">${translations.hide}</span>
                            </span>
                            <span class="credit-service-box__btn-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="credit-service__col">
                <button class="credit-service__btn credit-service__btn-hidden btn-hidden" type="button">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.5013 3.71687C8.30967 3.46005 9.15312 3.33072 10.0013 3.33354C13.4863 3.33354 15.858 5.41688 17.2721 7.25354C17.9805 8.17521 18.3346 8.63437 18.3346 10.0002C18.3346 11.3669 17.9805 11.826 17.2721 12.7469C15.858 14.5835 13.4863 16.6669 10.0013 16.6669C6.5163 16.6669 4.14464 14.5835 2.73047 12.7469C2.02214 11.8269 1.66797 11.366 1.66797 10.0002C1.66797 8.63354 2.02214 8.17438 2.73047 7.25354C3.16255 6.68923 3.64359 6.16414 4.16797 5.68437"
                            stroke="currentColor" stroke-width="1.25" stroke-linecap="round" />
                        <path
                            d="M12.5 10C12.5 10.663 12.2366 11.2989 11.7678 11.7678C11.2989 12.2366 10.663 12.5 10 12.5C9.33696 12.5 8.70107 12.2366 8.23223 11.7678C7.76339 11.2989 7.5 10.663 7.5 10C7.5 9.33696 7.76339 8.70107 8.23223 8.23223C8.70107 7.76339 9.33696 7.5 10 7.5C10.663 7.5 11.2989 7.76339 11.7678 8.23223C12.2366 8.70107 12.5 9.33696 12.5 10Z"
                            stroke="currentColor" stroke-width="1.25" />
                    </svg>
                    <span class="credit-service__btn-wrapper">
                        <span class="credit-service__btn-text-hidden">${translations.hide_2}</span>
                        <span class="credit-service__btn-text-show">${translations.display}</span>
                    </span>
                </button>
                <button class="credit-service__btn credit-service__btn-history btn-history" type="button">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.96854 16.6668C8.27632 16.6668 6.80104 16.1141 5.54271 15.0085C4.28493 13.9035 3.55715 12.5118 3.35938 10.8335H4.20187C4.42854 12.2668 5.0816 13.4585 6.16104 14.4085C7.24049 15.3585 8.50965 15.8335 9.96854 15.8335C11.5935 15.8335 12.9719 15.2677 14.1035 14.136C15.2352 13.0043 15.8013 11.6257 15.8019 10.0002C15.8024 8.37461 15.2363 6.996 14.1035 5.86433C12.9708 4.73266 11.5924 4.16683 9.96854 4.16683C9.10576 4.16683 8.29521 4.34905 7.53687 4.7135C6.77854 5.07739 6.1091 5.57877 5.52854 6.21766H7.59604V7.051H4.13521V3.591H4.96854V5.581C5.61299 4.87377 6.36799 4.32266 7.23354 3.92766C8.0991 3.53266 9.01076 3.33461 9.96854 3.3335C10.8924 3.3335 11.7585 3.50738 12.5669 3.85516C13.3752 4.20294 14.0813 4.67905 14.6852 5.2835C15.2891 5.88794 15.7652 6.59405 16.1135 7.40183C16.4619 8.20961 16.6358 9.07572 16.6352 10.0002C16.6347 10.9246 16.4608 11.7907 16.1135 12.5985C15.7663 13.4063 15.2902 14.1124 14.6852 14.7168C14.0802 15.3213 13.3741 15.7974 12.5669 16.1452C11.7597 16.4929 10.8935 16.6668 9.96854 16.6668ZM12.6385 13.2118L9.59937 10.1735V5.8335H10.4327V9.82683L13.2277 12.6218L12.6385 13.2118Z"
                            fill="currentColor" />
                    </svg>
                    <span class="credit-service__btn-text">${translations.credit_history}</span>
                </button>
            </div>
        </div>  
    `;

    return html;
}



class ForgotPasswordModal {
    constructor(modal, btn, divModalSignIn) {

        this.modal = modal;
        this.form = modal.querySelector('#forgot-password-form');

        this.btnOpen = btn;
        this.divModalSignIn = divModalSignIn;


        this.inputEmail = this.form.querySelector('#email-forgot');

        this.preloader = document.querySelector('.forgot-preloader');
        this.forgotSuccess = document.querySelector('.forgot-success');
        this.messageError = this.form.querySelector('.message-errors');
        this.currentFormGroup = null;

        this.btnSend = this.form.querySelector('.btn-send');


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

        this.currentFormGroup = this.inputEmail.parentNode;

        this.currentFormGroup.classList.remove('error');


    }

    events() {
        this.form.addEventListener('submit', e => {
            e.preventDefault();
        });

        this.btnOpen.addEventListener('click', () => {
            closeModal(this.divModalSignIn);
            openModal(this.modal);

        })



        this.inputEmail.addEventListener('input', () => {

            this.value = this.inputEmail.value.trim();
            this.currentFormGroup = this.inputEmail.parentNode;
            if (checkEmail(this.value)) {
                this.currentFormGroup.classList.remove('error');
                this.currentFormGroup.classList.add('valid');
            } else {
                this.currentFormGroup.classList.remove('valid');
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

        this.modal.addEventListener('click', e => {
            if (e.target.closest('.modal__btn-close') || this.modal.classList.contains('open') && !e.target.closest('.modal-body')) {
                closeModal(this.modal);
            }
        })
    }

    validation() {

        this.flagSend = true;

        this.value = this.inputEmail.value.trim();
        this.currentFormGroup = this.inputEmail.parentNode;
        if (checkEmail(this.value)) {
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
        this.objSendData[this.inputEmail.name] = this.inputEmail.value;

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

            this.currentFormGroup = this.inputEmail.parentNode;
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

const forgotPasswordModal = document.querySelector('#forgot-password');
const btnForgotPassword = document.querySelector('#modal-btn-forgot');
if (forgotPasswordModal && btnForgotPassword && divModalSignIn) {
    new ForgotPasswordModal(forgotPasswordModal, btnForgotPassword, divModalSignIn);
}


class MessageSend {
    constructor(form) {
        this.form = form;
        this.inputs = this.form.querySelectorAll('input');
        this.textarea = this.form.querySelector('textarea');
        this.btnSend = this.form.querySelector('#btn-contacts-send');

        this.preloader = this.form.querySelector('.contacts-form-preloader');
        this.messageSucces = this.form.querySelector('.contact-forms-success');
        this.messageError = this.form.querySelector('.message-errors');

        this.modalMessage = document.querySelector('#messages');
        this.modalMessageText = this.modalMessage.querySelector('.message-text');


        this.currentFormGroup = null;
        this.objSendData = null

        this.flagSend = false;

        this.url = this.form.getAttribute('action');

        this.objData = null;

        this.timerId = null;
        this.time = 2000;

        this.init();
    }
    init() {

        this.events();
    }
    // default() { }
    events() {

        this.form.addEventListener('submit', e => {
            e.preventDefault();
        });

        this.inputs.forEach(input => {
            input.addEventListener('input', () => {
                this.currentFormGroup = input.parentNode;
                this.currentFormGroup.classList.remove('error');
            })
        })
        this.textarea.addEventListener('input', () => {
            this.currentFormGroup = this.textarea.parentNode;
            this.currentFormGroup.classList.remove('error');
        })

        this.btnSend.addEventListener('click', () => {
            this.validation();

            if (this.flagSend) {
                this.formObjSendData();
                this.messageError.innerHTML = '';
                this.messageError.style.display = 'none';
                this.preloader.style.display = 'flex';
                this.send();
            }

        })
    }

    validation() {
        this.flagSend = true;
        this.inputs.forEach(input => {
            if (input.value.length == 0) {
                this.flagSend = false;
                this.currentFormGroup = input.parentNode;
                this.currentFormGroup.classList.add('error');
            }
        })
        if (this.textarea.value.length == 0) {
            this.flagSend = false;
            this.currentFormGroup = this.textarea.parentNode;
            this.currentFormGroup.classList.add('error');
        }
    }

    formObjSendData() {
        this.objSendData = {};

        this.inputs.forEach(input => {

            this.objSendData[input.name] = input.value;

        })
        this.objSendData[this.textarea.name] = this.textarea.value;

        if (tokenCsrf) {
            this.objSendData['_token'] = tokenCsrf;
        }
    }
    resSuccess() {
        this.preloader.style.display = 'none';

        this.form.reset();
        this.messageSucces.style.display = 'flex';

        this.timerId = setTimeout(() => {
            clearTimeout(this.timerId);
            this.messageSucces.style.display = 'none';
        }, this.time);
    }
    resError() {
        this.preloader.style.display = 'none';
        if (this.objData['status'] == 429) {
            this.messageError.innerHTML = this.objData.message;
            this.messageError.style.display = 'flex';
            return;
        }


        if (this.objData['status'] == 419) {
            this.modalMessageText.innerHTML = this.objData.message;

            openModal(this.modalMessage);

            return;
        }

        this.errors = this.objData['errors'];
        console.log(this.errors);

        this.html = '';
        for (const key in this.errors) {
            this.html += `<span>${this.errors[key]}</span>`;
        }

        this.messageError.innerHTML = this.html;

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

                        this.objData = error.errors;
                        this.objData['status'] = error.status;

                        this.resError();
                    }


                    console.error('Fetch error:', error);

                    this.flagSend = true;
                });
        }



    }
}


const divContactsForm = document.querySelector('#contacts-form');
if (divContactsForm) {
    new MessageSend(divContactsForm);
}