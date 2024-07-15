export default class RedrawAccNewCheque {
    constructor(cheque, pattern) {
        this.cheque = cheque;
        this.pattern = pattern;
        this.form = this.cheque.querySelector('form'); 
        this.loadButton = this.cheque.querySelector('.up-cheque__upload-cheque input');
        this.previewsModal = this.cheque.querySelector('.up-cheque__back-wr-preview');
        this.previewList = this.cheque.querySelector('.up-cheque__preview-list');

        this.statesAddCheque = {
            activate: 'up-cheque__notice_active', 
            elements: {
                success: this.cheque.querySelector('.up-cheque__notice_success'),
                fail: this.cheque.querySelector('.up-cheque__notice_fail'),
                noValid: this.cheque.querySelector('.up-cheque__notice_no-valid'),
                noLimit: this.cheque.querySelector('.up-cheque__notice_no-limit'),
            }
        }

        this.currentStateAdd = null; // какая инфо строка активна при добавлении чека
        this.lastCloseTimeOutID = null; // timeout для исчезновения инфо строки при загрузке чека

        this.amountPreview = 0; // количество показываемых превью
    }

    resultAddCheque(type) { 
        // если загружен новый файл, а таймаут старого еще не истек
        if(this.lastCloseTimeOutID) {
            this.clearResultAdd();
        };
 
        // активируем инфо строку с необходимым контентом, по результату добавления файла (чека)
        this.currentStateAdd = this.statesAddCheque.elements[type];
        this.currentStateAdd.classList.add(this.statesAddCheque.activate);
        

        this.lastCloseTimeOutID = setTimeout(() => {
            this.clearResultAdd();
        }, 10000)
    }

    // очистка данных по инфо строке при добавлении чека
    clearResultAdd() {
        this.currentStateAdd.classList.remove(this.statesAddCheque.activate);
        this.currentStateAdd = null;

        clearTimeout(this.lastCloseTimeOutID);
        this.lastCloseTimeOutID = null;
    } 

    showPreview() {
        this.previewsModal.classList.add('up-cheque__back-wr-preview_active');
    }

    hidePreview() {
        this.previewsModal.classList.remove('up-cheque__back-wr-preview_active');
        this.clearPreview();
    }

    renderPreview(files) {        
        // формируем превью
        const previews = this.pattern.create(files);
       
        // Активируем блок с превью
        this.showPreview();

        // добавляем превью
        this.previewList.append(...previews);
    }

    clearPreview() {
        // очищаем список превью
        this.previewList.replaceChildren();
        this.amountPreview = 0;
        this.form.reset();
    }
}