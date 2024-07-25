export default class RedrawUserBalls {
    constructor() {
        this.activeForm = null;
        this.activeTarget = null;
    }

    openForm(target, form) {
        form.classList.add('panel__form-change-balls_active');
        target.dataset.is_active = 1;
        const balls = target.children[0].textContent;
        form.balls.value = balls;

        // если по клику по другому пользователю уже
        // открыта форма у другого пользователя
        if(this.activeForm && form !== this.activeForm) {
            this.closeForm();
        }

        this.activeForm = form;
        this.activeTarget = target;
    }

    closeForm(callback) {
        this.activeForm.classList.remove('panel__form-change-balls_active');
        this.activeTarget.dataset.is_active = 0;
        this.activeForm.reset();
        this.activeForm = null;
        this.activeTarget = null;
    }

    changeBalls(balls) {
        const elText = this.activeTarget.children[0];
        elText.textContent = balls;
    }
} 