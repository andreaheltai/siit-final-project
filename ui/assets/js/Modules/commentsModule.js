var CommentsModule = (function($) {
    var BASE_URL = 'api/';
    
    var endpoints = {
        selectAll:   BASE_URL + 'comments/list',
        create:      BASE_URL + 'comment/add',
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
        selectAll: function(id, callback) {
            var params = {
                url: endpoints.selectAll + '/' + id,
                method: 'GET'
            }
            
            make_call(params, function (error, result) {
                if (error) {
                   return callback({
                        error: error,
                        text: 'Could not fetch comments. '
                    })
               }
               callback(null, result);
            });
        },
        
        create: function(data, callback) {
            var params = {
                url: endpoints.create,
                method: 'POST',
                data: data
            }
            
            make_call(params, function(error, result) {
               if (error) {
                   return callback({
                        error: error,
                        text: 'Could not add new comment. '
                    })
               }
               callback(null, result);
           }); 
        },
    }
})($);
