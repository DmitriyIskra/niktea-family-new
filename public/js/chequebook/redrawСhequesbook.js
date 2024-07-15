export default class RedrawСhequesbook {
    constructor(book, pattern) {
        this.book = book;
        this.pattern = pattern;

        this.chequeList = this.book.querySelector('.chequebook__cheque-list');
        this.pagination = this.book.querySelector('.chequebook__pagination');
        this.paginationList = this.book.querySelector('.chequebook__pagination-list');
        this.arrowPrev = this.book.querySelector('.chequebook__arrow-prev');
        this.arrowNext = this.book.querySelector('.chequebook__arrow-next');

        this.zoom = this.book.querySelector('.chequebook__wr-zoom');
        this.wrImgZoom = this.book.querySelector('.chequebook__wr-image-zoom')
        this.imgZoom = this.book.querySelector('.chequebook__img-zoom')

        this.cheques = [];

        this.update = this.update.bind(this);

        this.activePag = null;
        this.textPag = 1;
        this.indexPag = 0;
        this.leftPag = null;
        this.rightPag = null;
    }

    init(arr) {
        let counter = 1;
        let lastArr;
        
        // создаем структуру массива массивов
        // напр. [ [..., ..., и т.д], [..., ..., и т.д],  и т.д] со ссылками
        // на изображения чеков 
        arr.forEach(item => {
            if(counter === 1) {
                this.cheques.push([])
                lastArr =  this.cheques.length - 1;
            };

            this.cheques[lastArr].push(item);

            counter += 1;
            
            if(counter > 6) counter = 1;
        });

        this.renderCheque(0);

        // количество дочерних масивов 
        // (один массив - одна страница книги) - одна единица пагинации
        const length = this.cheques.length;

        this.renderPagination(length);


        if(length <= 3) {
            this.arrowPrev.style.visibility = 'hidden';
            this.arrowNext.style.visibility = 'hidden';
        } else {
            this.arrowPrev.style.visibility = 'hidden';
        }
    }

    /** Отрисовка чеков по индексу активной пагинации **/
    renderCheque(index) {
        // перерисовка происходит полностью, для этого очищаем
        if(this.chequeList.children) this.chequeList.innerHTML = '';
        
        // выделяем нужный массив
        const arr = this.cheques[index];

        // заполняем чеки (изображения) 
        const elements = this.pattern.createCheque(arr);

        this.chequeList.append(...elements);
    }

    renderPagination(length) {
        if(this.paginationList.children) this.paginationList.innerHTML = '';

        // заполняем пагинацию
        
        const elements = this.pattern.createPagination(length);
        
        this.paginationList.append(...elements);

        this.activePag = this.paginationList.children[0];
        this.leftPag = this.activePag;
        this.rightPag = this.paginationList.children[2];
    }

    /** 
     * используется только при добавлении чеков
     * (без обращения на сервер)
     * **/
    update(data) {
        console.log(data);
        const arr  = Array.from(data);
        console.log(arr)
    }

    next() {
        // долистав до конца скрываем стрелку вправо
        if(this.paginationList.children.length - 1 === this.textPag) {
            this.arrowNext.style.visibility = 'hidden';
        }

        const width = this.activePag.offsetWidth;
        const nextPag = this.activePag.nextElementSibling;

        // контент в левой и правой видимой пагинации
        const leftContent = +this.leftPag.textContent;
        const rightContent = +this.rightPag.textContent;

        this.arrowPrev.style.visibility = 'visible';

        if(this.textPag < rightContent && this.textPag >= leftContent) {
            this.changeActivePag(nextPag);
            return;
        }

        this.paginationList.style.transform = `translateX(-${width * (this.textPag - 2)}px)`;

        this.leftPag = this.leftPag.nextElementSibling;
        this.rightPag = this.rightPag.nextElementSibling;

        this.changeActivePag(nextPag);
    }

    prev() {
        // долистав до конца скрываем стрелку влево
        if(this.textPag === 2) {
            this.arrowPrev.style.visibility = 'hidden';
        }

        if(this.arrowNext.style.visibility === 'hidden') {
            this.arrowNext.style.visibility = 'visible';
        }

        const prevPag = this.activePag.previousElementSibling;
        const width = prevPag.offsetWidth;
        // контент в левой и правой видимой пагинации
        const leftContent = +this.leftPag.textContent;
        const rightContent = +this.rightPag.textContent;

        // переключение активного пункта пагинации если пагинации, если пункт
        // в направлении переключения не крайний
        if(this.textPag <= rightContent && this.textPag > leftContent) {
            this.changeActivePag(prevPag);
            return;
        }

        // если не находимся в промежутке между крайними правым и левым значениями
        this.paginationList.style.transform = `translateX(-${width * (this.textPag - 2)}px)`;

        this.leftPag = this.leftPag.previousElementSibling;
        this.rightPag = this.rightPag.previousElementSibling;

        this.changeActivePag(prevPag);
    }

    /**при выборе конкретного значения в пагинации**/ 
    num(pag) {
        this.changeActivePag(pag);
    }

    changeActivePag(pag) {
        this.activePag.classList.remove('chequebook__pagination-item_active');
        this.activePag = pag;
        this.activePag.classList.add('chequebook__pagination-item_active');
        
        this.indexPag = this.activePag.dataset.item;
        this.textPag = +this.activePag.textContent;

        this.renderCheque(this.indexPag);
    }

    openZoom(el) {
        const src = el.src;
        const top = el.getBoundingClientRect().top + 'px';
        const left = el.getBoundingClientRect().left + 'px';
        const height = el.offsetHeight;
        const width = el.offsetWidth;

        this.zoom.classList.add('chequebook__wr-zoom_active');

        this.wrImgZoom.style.top = top;
        this.wrImgZoom.style.left = left;
        this.wrImgZoom.style.height = height + 'px';
        this.wrImgZoom.style.width = width + 'px';
        this.imgZoom.src = src;

        setTimeout(() => {
            this.wrImgZoom.classList.add('chequebook__wr-image-zoom_animate');
        })
    }

    closeZoom() {
        this.zoom.classList.remove('chequebook__wr-zoom_active');

        this.wrImgZoom.style.top = '';
        this.wrImgZoom.style.left = '';
        this.wrImgZoom.style.height = '';
        this.wrImgZoom.style.width = '';
        this.imgZoom.src = '#';
        this.wrImgZoom.classList.remove('chequebook__wr-image-zoom_animate');
    }
}