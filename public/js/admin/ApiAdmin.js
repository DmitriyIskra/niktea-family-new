export default class ApiAdmin {
    constructor(loader) {
        this.loader = loader;
        this.token = null;
    }

    create() {

    }

    read() {

    }

    async update(params, data, user_id) {
        // блокировка - разблокировка контакта
        if(params === 'blocking') {
            try {
                this.loader.show();

                const response = await fetch(`/blocking/${user_id}`, {
                    method : "POST",
                    headers : {
                        "X-CSRF-Token" : this.token,
                        "Content-Type" : "application/json"
                    },
                    body : JSON.stringify({
                        action : params,
                    })
                })

                const result = await response.json();
                if(result.response) {
                    this.loader.hide();
                    return result.response;
                } else {
                    this.loader.hide();
                    console.log("Запрос на блокировку пользователя завершился ошибкой");
                    return result.response;
                }
            } catch (error) {
                this.loader.hide();
                console.log("Запрос на блокировку пользователя завершился ошибкой");
            }
        }

        // редактирование контактных данных
        if(params === 'edit_contacts') {
            
            try {
                this.loader.show();

                const response = await fetch(`/edit_contacts/${user_id}`, {
                    method : "POST",
                    headers : {
                        "X-CSRF-Token": this.token,
                    },
                    body : data,
                })

                const result = await response.json();

                if(result.response) {
                    this.loader.hide(result.response);
                    return result.response;
                } else {
                    this.loader.hide();
                    console.log("Запрос на редактирование контактных данных пользователя завершился ошибкой");
                    return result.response;
                }
            } catch (error) {
                this.loader.hide();
                console.log("Запрос на редактирование контактных данных пользователя завершился ошибкой");
            }
        }

        // верификация чека
        if(params === 'verified_cheque') {
            try {
                this.loader.show();

                const response = await fetch(`/verified_cheque/${data}`, {
                    method : "POST",
                    headers : {
                        "X-CSRF-Token" : this.token,
                        "Content-Type" : "application/json"
                    },
                    body : JSON.stringify({
                        action : 'verified_cheque',
                        cheque_id : data,
                    })
                })

                this.loader.hide();
                const result = await response.json();
                return result.response.verified;
            } catch (error) {
                this.loader.hide();
                throw new Error("Запрос на верификацию чека завершился ошибкой")
            }
        }

        // обновление балов
        if(params === 'balls') {
            const response = await fetch(`/balls/${user_id}`, {
                method : "POST",
                headers : {
                    "X-CSRF-Token" : this.token,
                    "Content-Type" : "application/json",
                },
                body : JSON.stringify({
                    action : 'balls',
                    data : data,
                })
            })

            const result = await response.json();
          
            return result;
        }

    }

    /**удаление пользователя или чека*/ 
    async delete(params, user_id, cheque_id) {
        if(params === 'user') {
            try {
                this.loader.show();
                // в данном случае отправляем id пользователя
                const response = await fetch(`/delete/${params}/${user_id}`, {
                    method : "DELETE",
                    headers : {
                        "X-CSRF-Token" : this.token,
                    },
                })
    
                const result = await response.json();
                if(result.response) {
                    this.loader.hide();
                    return result.response;
                } else {
                    this.loader.hide();
                    console.log("Запрос на удаление пользователя завершился ошибкой");
                }
                console.log(result);
            } catch (error) {
                this.loader.hide();
                console.log("Запрос на удаление пользователя завершился ошибкой");
            }
        }


        if(params === 'cheque') {
            try {
                console.log('delete cheque', params, user_id, cheque_id)
                this.loader.show();

                const response = await fetch(`/delete/${params}/${cheque_id}`, {
                    method : "DELETE",
                    headers : {
                        "X-CSRF-Token" : this.token,
                    },
                })

                const result = await response.json();

                this.loader.hide();
                return result.response;

            } catch (error) {
                this.loader.hide();
                throw new Error("Запрос на удаление чека завершился ошибкой", error);
            }
            
        }
    }
}