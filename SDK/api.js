class Sunny {
    
    _callApi(method,callback){
        fetch(this.endpoint+method).then(callback)
    }
    constructor(endpoint){
        this.endpoint = endpoint;
        
        
    }
}
