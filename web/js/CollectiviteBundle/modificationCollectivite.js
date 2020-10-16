$(document).ready(function () {
     $('#err-format').hide();
     $('#alert-err').hide();
    
    $('.toggle-bs').bootstrapToggle({
        on: 'Oui',
        off: 'Non'
    });
    $('[data-toggle="tooltip"]').tooltip();
    var table_modif_masse;

    $('div.custom-checkbox > div > label > input').each(function () {
        $(this).attr('type','checkbox');
    });

    $('#import-masse-coll').click(function(e){
        if($('#name-file').text() == ""){e.preventDefault(); return false;};
        $('#table-modif-mass-wrapper').hide();
        $('#table-modif-mass').DataTable().destroy();
        var formData = new FormData();
        var file_data = $('#form_importCollectivite').prop('files')[0];
        formData.append('file', file_data);
        $.ajax({
            url: Routing.generate('enquete_importmassecoll'),
            dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            deferRender: true,
            data: formData,
            type: 'post',
            success:function(data){
                /*console.log(data);*/
                if(data['code'] == undefined && data.erreur !== true){
                    $('#alert-err').hide();
                    $('#err-format').hide();
                   
                   
                    table_modif_masse = $('#table-modif-mass').DataTable({
                        data: data,
                        "columns": [
                              {data: "modifier", name: "modifier",
                                sortable:false,
                                render: function(data, type, row, meta){
                                    var checked = row.modifier == true;
                                    var attr = {
                                        checked:checked,
                                        name:row.idColl+'_modifier',
                                        class:'modifier to-bt'
                                    }
                                    var rendered = dtcreateCheckbox(attr);
                                    return rendered;
                                }
                            },
                              {data: "nmSire", name: "nmSire",
                                sortable:false,
                                render: function(data, type, row, meta){
                                    return data;
                                }
                            },
                            {data: "nmStratColl", name: "nmStratColl",
                                sortable:false,
                                render: function(data, type, row, meta){
                                    if(data === null){data = ''};
                                    var attr = {
                                        value: data,
                                        name:row.idColl+'_nmStratColl',
                                        class:'nmStratColl'
                                    }
                                    var rendered = createInputText(attr,{},{returnFormat : 'text', constraints : { "isNull" : "" }});
                                    return rendered;
                                }
                            },
                            {data: "allhorizontal", name: "allhorizontal",
                                sortable:false,
                                render: function(data, type, row, meta){
                                    var btn_attr = {
                                        id: row.idColl,
                                        class: "check-all all btn btn-sm"
                                    }
                                    var rendered = createButton("Tous",btn_attr,{},{returnFormat : 'text'} );
                                    return rendered;
                                }
                            },
                            {data: "blSurclasDemo", name: "blSurclasDemo",
                                sortable:false,
                                render: function(data, type, row, meta){
                                    var checked = row.blSurclasDemo == true;
                                    var attr = {
                                        checked:checked,
                                        name:row.idColl+'_blSurclasDemo',
                                        class:'blSurclasDemo to-bt'
                                    }
                                    var rendered = dtcreateCheckbox(attr);
                                    return rendered;
                                }
                            },
                            {data: "blAffiColl", name: "blAffiColl",
                                sortable:false,
                                render: function(data, type, row, meta){
                                    var checked = row.blAffiColl == true;
                                    var attr = {
                                        checked:checked,
                                        name:row.idColl+'_blAffiColl',
                                        class:'blAffiColl to-bt'
                                    }
                                    var rendered = dtcreateCheckbox(attr);
                                    return rendered;
                                }
                            },
                            {data: "blCtCdg", name: "blCtCdg",
                                sortable:false,
                                render: function(data, type, row, meta){
                                    var checked = row.blCtCdg == true;
                                    var attr = {
                                        checked:checked,
                                        name:row.idColl+'_blCtCdg',
                                        class:'blCtCdg to-bt'
                                    }
                                    var rendered = dtcreateCheckbox(attr);
                                    return rendered;
                                }
                            },
                            {data: "blChsct", name: "blChsct",
                                sortable:false,
                                render: function(data, type, row, meta){
                                    var checked = row.blChsct == true;
                                    var attr = {
                                        checked:checked,
                                        name:row.idColl+'_blChsct',
                                        class:'blChsct to-bt'
                                    }
                                    var rendered = dtcreateCheckbox(attr);
                                    return rendered;
                                }
                            },
                            
                        ],
                        language: languageDataTable,
                        initComplete: function(settings, json) {
                            //var rows = essai1.rows({ 'search': 'applied' }).nodes();
                            var currentdate = new Date(); 
                            var datetime = "Last Sync: " + currentdate.getDate() + "/"
                                + (currentdate.getMonth()+1)  + "/" 
                                + currentdate.getFullYear() + " @ "  
                                + currentdate.getHours() + ":"  
                                + currentdate.getMinutes() + ":" 
                                + currentdate.getSeconds();
                //            console.log(datetime);
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
                            var to_blur = $(nodes).find('input.nmStratColl');
                            initBoostrapToggle(to_bt);
                            initBlurEvent(to_blur, this.api() );
                        }
                    });

                    $('#table-modif-mass-wrapper').show();
                 }else if(data.erreur === true){
                    $('#err-format').html( data.message);
                    $('#alert-err').hide();
                    $('#err-format').show();
                    }else{
                    $('#err-format').hide();
                    $('#list-err').html('');
                    $('#table-modif-mass-wrapper').hide();
                    var err = data['sirets'];
                    $.each(err,function(k,v){
                        $('#list-err').append('<li>'+v+'</li>');
                    });
                    $('#alert-err').show();
                }
            },
        });
        e.preventDefault();
        
       
    });
    
    $('#table-modif-mass-wrapper').on('change','.to-bt',function(event){
        dtCheckboxToggle(this,table_modif_masse);
    });
    $('#table-modif-mass-wrapper .check-all.vertical').on('click',function(event){
        event.preventDefault();
        dtSelectAllVertical(this,table_modif_masse);
    });
    $('#table-modif-mass-wrapper').on('click','.check-all:not(.vertical)',function(event){
        event.preventDefault();
        dtSelectAllHorizontal(this,table_modif_masse);
    });
    
    $(document).on('click', '#modif-masse', function(e){
        $('#messageJS').hide();
        var checked = dtGetRowsBySelectedColl(table_modif_masse, 'modifier' );
        
        /*console.log(checked);*/
        if(checked.length > 0){
            $.ajax({
                url: Routing.generate('collectivite_modification_masse'),
                method: 'POST',
                data: {checked : checked},
                async: true,
                success: function (response) {
                    var url = Routing.generate('collectivite_modification_masse_import');
                    window.location= url;
                }
            });
            e.preventDefault();
        }else{
            $('#messageJS').removeClass('alert-success');
            $('#messageJS').addClass('alert-danger');
            $('#messageJS').html("Veuillez sélectionner les collectivités à modifier.");
            $('#messageJS').show();
            e.preventDefault();

        }
    });
    
    var depa = $('#bilan_social_bundle_collectivitebundle_collectivite_departement').val();
    if(depa != '' || depa != undefined){
        getCdg(depa);
    }
    $('form[name="bilan_social_bundle_collectivitebundle_collectivite"]').submit(function (e) {
        $(document).change();
        var url = window.location.href;
        if(url.indexOf("edit") >= 0){
            var inputRadio = $('.form8').find('input:radio');
            var NbInput = inputRadio.length;
            var NbNoChecked = 0;
            var NbTr = $('.form8').find('tr');
            $(inputRadio).each(function () {
                if ($(this).is(':checked') === false) {
                    NbNoChecked += 1;
                }
            });
            if (NbTr.length !== 0) {
                if (NbInput == NbNoChecked) {
                    alert('Aucun contact par défaut selectionné');
                    e.preventDefault();
                }
            }else{
                alert('Un contact par défaut doit être renseigné.');
                e.preventDefault();
            }
        }
    });

    $('input[id^="bilan_social_bundle_collectivitebundle_cdg_contacts"]').attr('readonly', true);
    var inputRadioCdg = $('.form8-cdg').find('input:radio');
    $(inputRadioCdg).on('click', function (e) {
        e.preventDefault()
    });
//    $('.col-hidden').hide();
    // afficher ou non chsct dans modif compte collectivite
    var blCtCdg = $('#bilan_social_bundle_collectivitebundle_collectivite_blCtCdg').prop('checked');
    initForm(blCtCdg,'edit');
    $('#bilan_social_bundle_collectivitebundle_collectivite_blCtCdg').change(function () {
        var blCtCdg = $(this).prop('checked');
        initForm(blCtCdg,'edit');
    });

    var blCtCdgFiche = $('input[name="bilan_social_bundle_collectivitebundle_collectivite[blCtCdg]"]:checked').val();
    initForm(blCtCdgFiche,'fiche');
    $('input[name="bilan_social_bundle_collectivitebundle_collectivite[blCtCdg]"]').click(function () {
        var blCtCdgFiche = $(this).val();
        initForm(blCtCdgFiche,'fiche');
    });
    
    $('#bilan_social_bundle_collectivitebundle_collectivite_blSurclasDemo, #bilan_social_bundle_collectivitebundle_collectivite_refTypeCollectivite').change(function () {
        var $html = '';
        var current_select_option = '';
        var blSurClassDemo = $('#bilan_social_bundle_collectivitebundle_collectivite_blSurclasDemo').prop('checked');
        $('#bilan_social_bundle_collectivitebundle_collectivite_blSurclasDemo').bootstrapToggle('enable');
        if(blSurClassDemo == false){
            $('.surclassdemo').addClass('hidden');
            $('#bilan_social_bundle_collectivitebundle_collectivite_nmSurclasDemo').val('');
        }else{
           $('.surclassdemo').removeClass('hidden');
           var id_type_coll = $('#bilan_social_bundle_collectivitebundle_collectivite_refTypeCollectivite').val();
           
           $.ajax({
            url: Routing.generate('get_surclass_demo_by_reftypecoll', {'idTypeColl' : id_type_coll}),
            method: 'POST',
            success: function (response) {
                
                 current_select_option = $('#bilan_social_bundle_collectivitebundle_collectivite_refTypeSurclassDemo :selected').val();
                
                /*console.log(current_select_option);*/
                    if(response.count == false){
                        /*BTN TOGGLE TO OFF ICI*/
                        $('#bilan_social_bundle_collectivitebundle_collectivite_blSurclasDemo').bootstrapToggle('off').bootstrapToggle('disable');
                        
                        
                        $('.surclassdemo').addClass('hidden');
                        $("#bilan_social_bundle_collectivitebundle_collectivite_refTypeSurclassDemo").html('');
                    }else if(response.count == true){
                        
                        $.each(response.list, function (key, value) {
                            if(current_select_option !== '' && key === current_select_option){
                                $html += "<option value='" + key + "' selected>" + value + "</option>";
                            }
                            $html += "<option value='" + key + "'>" + value + "</option>";
                        });
                        $("#bilan_social_bundle_collectivitebundle_collectivite_refTypeSurclassDemo").html($html);
                    }
                }
              
            });
        };
        
    });
    $('#bilan_social_bundle_collectivitebundle_collectivite_blSurclasDemo').trigger('change');
//    
//    var table_rech = $('#table-rech-coll').DataTable({
//        "order": [],
//        "columns": [
//            {"sortable": true, "name": "blSire", "visible": false},
//            {"sortable": true, "name": "blLibe", "visible": false},
//            {"sortable": true, "name": "blTypeColl", "visible": false},
//            {"sortable": true, "name": "blAffiCdg", "visible": false},
//            {"sortable": true, "name": "blDepa", "visible": false},
//            {"sortable": true, "name": "blCdPost", "visible": false},
//            {"sortable": true, "name": "blLbVill", "visible": false},
//            {"sortable": true, "name": "blCdInse", "visible": false},
//            {"sortable": true, "name": "blNmPopuInse", "visible": false},
//            {"sortable": true, "name": "blSurclasDemo", "visible": false},
//            {"sortable": true, "name": "blNmStratColl", "visible": false},
//            {"sortable": true, "name": "blCtCdg", "visible": false},
//            {"sortable": true, "name": "blChsct", "visible": false},
//            {"sortable": true, "name": "blCollDgcl", "visible": false},
//            {"sortable": true, "name": "blCdgColl", "visible": false},
//            {"sortable":true, "name": "blNbAgenPerm", "visible": false},
//            {"sortable":true, "name": "blNbAgenTitu", "visible": false},
//            {"sortable":true, "name": "blNbAgenContPerm", "visible": false},
//            {"sortable":true, "name": "blNbAgenContNonPerm", "visible": false},
//        ],
//        language: {
//            processing: "Traitement en cours...",
//            search: "Rechercher&nbsp;:",
//            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
//            info: "Affichage collectivit&eacute; _START_ &agrave; _END_ sur _TOTAL_ collectivit&eacute;s",
//            infoEmpty: "Affichage collectivit&eacute; 0 &agrave; 0 sur 0 collectivit&eacute;s",
//            infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
//            infoPostFix: "",
//            loadingRecords: "Chargement en cours...",
//            zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
//            emptyTable: "Aucune donnée disponible dans le tableau",
//            paginate: {
//                first: "Premier",
//                previous: "Pr&eacute;c&eacute;dent",
//                next: "Suivant",
//                last: "Dernier"
//            },
//            aria: {
//                sortAscending: ": activer pour trier la colonne par ordre croissant",
//                sortDescending: ": activer pour trier la colonne par ordre décroissant"
//            }
//        },
//        "initComplete": function(){
//            initColonnes('RECH','table-rech-coll')
//        },
//    });

    var table_rech = $('#table-rech-coll').DataTable({
        processing: false,
        serverSide: false,
        deferRender: true,
        columns: [
            { "data": "nmSire", name:"blSire" },
            { "data": "lbColl", name: "blLibe"  },
            { "data": "lbMail", name: "lbMail"  },
            { "data": "lbPassTemp", name: "lbPassTemp"  },
            { "data": "lbTypeColl", name: "blTypeColl"  },
            {
                data: null, name: "blAffiCdg", 
                render: function(data, type, row, meta){
                    if(data.blAffiColl === true){
                            data = "Oui";
                        }else if(data.blAffiColl === false){
                            data = "Non";
                        }else{
                            data = "Non renseigné";
                        }
                        return data;
                }
            },
            { "data": "lbAdre", name: "blLbAdresse" },
            { "data": "lbDepa", name: "blDepa"  },
            { "data": "cdPost", name: "blCdPost" },
            { "data": "lbVill", name: "blLbVill" },
            { "data": "cdInse", name: "cdInse"  },
            { "data": "nmPopuInse", name: "blNmPopuInse"  },
            //{ "data": "blSurclasDemo", name: "blSurclasDemo"  },
            { 
                data: null, name: "blSurclasDemo", 
                render: function(data, type, row, meta){
                    if(data.blSurclasDemo === true){
                        data = "Oui";
                    }else if(data.blSurclasDemo === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
                } 
            },
            { "data": "nmStratColl", name: "blNmStratColl"  },
            {   
                data: null, name: "blCtCdg",  
                render: function(data, type, row, meta){
                    if(data.blCtCdg === true){
                        data = "Oui";
                    }else if(data.blCtCdg === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
                }
            },
            {   
                data: null, name: "blChsct",  
                render: function(data, type, row, meta){
                    if(data.blChsct === true){
                        data = "Oui";
                    }else if(data.blChsct === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
                }
            },
            {   
                data: null, name: "blCollDgcl",
                render: function(data, type, row, meta){
                    if(data.blCollDgcl === true){
                        data = "Oui";
                    }else if(data.blCollDgcl === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
                }
            },
            {
                data: null, name: "cdg_is_authorized_by_collectivity",  
                render: function(data, type, row, meta){
                    if(data.cdg_is_authorized_by_collectivity === true){
                        data = "Oui";
                    }else if(data.cdg_is_authorized_by_collectivity === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
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
                    if(data.NbAgenTitu === null){
                        return 0;
                    }
                    return data.NbAgenTitu;
                }
            },{
                data: null, name: "blNbAgenContPerm",
                    render: function(data, type, row, meta){
                    if(data.NbAgenContPerm === null){
                        return 0;
                    }
                    return data.NbAgenContPerm;
                }
            },{
                data: null, name: "blNbAgenContNonPerm",
                    render: function(data, type, row, meta){
                    if(data.NbAgenContNonPerm === null){
                        return 0;
                    }
                    return data.NbAgenContNonPerm;
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
        ajax :{
            url : Routing.generate('ajax_get_collectivite'),
            "type" : 'POST',
//            "data" : function(d){
            "data" : function(d){
                var filtres = getFiltreApplied();
                d.filtres = filtres;
            },
//                var filtres = [];
//                $('.filtre_applied').each(function(){
//                    filtres.push({
//                        condition:$(this).find('input[name="condition"]').val(),
//                        parametre:$(this).find('input[name="parametre"]').val(),
//                        filtre:$(this).find('input[name="filtre"]').val()
//                    });
//                });
//                d.filtres = filtres;
//            },
                    
        },
        "initComplete": function(settings, json) {
            hideShowColumn('#table-rech-coll');
            initColonnes('RECH','table-rech-coll');
//           
            $('.table-hover').closest('.col-sm-12').css('overflow-x', 'auto');
        },
        fnInitComplete: function(){
            $('.dataTables_scrollHead').css('overflow', 'auto');
            $('.dataTables_scrollHead').on('scroll', function () {
                $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
            });
            var rows = table_rech.rows({ 'search': 'applied' }).nodes();
//            initColonnes('ENQU','suivi');
            initFiltres(false,{
                tardy_add_filtre:function(ok){
                    if(ok){
                        table_rech.ajax.reload();
                    }
                },
                tardy_remove_filtre:function(){
                    var url = window.location.href;
                    table_rech.ajax.reload();
                }
            });
        }
        
        
    });

    $('.reponse-modif').click(function () {
        var id = $(this).attr('id');
        var idColl = $('#idColl').val();
        var url = id + '_collectivite';
        $.ajax({
            url: Routing.generate(url),
            method: 'POST',
            data: {'collectivite': idColl},
            success: function (response) {
                window.location.href = Routing.generate('index_modifications');
            }
        });
    });

    $('.reponse-crea').click(function (e) {
        var id = $(this).attr('id');
        var idColl = $('#idColl').val();
        var url = id + '_crea_collectivite';
        if(id == 'valider'){
            //submit form
            $('form[name="bilan_social_bundle_collectivitebundle_collectivite"]').submit();
        }else if(id == 'refuser'){
            $.ajax({
                url: Routing.generate(url),
                method: 'POST',
                data: {'collectivite': idColl},
                success: function (response) {
                    window.location.href = Routing.generate('collectivite_liste_demande_creation');
                }
            });
        }
        e.preventDefault();
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

    $('input[name=modif]').change(function () {
        if ($(this).is(':checked')) {
            $(this).closest('tr').find('input[name=nmSire]').attr('required', true);
            $(this).closest('tr').find('input[name=nmSire]').attr('data-validation', 'length');
            $(this).closest('tr').find('input[name=nmSire]').attr('data-validation-length', '14');
            $(this).closest('tr').find('input[name=nmSire]').attr('data-validation-error-msg', 'Le numéro de SIRET doit compter 14 caractères.');
        } else {
            $(this).closest('tr').find('input[name=nmSire]').attr('required', false);
            $(this).closest('tr').find('input[name=nmSire]').removeAttr('data-validation');
            $(this).closest('tr').find('input[name=nmSire]').removeAttr('data-validation-length');
            $(this).closest('tr').find('input[name=nmSire]').removeAttr('data-validation-error-msg');
        }
    });
//    $('#modif-masse').click(function (e) {
//        //var form = $('form[name=form-modif-masse]');
//        var checked = $('input[name=modif]:checked').closest('tr');
//        var nmSire;
//        var blSurclasDemo;
//        var nmStratColl;
//        var blAffiColl;
//        var blCtCdg;
//        var blChsct;
//        var blCollDgcl;
//        var idColl;
//        if (checked.length > 0) {
//            $.validate({
//                form: 'form[name=form-modif-masse]',
//                onSuccess: function ($form) {
//                    $.each(checked, function () {
//                        nmSire = $(this).find('input[name=nmSire]').val();
//                        if($(this).find('input[name$=blSurclasDemo]').prop('checked') === true){
//                            blSurclasDemo = 1;
//                        }else{
//                            blSurclasDemo = 0;
//                        };
//                        nmStratColl = $(this).find('input[name=nmStratColl]').val();
//                        //blAffiColl = $(this).find('input[name^=blAffiColl]:checked').val();
//                        if($(this).find('input[name$=blAffiColl]').prop('checked') === true){
//                           blAffiColl = 1;
//                        }else{
//                            blAffiColl = 0;
//                        };
//                        //blCtCdg = $(this).find('input[name^=blCtCdg]:checked').val();
//                        if($(this).find('input[name$=blCtCdg]').prop('checked') === true){
//                           blCtCdg = 1;
//                        }else{
//                            blCtCdg = 0;
//                        };
//                        //blChsct = $(this).find('input[name^=blChsct]:checked').val();
//                         if($(this).find('input[name$=blChsct]').prop('checked') === true){
//                           blChsct = 1;
//                        }else{
//                            blChsct = 0;
//                        };
//                        //blCollDgcl = $(this).find('input[name^=blCollDgcl]:checked').val();
//                        if($(this).find('input[name$=blCollDgcl]').prop('checked') === true){
//                           blCollDgcl = 1;
//                        }else{
//                            blCollDgcl = 0;
//                        };
//                        idColl = $(this).attr('id');
//                        $.ajax({
//                            url: Routing.generate('collectivite_modification_masse'),
//                            method: 'POST',
//                            data: {'idColl': idColl, 'nmSire': nmSire, 'blSurclasDemo': blSurclasDemo, 'nmStratColl': nmStratColl, 'blAffiColl': blAffiColl, 'blCtCdg': blCtCdg, 'blChsct': blChsct, 'blCollDgcl': blCollDgcl},
//                            async: true,
//                            success: function (response) {
//                                window.location.href = Routing.generate('collectivite_modification_masse_import');
//                            }
//                        });
//                    });
//                    return false;
//                }
//            });
//
//        } else {
//            $('#messageJS').html("Veuillez sélectionner les collectivités à modifier.");
//            $('#messageJS').show();
//            e.preventDefault();
//
//        }
//    });

    $('#ajouter-colonne').click(function () {
        var table = $('.table').attr('id');
        var colVal = $('#parametrageEnquete_colonnes option:selected').val();
        var colText = $('#parametrageEnquete_colonnes option:selected').text();
        if (null != colVal || undefined != colVal) {
            indexCol = $('#' + table).DataTable().column(colVal+':name').index();
            $('#' + table).DataTable().column( indexCol ).visible( true ).draw();
            $('.col-hidden.col-' + colVal).find('input[type=hidden]').val('1');
            $('#liste-colonnes').append('<option value="' + colVal + '">' + colText + '</option>');
            $("#parametrageEnquete_colonnes option[value='" + colVal + "']").remove();
        }

        hideShowColumn('#essai');
    });
    $('#enlever-colonne').click(function () {
        var table = 'essai';
        var colVal = $('#liste-colonnes option:selected').val();
        var colText = $('#liste-colonnes option:selected').text();
        if (null != colVal || undefined != colVal) {
            indexCol = $('#' + table).DataTable().column(colVal+':name').index();
            $('#' + table).DataTable().column( indexCol ).visible( false ).draw();
            $('.col-hidden.col-' + colVal).find('input[type=hidden]').val('0');
            $('#parametrageEnquete_colonnes').append('<option value="' + colVal + '">' + colText + '</option>');
            $("#liste-colonnes option[value='" + colVal + "']").remove();
        }
        hideShowColumn('#essai');
    });

//    $('#add-filtre').click(function () {
//        $('.alert.alert-danger.display-none').hide();
//        $('.alert.alert-danger.display-none').find('p').html('');
//        var filtre = $('#parametrageEnquete_filtres option:selected').text();
//        var filtreVal = $('#parametrageEnquete_filtres').val();
//        var condition = $('#parametrageEnquete_conditions option:selected').text();
//        var condiVal = $('#parametrageEnquete_conditions').val();
//        var parametre_text = $('#parametres').find('option:selected').text();
//        if(parametre_text == 'undefined' || parametre_text == null || parametre_text == ''){
//            parametre_text = $('#parametres').val();
//        }
//        var parametre_id = $('#parametres').val();
//        if (filtreVal != undefined && condiVal != undefined && parametre_text != undefined && parametre_text != null && parametre_text != '') {
//            $('#param-applique').text('');
//            var row_elmt = $('<tr class="filtre"></tr>');
//            var col_ico_elmt = $('<td class="suppr"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>');
//            var col_filter_text_elmt = $('<td>' + filtre + ' ' + condition + ' ' + parametre_text + '</td>');
//            var col_value = $('<td class="filtre_applied"><input type="hidden" name="filtre" value="' + filtreVal + '"><input type="hidden" name="condition" value="' + condiVal + '"><input type="hidden" name="parametre" value="' + parametre_id + '"></td>');
//            $(row_elmt).append(col_ico_elmt,col_filter_text_elmt,col_value);
//            //$('#liste-filtres table').append('<tr class="filtre"><td class="suppr"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td><td>' + filtre + ' ' + condition + ' ' + parametre + '</td><td><input type="hidden" name="filtre" value="' + filtreVal + '"></td><td><input type="hidden" name="condition" value="' + condiVal + '"></td><td><input type="hidden" name="parametre" value="' + parametre + '"></td></li>');
//            $('#liste-filtres table').append(row_elmt);
//            $('#appl-filtre').attr('disabled', false);
//            $('#parametrageEnquete_filtres').val('');
//            $('#parametrageEnquete_conditions').val('');
//            $('#parametres').val('');
//            $('#essai').DataTable().ajax.reload();
//            $('#table-rech-coll').DataTable().ajax.reload();
//            var url = window.location.href;
//        } else {
//            $('.alert.alert-danger.display-none').find('p').html('Toutes les conditions ne sont pas remplies, veuillez vérifier.');
//            $('.alert.alert-danger.display-none').show();
//        }
//    });


    $('#save-param').click(function () {
        var listeColonnes = $('#liste-colonnes option');
        var colonnesCachees = $('#parametrageEnquete_colonnes option');
        var colonnes = [];
        var listeFiltres = $('#liste-filtres table tr');
        var filtres = [];
        var lbParaVal = $('input[name=lbPara]').val();
        var lbPara = lbParaVal.trim();
        if(0 != colonnesCachees.length || 0 != listeFiltres.length){
            if ('' != lbPara) {
                listeColonnes.each(function () {
                    colonnes.push($(this).val());
                });
                listeFiltres.each(function () {
                    var condiVal = $(this).find('input[name=condition]').val();
                    var parametreTmp = $(this).find('input[name=parametre]').val();
                    var parametre = parametreTmp.split(',');
                    var filtre = $(this).find('input[name=filtre]').val();
                    filtres.push({colonne: filtre, condition: condiVal, parametre: parametre});
                });
                $.ajax({
                    url: Routing.generate('collectivite_enregistrer_parametrage'),
                    method: 'POST',
                    data: {'colonnes': colonnes, 'filtres': filtres, 'lbPara': lbPara},
                    async: true,
                    success: function (response) {
                        if (response != 'error' && response != 'exist') {
                            arr = JSON.parse(response);
                            $('#messageJS').removeClass('alert-danger');
                            $('#messageJS').addClass('alert alert-success fade in');
                            $('#messageJS').html("Le paramétrage a été sauvegardé avec succès.");
                            $('#messageJS').show();
                            $('#liste-params table').append('<tr class="param"><td class="suppr-param" id="' + arr[0] + '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td><td><a href="" class="appl-param" id="' + arr[0] + '">' + arr[1] + '</a></td></tr>');
                            $('input[name=lbPara]').val('');
//                            initParam(arr[0]);
                            //$('#param-applique').html(arr[1]);
                            setTimeout(function () {
                                $('#messageJS').hide();
                            }, 5000);
                        } else if(response == 'error') {
                            $('#messageJS').removeClass('alert-success');
                            $('#messageJS').addClass('alert alert-danger fade in');
                            $('#messageJS').html("Une erreur est survenue, veuillez recommencer.");
                            $('#messageJS').show();
                        }else if(response == 'exist'){
                            $('#messageJS').removeClass('alert-success');
                            $('#messageJS').addClass('alert alert-danger fade in');
                            $('#messageJS').html("Un paramétrage possède déjà ce nom, veuillez en choisir un autre.");
                            $('#messageJS').show();
                        }
                    }
                });
            } else {
                $('#messageJS').removeClass('alert-success');
                $('#messageJS').addClass('alert alert-danger fade in');
                $('#messageJS').html("Veuillez indiquer le nom du paramétrage.");
                $('#messageJS').show();
            }
        }else{
            $('#messageJS').removeClass('alert-success');
            $('#messageJS').addClass('alert alert-danger fade in');
            $('#messageJS').html("Vous n'avez caché aucune colonne ni ajouté aucun filtre.");
            $('#messageJS').show();
        }
    });

    $(document).on('click', '.appl-param', function (e) {
        e.preventDefault();
        var idParaAffiColl = $(this).attr('id');
        var lbPara = $(this).text();
        
        var textAppliedParams = $('#param-applique').text();
        
        var array_applied_params = textAppliedParams.split(' | ');
        
        if($.inArray(lbPara, array_applied_params) === -1){
            $('#param-applique').append(lbPara + ' | ');
            initParam(idParaAffiColl);
        };
    });

    $('#reinit-params').click(function () {
        initParam(null);
        $('#table-rech-coll').DataTable().ajax.reload();
    });

    $(document).on('click', '.suppr-param', function () {
        var id = $(this).attr('id');
        $('#confirm-suppr-params-wrapper').find('input[name=idPara]').val(id);
        $('#confirm-suppr-params-wrapper').modal('show');
    });

    $('#confirm-suppr-params').click(function () {
        var id = $('#confirm-suppr-params-wrapper').find('input[name=idPara]').val();
        $.ajax({
            url: Routing.generate('collectivite_remove_parametrage'),
            method: 'POST',
            data: {'id': id},
            async: true,
            success: function () {
                location.reload();
            }
        });

    });
    $(document).on('change', ':file', function () {
        var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        $('#file-select').show();
        $('#name-file').html(label);
//        input.trigger('fileselect', [numFiles, label]);
    });
    var button = '<td><button type="button" class="remove btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>';
    $('#add-contact-coll').on('click', function (e) {
        /* get the number of lign tr inside the form  */
        var indexTr = $(document).find('.form8 tr').length;
        if (indexTr !== 3) {
            indexTr += 1;
            /* get the prototype of the current form */
            var formLine = $('.form8').data('prototype');
            /* replace all __name__ in prototype by the current index */
            var newFormLine = formLine.replace(/__name__/g, indexTr)

            $('.form8').append('<tr>' + newFormLine + button + '</tr>');
            $('div.custom-checkbox > div > label > input').each(function () {
                $(this).attr('type','checkbox');
            });
            $(document).trigger('change');
        }
    });
    $(document).on('click', '.remove', function (e) {
        $(this).closest('tr').remove();
    });

    $(document).on('click', '.edit-echange',function(e){
        var idEcha = $(this).closest('tr').attr('id');
        afficherFormulaireEchange(idEcha);
    });

    $(document).on('click', '.suppr-echange span',function(e){
        var idEcha = $(this).closest('tr').attr('id');
        supprimerEchange(idEcha);
    });

    $('#ajout-echange').click(function(e){
        var idEcha = null;
        afficherFormulaireEchange(idEcha);
    });

    $(document).on('click', '#btn-form-echange',function(e){
        var collectivite = $('#idColl').val();
        var lbIntiEcha = $('#bilan_social_bundle_collectivitebundle_historiqueechange_lbIntiEcha').val();
        var lbTypeEcha = $('#bilan_social_bundle_collectivitebundle_historiqueechange_lbTypeEcha').val();
        var cmEcha = $('#bilan_social_bundle_collectivitebundle_historiqueechange_cmEcha').val();
        var dtEcha = $('#bilan_social_bundle_collectivitebundle_historiqueechange_dtEcha').val();
        var idHistEcha = $('#bilan_social_bundle_collectivitebundle_historiqueechange_idHistEcha').val();
        if(lbIntiEcha !== '' && dtEcha != '') {
            $.ajax({
                url: Routing.generate('submit_echange'),
                method: 'POST',
                data: {lbIntiEcha:lbIntiEcha, lbTypeEcha:lbTypeEcha, cmEcha:cmEcha, dtEcha:dtEcha, idHistEcha:idHistEcha, collectivite:collectivite},
                dataType: "json",
                success: function (response) {
                    if(response == 'ok'){
                        reloadTableauEchange(collectivite);
                        $('#messageJS').addClass('alert-success');
                        $('#messageJS').removeClass('alert-danger');
                        $('#messageJS').html("L'échange a été sauvegardé avec succès.");
                        $('#messageJS').show();
                        $('#echange').modal('hide');
                    }else{
                        $('#messageJS').removeClass('alert-success');
                        $('#messageJS').addClass('alert-danger');
                        $('#messageJS').html("Une erreur est survenue, veuillez recommencer.");
                        $('#messageJS').show();
                        $('#echange').modal('hide');
                    }
                }
            });
            e.preventDefault();
            return false;
        }
    });
    $(document).on('change', function (e) {
        var NbReferent = 0;
        $('div.referent-coll > div > label > input:radio').each(function () {
            if ($(this).prop('checked') === true) {
                NbReferent += 1;
            }
        });
        if (NbReferent > 1) {
            $('div.referent-coll > div > label > input:radio').each(function () {
                $(this).prop('checked', false);
                //$('#myModal').modal('show');
            });
        }

    });

    var RadioClicked = '';
    $('#mytable8').on('click', 'div.referent-coll > div > label > input:radio', function (event) {
        $(document).change();
        RadioClicked = $(this);
        $(RadioClicked).prop('checked', true);
    });

    $('#bilan_social_bundle_collectivitebundle_collectivite_departement').change(function(){
        var depa = $(this).val();
        getCdg(depa);
    });

    $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_nmNouvSire').parent('div.form-group').hide();
    $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_nmSireAbso').parent('div.form-group').hide();
    $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_lbTypeArch').change(function(){
        var val = $(this).val();
        if(val == 0 || val == 'dissolution'){
            $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_nmNouvSire').parent('div.form-group').hide();
            $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_nmSireAbso').parent('div.form-group').hide();
            if(val == 'dissolution'){
                $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_dtArch').prev('label').html('Date de dissolution');
            }
        }else if(val == 'absorption'){
            $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_nmNouvSire').parent('div.form-group').hide();
            $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_nmSireAbso').parent('div.form-group').show();
            $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_dtArch').prev('label').html('Date d\'absorption');
        }else if(val == 'fusion'){
            $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_dtArch').prev('label').html('Date de fusion');
            $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_nmNouvSire').parent('div.form-group').show();
            $('#bilan_social_bundle_collectivitebundle_historiquecollectivite_nmSireAbso').parent('div.form-group').hide();

        }
    });
    
        


    var dtTableColl = $('#essai').DataTable({
        "processing": false,
        "serverSide": false,
        deferRender : true,
        scrollY: "80vh",
        scrollX: "80vw",
        scrollCollapse: true,
        info: true,
        "columnDefs": [
            { "orderable": false, "targets": [0,1] }
        ],
        "columns": [
            { 
                data: "selected", name: "Exporter",
                render: function(data, type, row, meta){
                    //var input = dtTableColl.cell(meta.row,meta.col).node();
                    //console.log($(input));
                    //if(input == undefined || $(input).prop('innerHTML')=="" || $(input).prop('innerHTML')==undefined || $(input).prop('innerHTML')==null){
                        var checked = data==1 ? "checked" : "";
                        var attr = {
                            checked:checked,
                            name:row.idColl,
                            value:row.idColl,
                            class:'check-coll-export bootstrapToggle to-bt'
                        };
                        var input = dtcreateCheckbox(attr,{toggle:'toggle'});//"<input type='checkbox' class='check-coll-export bootstrapToggle' name='"+ row.idColl +"' value='"+ row.idColl +"' "+checked+">";
                    //}else{
                        //console.log(input);
                        //input = $(input).prop('innerHTML');
                        //console.log(input);
                    //}
                    return input;
                },
                /*fnCreatedCell: dtInitBootstrapOnCreatedCell/*function(td,cellData,rowData, row_i, col_i){
                    var input = $(td).find('input[type:checkbox]');
                    initBoostrapToggle(input);
                },*/
                ordering: false
            },
            { 
                data: "nmSire", name:"blSire",
                type: 'title-string', targets: 1,
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        if(row.change_request == true){
                            data = '<a title="'+ data +'" href='+ Routing.generate('collectivite_modifications', { id: row.idColl })+' target="_blank">'+ data +'</a>';
                        }else{
                            data = '<a title="'+ data +'" href='+ Routing.generate('collectivite_fiche', { id: row.idColl })+' target="_blank">'+ data +'</a>';
                        }
                    }
                    return data;
                },
                
            },
            { "data": "lbColl", name: "blLibe"  },
            { "data": "lbMail", name: "lbMail"  },
            { "data": "lbPassTemp", name: "lbPassTemp"  },
            { "data": "lbTypeColl", name: "blTypeColl"  },
            { 
                data: null, name: "blAffiCdg",
                render: function(data, type, row, meta){
                    if(data.blAffiColl === true){
                        data = "Oui";
                    }else if(data.blAffiColl === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
                } 
            },
            { "data": "lbAdre", name: "blLbAdresse" },
            { "data": "lbDepa", name: "blDepa"  },
            { "data": "cdPost", name: "blCdPost" },
            { "data": "lbVill", name: "blLbVill" },
            { "data": "cdInse", name: "cdInse"  },
            { "data": "nmPopuInse", name: "blNmPopuInse"  },
            //{ "data": "blSurclasDemo", name: "blSurclasDemo"  },
            {
                data: null, name: "blSurclasDemo",
                render: function(data, type, row, meta){
                    if(data.blSurclasDemo === true){
                        data = "Oui";
                    }else if(data.blSurclasDemo === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
                }
            },
            { "data": "nmStratColl", name: "blNmStratColl"  },
            {
                data: null, name: "blCtCdg",
                render: function(data, type, row, meta){
                    if(data.blCtCdg === true){
                        data = "Oui";
                    }else if(data.blCtCdg === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
                }
            },
            {
                data: null, name: "blChsct",
                render: function(data, type, row, meta){
                    if(data.blChsct === true){
                        data = "Oui";
                    }else if(data.blChsct === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
                }
            },
            {
                data: null, name: "blCollDgcl",
                render: function(data, type, row, meta){
                    if(data.blCollDgcl === true){
                        data = "Oui";
                    }else if(data.blCollDgcl === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
                }
            },
            {
                data: null, name: "cdg_is_authorized_by_collectivity",
                render: function(data, type, row, meta){
                    if(data.cdg_is_authorized_by_collectivity === true){
                        data = "Oui";
                    }else if(data.cdg_is_authorized_by_collectivity === false){
                        data = "Non";
                    }else{
                        data = "Non renseigné";
                    }
                    return data;
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
                   if(data.NbAgenTitu === null){
                        return 0;
                    }
                    return data.NbAgenTitu;
                }
            },{ 
                data: null, name: "blNbAgenContPerm",
                render: function(data, type, row, meta){
                    if(data.NbAgenContPerm === null){
                        return 0;
                    }
                    return data.NbAgenContPerm;
                }
            },{ 
                data: null, name: "blNbAgenContNonPerm",
                render: function(data, type, row, meta){
                    if(data.NbAgenContNonPerm === null){
                        return 0;
                    }
                    return data.NbAgenContNonPerm;
                }
            },
            { "data": "lbNom", name: "blNom"  },
            { "data": "lbTele", name: "blTele"  }
        ],
        language: languageDataTable,
        ajax :{
            url : Routing.generate('ajax_get_collectivite'),
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

            initColonnes('COLL','essai');
            hideShowColumn('#essai');
            $('.table-hover').closest('.col-sm-12').css('overflow-x', 'auto');
            dtTableColl.columns.adjust().draw();
            initFiltres(false,{
                tardy_add_filtre:function(ok,filtres_elmnts,filtre_params){
                    if(ok){
                        dtTableColl.ajax.reload();
                    }
                },
                tardy_remove_filtre:function(){
                    dtTableColl.ajax.reload();
                }
            });
//
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
        //createdRow: dtInitBootstrapOnCreatedRow
    });

    $('#essai_wrapper .check-all.vertical').on('click',function(event){
        event.preventDefault();
        dtSelectAllVertical(this,dtTableColl);
    });

   // Handle click on checkbox to set state of "Select all" control
   $('#essai tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }

      }
   });

   $('#export-collectivite').on('click', function(e){
        e.preventDefault();
        var Array_collectivite = dtGetRowsBySelectedColl(dtTableColl,'selected','idColl');
        var Array_columns = [];
        var columns_to_show = $('#liste-colonnes').find('option');
        columns_to_show.each(function(){
            Array_columns.push($(this).val());
        });
        Array_columns.push('lbPassTemp');
        $('#list_id_collectivite').val(Array_collectivite);
        $('#listeColumns').val(Array_columns);
        $('#button_sender').val('export-collectivite');

        if(Array_collectivite.length > 0){
            var url = Routing.generate('csv_prepar');
            var form = createFormToAjax(url,'POST',{
                'listIds' : Array_collectivite,
                'listeColumns' : Array_columns,
                'button_sender' : 'export-collectivite'
            });
            
            $('body').append(form);
           form.submit();
       }else{
           e.preventDefault();
       }
    });
    
    $('#export-mdp-temp').click(function(){
        var Array_collectivite = dtGetRowsBySelectedColl(dtTableColl,'selected','idColl');
        var Array_columns = [];
        var checkEmpty = true;
        var columns_to_show = $('#liste-colonnes').find('option');
        
        columns_to_show.each(function(){
            Array_columns.push($(this).val());
        });
            $('#list_id_collectivite').val(Array_collectivite);
            $('#listeColumns').val(Array_columns);
            $('#button_sender').val('export-mdp-temp');
            
        if(Array_collectivite.length > 0){
            
            $.ajax({
            url: Routing.generate('get_departement_exclude'),
            method: 'POST',
            data: {'listIds' : Array_collectivite},
            success: function (response) {
                if(response.message !== null && response.checkEmpty === false){
                    checkEmpty = false;
                    destroyModal('#droits');
                    createBtpModal('droits','Contrôle des droits sur les collectivites',response.message);
                    openBtpModal('#droits');
                }else{
                    destroyModal('#droits');
                    createBtpModal('droits','Contrôle des droits sur les collectivites',response.message);
                    openBtpModal('#droits');
                }
                launchIfNotEmpty(checkEmpty, Array_collectivite, Array_columns);
            }
        });
        }else{
            e.preventDefault();
        }
    });
    
    function launchIfNotEmpty(checkEmpty, Array_collectivite, Array_columns ){
         if(checkEmpty == false){
            var url =  Routing.generate('csv_prepar');
            var form = createFormToAjax(url,'POST',{
                'listIds' : Array_collectivite,
                'listeColumns' : Array_columns,
                'button_sender' : 'export-mdp-temp'
            });
            form.submit();
        }
    }
    $(document).on('change','.check-coll-export',function(event){
        dtCheckboxToggle(this,dtTableColl);
    })
});
function hideShowColumn(from_table){
    var table = $(from_table);

    var array_hide_columns = [];
    $('#parametrageEnquete_colonnes').find('option').each(function(){
       array_hide_columns.push($(this).val()+":name");
    });
    $(table).DataTable().columns(array_show_columns).visible(false, false);
    var array_show_columns = [];
    $('#liste-colonnes').find('option').each(function(){
       array_show_columns.push($(this).val()+":name");
    });
    array_show_columns.push("Exporter:name");
//    array_show_columns.push("Reinitialiser:name");
    array_show_columns.push("lbMail:name");
    array_show_columns.push("lbPassTemp:name");

    $(table).DataTable().columns(array_show_columns).visible(true, false);
    $(table).DataTable().columns.adjust().draw();

}

function initColonnes(vue, table) {
    var removeArr = ['blBilaSoci','blRass','blHand','blGpee', 'blGpeecPlus','blApa','blCons','blN4ds','blBilaSociVide','blBaseCarr', 'fgStat'];
    var dtTable = $('#'+table).DataTable();
    $.ajax({
        url: Routing.generate('get_model_vue'),
        method: 'POST',
        data: {vue: vue},
        success: function (response) {
         //   console.log(response);
            var colonnes = response;
            var indexCollToShow = [];
            $.each(colonnes, function (k, v) {
                if ($.isNumeric(k)) {
                    var indexCol = dtTable.column(v+':name').index();
                    if(indexCol!=undefined){
                        indexCollToShow.push(indexCol);
                    }
                    var text = $('#parametrageEnquete_colonnes option[value=' + v + ']').text();
                    $('#parametrageEnquete_colonnes option[value=' + v + ']').remove();
                    
                    $('.col-hidden.col-' + v).find('input[type=hidden]').val('1');
                    $('#liste-colonnes').append('<option value="' + v + '">' + text + '</option>');
                }
            });
            dtTable.columns( indexCollToShow ).visible( true );
            if(table == 'essai' || table == 'table-rech-coll'){
                $.each(removeArr, function(k,v){
                    $('#liste-colonnes option[value=' + v + ']').remove();
                    $('#parametrageEnquete_colonnes option[value^=' + v + ']').remove();
                    $('#parametrageEnquete_filtres option[value^=' + v + ']').remove();
                });
            }
            //dtTable.draw();
            //$(dtTable).show();
            $('#ajout-colonnes div.panel-body, #ajout-filtres div.panel-body').show();
        }
    });
}

function initForm(blCtCdg,url) {
    $('#bilan_social_bundle_collectivitebundle_collectivite_blChsct').prop('checked',false);
    if(url == 'edit'){
        if (blCtCdg == false) {
            $('#div-chsct').show();
        } else {
            $('#div-chsct').hide();
        }
    }else if(url == 'fiche'){
        var radioParent = $('input[name="bilan_social_bundle_collectivitebundle_collectivite[blChsct]"]').closest('div.form-group');
        if (blCtCdg == 0) {
            radioParent.show();
            $('input[name="bilan_social_bundle_collectivitebundle_collectivite[blChsct]"]').attr("required", "required");
        } else {
            radioParent.hide();
            $('input[name="bilan_social_bundle_collectivitebundle_collectivite[blChsct]"]').removeAttr("required");
        }
    }
}

function initTab(blCtCdg, name) {
    var idArr = name.split('_');
    var id = idArr[1];
    var radioParent = $('input[name=blChsct_' + id + ']').closest('span.chsct');
    if (blCtCdg == 0) {
        radioParent.show();
    } else {
        radioParent.hide();
        $('input[name=blChsct_' + id + ']').prop('checked', false);
    }
}
function showCol() {
    var inputArr = $('input[value=1].hidden').parent();

    $.each(inputArr, function () {
        classV = $(this).attr('class');
        if ($(this).hasClass('col-hidden')) {
            classArr = classV.split(' ');
            classArr2 = classArr[1].split('-');
            optVal = classArr2[1];
            var text = $("#parametrageEnquete_colonnes option[value='" + optVal + "']").text();
            $('#liste-colonnes').append('<option value="' + optVal + '">' + text + '</li>');
            $("#parametrageEnquete_colonnes option[value='" + optVal + "']").remove();
        }
        var elements = document.getElementsByClassName(classV);
        $.each(elements, function () {
            $(this).show();
        });
    });
}
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
//    $('#appl-filtre').trigger("click");
    var colonnes = $('#parametrageEnquete_colonnes option');
//    $.each(colonnes, function () {
//        $(this).attr('selected', true);
////        $('#ajouter-colonne').trigger("click");
//    });
//    $('#param-applique').html('');
    
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

function afficherFormulaireEchange(idEcha){
    $.ajax({
        url: Routing.generate('formulaire_echange_ajax'),
        method: 'POST',
        data: {'id':idEcha},
        async: true,
        success: function(response){
            $('#modal-wrapper').html(response);
            $('#echange').modal();
        }
    });
}

function reloadTableauEchange(idColl){
    $.ajax({
        url: Routing.generate('reload_tableau_echange'),
        method: 'POST',
        data: {'collectivite':idColl},
        success: function(response){
            $('#table-echanges-wrapper').html(response);
        }
    });
}

function supprimerEchange(idEcha){
    var collectivite = $('#idColl').val();
    $.ajax({
        url: Routing.generate('supprimer_echange_ajax'),
        method: 'POST',
        data: {'id':idEcha},
        async: true,
        success: function(response){
            if(response == 'ok'){
                reloadTableauEchange(collectivite);
                $('#messageJS').addClass('alert-success');
                $('#messageJS').removeClass('alert-danger');
                $('#messageJS').html("L'échange a été supprimé avec succès.");
                $('#messageJS').show();
            }else{
                $('#messageJS').removeClass('alert-success');
                $('#messageJS').addClass('alert-danger');
                $('#messageJS').html("Une erreur est survenue, veuillez recommencer.");
                $('#messageJS').show();
            }
        }
    });
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
