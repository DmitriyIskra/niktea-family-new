export default class ControllMoreDetailed {
    constructor(d) {
        this.d = d;

        this.click = this.click.bind(this);
    }

    init() {
        this.registerEvents();
    } 

    registerEvents() {
        this.d.element.addEventListener('click', this.click);
    }

    click(e) {        
        // переключаем окна с информацией о подарках и табы
        if(e.target.closest('.more-detailed__tabs-item')) {
            this.d.changeWindowInfo();
        }

        // переход в личный кабинет или открытие модалки входа 
        if(e.target.closest('.more-detailed__to-account')) {
            e.preventDefault();

            // определяем десктоп или мобилка отменяем стандартное
            // поведение чтоб не прокручивалось и эмулируем клик

            const toAccountMobile = document.querySelector('.account-logo-mobile');

            if(getComputedStyle(toAccountMobile).display !== 'block') {
                // DESCTOP
                const toAccountDesctop = document.querySelector('#lkbuttonpc');

                toAccountDesctop.addEventListener('click', (e) => e.preventDefault(),
                 {once : true});
                console.dir(toAccountDesctop.pathname)
                if(toAccountDesctop.pathname === '/account') {
                    location.href = '/account';
                    return;
                }

                toAccountDesctop.click();
                return;
            }

            // MOBILE
            toAccountMobile.addEventListener('click', (e) => e.preventDefault(),
             {once : true});

             if(toAccountMobile.pathname === '/account') {
                location.href = '/account';
                return;
            }

            toAccountMobile.click();
        }
    }
}