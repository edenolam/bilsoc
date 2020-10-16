$(document).ready(function(){
    var confirm = false;
    $('.runjob').on('click', function(event){
        event.preventDefault(); //prevent default action

        var checked_input = $('#infocentre_filter_form_depaColl').find('input[type="checkbox"]:checked');
        var btn_export = $(this);
        if(checked_input.length > 0){
            var form_data = $(checked_input); //Encode form elements for submission
            var departements = [];
            var str_departement = "";
            $( form_data ).each(function( index, element ) {
                departements.push($(element).val());
                str_departement += index>0 ? ", " : "";
                str_departement += "n° "+ $(element).val();
            });
            modal = createConfirmModal(
                'confirm_modal_pool_export',
                'Export département', "Départements "+str_departement+' : confirmez-vous l\'export ?',
                function(){
                    var to_ajax = $(btn_export).attr('data-ajax-export');
                    

                    var job = $(btn_export).data('job');

                    var url = Routing.generate('info_centre_departement_get_data_ajax');
                    var form = createFormToAjax(url,'POST',{
                        'departements' : departements,
                        'job' : job
                    });

                    $('body').append(form);
                    if(to_ajax){
                        confirm = false;
                        var temp_spinner = addSpinner('#spinner_export','Export en préparation',true);
                        $(form).ajaxSubmit({
                            beforeSubmit: function(){
                                closeBtpModal(modal);
                            },
                            success:    function(response) {
                                //var pool_export = response.pool_export;
                                var dt_table_api = $('#infocentre_departement_list_export').dataTable().api();
                                dt_table_api.row.add(response).draw(false);

                                removeASpinner(temp_spinner);
                                //initProgressBarOfElement($('#long_task_fiche_container'));
                                $(document).on('click','.cancel_delete_longTask',cancelDeleteTaskEvent);
                                //$('#table_task').DataTable().ajax.reload();

                            } 
                        });
                    }else{
                        confirm = true;
                        form.submit();
                    }
                },{
                    replace: true
                }
            );
            if(!isset(confirm) || !confirm){
                openBtpModal(modal);
                event.preventDefault();
            }else{
                confirm = false;
                closeBtpModal(modal);
            }
        }else{
            alert('vide');
        }
    });

    $('.select_all_fellow_checkbox_departement').on('change',function(event){
        var is_to_check = $(this).is(':checked');
        var to_check_uncheck = $('#infocentre_filter_form_depaColl').find('input[type="checkbox"]');
        $(to_check_uncheck).each(function(k,v){
            $(v).prop('checked',is_to_check);
        });
    });
    $.fn.dataTable.moment('DD/MM/YYYY HH:mm');
    $('#infocentre_departement_list_export').DataTable({
        language:getLanguagaDataTableBase({
            info: "Affichage _START_ &agrave; _END_ sur _TOTAL_ export",
            infoEmpty: "Affichage 0 &agrave; 0 sur 0 export",
        }),
        columns: [
            {
                "data":"taskTypeLibelle",
                "render":function(data,type,row,meta){
                    return sfTrans(data); 
                }
            },
            {
                "data":"start_date",
                "render":function(data,type,row,meta){
                    return moment(data).format('DD/MM/YYYY HH:mm');
                }
            },
            {
                "data":null,
                "render":function(data,type,row,meta){
                    var ratio  = '';
                    var src_param  = '';
                    var view = "";
                    if (data.statusCode == "RUNNING" || data.statusCode == "READY_TO_RUN" || data.statusCode == "FINISHING"){
                        var pb_attr = getAttrProgressBarForTask(data.task_key);
                        var attr_str = "";
                        var class_str = "";
                        var queued_string = "";
                        var attr_keys = [
                            'data-progress-wait',
                            'data-pile-index-timer'
                        ];
                        if(data.statusCode == "FINISHING"){
                            class_str += " hidden ";
                            queued_string = '<p>traitement des données<i class="fa fa-check"></i></p>' +
                                    '<p>préparation du fichier<i class="fa fa-spinner"></i></p>';
                        }
                        if(isset(pb_attr)){
                            for(var attr_key of attr_keys){
                                var temp_attr_value = pb_attr[attr_key];
                                if(isset(temp_attr_value)){
                                    attr_str += ' '+attr_key+'="'+temp_attr_value+'"';                      
                                }
                            }
                            var is_initialized = isset(pb_attr['is_initialized']) && pb_attr['is_initialized']==true;
                            if(is_initialized){
                                class_str += ' initialized ';
                            }
                        }
                        var ratio =  data.details_count>0 ? (data.details_done_count + data.details_error_count) / data.details_count * 100 : 0;
                        /*console.log(data.dataKey);*/
                        var src_param = { "task_key" : data.task_key };
                        var url_data_manager = Routing.generate('info_centre_departement_get_export');
                        view += '<div class="progress_infocentre_depa bs_progress_bar '+class_str+'" '+attr_str+' data-task_key="'+data.task_key+'" data-progress-src="'+url_data_manager+'" data-progress-src-param=\''+JSON.stringify(src_param)+'\' data-progress-delay="10000">'
                                + '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="'+ratio+'" aria-valuemin="0" aria-valuemax="100" style="width: '+ratio+'%; min-width:2em;">'
                                + ratio + '%'
                                +'</div>'
                                +'</div>'
                                +queued_string;
                    }else {
                        var timer_index = getAttrProgressBarForTask(data.task_key,'data-pile-index-timer');
                        if(data.statusCode == "FINISHING"){
                            view += '<p>traitement des données<i class="fas fa-check"></i></p>'
                                  +'<p>préparation du fichier<i class="fas fa-spinner"></i></p>';
                        }else{
                            if(data.statusCode == "FINISHED"){
                                var date = moment(data.end_date).format('DD/MM/YYYY HH:mm');
                                view += '<p>'+ date + '</p>';
                            }else if(data.statusCode == "RUN_FAILED"){
                                view += '<p>Une erreur est survenue</p>';
                            }
                            if(isset(timer_index)) {
                                stopTimerFromPile(timer_index, {
                                    on_stopped: function () {
                                        //$('#table_data').DataTable().ajax.reload(null, false);
                                    }
                                });
                            }
                        }
                    }
                    return view;
                }
            },
            {
                "data":null,
                "render":function(data,type,row,meta){
                    var run_data = JSON.parse(data.run_data);
                    var nbItem =  data.details_count;
                    view = nbItem+" département"+(nbItem>1?"s":"");    
                    return view; 
                }
            },
            {
                "data":null,
                "render":function(data,type,row,meta){
                    /*if (data.statusCode == "RUNNING"){
                        etat = sfTrans("infocentre.etat.running");
                    }else if(data.statusCode == "FINISHED"){
                        etat = sfTrans("infocentre.etat.finished");
                    }else if(data.statusCode == "READY_TO_RUN"){
                        etat = sfTrans("infocentre.etat.readytorun");
                    }else if(data.statusCode == "RUN_FAILED"){
                        etat = sfTrans("infocentre.etat.runfailed");
                    }*/
                    var status_code = data.statusCode;
                    var str_etat = status_code!=null ? "infocentre.etat."+status_code.toLowerCase() : "inconnue";
                    var etat = sfTrans(str_etat);
                    view += "<p> "+etat+" </p>";
                    return etat 
                }
            },
            {
                "data":null,
                "render":function(data,type,row,meta){
                    var view = "";
                        //var data_from_api = task.from_api;
                        //var url_pile = data.uriPile;//data[0].url;
                        //var url_to_content = !isEmpty(url_pile) && isset(url_pile['contentUri']) ? url_pile['contentUri'] : null;

                        /*if(["FINISHED","INIT_FAILED","RUN_FAILED","ABORTED"].indexOf(task.statusCode)==-1){
                            all_done = false;
                        }
                        if(["INIT_FAILED","RUN_FAILED","ABORTED"].indexOf(task.statusCode)!=-1){
                            some_error = true;
                            in_error = true;
                        }*/
                    if(["FINISHED"].indexOf(data.statusCode)!=-1){
                        view += '<button class="btn_download_depa_export btn btn-success sm_btn" title="Télécharger l\'export" data-task-keys="'+data.task_key+'">\
                                <span class="glyphicon glyphicon-download" aria-hidden="true"></span>\
                            </button>';
                    }
                    view += '<p><button class="btn btn-danger sm_btn cancel_delete_longTask" title="annuler/supprimer l\'export"><i class="fa fa-trash-o" data-task-status="'+data.statusCode+'" data-task-key="'+data.task_key+'"></i></button></p>';
                    return view;
                }
            }
        ],
        ajax: {
            url: Routing.generate('info_centre_departement_get_list_export'),
            dataSrc: '',
            rowId: 'id'
        },
        drawCallback:function(settings){
            initProgressBarOfDatatable($(this));
        }
    });

    $(document).on('click','.btn_download_depa_export',function(event){
        var list_task_keys = $(this).attr('data-task-keys');
        var url = Routing.generate('long_task_manager_get_file_task');
        var form = createFormToAjax(url,'POST',{
            'task_keys' : list_task_keys,
        });

        $('body').append(form);
        form.submit();
    });
    function checkProgressBar($pb_element){
        var row = $(this).parents('tr:first');
        var dt_table_api = $('#infocentre_departement_list_export').dataTable().api();
        dt_table_api.row(row).data(response).draw(false);
    }
});
/*
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
});*/
