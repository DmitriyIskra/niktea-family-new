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

// ADMIN
import ControllAdmin from "./admin/ControllAdmin.js";
import ApiAdmin from "./admin/apiAdmin.js";
import RedrawGiftLottery from "./admin/RedrawGiftLottery.js";
import RedrawUserAwardedLottery from "./admin/RedrawUserAwardedLottery.js";
import RedrawUserBalls from "./admin/RedrawUserBalls.js";
import RedrawUserCheques from "./admin/RedrawUserCheques.js";
import RedrawUserData from "./admin/RedrawUserData.js";
import RedrawUserGiftsPoints from "./admin/RedrawUserGiftsPoints.js";
import RedrawUserId from "./admin/RedrawUserId.js";
import RedrawUserLottery from "./admin/RedrawUserLottery.js";
import PatternSearchUsers from "./admin/PatternSearchUsers.js";
import RerenderAllUsers from "./admin/RerenderAllUsers.js";

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

    const panel = document.querySelector('.panel');
    if(panel) {
        const api = new ApiAdmin(controllLoader);
 
        const redraws = {
            giftLottery : new RedrawGiftLottery(),
            awardedLottery : new RedrawUserAwardedLottery(),
            balls : new RedrawUserBalls(),
            cheques : new RedrawUserCheques(),
            userData : new RedrawUserData(),
            giftsPoints : new RedrawUserGiftsPoints(),
            id : new RedrawUserId(),
            lottery : new RedrawUserLottery(),
        }
        
        const pattern = new PatternSearchUsers();
        const rerender = new RerenderAllUsers(pattern);
        
        const controll = new ControllAdmin(panel, api, redraws, rerender);
        controll.init();
    }
})
 