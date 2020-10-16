$(document).ready(function () {

    $('.ind_totaux_inside').on('change','.ind_table_totaux input',function(event){
        var input = $(this);
        updateIndTotaux(input);
    });
    function updateIndTotaux(input) {
        /*var total_opened_fili = $(table421).find('#totalFil');
        var total_all_fili = $(table421).find('#totalFilGlo');
        var total_all_ind = $(table421).find('#totalGlo');*/
        var container = $(input).parents('table:first');
        var row_totaux = $(container).find('tr.row_totaux');
        var cell_input = $(input).parents('td:first');
        var row_input = $(cell_input).parents('tr:first');
        var nb_cell_in_row = $(row_input).find('td,th').length;
        var cell_index = $(cell_input).index() + 1;// + delta_nb_cell;
        var row_total_group_id = $(row_input).attr('data-row-group');
        row_total_group_id = row_total_group_id != undefined ? row_total_group_id.split(",") : [];
        var row_index = $(row_input).index();
        var old_value = getSavedInputData(input);// $(input).data('old_val');
        var new_value = $(input).val();
        var col_groups = {};
        old_value = !isNaN(old_value) ? old_value : 0;
        new_value = !isNaN(new_value) ? new_value : 0;
        var delta = new_value - old_value;
        if($(cell_input).is('[data-col-group]')){
            var col_group = $(cell_input).attr('data-col-group');
            updateIndColGroup(delta,row_input,col_group);
        }
        $(row_totaux).filter(function(index,row_total){
            var temp_group_id = $(row_total).attr('data-row-id');
            return ($(row_total).index() > row_index && (!isset(temp_group_id) ||  row_total_group_id.indexOf(temp_group_id)!=-1)) ;
        }).each(function(index,tr_total){
            var nb_cell_in_total_row = $(tr_total).find('td,th').length;
            var delta_nb_cell = nb_cell_in_total_row - nb_cell_in_row;
            delta_nb_cell = !isNaN(delta_nb_cell) ? delta_nb_cell : 0;
            var temp_cell_index = cell_index + delta_nb_cell;
            var cell_total = $(tr_total).find('td:nth-child('+temp_cell_index+'),th:nth-child('+temp_cell_index+')');
            var current_total = parseFloat($(cell_total).text());
            $(cell_total).text(current_total+delta);
            if($(cell_total).is('[data-col-group]')){
                var col_group = $(cell_total).attr('data-col-group');
                updateIndColGroup(delta,tr_total,col_group);
            }
        });
    }

    function updateIndColGroup(delta,row,col_groups){
        if(col_groups!=undefined){
            col_groups = col_groups!=undefined ? col_groups.split(",") : [];
            for(key in col_groups){
                var col_group = col_groups[key];
                var cell_col_total = $(row).find('[data-col-id="'+col_group+'"]');
                var current_total = parseFloat($(cell_col_total).text());
                $(cell_col_total).text(current_total+delta);
                if($(cell_col_total).is('[data-col-group]')){
                    var next_col_group = $(cell_col_total).attr('data-col-group');
                    updateIndColGroup(delta,row,next_col_group);
                }
            }
        }
    }

});
