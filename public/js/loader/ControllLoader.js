export default class ControllLoader {
    constructor(loader) {
        this.loader = loader;
    }
    
    /**показать лоадер*/ 
    show() {
        this.loader.classList.add('loader__cover_active');
    }
    /**скрыть лоадер */ 
    hide() {
        this.loader.classList.remove('loader__cover_active');
    }
} 