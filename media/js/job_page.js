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
            alertify.log("Uspesno izmenjeno");
        });

    });

    $( "#dugme_obavesti" ).click(function() {

        $('.chkbx').each( function(i) {
            var id = $(this).attr('id');
            //var s = $(this)s.checked;
            var s = document.getElementById(id).checked;
            id = id.substring(2);

            var jid = $('#hid').val();

            $.ajax({
                method: "GET",
                url: "/osvezi/id/"+id+"/s/"+(s?'1':'0')+'/j/'+jid
                // async: false
            })
            .done(function( msg ) {
                alert(msg);
            });
        });

    });

    $( "#dugme_prijava" ).click(function() {

        var dugme = $('#dugme_prijava').html();
        var tip = dugme=='Prijavi se'?'prijava':'odjava';
        var idposao = $('#idposao').val();
        var iduser = $('#iduser').val();
        console.log(iduser, idposao, tip);

        $.ajax({
            method: "POST",
            url: "/prijava",
            data: {idposao: idposao, iduser: iduser, tip: tip}
        })
        .done(function( msg ) {
            if(msg=='odjavljen')
            {
                $('#dugme_prijava').html('Prijavi se');
            }
            else if(msg=='prijavljen')
            {
                $('#dugme_prijava').html('Odjavi se');
            }
            
        });

    });

});