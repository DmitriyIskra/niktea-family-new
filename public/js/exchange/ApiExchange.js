export default class ApiExchange {
    constructor() {

    }

    async create(data, csrf) {
        try {
            const response = await fetch('/send_email_exchange', {
                method: 'POST',
                headers: {
                    "X-CSRF-Token": csrf,
                    "Content-Type" : "application/json"
                },
                body: JSON.stringify(data),
            })

            const json = await response.json();
            
            if(!json.result) return false;

            return true;
        } catch (error) {
            console.log("Ошибка отправки email на обмен баллов")
            return false;
        }
        
    }
}