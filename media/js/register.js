$(document).ready(function() {

    $( "#dugme_reg" ).click(function() {
        
        $('#response_reg').html("Result: ");
        var f_email = $('#email_reg').val();
        var f_pass = $('#password_reg').val();

        $.ajax({
            // preko GET
            // method: "GET",
            // url: "/register/email/"+f_email+"/pass/"+f_pass,

            // preko POST
            method: "POST",
            url: "/register/",
            data: {email: f_email, pass: f_pass}
        })
        .done(function( msg ) {
            $('#response_reg').html("Result: " + msg );
        });

    });

});