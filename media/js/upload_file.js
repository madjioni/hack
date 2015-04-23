$(document).ready(function() {

    $( "#upload_btn" ).click(function() {
        
        $('#upload_res').html("Result:");
        var f_name = $('#filename').val();
        var file_data = $("#inp_file").prop('files')[0];   

        var form_data = new FormData();                  
        form_data.append('inp_file', file_data);
        form_data.append('filename',f_name);

        $.ajax({
            method: "POST",
            url: "/upload/",
            processData: false,
            contentType: false,
            data: form_data
        })
        .done(function( msg ) {
            $('#upload_res').html("Result: " + msg );
        });

    });

});