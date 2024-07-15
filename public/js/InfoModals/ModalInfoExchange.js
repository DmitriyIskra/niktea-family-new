export default class ModalInfoExchange {
    constructor() {
        this.state =  {
            activate: 'api-res__wrapper_active',
            type: {
                lottery : 'api-res__lottery',
                noEnough : 'api-res__no-enough',
                success : 'api-res__success',
                failSend : 'api-res__fail-send',
                chequeSuccess : 'api-res__cheque-success',
            }
        };

        this.modal = null;
        this.modalClick = this.modalClick.bind(this);
    }

    // РЕГИСТРАЦИЯ СОБЫТИЙ И ИХ УДАЛЕНИЕ

    registerModalEvents() {
        if(this.modal) {
            this.modal.addEventListener('click', this.modalClick);
        }
    }

    removeEvents() {
        this.modal.removeEventListener('click', this.modalClick);
    }

    // СОБЫТИЯ

    modalClick(e) { 
        if(e.target.closest('.api-res__close')) {
            this.unactivateModal();
        }

        if(e.target.matches('.api-res__wrapper')) {
            this.unactivateModal();  
        }
    }

    // АКТИВАЦИЯ, ДЕАКТИВАЦИЯ МОДАЛОК 

    activateModal() {
        // находим модалку н астранице
        if(!this.modal) {
            this.modal = document.querySelector('.api-res__wrapper');
        }

        this.registerModalEvents();
        // активируем
        if(this.modal) this.modal.classList.add(this.state.activate);
    }

    unactivateModal() {
        if(this.modal) this.modal.className = 'api-res__wrapper';
        this.removeEvents();
    }

    // ОКНА ( УКАЗАНИЕ ТИПА КОНТЕНТА )

    openModalLottery() {
        this.activateModal();
        // указываем тип контента
        this.setModalType('lottery');
    }

    openModalnoEnough() {
        this.activateModal();
        // указываем тип контента
        this.setModalType('noEnough');
    }
    
    openModalSuccess() {
        this.activateModal();
        // указываем тип контента
        this.setModalType('success');
    }
    
    openModalFailSend() {
        this.activateModal();
        // указываем тип контента
        this.setModalType('failSend');
    }

    openModalСhequeSuccess() {
        this.activateModal();
        // указываем тип контента
        this.setModalType('chequeSuccess');
    }

    // тип контента активирующийся в окне модалки
    setModalType(data) {
        this.modal.classList.add(this.state.type[data]);
    }
}