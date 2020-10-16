
$(document).ready(function () {
     $('#err-format').hide();
     $('#alert-err').hide();

     $('#historiquecollectivite_RefNatureMAJ').on('change', function(){

         $('#dtNewCollHisto').addClass('hidden');
         //$('.dtArch').addClass('hidden');
         //$('.dtArch').attr('required', false);

         $('.dtArch').attr('required', true);
         $('.dtArch').removeClass('hidden');


         if ($.fn.DataTable.isDataTable( '#dtNewCollHisto' ) ) {
             $('#dtNewCollHisto').DataTable().destroy();
         }

         if($(this).val() === 'fs' || $(this).val() === "ca"){
             /* initialisation du tableau pour les créations : Changement d'adresse et fusion */
             initDtTable(1, $(this).val());
         }else if($(this).val() === 'ds' ){

         }else if( $(this).val() === "ab"){
          /*   if ($.fn.DataTable.isDataTable( '#dtNewCollHisto' ) ) {
                 $('#dtNewCollHisto').DataTable().destroy();
             }*/
             /* initialisation du tableau pour les absorptions reprennant les données en bdd de la table historique_collectivité qui ont le statut 'aucun changement' */
             initDtTableAbsorption(2, $(this).val());
         }else if($(this).val() === "cr"){
          /*   if ($.fn.DataTable.isDataTable( '#dtNewCollHisto' ) ) {
                 $('#dtNewCollHisto').DataTable().destroy();
             }*/
         }

     });
     $(document).on('click', '.siret_fs', function(){
         var matches = [];
         $('input[name="historiquecollectivite[listColl]"]').val('');
         var checkedcollection = $('#dtNewCollHisto').DataTable().$(".siret_fs:checked", { "page": "all" });
         /*console.log(checkedcollection);*/
         checkedcollection.each(function (index, elem) {
             matches.push($(elem).data('options'));
         });
         var AccountsJsonString = JSON.stringify(matches);
         $('input[name="historiquecollectivite[listColl]"]').val(AccountsJsonString);
    });
    $(document).on('click', '.siret_ca', function(){
        var matches = [];
        $('input[name="historiquecollectivite[listColl]"]').val('');
        //var checkedcollection = $('#dtNewCollHisto').DataTable().$(".siret_ca:checked", { "page": "all" });

        //checkedcollection.each(function (index, elem) {
        //    matches.push($(elem).data('options'));
        //});

        setGlobalVar('histo_crea_id',$(this).attr('id'));
        matches.push($(this).attr('id'));

        var AccountsJsonString = JSON.stringify(matches);
        $('input[name="historiquecollectivite[listColl]"]').val(AccountsJsonString);

    });

    $(document).on('click', '.suppr', function () {
        $(this).parent('tr').remove();
        var url = window.location.href;
        if (url.indexOf("recherche") >= 0) {
        //tri('table-rech-coll');
            $('#param-applique').text('');
            $('#table-rech-coll').DataTable().ajax.reload();
        }else if(url.indexOf("modification-masse-import") >= 0){
             tri('table-modif-mass');
        }else {
            $('#essai').DataTable().ajax.reload();
        }
    });

    var dtTableColl = $('#creation').DataTable({
        "processing": false,
        "serverSide": false,
        deferRender : true,
        info: true,
        "columnDefs": [
            { "orderable": false, "targets": [0] }
        ],
        "columns": [
            {
                "data": null, name: "maj",
                render: function(data, type, row, meta){
                    if(type === 'display'){
                            data = '<a title="'+ row.nmSire +'" href='+ Routing.generate('collectivite_modifications_historisation_creation', { siret: row.nmSire })+'>Mettre à jour </a>';
                    }
                    return data;
                },
                ordering: false
            },
            { "data": "nmSire", name:"nmSireNouveau" },
            { "data": "lbColl", name: "blSireNouveau"  },
            { "data": "lbAdre", name: "blLbAdresse" },
            { "data": "lbDepa", name: "blDepa"  },
            { "data": "cdDepa", name: "cdDepa" },
            { "data": "lbVill", name: "blLbVill" },
        ],
        language: languageDataTable,
        ajax :{
            url : Routing.generate('ajax_get_collectivite_historisation_creation_worktable'),
            "type" : 'POST',
            "async": true,
            "data" : function(d){
                var filtres = [];
                $('.filtre_applied').each(function(){
                    filtres.push({
                        condition:$(this).find('input[name="condition"]').val(),
                        parametre:$(this).find('input[name="parametre"]').val(),
                        filtre:$(this).find('input[name="filtre"]').val()
                    });
                });
                d.filtres = filtres;
            },

        },
        "initComplete": function(settings, json) {

        },
        fnDrawCallback: function(settings){

        },
    });
    var dtTableCollSuppression = $('#suppression').DataTable({
        "processing": false,
        "serverSide": false,
        deferRender : true,
        info: true,
        "columnDefs": [
            { "orderable": false, "targets": [0] }
        ],
        "columns": [
            {
                "data": null, name: "maj",
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<a title="'+ row.nmSire +'" href='+ Routing.generate('collectivite_modifications_historisation_suppression', { siret: row.nmSire })+'>Mettre à jour </a>';
                    }
                    return data;
                },
                ordering: false
            },

            {"data": "nmSire", name: "blSireNouveau"},
            {"data": "lbColl", name: "blSireNouveau"},
            {"data": "lbAdre", name: "blLbAdresse"},
            {"data": "lbDepa", name: "blDepa"},
            {"data": "cdDepa", name: "cdDepa"},
            {"data": "lbVill", name: "blLbVill"},
        ],
        language: languageDataTable,
        ajax :{
            url : Routing.generate('ajax_get_collectivite_historisation_suppression_worktable'),
            "type" : 'POST',
            "async": true,
            "data" : function(d){
                var filtres = [];
                $('.filtre_applied').each(function(){
                    filtres.push({
                        condition:$(this).find('input[name="condition"]').val(),
                        parametre:$(this).find('input[name="parametre"]').val(),
                        filtre:$(this).find('input[name="filtre"]').val()
                    });
                });
                d.filtres = filtres;
            },

        },
        "initComplete": function(settings, json) {

        },
        fnDrawCallback: function(settings){

        },
    });

    $('#dtNewCollHisto').on('click', 'input[name="siret"]', function (even) {
        //alert('orororor');
     /*   var checked = $(this).prop('checked');
        if (checked) {
            is_radio_metier_checked = $(this).val();

        }*/
    });
    var currentInput = $('#historiquecollectivite_listColl').val();
});

function tri(table) {
    var liste = $('#liste-filtres table tr');

//    table
//        .search( '' )
//        .columns().search( '' )
//        .draw();
    $('#' + table + ' tbody tr').show();
    $('#' + table + ' tbody tr').removeClass('ignore');

    liste.each(function () {
        var condiVal = $(this).find('input[name=condition]').val();
        var parametreTmp = $(this).find('input[name=parametre]').val();
        var parametre = parametreTmp.split(',');
        var filtre = $(this).find('input[name=filtre]').val();
        var tmp = filtre.split('-');
        var id = tmp[0];
        var tr = $('#' + table + ' tbody tr');
        if ('==' == condiVal) {
            $.each(tr, function () {
                nm = $(this).find('td.col-' + id).text();
                if (parametre.indexOf(nm) < 0) {
                    $(this).hide();
                    $(this).find('input:checkbox').addClass('hidden-row');
                }
            });
        } else if ('!=' == condiVal) {
            $.each(tr, function () {
                nm = $(this).find('td.col-' + id).text();
                if (parametre.indexOf(nm) >= 0) {
                    $(this).hide();
                    $(this).find('input:checkbox').addClass('hidden-row');
                }
            });
        } else if ('in' == condiVal) {
            $.each(tr, function () {
                var checkTr = $(this);
                $.each(parametre, function (k, v) {
                    arg = v.toLowerCase();
                    nmTmp = checkTr.find('td.col-' + id).text();
                    nm = nmTmp.toLowerCase();
                    if (nm.indexOf(arg) < 0 && !checkTr.hasClass('ignore')) {
                        checkTr.hide();
                        checkTr.find('input:checkbox').addClass('hidden-row');
                    } else {
                        checkTr.show();
                        checkTr.find('input:checkbox').removeClass('hidden-row');
                        checkTr.addClass('ignore');
                    }
                });
            });
        }else if('^=' == condiVal){
            $.each(tr,function(){
                nm = $(this).find('td.col-'+id).text();
                if($(this).find('td.col-'+id).hasClass('btn-toggle')){
                    if($(this).find('td.col-'+id).find('input[type=checkbox]').prop('checked') == false){
                        nm = 'Non';
                    }else{
                        nm = 'Oui';
                    }
                }
                if(!nm.match("^"+parametre)){
                    $(this).hide();
                    $(this).find('input:checkbox').addClass('hidden-row');
                }
            });
        } else if ('>' == condiVal) {
            $.each(tr, function () {
                nm = $(this).find('td.col-' + id).text();
                if (nm <= parametre) {
                    $(this).hide();
                    $(this).find('input:checkbox').addClass('hidden-row');
                }
            });
        } else if ('<' == condiVal) {
            $.each(tr, function () {
                nm = $(this).find('td.col-' + id).text();
                if (nm >= parametre) {
                    $(this).hide();
                    $(this).find('input:checkbox').addClass('hidden-row');
                }
            });
        }else if('>=' == condiVal){
            $.each(tr,function(){
                nm = $(this).find('td.col-'+id).text();
                if(nm < parametre){
                    $(this).hide();
                    $(this).find('input:checkbox').addClass('hidden-row');
                }
            });
        }else if('<=' == condiVal){
            $.each(tr,function(){
                nm = $(this).find('td.col-'+id).text();
                if(nm > parametre){
                    $(this).hide();
                    $(this).find('input:checkbox').addClass('hidden-row');
                }
            });
        }
    });
    if (liste.length == 0) {
        $('#appl-filtre').attr('disabled', true);
    }
}

function initParam(id) {
    $('#liste-filtres table').append(' ');
    $('#appl-filtre').attr('disabled', false);

    if (id != null) {
        $.ajax({
            url: Routing.generate('collectivite_parametrage'),
            method: 'POST',
            async: true,
            data: {'id': id},
            dataType: "json",
            success: function (response) {
                $.each(response, function (k, v) {
                    if ($.isPlainObject(v)) {
                        $.each(v['filtres'], function (key, value) {
                            colonne = $('#parametrageEnquete_filtres option[value="' + value['colonne'] + '"').text();
                            condition = $('#parametrageEnquete_conditions option[value="' + value['condition'] + '"').text();
                            parametres = value['parametre'] + "";
//                            $('#liste-filtres table').append('<tr class="filtre"><td class="suppr"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td><td>' + colonne + ' ' + condition + ' ' + parametres + '</td><td><input type="hidden" name="filtre" value="' + value['colonne'] + '"></td><td><input type="hidden" name="condition" value="' + value['condition'] + '"></td><td><input type="hidden" name="parametre" value="' + parametres + '"></td></li>');
                            var row_elmt = $('<tr class="filtre"></tr>');
                            var col_ico_elmt = $('<td class="suppr"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>');
                            var col_filter_text_elmt = $('<td>' + colonne + ' ' + condition + ' ' + parametres + '</td>');
                            var col_value = $('<td class="filtre_applied"><input type="hidden" name="filtre" value="' + value['colonne'] + '"><input type="hidden" name="condition" value="' + value['condition'] + '"><input type="hidden" name="parametre" value="' + parametres + '"></td>');
                            $(row_elmt).append(col_ico_elmt,col_filter_text_elmt,col_value);
                            //$('#liste-filtres table').append('<tr class="filtre"><td class="suppr"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td><td>' + filtre + ' ' + condition + ' ' + parametre + '</td><td><input type="hidden" name="filtre" value="' + filtreVal + '"></td><td><input type="hidden" name="condition" value="' + condiVal + '"></td><td><input type="hidden" name="parametre" value="' + parametre + '"></td></li>');
                            $('#liste-filtres table').append(row_elmt);
                            $('#appl-filtre').attr('disabled', false);
//                            $('#appl-filtre').trigger("click");

                        });
                        $('#table-rech-coll').DataTable().ajax.reload();
                    } else {
                        if(v == false || v == null){
                            $('#liste-colonnes option[value="' + k + '"').attr('selected', true);
//                            $('#enlever-colonne').trigger("click");
                        }
                    }
                });
            }
        });
    }else{
        $('#param-applique').html('');
        $('#liste-filtres table').html('');
    }
}

function getCdg(depa){
    if(depa != ''){
        $.ajax({
           url: Routing.generate('get_cdg_ajax'),
           method: 'POST',
           data: {depa: depa},
           success: function (response) {
               if(response != ''){
                   $.each(response,function(key,value){
                       $('#cdgDepa').html('<option value="'+key+'">'+value+'</option>');
                   });
               }else{
                   $('#cdgDepa').html('<option value="">Aucun CDG n\'est associé à ce département</option>');
               }
           }
       });
   }else{
       $('#cdgDepa').html('<option value="">Veuillez sélectionner un département</option>');
   }
}


setGlobalVar('histo_crea_id',"");

function initDtTable(params, value_select) {

    if ($.fn.DataTable.isDataTable('#dtNewCollHisto')) {
        $('#dtNewCollHisto').DataTable().destroy();
    }
    var url = '';

    if (value_select === 'fs' || value_select === 'ca') {
        url = Routing.generate('collectivite_modifications_historisation_get_all_creation', {params: params})
    }

    var dtNewCollHisto = $('#dtNewCollHisto').DataTable({
        "processing": false,
        "serverSide": false,
        deferRender: true,
        info: true,
        "columnDefs": [{
            orderable: false,
            targets: 0,
            data: null,
            defaultContent: ''
        }],
        order: [[1, 'asc']],
        "select": {
            style: 'os',
            selector: 'td:first-child'
        },
        "columns": [
            {
                render: function (data, type, row, meta) {
                    if (value_select === 'fs') {
                        var checkbox = '<input type="checkbox" class="siret_fs" name="siret" data-options="' + data.nmSire + '"/>';
                        return checkbox;
                    } else if (value_select === 'ca') {
                        var is_selected = getGlobalVar('histo_crea_id') == data.nmSire ? "checked" : "";
                        var radio = '<input type="radio" class="siret_ca" name="siret" data-options="' + data.nmSire +'" id="'+data.nmSire+'" '+is_selected+'/>';
                        //var radio = '<input type="radio" class="siret_ca" name="siret" data-options="' + data.nmSire + '"/>';
                        return radio;
                    }

                }
            },
            {"data": "nmSire", name: "blSireNouveau"},
            {"data": "lbColl", name: "blLibe"},
            {"data": "lbAdre", name: "lbAdresse"},
            {"data": "lbDepa", name: "blDepa"},
            {"data": "cdDepa", name: "cdDepa"},
            {"data": "lbVill", name: "blLbVill"},
        ],

        language: languageDataTable,
        ajax: {
            url: url,
            "type": 'POST',
            "async": true

        },
        "initComplete": function (settings, json) {
            $('#dtNewCollHisto').removeClass('hidden');
        },
        fnDrawCallback: function (settings) {

        },
    });
}




function initDtTableAbsorption(params, value_select){

    if ($.fn.DataTable.isDataTable( '#dtNewCollHisto' ) ) {
        $('#dtNewCollHisto').DataTable().destroy();
    }
    var url = '';

    if(value_select === 'ab'){
        url = Routing.generate('collectivite_modifications_historisation_get_all_creation', {params: params})
    }

    var dtNewCollHisto = $('#dtNewCollHisto').DataTable({
        "processing": false,
        "serverSide": false,
        deferRender : true,
        info: true,
        "columnDefs": [ {
            orderable: false,
            targets:   0,
            data: null,
            defaultContent: ''
        } ],
        order: [[ 1, 'asc' ]],
       "select": {
            style:    'os',
            selector: 'td:first-child'
        },
        "columns": [
            {
                render: function (data, type, row, meta) {
                    var is_selected = getGlobalVar('histo_crea_id') == data.nmSire ? "checked" : "";
                    var radio = '<input type="radio" class="siret_ca" name="siret" data-options="' + data.nmSire +'" id="'+data.nmSire+'" '+is_selected+'/>';
                    //var radio = '<input type="radio" class="siret_ca" name="siret" data-options="' + data.nmSire +'"/>';
                    return radio;
                }
            },
            { "data": "nmSire", name: "blSireNouveau" },
            { "data": "lbColl", name: "blLibe"  },
            { "data": "lbAdre", name: "lbAdresse" },
            { "data": "lbDepa", name: "blDepa"  },
            { "data": "cdDepa", name: "cdDepa" },
            { "data": "lbVill", name: "blLbVill" },
        ],

        language: languageDataTable,
        ajax :{
            url : url,
            "type" : 'POST',
            "async": true

        },
        "initComplete": function(settings, json) {
            $('#dtNewCollHisto').removeClass('hidden');
        },
        fnDrawCallback: function(settings){

        },
    });
}