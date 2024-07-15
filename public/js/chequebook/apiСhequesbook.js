export default class ApiСhequesbook {
    constructor(methods) {
        this.methods = methods;

        // this.cheques = [
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"}, 
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        //     {ticket_path: "./img/content/priz/fan-priz.png"},
        //     {ticket_path: "./img/content/priz/alice.png"},
        // ];
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