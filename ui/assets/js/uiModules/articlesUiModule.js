var ArticlesUiModule = (function($){
    var getArticlesHtml = function(articles) {
        var html = '';
        $.each(articles, function(index, article){
            var shortDesc = (article.content).substring(0,150) + '...';
            var date = new Date(article.creation_date + ' UTC');
            var newDate = date.toLocaleString();
            console.log('Local date is:' + newDate);
            html += '<div class="post-preview">' +
                        '<a href="article.php?id=' + article.id + '">' +
                            '<h2 class="post-title">' +
                                article.title + 
                            '</h2>' +
                            '<h3 class="post-subtitle">' + 
                                shortDesc + 
                            '</h3>' +
                        '</a>' +
                        '<p class="post-meta">Posted by ' + article.user_name + ' on ' + newDate + '</p>' +
                   '</div>' +
                   '<hr>'    
        });
        return html;
    };
    
    var getArticleHtml = function(article) {
        console.log(article.creation_date);
        var date = new Date(article.creation_date + ' UTC');
        var newDate = date.toLocaleString();
        var html = '';
        html += '<div class="post-heading">' +
                        '<h1 id="artTitle">' + article.title + '</h1>' +
                        '<span class="meta" class="checkArtUpd">Posted by ' + article.user_name + ' on ' + newDate + '</span>'+
                '</div>' +
                '<p><pre id="artContent">' + article.content + '</pre></p>'+
                '<input type="hidden" class="form-control checkArtUpd" name="published" id="artPublished" value=' + article.published + '>';
        return html;
    };
    
    var getAdminBtnsHtml = function() {
        var html = '<div class="row">' +
                        '<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">' +
                            '<button class="btn btn-default btn-admin float-left" id="delete-btn">Delete</button>' +
                            '<button class="btn btn-default btn-admin float-left" id="edit-btn">Edit</button>' +
                            '<button class="btn btn-default btn-admin float-left" id="upd-btn" style="display: none">Update</button>' +
                            '<button class="btn btn-default btn-admin float-left" id="cancel-btn" style="display:none">Cancel</button>' +
                        '</div>' +
                    '</div>';
        return html;
    }
    
    function displayArticles (articles) {
        $('#message').html(getArticlesHtml(articles)); 
        displayPages();
    };
    
    function displayArticle (article) {
        $('#displayArt').html(getArticleHtml(article)); 
        $('#admin-btns').html(getAdminBtnsHtml());
        
        var id = $('#commArtId').val();
        var deleteBtn = $('#delete-btn');
        var editBtn = $('#edit-btn');
        var updBtn = $('#upd-btn');
        var cancelBtn = $('#cancel-btn');
        
        setArtIdOnBtn(deleteBtn, id);
        setArtIdOnBtn(editBtn, id);
        setArtIdOnBtn(updBtn, id);
        setArtIdOnBtn(cancelBtn, id);
        
        subscribeToEdit(editBtn, updBtn, cancelBtn);
        subscribeToUpdate(editBtn, updBtn, cancelBtn);
        subscribeToCancel(editBtn, updBtn, cancelBtn);
        subscribeToDelete();
        
        getComments();
        $('.comm').show();
    };
    
    function deleteArticle(delBtn) {
        bootbox.confirm("Are you sure you want to delete this article?", function(result){
            if (result) {
                var artId = delBtn.val();
                ArticlesModule.deleteOne(artId, function (err, result){
                    var error = '';
                        if (err) {
                            error = 'Sorry, it seems that the server is not responding. Please try again later!';
                        } else if (!result.ok) {
                            error = result.error;
                        } 
                            
                    if (error !== ''){
                      return displayMessage(error);
                    }
                    bootbox.alert("Article has been deleted", function(){ window.location.href = 'home.php';});
                })
            }
        })
    }
    
    function updateArticle(editBtn, updBtn, cancelBtn){
        var title = $('#newTitle').val();
        var content = $('#newContent').val();
        var id = $('#upd-btn').val();
        var published = $('#artPublished').val();
        var data = {title: title,
                    content: content,
                    id: id,
                    published: published
                    }
        ArticlesModule.update(data, function (err, result){
            var error = '';
                if (err) {
                    error = 'Sorry, it seems that the server is not responding. Please try again later!';
                } else if (!result.ok) {
                    error = result.error;
                } 
                    
            if (error !== ''){
              return displayMessage(error);
            }
            if (result.data === 1) {
                message = 'Article successfully updated';
            } else {
                message = 'No changes were submitted.';
            }
            getArticle();
            return displayMessage(message);
        })
    }
    
    function subscribeToEdit(editBtn, updBtn, cancelBtn) {
        var ArtId = editBtn.val();
        editBtn.click( function( event ) {
          event.preventDefault();
          clearMessage();
          editBtn.hide();
          updBtn.show();
          cancelBtn.show();
          changeFieldsToEdit();
          })
    }
    
    function subscribeToUpdate (editBtn, updBtn, cancelBtn) {
        updBtn.click( function( event ) {
          event.preventDefault();
          var err = 0;
          //Check if fields are empty or have scripts
          ($("#newTitle"), function () {
              var text = $(this).val().toLowerCase();
              var regEx = /<\s*script\s*>$/;
              console.log('Verify value:' + regEx.test(text));
                if (text === '') {
                    err = 1;
                    return ArticlesUiModule.displayMessage('Please fill out fields before submitting.');
                } else if (text.test(regEx)) {//(text.toLowerCase().indexOf("<\\s*script\\s*>") >= 0) || (text.toLowerCase().indexOf("</script>") >= 0)) {
                    err = 1;
                    return ArticlesUiModule.displayMessage('Message cannot contain scripts.');
                }
                return;
            })
            if (err === 0) {
              updateArticle(editBtn, updBtn, cancelBtn);
            }
          })
    }
    
    function subscribeToCancel (editBtn, updBtn, cancelBtn) {
        cancelBtn.click( function( event ) {
          event.preventDefault();
          editBtn.show();
          updBtn.hide();
          cancelBtn.hide();
          getArticle();
          })
    }
    
    function subscribeToDelete () {
        var delBtn = $('#delete-btn');
        delBtn.click( function( event ) {
        event.preventDefault();
        deleteArticle(delBtn);
        }
        )
    }
    
    function displayPages() {
        var query = getQuery();
        ArticlesModule.countAll(query, function (err, result){
            var error = '';
            if (err) {
                error = 'Sorry, it seems that the server is not responding. Please try again later!';
            } else if (!result.ok) {
                error = result.error;
            } 
                    
            if (error !== ''){
               return displayMessage(error);
            }
            
            setPaging(result.data);  
        })
    }
    
    function setPaging(lastPage) {
        var page = getParameterByName('page');
        var items = getParameterByName('items');
        var search = getParameterByName('search');
        if (page === "") {
            page = 1;
        } else {
            page = parseInt(page);
        }
        var previous = page-1;
        var next = page+1;
        var query = '&search=' + search + '&items = ' + items;
        
        if (page > 1) {
            var PreviousBtn = '<a class="btn btn-secondary pagination float-left" href="home.php?page=' + previous + query + '">&larr; Previous Posts</a>';
            $('#pagination').append(PreviousBtn);
        }
        if ((page < lastPage) || (page === '') || (page === undefined)) {
            var NextBtn = '<a class="btn btn-secondary pagination float-right" href="home.php?page=' + next + query + '">Next Posts &rarr;</a>';
            $('#pagination').append(NextBtn);
        }
    }

    
    function changeFieldsToEdit() {
        var title = $('#artTitle').html();
        var content = $('#artContent').html();
        var titleHtml = '<input class="form-control text" type="text" name="ArtTitle" placeholder="Article Title" id="newTitle" value="' + title + '">';
        var contentHtml = '<textarea rows="10" cols="52" class="form-control text" type="text" name="ArtComm" placeholder="Article Content" id="newContent">' + content + '</textarea>';
        $('#artTitle').html(titleHtml);
        $('#artContent').html(contentHtml);
    }
    
    function changeFieldsToStatic () {
        var title = $('#newTitle').val();
        var content = $('#newContent').val();
        $('#artTitle').html(title);
        $('#artContent').html(content);
    }
    
    function displayMessage (txt) {
        $('#message').html(txt);
    }
    
    function clearMessage(){
        $('#message').html('');
    }
    
    
    return {
        displayArticles: displayArticles,
        
        displayArticle: displayArticle,
        
        displayMessage: displayMessage,
        
        clearMessage: clearMessage
    }
})($);

