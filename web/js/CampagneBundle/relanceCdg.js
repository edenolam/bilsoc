$(document).ready(function(){
    var table = $('#table-cdg-suivi').DataTable({
        "order": [],
        "columns": [
            {"sortable":false},
            {"sortable":false},
            {"sortable":false},
            {"sortable":true},
            {"sortable":false, "name": "relanceColumn"}
        ],
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage centre de gestion _START_ &agrave; _END_ sur _TOTAL_ centre de gestions",
            infoEmpty: "Affichage centre de gestion 0 &agrave; 0 sur 0 centre de gestions",
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
    var table_dept = $('#table-dept').DataTable({
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage d&eacute;partement _START_ &agrave; _END_ sur _TOTAL_ d&eacute;partements",
            infoEmpty: "Affichage d&eacute;partement 0 &agrave; 0 sur 0 d&eacute;partements",
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
        }});
    
    $('.btn-relance').click(function(e){
        var idCamp = $('#idCamp').val();
        var message = $('#bilan_social_bundle_campagnebundle_relance_lbMessrela').val();
        if(message != ''){
            var checkboxes = table.column('relanceColumn:name').nodes();//$('input[name$='+id+']:checkbox');;
            checkboxes = $(checkboxes).find('input');
            $(checkboxes).each(function(){
                if($(this).is(':checked'))  {
                    var idCdg = $(this).attr('id');
                    $.ajax({
                        url: Routing.generate('campagne_relancer'),
                        method: 'POST',
                        dataType: 'json',
                        data: {'cdg':idCdg, 'campagne':idCamp, 'message': message},
                        async: true,
                        success: function (response) {
                            if('done' == response){
                                location.reload();
                            }else if('no_contact' == response){
                                $('#messageJS').html("Cette collectivité ne possède pas de contact par défaut, le mail n'a pas pu être envoyé.");
                                $('#messageJS').show();
                            }
                        }
                    });
                }
            });
        }else{
            $('#messageJS').html("Veuillez renseigner le message à envoyer.");
            $('#messageJS').show();
        }
        return false;
    });
    $('#btn-open-modal').click(function(e){e.preventDefault();});
    
    $('.filtre').change(function(){
        var col;
        var val_filtre = $(this).val();
        var id = $(this).attr('id');
        if('filtre-cdg' == id){
            col = 0;
        }else{
            col = 1;
        }
        if('Tous' != val_filtre){
            table
                .columns( col )
                .search(  val_filtre )
                .draw();
        }else{
            table
                .search( '' )
                .columns(col).search( '' )
                .draw();
        }
    });
    $('.check-all-relance').change(function(){
        if ($(this).prop('checked')) {
            $('.check-relance').prop('checked',true);
        } else {
            $('.check-relance').prop('checked', false);
        } 
    });
});

