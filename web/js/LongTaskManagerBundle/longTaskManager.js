/*
*	fichier javascript du LongTaskManagerBundle
*/

function getTaskList(){

}
var row_task_fiche_node;
var task_fiche;
var task_key;
var delete_modal;

function cancelDeleteTaskEvent(event){
    row_task_fiche_node = $(this).parents('tr:first');
    task_fiche = $(event.target);
    if ((task_fiche).is('button')) {
        task_key = $(task_fiche).find('i').attr('data-task-key');
        task_status = $(task_fiche).find('i').attr('data-task-status');
    } else {
        task_key = $(task_fiche).attr('data-task-key');
        task_status = $(task_fiche).attr('data-task-status');
    }


    if(task_status == "RUN_FAILED" || task_status == "ABORTED") {
        delete_modal = createConfirmModal(
        'confirm_modal_cancel_delete_task',
        'Suppression de la tâche','Attention ! Voulez-vous vraiment supprimer cette tâche ?',
        function(){
            var temp_spinner = addSpinner('#confirm_modal_cancel_delete_task .modal-footer','Suppression de la tâche',true);
            $.ajax({
                url : Routing.generate('long_task_manager_delete_failed_task'),
                data : {task_key:task_key, task_status:task_status},
                type : 'post',
                success : function(response){
                    var dt_table = $(row_task_fiche_node).parents('table');
                    var dt_table_api = $(dt_table).dataTable().api();
                    var dt_row = dt_table_api.row(row_task_fiche_node);
                    if (response == "success"){
                        task_fiche.closest('.long_task_fiche').remove();
                        // dt_row.remove()
                        //     .draw();
                        //dt_table_api.draw();
                    }

                    //$('#table_task').DataTable().ajax.reload(function(){
                   removeASpinner(temp_spinner);
                   closeBtpModal(delete_modal);
                   //});
                }
            });
        }
        );
    } else {
        delete_modal = createConfirmModal(
        'confirm_modal_cancel_delete_task',
        'Suppression de la tâche','Attention ! Voulez-vous vraiment supprimer cette tâche ?',
        function(){
            var temp_spinner = addSpinner('#confirm_modal_cancel_delete_task .modal-footer','Suppression de la tâche',true);
            $.ajax({
                url : Routing.generate('long_task_manager_cancel_delete_task'),
                data : {task_key:task_key, task_status:task_status},
                type : 'post',
                success : function(response){

                    var dt_table = $(row_task_fiche_node).parents('table');
                    var dt_table_api = $(dt_table).dataTable().api();
                    var dt_row = dt_table_api.row(row_task_fiche_node);
                    if (response[1] == null || response['1']['error']=="" || response['1']['error']==false){
                        
                        task_fiche.closest('.long_task_fiche').remove();
                        // dt_row.remove()
                        //     .draw();
                        //dt_table_api.draw();
                    }

                    //$('#table_task').DataTable().ajax.reload(function(){
                   removeASpinner(temp_spinner);
                   closeBtpModal(delete_modal);
                   //});
                }
            });
        }
        );
    }
    
    openBtpModal(delete_modal);
}

function deleteExportHrg(event){
    row_task_fiche_node = $(this).parents('tr:first');
    task_fiche = $(event.target);
    if ((task_fiche).is('button')) {
        pool_export_id = $(task_fiche).find('i').attr('data-pool-export');
    } else {
        pool_export_id = $(task_fiche).attr('data-pool-export');
    }

    delete_modal = createConfirmModal(
    'cancel_delete_export_hrg',
    'Suppression de la tâche','Attention ! Voulez-vous vraiment supprimer cette tâche ?',
    function(){
        var temp_spinner = addSpinner('#cancel_delete_export_hrg .modal-footer','Suppression de la tâche',true);
        $.ajax({
            url : Routing.generate('delete_export_hrg'),
            data : {pool_export_id:pool_export_id},
            type : 'post',
            success : function(response){
                if (response.success == true) {
                    var dt_table = $(row_task_fiche_node).parents('table');
                    console.log(dt_table);
                    var dt_table_api = $(dt_table).dataTable().api();
                    console.log(dt_table_api);
                    var dt_row = dt_table_api.row(row_task_fiche_node);
                    console.log(task_fiche);
                    row_task_fiche_node.remove();
    
                    //$('#table_task').DataTable().ajax.reload(function(){
                    removeASpinner(temp_spinner);
                    closeBtpModal(delete_modal);
                    //});
                } else if (response.success == false) {
                    console.log(response.message);
                }
            }
        });
    }
    );

openBtpModal(delete_modal);
}

$(document).ready(function(){
    // $('#long_task_fiche_container').on('click','.cancel_delete_longTask',cancelDeleteTaskEvent);

    $('.cancel_delete_longTask').on('click', function(e) {
        cancelDeleteTaskEvent(e);
    });
});