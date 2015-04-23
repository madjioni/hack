$(document).ready(function() {

    $( "#dugme_log" ).click(function() {
        
        $('#response_log').html("Login res: ");
        var f_email = $('#email_log').val();
        var f_pass = $('#password_log').val();

        $.ajax({
            method: "GET",
            url: "/login/",
            data: {email: f_email, pass: f_pass}
        })
        .done(function( msg ) {
            $('#response_log').html("Login res: " + msg );
        });

    });

});