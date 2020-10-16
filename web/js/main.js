$(document).ready(function () {


    $('#inputGenerateDGCL').on('click', function(){
       $(this).prop('disabled', true); 
    });
    
    
    $('.input-disabled input, .input-disabled button, .input-disabled .button-tableau').attr('disabled', true);

    $('.input-date').datepicker({
        language: "fr"
    });


    /* Permet de changer l'intitulé du bouton qui affiche / cache le sidemenu */
    $('.menu-toggle').on('click', function (e) {
        e.preventDefault();
        if ($('#wrapper').hasClass('hide')) {
            $('.menu-toggle').html('<i class="fa fa-angle-double-right" aria-hidden="true"></i> Afficher le menu');
        } else {
            $('.menu-toggle').html('<i class="fa fa-angle-double-left" aria-hidden="true"></i> Cacher le menu');
        }
    })
    jQuery(function ($) {
        $('.carousel').carousel();
        var caption = $('div.item:nth-child(1) .carousel-caption');
        $('.new-caption-area').html(caption.html());
        caption.css('display', 'none');

        $(".carousel").on('slide.bs.carousel', function (evt) {
            var caption = $('div.item:nth-child(' + ($(evt.relatedTarget).index() + 1) + ') .carousel-caption');
            $('.new-caption-area').html(caption.html());
            caption.css('display', 'none');
        });



    });
    /*Affichage d'un modal dans le cas ou la collectivite n'a pas de contact par defaut, ce modal l'invite a aller sur la page des informations collectivite afin de renseigner un contact*/
    $('.blocktoinfocoll').on('click', function(e){
        $('#informationCollectiviteRequired').modal("show");
        e.preventDefault();
    });
    
    
    $(document).change();

    $('#enquete_gestion_form_new').ajaxForm({
        
        url: Routing.generate('enquete_gestion_creation'),
	     error: function(){
                addSpinner($('.content-enquete'),"Une erreur est survenue, Veuillez recharger la page.",true,{'empty': true})
            },
            beforeSubmit: function(){
              addSpinner($('.content-enquete'),"Enregistrement de l'enquête en cours, cela peut durer quelques instants",true,{'empty': true})
            },
	    success:    function(response) { 
                $('.contentConsolide').html(response);
                initFunctionBaseCarriere();
                
	    } 
    });
    var idEnqu = $('#idEnquHidden').val();
    $('#enquete_gestion_form_edit').ajaxForm({
        
        url: Routing.generate('enquete_gestion_edition', {'idEnqu':idEnqu}),
            error: function(){
                addSpinner($('.content-enquete'),"Une erreur est survenue, Veuillez recharger la page.",true,{'empty': true})
            },
            beforeSubmit: function(){
              addSpinner($('.content-enquete'),"Enregistrement de l'enquête en cours, cela peut durer quelques instants",true,{'empty': true})
            },
	    success:    function(response) { 
                $('.contentConsolide').html(response);
                initFunctionBaseCarriere();
                
	    } 
    });
    
    $(document).on('click','#gestion_enquete_coll', function(){
        $.ajax({
            url: Routing.generate('enquete_modifier'),
            method: 'POST',
            async: true,
            beforeSend : function(){
                addSpinner($('.content-enquete'),"Le contenu est en cours de chargement",true,{'empty': true})
            },
            success: function (response) {
                $('.contentConsolide').html(response);
                setGlobalVar('idEnqu', $('#idEnquHidden').val());
                initFunctionParametrageEnquete();
                
            },
            complete: function(){

            }

        });
    });
});
function initFunctionBaseCarriere(){
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
}
function initFunctionParametrageEnquete(){
    $('#back_to_bcimport').on('click', function(){
         $.ajax({
           url: Routing.generate('import_bc'),
	    success:    function(response) { 
                $('.contentConsolide').html(response);
                initFunctionBaseCarriere();
                
	    } 
        });
    });
    $('.modifierJson').click(function(){
        //var params = essai1.$('input').serializeArray();
        //console.log('debut : ' + new Date());
        $('.lazy_loading_save').removeClass("hidden");
        setTimeout(function(){

            var blBilaSociHash = {};
            var blRassHash = {};
            var blHandHash = {};
            var blGepeHash = {};
            var blGpeecPlusHash = {};
            var blApaHash = {};
            var blConsHash = {};
            var blN4dsHash = {};
            var blBaseCarrHash = {};
            var blBilaSociVideHash = {};
            var blDgclHash = {};

            var enquCollIdHash = {};
            
            
            
            var dt_data = dtGetAllData(essai1);

            //console.log('serialize : ' + new Date());

            // Iterate over all form elements
            $.each(dt_data, function(){
               // If element doesn't exist in DOM
                var data = this;
                var idColl = data.idColl;
                blBilaSociHash[idColl] = data.blBilasoci==1 ? 'on' : undefined;
                blRassHash[idColl] = data.blRast==1 ? 'on' : undefined;
                blHandHash[idColl] = data.blHand==1 ? 'on' : undefined;
                blGepeHash[idColl] = data.blGepe==1 ? 'on' : undefined;
                blGpeecPlusHash[idColl] = data.blGpeecPlus==1 ? 'on' : undefined;
                blApaHash[idColl] = data.blApa==1 ? 'on' : undefined;
                blConsHash[idColl] = data.blCons==1 ? 'on' : undefined;
                blN4dsHash[idColl] = data.blN4ds==1 ? 'on' : undefined;
                blBaseCarrHash[idColl] = data.blBasecarr==1 ? 'on' : undefined;
                blBilaSociVideHash[idColl] = data.blBilasocivide==1 ? 'on' : undefined;
                blDgclHash[idColl] = data.blDgcl==1 ? 'on' : undefined;
                enquCollIdHash[idColl] = data.idEnqucoll;
            

            });
            var idEnqu = getGlobalVar('idEnqu');
            var json = '"idEnquete":"'+idEnqu+'","enqueteCollList": [';

            for (var idColl in enquCollIdHash) {
                var idEnquColl = enquCollIdHash[idColl];

                var val1 = blBilaSociHash[idColl];
                var val2 = blRassHash[idColl];
                var val3 = blHandHash[idColl];
                var val4 = blGepeHash[idColl];
                var val5 = blGpeecPlusHash[idColl];
                var val6 = blApaHash[idColl];
                var val7 = blConsHash[idColl];
                var val8 = blN4dsHash[idColl];
                var val9 = blBaseCarrHash[idColl];
                var val10 = blBilaSociVideHash[idColl];
                var val11 = blDgclHash[idColl];

                val1 = (val1 == undefined || val1===0 ? 0 : 1);
                val2 = (val2 == undefined || val2===0 ? 0 : 1);
                val3 = (val3 == undefined || val3===0 ? 0 : 1);
                val4 = (val4 == undefined || val4===0 ? 0 : 1);
                val5 = (val5 == undefined || val5===0 ? 0 : 1);
                val6 = (val6 == undefined || val6===0 ? 0 : 1);
                val7 = (val7 == undefined || val7===0 ? 0 : 1);
                val8 = (val8 == undefined || val8===0 ? 0 : 1);
                val9 = (val9 == undefined || val9===0 ? 0 : 1);
                val10 = (val10 == undefined || val10===0 ? 0 : 1);
                val11 = (val11 == undefined || val11===0 ? 0 : 1);

                var valeur = val1 + "|" + val2+ "|" + val3+ "|" + val4+ "|" + val5+ "|" + val6+ "|" + val7+ "|" + val8+ "|" + val9+ "|" + val10 + "|" + val11;

                json += '{"idEnquColl":"'+idEnquColl+'","idColl":"'+idColl+'","valeur":"'+valeur+'"},'
                        ;
            }

            if(json!="") json = json.substr(0, json.length-1);
            json += ']';
            json = "{" + json + "}";

            //console.log('json ok : ' + new Date());

            $.ajax({
                type: 'POST',
                url: Routing.generate('save_enquete_collectivite'),
                data:{
                    data: json
                },
                success: function (response) {
                    var responsejson = JSON.parse(response);
                    if (responsejson.data == "1") {
                        $('#messageJS').html("L'enquête a été modifiée");
                        messageJS.dialog("open");
                        setTimeout(function(){
                            window.location.href = Routing.generate('enquete_homepage');
                        }, 2000);
                    } else {
                        $('#messageJS').html("Oups, une erreur s'est produite.");
                        messageJS.dialog("open");
                    }
                },
                error: function (xhr, status, error) {
                   alert(xhr);
                }

            });
        }, 1000);
    });
    
    var messageJS = $("#messageJS").dialog({
        autoOpen: false,
        resizable: true,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "OK": function () {
                messageJS.dialog("close");
            }
        },
        open: function (event, ui) {
            setTimeout(function () {
                messageJS.dialog("close");
            }, 3000);
        },
        close: function () {
        }
    });
    
    var essai1 = $('#essai').DataTable({
        "processing": false,
        "serverSide": false,
        "aaSorting": [],
        deferRender: true,
        "columns": [
            { "data": "lbTypeColl", name: "blTypeColl"  },
            { "data": "lbDepa", name: "blDepa"  },
            { "data": "lbAdre", name: "blLbAdresse"  },
            { "data": "lbColl", name: "blLibe"  },
            { "data": "cdPost", name: "blCdPost"  },
            { "data": "lbVill", name: "blLbVill"  },
            { "data": "cdInse", name: "blCdInse"  },
            { "data": "nmSire", name:"blSire" },
            { "data": "nmPopuInse", name: "blNmPopuInse"  },
            { 
                data: null, name: "blSurclasDemo",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blSurclasDemo);
                    return rendered; 
                }
            },
            { "data": "nmStratColl", name: "blNmStratColl"  },
            { 
                data: null, name: "blAffiCdg",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blAffiColl);
                    return rendered; 
                }  
            },{ 
                data: null , name: "blCtCdg",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blCtCdg);
                    return rendered;    
                }
            },{ 
                data: null, name: "blChsct",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blChsct);
                    return rendered; 
                }
            },{
                data: null, name: "blCollDgcl",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blCollDgcl);
                    return rendered; 
                }
            },{
                data: null, name: "blCourtier",
                render: function(data, type, row, meta){
                    var render = "";
                    if(row.courtier !== undefined && row.courtier !== ""){
                        render = row.courtier;
                    }
                    return render;
                }
            },{
                data: null, name: "cdg_is_authorized_by_collectivity",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.cdg_is_authorized_by_collectivity);
                    return rendered; 
                }
            },{ 
                data: null, name: "blNbAgenPerm",
                render: function(data, type, row, meta){
                    if(data.NbAgenPerm === null){
                        return 0;
                    }
                    return data.NbAgenPerm;
                }
            },{ 
                data: null, name: "blNbAgenTitu",
                render: function(data, type, row, meta){
                    if(data.NbAgenPerm === null){
                        return 0;
                    }
                    return data.NbAgenTitu;
                }
            },{ 
                data: null, name: "blNbAgenContPerm",
                render: function(data, type, row, meta){
                    if(data.NbAgenPerm === null){
                        return 0;
                    }
                    return data.NbAgenContPerm;
                }
            },{ 
                data: null, name: "blNbAgenContNonPerm",
                render: function(data, type, row, meta){
                    if(data.NbAgenPerm === null){
                        return 0;
                    }
                    return data.NbAgenContNonPerm;
                }
            },
            { 
                data: null, name: "toutCocher",
                sortable: false,
                render: function(data, type, row, meta){
                    var btn_attr = {
                        id: row.idColl,
                        class: "check-all all btn btn-sm"
                    }
                    var button = createButton("Tous",btn_attr);
                    var input_attr = {
                        name: row.idColl+'_idEnqucoll',
                        value: row.idEnqucoll
                    }
                    var input = createInputHidden(input_attr);
                    //data = '<button class="check-all all btn btn-sm" id="'+data.idColl+'">Tous</button> <input type="hidden" name="'+data.idColl+'_idEnqucoll" value="'+data.idEnqucoll+'">';
                    var rendered = $(button).prop('outerHTML')+$(input).prop('outerHTML');
                    return rendered;
                }
            },{ 
                data: "blBilasoci", name: "blBilaSoci",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blBilasoci == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blBilasoci',
                        class:'blBilaSoci to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            },{
                data: "blRast", name: "blRast",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blRast == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blRast',
                        class:'blRast to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            },{
                data: "blHand", name: "blHand",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blHand == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blHand',
                        class:'blHand to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            },{
                data: "blGepe", name: "blGpee",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blGepe == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blGpee',
                        class:'blGepe to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            },
            {
                data: "blGpeecPlus", name: "blGpeecPlus",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blGpeecPlus == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blGpeecPlus',
                        class:'blGpeecPlus to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            }
            ,{
                data: "blApa", name: "blApa",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blApa == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blApa',
                        class:'blApa to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            },{
                data: "blCons", name: "blCons",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blCons == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blCons',
                        class:'blCons to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            },{
                data: "blN4ds", name: "blN4ds",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blN4ds == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blN4ds',
                        class:'blN4ds to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            },{ 
                data: "blBasecarr", name: "blBaseCarr",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blBasecarr == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blBaseCarr',
                        class:'blBaseCarr to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            },{   
                data: "blBilasocivide", name: "blBilaSociVide",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blBilasocivide == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blBilasocivide',
                        class:'blBilaSociVide to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            },{   
                data: "blDgcl", name: "blDgcl",
                sortable:false,
                render: function(data, type, row, meta){
                    var checked = row.blDgcl == true;
                    var attr = {
                        checked:checked,
                        name:row.idColl+'_blDgcl',
                        class:'blDgcl to-bt'
                    }
                    var rendered = dtcreateCheckbox(attr);
                    return rendered;
                }
            }
        ],
        language: languageDataTable,
        ajax :{
            url : Routing.generate('ajax_get_enquete_collectivite'),
            type : 'POST',
            data : function(d){
                var filtres = getFiltreApplied();
                d.filtres = filtres;
            },
        },
        initComplete: function(settings, json) {
            var rows = essai1.rows({ 'search': 'applied' }).nodes();
            var currentdate = new Date(); 
            var datetime = "Last Sync: " + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/" 
                + currentdate.getFullYear() + " @ "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
//            console.log(datetime);
            initColonnes('ENQU','essai');
            initFiltres(false,{
                tardy_add_filtre:function(ok,filtres_elmnts,filtre_params){
                    if(ok){
                        essai1.ajax.reload();
                    }
                },
                tardy_remove_filtre:function(){
                    essai1.ajax.reload();
                }
            });
            setTimeout(function(){
                $('.lazy_loading').hide();
                $('.loadingTable').show();
                $(".col-blTypeColl").trigger("click");
            }, 2000);
            $('.table-hover').closest('.col-sm-12').css('overflow-x', 'auto');
        },
        fnDrawCallback: function(settings){
            var nodes = this.api().rows().nodes();
            var to_bt = $(nodes).find('input[type="checkbox"].to-bt');
            initBoostrapToggle(to_bt);
        },
        drawCallback: function(){
            essai1.columns.adjust().draw();
        },
        scrollY: "80vh",
        scrollX: "80vw",
        scrollCollapse: true,
    });

    $('#essai_wrapper').on('change','#essai .to-bt',function(event){
        dtCheckboxToggle(this,essai1);
        if($(this).is(".blGpeecPlus")) {
            var name = $(this).attr('name');
            var id = name.substr(0, name.indexOf('_'));
            var btn = $('input[name="'+id+'_blGpee"]');
            if($(this).prop('checked') == true) {
                $(btn).prop('checked', true).change();
            }
        }
        if($(this).is(".blGepe")) {
            var name = $(this).attr('name');
            var id = name.substr(0, name.indexOf('_'));
            var btn = $('input[name="'+id+'_blGpeecPlus"]');
            if($(this).prop('checked') == false) {
                $(btn).prop('checked', false).change();
            }
        }
    });
    $('#essai_wrapper').on('click','.check-all:not(.vertical)',function(event){
        event.preventDefault();
        dtSelectAllHorizontal(this,essai1);
    });
    $('#essai_wrapper .check-all.vertical').on('click',function(event){
        event.preventDefault();
        dtSelectAllVertical(this,essai1);
        if($(this).is("#blGpeecPlus")) {
            if(!$(this).hasClass('all')) {
                $('#blGpee').trigger('click');
            }
        }
        if($(this).is("#blGpee")) {
            if($(this).hasClass('all')) {
                $('#blGpeecPlus').trigger('click');
            }
        }
    });

    $('#ajouter-colonne').click(function(){
        var colVal = $('#parametrageEnquete_colonnes option:selected').val();
        var colText = $('#parametrageEnquete_colonnes option:selected').text();
        var table = $('.dataTables_scrollBody table').attr('id');
        if(null != colVal || undefined != colVal){
            //indexCol = $('#' + table).DataTable().column(colVal+':name').index();
            //$('#' + table).DataTable().column( indexCol ).visible( true ).draw();
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
        if(null != colVal || undefined != colVal){
            //indexCol = $('#' + table).DataTable().column(colVal+':name').index();
            //$('#' + table).DataTable().column( indexCol ).visible( false ).draw();
            $('.col-hidden.col-'+colVal).find('input[type=hidden]:not(input[name*="idEnqucoll"])').val('0');
            $('#parametrageEnquete_colonnes').append('<option value="'+colVal+'">'+colText+'</option>');
            $("#liste-colonnes option[value='"+colVal+"']").remove();
            hideShowColumn(table);
        }
    });
}
function initColonnes(vue,table){
    var removeArr = ['fgStat', 'fgStat-28'];
    var removeSuivi = ['blBilaSoci','blN4ds','blBilaSociVide','blBaseCarr', 'LB_ETAT_SAIS-15', 'blNbAgenPerm-24', 'blNbAgenTitu-25', 'blNbAgenContPerm-26', 'blNbAgenContNonPerm-27'];
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
            if(table == 'suivi'){
                $.each(removeSuivi, function(k,v){
                    $('#liste-colonnes option[value=' + v + ']').remove();
                    $('#parametrageEnquete_colonnes option[value=' + v + ']').remove();
                    $('#parametrageEnquete_filtres option[value^=' + v + ']').remove();
                });
            }
            if(table == 'essai') {
                $.each(removeArr, function(k,v){
                    $('#liste-colonnes option[value=' + v + ']').remove();
                    $('#parametrageEnquete_colonnes option[value=' + v + ']').remove();
                    $('#parametrageEnquete_filtres option[value^=' + v + ']').remove();
                });
            }
            //$('#'+table).show();
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
    //$(table).DataTable().columns(array_show_columns).visible(false, false);
    var array_show_columns = [];
    $('#liste-colonnes').find('option').each(function(){
       array_show_columns.push($(this).val()+":name");
    });
    // console.log(from_table);

    if(from_table === "#suivi"){
        array_show_columns.push("relance:name");
        array_show_columns.push("export:name");
        array_show_columns.push("cons:name");
        array_show_columns.push("apa:name");
        array_show_columns.push("dtLastconn:name");
    }else{
         array_show_columns.push("toutCocher:name");
    }

    //$(table).DataTable().columns(array_show_columns).visible(true, false);
    dtHideShowColumn(dtTable,array_show_columns,array_hide_columns);
    }
function changePasswordProgressBar(ev) {
    // less than 8 characters
    var wrost = 7,
        // minimum 8 characters
        //nbLetterMdp
        bad = "(?=.{nb,}).*",
        //Alpha Numeric plus minimum 8
        good = "^(?=\\S*?[a-z])(?=\\S*?[0-9])\\S{nb,}$",
        //Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
        better = "^(?=\\S*?[A-Z])(?=\\S*?[a-z])((?=\\S*?[0-9])|(?=\\S*?[^w]))S{nb,}$",
        //Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
        best = "^(?=\\S*?[A-Z])(?=\\S*?[a-z])(?=\\S*?[0-9])(?=\\S*?[^w])\\S{nb,}$",
        password = $(ev.target).val(),
        strength = '0',
        progressClass = 'progress-bar progress-bar-',
        ariaMsg = '0% Complete (danger)',
        $progressBarElement = $('#password-progress-bar');
   // var bad = new RegExp(bad.toString().replace('nb', nbLetterMdp));
    var bad = new RegExp(bad.replace('nb', nbLetterMdp));
    //var good = new RegExp(good.toString().replace('nb', nbLetterMdp));
    var good = new RegExp(good.replace('nb', nbLetterMdp));
    //var better = new RegExp(better.toString().replace('nb', nbLetterMdp));
    var better = new RegExp(better.replace('nb', nbLetterMdp));
    //var best = new RegExp(best.toString().replace('nb', nbLetterMdp));
    var best = new RegExp(best.replace('nb', nbLetterMdp));

    if (best.test(password) === true) {
        strength = '100%';
        progressClass += 'success';
        ariaMsg = '100% Complete (success)';
    } else if (better.test(password) === true) {
        strength = '80%';
        progressClass += 'info';
        ariaMsg = '80% Complete (info)';
    } else if (good.test(password) === true) {
        strength = '50%';
        progressClass += 'warning';
        ariaMsg = '50% Complete (warning)';
    } else if (bad.test(password) === true) {
        strength = '30%';
        progressClass += 'warning';
        ariaMsg = '30% Complete (warning)';
    } else if (password.length >= 1 && password.length <= wrost) {
        strength = '10%';
        progressClass += 'danger';
        ariaMsg = '10% Complete (danger)';
    } else if (password.length < 1) {
        strength = '0';
        progressClass += 'danger';
        ariaMsg = '0% Complete (danger)';
    }

    $progressBarElement.removeClass().addClass(progressClass);
    $progressBarElement.attr('aria-valuenow', strength);
    $progressBarElement.css('width', strength);
    $progressBarElement.find('span.sr-only').text(ariaMsg);
}
function reload_js(src) {
    $('script[src="' + src + '"]').remove();
    $('<script>').attr('src', src).appendTo('head');
}
$(document).on('click','#infosEnquete_departements input', function(){

       var clicked_input_group = $(this).data('group');
       var is_checked = $(this).is(':checked');
       if(!isEmpty(clicked_input_group)){
           $(this).parents('#infosEnquete_departements').find('input[data-group="'+clicked_input_group+'"]').prop('checked',is_checked);
       }
    });
$('.unlockCollectivite').on('click', function(){
    var idUtil = $(this).val();
    waitForDownload('downloadMdp',null,null,function(){
        window.location.href = Routing.generate('collectivite_bloque');
    });
    var link = createElement('a','',{'id':'mdp','href':Routing.generate('unlock_Account', {idUtil: idUtil}),'class':'hidden','download':'download'}).get(0);
    $('body').append(link);
    $(link).get(0).click();
    $(link).remove();
  
});
