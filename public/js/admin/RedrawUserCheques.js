export default class RedrawUserCheques {
    constructor() {
        
    }

    changeVerified(el, result) {
        el.dataset.verified = result;

        el.classList.toggle('panel__circle-verified_green');
    }

    delete(cheque) {
        cheque.remove();
    }
}  