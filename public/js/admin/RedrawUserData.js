export default class RedrawUserData {
    constructor() {
        this.modalEdit = null; //Окно изменения данных пользователя
        this.modalIsBlocked = null;
        this.editForm = null;
        this.modalConfirm = null; //Окно подтверждения блокировки пользователя
    }

    colorFIO(el) {
        const fio = el.querySelector('.panel__user-fio');
        const content = el.querySelector('.panel__user-item-content');

        fio.classList.toggle('panel__user-fio_red');
        content.dataset.is_active = +content.dataset.is_active ? 0 : 1;
    }

    /**Окно изменения данных пользователя*/ 
    openModalEdit(data) {
        // надпись - профиль заблокирован
        if(!+data.is_active) {
            this.modalIsBlocked.classList.add('modal-edit__user-is-blocked_active');
        }

        this.editForm.second_name.value = data.fio.dataset.second_name;
        this.editForm.name.value = data.fio.dataset.name;
        this.editForm.patronymic.value = data.fio.dataset.patronymic;
        this.editForm.phone.value = data.phone.textContent;
        this.editForm.email.value = data.email.textContent;
        
        this.editForm.index.value = data.address.dataset.index || '';
        this.editForm.area.value = data.address.dataset.area || '';
        this.editForm.district.value = data.address.dataset.district || '';
        this.editForm.settlement.value = data.address.dataset.settlement;
        this.editForm.street.value = data.address.dataset.street;
        this.editForm.house.value = data.address.dataset.house;
        this.editForm.appartment.value = data.address.dataset.appartment;

        // кнопка 'Заблокировать' : 'Разблокировать', определяем текст
        this.editForm.blocking.textContent = data.is_active ? 'Заблокировать' : 'Разблокировать';

        this.modalEdit.classList.add('modal-edit_active');
    }

    closeModalEdit() {
        this.modalIsBlocked.classList.remove('modal-edit__user-is-blocked_active');
        this.editForm.reset();
        this.editForm.blocking.textContent = '';

        this.modalEdit.classList.remove('modal-edit_active');
    }

    /**Окно подтверждения блокировки пользователя*/ 
    openModalConfirm(is_active) {
        this.modalConfirm.classList.add('modal-confirmation_active');

        this.modalConfirm
            .querySelector('.modal-confirmation__content')
            .textContent = is_active ? 'Заблокировать пользователя?' : 'Разблокировать пользователя?';

        this.modalConfirm
            .querySelector('.modal-confirmation__button_agree')
            .textContent = is_active ? 'Заблокировать' : 'Разблокировать';
    }

    closeModalConfirm() {
        this.modalConfirm.classList.remove('modal-confirmation_active');

        this.modalConfirm
            .querySelector('.modal-confirmation__content')
            .textContent = '';

        this.modalConfirm
            .querySelector('.modal-confirmation__button_agree')
            .textContent = '';
    }
} 