/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    //$('#tables_coll_container table').dataTable();
    var table_match_coll = $('#match-coll');
    if($(table_match_coll).find('input[name="coll_selected[]"]').length==$(table_match_coll).find('input[name="coll_selected[]"]:checked').length){
        $('.select_all_self_coll').prop('checked',true);
    }
    
    table_match_coll = $(table_match_coll).DataTable({
        deferRender: true,
        columns:[
            { name: 'siret' },
            { name: 'libelle' },
            { name: 'departement' },
            { 
                name: 'can_import',
                orderable: false
            }
        ],
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage collectivit&eacute; _START_ &agrave; _END_ sur _TOTAL_ collectivit&eacute;s",
            infoEmpty: "Affichage collectivit&eacute; 0 &agrave; 0 sur 0 collectivit&eacute;s",
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
    $('#fichier-coll').DataTable({
        deferRender: true,
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage collectivit&eacute; _START_ &agrave; _END_ sur _TOTAL_ collectivit&eacute;s",
            infoEmpty: "Affichage collectivit&eacute; 0 &agrave; 0 sur 0 collectivit&eacute;s",
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
    $('#bdd-coll').DataTable({
        deferRender: true,
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage collectivit&eacute; _START_ &agrave; _END_ sur _TOTAL_ collectivit&eacute;s",
            infoEmpty: "Affichage collectivit&eacute; 0 &agrave; 0 sur 0 collectivit&eacute;s",
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
    $('#select_coll_btn').on('click',function(event){
        var coll_selected = getCheckedCollToImport();
        var type_import = $('input#hidden_algo_import_carriere_type').val();
        if(coll_selected.length === 0){
            $('#alert_no_coll').modal();
            return false;
        }
         $.ajax({
                url: Routing.generate('import_carriere_selectcoll'),
                method: 'POST',
                dataType: 'json',
                data: {
                    coll_selected:coll_selected,
                    algo_import_type:type_import
                },
                async: true,
                success: function (response) {
//                    console.log(response);
                },
                complete:function (response) {
//                    console.log(response);
                    $('#alert_valide').modal();
                }
            });
    });
    $('.select_all_self_coll').on('change',function(event){
        var selected = $(this).is(':checked');
        var to_toggle = getToImportNode(!selected);
        $(to_toggle).each(function(){
            $(this).prop('checked',selected);
        });
    });
    function getCheckedCollToImport(){
        var coll_selected = [];
        var can_import_checkboxes = getToImportNode(true);
        $(can_import_checkboxes).each(function(){
            coll_selected.push($(this).val());
        });
        return coll_selected;
    }
    /*
    *   fonction récupérant les checkboxes can_import via DataTable
    */
    function getToImportNode(checked=undefined){
        var can_import_checkboxes = table_match_coll.column('can_import:name').nodes();
        var to_import_nodes =  $(can_import_checkboxes).find('input');
        if(checked!=undefined){
            if(checked==true){
                to_import_nodes = $(to_import_nodes).filter(':checked');
            }else if(checked==false){
                to_import_nodes = $(to_import_nodes).filter(':not(:checked)');
            }
        }
        return to_import_nodes;
    }
})

