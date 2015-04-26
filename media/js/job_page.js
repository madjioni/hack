$(document).ready(function() {

    $( "#dugme_izmeni" ).click(function() {

        $('#izmene_res').html("Rez: ");
        var _id             = $('#id').val();
        var _title          = $('#title').val();
        var _description    = $('#description').val();
        var _location       = $('#location').val();
        var _datestart      = $('#datestart').val();
        var _dateend        = $('#dateend').val();
        var _num            = $('#num').val();
        var _price          = $('#price').val();
        var _pricetype      = $('#pricetype').val();
        var _activeend      = $('#activeend').val();
        var _time           = $('#time').val();
        var _transportation = $('#transport').val();
        var _category       = $('#category').val();

        $.ajax({
            method: "POST",
            url: "/updatejob/",
            data: {
                id: _id,
                title: _title,
                description: _description,
                location: _location,
                datestart: _datestart,
                dateend: _dateend,
                num: _num,
                price: _price,
                pricetype: _pricetype,
                time: _time,
                activeend: _activeend,
                transportation: _transportation,
                category: _category
            }
        })
        .done(function( msg ) {
            $('#izmene_res').html("Rez: "+msg);


        });

    });

    $( "#dugme_obavesti" ).click(function() {

        // $('#response_log').html("Login res: ");
        // var f_email = $('#email_log').val();
        // var f_pass = $('#password_log').val();

        // $.ajax({
        //     method: "POST",
        //     url: "/logincheck/",
        //     data: {email: f_email, pass: f_pass}
        // })
        // .done(function( msg ) {
        //     if(msg=='bad')
        //     {
        //         $('#response_log').html('Losi podaci.');
        //         window.location.href = 'login';
        //     } else
        //     {
        //         window.location.href = '/';
        //     }


        // });

    });

    $( "#dugme_prijavi" ).click(function() {

        // $('#response_log').html("Login res: ");
        // var f_email = $('#email_log').val();
        // var f_pass = $('#password_log').val();

        // $.ajax({
        //     method: "POST",
        //     url: "/logincheck/",
        //     data: {email: f_email, pass: f_pass}
        // })
        // .done(function( msg ) {
        //     if(msg=='bad')
        //     {
        //         $('#response_log').html('Losi podaci.');
        //         window.location.href = 'login';
        //     } else
        //     {
        //         window.location.href = '/';
        //     }


        // });

    });

});