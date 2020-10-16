/* les select utilisé dans information collectivité affiche un label => 0 / 1 / 2 pour cacher ces élements, on initialise des class hidden sur chaques */
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_Etpr131AnneePrecedente').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_Etpr124AnneePrecedente').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_Etpr114AnneePrecedente').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_Sante').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_acteviolencephysique').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_Prevoyance').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_ConflitTravail').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_actionPrevention').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_AgentSanctionDisciplinaire').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationcolectiviteagent_AgentMotifSanctionDisciplinaire').addClass('hidden');
var $currentUser = $user;
var table_metier = '';
var sectionIds = ["section_statut", "section_remuneration", "section_absences",
    "section_formation", "section_autres", "section_gpeec"];

function _showHideTab(tabIdx) {
    var sectionId = sectionIds[tabIdx];
    $("section").each(function () {
        var me = $(this);
        if (me[0].id === sectionId) {
            me.show();
            $('#currentstep').val(tabIdx);
            if(tabIdx === 5){
                ajax_gpeec();
            }
        } else {
            me.hide();
        }
    });
}
function _toggleTabById(sectionId) {
    $("section").each(function () {
        var me = $(this);
        if (me[0].id === sectionId) {
            me.toggle();
            return false;
        }
    });
}
function _getPanelLinkById(sectionId) {
    var panel_link = $('#sidebar-wrapper a[data-target="'+sectionId+'"]');
    return panel_link;
} 

function _setPanelPourcentage(sectionId,pourcentage){
    var panel_link = _getPanelLinkById(sectionId);
    var range = $(panel_link).find('div.progress-bar');
    var value_lbl = $(panel_link).find('span.progress-completed');
    var sub_lbl = $(panel_link).find('p.progress-etat');
    $(range).attr('aria-valuenow',pourcentage).css('width',pourcentage+'%');
    $(value_lbl).text(parseInt(pourcentage)+'%');
    if(pourcentage==100){
        $(sub_lbl).text('Saisie cohérente');
    }else{
        $(sub_lbl).text('A saisir');
    }
}
var ajax_gpeec;

function disabledInputOnChange(hiddenSection, inputsArray) {
    if($('#'+hiddenSection).css('display') == 'block') {
        $.each(inputsArray, function(index, value) {
            $('#'+value).prop('readonly', false);
        });
    } else {
        $.each(inputsArray, function(index, value) {
            $('#'+value).prop('readonly', true);
        });
    }
}
function setOnEditAction(){
    $(document).on('click','.editAgentLink',function(event){
        event.preventDefault();
        var row_index = $(this).attr('data-index');
        var code_status = $(this).parents('table:first').attr('data-status');
        var url = $(this).attr('href');
        var form_to_submit = createFormToAjax(url,'post',{'row_index':row_index,'code_status':code_status});
        form_to_submit.submit();
    });
}
$(document).ready(function () {

    //vide le textarea si selection = "non" ou "ne sait pas"
    $('input:radio[name="bilan_social_bundle_apabundle_informationcolectiviteagent[blAutrgardenfa]"]').change(
        function(){
            if ($(this).is(':checked') && $(this).val() == '0' || $(this).val() == '2') {
                $('#bilan_social_bundle_apabundle_informationcolectiviteagent_blAutrgardenfaDescription').val('');
            }
        });

    $("#apaImportCourtier").on('click', function (e) {
        openBtpModal("#import_courtier");
    });


    $("input[name='bilan_social_bundle_apabundle_informationcolectiviteagent[q3110]']").on('change', function(){
       if($("input[name='bilan_social_bundle_apabundle_informationcolectiviteagent[q3110]']:checked").val() == 1){
           $('.q3111').removeClass('hidden');
       }else{
           $('.q3111').addClass('hidden');
           $("input[name='bilan_social_bundle_apabundle_informationcolectiviteagent[q3111]").prop("checked", false);
       }
    });
    $("input[name='bilan_social_bundle_apabundle_informationcolectiviteagent[q3110]']").change();
    setOnEditAction();
    displayTitleOrNot('section_statut');
    displayTitleOrNot('section_remuneration');
    displayTitleOrNot('section_absences');
    displayTitleOrNot('section_formation');
    displayTitleOrNot('section_autres');

    $('.next_prev_btn').on('click',function(event){
        var index_modif = $(this).attr('data-index-modif');
        var url = Routing.generate('bilansocialagent_nextprev_edit');
        var currentstep = $('#currentstep').val();
        var form_to_submit = createFormToAjax(url,'post',{'index_modif':index_modif, 'current_step': currentstep});
        form_to_submit.submit();
    });

   var input_positive_float = $('body').find('.positiveFloat');
    
    $(input_positive_float).each(function(){
        $(this).trigger('blur');
    });
    ajax_gpeec();
        
    jQuery('select:not(".ui-datepicker-year")').tipso({
        position: 'bottom',
        showArrow: false,
        useTitle: true,
        width: 500,
        delay: 0,
        hideDelay: 0,
        speed: 0
    });

    $('select:not(".ui-datepicker-year")').each(function() {
        var title = $(this).find(":selected").text();
        $(this).attr('title', title);
        
        if($(this).hasClass('rassct')) {
            if($(this).val() && $(this).is(':enabled')) {
                $(this, '.rassct').css('background', '#24819B');
                $(this, '.rassct').css('color', '#FFFFFF');
            } else {
                $(this, '.rassct').css('background', 'none');
                $(this, '.rassct').css('color', '#000000');
            }
        }
        $(this).removeAttr('title');
        if(title != '') {
            jQuery(this).tipso('update', 'content', title);
        } else {
            jQuery(this).tipso('update', 'content', 'Veuillez sélectionner une valeur');
        }
    });

    statut_hors_filiere();

    $(function () {
        $('input.date-picker').monthpicker({
            changeYear: true,
            yearRange: "-100:+0",
            minDate: "-100 Y",
            maxDate: "-15 Y",
            prevText: 'Précédent',
            //nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        });
        $('input.date-picker-q13').monthpicker({
            changeYear: false,
            minDate: new Date(anne_campagne, 0),
            maxDate: new Date(anne_campagne, 12 - 1),
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        });
    });
   

    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });

    //Disable mouse right click
    $("body").on("contextmenu", function (e) {
        return false;
    });

    $(document).on('mousedown', '.selectEntity', function (e) {
        $(this).hide();
        var BottomElement = document.elementFromPoint(e.clientX, e.clientY);
        $(this).show();
        $(BottomElement).mousedown(); //Manually fire the event for desired underlying element
        return false;
    });

    $('#menu_statut').on('click', function () {
        _showHideTab(0);
    });
    $('#menu_remu').on('click', function () {
        _showHideTab(1);
    });
    $('#menu_absence').on('click', function () {
        _showHideTab(2);
    });
    $('#menu_formation').on('click', function () {
        _showHideTab(3);
    });
    $('#menu_autre').on('click', function () {
        _showHideTab(4);
    });
    $('#menu_rassct').on('click', function () {
        _showHideTab(2);
    });
    $('#menu_handi').on('click', function () {
        _showHideTab(4);
    });
    $('#menu_gpeec').on('click', function () {
        _showHideTab(5);
    });
    $('#menu_dgcl').on('click', function () {
        _showHideTab(2);
    });
    
    refreshPanelPourcentage();
    /* Ajax concernant la partie Statut uniquement */
    function AjaxFiliereCategorie($html, categorie, filiere) {
        $.ajax({
            url: Routing.generate('ajax_cadre_emploi'),
            data: {
                id_category: categorie,
                id_filiere: filiere
            },
            method: 'POST',
            async: true,
            success: function (response) {
                var $tab = JSON.parse(response);
                $.each($tab, function (key, value) {

                    $html += "<option value='" + key + "'>" + value + "</option>";
                });
                $("#bilan_social_bundle_apabundle_bilansocialagent_RefCadreEmploi").html($html);
            },
            error: function (jqXHR, textStatus, errorThrown) {
    //                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
    }
    function ajaxCadreEmploiGrade(cadreEmploi, $html_grade) {
        $.ajax({
            url: Routing.generate('ajax_cadre_emploi_grade'),
            data: {
                id_cadreEmploi: cadreEmploi
            },
            method: 'POST',
            async: true,
            success: function (response) {
                var $tab_grade = JSON.parse(response);
                $.each($tab_grade, function (key, value) {

                    $html_grade += "<option value='" + key + "'>" + value + "</option>";
                });
                $("#bilan_social_bundle_apabundle_bilansocialagent_refGrade").html($html_grade);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
    }
    function ajax_statut_motif_depart(){
        
        var $html_motif_depart = "<option value=''>Selectionner un motif de depart</option>";
        var statut = $("#bilan_social_bundle_apabundle_bilansocialagent_refStatut").val();
        var checkbox_q41 = 0;
        if ($('#bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112_2').prop('checked') == true) {
            checkbox_q41 = $('#bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112_2').val();
        }

        $.ajax({
            url: Routing.generate('ajax_q41_status_motif_depart'),
            data: {
                statut: statut,
                value_checkbox: checkbox_q41
            },
            method: 'POST',
            async: true,
            success: function (response) {
                var $tab = response;
                $.each($tab, function (key, value) {

                    $html_motif_depart += "<option value='" + value.idMotidepa + "'>" + value.lbMotidepa + "</option>";
                });
                $("#bilan_social_bundle_apabundle_bilansocialagent_refMotifDepart").html($html_motif_depart);
            },//            error: function (jqXHR, textStatus, errorThrown) {
//                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            });
    }
    function ajax_statut_motif_arrivee(){
        var statut = $("#bilan_social_bundle_apabundle_bilansocialagent_refStatut").val();
        var $html_arrivee = "<option value=''> Selectionner un motif d'arrivée </option>";
        $.ajax({
            url: Routing.generate('ajax_motif_arrivee'),
            data: {
                statut: statut
            },
            method: 'POST',
            async: true,
            success: function (response) {


                var $tab_arrivee = JSON.parse(response);
                $.each($tab_arrivee, function (key, value) {

                    $html_arrivee += "<option value='" + key + "'>" + value + "</option>";
                });
                $("#bilan_social_bundle_apabundle_bilansocialagent_refMotifArrivee").html($html_arrivee);
            },
            error: function (jqXHR, textStatus, errorThrown) {
//                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
    }
    function ajax_statut_motif_deces(motifDepart = ""){

        if( motifDepart !== ""){
            $.ajax({
                url: Routing.generate('ajax_motif_deces'),
                data: {
                    idMotidepa: motifDepart
                },
                method: 'POST',
                async: true,
                success: function (response) {
                    if (response == 1) {
                        $("#deces").removeClass("hidden");
                    } else {
                        $("#deces").addClass("hidden");
                        var input_deces = $('#bilan_social_bundle_apabundle_bilansocialagent_cdMotidece input');
                        input_deces.each(function(){
                            $(this).prop('checked', false);
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
//                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
                }
            });
        }else{
            $("#deces").addClass("hidden");
            $("#bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112no").addClass("hidden");
            var input_deces = $('#bilan_social_bundle_apabundle_bilansocialagent_cdMotidece input');
            input_deces.each(function(){
                $(this).prop('checked', false);
            });
        }

    }
    function ajax_statut_mouvement_interne(statut){
        var $html_mouvement_interne_annee = "";
        $.ajax({
            url: Routing.generate('ajax_mouvement_interne_annee_status'),
            data: {
                statut: statut,
            },
            method: 'POST',
            async: true,
            success: function (response) {
//                console.log(response);
                var $tab = response;
                $.each($tab, function (key, value) {
                    if (value.cdMouvInteAnne === "MIA000") {
                        $html_mouvement_interne_annee += "<option selected value='" + value.idMouvinteannee + "'>" + value.lbMouvinteannee + "</option>";
                    } else {
                        $html_mouvement_interne_annee += "<option value='" + value.idMouvinteannee + "'>" + value.lbMouvinteannee + "</option>";
                    }
                });
                $("#bilan_social_bundle_apabundle_bilansocialagent_RefMouvinteanne").html($html_mouvement_interne_annee);
            },
            error: function (jqXHR, textStatus, errorThrown) {
//                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
    }
    function ajax_statut_categorie(){
        $("#bilan_social_bundle_apabundle_bilansocialagent_refGrade").val("");
        $("#bilan_social_bundle_apabundle_bilansocialagent_RefCadreEmploi").val("");
        var categorie = $("#bilan_social_bundle_apabundle_bilansocialagent_refCategorie").val();
        var filiere = $("#bilan_social_bundle_apabundle_bilansocialagent_refFiliere").val();
        var $html = "<option value=''>Selectionner un cadre d'emploi</option>";
        AjaxFiliereCategorie($html, categorie, filiere);
    }
    function ajax_statut_filiere(){
        $("#bilan_social_bundle_apabundle_bilansocialagent_refGrade").val("");
        $("#bilan_social_bundle_apabundle_bilansocialagent_RefCadreEmploi").val("");
        var categorie = $("#bilan_social_bundle_apabundle_bilansocialagent_refCategorie").val();
        var filiere = $("#bilan_social_bundle_apabundle_bilansocialagent_refFiliere").val();
        var $html = "<option value=''>Selectionner un cadre d'emploi</option>";
        AjaxFiliereCategorie($html, categorie, filiere);
    }
    function statut_hors_filiere(){
       if($("#bilan_social_bundle_apabundle_bilansocialagent_refStatut").children(':selected').val() == 4){
            $("#bilan_social_bundle_apabundle_bilansocialagent_refFiliere").val(12);
            $("#bilan_social_bundle_apabundle_bilansocialagent_refFiliere").prop('disabled', true);
        }
    }
    function ajax_statut_cadre_emploi(cadreEmploi){
        $("#bilan_social_bundle_apabundle_bilansocialagent_refGrade").val("");
//        var cadreEmploi = $(this).val();
        var $html_grade = "<option value=''>Selectionner un grade</option>";
        ajaxCadreEmploiGrade(cadreEmploi, $html_grade);
    }
    function ajax_statut_position_statutaire(){
        var statut = $("#bilan_social_bundle_apabundle_bilansocialagent_refStatut").val();
        $.ajax({
            url: Routing.generate('ajax_position_statutaire'),
            data: {
                statut: statut,
                user: $currentUser
            },
            method: 'POST',
            async: true,
            success: function (response) {
                var $tab_position = JSON.parse(response);
                $("#bilan_social_bundle_apabundle_bilansocialagent_refPositionStatutaire").html($tab_position);
            },
            error: function (jqXHR, textStatus, errorThrown) {
//                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
    }
    function ajax_statut_temps_partiel(q11){
        //todo voir regle de gestion d'affichage pour déclencher au bon moment l'appel ajax
        var $html_temps_partiel = "<option value=''>Selectionner un type de temps partiel</option>";
//        var value = $(this).val();
        $.ajax({
            url: Routing.generate('ajax_q11_1_q12_1'),
            data: {
                value: q11,
            },
            method: 'POST',
            async: true,
            success: function (response) {

                var $tab = response;
                $.each($tab, function (key, value) {

                    $html_temps_partiel += "<option value='" + value.idTemppart + "'>" + value.lbTemppart + "</option>";
                });
                $("#bilan_social_bundle_apabundle_bilansocialagent_refTempsPartiel").html($html_temps_partiel);
            },
            error: function (jqXHR, textStatus, errorThrown) {
//                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
    }
    /* Ajax concernant la partie Autre uniquement */
    function ajax_autres_inaptitude_deci(inaptitude){
        $.ajax({
            url: Routing.generate('ajax_inaptitude_filiere'),
            data: {
                inaptitude: inaptitude
            },
            method: 'POST',
            async: true,
            success: function (response) {

                if (response == 1) {
                    $('#FiliereInaptitude').removeClass('hidden');
                } else {
                    $('#FiliereInaptitude').addClass('hidden');
                    $('#bilan_social_bundle_apabundle_bilansocialagent_FiliereInaptitude').val("");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
//                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
    }
    
    
    // déclaration des variables utilisées par datatable pour ne pas les répéter x fois
    var language = {
        processing: "Traitement en cours...",
        search: "Rechercher&nbsp;:",
        lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
        info: "Affichage agent _START_ &agrave; _END_ sur _TOTAL_ agents",
        infoEmpty: "Affichage agent 0 &agrave; 0 sur 0 agents",
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
    var valider = ' <div class="progress" data-toggle="tooltip" data-placement="top" title="Validé"><div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div></div>';
    
    function strtrunc(str, max, add) {
        add = add || '...';
        return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };
    /* Mise en forme du tableau d'affichage des agents via datatable https://datatables.net/ */
    $('#listagent1').DataTable({
            "processing"    : false,
            "serverSide"    : false,
            "deferRender"   : true,
            "stateSave"     : true,
            "info"          : true,
            "ordering"      : true,
            "columnDefs" : [
                {'targets' : 4, 'render' : function(data){
                    data = strtrunc(data, 20);
                    return data;
                }},
                {'targets' : [10, 11], 'orderable' : false},
                {'targets' : '_all', 'orderable' : true}
            ],
            "columns": [
                {
                    type: 'title-string', targets: 0,
                    "data": null,
                    "render": function (data, type, row, meta) {
                    if (data.blAgenarriannecoll == '1' && data.blAgenremu3112 == '0' ) {
                       data = '<i title="4"class="fa fa-exchange fa-2x gradient_arrow" style="color:green" aria-hidden="true"></i>';
                    } else if((data.blAgenarriannecoll == '0' || data.blAgenarriannecoll == null) && data.blAgenremu3112 == '0'){
                        data = '<i title="1" class="fa fa-long-arrow-left fa-2x" style="color:red" aria-hidden="true"></i>'
                    }else if((data.blAgenarriannecoll == '0' || data.blAgenarriannecoll == null) && data.blAgenremu3112 == '1'){
                        data = '<i title="3" class="fa fa-pause rotate90 fa-2x" style="color:#1b1464; font-size: small" aria-hidden="true"></i>';
                    }else if(data.blAgenarriannecoll == '1' && data.blAgenremu3112 == '1'){
                        data = '<i title="2"class="fa fa-long-arrow-right fa-2x" style="color:green" aria-hidden="true"></i>';
                    }else{
                        data = '<i title="2" style="color:silver" aria-hidden="true">?</i>'
                    }
                    return data;
                    }
                },
                {"data": "idBilasociagen"},
                {"data": "lbNom"},
                {"data": "lbPren"},
                {"data": "commAgent"},
                {"data": "lbDatenais"},
                {
                    "data": null,
                    "render": function (data, type, row, meta) {

                        if (data.cdSexe === '1') {
                            data = "Homme";
                        } else {
                            data = "Femme";
                        }
                        return data;

                    }
                },
                {"data": "refStatut.lbStat"},
                {
                    "data": null,
                    "render": function (data, type, row, meta) {
                        //console.log(data.pcFillAgent);
                        if(data.pcFillAgent == 100){
                            data = valider;
                        }else if(data.pcFillAgent == 0){
                            var data = 'Non contrôlé';
                        }else{
                            var data = ' <div class="progress" data-toggle="tooltip" data-placement="top" title="Renseigné à '+data.pcFillAgent+'%"><div class="progress-bar progress-bar-grey" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '+data.pcFillAgent+'%;"></div></div>'
                        }
                        return data;
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row, meta) {
                        var rendered;
                        var image = '';
                        if (data.blBoeth == true) {
                            rendered = "<img title='boeth' class='width50px' src='/img/logo_boeth.png' alt='BOETH' />";
                        } else {
                            rendered = "";
                        }
                        return rendered;
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row, meta) {
                        if (type === 'display') {
                            var row_index = meta.row;
                            data = '<a class="editAgentLink" data-index="'+row_index+'" href=' + Routing.generate('bilansocialagent_edit', {idBilasociagen: data.idBilasociagen}) + '><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> '
                                + '<a class="confirmModalLink" data-href=' + Routing.generate('bilansocialagent_delete', {idBilasociagen: data.idBilasociagen}) + '><span class="glyphicon glyphicon-trash"></span></a>';
                        }
                        return data;
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row, meta) {
                            var data = '<input type=checkbox id='+data.idBilasociagen+' class="delCheckbox" value='+data.idBilasociagen+'>';
                       return data;
                    }
                }
            ],
            ajax: {
                url: Routing.generate('ajax_list_fonctionnaire'),
                type : 'POST',
                data : function(d){
                    return d;
                }    
            },
            language: language
    });

    $('#listagent2').DataTable({
        "processing"    : false,
        "serverSide"    : false,
        "deferRender"   : true,
        "stateSave"     : true,
        "info"          : true,
        "order"         : [[1,'asc']],
        "columnDefs" : [
            {'targets' : 4, 'render' : function(data){
                data = strtrunc(data, 20);
                return data;
            }},
            {'targets' : [10, 11], 'orderable' : false},
            {'targets' : '_all', 'orderable' : true}
            ],
        "columns": [
            {
                type: 'title-string', targets: 0,
                "data": null,
                "render": function (data, type, row, meta) {
                    if (data.blAgenarriannecoll == '1' && data.blAgenremu3112 == '0' ) {
                       data = '<i title="4"class="fa fa-exchange fa-2x gradient_arrow" style="color:green" aria-hidden="true"></i>';
                    } else if((data.blAgenarriannecoll == '0' || data.blAgenarriannecoll == null) && data.blAgenremu3112 == '0'){
                        data = '<i title="1" class="fa fa-long-arrow-left fa-2x" style="color:red" aria-hidden="true"></i>'
                    }else if((data.blAgenarriannecoll == '0' || data.blAgenarriannecoll == null) && data.blAgenremu3112 == '1'){
                        data = '<i title="3" class="fa fa-pause rotate90 fa-2x" style="color:#1b1464; font-size: small" aria-hidden="true"></i>';
                    }else if(data.blAgenarriannecoll == '1' && data.blAgenremu3112 == '1'){
                        data = '<i title="2"class="fa fa-long-arrow-right fa-2x" style="color:green" aria-hidden="true"></i>';
                    }else{
                        data = '<i title="5" style="color:darkgrey" aria-hidden="true">?</i>'
                    }
                    return data;
                }
            },
            {"data": "idBilasociagen"},
            {"data": "lbNom"},
            {"data": "lbPren"},
            {"data": "commAgent"},
            {"data": "lbDatenais"},
            {
                "data": null,
                "render": function (data, type, row, meta) {

                    if (data.cdSexe === '1') {
                        data = "Homme";
                    } else {
                        data = "Femme";
                    }
                    return data;

                }
            },
            {"data": "refStatut.lbStat"},
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    if(data.pcFillAgent == 100){
                        data = valider;
                    }else if(data.pcFillAgent == 0){
                        data = 'Non contrôlé';
                    }else{
                        data = ' <div class="progress" data-toggle="tooltip" data-placement="top" title="Renseigné à '+data.pcFillAgent+'%"><div class="progress-bar progress-bar-grey" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '+data.pcFillAgent+'%;"></div></div>'
                    }
                    return data;
                }
            },
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    var rendered;
                    var image = '';
                    if (data.blBoeth == true) {
                        rendered = "<img title='boeth' class='width50px' src='/img/logo_boeth.png' alt='BOETH' />";
                    } else {
                        rendered = "";
                    }
                    return rendered;
                }
            },
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    if (type === 'display') {
                        var row_index = meta.row;
                        data = '<a class="editAgentLink" data-index="'+row_index+'" href=' + Routing.generate('bilansocialagent_edit', {idBilasociagen: data.idBilasociagen}) + '><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> '
                            + '<a class="confirmModalLink" data-href=' + Routing.generate('bilansocialagent_delete', {idBilasociagen: data.idBilasociagen}) + '><span class="glyphicon glyphicon-trash"></span></a>';
                    }
                    return data;
                }
            },
            {
                    "data": null,
                    "render": function (data, type, row, meta) {
                            var data = '<input type=checkbox id='+data.idBilasociagen+' class="delCheckbox" value='+data.idBilasociagen+'>';
                       return data;
                    }
            }
        ],
        ajax: {
            "url": Routing.generate('ajax_list_emploipermanent'),
        },
        language: language
    });
    $('#listagent3').DataTable({
        "processing"    : false,
        "serverSide"    : false,
        "deferRender"   : true,
        "stateSave"     : true,
        "info"          : true,
        "order"         : [],
        "columnDefs" : [
            {'targets' : 4, 'render' : function(data){
                data = strtrunc(data, 20);
                return data;
            }},
            {'targets' : [10, 11], 'orderable' : false},
            {'targets' : '_all', 'orderable' : true}
            ],
        "columns": [
            {
                type: 'title-string', targets: 0,
                "data": null,
                "render": function (data, type, row, meta) {
                    if (data.blAgenarriannecoll == '1' && data.blAgenremu3112 == '0' ) {
                       data = '<i title="4"class="fa fa-exchange fa-2x gradient_arrow" style="color:green" aria-hidden="true"></i>';
                    } else if((data.blAgenarriannecoll == '0' || data.blAgenarriannecoll == null) && data.blAgenremu3112 == '0'){
                        data = '<i title="1" class="fa fa-long-arrow-left fa-2x" style="color:red" aria-hidden="true"></i>'
                    }else if((data.blAgenarriannecoll == '0' || data.blAgenarriannecoll == null) && data.blAgenremu3112 == '1'){
                        data = '<i title="3" class="fa fa-pause rotate90 fa-2x" style="color:#1b1464; font-size: small" aria-hidden="true"></i>';
                    }else if(data.blAgenarriannecoll == '1' && data.blAgenremu3112 == '1'){
                        data = '<i title="2"class="fa fa-long-arrow-right fa-2x" style="color:green" aria-hidden="true"></i>';
                    }else{
                        data = '<i title="2" style="color:silver" aria-hidden="true">?</i>';
                    }
                    return data;
                }
            },
            {"data": "idBilasociagen"},
            {"data": "lbNom"},
            {"data": "lbPren"},
            {"data": "commAgent"},
            {"data": "lbDatenais"},
            {
                "data": null,
                "render": function (data, type, row, meta) {

                    if (data.cdSexe === '1') {
                        data = "Homme";
                    } else {
                        data = "Femme";
                    }
                    return data;

                }
            },
            {"data": "refStatut.lbStat"},
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    if(data.pcFillAgent == 100){
                        data = valider;
                    }else if(data.pcFillAgent == 0){
                        data = 'Non contrôlé';
                    }else{
                        data = ' <div class="progress" data-toggle="tooltip" data-placement="top" title="Renseigné à '+data.pcFillAgent+'%"><div class="progress-bar progress-bar-grey" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '+data.pcFillAgent+'%;"></div></div>'
                    }
                    return data;
                }
            },
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    var rendered;
                    var image = '';
                    if (data.blBoeth == true) {
                        rendered = "<img title='boeth' class='width50px' src='/img/logo_boeth.png' alt='BOETH' />";
                    } else {
                        rendered = "";
                    }
                    return rendered;
                }
            },
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    if (type === 'display') {
                        var row_index = meta.row;
                        data = '<a class="editAgentLink" data-index="'+row_index+'" href=' + Routing.generate('bilansocialagent_edit', {idBilasociagen: data.idBilasociagen}) + '><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> '
                            + '<a class="confirmModalLink" data-href=' + Routing.generate('bilansocialagent_delete', {idBilasociagen: data.idBilasociagen}) + '><span class="glyphicon glyphicon-trash"></span></a>';
                    }
                    return data;
                }
            },
            {
                    "data": null,
                    "render": function (data, type, row, meta) {
                            var data = '<input type=checkbox id='+data.idBilasociagen+' class="delCheckbox" value='+data.idBilasociagen+'>';
                       return data;
                    }
            }
        ],
        ajax: {
            "url": Routing.generate('ajax_list_emploinonpermanent'),
        },
        language: language,
    });
    $('#listagent4').DataTable({

            "processing": false,
            "serverSide": false,
            "stateSave": true,
            "deferRender" : true,
            "columns": [
               
                {"data": "idBilasociagen"},
                {"data": "lbNom"},
                {"data": "lbPren"},
                {"data": "lbNatureEmploiN4ds"},
                {
                    "data": null,
                    "render": function (data, type, row, meta) {
                        if (type === 'display') {
                            var row_index = meta.row;
                            data = '<a class="editAgentLink" data-index="'+row_index+'" href=' + Routing.generate('bilansocialagent_edit', {idBilasociagen: data.idBilasociagen}) + '><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> '
                                + '<a class="confirmModalLink" data-href=' + Routing.generate('bilansocialagent_delete', {idBilasociagen: data.idBilasociagen}) + '><span class="glyphicon glyphicon-trash"></span></a>';
                        }
                        return data;
                    }
                }
            ],
            "deferRender": true,
            "order": [["0", "desc"], ["2", "asc"]],
            language: language
    });

    var theHREF;
    var idAgentDelete   = [];
    var nrAgents        = idAgentDelete.length;
    var singleAgent     = true;
    var several         = '';
    var idTable;
    var rows            = [];

    $('table').on('click', '.confirmModalLink', function (e) {
        e.preventDefault();
        rows            =[];
        idTable         = $(this).parents('table').attr('id');
        rows.push($('#'+idTable).DataTable().row($(this).closest('tr')).index());
        theHREF = $(this).attr("data-href");
        $("#confirmModal").modal("show");
    });

    $("#confirmModalNo").click(function (e) {
        $("#confirmModal").modal("hide");
    });
    $("#confirmModalYes").click(function (e) {
        ajax_delete_agent(idAgentDelete, idTable, rows);
    });

    function ajax_delete_agent(idAgentDelete, idTable, rows){
            $.ajax({
                url: theHREF,
                type: "GET",
                data: { deleteAgent  : idAgentDelete }, 
                dataType: "json",
                async: true,
                success: function (request) {
                            if ($('.flash .alert')[0] != undefined){
                                $('.flash .alert').remove();
                            }
                            $('#'+idTable).DataTable().row(rows).remove().draw();
                            $("#confirmModal").modal("hide");
                            $('.flash').prepend('<div class="alert alert-success text-center"><strong>'+request.message+'</strong></div>');   
                        },
                error:   function(request){
                          
                        }
            });
        }; 


    $('.del-several').on('click', function(){
        idAgentDelete   =[];
        several         = '';
        rows            =[];
        if ($('#confirmModalSeveral .text')[0] != undefined){
            $('#confirmModalSeveral .text').remove();
        }
        idTable         = $(this).parents('table').attr('id');
        $('#'+idTable).find($('.delCheckbox')).filter(':checked').each(function(){
            idAgentDelete.push($(this).val());
            rows.push($('#'+idTable).DataTable().row($(this).closest('tr')).index());
        });
        nrAgents        = idAgentDelete.length;
        if (nrAgents>1){
            singleAgent = false;
            several     = 's';
        }
        nrAgents=idAgentDelete.length;
        $(this).attr("data-target", "#confirmModalSeveral");
        $('#confirmModalSeveral .modal-body').prepend('<p class="text">Attention, vous allez supprimer '+nrAgents+' agent'+several+', l’ensemble des données saisies seront perdues.<br><br>Souhaitez-vous continuer ? </p>');

    });

    function ajax_delete_several(idAgentDelete, idTable, singleAgent, rows){
        $.ajax({
            url: Routing.generate('bilansocialagent_delete_several'),
            type: "POST",
            data: { deleteSeveral  : idAgentDelete ,
                    oneAgent       : singleAgent,
                  }, 
            dataType: "json",
            async: true,
            success: function (request) {
                        if ($('.flash .alert')[0] != undefined){
                            $('.flash .alert').remove();
                        }
                        $('#'+idTable).DataTable().rows(rows).remove().draw(); /*s(':checked')*/
                        $("#confirmModalSeveral").modal("hide");
                        $('.flash').prepend('<div class="alert alert-success text-center"><strong>'+request.message+'</strong></div>');      
                    },
            error:   function(request){
                       
                    }
        });
    }; 

    $("#confirmModalSeveralNo").click(function (e) {
        $("#confirmModalSeveral").modal("hide");
    });
    $('#confirmModalSeveralYes').on('click', function(){
        ajax_delete_several(idAgentDelete, idTable, singleAgent, rows);
    });

    /* Fin Mise en forme du tableau d'affichage des agents via datatable */

    var currentSpecialite = $('#currentSpecialite').val();
    function checkGpeecPlusInputSpecialite(){
        var inputs = $('#listspecialite').find("input[name='id_specialite']");
            $(inputs).prop("checked",false);
            $(inputs).filter("[value='"+currentSpecialite+"']").prop("checked",true);
            $(inputs).off('change').on('change',function(){
                var id_specialite = $(this).val();
                $('#currentSpecialite').val($(this).val());
                currentSpecialite = $(this).val();
        })
    }
    
    var is_radio_specialite_checked = false;
    $('#listspecialite').DataTable({
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage métier _START_ &agrave; _END_ sur _TOTAL_ métiers",
            infoEmpty: "Affichage métier 0 &agrave; 0 sur 0 métiers",
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
        "lengthMenu": [15, 30, 45, 60],
        "columns": [
            null,
            {
                render: function (data, type, row, meta) {
                    //var val = row[2];
                    var checked = currentSpecialite == data ? "checked" :  "";
                    var radio = '<input type="radio" name="id_specialite" value="' + data +'" '+checked+'/>';
                    return radio;
                }
            }
        ],
        "processing": true,
        "order": [],
        "pageLength": 15,
        "serverSide": false,
        ajax: {
            url: Routing.generate('ajax_get_specialite'),
            data: function (d) {
                d.idDomaineSpecialite = $('#domaineSpecialite').val();
                return d;
            }
        },
        fnDrawCallback: function (oSettings) {
            $("input[name='id_specialite']").not('[value="' + is_radio_specialite_checked + '"]').prop('checked', false);
            checkGpeecPlusInputSpecialite();
        },
        initComplete : function(setting,json){
            checkGpeecPlusInputSpecialite();
            refreshPanelPourcentage();
        }
    });

    $('#listspecialite').on('page.dt', function (event, setting) {
        if (is_radio_specialite_checked !== false) {
            var dt = $('#listspecialite').DataTable();
            var rows = dt.rows();
            for (var row_i in rows) {
    //               var row_node = dt.row(row_i).node();
    //               $(row_node).find('input[type="radio"]').not('[value="'+is_radio_metier_checked+'"]').prop('checked',false);
    //               console.log("test");
                //var radio_btn = data[2];
                //var unchecked_radio_btn = radio_btn.replace('/checked(=("|\')true("|\'))?/','');
                //data[2]=unchecked_radio_btn;
                // dt.row(row_i).data(data).draw();
            }
        }
    });

    // $('#mytable1').dataTable( {
    //     "scrollX": true,
    //     "scrollY": true,
        // iDisplayLength: false,
        // lengthMenu: false,
        // language: {
        //     processing: false,
        //     search: false,
        //     lengthMenu: false,
        //     info: false,
        //     infoEmpty: false,
        //     infoFiltered: "",
        //     infoPostFix: "",
        //     loadingRecords: false,
        //     zeroRecords: false,
        //     emptyTable: false,
        //     paginate: {
        //         first: "Premier",
        //         previous: "Pr&eacute;c&eacute;dent",
        //         next: "Suivant",
        //         last: "Dernier"
        //     },
    // });
    // ,),;

    $('#listspecialite').on('click', 'input[name="id_specialite"]', function () {
        var val = $(this).val();
        $("#bilan_social_bundle_apabundle_bilansocialagent_GpeecPlus_refSpecialite option").each(function () {
            var selectVal = $(this).val();
            if (selectVal === val) {
                $(this).attr('selected', true);
            } else {
                $(this).attr('selected', false);
            }
        });
    });

    $('#domaineSpecialite').on('change', function (event) {
        $('#listspecialite').DataTable().ajax.reload();
    })

    $('#listspecialite').on('click', 'input[name="id_specialite"]', function (even) {
        var checked = $(this).prop('checked');
        if (checked) {
            is_radio_specialite_checked = $(this).val();

        }
    })

    /**
     *  début agent par agent - tableau dynamiques
     */
    initBtnsRemoveAProtoFormLine();
    initBtnsAddAProtoFormLine([
        '#add-RemunerationGlobaleAgent',
        '#add-HeuSuppReaRemAgent',
        '#add-HeuCompReaRemAgent',
        '#add-AbsenceArretAgents',
        '#add-FormationAgents',
        {
            'element':'#add-etpragent',
            'post_callback':function(form_body){
                $(form_body).find('input.date-picker-q13').monthpicker({
                    changeYear: false,
                    minDate: new Date(anne_campagne, 0),
                    maxDate: new Date(anne_campagne, 12 - 1),
                    prevText: 'Précédent',
                    nextText: 'Suivant',
                    currentText: 'Aujourd\'hui',
                    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                });
            }
        }
    ]);
    initBtnsAddAProtoFormLine([

        {
            'element':'#add-RemunerationAgent',
            'post_callback':function(form_body){
                $(form_body).find('input.date-picker-q13').monthpicker({
                    changeYear: false,
                    minDate: new Date(anne_campagne, 0),
                    maxDate: new Date(anne_campagne, 12 - 1),
                    prevText: 'Précédent',
                    nextText: 'Suivant',
                    currentText: 'Aujourd\'hui',
                    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                });
            }
        }
    ]);
    /* FIN TABLEAU DYNAMIQUE */


    /* Gestion des erreurs de cohérences*/
    $('#bilan_social_bundle_apabundle_informationcolectiviteagent_nmAnnecrea').on('change', function () {

        if ($(this).val() < 1980 || $(this).val() > anneCreaCamp) {
            $(this).closest('.form-group').addClass('has-error');
            $('#encours').removeClass('hidden');
        } else {
            $(this).closest('.form-group').removeClass('has-error');
            $('#encours').addClass('hidden');
        }


    });
    $('#bilan_social_bundle_apabundle_informationcolectiviteagent_nmAnnedernmaj').on('change', function () {


        if ($(this).val() < $('#bilan_social_bundle_apabundle_informationcolectiviteagent_nmAnnecrea').val() || $(this).val() > anneCreaCamp) {
            $(this).closest('.form-group').addClass('has-error');
            $('#maj').removeClass('hidden');
        } else {
            $(this).closest('.form-group').removeClass('has-error');
            $('#maj').addClass('hidden');
        }


    });

    /* Fin de gestion des erreurs de cohérences*/
    
    /* conditionnement des appels ajax */
    $("#bilan_social_bundle_apabundle_bilansocialagent_refInapdeci").on('change',function () {
      ajax_autres_inaptitude_deci($(this).val());
    });
    $("#bilan_social_bundle_apabundle_bilansocialagent_refStatut").on('change', function (event, reset) {
        if(reset !== true){
            statut = $(this).val();
            ajax_statut_mouvement_interne(statut);
           
            if($("#bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112_1").is(':checked')){
                ajax_statut_motif_depart();
                ajax_statut_motif_deces();
            }
        }
        statut_hors_filiere();
    });
    $("#bilan_social_bundle_apabundle_bilansocialagent_blPosiacti_1").on('click', function(){
           ajax_statut_position_statutaire();
    });
    $("#bilan_social_bundle_apabundle_bilansocialagent_blAgenarriannecoll_0").on('click', function(){
           ajax_statut_motif_arrivee();
    });
    $("#bilan_social_bundle_apabundle_bilansocialagent_refStageTitularisation").on('change', function(){
           ajax_statut_motif_titularisation($(this).val());
    });
     $("#bilan_social_bundle_apabundle_bilansocialagent_refMotifDepart").on('change', function(){
         
           ajax_statut_motif_deces($(this).val());
    });

    $("#bilan_social_bundle_apabundle_bilansocialagent_refMotifDepart").change();


    $("#bilan_social_bundle_apabundle_bilansocialagent_refFiliere").on('change', function(event, reset){
         if(reset !== true){
            ajax_statut_filiere();
        }
    });
    $("#bilan_social_bundle_apabundle_bilansocialagent_refCategorie").on('change', function(event, reset){
         if(reset !== true){
            ajax_statut_categorie();
        }
    });
    $("#bilan_social_bundle_apabundle_bilansocialagent_RefCadreEmploi").on('change', function(event, reset){
         if(reset !== true){
            ajax_statut_cadre_emploi($(this).val());
        }
    });
    $('#bilan_social_bundle_apabundle_bilansocialagent_blTempcomp').on('change', function(){
       input_val = $('input[name="bilan_social_bundle_apabundle_bilansocialagent[blTempcomp]"]:checked').val();
       ajax_statut_temps_partiel(input_val);
    });
    
    var AllStatutEtpr = $('.form1').find('.refStatutEtpr');

    $('.form1').on('change', '.refStatutEtpr', function () {
        DisableFieldEtprByStatut(this)
    });

    $(AllStatutEtpr).each(function () {
        DisableFieldEtprByStatut(this);
    });


    $('.form1').on('change', '.SelectFiliere', function () {
//        console.log($(this));
        launchAjaxOnFiliereEtpr($(this));
    });

    function launchAjaxOnFiliereEtpr(selectFiliere) {
        var $html_cadre_emploi_select = '';
        var cdFili = $(selectFiliere).val();
        var CurrentValueSelectCadreEmploi = $(selectFiliere).parent().next().find('.SelectCadreEmploi').find('option');
        var CadreEmploiValue = '';
        $(CurrentValueSelectCadreEmploi).each(function () {
            if ($(this).attr('selected') == 'selected') {
                CadreEmploiValue = $(this).val();
                return false;
            }
        });
        if (cdFili == 'CU') {
            $.ajax({
                url: Routing.generate('ajax_get_cadreemploi_by_filiere_etpr'),
                data: {
                    codeFili: cdFili,
                },
                method: 'POST',
                async: true,
                success: function (response) {
                    var $tab = response;

                    $.each($tab, function (key, value) {
                        if (key == CadreEmploiValue) {
                            $html_cadre_emploi_select += "<option selected='selected' value='" + key + "'>" + value + "</option>";
                        } else {
                            $html_cadre_emploi_select += "<option value='" + key + "'>" + value + "</option>";
                        }
                    });
                    $(selectFiliere).parent().next().find('.SelectCadreEmploi').prop('disabled', false);
                    $(selectFiliere).parent().next().find('.SelectCadreEmploi').html($html_cadre_emploi_select);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
                }
            });
        }else{
            $(selectFiliere).parent().next().find('.SelectCadreEmploi').prop('disabled', true);
            $(selectFiliere).parent().next().find('.SelectCadreEmploi').html($html_cadre_emploi_select);
        }

    }

    function DisableFieldEtprByStatut(select) {

        var CurrentSelect = select;
        if ($(select).val() === 'CONTNONPERM') {
//                    alert('CONTNONPERM');
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').val('');
            $(CurrentSelect).parent().nextAll().find('.SelectCadreEmploi').val('');
            $(CurrentSelect).parent().nextAll().find('.SelectCadreEmploi').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.etprCalcule ').change();

        } else {
//                    alert('else');
            $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').val('');
            $(CurrentSelect).parent().nextAll().find('.SelectCadreEmploi').val('');
            $(CurrentSelect).parent().nextAll().find('.SelectCadreEmploi').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.etprCalcule ').change();
        }
    }

    $('.form2').on('change', '.refStatutRemuneration', function () {


        var CurrentSelect = this;

        if ($(this).val() === '1' || $(this).val() === '2') {
            $(CurrentSelect).parent().nextAll().find('.NBI').prop('disabled', false);

        } else {
            $(CurrentSelect).parent().nextAll().find('.NBI').val('');
            $(CurrentSelect).parent().nextAll().find('.NBI').prop('disabled', true);
        }

        if ($(this).val() === '4') {
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SelectCategorie').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').val('');
            $(CurrentSelect).parent().nextAll().find('.SelectCategorie').val('');



        } else {
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').val();
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').prop('disabled', false);

            $(CurrentSelect).parent().nextAll().find('.SelectCategorie').val();
            $(CurrentSelect).parent().nextAll().find('.SelectCategorie').prop('disabled', false);

        }
    });


    $('.form1').on('change', '.refStatutRemuneration', function () {


        var CurrentSelect = this;


        if ($(this).val() === '4' ) {
            $(CurrentSelect).parent().nextAll().find('.SelectBlTempsComp').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SelectCategorie').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.Prime').prop('disabled', true);
            // $(CurrentSelect).parent().nextAll().find('.NBI').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.HcHs').prop('disabled', true);
            // $(CurrentSelect).parent().nextAll().find('.SFT').prop('disabled', true);
            // $(CurrentSelect).parent().nextAll().find('.IR').prop('disabled', true);
            // $(CurrentSelect).parent().nextAll().find('.HeureSupp').prop('disabled', true);
            // $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', true);
            
            
            $(CurrentSelect).parent().nextAll().find('.SelectBlTempsComp').val('');
            $(CurrentSelect).parent().nextAll().find('.SelectCategorie').val('');
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').val('');
            $(CurrentSelect).parent().nextAll().find('.Prime').val('');
            // $(CurrentSelect).parent().nextAll().find('.NBI').val('');
            $(CurrentSelect).parent().nextAll().find('.HcHs').val('');
            // $(CurrentSelect).parent().nextAll().find('.SFT').val('');
            // $(CurrentSelect).parent().nextAll().find('.IR').val('');
            $(CurrentSelect).parent().nextAll().find('.HeureSupp').val('');
            // $(CurrentSelect).parent().nextAll().find('.HeureCompl').val('');
            

        } else {
            $(CurrentSelect).parent().nextAll().find('.SelectBlTempsComp').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.SelectCategorie').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.SelectFiliere').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.Prime').prop('disabled', false);
            // $(CurrentSelect).parent().nextAll().find('.NBI').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.HcHs').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.SFT').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.IR').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.HeureSupp').prop('disabled', false);
            // $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', false);

        }

        // if ($(this).val() === '3' ) {
        //     // $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').prop('disabled', true);
        //     // $(CurrentSelect).parent().nextAll().find('.NBI').prop('disabled', true);
        //     // $(CurrentSelect).parent().nextAll().find('.SFT').prop('disabled', true);
        //     $(CurrentSelect).parent().nextAll().find('.IR').prop('disabled', true);
        //     $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', true);
        //     // $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').val('');
        //     // $(CurrentSelect).parent().nextAll().find('.NBI').val('');
        //     // $(CurrentSelect).parent().nextAll().find('.SFT').val('');
        //     $(CurrentSelect).parent().nextAll().find('.IR').val('');
        //     $(CurrentSelect).parent().nextAll().find('.HeureCompl').val('');
        //
        // } else {
        //     // $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').prop('disabled', false);
        //     // $(CurrentSelect).parent().nextAll().find('.NBI').prop('disabled', false);
        //     $(CurrentSelect).parent().nextAll().find('.SFT').prop('disabled', false);
        //     $(CurrentSelect).parent().nextAll().find('.IR').prop('disabled', false);
        //     $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', false);
        // }

        // if ($(this).val() === '1' || $(this).val() === '2') {
        //     $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', true);
        //     // $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').prop('disabled', true);
        //     $(CurrentSelect).parent().nextAll().find('.HeureCompl').val('');
        //     // $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').val('');
        //
        // } else {
        //     $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', false);
        //     // $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').prop('disabled', false);
        // }

        if ($(this).val() === '1' || $(this).val() === '2' || $(this).val() === '3') {
            $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').val('');

        } else {
            $(CurrentSelect).parent().nextAll().find('.SelectEmploiNonPermanent').prop('disabled', false);
        }

        // if ($(this).val() === '1' || $(this).val() === '2' || $(this).val() === '3' || $(this).val() === '4') {
        //     $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', true);
        //     $(CurrentSelect).parent().nextAll().find('.HeureCompl').val('');
        //
        // } else {
        //     $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', false);
        // }

        if ( $(this).val() === '3' || $(this).val() === '4') {
            $(CurrentSelect).parent().nextAll().find('.NBI').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.SFT').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.IR').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.NBI').val('');
            $(CurrentSelect).parent().nextAll().find('.SFT').val('');
            $(CurrentSelect).parent().nextAll().find('.IR').val('');

        } else {
            $(CurrentSelect).parent().nextAll().find('.NBI').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.SFT').prop('disabled', false);
            $(CurrentSelect).parent().nextAll().find('.IR').prop('disabled', false);
        }


    });


    $('.form1').on('change', '.SelectCadreEmploi', function () {
        $('.etprCalcule').each(function () {
            $(this).change();
        });
    });

    $('.form1').on('change', '.SelectBlTempsComp', function () {
        var CurrentSelect = this;
        if ($(this).val() === '1' || $(this).val() === '2' ) {
            $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', true);
            $(CurrentSelect).parent().nextAll().find('.HeureCompl').val('');
        } else {
            $(CurrentSelect).parent().nextAll().find('.HeureCompl').prop('disabled', false);
        }
    });


    $('.form6 , .form7').on('change', '.SelectStatus', function () {
        var CurrentSelect = this;

        if ($(this).val() === '1' || $(this).val() === '2') {
            $(CurrentSelect).parent().nextAll().find('.SelectBlTempsComp').prop('disabled', false);

        } else {
            $(CurrentSelect).parent().nextAll().find('.SelectBlTempsComp').val('');
            $(CurrentSelect).parent().nextAll().find('.SelectBlTempsComp').prop('disabled', true);
        }
    });

    $('.SelectStatus').change();

    $('.form6').on('change', '.SelectFiliere', function () {
        var $html_cadre_emploi = '';
        var CurrentSelect = this;
        if ($(CurrentSelect).parent().next().find('.SelectCadreEmploi').val() === '') {

            $html_cadre_emploi = "<option value=''>Selectionner un cadre emploi</option>";
        } else {
            $html_cadre_emploi = "<option value='" + $(CurrentSelect).parent().next().find('.SelectCadreEmploi').val() + "'>" + $(CurrentSelect).parent().next().find('.SelectCadreEmploi').children(':selected').text() + "</option>";
        }


        idFili = $(this).val();
        $.ajax({
            url: Routing.generate('ajax_get_cadreemploi_by_filiere_heure_supp'),
            data: {
                idFili: idFili,
            },
            method: 'POST',
            async: true,
            success: function (response) {
//                           console.log(response);
                var $tab = response;

                $.each($tab, function (key, value) {
                    $html_cadre_emploi += "<option value='" + key + "'>" + value + "</option>";
                });

                $(CurrentSelect).parent().next().find('.SelectCadreEmploi').html($html_cadre_emploi);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                //                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
    });

    $('.form7').on('change', '.SelectFiliere', function () {
        var $html_cadre_emploi = '';
        var CurrentSelect = this;
        if ($(CurrentSelect).parent().next().find('.SelectCadreEmploi').val() === '') {

            $html_cadre_emploi = "<option value=''>Selectionner un cadre emploi</option>";
        } else {
            $html_cadre_emploi = "<option value='" + $(CurrentSelect).parent().next().find('.SelectCadreEmploi').val() + "'>" + $(CurrentSelect).parent().next().find('.SelectCadreEmploi').children(':selected').text() + "</option>";
        }


        idFili = $(this).val();
        $.ajax({
            url: Routing.generate('ajax_get_cadreemploi_by_filiere_heure_supp'),
            data: {
                idFili: idFili,
            },
            method: 'POST',
            async: true,
            success: function (response) {
//                           console.log(response);
                var $tab = response;

                $.each($tab, function (key, value) {
                    $html_cadre_emploi += "<option value='" + key + "'>" + value + "</option>";
                });

                $(CurrentSelect).parent().next().find('.SelectCadreEmploi').html($html_cadre_emploi);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                //                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
    });


    $('.SelectCadreEmploi').change();
    $('.refStatutRemuneration ').change();
    $('.refStatutRemuneration ').change();

    var SelectFiliereForm1 = $('.form1').find('.SelectFiliere');

    SelectFiliereForm1.each(function () {
        $(this).change();
    });

    $('.form1').on('change', '.SelectFiliere', function() {
        var nbHeureValue = $(this).parents('tr').find('.etprCalcule ').val();
        var value = nbHeureValue / 1820.04;
        $(this).parents('tr').find('.etprInput').val(value.toFixed(2));
    });

    $('.form1').on('change', '.etprCalcule', function () {

        var valueCadreEmploi = $(this).parents('tr').find('.SelectCadreEmploi').val();
        var nbHeureValue = $(this).parents('tr').find('.etprCalcule ').val();
        
        if (valueCadreEmploi !== null) {
            if (valueCadreEmploi === 'CE017') {
                // todo mettre le bon calcule ici
                var value = nbHeureValue / 832.02;
                $(this).parents('tr').find('.etprInput').val(value.toFixed(2));
            } else if (valueCadreEmploi === 'CE019') {
                var value = nbHeureValue / 1040.02;
                $(this).parents('tr').find('.etprInput').val(value.toFixed(2));
            } else {
                var value = nbHeureValue / 1820.04;
                $(this).parents('tr').find('.etprInput').val(value.toFixed(2));
            }
        } else {
            var value = nbHeureValue / 1820.04;
            $(this).parents('tr').find('.etprInput').val(value.toFixed(2));
        }
    });

    /*Calcule du ratio automatique pour la question 3.4.4 */

    $('#bilan_social_bundle_apabundle_informationcolectiviteagent_mtCharpers').on('change', function () {
        var ChargePersonnel = $(this).val();
        var DepenseFonctionnement = $('#bilan_social_bundle_apabundle_informationcolectiviteagent_mtDepefonccoll').val();
        var ratio = (ChargePersonnel / DepenseFonctionnement) * 100;
        if (isFinite(ratio)) {
            $('#bilan_social_bundle_apabundle_informationcolectiviteagent_lbRati').val(ratio.toFixed(1));
        } else {
            $('#bilan_social_bundle_apabundle_informationcolectiviteagent_lbRati').val('');
        }

    });

    $('#bilan_social_bundle_apabundle_informationcolectiviteagent_mtDepefonccoll').on('change', function () {
        var ChargePersonnel = $('#bilan_social_bundle_apabundle_informationcolectiviteagent_mtCharpers').val();
        var DepenseFonctionnement = $(this).val();
        var ratio = (ChargePersonnel / DepenseFonctionnement) * 100;
        if (isFinite(ratio)) {
            $('#bilan_social_bundle_apabundle_informationcolectiviteagent_lbRati').val(ratio.toFixed(1));
        } else {
            $('#bilan_social_bundle_apabundle_informationcolectiviteagent_lbRati').val('');
        }
    });

    toggleDisableRassctField();
    toggleDisabledArretField();
    toggleNbJourAbsence();
    toggleDisabledMaladiePro();

    // Affichage de la bonne section
    _showHideTab(index);
    if (isset($('#current_step_from_other_agent').val()) && $('#current_step_from_other_agent').val() != -1) {
        _showHideTab($('#current_step_from_other_agent').val());
    }
    
    var arrayOnIdentityToHide = ['bilan_social_bundle_apabundle_bilansocialagent_lbNom', 'bilan_social_bundle_apabundle_bilansocialagent_lbPren'];
    disabledInputOnChange('section_statut', arrayOnIdentityToHide);
});

$(document).on('click', '.each_menu_apa', function() {
    var arrayOnIdentityToHide = ['bilan_social_bundle_apabundle_bilansocialagent_lbNom', 'bilan_social_bundle_apabundle_bilansocialagent_lbPren'];
    disabledInputOnChange('section_statut', arrayOnIdentityToHide);
});

$(document).on('change', function () {
    $('.input-date').datepicker({
        language: "fr"
    });
    toggleDisableRassctField();
    toggleDisabledArretField();
    toggleNbJourAbsence();
    toggleDisabledMaladiePro();
   
});

$(document).on('change', 'select', function() {
    var title = $(this).find(":selected").text();
    $(this).attr('title', title);
    if($(this).hasClass('rassct')) {
        if($(this).val() && $(this).is(':enabled')) {
            $(this, '.rassct').css('background', '#24819B');
            $(this, '.rassct').css('color', '#FFFFFF');
        } else {
            $(this, '.rassct').css('background', 'none');
            $(this, '.rassct').css('color', '#000000');
        }
    }
    $(this).removeAttr('title');
    if(title != '') {
        jQuery(this).tipso('update', 'content', title);
    } else {
        jQuery(this).tipso('update', 'content', 'Veuillez sélectionner une valeur');
    }
});

var addLine = $('.glyphicon-plus').closest('button');
$(document).on('click', addLine, function() {
    jQuery('select:not(".ui-datepicker-year")').tipso({
        position: 'bottom',
        showArrow: false,
        content: 'Veuillez sélectionner une valeur',
        width: 500,
        delay: 0,
        hideDelay: 0,
        speed: 0
    });
});

function toggleDisableRassctField() {

    $('.RascctSelect').each(function () {
        if ($(this).val() === 'ABS003' || $(this).val() === 'ABS004') {
            var CurrentTr = $(this).closest('tr');
            CurrentTr.find('.rassct').each(function () {
                $(this).prop('disabled', false);
                if(!$(this).val()) {
                    $(this, '.rassct').css({
                        'background' : 'none',
                        'color' : '#000'
                    });
                }
            });
            CurrentTr.find('.accidentAvecArret').each(function () {
                $(this).prop('disabled', false);
                if(!$(this).val()) {
                    $(this, '.rassct').css({
                        'background' : 'none',
                        'color' : '#000'
                    });
                }
            });
        } else if ($(this).val() !== '') {
            var CurrentTr = $(this).closest('tr');
            CurrentTr.find('.arretTravail003_004').each(function () {
                $(this).prop('disabled', true);
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).val('');
            });
            CurrentTr.find('.accidentAvecArret').each(function () {
                $(this).prop('disabled', true);
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).val('');
            });
        }else{
            var CurrentTr = $(this).closest('tr');
            CurrentTr.find('.arretTravail003_004').each(function () {
                $(this).prop('disabled', true);
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).val('');
            });
            CurrentTr.find('.accidentAvecArret').each(function () {
                $(this).prop('disabled', true);
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).val('');
            });
        }
    });

};

function toggleDisabledArretField() {
    $('.RascctSelect').each(function () {
        if ($(this).val() === 'ABS003' || $(this).val() === 'ABS004' || $(this).val() === 'ABS005') {
            var CurrentTr = $(this).closest('tr');
            CurrentTr.find('.nbArret').each(function (k,v) {
                $(this).prop('disabled', true);
                var absAvecArret = CurrentTr.find('.accidentAvecArret').val();
                var motifAbs = CurrentTr.find('.RascctSelect').val()
                if(absAvecArret == 1 && (motifAbs == "ABS003" || motifAbs == "ABS004")){
                    $(v).val(1);
                }else{
                    $(this).val('');
                }
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });

            });
            CurrentTr.find('.anneeEvenement').each(function () {
                $(this).prop('disabled', false);
                if(!$(this).val()) {
                    $(this, '.rassct').css({
                        'background' : 'none',
                        'color' : '#000'
                    });
                }
            });
        } else if ($(this).val() !== '') {
            var CurrentTr = $(this).closest('tr');
            CurrentTr.find('.nbArret').each(function () {
                $(this).prop('disabled', false);
                //if(!$(this).val()) {
                    $(this, '.rassct').css({
                        'background' : 'none',
                        'color' : '#000'
                    });
                //}
            });
            CurrentTr.find('.anneeEvenement').each(function () {
                $(this).prop('disabled', true);

                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).prop('selectedIndex', 1);
            });
        }else{
            var CurrentTr = $(this).closest('tr');
            CurrentTr.find('.nbArret').each(function () {
                $(this).val('');
                $(this).prop('disabled', true);
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).val('');
            });
            CurrentTr.find('.anneeEvenement').each(function () {
                $(this).prop('disabled', true);
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).prop('selectedIndex', 1);
            });
        }
    });
}

function toggleDisabledMaladiePro() {
    $('.RascctSelect').each(function () {
        if ($(this).val() === 'ABS005') {
            var CurrentTr = $(this).closest('tr');
            CurrentTr.find('.rassctMaladiePro').each(function () {
                $(this).prop('disabled', false);
                if(!$(this).val()) {
                    $(this, '.rassct').css({
                        'background' : 'none',
                        'color' : '#000'
                    });
                }
            });
        } else if ($(this).val() !== '') {
            var CurrentTr = $(this).closest('tr');
            CurrentTr.find('.rassctMaladiePro').each(function () {
                $(this).prop('disabled', true);
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).val('');
            });
        }else{
            var CurrentTr = $(this).closest('tr');
            CurrentTr.find('.rassctMaladiePro').each(function () {
                $(this).prop('disabled', true);
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).val('');
            });
        }
    });
}

function toggleNbJourAbsence() {
    $('.accidentAvecArret').each(function () {
        var CurrentTr = $(this).closest('tr');
        if($.inArray(CurrentTr.find('.RascctSelect').val(),['ABS003','ABS004'])!=-1){
                if ($(this).val() === '1') {
                CurrentTr.find('.nbJourAbs').each(function () {
                    $(this).prop('disabled', false);
                    if(!$(this).val()) {
                        $(this, '.rassct').css({
                            'background' : 'none',
                            'color' : '#000'
                        });
                    }
                });
            } else{
                CurrentTr.find('.nbJourAbs').each(function () {
                    $(this).prop('disabled', true);
                    $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                    $(this).val('');
                });
            }
        }else if(CurrentTr.find('.RascctSelect').val()!=""){
            CurrentTr.find('.nbJourAbs').each(function () {
                $(this).prop('disabled', false);
                if(!$(this).val()) {
                    $(this, '.rassct').css({
                        'background' : 'none',
                        'color' : '#000'
                    });
                }
            });
        }else{
            CurrentTr.find('.nbJourAbs').each(function () {
                $(this).prop('disabled', true);
                $(this, '.rassct').css({
                    'background' : '#EEE',
                    'color' : '#000'
                });
                $(this).val('');
            });
        }
    });
}


$("#generer_conso").on('click',function(event){
    event.preventDefault();
    var is_all_apa_valid = $(this).attr('data-all-apa-valid');
    var href = $(this).attr('href');
    var modal;
    if(is_all_apa_valid==1){
        modal = $("#confirmToConsolideModalAllValid");
    }else{
        modal = $("#confirmToConsolideModalNotAllValid");
    }
    $(modal).modal("show");
    $(modal).off("click",".confirmToConsolideModalYes");
    $(modal).on("click",".confirmToConsolideModalYes",function(){
        window.location = href;
    });
})
    /* Ajax concernant la partie Gpeec uniquement */
function ajax_gpeec(){
        var is_radio_metier_checked = false;
        var currentMetier = $('#currentMetier').val();
        if ( ! $.fn.DataTable.isDataTable( '#listmetier' ) ) {
            table_metier = $('#listmetier').dataTable(({
                    language: {
                        processing: "Traitement en cours...",
                        search: "Rechercher&nbsp;:",
                        lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                        info: "Affichage métier _START_ &agrave; _END_ sur _TOTAL_ métiers",
                        infoEmpty: "Affichage métier 0 &agrave; 0 sur 0 métiers",
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
                    "lengthMenu": [30, 40, 50, 60],
                    "columns": [
                        null,
                        null,
                        {
                            render: function (data, type, row, meta) {
                                //var val = row[2];
                                var checked = currentMetier == data ? "checked" :  "";
                                var radio = '<input type="radio" name="id_metier" value="' + data +'" '+checked+'/>';
                                return radio;
                            }
                        }
                    ],
                    "processing": true,
                    "order": [],
                    "pageLength": 30,
                    "serverSide": false,
                    ajax: {
                        url: Routing.generate('ajax_get_metier'),
                        data: function (d) {
                            d.idDomainePro = $('#domainePro').val();
                            d.idFamilleMetier = $('#familleMetier').val();
                            return d;
                        }
                    },
                    fnDrawCallback: function (oSettings) {
                        $("input[name='id_metier']").not('[value="' + is_radio_metier_checked + '"]').prop('checked', false);
                        checkGpeecInputMetier();
                    },
                    initComplete : function(setting,json){
                        checkGpeecInputMetier();
                        refreshPanelPourcentage();
                    }
                })
            );
        }
//        $('#listmetier').DataTable;
        function checkGpeecInputMetier(){
            var inputs = $('#listmetier').find("input[name='id_metier']");
                $(inputs).prop("checked",false);
                $(inputs).filter("[value='"+currentMetier+"']").prop("checked",true);
                $(inputs).off('change').on('change',function(){
                    var id_metier = $(this).val();
                    $('#currentMetier').val($(this).val());
                    currentMetier = $(this).val();
            })
        }
        $('#listmetier').on('page.dt', function (event, setting) {
            if (is_radio_metier_checked !== false) {
                var dt = $('#listmetier').DataTable();
                var rows = dt.rows();
                for (var row_i in rows) {
                }
            }
        });
        $('#domainePro').on('change', function (event) {
            var idDomainePro = $(this).val();
            var html = "";
            $.ajax({
                url: Routing.generate('ajax_get_famille_metier', {idDomainePro: idDomainePro}),
                method: 'POST',
                async: true,
                success: function (response) {
                    var $famille_metier = response;
                    $.each($famille_metier, function (key, value) {
                        html += "<option value='" + value.idFamilleMetier + "'>" + value.lbFamilleMetier + "</option>";
                    });
                    $("#familleMetier").html(html);
                    $("#familleMetier").trigger('change');
                },
                error: function (jqXHR, textStatus, errorThrown) {
    //                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
                }
            });
            $('#listmetier').DataTable().ajax.reload();
        });

        $('#listmetier').on('click', 'input[name="id_metier"]', function () {
            var val = $(this).val();
            $("#bilan_social_bundle_apabundle_bilansocialagent_Gpeec_refMetier option").each(function () {
                var selectVal = $(this).val();
                if (selectVal === val) {
                    $(this).attr('selected', true);
                } else {
                    $(this).attr('selected', false);
                }
            });
        });

        $('#familleMetier').on('change', function (event) {
            $('#listmetier').DataTable().ajax.reload();
        })

        $('#listmetier').on('click', 'input[name="id_metier"]', function (even) {
            var checked = $(this).prop('checked');
            if (checked) {
                is_radio_metier_checked = $(this).val();

            }
        });
    }
    
function displayTitleOrNot(section) {
    var body = $('#' + section).find('.panel-body').text();
    var bodyClean = $.trim(body);
    if (bodyClean === '') {
        var menu = $('.sidebar-nav').find("[data-target='" + section + "']");
        menu.hide();
    }
}
