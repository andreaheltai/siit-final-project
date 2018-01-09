var CommentsUiModule = (function($){
    var getCommentHtml = function(comments) {
        var html = '';
        $.each(comments, function(index, comment){
            var username;
            if (comment.user_name == '') {
                username = 'User'
            } else {
                username = comment.user_name;
            }
            var date = new Date(comment.creation_date + ' UTC');
            var newDate = date.toLocaleString();
            html += '<div class="col-sm-8">' +
                        '<div class="panel panel-white post panel-shadow">' +
                            '<div class="post-heading">' +
                                '<div class="pull-left image">' +
                                    '<img src="ui/assets/img/user.png" class="img-circle avatar" alt="user profile image">' +
                                '</div>' +
                                '<div class="pull-left meta">' +
                                    '<div class="title h6">' +
                                        username + ' added a comment.' +
                                    '</div>'+
                                    '<h6 class="text-muted time">' + comment.title + '</h6>' +
                                '</div>'+
                            '</div>' +
                            '<div class="post-description">' +
                                '<p>' + comment.content + '<p>' +
                                '<p>' + newDate + '<p>' +
                            '</div>'+
                        '</div>'+
                    '</div>'
     
        });
        return html;
    };
    
    function addComments() {
        var data = $("#addComm").serialize();
        CommentsModule.create(data, function (err, result){
            var error = '';
            if (err) {
                error = 'Sorry, it seems that the server is not responding. Please try again later!';
            } else if (!result.ok) {
                error = result.error;
            } 
                    
            if (error !== ''){
               return CommentsUiModule.displayMessage(error);
            }
            clearComment();
            getComments();
            CommentsUiModule.displayMessage(result.data);  
        })
    }
    
    function clearComment() {
        $('#rad1').val('');
        $('#rad2').val('');
    }
    
    function subscribeToAddComment() {
        $('#addComm-btn').click(function( event ) {
          event.preventDefault();
          var err = 0;
          //Check if fields are empty or have scripts
          $.each($(".checkComm"), function () {
              var text = $(this).val();
              console.log('text');
                if (text === '') {
                    err = 1;
                    return CommentsUiModule.displayMessage('Please fill out fields before submitting.');
                } else if ((text.toLowerCase().indexOf("<script>") >= 0) || (text.toLowerCase().indexOf("</script>") >= 0)) {
                    err = 1;
                    return CommentsUiModule.displayMessage('Message cannot contain scripts.');
                }
                return;
            })
            if (err === 0) {  
                CommentsUiModule.addComments();
                
            }
        })
    }

    
    function displayComments (comments) {
        $('#commSection').html(getCommentHtml(comments)); 
    };
    
    function displayMessage (txt) {
        $('#commErr').html(txt);
    }
    
    
    return {
        displayComments: displayComments,
        
        displayMessage: displayMessage,
        
        addComments: addComments,
        
        subscribeToAddComment: subscribeToAddComment
    }
})($);