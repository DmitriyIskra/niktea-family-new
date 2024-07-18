// Информационные модалки
import ModalInfo from "./InfoModals/ModalInfo.js";

// Слайдер на главной
import ControllSlHeaderMain from "./sliderHeaderMain/controllSlHeaderMain.js";
import RedrawSlHeaderMain from "./sliderHeaderMain/redrawSlHeaderMain.js";
import MobileSlHeaderMain from "./sliderHeaderMain/mobileSlHeaderMain.js";

// Больше о подарках на главной
import ControllMoreDetailed from "./more-detailed/ControllMoreDetailed.js";
import RedrawMoreDetailed from "./more-detailed/RedrawMoreDetailed.js";

// Блок с бонусами
import ControllExchange from "./exchange/ControllExchange.js";
import RedrawExchange from "./exchange/RedrawExchange.js";
import ApiExchange from "./exchange/ApiExchange.js";

// Добавление нового чека в аккаунте -- слайдер с чеками в аккаунте
import ControllAccNewCheque from "./accountNewCheque/controllAccNewCheque.js";
import RedrawAccNewCheque from "./accountNewCheque/redrawAccNewCheque.js";
import ApiAccNewCheque from "./accountNewCheque/ApiAccNewCheque.js";
import PatternNewCheque from "./accountNewCheque/patternNewCheque.js";
// import RedrawVoucherSlider from "./accountNewCheque/redrawVoucherSlider.js";

// Книга с фото чеков в аккаунте
import ControllСhequesbook from "./chequebook/controllСhequesbook.js";
import RedrawСhequesbook from "./chequebook/redrawСhequesbook.js";
import ApiСhequesbook from "./chequebook/apiСhequesbook.js";
import PatternChequesbook from "./chequebook/patternChequesbook.js";

// loader
import ControllLoader from "./loader/ControllLoader.js";



window.addEventListener('load', () => {
    // LOADER
    const loader = document.querySelector('.loader');
    let controllLoader;
    if(loader) controllLoader = new ControllLoader(loader);
    window.controllLoader = controllLoader;
    // Слайдер для HEADER
    const sliderHead = document.querySelector('.slider-hm');

    if(sliderHead) {
        const redrawSlHeaderMain = new RedrawSlHeaderMain(sliderHead);
        const controllSlHeaderMain = new ControllSlHeaderMain(redrawSlHeaderMain);
        controllSlHeaderMain.init();
    }

    // Слайдер для HEADER mobile
    const swiper__mainSL = document.querySelector('.swiper__main-header')

    if(swiper__mainSL) {
        const mobileSlHeaderMain = new MobileSlHeaderMain(swiper__mainSL);
        mobileSlHeaderMain.initSlider();
    }

    // Больше о подарках на главной
    const moreDetailed = document.querySelector('.more-detailed');
    if(moreDetailed) {
        const redraw = new RedrawMoreDetailed(moreDetailed);
        const controll = new ControllMoreDetailed(redraw);
        controll.init();
    }

    // Блок с бонусами
    const exchange = document.querySelector('.exchange__wrapper');
    if(exchange) {
        const userData = document.querySelector('.user__data')
        const apiExchange = new ApiExchange();
        const redrawExchange = new RedrawExchange(exchange, userData);
        const controllExchange = new ControllExchange(redrawExchange, apiExchange, controllLoader);
        controllExchange.init();
    }

    // Добавление нового чека в аккаунте и управление книгой с чеками
    const cheque = document.querySelector('.up-cheque');
    if(cheque) {
        const chequebook = document.querySelector('.chequebook');
        const patternCh = new PatternChequesbook();
        const apiCh = new ApiСhequesbook();
        const redrawCh = new RedrawСhequesbook(chequebook, patternCh);
        const controllCh = new ControllСhequesbook(redrawCh, apiCh);
        controllCh.init();
        // метод для обновления фото чеков в книге
        const update = redrawCh.update;
     
        // Добавление чеков (кнопка и отправка файлов на сервер)
        const pattern = new PatternNewCheque();
        const redraw = new RedrawAccNewCheque(cheque, pattern);
        const api = new ApiAccNewCheque();
        const controll = new ControllAccNewCheque(api, redraw, controllLoader, update); //sliderCheque
        controll.init();
    }

    // проверка участия в лотерее и если нужно показ модалки
    const lottery = document.querySelector('.user_prezent-icon');
    if(lottery) {
        const result = lottery.dataset.lottery;
        const modalInfo = new ModalInfo();

        if(result && !sessionStorage?.lottery) modalInfo.openModalLottery();
        
        if(!sessionStorage?.lottery) sessionStorage.lottery = true;
    }
})
 