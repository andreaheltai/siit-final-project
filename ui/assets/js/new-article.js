// Contact Form Scripts

$(function() {

    $("#createArtForm input, #createArtForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); 
            // prevent default submit behaviour
            // tried for IMAGES
            // var title = $("#newart-title").val();
            // var content = $("#newart-content").val();
            // var image = $("#newart-image").val();
            // var usrid = $("#newart-usrid").val;
            // var pub = $("#newart-pub").val();
            // var data = {title: title,
            //             content: content,
            //             image:image,
            //             user_id: usrid,
            //             published: pub
            //             }
            
            var invalid = 0;
            //Check if fields are empty or have scripts
            $.each($(".checkArtAdd"), function () {
                var text = $(this).val();
                    if ((text.toLowerCase().indexOf("<script>") >= 0) || (text.toLowerCase().indexOf("</script>") >= 0)) {
                        invalid = 1;
                            $('#success').html("<div class='alert alert-danger alert-dismissable fade show'>");
                            $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                .append("</button>");
                            $('#success > .alert-danger').append('Message cannot contain scripts');
                            $('#success > .alert-danger').append('</div>');
                            //clear all fields
                            $('#createArtForm').trigger("reset");
                        return;
                    }
                return;
                })
                if (invalid === 0) {
                    var data = $('#createArtForm').serialize();
                    ArticlesModule.create(data, function (err, result){
                        var error = '';
                        if (err) {
                            error = 'Sorry, it seems that the server is not responding. Please try again later!';
                        } else if (!result.ok) {
                            error = result.error;
                        } 
                        
                        if (error !== ''){
                            // Fail message
                            $('#success').html("<div class='alert alert-danger alert-dismissable fade show'>");
                            $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                .append("</button>");
                            $('#success > .alert-danger').append(error);
                            $('#success > .alert-danger').append('</div>');
                            //clear all fields
                            $('#createArtForm').trigger("reset");
                        } else {
                            // Success message
                            $('#success').html("<div class='alert alert-success alert-dismissable fade show'>");
                            $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                .append("</button>");
                            $('#success > .alert-success')
                                .append(result.data);
                            $('#success > .alert-success')
                                .append('</div>');
            
                            //clear all fields
                            $('#createArtForm').trigger("reset"); 
                        }
                    })
                }
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
    $('#success').html('');
});

var fileTypes = [
  'image/jpeg',
  'image/pjpeg',
  'image/png'
]

function validFileType(file) {
  for(var i = 0; i < fileTypes.length; i++) {
    if(file.type === fileTypes[i]) {
      return true;
    }
  }

  return false;
}
