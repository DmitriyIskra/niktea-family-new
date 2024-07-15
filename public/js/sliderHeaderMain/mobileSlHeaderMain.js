export default class MobileSlHeaderMain {
    constructor(sl) {
        this.sl = sl;
    }

    initSlider() {
        new Swiper(this.sl, {
            loop: true,
            centeredSlides: true,
        });
    }
}