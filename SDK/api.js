(function(global){
    function Sunny(){
        if(endpoint&&endpoint[endpoint.length-1]=="/")endpoint=endpoint.substr(0, endpoint.length-1);
        this.endpoint = endpoint || "https://yiarashi.com/user7/login/api";
    }
    
    Sunny.prototype._callApi=function(method,callback){
        fetch(this.endpoint+method).then(res=>res.json()).then(callback)
    }

    global.Sunny = Sunny
})(window)
