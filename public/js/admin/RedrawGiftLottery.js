export default class RedrawGiftLottery {
    constructor() {
        this.activeForm = null;
        this.activeTarget = null;
    }

    openForm(target, form) {
        form.classList.add('panel__form-gifts-lottery_active');
        target.dataset.is_active = 1;
        const gift = target.children[1].textContent;
        form.gift_lottery.value = gift;

        // если по клику по другому пользователю уже
        // открыта форма у другого пользователя
        if(this.activeForm && form !== this.activeForm) {
            this.closeForm();
        }

        this.activeForm = form;
        this.activeTarget = target;
    }

    closeForm() {
        this.activeForm.classList.remove('panel__form-gifts-lottery_active');
        this.activeTarget.dataset.is_active = 0;
        this.activeForm.reset();
        this.activeForm = null;
        this.activeTarget = null;
    }

    changeText(text) {
        const elText = this.activeTarget.children[1];
        elText.textContent = text;
    }
} 