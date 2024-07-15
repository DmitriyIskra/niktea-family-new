export default class ControllSlHeaderMain {
    constructor(d) {
        this.d = d;

        this.click = this.click.bind(this);
    }

    init() {
        this.registerEvents();
        this.d.initSlider();
    }

    registerEvents() {
        this.d.el.addEventListener('click', this.click);
    }

    click(e) {
        if(e.target.closest('.slider-hm__controll-next')) {
            this.d.mooveNext();
        }

        if(e.target.closest('.slider-hm__controll-prev')) {
           this.d.moovePrev();
        }
    }
}