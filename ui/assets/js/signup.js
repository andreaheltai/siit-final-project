// Sign Up Form Scripts

$(function() {

    $("#signUpForm input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
        // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            var invalid = 0;
            //Check if fields are empty or have scripts
            $.each($(".checkSgnUp"), function () {
                var text = $(this).val();
                    if ((text.toLowerCase().indexOf("<script>") >= 0) || (text.toLowerCase().indexOf("</script>") >= 0)) {
                        invalid = 1;
                            $('#success').html("<div class='alert alert-danger alert-dismissable fade show'>");
                            $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                .append("</button>");
                            $('#success > .alert-danger').append('Message cannot contain scripts');
                            $('#success > .alert-danger').append('</div>');
                            //clear all fields
                            $('#signUpForm').trigger("reset");
                        return;
                    }
                return;
                })
                if (invalid === 0) {
                    // get values from FORM
                    if ((checkPass() === true) && (checkRepass() === true)) {
                    var data = $("#signUpForm").serialize();
                    UsersModule.signup(data, function (err, result){
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
                            $('#signUpForm').trigger("reset");
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
                            $('#signUpForm').trigger("reset"); 
                        }
                    })}
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

function matchPass (pass, repass) {
    return pass === repass;
}

function matchRegex (pass) {
    return /^\S*(?=\S{6,})(?=\S*[a-zA-Z])(?=\S*[\d])\S*$/.test(pass);
}

function showError(alert, error) {
    html = '<li>' + error +'</li>';
    alert.html(html);
}

function checkPass () {
    var pass = $("#sgnup-pass").val();
    var alert = $('#pass-list');
    if (!matchRegex(pass)) {
        var error = "Password should be at least 6 characters with at least 1 letter and 1 number."
        showError(alert, error);
        return false;
    } else {
        alert.html('');
        return true;
    }
}

function checkRepass () {
    var pass = $("#sgnup-pass").val();
    var repass = $("#sgnup-repass").val();
    var alert = $('#repass-list');
    if (!matchPass(pass, repass)) {
        var error = "Passwords do not match."
        showError(alert, error);
        return false;
    } else {
        alert.html('');
        return true;
    }
}


