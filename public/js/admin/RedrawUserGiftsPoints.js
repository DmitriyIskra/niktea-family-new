export default class RedrawUserGiftsPoints {
    constructor() {
        this.activeForm = null;
        this.activeTarget = null;
        this.activeList = null;
    }

    openForm(target, form) {
        form.classList.add('panel__form-gift-points_active');
        target.dataset.is_active = 1;

        // если по клику по другому пользователю уже
        // открыта форма у другого пользователя
        if(this.activeForm && form !== this.activeForm) {
            this.closeForm();
        }

        this.activeForm = form;
        this.activeTarget = target;
        this.activeList = this.activeTarget.querySelector('ul');
    }

    closeForm() {
        this.activeForm.classList.remove('panel__form-gift-points_active');
        this.activeTarget.dataset.is_active = 0;
        this.activeForm.reset();
        this.activeForm = null;
        this.activeTarget = null;
        this.activeList = null;
    }

    changeVerifie(gift, target) {
        if(gift.verified) {
            target.classList.add('panel__circle-verified_green');
            return;
        }

        target.classList.remove('panel__circle-verified_green');
    }

    addGift(gift) {
        const newGift = this.createGift(gift);

        this.activeList.prepend(newGift);
    }

    createGift(gift) {
        const li = this.createElement('li', ['panel__user-gifts-points-item'], null);
        
        const verified = this.createElement('div', ['panel__circle-verified', 'panel__circle-verified_gift-p'], null);
        verified.dataset.gift_id = gift.id;

        const text = this.createElement('div', ['panel__user-gifts-points-name'], gift.name);

        li.append(verified);
        li.append(text);

        return li;
    }

    createElement(tag, classes, content) {
        const el = document.createElement(tag);
        el.classList.add(...classes);
        if(content) el.textContent = content;

        return el;
    }
} 