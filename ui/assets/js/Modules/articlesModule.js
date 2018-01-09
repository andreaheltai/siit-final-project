var ArticlesModule = (function($) {
    var BASE_URL = 'api/';
    
    var endpoints = {
        getAll:    BASE_URL + 'articles',
        countAll:  BASE_URL + 'articles/pages',
        getOne:    BASE_URL + 'article/details',
        create:    BASE_URL + 'article/add',
        deleteOne: BASE_URL + 'article/delete',
        update:    BASE_URL + 'article/edit'
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
        getAll: function(query, callback) {
            var params = {
                url: endpoints.getAll + query,
                method: 'GET'
            }
           make_call(params, function(error, result) {
               if (error) {
                    return callback(error);
               }
   
               callback(null, result);
           }); 
        },
        
        countAll: function(query, callback) {
            var params = {
                url: endpoints.countAll + query,
                method: 'GET'
            }
           make_call(params, function(error, result) {
               if (error) {
                    return callback(error);
               }
   
               callback(null, result);
           }); 
        },
        
        getOne: function(id, callback) {
            var params = {
                url: endpoints.getOne + '/' + id,
                method: 'GET'
            }
            
            make_call(params, function (error, result) {
                if (error) {
                   return callback(error);
               }
               callback(null, result);
            });
        },
        
        create: function(data, callback) {
            var params = {
                url: endpoints.create,
                method: 'POST',
                data: data
                // Tried for Images:
                // data: new FormData(data), 
                // contentType: false,       
                // cache: false,             
                // processData: false
            }
            
            make_call(params, function(error, result) {
               if (error) {
                   return callback(error);
               }
               callback(null, result);
           }); 
        },
        
        deleteOne: function(id, callback) {
            var params = {
                url: endpoints.deleteOne,
                method: 'POST',
                data: {
                    id: id,
                }
            }
            
            make_call(params, function(error, result) {
               if (error) {
                   return callback(error);
               }
               callback(null, result);
           }); 
            
        },
        
        update: function(data, callback) {
            var params = {
                url: endpoints.update,
                method: 'POST',
                data: data
            }
            
            make_call(params, function(error, result) {
               if (error) {
                   return callback(error);
               }
               callback(null, result);
            }); 
        }
    }
})($);
