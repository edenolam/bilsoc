$(document).ready(function () {
    var $currentUser = $user;

    var categorie = $("#bilan_social_bundle_apabundle_bilansocialagent_refCategorie").val();

    var filiere = $("#bilan_social_bundle_apabundle_bilansocialagent_refFiliere").val();

    var cadreemploi = $("#bilan_social_bundle_apabundle_bilansocialagent_RefCadreEmploi").val();
    
    var grade = $("#bilan_social_bundle_apabundle_bilansocialagent_refGrade").val();

    var stageTitu = $("#bilan_social_bundle_apabundle_bilansocialagent_refStageTitularisation").val();

    var statut = $('#bilan_social_bundle_apabundle_bilansocialagent_refStatut').val();

    var depart = $('#bilan_social_bundle_apabundle_bilansocialagent_refMotifDepart').val();

    var arrivee = $('#bilan_social_bundle_apabundle_bilansocialagent_refMotifArrivee').val();

    var positionstatutaire = $('#bilan_social_bundle_apabundle_bilansocialagent_refPositionStatutaire').val();
    
    var tempspartiel = $('input[name="bilan_social_bundle_apabundle_bilansocialagent[blTempcomp]"]:checked').val();
    
    var $html_grade = '';
    var $html_cadreemploi = '';
    var $html_motifarrivee = "<option value=''> Selectionner un motif d'arrivée </option>";
    var $html_motifdepart = '';
    var $html_temps_partiel = '';
    
     $.ajax({
            url: Routing.generate('ajax_q11_1_q12_1'),
            data: {
                value: tempspartiel
            },
            method: 'POST',
            async: true,
            success: function (response) {
               
               var $tab =  response;
                $.each($tab, function (key, value) {
                    
                      if (value.idTemppart === tempspartiel) {
                        $html_temps_partiel += "<option selected='selected' value='" +  value.idTemppart + "'>" + value.lbTemppart + "</option>";
                    } else {
                        $html_temps_partiel += "<option value='" +  value.idTemppart + "'>" + value.lbTemppart + "</option>";
                    }
                   
                });
                $("#bilan_social_bundle_apabundle_bilansocialagent_refTempsPartiel").html($html_temps_partiel);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            // alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
            }
        });
        
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
                    if (key === cadreemploi) {
                        $html_cadreemploi += "<option selected='selected' value='" + key + "'>" + value + "</option>";
                    } else {
                        $html_cadreemploi += "<option value='" + key + "'>" + value + "</option>";
                    }
                });
                $("#bilan_social_bundle_apabundle_bilansocialagent_RefCadreEmploi").html($html_cadreemploi);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
        }
    });
    
    $.ajax({
        url: Routing.generate('ajax_cadre_emploi_grade'),
        data: {
            id_cadreEmploi: cadreemploi
        },
        method: 'POST',
        async: true,
        success: function (response) {
            var $tab = JSON.parse(response);
            $.each($tab, function (key, value) {
                if (key === grade) {
                    $html_grade += "<option selected='selected' value='" + key + "'>" + value + "</option>";
                } else {
                    $html_grade += "<option value='" + key + "'>" + value + "</option>";
                }
            });
            $("#bilan_social_bundle_apabundle_bilansocialagent_refGrade").html($html_grade);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
        }
    });


    $.ajax({
        url: Routing.generate('ajax_motif_depart'),
        data: {
            statut: statut
        },
        method: 'POST',
        async: true,
        success: function (response) {
            var $tab_depart = JSON.parse(response);

            $.each($tab_depart, function (key, value) {

                if (key === depart) {
                    $html_motifdepart += "<option selected='selected' value='" + key + "'>" + value + "</option>";
                } else {
                    $html_motifdepart += "<option value='" + key + "'>" + value + "</option>";
                }
            });

            $("#bilan_social_bundle_apabundle_bilansocialagent_refMotifDepart").html($html_motifdepart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
        }
    });

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
                if (key === arrivee) {
                    $html_motifarrivee += "<option selected='selected' value='" + key + "'>" + value + "</option>";
                } else {
                    $html_motifarrivee += "<option value='" + key + "'>" + value + "</option>";
                }
            });
            $("#bilan_social_bundle_apabundle_bilansocialagent_refMotifArrivee").html($html_motifarrivee);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
        }
    });

    $.ajax({
        url: Routing.generate('ajax_stage_titularisation'),
        data: {
            id_stagetitu: stageTitu
        },
        method: 'POST',
        async: true,
        success: function (response) {
            if (response == 1) {
                $("#refStageTitularisation").removeClass("hidden");
            } else {
                $("#refStageTitularisation").addClass("hidden");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
        }
    });

    $.ajax({
        url: Routing.generate('ajax_motif_deces'),
        data: {
            idMotidepa: depart
        },
        method: 'POST',
        async: true,
        success: function (response) {
            if (response == 1) {
                $("#deces").removeClass("hidden");
            } else {
                $("#deces").addClass("hidden");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
        }
    });

    $.ajax({
        url: Routing.generate('ajax_position_statutaire'),
        data: {
            statut: statut,
            user: $currentUser,
            position: positionstatutaire
        },
        method: 'POST',
        async: true,
        success: function (response) {
            var $tab_position = JSON.parse(response);
            $("#bilan_social_bundle_apabundle_bilansocialagent_refPositionStatutaire").html($tab_position);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
        }
    });

    $('.next_prev_btn').on('click',function(event){
        var index_modif = $(this).attr('data-index-modif');
        var url = Routing.generate('bilansocialagent_nextprev_edit');
        var form_to_submit = createFormToAjax(url,'post',{'index_modif':index_modif});
        form_to_submit.submit();
     })
});

