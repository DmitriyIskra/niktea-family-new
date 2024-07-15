export default class ApiAccNewCheque {
    constructor() {

    }

    async a() {
        const resp = await fetch('https://jsonplaceholder.typicode.com/todos/1');
        const result = await resp.json();
        console.log('api', result);
        return result;
    } 
} 