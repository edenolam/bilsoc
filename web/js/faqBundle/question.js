$(document).ready(function () {

    $('#questions_lecture').DataTable(
            {
                "order": [],

                language: {
                    processing: "Traitement en cours...",
                    search: "Rechercher&nbsp;:",
                    lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                    info: "Affichage questions _START_ &agrave; _END_ sur _TOTAL_ questions",
                    infoEmpty: "Affichage question 0 &agrave; 0 sur 0 questions",
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
            }
    );
    $('#questions_ecriture').DataTable(
            {
                "order": [],

                language: {
                    processing: "Traitement en cours...",
                    search: "Rechercher&nbsp;:",
                    lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                    info: "Affichage questions _START_ &agrave; _END_ sur _TOTAL_ questions",
                    infoEmpty: "Affichage question 0 &agrave; 0 sur 0 questions",
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
            }
    );

    var theHREF;
    var idTable;
    var theRow;
    var idQuestionDelete;

    $('.delQuestModalLink').on('click', function (e) {
        e.preventDefault();
        idTable             = $(this).parents('table').attr('id');
        theRow              = $(this).closest('tr');
        theHREF             = $(this).attr("data-href");
        idQuestionDelete    = $(this).attr("data-id");
        $("#delQuestModal").modal("show");
    });

    $("#confirmDelQuestModalNo").click(function (e) {
        $("#delQuestModal").modal("hide");
    });
    $("#confirmDelQuestModalYes").click(function (e) {
        ajax_delete_question(idTable, theRow);
    });

    function ajax_delete_question(idTable, theRow){
        $.ajax({
            url: theHREF,
            type: "DELETE",
            dataType: "json",
            async: true,
            success: function(request){
                    if ($('.flash .alert') != undefined){
                            $('.flash .alert').remove();
                    }
                    var table = $('#'+idTable);
                    $('#'+idTable).DataTable().row(theRow).remove().draw();
                    $("#delQuestModal").modal("hide");
                    $('.flash').prepend('<div class="alert alert-success text-center"><strong>'+request.message+'</strong></div>');
                    },
            error: function(request){

                    }
        });
    };
});
