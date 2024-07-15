export default class ApiAccNewCheque {
    constructor() {

    }

    async create(data) {
        try {
            const resp = await fetch('/upload_cheque_from_account', {
                method: 'POST',
                headers: {
                    "X-CSRF-Token": data.get('_token'),
                },
                body: data,
            });
            const json = await resp.json();
            
            if(!json.result) {
                console.log('Ошибка сервера при загрузке файла');
                return json.result;
            }

            return json.result;
        } catch (e) {
            throw new Error('Ошибка загрузки файлов' + '---' + e);
        }
        
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

    async update() {

    }

    async delete() {

    }
}  