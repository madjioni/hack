$(document).ready(function() {

    $( "#dugme_log" ).click(function() {
        
        $('#response_log').html("Login res: ");
        var f_email = $('#mejl_login').val();
        var f_pass = $('#pass_login').val();

        $.ajax({
            method: "POST",
            url: "/logincheck/",
            data: {email: f_email, pass: f_pass}
        })
        .done(function( msg ) {
            if(msg=='bad')
            {
                $('#response_log').html("Pogresni podaci.");
            }
            else
            {
                window.location.href = '/';
            }
            
        });

    });

});