$(document).ready(function () {
    $('#transmettre-cons').click(function () {
        var idBS = $(this).val();
        var modal = createBtpModal('modal_valid_transmettre_con',sfTrans('consolide.modal.transmetreConso.title'),sfTrans('consolide.modal.transmetreConso.msg'),{
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
                    lbl:sfTrans("modal.btn.transmettreBilan"),
                    attr:{
                        class:"btn btn-primary"
                    },
                    callbacks:{
                        click:function(){
                            var modal_footer = $(this).parent(':first');
                            addSpinner(modal_footer,'Traitement en cours',true);
                            $.ajax({
                                url: Routing.generate('bilan_conso_transmettre'),
                                method: 'POST',
                                data: {'idBS': idBS},
                                dataType: 'json',
                                async: true,
                                success: function (response) {
                                    removeSpinner(modal_footer);
                                    addSpinner(modal_footer,'Redirection en cours',true);
                                    if ('done' == response) {

                                        var url = Routing.generate('bilan_conso_edit');

                                        window.location.href = url;
                                    }
                                },
                                complete: function(response){
                                    removeSpinner(modal_footer);
                                    closeBtpModal(modal);
                                }
                            });
                        }
                    }
                }
            ]
        })
        openBtpModal(modal);
    });
    $('#valider-cons').click(function () {
        var idBS = $(this).val();
        var modal = createBtpModal('modal_validation_bilan_cons',sfTrans('consolide.modal.validationConso.title'),sfTrans('consolide.modal.validationConso.msg'),{
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
                    lbl:sfTrans("modal.btn.validerBilan"),
                    attr:{
                        class:"btn btn-primary"
                    },
                    callbacks:{
                        click:function(){
                            var modal_footer = $(this).parent(':first');
                            addSpinner(modal_footer,'Traitement en cours',true);
                            $.ajax({
                                url: Routing.generate('bilan_conso_valider'),
                                method: 'POST',
                                data: {'idBS': idBS},
                                dataType: 'json',
                                async: true,
                                success: function (response) {
                                    removeSpinner(modal_footer);
                                    addSpinner(modal_footer,'Redirection en cours',true);
                                    if ('done' == response) {
                                        location.reload();
                                    }
                                },
                                complete: function(response){
                                    closeBtpModal(modal);
                                    removeSpinner(modal_footer);
                                }
                            });
                        }
                    }
                }
            ]
        })
        openBtpModal(modal);
    });
    $('#deverrouiller-cons').click(function () {
        var idBS = $(this).val();
        var modal = createBtpModal('modal_deverrouiller_bilan_cons',sfTrans('consolide.modal.deverrouillerConso.title'),sfTrans('consolide.modal.deverrouillerConso.msg'),{
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
                    lbl:sfTrans("modal.btn.deverrouillerBilan"),
                    attr:{
                        class:"btn btn-primary"
                    },
                    callbacks:{
                        click:function(){
                            var modal_footer = $(this).parent(':first');
                            addSpinner(modal_footer,'Traitement en cours',true);
                            $.ajax({
                                url: Routing.generate('bilan_conso_deverrouiller'),
                                method: 'POST',
                                data: {'idBS': idBS},
                                dataType: 'json',
                                async: true,
                                success: function (response) {
                                    removeSpinner(modal_footer);
                                    addSpinner(modal_footer,'Redirection en cours',true);
                                    if ('done' == response) {
                                        location.reload();
                                    }
                                },
                                complete: function(response){
                                    removeSpinner(modal_footer);
                                    closeBtpModal(modal);
                                }
                            });
                        }
                    }
                }
            ]
        })
        openBtpModal(modal);
    });
    $('#refuser-cons').click(function () {
        var idBS = $(this).val();
        var modal = createBtpModal('modal_refus_bilan_cons',sfTrans('consolide.modal.refusConso.title'),sfTrans('consolide.modal.refusConso.msg'),{
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
                    lbl:sfTrans("modal.btn.refuserBilan"),
                    attr:{
                        class:"btn btn-primary"
                    },
                    callbacks:{
                        click:function(){
                            var modal_footer = $(this).parent(':first');
                            var sendEmail = $('#send-email-when-refused').prop('checked');

                            addSpinner(modal_footer,'Traitement en cours',true);

                            $.ajax({
                                url: Routing.generate('bilan_conso_refuser'),
                                method: 'POST',
                                data: {'idBS': idBS, 'sendEmail': sendEmail},
                                dataType: 'json',
                                async: true,
                                success: function (response) {
                                    removeSpinner(modal_footer);
                                    addSpinner(modal_footer,'Redirection en cours',true);
                                    if ('done' == response) {
                                        location.reload();
                                    }
                                },
                                complete: function(response){
                                    removeSpinner(modal_footer);
                                    closeBtpModal(modal);
                                }
                            });
                        }
                    }
                }
            ]
        })
        openBtpModal(modal);
    });
    // $('.ind_totaux_inside').on('change','.ind_table_totaux input',function(event){
    //     var input = $(this);
    //     updateIndTotaux(input);
    // });
    // function updateIndTotaux(input) {
    //     /*var total_opened_fili = $(table421).find('#totalFil');
    //     var total_all_fili = $(table421).find('#totalFilGlo');
    //     var total_all_ind = $(table421).find('#totalGlo');*/
    //     var container = $(input).parents('table:first');
    //     var row_totaux = $(container).find('tr.row_totaux');
    //     var cell_input = $(input).parents('td:first');
    //     var row_input = $(cell_input).parents('tr:first');
    //     var cell_index = $(cell_input).index()+1;
    //     var row_total_group_id = $(row_input).attr('data-row-group')
    //     var row_index = $(row_input).index();
    //     var old_value = getSavedInputData(input);// $(input).data('old_val');
    //     var new_value = $(input).val();
    //     var col_groups = {};
    //     old_value = !isNaN(old_value) ? old_value : 0;
    //     new_value = !isNaN(new_value) ? new_value : 0;
    //     var delta = new_value - old_value;
    //     if($(cell_input).is('[data-col-group]')){
    //         var col_group = $(cell_input).attr('data-col-group');
    //         updateIndColGroup(delta,row_input,col_group);
    //     }
    //     $(row_totaux).filter(function(index,row_total){
    //         var temp_group_id = $(row_total).attr('data-row-id');
    //         return ($(row_total).index() > row_index && (!isset(temp_group_id) || temp_group_id == row_total_group_id)) ;
    //     }).each(function(index,tr_total){
    //         var cell_total = $(tr_total).find('td:nth-child('+cell_index+')');
    //         var current_total = parseFloat($(cell_total).text());
    //         $(cell_total).text(current_total+delta);
    //         if($(cell_total).is('[data-col-group]')){
    //             var col_group = $(cell_total).attr('data-col-group');
    //             updateIndColGroup(delta,tr_total,col_group);
    //         }
    //     });
    // }
    //
    // function updateIndColGroup(delta,row,col_group){
    //     if(col_group!=undefined){
    //         var cell_col_total = $(row).find('[data-col-id="'+col_group+'"]');
    //         var current_total = parseFloat($(cell_col_total).text());
    //         $(cell_col_total).text(current_total+delta);
    //         if($(cell_col_total).is('[data-col-group]')){
    //             var next_col_group = $(cell_col_total).attr('data-col-group');
    //             updateIndColGroup(delta,row,next_col_group);
    //         }
    //     }
    // }
});
