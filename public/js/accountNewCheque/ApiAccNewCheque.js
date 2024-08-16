export default class ApiAccNewCheque {
    constructor() {

    }

    async create(data) {
        console.log(Array.from(data))
        try {
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
            // const resp = await fetch('/upload_cheque_from_account', {
            //     method: 'POST',
            //     headers: {
            //         "X-CSRF-Token": data.get('_token'),
            //     },
            //     body: data,
            // });
            // const json = await resp.json();
            // console.log(json)
            // if(!json.result) {
            //     console.log('Ошибка сервера при загрузке файла');
            //     return json.result;
            // }

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