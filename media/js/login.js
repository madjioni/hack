$(document).ready(function() {

    $( "#dugme_log" ).click(function() {

        $('#response_log').html("Login res: ");
        var f_email = $('#email_log').val();
        var f_pass = $('#password_log').val();

        $.ajax({
            method: "POST",
            url: "/logincheck/",
            data: {email: f_email, pass: f_pass}
        })
        .done(function( msg ) {
            if(msg=='bad')
            {
                $('#response_log').html('Losi podaci.');
            }
            else
            {
                window.location.href = '/';
                //$('#response_log').html('Dobri podaci.');
            }

        });

    });

});