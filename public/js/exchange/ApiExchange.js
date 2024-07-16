export default class ApiExchange {
    constructor() {

    }

    async create(data, csrf) {
        console.log(data)
        const response = await fetch('/send_email_exchange', {
            method: 'POST',
            headers: {
                "X-CSRF-Token": csrf,
                "Content-Type" : "application/json"
            },
            body: JSON.stringify(data),
        })
    }
}