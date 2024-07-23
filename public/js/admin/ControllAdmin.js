export default class ControllAdmin {
    constructor(panel, api, redraws, rerender) {
        this.panel = panel;
        this.api = api;
        this.rerender = rerender;
        
        this.userData = redraws.userData;
        this.id = redraws.id;
        this.cheques = redraws.cheques;
        this.balls = redraws.balls;
        this.isLottery = redraws.lottery;
        this.giftsPoints = redraws.giftsPoints;
        this.giftLottery = redraws.giftLottery;
        this.awardedLottery = redraws.awardedLottery;
 
        this.token = null;
        this.activeUserID = null;
        this.is_active = null;

        this.click = this.click.bind(this);
    }

    init() {
        this.userData.modalEdit = this.panel.querySelector('.modal-edit');
        this.userData.modalIsBlocked = this.userData.modalEdit.querySelector('.modal-edit__user-is-blocked');
        this.userData.editForm = this.userData.modalEdit.querySelector('form');
        this.userData.modalConfirm = this.panel.querySelector('.modal-confirmation');

        this.api.token = this.userData.editForm._token.value;
       
        this.registerEvents();
    }

    registerEvents() {
        this.panel.addEventListener('click', this.click);
    }

    click(e) {
        /**открыть окно редактирования адреса пользователя*/ 
        if(e.target.closest('.panel__user-item-edit_user-data')) {
            const parrentItem = e.target.closest('.panel__user-item-content');

            this.activeUserID = e.target.dataset.user_id;
  
            this.is_active = +parrentItem.dataset.is_active;

            const data = {
                fio : parrentItem.querySelector('.panel__user-fio'),
                phone : parrentItem.querySelector('.panel__user-phone'),
                email : parrentItem.querySelector('.panel__user-email'),
                address : parrentItem.querySelector('.panel__user-address'),
                is_active : this.is_active,
            }

            this.userData.openModalEdit(data);
        }

        /**закрыть окно редактирования адреса пользователя по крестику*/ 
        if(e.target.closest('.modal-edit_close')) {
            this.userData.closeModalEdit();
            this.clearDataUser();
        }

        /**открыть подтверждение блокировки*/ 
        if(e.target.closest('.modal-panel__button_block')) {
            this.userData.closeModalEdit();
            this.userData.openModalConfirm(this.is_active);
        }

        /**
         * закрыть подтверждение блокировки по крестику
         * или кнопке отмена
         * */ 
        if(e.target.closest('.modal-confirmation_close') 
        || e.target.closest('.modal-confirmation__button_cancel')) {
            this.userData.closeModalConfirm(this.is_active);
            this.clearDataUser();
        }

        /**блокировка или разблокировка пользователя*/
        if(e.target.closest('.modal-confirmation__button_agree')) {
            (async() => {
                const result = await this.api.update('blocking', this.activeUserID);

                if(result) {
                    const user = this.panel.querySelector(`li[data-user_id='${this.activeUserID}']`);
                    this.userData.colorFIO(user);
    
                    this.userData.closeModalConfirm(this.is_active);
                    this.clearDataUser();
                }
            })()
        }
    }



    clearDataUser() {
        this.activeUserID = null;
        this.is_active = null;
    }
} 