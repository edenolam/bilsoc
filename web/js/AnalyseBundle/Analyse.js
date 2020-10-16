$(document).ready(function(){
    $('.panel-body.slide-up').slideUp();
    $(document).on('click', '.panel-heading span.clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body.slide-up').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            $this.parents('.panel').find('.panel-body.slide-up').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    });
    
    var table = $('#table-anal-coll').DataTable({
        processing: false,
        serverSide: false,
        deferRender: true,
        scrollY: "80vh",
        scrollX: "80vw",
        scrollCollapse: true,
        order: [],
        columns: [
            { 
                data: 'select_affi',name: "select",
                sortable: false, orderable: true,
                render: function(data, type, row, meta){
                    var checked = data==1 ? "checked" : "";
                    var attr = {
                        checked:checked,
                        id:row.idColl,
                        name:row.idColl,
                        class:'check-coll-export bootstrapToggle to-bt'
                    };
                    var input = dtcreateCheckbox(attr,{toggle:'toggle'});
                       //data = "<input type='checkbox' class='check-export' id='"+row.idColl+"'>";
                   return input;
               }, 
            },
            { data: "nmSire", name:"blSire" },
            { data: "lbColl", name: "blLibe"  },
            { data: "lbTypeColl", name: "blTypeColl"  },
            { data: "lbAdre", name: "blLbAdresse" },
            { data: "lbDepa", name: "blDepa"  },
            { data: "cdPost", name: "blCdPost"  },
            { data: "lbVill", name: "blLbVill"  },
            { data: "cdInse", name: "blCdInse"  },
            { data: "nmPopuInse", name: "blNmPopuInse"  },
            { 
                data: "blSurclasDemo", name: "blSurclasDemo",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blSurclasDemo);
                    return rendered;
                }
            },{ data: "nmStratColl", name: "blNmStratColl"  },
            { 
                data: "blAffiColl", name: "blAffiCdg",  
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blAffiColl);
                    return rendered;
               }  
            },{ 
                data: "blCtCdg", name: "blCtCdg",  
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blCtCdg);
                    return rendered;
                }
            },{
                data: "blChsct", name: "blChsct",  
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blChsct);
                    return rendered;
                }
            },{
                data: "blCollDgcl", name: "blCollDgcl",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blCollDgcl);
                    return rendered;
                }
            },{ 
                data: "cdg_is_authorized_by_collectivity", name: "cdg_is_authorized_by_collectivity",  
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.cdg_is_authorized_by_collectivity);
                    return rendered;
                }
            },{   
                data: null, name: "blNbAgenPerm",
                render: function(data, type, row, meta){
                    data = (parseInt(data.val1) + parseInt(data.val2) + parseInt(data.val3) + parseInt(data.val4) + parseInt(data.val5) + parseInt(data.val6)) || 0;
                    return data;
                }
            },{ 
                data: null, name: "blNbAgenTitu",
                render: function(data, type, row, meta){
                    data = (parseInt(data.val1) + parseInt(data.val2)) || 0;
                    return data;
                }
            },{ 
                data: null, name: "blNbAgenContPerm",
                render: function(data, type, row, meta){
                    data = (parseInt(data.val3) + parseInt(data.val4) + parseInt(data.val5) + parseInt(data.val6)) || 0;
                    return data;
                }
            },{   
                data: null, name: "blNbAgenContNonPerm",
                render: function(data, type, row, meta){
                    data = (parseInt(data.val7) + parseInt(data.val8) + parseInt(data.val9) + parseInt(data.val10) + parseInt(data.val11) + parseInt(data.val12)) || 0;
                    return data;
                }
            },{ 
                data: "blBilasoci", name: "blBilaSoci",
                sortable:false,
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blBilasoci);
                    return rendered;
                }
            },{
                data: "blRast", name: "blRass",
                sortable:false,
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blRast);
                    return rendered;
                }
            },{
                data: "blHand", name: "blHand",
                sortable:false,
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blHand);
                    return rendered;
                }
            },{
                data: "blGpee", name: "blGpee",
                sortable:false,
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blGpee);
                    return rendered;
                }
            },{
                data: "blApa", name: "blApa",
                sortable:false,
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blApa);
                    return rendered;
                }
            },{
                data: "blCons", name: "blCons",
                sortable:false,
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blCons);
                    return rendered;
                }
            },{
                data: "blN4ds", name: "blN4ds",
                sortable:false,
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blN4ds);
                    return rendered;
                }
            },{ 
                data: "blBasecarr", name: "blBaseCarr",
                sortable:false,
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blBasecarr);
                    return rendered;
                }
            },{   
                data: "blBilasocivide", name: "blBilaSociVide",
                sortable:false,
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blBilasocivide);
                    return rendered;
                }
            },
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
        },
        ajax: {
            url : Routing.generate('ajax_get_collectivite'),
            type : 'POST',
            data : function(d){
                var filtres = getFiltreApplied();/*[];
                $('.filtre_applied').each(function(){
                    filtres.push({
                        condition:$(this).find('input[name="condition"]').val(),
                        parametre:$(this).find('input[name="parametre"]').val(),
                        filtre:$(this).find('input[name="filtre"]').val()
                    });
                });*/
                d.filtres = filtres;
            }
        },
        initComplete: function(){
            initColonnes("ANAL",'table-anal-coll');
            initFiltres(false,{
                tardy_add_filtre:function(ok,filtres_elmnts,filtre_params){
                    if(ok){
                        table.ajax.reload();
                    }
                },
                tardy_remove_filtre:function(){
                    table.ajax.reload();
                }
            });
            //hideShowColumn('table-anal-coll');
        },
        fnDrawCallback: function(settings){
            /*var nodes = this.api().column("Selectionner:name").nodes();
            $(nodes).find('input[type="checkbox"]').bootstrapToggle({
                'on' : 'Oui',
                'off' : 'Non',
                'size' : 'small',
            });*/
            var nodes = this.api().rows().nodes();
            var to_bt = $(nodes).find('input[type="checkbox"].to-bt');
            initBoostrapToggle(to_bt);
        },
        drawCallback: function(){
            dtAjustHeader(table);
        },
    });
    /*
    * self toggle
    */
    $(document).on('change','#table-anal-coll .to-bt',function(event){
        dtCheckboxToggle(this,table);
    });
    /*
    *   check all vertical
    */
    $(document).on('click','#table-anal-coll-wrapper .check-all.vertical',function(event){
        event.preventDefault();
        dtSelectAllVertical(this,table);
    })
    $('#afficher-modele').click(function(){
        var ids = [];
        $(':checkbox').each(function(i){
            if($(this).is(':checked')){
                ids[$(this).val()] = 1;
            }else{
                ids[$(this).val()] = 0;
            }
          
        });
        
        $.ajax({
            url: Routing.generate('analyse_modele_affi'),
            method: 'POST',
            data: {'ids': ids},
            success: function (response) {
                if(response == 'ok'){
                    $('#messageJS').removeClass('alert-danger');
                    $('#messageJS').addClass('alert alert-success fade in');
                    $('#messageJS').html("Le paramétrage a été sauvegardé avec succès.");
                }else{
                    $('#messageJS').removeClass('alert-success');
                    $('#messageJS').addClass('alert alert-danger fade in');
                    $('#messageJS').html("Une erreur est survenue, veuillez recommencer.");
                }
                $('#messageJS').show();
            }
        });
    });
    
    $('#table_demande_analyse').DataTable({
        
        columns:[
            {
                data:"collectivite.nmSire", name:"nmSire"
            },{
                data:"collectivite.lbColl", name:"lbLibe"
            },{
                data:"collectivite.departement.cdDepa", name:"lbDepa"
            },{
                data:"lbTypeAnalyse", name:"lbTypeAna"
            },{
                data:"dtCrea.date", name:"dtDeman",
                sortable:true,
                render: function(data, type, row, meta){
                    
                    var rendered = bsDateFormat(data,'short');
                    
                    return rendered;
                }
            },{
                data:"fgStat", name:"lbStat",
                sortable:true,
                render: function(data, type, row, meta){
               
                    if(data == '1'){
                        var rendered = "Envoyé";
                    }else{
                        var rendered = "En attente";
                    }
                    
                    
                    return rendered;
                }
            },{
                data:"fichier", name:"fichier",
                sortable:true,
                render: function(data, type, row, meta){
//                    var rendered = data.fgStat === 1 ? "Répondre":"Télécharger";
                    if(row.fgStat == '1'){
                        url = Routing.generate('fiche_demande_analyse', {'id': row.idDemandeAnalyse });
                        var rendered = "<a href=" + url + ">Détails</a>";
                    }else{
                        url = Routing.generate('fiche_demande_analyse', {'id': row.idDemandeAnalyse });
                        var rendered = "<a href=" + url + ">Répondre</a>";
                    }
                    
                    return rendered;
                }
            },{
                "data": null,
                "render": function (data, type, row, meta) {
                            var data = '<a class="delDemandeAnalyseModalLink" href="#" data-href=' + Routing.generate('analyse_demande_delete', {'id': row.idDemandeAnalyse}) + ' data-id="' + row.idDemandeAnalyse + '" ><span class="glyphicon glyphicon-trash"></span></a>';
                            return data;
                          }
            }
        ],
        ajax: {
            url : Routing.generate('ajax_get_demande_analyse'),
            type : 'POST',
            data : function(d){
                return d;
            }
        },
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
        },
        "createdRow": function(row, data, dataIndex){
            if( data.analyseRead != true && row.fgStat == '0'){
                $(row).css('font-weight', 'bolder');
            }
        }
    });

    /*
    *   sauvegarde d'un modèle d'analyse
    */
    $('#bilan_social_bundle_analysebundle_modeleanalyse_enregistrer').on('click',function(event){
        //event.preventDefault();
        var ids_coll = [];
        //if($('#bilan_social_bundle_analysebundle_modeleanalyse_blAffi').is(':checked')){
            ids_coll = dtGetRowsBySelectedColl(table,'select_affi','idColl');
        /*}else{
            ids_coll = dtGetAllData(table,'idColl');
        }*/
        $('#bilan_social_bundle_analysebundle_modeleanalyse_idColl').val(ids_coll);
        $(this).trigger('submit');
    });

    $(document).on('change', ':file', function () {
        var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        $('#file-select').show();
        $('#name-file').html(label);
        //input.trigger('fileselect', [numFiles, label]);
    });
    
    $('.delete-file').click(function(){
        var fileKey = $(this).attr('id');
        $.ajax({
            url: Routing.generate('remove_analyse_partagee', {'fileKey': fileKey } ),
            method: 'POST',
//            data: {'fileKey': fileKey},
            success: function () {
                location.reload();
            }
        });
    });

    /*
    *   Gestion des colonnes et filtres
    */
    $('#ajouter-colonne').click(function(){
        var colVal = $('#parametrageEnquete_colonnes option:selected').val();
        var colText = $('#parametrageEnquete_colonnes option:selected').text();
        var table = $('.dataTables_scrollBody table').attr('id');
        //var dtTable = $('#' + table).DataTable();
        if(null != colVal || undefined != colVal){
            //indexCol = dtTable.column(colVal+':name').index();
            //dtTable.column( indexCol ).visible( true ).draw();
            $('.col-hidden.col-'+colVal).find('input[type=hidden]:not(input[name*="idEnqucoll"])').val('1');
            $('#liste-colonnes').append('<option value="'+colVal+'">'+colText+'</option>');
            $("#parametrageEnquete_colonnes option[value='"+colVal+"']").remove();
            hideShowColumn(table);
        }
    });
    $('#enlever-colonne').click(function(){
        var colVal = $('#liste-colonnes option:selected').val();
        var colText = $('#liste-colonnes option:selected').text();
        var table = $('.dataTables_scrollBody table').attr('id');
        //var dtTable = $('#' + table).DataTable();
        if(null != colVal || undefined != colVal){
            //indexCol = dtTable.column(colVal+':name').index();
            //dtTable.column( indexCol ).visible( false ).draw();
            $('.col-hidden.col-'+colVal).find('input[type=hidden]:not(input[name*="idEnqucoll"])').val('0');
            $('#parametrageEnquete_colonnes').append('<option value="'+colVal+'">'+colText+'</option>');
            $("#liste-colonnes option[value='"+colVal+"']").remove();
            hideShowColumn(table);
        }
    });

    /*$('#add-filtre').click(function(){
        $('.alert.alert-danger.display-none').hide();
        $('.alert.alert-danger.display-none').find('p').html('');
        var filtre = $('#parametrageEnquete_filtres option:selected').text();
        var filtreVal = $('#parametrageEnquete_filtres').val();
        var condition = $('#parametrageEnquete_conditions option:selected').text();
        var condiVal = $('#parametrageEnquete_conditions').val();
        var parametre = $('#parametres').val();
        if(filtreVal != undefined && condiVal != undefined && parametre != undefined && parametre != null && parametre != ''){
            $('#liste-filtres table').append('<tr class="filtre"><td class="suppr"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td><td>'+filtre+' '+condition+' '+parametre+'</td><td><input type="hidden" name="filtre" value="'+filtreVal+'"></td><td><input type="hidden" name="condition" value="'+condiVal+'"></td><td><input type="hidden" name="parametre" value="'+parametre+'"></td></li>');
            $('#appl-filtre').attr('disabled',false);
            $('#parametrageEnquete_filtres').val('');
            $('#parametrageEnquete_conditions').val('');
            $('#parametres').val('');
        }else{
            $('.alert.alert-danger.display-none').find('p').html('Toutes les conditions ne sont pas remplies, veuillez vérifier.');
            $('.alert.alert-danger.display-none').show();

        }
    });*/
    $('#table_demande_analyse_wrapper').on('click', '.response', function(){
        alert($(this).data('siret'));
    });
});

function initColonnes(vue,table){
    //var removeArr = ['blBilaSoci','blRass','blHand','blGepe','blN4ds','blBilaSociVide','blBaseCarr'];
    var dtTable = $('#' + table).DataTable();
    $.ajax({
        url: Routing.generate('get_model_vue'),
        method: 'POST',
        data: {vue: vue},
        success: function(response){
            var colonnes = response;
            var indexes_col_to_show = [];
            
            $.each(colonnes, function(k,v){
                if(!$.isNumeric(k)){
                    $('.col-'+k).attr('colspan',v);
                }else{
                    var text = $('#parametrageEnquete_colonnes option[value='+v+']').text();
                    var indexCol = dtTable.column(v+':name').index();
                    if(indexCol!=undefined){
                        indexes_col_to_show.push(indexCol);
                    }
                    $('#parametrageEnquete_colonnes option[value='+v+']').remove();
                    //$('#' + table).DataTable().column( indexCol ).visible( true ).draw();
                    $('.col-hidden.col-'+v).find('input[type=hidden]:not(input[name*="idEnqucoll"])').val('1');
                    $('#liste-colonnes').append('<option value="'+v+'">'+text+'</option>');
                }
            });
            dtTable.columns( indexes_col_to_show ).visible( true ).draw();
            
            /*$.each(removeArr, function(k,v){
                $('#liste-colonnes option[value=' + v + ']').remove();
                $('#parametrageEnquete_colonnes option[value=' + v + ']').remove();
                $('#parametrageEnquete_filtres option[value^=' + v + ']').remove();
            });*/

            $('#ajout-colonnes, #param-filtre').show();
            hideShowColumn(table);
        }
    });
}

function hideShowColumn(from_table){
    var dtTable = $('#'+from_table).DataTable();

    var array_hide_columns = [];
    $('#parametrageEnquete_colonnes').find('option').each(function(){
       array_hide_columns.push($(this).val()+":name");
    });
    //$(table).DataTable().columns(array_hide_columns).visible(false, false);
    var array_show_columns = [];
    $('#liste-colonnes').find('option').each(function(){
       array_show_columns.push($(this).val()+":name");
    });
    array_show_columns.push("select:name");
    dtHideShowColumn(dtTable,array_show_columns,array_hide_columns);
    //$(table).DataTable().columns(array_show_columns).visible(true, false);
}


$('#anneecampagne').on('change', function(){
   var anneeCampagne = $(this).val();
    url = Routing.generate('analyse_demande', { 'anneeCampagne' : anneeCampagne });
    window.location = url; 
});

//vérif //
var theHREF;
var idTable;
var theRow;
var idQuestionDelete;

$('#table_demande_analyse').on('click', '.delDemandeAnalyseModalLink', function (e) {
    e.preventDefault();
    idTable             = $(this).parents('table').attr('id');
    theRow              = $(this).closest('tr');
    theHREF             = $(this).attr("data-href");
    idQuestionDelete    = $(this).attr("data-id");
    $("#delDemandeAnalyseModal").modal("show");
});


$("#confirmDelDemandeAnalyseModalNo").click(function (e) {
    $("#delDemandeAnalyseModal").modal("hide");
});
$("#confirmDelDemandeAnalyseModalYes").click(function (e) {
    ajax_delete_demande_analyse(idTable, theRow);
});

function ajax_delete_demande_analyse(idTable, theRow){
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
                console.log('envoye success');
                $("#delDemandeAnalyseModal").modal("hide");
                $('.flash').prepend('<div class="alert alert-success text-center"><strong>'+request.message+'</strong></div>');
                },
        error: function(request){

                }
    });
};