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
        el.dataset.is_active = +el.dataset.is_active ? 0 : 1;
    }

    changeUserData(el, data) {
        console.log(el, data);
        const wrFio = el.querySelector('.panel__user-fio');
        const secondName = el.querySelector('.panel__user-fio_second_name');
        const namePatronymic = el.querySelector('.panel__user-fio_name-patronymic');
        
        const phone = el.querySelector('.panel__user-phone');
        const email = el.querySelector('.panel__user-email');
        const address = el.querySelector('.panel__user-address');

        wrFio.dataset.second_name = data.second_name;
        wrFio.dataset.name = data.name;
        wrFio.dataset.patronymic = data.patronymic;

        secondName.textContent = data.second_name;
        namePatronymic.textContent = `${data.name} ${data.patronymic}`;

        phone.textContent = data.phone;
        email.textContent = data.email;
 
        address.dataset.index = data.index ? data.index : '';
        address.dataset.area = data.area ? data.area : '';
        address.dataset.district = data.district ? data.district : '';
        address.dataset.settlement = data.settlement;
        address.dataset.street = data.street;
        address.dataset.house = data.house;
        address.dataset.appartment = data.appartment ? data.appartment : '';

        address.textContent = `
            ${data.index ? `${data.index},` : ''} 
            ${data.area ? `${data.area} обл,` : ''} 
            ${data.district ? `${data.district} р-он,` : ''}
            г. ${data.settlement},  
            ул. ${data.street}, 
            д. ${data.house}
            ${data.appartment ? `, кв. ${data.appartment}` : ''}
        `;
    }

    removeUser(user) {
        user.remove();
    }

    /**Окно изменения данных пользователя*/ 
    openModalEdit(data) {
        // надпись - профиль заблокирован
        if(!data.is_active) {
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
    openModalConfirm(action, is_active) {
        this.modalConfirm.classList.add('modal-confirmation_active');
        const text = this.modalConfirm.querySelector('.modal-confirmation__content');
        const button = this.modalConfirm.querySelector('.modal-confirmation__button_agree');

        if(action === 'blocking') {
            text.textContent = is_active ? 'Заблокировать пользователя?' : 'Разблокировать пользователя?';
            button.textContent = is_active ? 'Заблокировать' : 'Разблокировать';

            button.dataset.action = action;
        }

        if(action === 'remove') {
            text.textContent = 'Удалить пользователя?';
            button.textContent = 'Удалить';

            button.dataset.action = action;
        }
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