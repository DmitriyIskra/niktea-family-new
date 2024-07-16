export default class ApiСhequesbook {
    constructor() {
    
    }

    create() {

    }

    async read() {
        /**Запрашивает информацию и возвращает массив чеков**/ 
        try {
            const response = await fetch('/get_cheques');

            const json = await response.json();

            if(!json.cheques) {
                console.log(json)

                return;
            } 

            return json.cheques;
            
        } catch (e) {
            throw new Error('Ошибка запрос на получение путей к файлам чеков' + '---' + e);
        }
    }

    update() {

    }

    delete() {

    }
}