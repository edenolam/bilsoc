$(document).ready(function () {
    $('#err-format').hide();
    $(document).on('submit','form[name="infosEnquete"]',function(e){
        /*e.preventDefault();
        var form = $('form[name="infosEnquete"]');
         $.ajax({
                url: Routing.generate('enquete_creer'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                        window.location = Routing.generate('enquete_homepage');
                    }
                });*/
    });

    $('.displayToggle').on('click', function() {
        $(this).find('span').toggleClass('buttonplus buttonmoins');
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

    $('.modifier').html('Modifier');
    $('button[type=submit]:not(".btn")').remove();

    $('input[name="modificationCollectivite[blModi]"]').prop('checked',false);
    $('input[name="modificationCollectivite[blModi]"]').change(function(){
        if($(this).attr('id') == 'modificationCollectivite_blModi_1'){
            $('#form_importCollectivite').prop('required',false);
            $('#ecran-modi-masse').hide();
        }else{
            $('#form_importCollectivite').prop('required',true);
            $('#ecran-modi-masse').show();
        }
    });
    $("#import_blImport input").on('change',function(event){
        if($(this).val()==1){
            $.ajax({
                url: Routing.generate('import_carriere_homepage'),
                method: 'POST',
                dataType: 'json',
                data: {},
                async: true,
                success: function (response) {
                    //console.log(response);
                    $('.panel-body').append(response.responseText);
                },
                complete:function (response) {
                    //console.log(response);
                    $('.panel-body').append(response.responseText);
                }
            });
        }else{
            $('#import_carriere_container').remove();
        }

    });
    $(".panel-body").on('submit','#import_carriere_form_algo_type',function(event){ return false });
    $(".panel-body").on('submit','#import_carriere_form_algo_type .algo_type_radio',function(event){
        return false
    });
    $(".panel-body").on('click','#import_carriere',function(event){
        var type_import = $("input[name='algo_type']").filter(':checked').val();
        var file_data = $('#import_file').prop('files')[0];
        var file_import = file_data.name;
        $('#tables_coll_container').empty();
        if(type_import!=undefined && file_import!=""){
            $.ajax({
                url: Routing.generate('import_carriere_homepage'),
                method: 'POST',
                dataType: 'json',
                data: {
                    type_import:type_import,
                    file_import:file_import
                },
                async: true,
                success: function (response) {
                    //console.log(response);
                    $('#tables_coll_container').append(response.responseText);
                    $('#tables_coll_container table').dataTable();
                },
                complete:function (response) {
                    //console.log(response);
                    $('#tables_coll_container').append(response.responseText);
                    $('#tables_coll_container table').dataTable();
                }
            });
        }else{
            //$('#import_carriere_container').remove();
        }
    });
    $('.panel-body').on('click','#select_coll_btn',function(event){
        var coll_selected = [];
        $('input[name="coll_selected[]"]').filter(':checked').each(function(){
            coll_selected.push($(this).val());
        });
        var type_import = $('input#hidden_algo_import_carriere_type').val();
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
                    //console.log(response);
                },
                complete:function (response) {
                    //console.log(response);
                }
            });
    });

    /*
    *   Suivi enquête
    */
    $('#suivi-enquete #parametrageEnquete_filtres').append('<option value="LB_ETAT_SAIS-15">Etat de saisie</option>')

    var anneeRef = parseInt($('#annee').text());
    var annee = anneeRef + 1;
    var dtMin = $('.dtDebutCampagne').val();
    var dtMax = '31/12/'+annee;
    
    $('.input-date-enquete').datepicker({
        language: "fr",
        startDate: dtMin,
        endDate: dtMax
    });

    var suivi = $('#suivi').DataTable({
        processing: false,
        serverSide: false,
        deferRender: true,
        scrollX: "80vw",
        scrollCollapse: true,
        info: true,
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "_START_ &agrave; _END_ sur _TOTAL_ collectivités",
            infoEmpty: "0 &agrave; 0 sur 0 collectivités",
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
        columns: [
            { 
                data: "export",name: "export",
                sortable: false,
                render: function(data, type, row, meta){
                    var checked = row.export == true;
                    var attr = {
                        checked:checked,
                        name:'export',
                        class:'check-export to-bt',
                        id: row.idColl
                    }
                    var rendered = dtcreateCheckbox(attr);
                    //data = "<input type='checkbox' class='check-export' id='"+data.idColl+"'><input class='idEnquValue' type='hidden' value='"+data.idEnqu+"' />";
                    return rendered;
                },
            },
            { "data": "lbTypeColl", name: "blTypeColl"  },
            { "data": "lbDepa", name: "blDepa"  },
            { "data": "lbAdre", name: "blLbAdresse" },
            { "data": "lbColl", name: "blLibe"  },
            { "data": "cdPost", name: "blCdPost"  },
            { "data": "lbVill", name: "blLbVill"  },
            { "data": "cdInse", name: "blCdInse"  },
            { "data": "lbNom", name: "blNom"  },
            { "data": "lbTele", name: "blTele" },
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
                data: null, name: "blCtCdg",
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
            },/*{ 
                data: "etat", name: "etat",
                defaultContent: ""
            },*/{ 
                data: 'fgStat', name: "fgStat",
                render: function(data, type, row, meta) {
                    var rendered = dataSwap(row.fgStat,{
                        '-2':'Non connecté',
                        '-1':'Non saisi',
                        0:"En cours de saisie",
                        1:"Transmis",
                        2:"Validé",
                        3:"Non validé",
                        4:"En cours de saisie suite à non validation",
                        5:"Nouvelle transmission en attente de validation",
                        6:"Non connecté",
                        7:"Non saisie",
                        8:"Saisie réinitialisée"
                    });//"";
                    if(rendered == null) {
                        rendered = 'Non connecté';
                    }
                    rendered = rendered===undefined ? "" : rendered;
                    return rendered;
                }
            },{ 
                data: null, name: "blRass",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blRast);
                    return rendered; 
                }
            },{ 
                data: null, name: "blGpee",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blGepe);
                    return rendered; 
                }
            },{ 
                data: null, name: "blGpeecPlus",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blGpeecPlus);
                    return rendered; 
                }
            },{ 
                data: null, name: "blHand",
                render: function(data, type, row, meta){
                    var rendered = boolToYesNoNa(row.blHand);
                    return rendered; 
                }
            },{
                data: null, name: "initSource",
                render: function(data, type, row, meta){
                    var rendered = data.initSource;
                    return rendered;
                }
            },{
                className: "tooltilpc",
                data: null, name: "nb_pc_bsc",
                render: function(data, type, row, meta){
                    var total = (parseInt(data.nb_pc_gpeec)  + parseInt(data.nb_pc_rassct) + parseInt(data.nb_pc_hand) + parseInt(data.nb_pc_bsc))/4;
                    /*data-bsc="+ data.nb_pc_hand + '%'" data-hand = " + data.nb_pc_hand +'%'" data-rassct=" + data.nb_pc_gpeec +'%'" data-gpeec=" + data.nb_pc_gpeec +'%'"*/
                    var rendered = '<td class="tooltilpc">' +
                        '<span data-total="' + parseInt(total) + '%" data-hand="' + parseInt(data.nb_pc_hand) + '%" data-gpeec="'+ parseInt(data.nb_pc_gpeec) +'%" data-rassct="'+ parseInt(data.nb_pc_rassct) +'%" data-bsc="'+ parseInt(data.nb_pc_bsc) +'%" >' +
                        parseInt(total) +
                            '%</span>' +
                        '</td>';

                        //data.nb_pc_bsc;
                    return rendered;
                }
            },{
                data: null, name: "apa",
                render: function(data, type, row, meta){
                    var droitCdg = '0';
                    if(data.cdg_is_authorized_by_collectivity == true) {
                        droitCdg = '1';
                    } else {
                        droitCdg = '0';
                    }
                    if(data.initApa == true && (data.initCons == false || data.initCons == null) && data.fgStat != 6 && data.fgStat != 7 && data.cdg_is_authorized_by_collectivity == true) {
                        data = "<a href='"+ Routing.generate('show_bilan_apa', {userId: data.idUtil, idColl: data.idColl, droit: droitCdg}) +"' target='_blank'><i style='height: auto; font-size: 1.5em; float: none;' class='icone-menu fa fa-eye' aria-hidden='true'></i></a>";
                        // data = "<a href='"+ Routing.generate('homepage', { _switch_user: data.nmSire }) +"' target='_blank'><i style='height: auto; font-size: 1.5em; float: none;' class='icone-menu fa fa-eye' aria-hidden='true'></i></a>";
                    } else {
                        data = '';
                    }
                    return data;
                }
            },{ 
                data: null, name: "cons",
                render: function(data, type, row, meta){
                    if((((data.initCons == true || data.initApa == false) || (data.initCons == true && data.initApa == true)) && data.fgStat != 6 && data.fgStat != 7 && data.cdg_is_authorized_by_collectivity == true) || data.fgStat == 2) {
                        // data = "<a href='"+ Routing.generate('homepage', { _switch_user: data.nmSire }) +"' target='_blank'><i style='height: auto; font-size: 1.5em; float: none;' class='icone-menu fa fa-eye' aria-hidden='true'></i></a>";
                        data = "<a href='"+ Routing.generate('show_bilan_cons', {userId: data.idUtil, idColl: data.idColl}) +"' target='_blank'><i style='height: auto; font-size: 1.5em; float: none;' class='icone-menu fa fa-eye' aria-hidden='true'></i></a>";
                    } else {
                        data = '';
                    }
                    return data;
                }
            },{
                data: null, name: "anal",
                render: function(data, type, row, meta){
                    if( data.mdaId != null && data.cdg_is_authorized_by_collectivity == 1 ) {
                        data = "<a href='"+ Routing.generate('analyse_demande_switch', {id: data.idColl}) +"' target='_blank'><i style='height: auto; font-size: 1.5em; float: none; color: #8959A8' class='icone-menu fa fa-eye' aria-hidden='true'></i></a>";
                    } else {
                        data = '';
                    }
                    return data;
                }
            },{
                data: null, name: "sais",
                render: function(data, type, row, meta){
                    if( data.mdaId != null  && data.cdg_is_authorized_by_collectivity == 1) {
                        data = "<a href='"+ Routing.generate('switch_cdg_saisie_enquete', {id: data.idColl}) +"' target='_blank'><i style='height: auto; font-size: 1.5em; float: none; color: #FF8C00' class='icone-menu fa fa-eye' aria-hidden='true'></i></a>";
                    } else {
                        data = '';
                    }
                    return data;
                }
            },{
                data: null, name: "dtLastconn",
                render: function(data, type, row, meta) {
                    if(data.dtLastconn != null) {
                        var date = new Date(data.dtLastconn.date);
                        var day = date.getDate().toString();
                        if(day < 10) {
                            day = '0' + date.getDate().toString();
                        }
                        var lastCon = day + '/' + (date.getMonth() + 1) + '/' +  date.getFullYear();
                        data = "<td><span class='hide'>"+data.dtLastconn.date+"</span>"+ lastCon +"</td>";
                    } else {
                        data = '';
                    }
                    return data;
                }
            },{ 
                data: "relance",name: "relance",
                sortable: false,
                render: function(data, type, row, meta){
                    var rendered;
                    var checked = row.relance == true;
                    var attr = {
                        checked:checked,
                        name:'relance',
                        class:'check-relance to-bt',
                        id: row.idColl
                    }
                    if(row.fgStat == 0 || row.fgStat == 4 || row.fgStat == 3 || row.fgStat == 7 || row.fgStat == undefined || row.fgStat == '') {
                        if(row.lastRelance != null) {
                            var relance = new Date(row.lastRelance.date);
                            var year = (relance.getDate()) + '/' + (relance.getMonth() + 1) + '/' +  relance.getFullYear();
                                rendered = 'dernière relance le : ' + year + '  ' + dtcreateCheckbox(attr);
                        } else {
                            if(row.email == null) {
                                rendered = "Pas d'email renseigné";
                            } else {
                                rendered = dtcreateCheckbox(attr);
                                
                            }
                        }
                    }else if(row.fgStat == 1){
                        rendered = 'Bilan transmis';
                    }else if(row.fgStat == 2){
                        rendered = 'Bilan validé';
                    }else{
                        rendered = '';
                    }
                    return rendered;
                },
            },
            {
                data: null, name: "email",
                sortable: false,
                render: function(data, type, row, meta) {
                    var rendered;
                    if (row.email) {
                        rendered = "<a href='mailto:"+row.email+"'>"+row.email+"</a>";
                    } else {
                        rendered = "Pas d'email renseigné";
                    }
                    return rendered;
                }
            }
        ],
        ajax :{
            url : Routing.generate('ajax_suivi_enquete'),
            "type" : 'POST',
            "data" : function(d){
                var filtres = getFiltreApplied();
                d.filtres = filtres;
            },

        },
        "initComplete": function(settings, json) {
          
        },
        fnDrawCallback: function(settings){
            var nodes = this.api().rows().nodes();
            var to_bt = $(nodes).find('input[type="checkbox"].to-bt');
            initBoostrapToggle(to_bt);

            $(nodes).find("td.tooltilpc")
                     .mouseover(function() {
                         var bsc = $( this ).find( "span" ).data("bsc");
                         var hand = $( this ).find( "span" ).data("hand");
                         var gpeec = $( this ).find( "span" ).data("gpeec");
                         var rassct = $( this ).find( "span" ).data("rassct");
                         $( this ).find( "span" ).addClass('sizeFont').html( 'Bilan Social : '+ bsc +'<br/>Handitorial : '+ hand +'<br/>Gpeec : '+gpeec +'<br/>Rassct : ' +rassct);
                     })
                     .mouseout(function() {

                         var total = $( this ).find( "span" ).data("total");
                         $( this ).find( "span" ).removeClass('sizeFont').html( total );
                     });
        },
        drawCallback: function(){
            dtAjustHeader(suivi);
        },
        fnInitComplete: function(){
            $('.dataTables_scrollHead').css('overflow', 'auto');
            $('.dataTables_scrollHead').on('scroll', function () {
                $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
            });
            var rows = suivi.rows({ 'search': 'applied' }).nodes();
            initColonnes('ENQU','suivi');
            initFiltres(false,{
                tardy_add_filtre:function(ok){
                    if(ok){
                        suivi.ajax.reload();
                    }
                },
                tardy_remove_filtre:function(){
                    var url = window.location.href;
                    suivi.ajax.reload();
                }
            });
            var idEnqu = $('.idEnquValue').val();
            $('<input value="'+idEnqu+'" type="hidden" id="idEnqu">').appendTo('body');
            $('.table-hover').closest('.col-sm-12').css('overflow-x', 'auto');
           


        }
    });
     $('#suivi_wrapper .check-all.vertical').on('click',function(event){
        event.preventDefault();
        dtSelectAllVertical(this,suivi);
    });
    $(document).on('change','#suivi .to-bt',function(event){
        dtCheckboxToggle(this,suivi);
    });

    var id_enquete = getUrlParameter('id');
    $('.btn-relance').click(function(e){
        //var idEnqu = $('.idEnquValue').val();
        var message = $('#bilan_social_bundle_campagnebundle_relance_lbMessrela').val();
        var rows = dtGetRowsBySelectedColl(suivi,'relance');// suivi.rows({ 'search': 'applied' }).nodes();
        if(message != ''){
            $(rows).each(function(){
                //console.log("test");
                var idColl = this.idColl;
                var idEnqu = this.idEnqu;
                $.ajax({
                    url: Routing.generate('enquete_relancer'),
                    method: 'POST',
                    dataType: 'json',
                    data: {'collectivite':idColl, 'idEnqu':idEnqu, 'message': message},
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
            });
        }else{
            $('#messageJS').html("Veuillez renseigner le message à envoyer.");
            $('#messageJS').show();
        }
        return false;
    });
    $('#btn-open-modal').click(function(e){

       var checked = dtGetRowsBySelectedColl(suivi,"relance");//$('.check-relance:checked');

        //console.log(checked.length);

       if(checked.length < 1){
               $('#export-relance-coll').modal().show();
               return false;
       }else{
            e.preventDefault();
       }
    });

    /*
    *   Paramétrage enquête
    */
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
            url : Routing.generate('ajax_get_enquete_collectivite', {'idEnquete' : id_enquete}),
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
    
//    $('#essai_wrapper .check-all#blGpeecPlus').on('click', function() {
//        var btn = $('.check-all#blGpee');
//        dtSelectAllHorizontal(btn,essai1);
//    });

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

    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        $('#file-select').show();
        $('#name-file').html(label);
    });
     var table_modif_masse = $('#table-modif-mass').DataTable();
    $('#import-masse-coll').click(function(e){
        if($('#name-file').text() == ""){e.preventDefault(); return false;};
        $('#table-modif-mass-wrapper').hide();
        table_modif_masse.destroy();
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
        
        if(checked.length > 0){
            $.ajax({
                url: Routing.generate('collectivite_modification_masse'),
                method: 'POST',
                data: {checked : checked},
                async: true,
                success: function (response) {
                    $('#messageSuccess').html("Les modifications ont été prises en compte.");
                    $('#messageSuccess').removeClass('hidden');
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
    $('input[name="infosEnquete[cdgDepartements][]"]').change(function(){
        var labelInput = $(this).closest('label').html();
        var cdgName = $('.cdgName').val();
        if(cdgName == "ciggc") {
            if(labelInput.indexOf("Val-d'Oise") >= 0 || labelInput.indexOf("Yvelines") >= 0 || labelInput.indexOf("Essonne") >= 0){
                if($(this).prop('checked') == true){
                    $('input[name="infosEnquete[cdgDepartements][]"]').prop('checked',true);
                }else{
                    $('input[name="infosEnquete[cdgDepartements][]"]').prop('checked',false);
                }
            }           
        } else if(cdgName == "cigpc") {
            if(labelInput.indexOf("Hauts-de-Seine") >= 0 || labelInput.indexOf("Seine-Saint-Denis") >= 0 || labelInput.indexOf("Val-de-Marne") >= 0) {
                if($(this).prop('checked') == true){
                    $('input[name="infosEnquete[cdgDepartements][]"]').prop('checked',true);
                }else{
                    $('input[name="infosEnquete[cdgDepartements][]"]').prop('checked',false);
                }
            }
        }

    });
    $('#creer-enquete').click(function(){
        window.location.href=Routing.generate('enquete_homepage');
    });
    $('#telecharger-csv').click(function(event){
        var form = $(this).parents('form:first').get(0);
        if(form.checkValidity()){
            $('#creer-enquete').prop('disabled',false);
            $('workInProgress').modal('show');
        }else{
            //event.preventDefault();
        }
        
    });
    $('#infosEnquete_reinitMdp_0').change(function(){
        // if($(this).prop('checked') == true){
            // $('#creer-enquete').show();
            // $('.alert.alert-danger').show();
            // $('#telecharger-csv').html('Télécharger');
        // }else{
            // $('#creer-enquete').hide();
            // $('.alert.alert-danger').hide();
            // $('#creer-enquete').prop('disabled',true);
            // $('#telecharger-csv').html('Créer');
        // }
    });

    $('form').on('submit', function(e){
        var form = this;

        // Encode a set of form elements from all pages as an array of names and values
        var params = essai1.$('input').serializeArray();

        // Iterate over all form elements
        $.each(params, function(){
            // If element doesn't exist in DOM
            if(!$.contains(document, form[this.name])){
                // Create a hidden element
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', this.name)
                        .val(this.value)
                );
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
//            console.log(essai1.$('input').serializeArray());

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
                  /*var nameAtt = this.name;
                  var valueAtt = this.value;

                  if(nameAtt != undefined) {

                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_blBilasoci") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          blBilaSociHash[idColl] = valeur;
                      }

                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_blRast") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          blRassHash[idColl] = valeur;
                      }

                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_blHand") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          blHandHash[idColl] = valeur;
                      }

                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_blGepe") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          blGpeeHash[idColl] = valeur;
                      }

                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_blApa") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          blApaHash[idColl] = valeur;
                      }

                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_blCons") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          blConsHash[idColl] = valeur;
                      }

                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_blN4ds") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          blN4dsHash[idColl] = valeur;
                      }

                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_blBasecarr") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          blBaseCarrHash[idColl] = valeur;
                      }
                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_blBilasocivide") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          blBilaSociVideHash[idColl] = valeur;
                      }

                      if(nameAtt.substring( nameAtt.indexOf("_") ) == "_idEnqucoll") {
                          var idColl = nameAtt.substring(0, nameAtt.indexOf("_"));
                          var valeur = valueAtt;
                          enquCollIdHash[idColl] = valeur;
                      }

                  }*/

            });

            var json = '"idEnquete":"'+id_enquete+'","enqueteCollList": [';

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
    $('#export-collectivite-enquete').on('click', function(e){
        e.preventDefault();
        var Array_collectivite = dtGetRowsBySelectedColl(suivi,'export', 'idColl');
       
        var Array_columns = [];
        var columns_to_show = $('#liste-colonnes').find('option');
        columns_to_show.each(function(){
            Array_columns.push($(this).val());
        });
        $('#list_id_collectivite').val(Array_collectivite);
        $('#listeColumns').val(Array_columns);
        $('#button_sender').val('export-suivi-enquete');

       if(Array_collectivite.length > 0){
            var url = Routing.generate('csv_prepar');
            var form = createFormToAjax(url,'POST',{
                'listIds' : Array_collectivite,
                'listeColumns' : Array_columns,
                'button_sender' : 'export-suivi-enquete'
            });
            
            $('body').append(form);
           form.submit();
       }else{
           e.preventDefault();
       }
    });

    $('#export-collectivite-historique').on('click', function(e){
        e.preventDefault();
        var Array_collectivite = dtGetRowsBySelectedColl(suivi,'export', 'idColl');
        $('#list_id_collectivite').val(Array_collectivite);

       if(Array_collectivite.length > 0){
            var url = Routing.generate('export_historique_echange');
            var form = createFormToAjax(url,'POST',{
                'listIds' : Array_collectivite,
            });
            
            $('body').append(form);
           form.submit();
       }else{
           e.preventDefault();
       }
    });
    
    $('#bsvide-collectivite-enquete').on('click', function(e){
        e.preventDefault();
        var Array_collectivite = dtGetRowsBySelectedColl(suivi,'export', 'idColl');
        var countColl = Array_collectivite.length;
        var txt = "Vous allez initialiser les bs à vide de "+ countColl +" collectivité(s). Cette action ne pourra pas être annulée. Êtes-vous sûr(e)?"
        $("#contentModalBsVide").html(txt);
        $("#modalbsvide").modal('show');
                                        
       
//        var Array_columns = [];
//        var columns_to_show = $('#liste-colonnes').find('option');
//        columns_to_show.each(function(){
//            Array_columns.push($(this).val());
//        });
//        
//        var countColl = Array_collectivite.length;
//        
//        
//        $('#list_id_collectivite').val(Array_collectivite);
//        $('#listeColumns').val(Array_columns);
//        $('#button_sender').val('bsvide-suivi-enquete');
//        
//       if(Array_collectivite.length > 0){
//            var url = Routing.generate('bsvidemass');
//            var form = createFormToAjax(url,'POST',{
//                'listIds' : Array_collectivite,
//                'listeColumns' : Array_columns,
//                'button_sender' : 'bsvide-suivi-enquete'
//            });
//            
//            $('body').append(form);
//           form.submit();
//       }else{
//           e.preventDefault();
//       }
    });
     $('#bsvide-confirmation').on('click', function(e){
        e.preventDefault();
        var Array_collectivite = dtGetRowsBySelectedColl(suivi,'export', 'idColl');
        var Array_columns = [];
        var columns_to_show = $('#liste-colonnes').find('option');
        columns_to_show.each(function(){
            Array_columns.push($(this).val());
        });
 
        $('#list_id_collectivite').val(Array_collectivite);
        $('#listeColumns').val(Array_columns);
        $('#button_sender').val('bsvide-suivi-enquete');
        
       if(Array_collectivite.length > 0){
            var url = Routing.generate('bsvidemass');
            var form = createFormToAjax(url,'POST',{
                'listIds' : Array_collectivite,
                'listeColumns' : Array_columns,
                'button_sender' : 'bsvide-suivi-enquete'
            });
            
            $('body').append(form);
           form.submit();
       }else{
           e.preventDefault();
       }
     });

});


function checkInput(id){
    if($.isNumeric(id)){
        if($('input[name^='+id+']:checkbox:checked').length == $('input[name^='+id+']:checkbox').length){
            $('button#'+id).removeClass('all');
            $('button#'+id).addClass('btn-primary');
            $('button#'+id).html('Aucun');
        }else{
            $('button#'+id).addClass('all');
            $('button#'+id).removeClass('btn-primary');
            $('button#'+id).html('Tous');
        }
    }else{
        if($('input[name$='+id+']:checkbox:checked').length == $('input[name$='+id+']:checkbox').length){
            $('button#'+id).removeClass('all');
            $('button#'+id).addClass('btn-primary');
            $('button#'+id).html('Aucun');
        }else{
            $('button#'+id).addClass('all');
            $('button#'+id).removeClass('btn-primary');
            $('button#'+id).html('Tous');
        }
    }
}

function initColonnes(vue,table){
    var removeArr = ['fgStat', 'fgStat-28'];
    var removeSuivi = ['email', 'blBilaSoci','blN4ds','blBilaSociVide','blBaseCarr', 'LB_ETAT_SAIS-15', 'blNbAgenPerm-24', 'blNbAgenTitu-25', 'blNbAgenContPerm-26', 'blNbAgenContNonPerm-27'];
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
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
