$(document).ready(function () {
    
    $('.afficherModelInterne').click(function (e) {
        var IdModel = $(this).data('id');

        $.ajax({
            url: Routing.generate('modelmailinterneappli_showmodal', {id: IdModel}),

            method: 'POST',
            async: true,
            success: function (response) {
                $('body').append(response);
                $('#Modal').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });

    });

    $('body').on('hidden.bs.modal', '#Modal' , function (e) {
        $(this).remove();
    })



});