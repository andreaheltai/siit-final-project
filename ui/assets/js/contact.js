// Contact Form Scripts

$(function() {

    $("#contactForm input,#contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            var invalid = 0;
            //Check if fields are empty or have scripts
            $.each($(".checkContact"), function () {
                var text = $(this).val();
                    if ((text.toLowerCase().indexOf("<script>") >= 0) || (text.toLowerCase().indexOf("</script>") >= 0)) {
                        invalid = 1;
                            $('#success').html("<div class='alert alert-danger alert-dismissable fade show'>");
                            $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                .append("</button>");
                            $('#success > .alert-danger').append('Message cannot contain scripts');
                            $('#success > .alert-danger').append('</div>');
                            //clear all fields
                            $('#contactForm').trigger("reset");
                        return;
                    }
                return;
                })
                if (invalid === 0) {
                    // get values from FORM
                    var data = $("#contactForm").serialize();
                    ContactsModule.create(data, function (err, result){
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
                            $('#contactForm').trigger("reset");
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
                                $('#contactForm').trigger("reset"); 
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
