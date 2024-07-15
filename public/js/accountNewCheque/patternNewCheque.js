export default class PatternNewCheque {
    // СОЗДАЕТ ЭЛЕМЕНТЫ ПРЕВЬЮ
    /**
     * Получаем массив
     * files - номер превью и файл
     * **/ 
    create(files) {
        const elements = [...files].map(item => {

            const li = this.createElement('li', ['up-cheque__preview-item']);

            const wrImage = this.createElement('div', ['up-cheque__preview-item-wr-img']);
            const image = this.createElement('img');

            const number = this.createElement('p', null, item.name);

            const reader = new FileReader(); 

            reader.addEventListener('load', (e) => {
                image.src = e.target.result;
            }, {once : true});

            reader.readAsDataURL(item);

            wrImage.append(image);
            li.append(wrImage, number);

            return li;
        });

        return elements;
    }

    createElement(tag, classes = [], content) {
        const el = document.createElement(tag);

        if(classes) {
            el.classList.add(...classes);
        }

        if(content) {
            el.textContent = content;
        }

        return el;
    }
}