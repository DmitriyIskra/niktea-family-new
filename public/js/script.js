// ----------  П Р О К Р У Т К А  К  П Р И З А М  С  Р Е Д И Р Е К Т О М
// находим кнопку призы в хедер (!!!!!!!!!!!  РАБОЧАЯ ВЕРСИЯ  !!!!!!!!!!)
// const nav = document.querySelector('.header__link-prizes');
// const sizeWindow = window.innerWidth; // 768 mobile version
 
// nav.addEventListener('click', (e) => {
//     let prizes = null;
//     if(sizeWindow > 768) prizes = document.querySelector('.slider_circle_10');
//     if(sizeWindow <= 768) prizes = document.querySelector('.priz-mobile');
    
//     if(prizes) {
//         scrollToPrizes(prizes);
//     } else {
//         localStorage.redirect = true;

//         location.href = '/';
//     }
// });

// // при загрузке страницы проверяем есть ли в хранилище 
// // информация о редиректе
// if(localStorage?.redirect === 'true') {
//     let prizes = null;
//     if(sizeWindow > 768) prizes = document.querySelector('.slider_circle_10');
//     if(sizeWindow <= 768) prizes = document.querySelector('.priz-mobile');

//     scrollToPrizes(prizes);

//     delete localStorage.redirect;
// }



// function scrollToPrizes(el) {
//     const offsetTop = el.getBoundingClientRect().top;

//     setTimeout(scrollTo({
//         top: offsetTop,
//         behavior: "smooth",
//     }), 100)
      
// }


// ----------  П Р О К Р У Т К А  К  П Р И З А М




//----- М А С К А  Т Е Л Е Ф О Н А  __Р А Б О Ч А Я В Е Р С И Я

document.addEventListener("DOMContentLoaded", function () {
    var eventCalllback = function (e) {
        var el = e.target,
            clearVal = el.dataset.phoneClear,
            pattern = el.dataset.phonePattern,
            matrix_def = "+7(___) ___-__-__",
            matrix = pattern ? pattern : matrix_def,
            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = e.target.value.replace(/\D/g, "");
        if (clearVal !== 'false' && e.type === 'blur') {
            if (val.length < matrix.match(/([\_\d])/g).length) {
                e.target.value = '';
                return;
            }
        }
        if (def.length >= val.length) val = def;
        e.target.value = matrix.replace(/./g, function (a) {
            return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
        });
    }
    var phone_inputs = document.querySelectorAll('[data-phone-pattern]');
    for (let elem of phone_inputs) {
        for (let ev of ['input', 'blur', 'focus']) {
            elem.addEventListener(ev, eventCalllback);
        }
    }
});

//------ E N D  М А С К А  Т Е Л Е Ф О Н А  __Р А Б О Ч А Я  В Е Р С И Я



// window.addEventListener('load', () => {
    // Слайдер кодов

    // let codeArr = [];
    // let codePlace = null; 

    // const codeAddbutton = document.querySelector('.code__add');
    // const codeSlider = document.querySelector('.code__slider');
    // const codeSubmit = document.querySelector('.code__submit')

    // function registerEvents() {
    //   codeAddbutton.addEventListener('click', () => {
    //     codeSlider.classList.add('code__sleder--display');
    //   })
    // }

    // if(codeAddbutton){


    //   codeSubmit.addEventListener('click', (e) => {
    //     console.log('Кнопка зарегистрировать код')
    //   })
    // }


    // С Л А Й Д Е Р  К О Д О В  __Р А Б О Ч А Я В Е Р С И Я
    // let swiperCode = new Swiper(".account__slider-add-code", {
    //     // grabCursor: true,
    //     // keyboard: true, 
    //     slidesPerView: 1,
    //     spaceBetween: 2,
    //     loop: true,
    //     centeredSlides: true,
    //     slideShadows: true,
    //     navigation: {
    //         nextEl: ".code__carousel-next",
    //         prevEl: ".code__carousel-prev",
    //     },
    //     breakpoints: {
    //         992: {
    //             // centeredSlides: true,
    //             slidesPerView: 1,
    //             spaceBetween: 0,
    //         },
    //         320: {
    //             slidesPerView: 1,
    //             spaceBetween: 0
    //         },
    //         300: {
    //             // with: 200,
    //             slidesPerView: 1,
    //             spaceBetween: 0,
    //         },
    //     },

    // });

// })

 // E N D  С Л А Й Д Е Р  К О Д О В  __Р А Б О Ч А Я В Е Р С И Я

// let swiperCheck
// //----- С Л А Й Д Е Р  Ч Е К О В  __Р А Б О Ч А Я В Е Р С И Я
// if(document.querySelector('.checkSlider')) {
//     console.log('init slider check')
//     swiperCheck = new Swiper(".account__slider-check", {
//         // grabCursor: true,
//         keyboard: true,
//         slidesPerView: 3,
//         spaceBetween: 10,
//         // loop: true,
//         slideShadows: true,
//         // отменили перетаскивание на ПК
//         simulateTouch: false,
//         navigation: {
//             nextEl: ".slider-button-next",
//             prevEl: ".slider-button-prev",
//         },

//         pagination: {
//             el: ".pagination",
//             type: "bullets",
//             // динамические булеты
//             dynamicBullets: true,
//             clickable: true,
//             renderBullet: function (index, className) {
//                 return '<span class="' + className + '">' + (index + 1) + "</span>";
//             },
//         },

//         // медиа запросы min-width
//         breakpoints: {
//             1920: {
//                 slidesPerView: 3,
//                 // spaceBetween: 15,
//             },
//             1536: {
//                 slidesPerView: 2,
//                 // spaceBetween: 15,
//             },
//             1280: {
//                 slidesPerView: 1,
//                 // spaceBetween: 15,
//             },
//             768: {
//                 // width: 940,
//                 slidesPerView: 3,
//                 // spaceBetween: 5,
//             },
//             // 540: {
//             //   slidesPerView: 1,
//             //   // spaceBetween: 0,
//             // },
//             300: {
//                 slidesPerView: 1,
//                 // spaceBetween: 5,
//             },
//         }
//     });

//     let checkPaginationNext = document.querySelector('.pagination-next--check')
//     let checkPaginationPrev = document.querySelector('.pagination-prev--check')


//     checkPaginationNext.addEventListener('click', function(){
//         swiperCheck.slideNext();
//     })

//     checkPaginationPrev.addEventListener('click', function(){
//         swiperCheck.slidePrev();
//     })
    
// }

// export default swiperCheck
//-------- E N D  С Л А Й Д Е Р  Ч Е К О В  __Р А Б О Ч А Я В Е Р С И Я









