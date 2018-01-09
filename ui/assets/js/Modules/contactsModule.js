var ContactsModule = (function($) {
    var BASE_URL = 'api/';
    
    var endpoints = {
        create:   BASE_URL + 'contact',
    }
    
    var make_call = function(params, callback) {
        $.ajax({
            url: params.url,
            method: params.method,
            data: params.data || null,
            success: function (result) {
                callback(null, result);
            },
            error: function (XHR, status, error) {
                callback(error);
            },
            complete: function (XHR, status) {
               
            },
        }) 
    }
    
    return {
        create: function(data, callback) {
            var params = {
                url: endpoints.create,
                method: 'POST',
                data: data
            }
            
            make_call(params, function(error, result) {
               if (error) {
                   return callback(error);
               }
               callback(null, result);
           }); 
        },
    }
})($);
