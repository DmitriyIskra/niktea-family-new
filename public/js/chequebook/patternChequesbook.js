export default class PatternChequesbook {
    constructor() {

    }

    /**создает элемент с картинкой чека**/ 
    createCheque(paths) {
        const elements = paths.map(item => {
            const li = this.element('li', ['chequebook__cheque-item']);
    
            const img = this.element('img', ['chequebook__cheque-img'], item);
    
            li.append(img);
    
            return li;
        })

        return elements;
    }

    /**создает элемент пагинации**/ 
    createPagination(length) {
        let elements = [];

        for(let i = 0; i < length; i += 1) {
            const div = this.element('div', ['chequebook__pagination-item'], null, i);
            if(i === 0) div.classList.add('chequebook__pagination-item_active');
            elements.push(div);
        }

        return elements;
    }

    element(tag, classes = [], path = null, index = null) {
        const el = document.createElement(tag);

        if(classes.length) el.classList.add(...classes);
        
        if(path) el.src = path.ticket_path;

        if(index != null) {
            el.textContent = index + 1;
            el.dataset.item = index;
        }

        return el;
    }
}