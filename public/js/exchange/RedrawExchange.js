import ModalInfoExchange from "../InfoModals/ModalInfoExchange.js";

export default class RedrawExchange extends ModalInfoExchange {
    constructor(el, userData, state) {
        super(state);
        this.el = el;
        this.userData = userData;
        this.address = null;

        this.wrapperModal = this.el.querySelector('.exchange__modal-wrapper');

        // модальное окно подтвердить и поле для адреса
        this.modalConfirm = this.el.querySelector('.exchange__modal-confirm');
        this.addressConfirm = this.el.querySelector('.exchange__modal-confirm-address'); 

        // модальное окно изменить адрес
        this.modalChange = this.el.querySelector('.exchange__modal-change');
        this.modalChangeForm = this.modalChange.querySelector('form');

        // инфа выбранного подарка
        this.bonusData = {
            index : null,
            points : null,
            name : null,
        };
        this.activeModal = null;
    }
 
    init() {
        this.parseAmountPoints();

        this.address = {
            index : this.userData.querySelector('.user-data__data_index').textContent,
            area : this.userData.querySelector('.user-data__data_area').textContent,
            district : this.userData.querySelector('.user-data__data_district').textContent,
            city : this.userData.querySelector('.user-data__data_city').textContent,
            street : this.userData.querySelector('.user-data__data_street').textContent,
            house : this.userData.querySelector('.user-data__data_house').textContent,
            apartment : this.userData.querySelector('.user-data__data_apartment').textContent,
        }
    }
    
    /**
     * активируем обертку модалок, оно же покрытие на страницу**/ 
    showCoverModal() {
        this.wrapperModal.classList.add('exchange__modal-wrapper_active');
    }

    hideCoverModal() {
        this.wrapperModal.classList.remove('exchange__modal-wrapper_active');
        this.bonusData = null;
    }

    /**
     * активируем модалку подтверждения**/ 
    showConfirmModal() {
        // если другое окно открыто (смена адреса), оно закроется
        this.hideModal();

        this.activeModal = this.modalConfirm;
        this.activeModal.classList.add('exchange__modal_active');

        // собираем строку с адресом
        this.addressConfirm.textContent = this.buildStringAddress();

        /**адрес указанный при регистрации, при первом открытии модалки подтверждения адреса, 
         * будет сохранен в this.address если пользователь изменит адрес, то пока страница 
         * не перезагружалась, там будет закеширован новый адрес, если страницу перезагрузить при первом 
         * открытии модалки подтверждения адреса снова загрузится адрес указанный при регистрации.
         * 
         * При выходе из аккаунта sessionStorage очищается**/ 
    }
 
    showChangeModal() {
        // если другое окно открыто (смена адреса), оно закроется
        this.hideModal();

        this.activeModal = this.modalChange;
        this.activeModal.classList.add('exchange__modal_active');

        this.modalChangeForm.index.value = this.address.index;
        this.modalChangeForm.area.value = this.address.area;
        this.modalChangeForm.district.value = this.address.district;
        this.modalChangeForm.city.value = this.address.city;
        this.modalChangeForm.street.value = this.address.street;
        this.modalChangeForm.house.value = this.address.house;
        this.modalChangeForm.apartment.value = this.address.apartment;
    }

    // сохранение нового адреса доставки 
    saveNewAddress() {
        this.address.index = this.modalChangeForm.index.value;
        this.address.area = this.modalChangeForm.area.value;
        this.address.district = this.modalChangeForm.district.value;
        this.address.city = this.modalChangeForm.city.value;
        this.address.street = this.modalChangeForm.street.value;
        this.address.house = this.modalChangeForm.house.value;
        this.address.apartment = this.modalChangeForm.apartment.value;
    }

    hideModal() {
        if(this.activeModal) {
            this.activeModal.classList.remove('exchange__modal_active');
            this.activeModal = null;
        };
    }

    /**
     * Проверка хвататет ли баллов**/ 
    checkPoints(el) {
        // получаем информацию выбранного подарка
        this.bonusData.index = +el.dataset.index;
        this.bonusData.points = +el.dataset.points;
        this.bonusData.name = el.dataset.name;

        // количество баллов у пользователя
        const elBalance = document.querySelector('.user__balance');
        const available = +elBalance.textContent; 

        return available > this.bonusData.points ? true : false;
    }

    parseAmountPoints() {
        // прописываем кнопкам обменять сколько баллов по данному бонусу
        // находим строки li с бонусами и индекс подарка
        const collItemsPoints  = this.el.querySelectorAll('.exchange__extraction-item');
        
        [...collItemsPoints].forEach((item, index) => {
            // парсим цифру по бонусам
            const elWidthPoint = item.querySelector('.exchange__extraction-text span');
            const point = parseFloat(elWidthPoint.textContent);
            // парсим название подарка 
            const nameBonus = item.querySelector('.exchange__name').textContent;
            // добавляем количество бонусов к кнопке
            const button = item.querySelector('.exchange__extraction-button-back');
            button.dataset.points = point;
            button.dataset.index = index;
            button.dataset.name = nameBonus;
        })
    }

    // Собираем адрес в одну строку
    buildStringAddress() {
        return (`${this.address.index}, ${this.address.area} обл, ${this.address.district} р-он,
         ${this.address.city}, ул.${this.address.street}, д. ${this.address.house}, кв. ${this.address.apartment}`
        );
    }
}