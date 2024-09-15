export default class RedrawMoreDetailed {
    constructor(element, buttonMenuGifts) {
        this.element = element;
        this.buttonMenuGifts = buttonMenuGifts;
        console.log(this.buttonMenuGifts)

        this.popUp = this.element.querySelector('.more-detailed__wr-modal');
        
        this.tabs = [
            this.element.querySelector('[data-type="bonus-prog"]'),
            this.element.querySelector('[data-type="lottery"]'),
        ]
        this.windowsInfo = [
            this.element.querySelector('.more-detailed__wr-content-bonus-prog'),
            this.element.querySelector('.more-detailed__wr-content-lottery'),
        ]
    }

    // активируем или скрываем весь POP-UP
    showClosePopUp() {
        this.popUp.classList.toggle('more-detailed__modal_active');
    }

    // переключаем табы и меняем таблицы с бонусами
    changeWindowInfo() {
        this.tabs.forEach(item => item.classList.toggle('more-detailed__tabs_active'));
        this.windowsInfo.forEach(item => item.classList.toggle('more-detailed__wr-content_active'));
    }
} 