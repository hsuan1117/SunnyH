class Sunny {
    
    _callApi(method,callback){
        fetch(this.endpoint+method).then(res=>res.json()).then(callback)
    }
    constructor(endpoint){
        this.endpoint = endpoint || "https://yiarashi.com/user7/";
        
        
    }
}
