$(document).ready(init);

function init() {
    getArticle();
}

function getArticle() {
    var id = getParameterByName('id');
    if (!$.isNumeric(id)) {
        window.location.href = 'home.php';
    } else {
        setCommArtId(id);
        CommentsUiModule.subscribeToAddComment(); }
        
    ArticlesModule.getOne(id, function (err, result){
        var error = '';
            if (err) {
                error = 'Sorry, it seems that the server is not responding. Please try again later!';
            } else if (!result.ok) {
                error = result.error;} 
                
        if (error !== ''){
           return ArticlesUiModule.displayMessage(error);
        }
        ArticlesUiModule.displayArticle(result.data);  
    })
};


function getComments() {
    var id = getParameterByName('id');
    CommentsModule.selectAll(id, function (err, result){
        var error = '';
        if (err) {
            error = 'Sorry, it seems that the server is not responding. Please try again later!';
        } else if (!result.ok) {
            error = result.error;
        } 
                
        if (error !== ''){
           return CommentsUiModule.displayMessage(error);
        }
        CommentsUiModule.displayComments(result.data);  
    })
}

function setCommArtId(id) {
    $('#commArtId').val(id);
}

function setArtIdOnBtn (button, id) {
    button.val(id);
}