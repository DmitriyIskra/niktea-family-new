import ModalInfoExchange from "../modalInfoExchange/ModalInfoExchange.js";

export default class ControllAccNewCheque extends ModalInfoExchange {
    constructor(api, d, update, state) {
        super(state);
        this.api = api;
        this.d = d;
        this.update = update;

        this.dropZone = document.body;

        this.files = []; // Массив загруженных файлов

        this.click = this.click.bind(this);
        this.change = this.change.bind(this);
        this.drop = this.drop.bind(this);
    }

    init() { 
        // (async () => {
        //     const e = await this.api.a();
        //     console.log('from control', e)
        // })();

        this.registerEvents();
    }

    registerEvents() { 
        this.d.cheque.addEventListener('click', this.click);
        this.d.loadButton.addEventListener('change', this.change);

        this.dropZone.addEventListener('dragenter', e => e.preventDefault());
        this.dropZone.addEventListener('dragover', e => e.preventDefault());
        this.dropZone.addEventListener('dragleave', e => e.preventDefault());
        this.dropZone.addEventListener('drop', this.drop);
    }
    
    /**
     * при загрузке страницы инициализируем слайдер
     * информация о пользователе заполняется при загрузке страницы из файла form.js
     * поэтому нет необходимости делать это в данной функции
     * в данной функции мы получаем данные и работаем только со слайдером чеков (картинок)
     * указываем что функция асинхронна для того чтоб раньше времени не вызвать методы
     * инициализации и отрисовки чеков
     * **/ 
    async startSliderCheque() {
        // запрос за фото чеков
        // const response = await this.api.read();
        // this.accountInfo = await response.json();
        
        // --- START ДЛЯ ОТЛАДКИ ---
        
        // !!!!!!!! НУЖНО ФОРМИРОВАТЬ МАССИВ ТАКОГО ТИПА
        let arr = [
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
        ];

        // --- END ДЛЯ ОТЛАДКИ ---
    }

    click(e) {
        if(e.target.closest('.exchange__extraction-button-back')) {
            const el = e.target.closest('.exchange__extraction-button-back');
            this.d.clickExchange(el);
        } 
        
        if(e.target.closest('.up-cheque__preview-close')) {
            this.d.hidePreview();
            this.d.clearResultAdd();
            this.files = [];
        }

        if(e.target.closest('.up-cheque__button-back_submit')) {
            const formData = this.submit();
            // очищаем данные и отображения после отправки на сервер
            this.files = [];
            this.d.hidePreview();

            // Обновляем книгу с фото чеков
            this.update(formData);
        } 
    }

    submit() {
        // если ни одного файла не выбрано
        if(!this.files.length) {
            this.d.resultAddCheque('fail');
            return;
        }
        /**
          * FormData для сбора прочитанных файлов,
          * для последующей отправки на сервер
          * и в альбом с чеками
        **/ 
        const formData = new FormData();
        this.files.forEach(item => {
            formData.append(`file`, item);       
        });

        // TO DO: this place for send file 
        // super.openModalSuccess();

        return formData;
    }

    change(e) { // РЕАЛИЗОВАТЬ drag and drop и показ превью
        const files = e.target.files;      

        if(!files.length) {
            // если файл не загружен, показываем предупреждение
            this.d.resultAddCheque('fail');
            return;
        }

        this.saveFiles(files);
    }
    
    drop(e) {
        e.preventDefault();
        const files = e.dataTransfer.files;
        
        this.saveFiles(files);
    }
    
    saveFiles(files) {
        
        const val = this.validation(files);

        // не больше 30 файлов за одно добавление
        if(!val.isLength) {
            this.d.resultAddCheque('noLimit');
            this.d.form.reset();
    
            return;
        }
    
        // соответствует заданному типу и размеру
        if(!val.isValid) {
            this.d.resultAddCheque('noValid');
            this.d.form.reset();
            return;
        }
    
        // показываем пользователю что все успешно загружено
        this.d.resultAddCheque('success');
    
        // отрисовка превью
        this.d.renderPreview(files);
    
        // сохраняем загруженные файлы в массив для дальнейшей отправки
        this.files = this.files.length === 0 ? [...files] : [this.files, ...files];
    }

    validation(files) {
        // Можно выбрать не более 30 файлов
        const isLength = files.length <= 6;

        // все файлы должны быть валидны 
        const isValid = [...files].every(item => {
            const fileType = item.type;
            const fileSize = item.size;
    
            return /^image\/.+$/.test(fileType) && fileSize <= 10485760;
        })

        return {
            isLength,
            isValid,
        };
    }
}