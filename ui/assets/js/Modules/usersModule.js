var UsersModule = (function($) {
    var BASE_URL = 'api/';
    
    var endpoints = {
        signup:   BASE_URL + 'signup',
        login:    BASE_URL + 'login',
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
        signup: function(data, callback) {
            var params = {
                url: endpoints.signup,
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
        
        login: function(data, callback) {
            var params = {
                url: endpoints.login,
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
