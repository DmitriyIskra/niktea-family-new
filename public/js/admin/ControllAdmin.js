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
        this.activeUser = null
        this.activeUserID = null;
        this.is_active = null;

        this.click = this.click.bind(this);
        this.handlerBalls = this.handlerBalls.bind(this);
        this.handlerGiftLottery = this.handlerGiftLottery.bind(this);
        this.handlerGiftPoints = this.handlerGiftPoints.bind(this);
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
        let target;

        // ------------======== ПОЛЬЗОВАТЕЛЬ

        /**открыть окно редактирования адреса пользователя*/ 
        if(target = e.target.closest('.panel__user-item-edit_user-data')) {

            this.getUserIdandIs_Active(target);

            const data = {
                fio : this.activeUser.querySelector('.panel__user-fio'),
                phone : this.activeUser.querySelector('.panel__user-phone'),
                email : this.activeUser.querySelector('.panel__user-email'),
                address : this.activeUser.querySelector('.panel__user-address'),
                is_active : this.is_active,
            }

            this.userData.openModalEdit(data);
        }

        /**закрыть окно редактирования адреса пользователя по крестику*/ 
        if(e.target.closest('.modal-edit_close')) {
            this.userData.closeModalEdit();
            this.clearDataUser();
        }

        /**открыть подтверждение удаления*/
        if(e.target.closest('.modal-panel__button_delete')) {
            this.userData.closeModalEdit();
            this.userData.openModalConfirm('remove', this.is_active);
        }

        /**открыть подтверждение блокировки*/ 
        if(e.target.closest('.modal-panel__button_block')) {
            this.userData.closeModalEdit();
            this.userData.openModalConfirm('blocking', this.is_active);
        }

        /**
         * закрыть подтверждение блокировки - удаления по крестику
         * или кнопке отмена в поп-ап подтверждения
         * */ 
        if(e.target.closest('.modal-confirmation_close') 
        || e.target.closest('.modal-confirmation__button_cancel')) {
            this.userData.closeModalConfirm();
            this.clearDataUser();
        }

        /**удаление пользователя*/
        if(e.target.closest('.modal-confirmation__button_agree') &&
        e.target.closest('[data-action="remove"]')) {
            (async () => {
                const result = await this.api.delete('user', this.activeUserID, null);

                if(result) {
                    this.userData.removeUser(this.activeUser);
                }

                this.userData.closeModalConfirm();
                this.clearDataUser();
            })()
        }

        /**блокировка или разблокировка пользователя*/
        if(e.target.closest('.modal-confirmation__button_agree') &&
        e.target.closest('[data-action="blocking"]')) {
            (async() => {
                const result = await this.api.update('blocking', null, this.activeUserID);

                if(result) {
                    this.userData.colorFIO(this.activeUser);
                }

                this.userData.closeModalConfirm();
                this.clearDataUser();

            })()
        }
        
        /**редактирование контактных данных*/
        if(e.target.closest('.modal-panel__button_submit')) {
            const formData = new FormData(this.userData.editForm);
            formData.append('action', 'edit_contacts');
            
            (async() => {
                const result = await this.api.update('edit_contacts', formData, this.activeUserID);

                if(result) {
                    this.userData.changeUserData(this.activeUser, result);
                }

                this.userData.closeModalEdit();
                this.clearDataUser();
            })()
        }

        // -----------======== ЧЕКИ 

        /**верификация чека*/
        if(target = e.target.closest('.panel__circle-verified_cheque')) {
            const chequeId = target.dataset.id;
            (async () => {
                const result = await this.api.update('verified_cheque', chequeId, null);

                const target = e.target.closest('.panel__circle-verified_cheque') 
                this.cheques.changeVerified(target, result);
                this.clearDataUser();
            })()
        }

        /**удаление чека*/
        if(target = e.target.closest('.panel__user-cheques-basket')) {
            const cheque_id = target.dataset.id;
            
            (async () => {
                const result = await this.api.delete('cheque', null, cheque_id);

                if(result) {
                    const cheque = e.target.closest('.panel__user-cheques-item')
                    this.cheques.delete(cheque);
                    this.clearDataUser();
                }
            })()
        }
        
        // ------------====== БАЛЛЫ

        /**редактирование баллов*/
        if(e.target.closest('.panel__user-wr-balls') 
        && !e.target.closest('input')) {
            const target = e.target.closest('.panel__user-wr-balls');
            const is_active = +target.dataset.is_active;
            const form = target.querySelector('form');

            this.getUserIdandIs_Active(target);

            // форма не активна 
            if(!is_active) {
                // если какая то форма уже была открыта
                if(this.balls.activeForm) {
                    this.balls.activeForm.removeEventListener('submit', this.handlerBalls, {once: true});
                }
                
                this.balls.openForm(target, form);
            };
            // предыдущая или актуальная форма активна - закрываем 
            if(is_active) this.balls.closeForm();
            
            form.addEventListener('submit', this.handlerBalls, {once: true});
        }

        // ----------============ УЧАСТИЕ В ЛОТЕРЕЕ
        if(e.target.closest('.panel__checkmark_lottery')) {
            const target = e.target.closest('.panel__checkmark_lottery');
            this.getUserIdandIs_Active(target);
            (async () => {
                const result = await this.api.update('lottery', null, this.activeUserID);

                if(result) this.isLottery.changeState(target);

                this.clearDataUser();
            })()
        }

        // ----------============== СПИСОК ПОДАРКОВ ПО БАЛЛАМ

        // добавление подарков за баллы
        if(e.target.closest('.panel__user-item-edit_gift-p')
        && !e.target.closest('input')) {
            const target = e.target.closest('.panel__user-wr-gifts-points');
            const is_active = +target.dataset.is_active;
            const form = target.querySelector('form');

            this.getUserIdandIs_Active(target);

            // форма не активна 
            if(!is_active) {
                // если какая то форма уже была открыта
                if(this.giftsPoints.activeForm) {
                    this.giftsPoints.activeForm.removeEventListener('submit', this.handlerGiftLottery, {once: true});
                }
                
                this.giftsPoints.openForm(target, form);
            };
            // если предыдущая или актуальная форма активна - закрываем 
            if(is_active) this.giftsPoints.closeForm();
            
            form.addEventListener('submit', this.handlerGiftPoints, {once: true});
        }

        // верификация подарков по баллам
        if(e.target.closest('.panel__circle-verified_gift-p')) {
            const target = e.target.closest('.panel__circle-verified_gift-p');
            const name = target.nextElementSibling.textContent;
            const id = target.dataset.gift_id;
            
            this.getUserIdandIs_Active(target);

            (async () => {
                const result = await this.api.update('verifie_gift_point', {id, name}, this.activeUserID);
                
                this.giftsPoints.changeVerifie(result, target, null);

                this.clearDataUser()
            })()
        }


        // -----------============ ПРИЗ ПО ЛОТЕРЕЕ
        if(e.target.closest('.panel__user-wr-gifts-lottery')
        && !e.target.closest('input')) {
            const target = e.target.closest('.panel__user-wr-gifts-lottery');
            const is_active = +target.dataset.is_active;
            const form = target.querySelector('form');

            this.getUserIdandIs_Active(target);

            // форма не активна 
            if(!is_active) {
                // если какая то форма уже была открыта
                if(this.giftLottery.activeForm) {
                    this.giftLottery.activeForm.removeEventListener('submit', this.handlerGiftLottery, {once: true});
                }
                
                this.giftLottery.openForm(target, form);
            };
            // если предыдущая или актуальная форма активна - закрываем 
            if(is_active) this.giftLottery.closeForm();
            
            form.addEventListener('submit', this.handlerGiftLottery, {once: true});
        }


        // ----------============= ПОЛУЧИЛ ПРИЗ ПО ЛОТЕРЕЕ (AWARDED)
        if(e.target.closest('.panel__checkmark_awarded')) {
            const target = e.target.closest('.panel__checkmark_awarded');
            this.getUserIdandIs_Active(target);
            (async () => {
                const result = await this.api.update('awarded', null, this.activeUserID);

                if(result) this.awardedLottery.changeState(target);

                this.clearDataUser();
            })()
        }
    }

    async handlerBalls(e) {
        e.preventDefault();

        const data = e.target.balls.value;

        const result = await this.api.update('balls', data, this.activeUserID);

        if(result.is_changed) this.balls.changeBalls(result.balls);
    
        this.balls.closeForm();

        this.clearDataUser();
    }

    async handlerGiftLottery(e) {
        e.preventDefault();

        const data = e.target.gift_lottery.value;

        const result = await this.api.update('gift_lottery', data, this.activeUserID);

        if(result.is_changed) this.giftLottery.changeText(result.gift);
    
        this.giftLottery.closeForm();

        this.clearDataUser();
    }

    async handlerGiftPoints(e) {
        e.preventDefault();

        // проверяем есть ли подарки, берем первый или не берем (null)
        // определяем id
        const value = e.target.gift_points.value;
        const gifts = [...this.giftsPoints.activeList.children];
        const verifie = gifts.length ? gifts[0].children[0] : null;
        
        const data = {
            id : verifie ? +verifie.dataset.gift_id + 1 : 0,
            verified : 0,
            name : value,
        }

        const result = await this.api.update('gift_point', data, this.activeUserID);
    
        if(result.is_changed) this.giftsPoints.addGift(result.gift);
    
        this.giftsPoints.closeForm();

        this.clearDataUser();
    }

    /**получаем id и is_active пользователя с которым работаем*/ 
    getUserIdandIs_Active(target) {
        this.activeUser = target.closest('.panel__user-item');
        this.activeUserID = this.activeUser.dataset.user_id;
        this.is_active = +this.activeUser.dataset.is_active;
    }

    clearDataUser() {
        this.activeUser = null;
        this.activeUserID = null;
        this.is_active = null;
    }
} 