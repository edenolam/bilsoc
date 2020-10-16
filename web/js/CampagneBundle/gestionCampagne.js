$(document).ready(function(){

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        e.target // newly activated tab
        var idTabBody = $(e.target).attr('href');
        e.relatedTarget // previous active tab
        $(idTabBody).find('.dataTable').css('width', '100%').dataTable().fnAdjustColumnSizing();

    });
    var langueEnqueteFr = {
        processing: "Traitement en cours...",
        search: "Rechercher&nbsp;:",
        lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
        info: "_START_ &agrave; _END_ sur _TOTAL_ enquêtes",
        infoEmpty: "0 &agrave; 0 sur 0 enquêtes",
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
    };
    $('#enquetesOuvertes').DataTable({
        data: enquetes_ouvertes,
        "columnDefs": [
            { "width": "5%", "targets": 0 , "className": "text-center" },
            { "width": "20%", "targets": 1 },
            { "width": "50%", "targets": 2 },
            /*{ "width": "20%", "targets": 3 }*/
        ],
        "columns": [
            {"data": "CD_DEPA"},
            {"data": "LB_DEPA"},
            {"data": "LB_ENQU"},
            /* {
                 "data": null,
                 "render": function (data, type, row, meta) {

                         data = '<a href=' + Routing.generate('enquete_lancer', {id: data.ID_ENQU}) + '><span>Lancer</span></a>'

                     return data;
                 }
             }*/
        ],
        language: langueEnqueteFr

    });
    var dtTableEnqLancee = $('#enquetesLancees').DataTable({

        data: enquetes_lancees,

        "columnDefs": [
            { "width": "5%", "targets": 0  },
            { "width": "5%", "targets": 1, "className": "text-center" },
            { "width": "20%", "targets": 2},
            { "width": "40%", "targets": 3 },
            { "width": "30%", "targets": 4 }
        ],
        "columns": [
            {
                data: "selected",
                "render": function (data, type, row, meta) {
                    var checked = data==1 ? "checked" : "";
                    var attr = {
                        checked: checked,
                        name: 'select[]',
                        value: row.ID_ENQU,
                        class:'check-coll-export bootstrapToggle to-bt'
                    };
                    var input = dtcreateCheckbox(attr,{toggle:'toggle'})
                    return input;
                }
            },
            {"data": "CD_DEPA"},
            {"data": "LB_DEPA"},
            {"data": "LB_ENQU"},
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    if(data.BL_CLOTURE == true){
                        data = 'Autorisée';
                    }else{
                        data = 'Interdite';
                    }
                    /* a utiliser dans le cas ou nous devrons acceder aux actions coté adminisatrateur */
                    //data = '<a href=' + Routing.generate('enquete_cloturer', {id: data.ID_ENQU}) + '><span>Clôturer</span></a>'

                    return data;
                }
            }
        ],
        fnDrawCallback: function(settings){
            var nodes = this.api().rows().nodes();
            var to_bt = $(nodes).find('input[type="checkbox"].to-bt');
            initBoostrapToggle(to_bt);
        },
        language: langueEnqueteFr
    });
    var dtTableEnqNonCree = $('#enquetesnoncrees').DataTable({

        data: enquetes_non_crees,
        "columnDefs": [
            { "width": "5%", "targets": 0, "orderable" : false},
            { "width": "45%", "targets": 1 },
            { "width": "5%", "targets": 2, "className": "text-center" },
            { "width": "20%", "targets": 3 },
            { "width": "20%", "targets": 4 , "type": "datetime",
                "format": "DD.MM.Y"}
        ],

        "columns": [
            {
                data: "selected",
                "render": function (data, type, row, meta) {

                    if(!isEmpty(row.LB_MAIL)){
                        var checked = data == 1 ? "checked" : "";
                        var attr = {
                            checked: checked,
                            name: 'select[]',
                            value: row.CD_DEPA,
                            class: 'check-coll-relance bootstrapToggle to-bt'
                        };
                        data = dtcreateCheckbox(attr, {toggle: 'toggle'});
                        return data;
                    }
                    return '';


                }
            },
            {"data" : "LB_CDG"},
            {"data": "CD_DEPA"},
            {"data": "LB_DEPA"},
            {
                "data": null,
                "render": function (data, type, row, meta) {

                    data = 'Pas de relance';
                    if(!isEmpty(row.DT_DERNRELA)){
                        console.log(row.DT_DERNRELA);
                        data = moment(row.DT_DERNRELA, ['YYYY-MM-DD HH:mm']).format('DD-MM-YYYY HH:mm');

                    }

                    return data;
                }
            },

        ],
        fnDrawCallback: function(settings){
            var nodes = this.api().rows().nodes();
            var to_bt = $(nodes).find('input[type="checkbox"].to-bt');
            initBoostrapToggle(to_bt);
        },
        language: langueEnqueteFr
    });
    $(document).on('change','.check-coll-relance',function(event){
        dtCheckboxToggle(this,dtTableEnqNonCree);
    });
    $(document).on('change','.check-coll-export',function(event){
        dtCheckboxToggle(this,dtTableEnqLancee);
    });
    $(document).on('click','#enquetesnoncrees .check-all.vertical',function(event){
        event.preventDefault();
        dtSelectAllVertical(this,dtTableEnqNonCree);
    });
    $(document).on('click','#enquetesLancees .check-all.vertical',function(event){
        event.preventDefault();
        dtSelectAllVertical(this,dtTableEnqLancee);
    })
    $('.btn-relance').click(function(e){
        var idCamp = $('#idCamp').val();
        var message = $('#bilan_social_bundle_campagnebundle_relance_lbMessrela').val();
        if(message != ''){
            e.preventDefault();
            var Array_departements = dtGetRowsBySelectedColl(dtTableEnqNonCree,'selected','ID_CDG');

            $.ajax({
                url: Routing.generate('campagne_relancer'),
                method: 'POST',
                dataType: 'json',
                data: {'idCdg' : Array_departements, 'message': message},
                async: true,
                success: function (response) {
                    if('done' == response){
                        location.reload();
                    }else if('erreur' == response){
                        $('#messageJS').html("Cette collectivité ne possède pas de contact par défaut, le mail n'a pas pu être envoyé.");
                        $('#messageJS').show();
                    }
                }

            });
        }else{
            $('#messageJS').html("Veuillez renseigner le message à envoyer.");
            $('#messageJS').show();
        }
        return false;
    });
    $('#editAutorisationCloture').click(function(e){


        e.preventDefault();
        var Array_enquete = dtGetRowsBySelectedColl(dtTableEnqLancee,'selected','ID_ENQU');

        $.ajax({
            url: Routing.generate('enquete_modifier_autorisation_cloture'),
            method: 'POST',
            dataType: 'json',
            data: {'idEnqu' : Array_enquete},
            async: true,
            success: function (response) {
                location.reload();
            }

        });
    });

    $('#enquetesClotures').DataTable({
        data: enquetes_clotures,
        "columnDefs": [
            { "width": "5%", "targets": 0 , "className": "text-center" },
            { "width": "20%", "targets": 1 },
            { "width": "50%", "targets": 2 },
            /*{ "width": "20%", "targets": 3 }*/
        ],
        "columns": [
            {"data": "CD_DEPA"},
            {"data": "LB_DEPA"},
            {"data": "LB_ENQU"},
            /* {
                 "data": null,
                 "render": function (data, type, row, meta) {

                     data = '<a href=' + Routing.generate('enquete_archiver', {id: data.ID_ENQU}) + '><span>Archiver</span></a><br>' +
                         '<a href=' + Routing.generate('enquete_ouvrir', {id: data.ID_ENQU, 'idCamp': data.ID_CAMP}) + '><span>Rouvrir</span></a>';

                     return data;
                 }
             }*/
        ],
        language: langueEnqueteFr

    });

    $('#enquetesArchivees').DataTable({
        data: enquetes_archivees,
        "columnDefs": [
            { "width": "5%", "targets": 0 , "className": "text-center" },
            { "width": "20%", "targets": 1 },
            { "width": "50%", "targets": 2 }
        ],
        "columns": [
            {"data": "CD_DEPA"},
            {"data": "LB_DEPA"},
            {"data": "LB_ENQU"}
        ],
        language: langueEnqueteFr

    });

    $('#export-collectivite').on('click', function(e){

          var Array_departements = dtGetRowsBySelectedColl(dtTableEnqNonCree,'selected','CD_DEPA');
          console.log(Array_departements);
        if(!isEmpty(Array_departements)){
            $('#relance-mail').modal();
        }
    });
    

});

