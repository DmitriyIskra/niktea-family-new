export default class ApiAdmin {
    constructor(loader) {
        this.loader = loader;
        this.token = null;
    }

    create() {

    }

    read() {

    }

    async update(params, id) {
        if(params === 'blocking') {
            try {
                this.loader.show();

                const result = await fetch(`/blocking/${id}`, {
                    method : "POST",
                    headers : {
                        "X-CSRF-Token": this.token,
                        "Content-Type" : "application/json"
                    },
                    body : JSON.stringify({
                        action : 'blocking',
                        id,
                    })
                })

                const json = await result.json();
                if(json) {
                    this.loader.hide();
                    return json.result;
                }
            } catch (error) {
                this.loader.hide();
                console.log("Запрос на блокировку пользователя завершился ошибкой");
            }
        }

            

    }

    delete(params) {
        if(params === 'user') {

        }

        if(params === 'cheque') {

        }
    }
}