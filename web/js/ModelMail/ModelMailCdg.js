$(document).ready(function () {
    
    $('.afficherModel').click(function (e) {
        var IdModel = $(this).data('id');

        $.ajax({
            url: Routing.generate('modelmail_showmodal', {id: IdModel}),

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

    $('#table-modelmailperso, #table-modelmail').DataTable({
        "lengthMenu": [5, 10, 15, 20],
        "pageLength": 5,
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage modèle de mail _START_ &agrave; _END_ sur _TOTAL_ modèles de mails",
            infoEmpty: "Affichage modèle de mail 0 &agrave; 0 sur 0 modèles de mails",
            infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix: "",
            loadingRecords: "Chargement en cours...",
            zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable: "Aucune donnée disponible dans le tableau",
            paginate: {
                first: "Premier",
                previous: "Pr&eacute;c&eacute;dent",
                next: "Suivant",
                last: "Dernier"
            },
            aria: {
                sortAscending: ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }
    });
    
    $('body').on('hidden.bs.modal', '#Modal' , function (e) {
        $(this).remove();
    })



});