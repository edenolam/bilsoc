$(document).ready(function () {

   // var modal = createBtpModal($(parent_block).data('name'),sfTrans($(parent_block).data('title')),sfTrans($(parent_block).data('trans')),{
    var modal_2 = createBtpModal('importFileModal2','Import historisation des SIRET','Traitement en cours...',{});

    var modal_1 = createBtpModal('importFileModal1','Import du fichier',sfTrans("historisation.confirme_import", "", [], "modal"),{
        buttons:[
            {
                lbl:sfTrans("modal.btn.oupsNon"),
                attr:{
                    class:"btn btn-secondary"
                },
                extra:{
                    dismiss:"modal"
                },
            },{
                lbl:sfTrans("initbilan.import.valide"),
                attr:{
                    class:"btn btn-primary"
                },
                callbacks:{
                    click:  function(event){
                        closeBtpModal(modal_1);
                        $('form[name="bilan_social_bundle_import_historisation_siret"]').submit();
                        $("#importFileModal2").find('button').remove();
                        $(modal_2).modal({backdrop: "static", keyboard: false});
                        openBtpModal(modal_2);
                    }
                }
            }
        ]
    });
    var modal_3 = createBtpModal('importFileModal3','Traitements des données importées',sfTrans("historisation.confirme_traitement", "", [], "modal"),{
        buttons:[
            {
                lbl:sfTrans("modal.btn.oupsNon"),
                attr:{
                    class:"btn btn-secondary"
                },
                extra:{
                    dismiss:"modal"
                },
            },{
                lbl:sfTrans("initbilan.import.valide"),
                attr:{
                    class:"btn btn-primary"
                },



                callbacks:{
                    click:  function(event) {
                        $("#importFileModal3").find('button').remove();
                        closeBtpModal(modal_3);

                       var valide = '<span style="color: #6b9311" class="glyphicon glyphicon-ok-circle"></span>';
                       var erreur = '<span style="color: #c1272d" class="glyphicon glyphicon-remove" title=":errmess"></span>';

                        $('#histoTraitement').modal({show: true, backdrop: 'static', keyboard: false});
                        var modal_body = $('#histoTraitement').find('.modal-body');

                        var etape1 = $(modal_body).find('.etape1');
                        var etape2 = $(modal_body).find('.etape2');
                        var etape3 = $(modal_body).find('.etape3');
                        var etape4 = $(modal_body).find('.etape4');
                        var etape5 = $(modal_body).find('.etape5');


                        $.ajax({
                            url: Routing.generate('historisation_traitement_automatique_fusion'),
                            type: 'POST',
                            success: function (response) {

                              /*  closeBtpModal(modal_fusion);*/
                               if(response.status === true ){
                                   $(etape1).replaceWith(valide);
                                   $.ajax({
                                       url: Routing.generate('historisation_traitement_automatique_ca'),
                                       type: 'POST',
                                       success: function (response) {
                                           if(response.status === true){
                                               $(etape2).replaceWith(valide);
                                               $.ajax({
                                                   url: Routing.generate('historisation_traitement_automatique_ac'),
                                                   type: 'POST',
                                                   success: function (response) {
                                                       if(response.status === true){
                                                           $(etape3).replaceWith(valide);
                                                             $.ajax({
                                                                   url: Routing.generate('historisation_traitement_automatique_creation'),
                                                                   type: 'POST',
                                                                   success: function (response) {
                                                                       if(response.status === true){
                                                                           $(etape4).replaceWith(valide);
                                                                           $.ajax({
                                                                               url: Routing.generate('historisation_traitement_automatique_manuelle'),
                                                                               type: 'POST',
                                                                               success: function (response) {
                                                                                   if(response.status === true){
                                                                                       $(etape5).replaceWith(valide);
                                                                                       location.reload();
                                                                                   }else{
                                                                                       $(etape5).replaceWith(erreur.replace(":errmess", response.message));
                                                                                       //alert(response.message);
                                                                                   }
                                                                               }
                                                                           });
                                                                       }else{
                                                                           $(etape4).replaceWith(erreur.replace(":errmess", response.message));
                                                                           //alert(response.message);
                                                                       }
                                                                   },
                                                                   error : function(resultat, statut, erreurserv){
                                                                       $(etape4).replaceWith(erreur.replace(":errmess", "Erreur lors de la création automatique"));
                                                                   }
                                                             });
                                                       }else{
                                                           $(etape3).replaceWith(erreur.replace(":errmess", response.message));
                                                           //alert(response.message);
                                                       }
                                                   }
                                               });
                                           }else{
                                               $(etape2).replaceWith(erreur.replace(":errmess", response.message));
                                               //alert(response.message);
                                           }
                                       }
                                   });
                               }else{
                                   $(etape1).replaceWith(erreur.replace(":errmess", response.message));
                                   //alert(response.message);
                               }
                            }
                        });
                    }
                }
            }
        ]
    });

    $('.sendjob').on('click', function(){
        openBtpModal(modal_3);

    });
   $('.sendFile').on('click', function( event ) {
       if( document.getElementById("bilan_social_bundle_import_historisation_siret_document_file").files.length == 0 ){
           event.preventDefault();
       }else{
           openBtpModal(modal_1);
           event.preventDefault();
       }

   });


   var dtTableColl = $('#erreurs').DataTable({
        "processing": false,
        "serverSide": false,
        deferRender : true,
        info: true,
        "columns": [
            { "data": "nmSire", name: "nmSire" },
            { "data": "idColl", name: "idColl"  },
            { "data": "lbColl", name: "blSireNouveau"  },
            { "data": "lbAdre", name: "blLbAdresse" },
            { "data": "idDepa", name: "idDepa" },
            { "data": "lbVill", name: "blLbVill" },
            { "data": "lbErreur", name: "lbErreur" },
        ],
        language: languageDataTable,
        ajax :{
            url : Routing.generate('ajax_get_collectivite_historisation_erreur_worktable'),
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


});