import ModalInfo from "../InfoModals/ModalInfo.js";

export default class ControllAccNewCheque extends ModalInfo {
    constructor(api, d, loader, update, state) {
        super(state);
        this.api = api;
        this.d = d;
        this.loader = loader;
        this.update = update;

        this.dropZone = document.body; 

        this.files = []; // Массив загруженных файлов
 
        this.click = this.click.bind(this);
        this.change = this.change.bind(this);
        this.drop = this.drop.bind(this);
    }

    init() { 
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
        } 
    }

    async submit() {
        // если ни одного файла не выбрано
        if(!this.files.length) {
            this.d.resultAddCheque('fail');
            return;
        }

        const formData = new FormData(this.d.form);

        this.loader.show();

        // Отправляем файлы на сервер
        const result = await this.api.create(formData);
        this.loader.hide();
        if(result) super.openModalСhequeSuccess();
        if(!result) super.openModalFailSend();

        const response = await fetch('https://s3.alephtrade.com/upload/niktea/sefsefsef.jpg/0', {
                method : "POST",
                headers : {
                    "content-Type" : "multipart/form-data",
                    "auth" : "6dbccf8ef722f87e9fd20129b958d5f3b07fbab9ebe39252b666e55e15afa6db31cf2cbca5d67d942180982314386b5f46080c1a64a3c3f552086f30feb1fbdc"
                },
                body : data
            })

            const json = await response.json();
            console.log(json)

        // const cheques = await this.api.read();
        
        // Обновляем альбом с чеками
        if(cheques) this.update(cheques);
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