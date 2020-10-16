$(document).ready(function(){
    
    var action = $('#action-utilisateur').val();
    var idUtil = $('#id-utilisateur').val();
    if(action == 'modifier'){
        $('#submit-fiche').attr('disabled',false);
        $('#bilan_social_user_cdgs').attr('disabled',true);
        $('#bilan_social_user_cdgs').attr('readonly',true);
        $('#bilan_social_user_password_first').attr('required',false);
        $('#bilan_social_user_password_second').attr('required',false);
    }
    var typeUtil = $('#typeUtil').val();
    if(typeUtil == 'Utilisateur départemental'){
        $('#liste-ref-wrapper').show();
    }
    $('#recherche-identifiant, #recherche-departement').keyup(function(){
        tri();
    });
    $('.infocentre').hide();
    
    if($('#bilan_social_user_profil').val() == 'cdg'){
        if($('#bilan_social_user_cdgs').val() == '0'){
            $('#submit-fiche').attr('disabled',true);
        }
        $('.cdg').show();
        $('.form-cdg').show();
        $('#cdg-wrapper').show();
        $('.infocentre').hide();

    }else if($('#bilan_social_user_profil').val() == 'infocentre'){
        if($('#bilan_social_user_profils').val() == '0'){
            $('#submit-fiche').attr('disabled',true);
        }
        $('#bilan_social_user_cdgs').attr('required',false);
        $('#bilan_social_user_profils').attr('required',true);

        $('.form-infocentre').show();
        $('.infocentre').show();
        $('.form-cdg').hide();
        $('.cdg').hide();
        $('#cdg-wrapper').hide();
        $('#table-droits-wrapper').hide();
    }else{
        $('#submit-fiche').attr('disabled',false);
        $('.cdg').hide();
        $('.form-cdg').hide();
        $('.form-infocentre').hide();
        $('.infocentre').hide();
    }

    $('#bilan_social_user_profil').change(function(){
        var form = $('form[name=bilan_social_user]');
        emptyform(form);
        if($(this).val() == 'cdg'){
            if($('#bilan_social_user_cdgs').val() == '0'){
                $('#submit-fiche').attr('disabled',true);
            }
            $('.cdg').show();
            $('.form-cdg').show();
            $('#cdg-wrapper').show();
            $('.infocentre').hide();

        }else if($(this).val() == 'infocentre'){
            if($('#bilan_social_user_profils').val() == '0'){
                $('#submit-fiche').attr('disabled',true);
            }
            $('#bilan_social_user_cdgs').attr('required',false);
            $('#bilan_social_user_profils').attr('required',true);

            $('.form-infocentre').show();
            $('.infocentre').show();
            $('.form-cdg').hide();
            $('.cdg').hide();
            $('#cdg-wrapper').hide();
            $('#table-droits-wrapper').hide();
        }else{
            $('#submit-fiche').attr('disabled',false);
            $('.cdg').hide();
            $('.form-cdg').hide();
            $('.form-infocentre').hide();
            $('.infocentre').hide();
        }
    });
    if(action == 'ajouter' || action == 'modifier'){
        $('#bilan_social_user_cdgs').change(function(){
            nmCdg = $(this).val();
            id = null;
            if(action == 'modifier'){
                id = idUtil;
            }
            if(action == 'ajouter'){
                nmCdg = nmCdg.toLowerCase();
                $.ajax({
                    url: Routing.generate('get_username_ajax'),
                    data: {username: nmCdg},
                    method: 'POST',
                    success: function (response) {
                        username = nmCdg + '_' + response;
                        $('#bilan_social_user_username').val(username);
                    }
                });
            }
            getLbCdg(id);
        });
        $('#bilan_social_user_profils').change(function(){
            nomProfil = $(this).children(':selected').val();
            id = null;
            if(action == 'modifier'){
                id = idUtil;
            }
            if(action == 'ajouter'){
                nomProfil = nomProfil.toLowerCase();
                $.ajax({
                    url: Routing.generate('get_username_ajax'),
                    data: {username: nomProfil},
                    method: 'POST',
                    success: function (response) {
                        username = nomProfil + '_' + response;
                        $('#bilan_social_user_username').val(username);
                    }
                });
            }
           $('#submit-fiche').attr('disabled',false);
        });
    }
    $('#bilan_social_user_departements').addClass('form_choices_col_4 form_choices_inline child_box_border_tinyround child_box_border_slim');
    $('#bilan_social_user_campagnes').addClass('form_choices_col_4 form_choices_inline child_box_border_tinyround child_box_border_slim');
    $("#bilan_social_user_password_first").on('keyup', changePasswordProgressBar);
    $('#submit-fiche').click(function(e){
        if($('#bilan_social_user_password_first').val() != ''){
            $('#errorPsw').hide();
            var pswStrength = $('#password-progress-bar').attr('aria-valuenow');
            pswStrength = parseInt(pswStrength);
            if(pswStrength < 100){
                $('#errorPsw').show();
                e.preventDefault();
            }
        }
    });
    $('.select_all_fellow_checkbox_departement').on('change',function(event){
        var is_to_check = $(this).is(':checked');
        var to_check_uncheck = $('#bilan_social_user_departements').find('input[type="checkbox"]');
        $(to_check_uncheck).each(function(k,v){
            $(v).prop('checked',is_to_check);
        });
    });

    $('.delete_profil_action').on('click', function(event){
        var id_profil_to_delete = $(this).parents('th').attr('data-id-profil');
        var theTH =  $(this).parents('th:first');
        var column = $('#table_profil_manager').DataTable().column(theTH);
        deleteProfil(id_profil_to_delete, column);
    });

    $('.profil_export_admin').on('click', function(event){

        var new_profil_export_admin = [];
        var remove_profil_export_admin = [];
        $('#table_profil_manager').DataTable().rows().nodes().to$().find('input[type="checkbox"]').each(function(){
            if ($(this).is(':checked')){
                var checkedCheckbox = [];
                checkedCheckbox.push($(this).attr('data-id-profil'));
                checkedCheckbox.push($(this).attr('data-id-export-admin'));
                new_profil_export_admin.push(checkedCheckbox);
            }else{
                var uncheckedCheckbox = [];
                uncheckedCheckbox.push($(this).attr('data-id-profil'));
                uncheckedCheckbox.push($(this).attr('data-id-export-admin'));
                remove_profil_export_admin.push(uncheckedCheckbox);
            }
        });
        profil_export_admin(new_profil_export_admin, remove_profil_export_admin);
    });

});

function tri(){ 
    $("#table-utilisateur tbody tr").each(function(index) {
        $row = $(this);
        argId = $('#recherche-identifiant').val().toLowerCase();
        var textIdTmp = $row.find("td:nth-child(1)").text();
        var textId = textIdTmp.toLowerCase();

        argDepa = $('#recherche-departement').val().toLowerCase();
        var textDepaTmp = $row.find("td:nth-child(2)").text();
        var textDepa = textDepaTmp.toLowerCase();

        if (textId.indexOf(argId) < 0 || textDepa.indexOf(argDepa) < 0) {
            $(this).hide();
        }else{
            $(this).show();
        }
    });
}

function getLbCdg(id,droits){
    var nmCdg = $('#bilan_social_user_cdgs').val();
    $.ajax({
        url: Routing.generate('get_lbcdg_ajax'),
        data: {nmCdg: nmCdg},
        method: 'POST',
        success: function (response) {
            $('#lbCdg').html('<option value="'+response+'">'+response+'</option>');
            getDepartements(nmCdg,id, droits);
            $('#lb-cdg-wrapper').show();
        }
    });
}

function getDepartements(nmCdg,id, droits){
    $.ajax({
        url: Routing.generate('get_departements_ajax'),
        data: {nmCdg: nmCdg, id: id, droits: droits},
        method: 'POST',
        success: function (response) {
            template = response[1];
            $('#table-droits-wrapper').html(template);
            reload_js('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.js');
            if(response[0] == false){
                $('#submit-fiche').attr('disabled',true);
            }else{
                $('#submit-fiche').attr('disabled',false);
            }
        }
    })
}

function deleteProfil(id_profil_to_delete, column){
    $.ajax({
        url: Routing.generate('utilisateur_delete_profil'),
        data: {id_profil_to_delete: id_profil_to_delete},
        method: 'POST',
        success: function (response) {
            $('#table_profil_manager').DataTable().column(column).visible(false);  
        }  
    })
}

function profil_export_admin(new_profil_export_admin, remove_profil_export_admin){
     $.ajax({
        url: Routing.generate('utilisateur_profil_export_admin'),
        data: { new_profil_export_admin     : new_profil_export_admin,
                remove_profil_export_admin  : remove_profil_export_admin
            },
        method: 'POST',
        success: function (response) {
            $('.alert-danger').hide();
            $('.alert-success').html('Les profils ont été mis à jour avec succès');
            $('.alert-success').show();
        },
        error: function (response) {
            $('.alert-success').hide();
            $('.alert-danger').html('Une erreur est survenue durant la sauvegarde');
            $('.alert-danger').show();
        }
    })   
}

function emptyform(form){
    form.find('input:not([type="hidden"]):not([type="checkbox"])').val('');
    $('#bilan_social_user_cdgs').val($('#bilan_social_user_cdgs option:first').val());
    $('#lb-cdg-wrapper').hide();
    $('#lb-profil-wrapper').hide();
    $('#password-progress-bar').removeClass().addClass('progress-bar progress-bar-');
    $('#password-progress-bar').attr('aria-valuenow', 0);
    $('#password-progress-bar').css('width', 0);
    $('#password-progress-bar').find('span.sr-only').text('0% Complete (danger)');
}