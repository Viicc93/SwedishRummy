    /*
     * ajax method is the main method that hold jQuery
     * ajax method. this method give us the opportunity
     * to use HTTP methods for RESTfull services like
     * POST, GET, PUT, PATCH and DELETE
     */
    function ajax(url, type, dataType, data, callBack) {
        // define the default HTTP method
        type = type || 'GET';
        // assign jQuery ajax method to res variable
        var res = $.ajax({
            url: url,
            type: type,
            dataType: dataType || 'JSON',
            data: data
        });
        // if the request success will call the callback function
        res.success(function(data) {
            callBack(data);
        });
        // if failed dispaly the error details
        res.fail(function(err) {
            console.error('response err', err.status);
        });
    };