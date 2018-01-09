$(document).ready(init);

function init() {
    getArticles();
}

function getArticles() {
    var query = getQuery();
    ArticlesModule.getAll(query, function (err, result){
        var error = '';
        if (err) {
            error = 'Sorry, it seems that the server is not responding. Please try again later!';
        } else if (!result.ok) {
            error = result.error;
        } 
                
        if (error !== ''){
           return ArticlesUiModule.displayMessage(error);
        }
        ArticlesUiModule.displayArticles(result.data);  
    })
};
