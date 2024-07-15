export default class ApiСhequesbook {
    constructor(methods) {
        this.methods = methods;

        this.cheques = [
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/alice.png"},
            {ticket_path: "./img/content/priz/fan-priz.png"},
            {ticket_path: "./img/content/priz/alice.png"},
        ];
    }

    create() {

    }

    async read() {
        /**Запрашивает информацию и возвращает массив чеков**/ 
        return this.cheques;
    }

    update() {

    }

    delete() {

    }
}