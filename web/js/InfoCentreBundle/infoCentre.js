/*
 *	fichier web/js/infoCentre.js
 *
 *	fichier javascript principal de l'InfoCentreBundle
 *
 *  ancre dans le script :
 *      - #action_export_btn : la gestion des demandes d'export
 *      - #action_delete_export_btn : la gestion de la suppresion d'un export long (bsltm)
 *      - #action_download_export_btn ; la gestion du téléchargement d'un export long (bsltm)
 *
 */
var filter_results_data_table_language_config = getLanguagaDataTableBase({
    info: "Collectivités _START_ &agrave; _END_ sur _TOTAL_",
    infoEmpty: "Aucune collectivité"
}) ;
setGlobalVar('filter_results_data_table_config',{
    'table':{
        'id':'filter_results_table',
        'key':'filter_results',
    },
    'columns_default':[
        {
            "orderable": false,
            'data':null,
            "render": function ( data, type, row, meta ) {
                //var btn = createButton('i class="fa fa-trash-o"></i>',{'class':'btn btn-danger remove_pool_item_action'},{'id_pool_item':data});
                /*"<button class='btn btn-danger remove_pool_item_action' data-id-pool-item='"+data+"'>
											<i class="fa fa-trash-o"></i>
										</button>*/
                var temp_row_key = getRowKeyIncludeToPool(row);//row.idColl+'-'+row.idEnqu;
                var checked = isInIncludeToPoolPile(temp_row_key) ? "checked" : "";
                return '<input type="checkbox" class="select_to_pool_button" name="select_to_pool[]" value="'+temp_row_key+'" '+checked+'>';//$(btn).prop('outerHTML');
            }
        }
    ],
    'columns_available':{
        'siretColl':{
            'libelle':'Siret',
            'data':'siretColl'
        },
        'codeInseeColl':{
            'libelle':'Code Insee',
            'data':'codeInseeColl'
        },
        'nomColl':{
            'libelle':'Nom de la collectivité',
            'data':'nomColl'
        },
        'lbTypeColl':{
            'libelle':'Type de collectivité',
            'data':'lbTypeColl'
        },
        'villeColl':{
            'libelle':'Ville',
            'data':'villeColl'
        },
        'lbDepa':{
            'libelle':'Département',
            'data':'lbDepa',
            'render':function(data, type, row, meta ){
                var lb_depa = data;
                lb_depa = isset(row['cdDepa']) ? row['cdDepa']+' - '+lb_depa : lb_depa;
                return lb_depa;
            }
        },
        'affiColl':{
            'libelle':'Collectivité affiliée',
            'data':'affiColl',
            'render':function(data, type, row, meta ){
                var affi_coll = boolToYesNoNa(data);
                return affi_coll;
            }
        },
        'chsctColl':{
            'libelle':'CHSCT propre',
            'data':'chsctColl',
            'render':function(data, type, row, meta ){
                var chsct_coll = boolToYesNoNa(data);
                return chsct_coll;
            }
        },
        'attachCtColl':{
            'libelle':'Rattachée au CT',
            'data':'attachCtColl',
            'render':function(data, type, row, meta ){
                var attach_ct_coll = boolToYesNoNa(data);
                return attach_ct_coll;
            }
        },
        'cdgAccesBilan':{
            'libelle':'Cdg peut prendre la place',
            'data':'cdgAccesBilan',
            'render':function(data, type, row, meta ){
                var cdg_acces_bilan = boolToYesNoNa(data);
                return cdg_acces_bilan;
            }
        },
        'lbCdg':{
            'libelle':'Cdg',
            'data':'lbCdg',
        },
        'lbTypeSurclDemo':{
            'libelle':'Tpe de surclassement démographique',
            'data':'lbTypeSurclDemo',
        },
        'anneCamp':{
            'libelle':'Année de la campagne',
            'data':'anneeCamp'
        },
        'nbAgentCons':{
            'libelle':'Nombre d\'agent',
            'data':'nbAgentCons'
        },
        'nbAgentConsEtpr':{
            'libelle':'Nombre d\'agent Etpr',
            'data':'nbAgentConsEtpr'
        },
        'blEnquCollRast':{
            'libelle':'Rast',
            'data':'blEnquCollRast',
            "render":function(data, type, row, meta ){
                return boolToYesNoNa(data)
            }
        },
        'blEnquCollGpeec':{
            'libelle':'Gpeec',
            'data':'blEnquCollGpeec',
            "render":function(data, type, row, meta ){
                return boolToYesNoNa(data)
            }
        },
        'blEnquCollHandi':{
            'libelle':'Echantillon DGCL',
            'data':'blEnquCollHandi',
            "render":function(data, type, row, meta ){
                return boolToYesNoNa(data)
            }
        },
        'echantillonDgcl':{
            'libelle':'Handitorial',
            'data':'echantillonDgcl',
            "render":function(data, type, row, meta ){
                return boolToYesNoNa(data)
            }
        },
        'nbPopulationCol':{
            'libelle':'Population de la collectivité',
            'data':'nbPopulationCol'
        },
        'nombreIncoherence':{
            'libelle':'Nombre d\'incohérence',
            'data':'nombreIncoherence'
        },
        'typeInitBilan':{
            'libelle':'Type d\'initialisation',
            'data':'sourceInitBilan',
            "render":function(data, type, row, meta ){
                return dataSwap(data,getSwapBoard('type_init_bilan'));
            }
        },
        'statutBilan':{
            'libelle':'Statut du bilan',
            'data':'statutBilanSocial',
            "render":function(data, type, row, meta ){
                return dataSwap(data,getSwapBoard('statut_bilan'));
            }
        },
        'moyenneHanditorial':{
            'libelle':'Pourcentage Handitorial',
            'data':'moyenneHanditorial',
            "render":function(data, type, row, meta ){
                return Math.round(data) + '%';
            }
        },
        'moyenneRassct':{
            'libelle':'Pourcentage Rassct',
            'data':'moyenneRassct',
            "render":function(data, type, row, meta ){
                return Math.round(data) + '%';

            }
        },
        'moyenneGpeec':{
            'libelle':'Pourcentage Gpeec',
            'data':'moyenneGpeec',
            "render":function(data, type, row, meta ){
                return Math.round(data) + '%';

            }
        },
        'moyenneGpeecPlus':{
            'libelle':'Pourcentage Gpeec plus',
            'data':'moyenneGpeecPlus',
            "render":function(data, type, row, meta ){
                return Math.round(data) + '%';

            }
        },
        'moyenneBilanSocialConso':{
            'libelle':'Pourcentage Bilan social consolidé',
            'data':'moyenneBilanSocialConso',
            "render":function(data, type, row, meta ){
                return Math.round(data) + '%';

            }
        }
    },
    'options':{
        'fnDrawCallback ': function(){
            //if(!getGlobalVar('filter_results_section_data_table_first_draw_done')){
            setDataTableIsInitialized('filter_results');
            if(checkFlowSectionDataTableIsInitialized('filter_results')){
                openSection('filter_results');
                adjustDataTableWidth('current_pool');
                getDataTableApi('current_pool').draw();
                removeSpinner('#info_centre_workflow_wrapper');
                setGlobalVar('filter_results_section_data_table_first_draw_done',true);
            }
        },
        'deferRender': true,
        'processing': true,
        'language':filter_results_data_table_language_config
            	
    }
});
setGlobalVar('filter_results_section_data_table_first_draw_done',false);

function getSwapBoard(board_name){
    var swap_boards = {
        'type_init_bilan':{
            'manu':'Manuelle',
            'bs-dgcl':'DGCL',
            'n4ds':'N4DS',
            'basecarr':'Base Carrière',
            'bs-vide':'Bilan à vide'
        },
        'statut_bilan' : [
            'En cours de saisie',
            'Transmis',
            'Validé',
            'Non validé',
            'En cours de saisie suite à non validation',
            'Nouvelle transmission en attente de validation',
            'Non connecté',
            'Non saisi',
            'Saisie réinitialisée',
        ]
    }
    var board = isset(swap_boards[board_name]) ? swap_boards[board_name] : undefined;
    return board;
}
function getRowKeyIncludeToPool(row_data){
    return row_data.idColl+'-'+row_data.idEnqu+'-'+row_data.anneeCamp;
}
setGlobalVar('current_pool_data_table_config',{
    'table':{
        'id':'current_pool_items_list',
        'key':'current_pool'
    },
    'columns_available':{
        'id_pool_item':{ 
            "data": "id_pool_item",
            "render": function ( data, type, row, meta ) {
                var btn = dtcreateButton('<i class="fa fa-trash-o"></i>',{'class':'btn btn-danger remove_pool_item_action'},{'id_pool_item':data});
                return btn;//$(btn).prop('outerHTML');
            } 
        },
        'siret':{ "data": "siret" },
        'nom':{ "data": "nom" },
        'annee':{ "data": "annee" },
        'departement':{ "data": "departement" }
    },
    'options':{
        'fnDrawCallback': function(){
            //if(!getGlobalVar('filter_results_section_data_table_first_draw_done')){
            setDataTableIsInitialized('current_pool');
            if(checkFlowSectionDataTableIsInitialized('filter_results')){
                openSection('filter_results');
                adjustDataTableWidth('filter_results');
                removeSpinner('#info_centre_workflow_wrapper');
                setGlobalVar('filter_results_section_data_table_first_draw_done',true);
            }
            //}
        },
        'ajax': function(data,callback,seeting){
            if(getCurrentPoolData()!=null){
                callback(getCurrentPoolData());
            }else{
                $.ajax({
                    url : Routing.generate('info_centre_get_pool_items'),
                    type: 'post',
                }).done(function(response){
                    setCurrentPoolData(response);
                    callback(getCurrentPoolData());
                })
            }
        },
        'deferRender': true,
        'processing': true,
        'language':getLanguagaDataTableBase({
            info: "&Eacute;léments de l'échantillon _START_ &agrave; _END_ sur _TOTAL_",
            infoEmpty: "Aucun élément dans l'échantillon"
        })
    }
});
function setCurrentPoolData(data){
    setGlobalVar('current_pool_data',data);
}
function getCurrentPoolData(){
    return getGlobalVar('current_pool_data');
}
function emptyCurrentPoolData(){
    setGlobalVar('current_pool_data',null);
}
setGlobalVar('data_table_available',{
    'filter_results':'filter_results_data_table_config',
    'current_pool':'current_pool_data_table_config'
});
function getDataTableConfig(table_key,config_name){
    var data_table_available = getGlobalVar('data_table_available');
    var table_config_key = data_table_available[table_key];
    var table_config;
    if(isset(table_config_key)){
        table_config = getGlobalVar(table_config_key);
        if(isset(config_name)){
            table_config = getNestedConfig(table_config,config_name);
        }
    }
    return table_config;
}
function setDataTableConfig(table_key,config_name,config_value){
    var data_table_available = getGlobalVar('data_table_available');
    var table_config_key = data_table_available[table_key];
    var table_config;
    if(isset(table_config_key)){
        table_config = getGlobalVar(table_config_key);
        if(isset(config_name)){
            table_config = setNestedConfig(table_config,config_name,config_value);
        }
        setGlobalVar(table_config_key,table_config);
    }
    return table_config;
}
function getDataTableElement(table_key){
    var table_id = getDataTableConfig(table_key,['table','id']);
    return $('#'+table_id);
}
function getDataTableApi(table_key){
    var table = getDataTableElement(table_key);
    return $(table).dataTable().api();
}
function setFilterResultsDataTableConfig(config_name,config_value){
    var config = getFilterResultsDataTableConfig();
    var updated_config = setNestedConfig(config,config_name,config_value);
    setGlobalVar('filter_results_data_table_config',updated_config);
}
function setCurrentPoolDataTableConfig(config_name,config_value){
    var config = getFilterResultsDataTableConfig();
    var updated_config = setNestedConfig(config,config_name,config_value);
    setGlobalVar('current_pool_data_table_config',updated_config);
}
function setNestedConfig(current_config,config_names,config_value){
    config_names = isArray(config_names) ? config_names : [config_names];
    var config_name = config_names.shift();
    if(config_names.length>0 && isset(current_config[config_name])){
        current_config[config_name] = setNestedConfig(current_config[config_name],config_names,config_value);
    }else{
        current_config[config_name] = config_value;
    }

    return current_config;
}
function getNestedConfig(current_config,config_names){
    config_names =isArray(config_names) ? config_names : [config_names];
    var config_name = config_names.shift();
    var config_value;
    if(isset(current_config[config_name])){
        if(config_names.length>0){
            config_value = getNestedConfig(current_config[config_name],config_names);
        }else{
            config_value = current_config[config_name];
        }
    }
    return config_value;
}
function getFilterResultsDataTableConfig(config_name){
    var data_table_config = getGlobalVar('filter_results_data_table_config');
    if(isset(data_table_config) && isset(config_name)){
        data_table_config = data_table_config[config_name];
    }
    return data_table_config;
}
function getFilterResultsTableConfig(config_name){
    var table_config = getFilterResultsDataTableConfig('table');
    if(isset(table_config) && isset(config_name)){
        table_config = table_config[config_name];
    }
    return table_config;
}
function getFilterResultsTable(get_datatable_api){
    get_datatable_api = get_datatable_api===true ? true : false;
    var table;
    if(get_datatable_api){
        table = getDataTableApi(getFilterResultsTableConfig('key'));
    }else{
        //var table_id = getFilterResultsTableConfig('id');
        table = getDataTableElement('filter_results');//$('#'+table_id);
    }
	
    return table
}
function getFilterRresultsColumsConfig(col_name){
    var colums_config = getFilterResultsDataTableConfig('columns_available');
    if(isset(colums_config) && isset(col_name)){
        colums_config = colums_config[col_name];
    }
    return colums_config;
}
function getFilterRresultsColumConfig(col_name,config_name){
    var colum_config = getFilterRresultsColumsConfig(col_name);
    if(isset(colum_config) && isset(config_name)){
        colum_config = colum_config[config_name];
    }
    return colum_config;
}
function getCurrentPoolDataTableConfig(config_name){
    var data_table_config = getGlobalVar('current_pool_data_table_config');
    if(isset(data_table_config) && isset(config_name)){
        data_table_config = data_table_config[config_name];
    }
    return data_table_config;
}
function getCurrentPoolTableConfig(config_name){
    var table_config = getCurrentPoolDataTableConfig('table');
    if(isset(table_config) && isset(config_name)){
        table_config = table_config[config_name];
    }
    return table_config;
}
function getCurrentPoolTable(get_datatable_api){
    get_datatable_api = get_datatable_api===true ? true : false;
    var table;
    if(get_datatable_api){
        table = getDataTableApi(getCurrentPoolTableConfig('key'));
    }else{
        //var table_id = getCurrentPoolTableConfig('id');
        table = getDataTableElement('current_pool');//$('#'+table_id);
    }
	
    return table
}
function getCurrentPoolColumsConfig(col_name){
    var colums_config = getCurrentPoolDataTableConfig('columns_available');
    if(isset(colums_config) && isset(col_name)){
        colums_config = colums_config[col_name];
    }
    return colums_config;
}
function getCurrentPoolDataTableColumConfig(col_name,config_name){
    var colum_config = getCurrentPoolColumsConfig(col_name);
    if(isset(colum_config) && isset(config_name)){
        colum_config = colum_config[config_name];
    }
    return colum_config;
}
function isFilterResultsDataTableCollAvailable(col_name,data){
    var is_available = false;
    if(isArray(data) && isset(data[0]) && data[0]!=null){
        if(Array.from(Object.keys(data[0])).indexOf(getFilterRresultsColumConfig(col_name,'data'))>-1){
            is_available = true;
        }
    }
    return is_available;
}
function isCurrentPoolCollAvailable(col_name,data){
    var is_available = false;

    if(Array.from(Object.keys(data[0])).indexOf(getCurentPoolColumConfig(col_name,'data'))>-1){
        is_available = true;
    }
    return is_available;
}
function processFilterResultsDataToTableHead(data){
    var heads = [];
    var columns_available = getFilterRresultsColumsConfig()
    for(col_name in columns_available){
        if(isFilterResultsDataTableCollAvailable(col_name,data)){
            var head_lbl = getFilterRresultsColumConfig(col_name,'libelle')
            head_lbl = isset(head_lbl) ? head_lbl : col_name;
            heads.push(head_lbl);
        }
    }
    return heads;
}
function processFilterResultsDataToTableColums(data){
    var columns = [];
    /*columns.push({
		'data':null,
		"render": function ( data, type, row, meta ) {
	       //var btn = createButton('<i class="fa fa-trash-o"></i>',{'class':'btn btn-danger remove_pool_item_action'},{'id_pool_item':data});
	       "<button class='btn btn-danger remove_pool_item_action' data-id-pool-item='"+data+"'>
										<i class="fa fa-trash-o"></i>
									</button>
			var temp_row_key = row.idColl+'-3';
	    	return '<input type="checkbox" name="select_to_pool[]" value="'+temp_row_key+'">';//$(btn).prop('outerHTML');
	    }
	});*/
    var columns_default = getDataTableConfig('filter_results',['columns_default']);
    if(isset(columns_default) && isArray(columns_default)){
        columns = columns.concat(columns_default);
    }
    var columns_available = getFilterRresultsColumsConfig()
    for(col_name in columns_available){
        if(isFilterResultsDataTableCollAvailable(col_name,data)){
            var column = {}
            var col_data_key = getFilterRresultsColumConfig(col_name,'data');
            var col_render = getFilterRresultsColumConfig(col_name,'render');
            if(isset(col_data_key)) column['data'] = col_data_key;
            if(isset(col_render)) column['render'] = col_render;
            columns.push(column);
        }
    }
    return columns;
}
function processFilterResultsDataToOptions(data){
    var options = getDataTableConfig('filter_results',['options']);
    return options;
}
function adjustDataTableWidth(table_key){
    var table = getDataTableApi(table_key);
    dtAdjustTable(table);
}
function setDataTableIsInitialized(table_key,is_initialized){
    is_initialized = is_initialized===false ? false : true;
    setDataTableConfig(table_key,['table','initialized'],is_initialized);
}
function getDataTableIsInitialized(table_key){
    getDataTableConfig(table_key,['table','initialized']);
}
function checkDataTableIsInitialized(table_key){
    var is_initialized = getDataTableConfig(table_key,['table','initialized']);
    return !isset(is_initialized) || is_initialized==false ? false : true;
}
function isDataTableInDom(table_key){
    var table_elmt = getDataTableElement(table_key);
    return $(table_elmt).length > 0;
}
function loadSliderRange(parentRange){
    var target = $(parentRange).data('target');

    /* target est le parametre qui permet de differencier chaque range */
    /*console.log(target);*/
    var idSlider = "#slider-range-"+target;
    var inputRange = $(parentRange).find('input[type="range"]');

    var htmlElement = '<div class="form-group "><label class="control-label">'+sfTrans("infocentre.filter_form.pourcent_"+target+"_range.label")+'</label><div id="value-'+target+'">Min : 0 et Max : 100</div><div id="slider-range-'+target+'"></div></div>';

    $(parentRange).append(htmlElement);
    /*console.log(inputRange);*/
    $(idSlider).slider({
        range: true,
        min: 0,
        max: 100,
        values: [ 0, 100 ],
        slide: function( event, ui ) {
            var min = $('#infocentre_filter_form_pourcent'+target+'Min');
            var max = $('#infocentre_filter_form_pourcent'+target+'Max');
            min.prop("disabled", false);
            max.prop("disabled", false);
            min.val(ui.values[ 0 ]);
            max.val(ui.values[ 1 ]);
            $( '#value-'+target ).text( "Min : " + ui.values[ 0 ] + " et Max : " + ui.values[ 1 ] );
        }
    });
}
$(document).ready(function(){
    $('.runjob').on('click', function(event){
        event.preventDefault(); //prevent default action

        var select_pool = $('#export_pool_id_select_table').val();
        if(select_pool.length > 0){
            console.log(select_pool);
            var form_data = $(select_pool); //Encode form elements for submission
            var job = $(this).data('job');
            var is_long_task = $(this).data('long-task');
            var url = Routing.generate('info_centre_collectivite_get_data_ajax');
            if(is_long_task==true){
                var temp_spinner = addSpinner('#spinner_export','Export en préparation',true);
                $.post({
                    'url':url,
                    'data': {
                        'pool' : select_pool,
                        'job' : job
                    },
                    'success' : function(response){
                        var dt_table_api = $('#table_task').dataTable().api();
                        dt_table_api.row.add(response).draw(false);

                        removeASpinner(temp_spinner);
                        /* TP I */
                    }
                });
            }else{
                var form = createFormToAjax(url,'POST',{
                    'pool' : select_pool,
                    'job' : job
                });

                $('body').append(form);
                form.submit();
            }
        }else{
            alert('vide');
        }
    });

    $(document).tooltip({
        content: function () {
            return $(this).prop('title');
        }
    });
    $.fn.dataTable.moment('DD/MM/YYYY HH:mm');
	$('#table_task').DataTable({
		deferRender: true,
        language:getLanguagaDataTableBase({
            info: "Affichage _START_ &agrave; _END_ sur _TOTAL_ export",
            infoEmpty: "Affichage 0 &agrave; 0 sur 0 export",
        }),
        columnDefs: [
            {
                targets: '_all',
                className: 'dt-center'
            },
            {
                targets: 2,
                type: 'date-euro'
            }
        ],
        columns: [
            { 	title: "Nom de l\'échantillon",
                data: "pool_nom",
                defaultContent: ""
            },{ 	
                title: "Nature de l'export",
                data: null,
                render: function (data, type, row, meta){
                    if (data.exportType == 'hrgExport') {
                        var trans = sfTrans("longtask.export.HRG");
                    
                        return trans;
                    } else {
                        if (data.longTaskHeaders[0]) {
                            var task_type = isset(data.longTaskHeaders[0].fromApi) ? data.longTaskHeaders[0].fromApi.taskType : data.longTaskHeaders[0].taskTypeLibelle;
                            var trans = sfTrans("longtask.export."+task_type);
                            return trans;
                        }
                    }
                    return "";
                }
            },{
                title: "Date de début",
                data: null,
                render: function (data, type, row, meta) {
                    var view = ""
                    if (data.exportType == 'hrgExport') {
                        var date = data.headerExportHRG.dateStart.date;
                        view = moment(date).format('DD/MM/YYYY HH:mm');

                        return view;
                    } else {
                        var tasks = data.longTaskHeaders;
                        for(var i=0;i<tasks.length;i++){
                            var task = tasks[i];
                            var date = task.start_date.date;
                            view += moment(date).format('DD/MM/YYYY HH:mm');
                            if(!isEmpty(view)) break;
                        }
                        return view;
                    }
                }
            },{
                title: "Date de fin",
                data: null,
                render: function (data, type, row, meta) {
                    if (data.exportType == 'hrgExport') {
                        if (data.headerExportHRG.dateEnd != null) {
                            var view = moment(data.headerExportHRG.dateEnd.date).format('DD/MM/YYYY HH:mm');
                        } else if (data.headerExportHRG.status == 3) {
                            var view = 'Echec';
                        } else {
                            var view = 'En cours';
                        }
                    } else {
                        var ratio  = '';
                        var src_param  = '';
                        var tasks = data.longTaskHeaders;
                        var view = "";
                        var leading_progress_bar_ok = false;
                        for(var i=0;i<tasks.length;i++){
                            view += "<p>";
                            var task = tasks[i];
                            if (task.statusCode == "RUNNING" || task.statusCode == "READY_TO_RUN" || task.statusCode == "FINISHING"){
                                var pb_attr = getAttrProgressBarForTask(task.task_key);
                                var attr_str = "";
                                var class_str = "";
                                var queued_string = "";
                                var attr_keys = [
                                    'data-progress-wait',
                                    'data-pile-index-timer'
                                ];
                                if(task.statusCode == "FINISHING"){
                                    class_str += " hidden ";
                                    queued_string = '<p>traitement des données<i class="fa fa-check"></i></p>' +
                                            '<p>préparation du fichier<i class="fa fa-spinner"></i></p>';
                                }
                                if(isset(pb_attr)){
                                    for(var attr_key of attr_keys){
                                        var temp_attr_value = pb_attr[attr_key];
                                        if(isset(temp_attr_value)){
                                            attr_str += ' '+attr_key+'="'+temp_attr_value+'"';						}
                                    }
                                    var is_initialized = isset(pb_attr['is_initialized']) && pb_attr['is_initialized']==true;
                                    if(is_initialized){
                                        class_str += ' initialized ';
                                    }
                                }
                                var ratio =  task.detailsCount>0 ? (task.detailsDoneCount + task.detailsErrorCount) / task.detailsCount * 100 : 0;
                                /*console.log(data.taskKey);*/
                                var src_param = { "pool_export" : data.id };
                                var url_task_manager = Routing.generate('getUserTasks');
                                var leading_progress_bar = !leading_progress_bar_ok ? 1 : 0;
                                leading_progress_bar_ok = true;
                                view += '<div class="progress_infocentre_depa bs_progress_bar '+class_str+'" '+attr_str+' data-task_key="'+task.task_key+'" data-progress-src="'+url_task_manager+'" data-leading-progress-bar="'+leading_progress_bar+'" data-index-in-response="'+i+'" data-progress-src-param=\''+JSON.stringify(src_param)+'\' data-progress-delay="10000">'
                                        + '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="'+ratio+'" aria-valuemin="0" aria-valuemax="100" style="width: '+ratio+'%; min-width:2em;">'
                                        + ratio + '%'
                                        +'</div>'
                                        +'</div>'
                                        +queued_string;
                            }else {
                                  var timer_index = getAttrProgressBarForTask(task.task_key,'data-pile-index-timer');
                                if(task.statusCode == "FINISHING"){
                                    view += '<p>traitement des données<i class="fas fa-check"></i></p>'
                                          +'<p>préparation du fichier<i class="fas fa-spinner"></i></p>';
                                }else{
                                    //if(task.statusCode == "FINISHED"){
                                        var date = isset(task.fromApi) ? moment(task.fromApi.endDate).format('DD/MM/YYYY HH:mm') : "-";
                                        view += '<p>'+ date + '</p>';
                                    //}
                                    if(task.statusCode == "RUN_FAILED"){
                                        view += '<p>Une erreur est survenue</p>';
                                    }
                                    if(task.statusCode == "ABORTED"){
                                        var info = (task.status_linked_data);
                                        view += '<span class="hidden">'+info+'</span>';
                                    }
                                    if(isset(timer_index)) {
                                        stopTimerFromPile(timer_index, {
                                            on_stopped: function () {
                                                //$('#table_task').DataTable().ajax.reload(null, false);
                                            }
                                        });
                                    }
                                }
                            }
                            view += "</p>";
                        }
                    }


                    /*
                    </div>
                    {% elseif task.status == "FINISHING" %}
                <p>traitement des données<i class="fas fa-check"></i></p>
                    <p>préparation du fichier<i class="fas fa-spinner"></i></p>
                    {% elseif task.status == "FINISHED"  %}
                <p>terminé le {{ task.endDate|date("d/m/Y à H:i", "Europe/Paris") }}</p>
                    {% endif %}*!/*/
                    /* var url = data[0].url;
                    data = '';
                    if(!isEmpty(url)){
                        data = '<a href=' + url + ' target="_blank" ><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a> ';
                    }*/

                    return view;
                }
            },{
               	title: "Nombre de collectivités",
                data: null,
                render: function(data, type, row, meta){
                    if (data.exportType == 'hrgExport') {
                        var view = "0";

                        return view;
                    } else {
                        var view = "";
                        var tasks = data.longTaskHeaders;
                        for(var i=0;i<tasks.length;i++){
                            var task = tasks[i];
                            var run_data = JSON.parse(task.run_data);
                            var annee = run_data.refYear;
                            var nbItem =  task.details_count;
                            view += "<p> "+annee+" : "+nbItem+" collectivitée"+(nbItem>1?"s":"")+" </p>";                      
                        }
                        return view;
                    }
                }
            },{
              	title: "Etat",
                data: null,
                render: function(data, type, row, meta){
                    if (data.exportType == 'hrgExport') { 
                        var status = data.headerExportHRG.status;
                        var view = '';
                        if (status == 0) {
                            view = 'Lancement';
                        } else if (status == 1) {
                            view = 'En cours';
                        } else if (status == 2) {
                            view = 'Terminé';
                        } else if (status == 3) {
                            view = 'Echec';
                        }

                        return view;
                    } else {
                        var view = "";
                        var tasks = data.longTaskHeaders;
                        var view = "";
                        var etat = "";
                        for(var i=0;i<tasks.length;i++){
    
                            var task = tasks[i];
                            
                            /*if (task.statusCode == "RUNNING"){
                                etat = sfTrans("infocentre.etat.running");
                            }else if(task.statusCode == "FINISHED"){
                                etat = sfTrans("infocentre.etat.finished");
                            }else if(task.statusCode == "READY_TO_RUN"){
                                etat = sfTrans("infocentre.etat.readytorun");
                            }else if(task.statusCode == "RUN_FAILED"){
                                etat = sfTrans("infocentre.etat.runfailed");
                            }*/
                            var status_code = task.statusCode;
                            var str_etat = status_code!=null ? "infocentre.etat."+status_code.toLowerCase() : "inconnue";
                            var etat = sfTrans(str_etat);
                            view += "<p> "+etat+" </p>";                      
                        }
                        return view;
                    }
                }

            },{
                title: "Action",
                data: null,
                render: function (data, type, row, meta) {
                    if (data.exportType == 'hrgExport') {
                        var status = data.headerExportHRG.status;
                        var view = '';
                        if (status == 2) {
                            view = '<button class="btn btn-success sm_btn btn_download_infocentre_export_hrg" data-header-export-hrg-id="'+data.headerExportHRG.id+'" title="Télécharger l\'export">\
                                        <span class="glyphicon glyphicon-download" aria-hidden="true"></span>\
                                    </button><br />\
                                    <button class="btn btn-danger sm_btn cancel_delete_export_hrg" title="annuler/supprimer l\'export"><i class="fa fa-trash-o" data-pool-export="'+data.headerExportHRG.pool_export_id+'"></i></button>';
                        } else {
                            view = '';
                        }
                        return view;
                    } else {
                        var tasks = data.longTaskHeaders;
                        var view = "";
                        var all_done = true;
                        var some_error = false;
                        var one_ok = false;
                        var tasks_view = "<span>";
                        for(var i=0;i<tasks.length;i++){
    
                            var task = tasks[i];
                            var in_error = false;
                            //var data_from_api = task.from_api;
                            //var url_pile = data.uriPile;//data[0].url;
                            //var url_to_content = !isEmpty(url_pile) && isset(url_pile['contentUri']) ? url_pile['contentUri'] : null;
    
                            if(["FINISHED","INIT_FAILED","RUN_FAILED","ABORTED"].indexOf(task.statusCode)==-1){
                                all_done = false;
                            }
                            if(["INIT_FAILED","RUN_FAILED","ABORTED"].indexOf(task.statusCode)!=-1){
                                some_error = true;
                                in_error = true;
                            }
                            if(["FINISHED"].indexOf(task.statusCode)!=-1){
                                one_ok = true;
                            }
                            tasks_view += '<p><button class="btn btn-danger sm_btn cancel_delete_longTask" title="annuler/supprimer l\'export"><i class="fa fa-trash-o" data-task-status="'+task.statusCode+'" data-task-key="'+task.task_key+'"></i></button></p>';
                        }
                        tasks_view += "</span>";
                        view += "<span>";
                        if(all_done && one_ok){
                            view += '<button class="btn btn-success sm_btn btn_download_infocentre_coll_export" data-pool-export-id="'+data.id+'" title="Télécharger l\'export">\
                                        <span class="glyphicon glyphicon-download" aria-hidden="true"></span>\
                                    </button></a> ';
                        }
                        view += "</span>"+tasks_view;
                        /*var url_pile = data.uriPile;//data[0].url;
                        var url_to_content = !isEmpty(url_pile) && isset(url_pile['contentUri']) ? url_pile['contentUri'] : null;
                        var responseHtml = '';
                        if(url_to_content!=null){
                            responseHtml = '<a href=' + url_to_content + ' target="_blank" >\
                                    <button class="btn btn-success sm_btn" title="Télécharger l\'export">\
                                        <span class="glyphicon glyphicon-download" aria-hidden="true"></span>\
                                    </button></a> ';'<a href=' + url_to_content + ' target="_blank" ><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a> ';
                            responseHtml += '<button class="btn btn-danger sm_btn cancel_delete_longTask" title="annuler/supprimer l\'export"><i class="fa fa-trash-o" data-task-status="'+data.status+'" data-task-key="'+data.taskKey+'"></i></button>';
                        } else if (url_to_content === null && data.status === "RUN_FAILED") {
                            responseHtml = '<button class="btn btn-danger sm_btn cancel_delete_longTask" title="annuler/supprimer l\'export"><i class="fa fa-trash-o" data-task-status="'+data.status+'" data-task-key="'+data.taskKey+'"></i></button>';
                        }
                        return responseHtml;*/
                        return view;
                    }
                }
            }
        ],
        ajax: {
            url: Routing.generate('getUserTasks'),
            dataSrc: '',
            rowId: 'id'
        },
        /*preDrawCallback: function( settings ) {
        	var data = this.data();
        	console.log(data);
            var dt_rows = $(this).DataTable().rows();
            var pb_elements = $(dt_rows.nodes()).find('.bs_progress_bar:not(.initialized)');
            $(pb_elements).each(function(k,v){
                $(v);
            });
        },*/
        drawCallback:function(settings){
            initProgressBarOfDatatable($(this));//$('#table_task'));
        }
    });

    //$('.export_pool_btn').tooltip();
    $('.copy_pool_action').on('click',function(event){
        var id_pool = $(this).parents('tr:first').attr('data-id-pool');
        var clone_action_path = Routing.generate('info_centre_clone_pool')
        var form = createFormToAjax(clone_action_path,'post',
        {
            'id_pool_to_clone':id_pool
        }
		);
        $(form).submit();
    });

    $('.delete_pool_action').on('click',function(event){

        var id_pool = $(this).parents('tr:first').attr('data-id-pool');
        createBtpModal("confirm_delete_pool", "Suppression", "Voulez-vous vraiment supprimer l'échantillon ?", {
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
                    lbl:sfTrans("modal.btn.confirmer"),
                    attr:{
                        class:"btn btn-primary"
                    },
                    callbacks:{
                        click:function(){
                            var delete_action_path = Routing.generate('info_centre_delete_pool')
                            var form = createFormToAjax(delete_action_path,'post',
                            {
                                'id_pool_to_delete':id_pool
                            }
                                    );
                            $(form).submit();
                        }
                    }
                }
            ]
        }, [], "modal");
        $('#confirm_delete_pool').modal().show();
		
    });

    $('#pools-list-wrapper').on('click','.select_pool_action',function(event){
        var pool_table = $(this).parents("table:first");
        var pool_row = $(this).parents('tr:first');
        selectPoolByRow(pool_table,pool_row);
    });
    $('#table_pool_manager').dataTable({
        "searching": true,
        "lengthChange": false,
        "pageLength": 5,
        "order": [[ 2, 'desc' ]],
        'language':getLanguagaDataTableBase({
            info: "&Eacute;chantillons _START_ &agrave; _END_ sur _TOTAL_",
            infoEmpty: "Aucun échantillon",
        }),
        'columns':[
            {
                "data":"nom",
                "render":function(data, type, row, meta ){
                    var name_btn = dtcreateElement("p",data,{'class':'txt_btn select_pool_action'});
                    return name_btn;
                }
            },
            {
                "data":"description"
            },
            {
                "data":"dateCreation",
                "type":"date-euro"
            },
            {"orderable": false}
        ],
        "fnDrawCallback": function(oSettings) {
            if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
                $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
            }else{
                $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
                var pool_table = $("#table_pool_manager");
                var dt_pool_table = $(pool_table).dataTable().api();
                var rows_nodes = dt_pool_table.rows().nodes().to$();
                var pool_row = $(rows_nodes).filter('.selected_pool');
                selectPoolByRow(pool_table,pool_row);
            }
        }
    });
    openSection('pool_manager');
    //openSection('pool_export_bay');
    $('#export_pool_id_select').on('change',onSelectPoolForExport);
    $('#export_pool_id_select').trigger('change');
    /*
    *   Gestion de la demande d'export long (#action_export_btn)
    */
    var confirm = false;
    var export_name;
    var export_action;
    var btn_clicked;
    $(document).on('click','.export_pool_btn',function(event){
        var modal;
        btn_clicked = $(this);
        export_name = $(btn_clicked).attr('data-export-name');
        export_action = $(btn_clicked).val();
        var to_ajax = $(btn_clicked).is('[data-ajax-submit="1"]');
        modal = createConfirmModal(
            'confirm_modal_pool_export',
            'Export de l\'échantillon',export_name+' : confirmez-vous l\'export ?',
            function(){
                if(to_ajax){
                    confirm = false;
                    var temp_spinner = addSpinner('#spinner_export','Export en préparation',true);
                    $('#export_pool_form').ajaxSubmit({
                        beforeSubmit: function(){
                            closeBtpModal(modal);
                        },
                        data: {"export_action":export_action},
                        success:    function(response) {
                            var pool_export = response.pool_export;
                            var dt_table_api = $('#table_task').dataTable().api();
                            dt_table_api.row.add(pool_export).draw(false);

                            removeASpinner(temp_spinner);
                            //initProgressBarOfElement($('#long_task_fiche_container'));
                            $(document).on('click','.cancel_delete_longTask',cancelDeleteTaskEvent);
                            //$('#table_task').DataTable().ajax.reload();

                        } 
                    });
                }else{
                    confirm = true;
                    $(btn_clicked).trigger('click');
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
    });
    /*
    *   Gestion de la suppresion d'un export long (bsltm) (#action_delete_export_btn)
    */
    $(document).on('click','.cancel_delete_longTask',cancelDeleteTaskEvent);
    $(document).on('click','.cancel_delete_export_hrg',deleteExportHrg);
    /*
    *   Gestion du téléchargement d'un export long (bsltm) (#action_download_export_btn)
    */
    $(document).on('click','.btn_download_infocentre_coll_export',function(event){
        var btn_clicked = $(this);
        var pool_export_id = $(btn_clicked).attr('data-pool-export-id');
        var url = Routing.generate('infocentre_get_pool_export_bsltm_file');
        var form = createFormToAjax(url,'POST',{
            'pool_export_id' : pool_export_id,
        });

        $('body').append(form);
        form.submit();
    });

    $(document).on('click','.btn_download_infocentre_export_hrg',function(event){
        var btn_clicked = $(this);
        var header_export_hrg = $(btn_clicked).attr('data-header-export-hrg-id');
        var url = Routing.generate('infocentre_get_header_export_hrg_file');
        var form = createFormToAjax(url,'POST',{
            'header_export_hrg' : header_export_hrg,
        });

        $('body').append(form);
        form.submit();
    });
})

function selectPoolByRow(pool_table,pool_row){
    var id_pool = $(pool_row).attr('data-id-pool');
    if(id_pool!=getGlobalVar('current_id_poll_selected')){
        var dt_pool_table = $(pool_table).dataTable().api();
        var rows_nodes = dt_pool_table.rows().nodes().to$();
        var select_action_path = Routing.generate('info_centre_select_pool');
        selectPoolOnExportBy(id_pool);
        emptySection('filter_form');
        addSpinnerSection('filter_form')
        emptySection('filter_results');
        addSpinnerSection('filter_results');
        closeSection('pool_export_bay');
        $.ajax({
            url : select_action_path,
            type: 'post',
            data : {'id_pool_selected':id_pool}
        }).done(function(response){
            setCurrentPool(response);
            $(rows_nodes).removeClass('selected_pool').removeClass('info');
            $(pool_row).addClass('selected_pool').addClass('info');
            $.ajax({
                url: Routing.generate('info_centre_get_filter_form'),
                type: 'post',
            }).done(function(response) {
                printSection('filter_form',response);
            });

            $.ajax({
                url: Routing.generate('info_centre_apply_filter'),
                type: 'post',
            }).done(function(response) { 
                printSection('filter_results',response);
            });
	        
        });
    }
}
function initFilterForm(){
    //applyRandomColor($('#form-filters-wrapper'));
    var form_group_done = [];
    $('#form-filters-wrapper').find('div[data-form-group-extra-attr]').each(function(k,v){
        var temp_form_group = $(v).parents('.form-group:first').get(0);
        if(form_group_done.indexOf(temp_form_group)==-1){
            var temp_extra_attr = JSON.parse($(v).attr('data-form-group-extra-attr'));
            addAttributeToElement(temp_form_group,temp_extra_attr);
        }
    });
    /*$(document).on('change','.row',loadSliderRange)*/

    var parentSlider = $('#form-filters-wrapper').find('[data-role="rangeslider"]');
    parentSlider.each(function(){
        loadSliderRange($(this));
    });

    $('#form-filters-wrapper').find('input[type="date"]')
    //.attr('type','text')
            .on('click', function(e) {e.preventDefault();})
            .datepicker({
                language: 'fr',
        clearBtn: true,
        todayBtn: true,
        format: {
            /*
             * Say our UI should display a week ahead,
             * but textbox should store the actual date.
             * This is useful if we need UI to select local dates,
             * but store in UTC
             */
            toDisplay: function (date, format, language) {
                //var d = new Date(date);
                return bsDateFormat(date,'isoShort');//d.toISOString();
            },
            toValue: function (date, format, language) {
                //var d = new Date(date);
                return new Date(bsDateFormat(date,'isoShort'));//new Date(d);
            }
        }
    })
            .on('changeDate', function(e) {
                $(this).datepicker('update', $(this).prop('value'));
        if($(this).is('.range_part')){
            var date = $(this).val();
            var sup_of = $(this).attr('data-sup-of');
            var low_than = $(this).attr('data-low-than');
            if(isset(sup_of)){
                sup_of = JSON.parse('"'+sup_of+'"');
                sup_of = isArray(sup_of) ? sup_of : [sup_of];
                for(sup_of_selector of sup_of){
                    setDatepEndDate(sup_of_selector,date);
                }
            }
            if(isset(low_than)){
                low_than = JSON.parse('"'+low_than+'"');
                low_than = isArray(low_than) ? low_than : [low_than];
                for(low_than_selector of low_than){
                    setDatepStartDate(low_than_selector,date);
                }
            }
        }
    });
    $('#form-filters-wrapper .checkbox').has('input:checked').addClass('box_border_bold');
    $('#form-filters-wrapper .checkbox').on('click',function(event){
        $(this).toggleClass('box_border_bold');
        event.stopPropagation()
    });
    $('.revert_choices').on('click',function(event){
        var target = $(this).attr('data-revert-for');
        $(target).find('input').prop('checked', false);
    });
    $('#infocentre_filter_form').ajaxForm({
        url: Routing.generate('info_centre_apply_filter'),
        success:    function(response) { 
            //$("#filter_results_receiver").html(response);
            //initFilterResults();
            printSection('filter_results',response)
            closeSection('filter_form');
            openSection('filter_results');
        } 
    });
    /*$('.autocomplete').autocomplete({
	    lookup: function (query, done) {
	        // Do Ajax call or lookup locally, when done,
	        // call the callback and pass your results:
	        var autocomplete_target = $(this).attr('data-auto-complete-field-target');
	        $.ajax({
	        	url: Routing.generate('info_centre_field_auto_complete'),
	        	type: 'post',
	        	data:{
	        		'field_to_autocomplete':autocomplete_target
	        	}
		    }).done(function(response) { 
	        	var result = {
		            suggestions: response
		        };
	        	done(result);
		    });
	        

	        
	    },
	    onSelect: function (suggestion) {
	        alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
	    }
	});*/
    $('.autocomplete').each(function(k,v){
        var autocomplete_target = $(this).attr('data-autocomplete-field-target');
        $(this).autocomplete({
            source: function(request, response){
                $.ajax({
                    url: Routing.generate('info_centre_field_auto_complete'),
                    type: 'post',
                    data:{
                        'field_to_autocomplete':autocomplete_target,
                        'search_term':request.term
                    }
                }).done(function(data) { 
                    response(data); 
                });
            },
            minLength: 2,
        });
    });
    $('.select_all_fellow_checkbox').on('change',function(event){
        var is_to_check = $(this).is(':checked');
        var is_collapse = $(this).is('.select_all_collapse');
        var to_check_uncheck = $(this).parents('.form-group:first').find('input[type="checkbox"]');
        $(to_check_uncheck).each(function(k,v){
            $(v).prop('checked',is_to_check);
        });
        if(is_collapse){
            var collapse_body = $(this).parents('.form-group:first').find('.field-collapse-body:first');
            var is_open = $(collapse_body).is('.in');
            if(is_to_check && !is_open){
                $(collapse_body).collapse('show');
            }else if(!is_to_check && is_open){
                $(collapse_body).collapse('hide');
            }
        }

    });
    $('.range_part[type="text"]:not(.textNumberRange)').attr('type','number');
    $('.range_part.textNumberRange').attr('type','text');
    $('.range_part').on('change',setMinAndMaxForRange);
    $('input[data-replace-pattern]').on('keyup',onInputChangeReplace);
    initInputWithProto();
}
function initFilterResults(){
    emptyIncludeToPoolPile();
    var filter_results_table = getFilterResultsTable();
    $(filter_results_table).on('click','.select_to_pool_button',function(event){
        var to_include = $(this).val();
        toogleInIncludeToPoolPile(to_include);
    })
    setFlowSectionDataTableIsInitialized('filter_results',false);
    /*setDataTableIsInitialized('filter_results',false);
	setDataTableIsInitialized('current_pool',false);*/
    $('#infocentre_edit_pool_form').ajaxForm({
        url: Routing.generate('info_centre_edit_pool'),
        success:    function(response) { 

        } 
    });
    var filter_results_receiver = getFlowSectionReceiverByRef('filter_results')
    $('#include_to_pool_action').on('click',function(event){
        var to_include = getIncludeToPoolPile();
        /*$('#filter_results_table input[name="select_to_pool[]"]:checked').each(function(k,v){
			to_include.push($(v).val());
		});*/
        var include_action_path = Routing.generate('info_centre_include_to_pool')
        $.ajax({
            url : include_action_path,
            type: 'post',
            data : {'include_to_pool':to_include}
        }).done(function(response){
            removeAllFromIncludeToPoolPile();
            emptyCurrentPoolData()
            //$("#filter_results_receiver").html(response);
            //initFilterResults();
            $('#export_pool_id_select').trigger('change');
            if(isset(response.error) && response.error == true){
                printIncludeToPoolError(response.msg_error);
            }
            if(response.data){
                setCurrentPool(response.data);
                printIncludeToPoolError(response.error);
                refreshFilterResultsTable();
                refreshPoolTable();
                //openSection('filter_results');
            }
        }).fail(function(response){
            printIncludeToPoolError(response.error);
        });
    });
    setGlobalVar('remove_self',[]);
    $(filter_results_receiver).on('click ','.remove_pool_item_action',function(){

        var remove_from_pool = $(this).attr('data-id_pool_item');
        if(!getRemovingPool(remove_from_pool)){
            toogleRemovingPool(remove_from_pool);
            var remove_from_pool_action_path = Routing.generate('info_centre_remove_from_pool')
            $.ajax({
                url : remove_from_pool_action_path,
                type: 'post',
                data : {'remove_from_pool_item_id':remove_from_pool}
            }).done(function(response){
                emptyCurrentPoolData()
                //$("#filter_results_receiver").html(response);
                //initFilterResults();
                // setCurrentPool(response.data);
                // printIncludeToPoolError(response.error);
                refreshFilterResultsTable();
                refreshPoolTable();
                //openSection('filter_results');
            }).fail(function(response){
                printIncludeToPoolError(response.error);
            }).always(function(){
                toogleRemovingPool(remove_from_pool);
            });
        }
    });
    $.ajax({
    	'url':Routing.generate('info_centre_get_filter_results'),
    	'method':'post'
    }).done(function(response){
    	initFilterResultsTableHead(response);
    	initFilterResultsTableColumns(response);
    });
	
    $('#current_pool_items_list').DataTable({
        'ajax': function(data,callback,seeting){
            if(getCurrentPoolData()!=null){
                callback(getCurrentPoolData());
            }else{
                $.ajax({
                    url : Routing.generate('info_centre_get_pool_items'),
                    type: 'post',
                }).done(function(response){
                    setCurrentPoolData(response);
                    callback(getCurrentPoolData());
                })
            }
        },
        'dataSrc':function (json) {
            if(isset(response.error)){
                printIncludeToPoolError(response.error);
            }
            return json.data;
        }, 
        "processing": true,
        "columns": [
            { 
                "data": "id_pool_item",
                "render": function ( data, type, row, meta ) {
                    var btn = createButton('<i class="fa fa-trash-o"></i>',{'class':'btn btn-danger remove_pool_item_action'},{'id_pool_item':data});
                    /*"<button class='btn btn-danger remove_pool_item_action' data-id-pool-item='"+data+"'>
                                                                                    <i class="fa fa-trash-o"></i>
                                                                            </button>*/
                    return $(btn).prop('outerHTML');
                } 
            },
            { "data": "siret" },
            { "data": "nom" },
            { "data": "annee" },
            { "data": "departement" },
        ],
        'deferRender': true,
        'language':getLanguagaDataTableBase({
            info: "&Eacute;lément de l'échantillon _START_ &agrave; _END_ sur _TOTAL_",
            infoEmpty: "Aucun élément dans l'échantillon"
        }),
        'fnDrawCallback': function(){
            setDataTableIsInitialized('current_pool');
            if(checkFlowSectionDataTableIsInitialized('filter_results')){
                openSection('filter_results');
                //removeSpinner('#info_centre_workflow_wrapper');
                setGlobalVar('filter_results_section_data_table_first_draw_done',true);
            }
        }
    });
    $('#select_all_to_pool').on('change',toogleAllInIncludeToPoolPile);
}
function getRemovingPool(id_pool){
    var remove_self_table = getGlobalVar('remove_self');
    return remove_self_table[id_pool];
}
function setRemovingPool(id_pool,flag){
    var remove_self_table = getGlobalVar('remove_self');
    remove_self_table[id_pool]=flag;
    setGlobalVar('remove_self',remove_self_table);
}
function toogleRemovingPool(id_pool){
    var flag = getRemovingPool(id_pool)==true;
    setRemovingPool(id_pool,!flag);
}
function initFilterResultsTableHead(data){
    var heads_lbl = processFilterResultsDataToTableHead(data);
    var table = getFilterResultsTable();
    var table_head = $(table).find('thead tr');
    for(i in heads_lbl){
        head_lbl = heads_lbl[i];
        var head_elmt = createElement('th',head_lbl);
        $(table_head).append(head_elmt);
    }
}
function initFilterResultsTableColumns(data){
    var data_table_colums_config = processFilterResultsDataToTableColums(data);
    var data_table_options = processFilterResultsDataToOptions(data);
    setCurrentFilterResults(data);
    var filter_results_table = getFilterResultsTable();
    var data_table_setting = {
        'ajax':function (data, callback, settings) {
            callback(
                    {data:getCurrentFilterResults()}
		    );
        },
        "deferRender": true,
        'columns':data_table_colums_config,
    };
    data_table_setting = mergePlainObject(data_table_setting,data_table_options);
    $(filter_results_table).DataTable(data_table_setting);
    //{
		
    /*"columnDefs": [ 
		 	{
    			"targets": [ 0 ],
				data:null,
				"render": function ( data, type, row, meta ) {
			       //var btn = createButton('i class="fa fa-trash-o"></i>',{'class':'btn btn-danger remove_pool_item_action'},{'id_pool_item':data});
			       "<button class='btn btn-danger remove_pool_item_action' data-id-pool-item='"+data+"'>
												<i class="fa fa-trash-o"></i>
											</button>
					var temp_row_key = row.idColl+'-3';
			    	return '<input type="checkbox" name="select_to_pool[]" value="'+temp_row_key+'">';//$(btn).prop('outerHTML');
			    } 
			}
		],*/
		
    /*'headerCallback': function( thead, data, start, end, display ) {
        	console.log(data);
        	if(data.length>0){
        		var head_list = data[0].keys();
        		$(thead).html('<tr></tr>');
        		var head = createElement('th','inclure');
    			$(thead).find('tr').append(head);
        		for(head_key in head_list){
        			var head_lbl = head_list[head_key];
        			var head = createElement('th',head_lbl);
        			$(thead).find('tr').append(head);
        		}
        	}		    
	  	}*/
    //});
}
function refreshFilterResultsTable(){
    setDataTableIsInitialized('filter_results',false);
    $.ajax({
    	'url':Routing.generate('info_centre_get_filter_results'),
    	'method':'post'
    }).done(function(response){
    	setCurrentFilterResults(response);
        var filter_results_table = getFilterResultsTable();
        var filter_results_table_api = getFilterResultsTable(true);
        getDataTableApi('filter_results').ajax.reload(null,false);
        dtAdjustTable(filter_results_table_api);
    	//initFilterResultsTableHead(response);
    	//initFilterResultsTableColumns(response);
    });
}
function refreshPoolTable(){
    setDataTableIsInitialized('current_pool',false);
    var pool_table_selector = getFlowSectionConfig('filter_results','pool_table_selector');
    var pool_table = $(pool_table_selector);
    getDataTableApi('current_pool').ajax.reload(null,false);
}
function printIncludeToPoolError(msg,empty){
    if(isset(empty) && empty===true){
        emptySectionErrorMsg('filter_results','include_to_pool')
    }
    printSectionErrorMsg('filter_results',msg,'include_to_pool')
}
function printExportPoolError(msg,empty){
    var error_container = $('#export_pool_error_container');
    if(isset(empty) && empty===true){
        $(error_container).find('.error_msg').remove();
    }
    if(!isEmpty(msg)){
        var error_html_msg = createElement("p",msg,{"class":"error_msg"});
        $(error_container).append(error_html_msg);
    }
}
function setCurrentPool(pool){
    setGlobalVar('current_pool',pool);
    setGlobalVar('current_id_poll_selected',pool.id);
}
function getCurrentPool(){
    return getGlobalVar('current_pool');
}
function setCurrentFilterResults(results){
    setGlobalVar('filter_results',results);
}
function getCurrentFilterResults(){
    return getGlobalVar('filter_results');
}

function getIncludeToPoolPile(){
    return getGlobalVar('to_include_to_pool');
}
function setIncludeToPoolPile(include_pile){
    include_pile = isset(include_pile) && isArray(include_pile) ? include_pile : [];
    setGlobalVar('to_include_to_pool',include_pile);
}
function emptyIncludeToPoolPile(){
    setIncludeToPoolPile([]);
}
function addToIncludeToPoolPile(to_include){
    var include_to_pool_pile = getIncludeToPoolPile();
    include_to_pool_pile.push(to_include);
    setIncludeToPoolPile(include_to_pool_pile);
}
function removeFromIncludeToPoolPile(to_include){
    var include_to_pool_pile = getIncludeToPoolPile();
    include_to_pool_pile.splice(include_to_pool_pile.indexOf(to_include),1);
    setIncludeToPoolPile(include_to_pool_pile);
}
function isInIncludeToPoolPile(to_include){
    var include_to_pool_pile = getIncludeToPoolPile();
    return include_to_pool_pile.indexOf(to_include)>-1;
}
function toogleInIncludeToPoolPile(to_include){
    if(isInIncludeToPoolPile(to_include)){
        removeFromIncludeToPoolPile(to_include);
    }else{
        addToIncludeToPoolPile(to_include);
    }
}
function toogleAllInIncludeToPoolPile(event){
    var is_to_check = $(this).is(':checked');
    if(is_to_check){
        addAllInIncludeToPoolPile();
    }else{
        removeAllFromIncludeToPoolPile();
    }
}
function addAllInIncludeToPoolPile(){
    var dt_filter_results = getFilterResultsTable(true);
    dt_filter_results.data().each(function(row_data){
        var to_include = getRowKeyIncludeToPool(row_data);
        if(!isInIncludeToPoolPile(to_include)){
            addToIncludeToPoolPile(to_include);
        }
    });
    dt_filter_results.rows().every(function(rowIdx, tableLoop, rowLoop){
        $(this.cell(rowIdx,0).node()).find('input').prop('checked',true);
    });
    //dt_filter_results.draw('page');
}
function removeAllFromIncludeToPoolPile(){
    var dt_filter_results = getFilterResultsTable(true);
    emptyIncludeToPoolPile();
    dt_filter_results.rows().every(function(rowIdx, tableLoop, rowLoop){
        $(this.cell(rowIdx,0).node()).find('input').prop('checked',false);
    });
}
function getFlowSectionConfig(section_name,config_name){

	var section_ref = {
		'pool_manager':{
			'receiver_selector':'#pools_manager_receiver',
			'section_selector':'#pools_manager_wrapper',
			'collapse_selector':'#body_pools_manager',
		},
		'filter_form':{
			'receiver_selector':'#filter_form_receiver',
			'section_selector':'#filter_form_wrapper',
			'collapse_selector':'#body_form_filters',
			'phantom_title_selector':'#filter_form_phantom_title',
			'spinner_container_selector':'#filter_form_spinner_container',
			'callbacks':{
				'on_printed':'initFilterForm',
			}
		},
		'filter_results':{
			'receiver_selector':'#filter_results_receiver',
			'section_selector':'#filter_results_wrapper',
			'collapse_selector':'#body_filter_results',
			'results_table_selector':'#filter_results_table',
			'pool_table_selector':'#current_pool_items_list',
			'phantom_title_selector':'#filter_results_phantom_title',
			'spinner_container_selector':'#filter_results_spinner_container',
			'error_msg_container_selector':{
				'include_to_pool':'#filter_results_include_to_pool_error_container'
			},
			'data_table':[
				'filter_results',
				'current_pool',
			],
			'callbacks':{
				'on_printed':'initFilterResults',
				'on_collapsed_in':function(event){
					dtMakeFullWidth(getDataTableElement('current_pool'));
					dtMakeFullWidth(getDataTableElement('filter_results'));
				}
			}
		},
		'pool_export_bay':{
			'collapse_selector':'#body_pool_export_bay',
			'phantom_title_selector':'#pool_export_bay_phantom_title',
			'spinner_container_selector':'#pool_export_bay_spinner_container',
			'longtask_table_liste':'#table_task',
		}
	};
	var section_config;
	if(isset(section_name)){
		section_config = section_ref[section_name];
		if(isset(section_config) && isset(config_name)){
			section_config = section_config[config_name];
		}
	}
	return section_config;

}
function getFlowSectionReceiverByRef(section_name){
    var receiver_selector = getFlowSectionConfig(section_name,'receiver_selector');
    var receiver = $(receiver_selector);
    return receiver;
}
function getFlowSectionByRef(section_name){
    var flow_section;
    var receiver = getFlowSectionReceiverByRef(section_name);
    if(isset(receiver)){
        flow_section = $(receiver).find('section:first');
    }
    return flow_section;
}
function getFlowSectionCollapseByRef(section_name){
    var collabse_selector = getFlowSectionConfig(section_name,'collapse_selector');
    var flow_section_collabse;
    if(isset(collabse_selector)){
        flow_section_collabse = $(collabse_selector);
    }
    return flow_section_collabse;
}
function getFlowSectionPhantomTitleByRef(section_name){
    var phantom_title_selector = getFlowSectionConfig(section_name,'phantom_title_selector');
    var flow_section_phantom_title;
    if(isset(phantom_title_selector)){
        flow_section_phantom_title = $(phantom_title_selector);
    }
    return flow_section_phantom_title;
}
function getFlowSectionSpinnerByRef(section_name){
    var spinner_selector = getFlowSectionConfig(section_name,'spinner_container_selector');
    var flow_section_spinner;
    if(isset(spinner_selector)){
        flow_section_spinner = $(spinner_selector);
    }
    return flow_section_spinner;
}
function getFlowSectionCallbackByRef(section_name,callback_name){
    var flow_section_callbacks = getFlowSectionConfig(section_name,'callbacks');
    if(isset(flow_section_callbacks)){
        if(isset(callback_name)){
            var flow_section_callbacks = getNestedConfig(flow_section_callbacks,callback_name);
        }
    }
    return flow_section_callbacks;
}
function getFlowSectionErrorContainerByRef(section_name,container_name){
    var flow_section_error_container = getFlowSectionConfig(section_name,'error_msg_container_selector');
    if(isset(flow_section_error_container)){
        if(isObject(flow_section_error_container) && isset(container_name)){
            var flow_section_error_container = getNestedConfig(flow_section_error_container,container_name);
        }
    }
    return flow_section_error_container;
}
function executeCallbackOnFlowSection(section_name,callback_name){
    if(isset(section_name) && isset(callback_name)){
        var callbacks = getFlowSectionCallbackByRef(section_name,callback_name);
        if(isset(callbacks)){
            callbacks = isArray(callbacks) ? callbacks : [callbacks];
            var event ={
                'section_name':section_name,
                'callback_name':callback_name,
            }
            for(var callback of callbacks){
                if(isCallable(callback)){
                    callback(event);
                }else if(typeof callback == "string"){
                    executeFunctionByName(callback,undefined,event);
                }
            }
        }
    }
}
function openSection(section_name){
    applyCollapseMothodOnFlowSection(section_name,'show');
}
function closeSection(section_name){
    applyCollapseMothodOnFlowSection(section_name,'hide');
}
function toggleSection(section_name){
    applyCollapseMothodOnFlowSection(section_name,'toggle');
}
function emptySection(section_name){
    $(getFlowSectionByRef(section_name)).remove();
    showPhatomSection(section_name);
}
function printSection(section_name,section_content){
    hidePhatomSection(section_name);
    replaceSectionInner(section_name,section_content);
    removeSpinnerSection(section_name);
}
function printSectionErrorMsg(section_name,error_msg,error_container_name){
    var error_container = getFlowSectionErrorContainerByRef(section_name,error_container_name); 
    var error_html_msg = createElement("p",error_msg,{"class":"error_msg"});
    $(error_container).append(error_html_msg);
}
function emptySectionErrorMsg(section_name,error_container_name){
    var error_container = getFlowSectionErrorContainerByRef(section_name,error_container_name);
    $(error_container).children().remove();
}
function hidePhatomSection(section_name){
    var phantom_title = getFlowSectionPhantomTitleByRef(section_name);
    $(phantom_title).hide();	
}
function showPhatomSection(section_name){
    var phantom_title = getFlowSectionPhantomTitleByRef(section_name);
    $(phantom_title).show();	
}
function addSpinnerSection(section_name){
    var spinner_container = getFlowSectionSpinnerByRef(section_name);
    addSpinner(spinner_container,Translator.trans('infocentre.'+section_name+'.spinnertxt'));	
}
function removeSpinnerSection(section_name){
    var spinner_container = getFlowSectionSpinnerByRef(section_name);
    removeSpinner(spinner_container);
}
function replaceSectionInner(section_name,replace){
    var receiver = getFlowSectionReceiverByRef(section_name);
    $(receiver).html(replace);
    executeCallbackOnFlowSection(section_name,"on_printed");
}
function applyCollapseMothodOnFlowSection(section_name,collapse_method){
    var collapse_target = getFlowSectionCollapseByRef([section_name]);
    if(collapse_target!=undefined && collapse_method!=undefined){
        $(collapse_target).collapse(collapse_method);
        if(collapse_method=='show'){
            executeCallbackOnFlowSection(section_name,"on_collapsed_in");
        }
    }
}
function setFlowSectionDataTableIsInitialized(section_name,is_initialized){
    is_initialized = is_initialized===false ? false : true;
    var section_data_table = getFlowSectionConfig(section_name,'data_table');
    var section_data_table_initialized = true;
    if(isArray(section_data_table)){
        for(var table_key_in_list in section_data_table){
            var table_key = section_data_table[table_key_in_list];
            var is_table_in_dom = isDataTableInDom(table_key)
            if(is_table_in_dom){
                setDataTableIsInitialized(table_key,is_initialized);
            }
        }
    }
}
function checkFlowSectionDataTableIsInitialized(section_name){
    var section_data_table = getFlowSectionConfig(section_name,'data_table');
    var section_data_table_initialized = true;
    if(isArray(section_data_table)){
        for(var table_key_in_list in section_data_table){
            var table_key = section_data_table[table_key_in_list];
            var is_table_in_dom = isDataTableInDom(table_key)
            if(is_table_in_dom){
                section_data_table_initialized = checkDataTableIsInitialized(table_key);
                if(section_data_table_initialized==false){
                    break;
                }
            }
        }
    }
    return section_data_table_initialized;
}
function selectPoolOnExportBy(id_pool){
    var export_pool_select = $('#export_pool_id_select');
    selectOneOnSelect(export_pool_select,id_pool);
    $(export_pool_select).trigger('change');
}

function onSelectPoolForExport(event) {
    var id_pool = $(this).val();
    emptyCurrentPoolData();
    $('#pool_export_bouttons_receiver').html('');
    printExportPoolError('', true);
    addSpinner('#pool_export_bouttons_receiver', 'Validation de l\'échantillon');
    checkPoolSecretStat(id_pool,
        function (id_pool, response) {
            printExportPoolError("", true);
            var btns_html = response['export_buttons'];
            $('#pool_export_bouttons_receiver').html(btns_html);
            openSection('pool_export_bay');
        },
        function (id_pool, response) {
            var msg_error = isset(response.error) ? response.error : "";
            printExportPoolError(msg_error, true);
            $('#pool_export_bouttons_receiver').html('');
            openSection('pool_export_bay');
        }
    );
}

function onSelectPoolForExportTable(event){
	var id_pool = $(this).val();
	emptyCurrentPoolData();
	$('#pool_export_bouttons_table_receiver').html('');
	printExportPoolError('',true);
	addSpinner('#body_select_export','Validation de l\'échantillon');
	checkPoolSecretStatV(id_pool,
		function(id_pool,response){
			printExportPoolError("",true);
			var btns_html = response['export_buttons'];
			$('#pool_export_bouttons_table_receiver').html(btns_html);
			/*openSection('pool_export_bay');*/
		},
		function(id_pool,response){
			var msg_error = isset(response.error) ? response.error : "";
			printExportPoolError(msg_error,true);
			$('#pool_export_bouttons_table_receiver').html('');
			/*openSection('head_select_export');*/
		}


	);
    removeSpinner('#body_select_export');
}
function checkPoolSecretStat(id_pool,callback_true,callback_false){
    var check_secret_stat_pool_path = Routing.generate('info_centre_check_pool_secret_stat')
    $.ajax({
        url : check_secret_stat_pool_path,
        type: 'post',
        data : {'id_pool':id_pool}
    }).done(function(response){
        if(isset(response.is_ok) && response.is_ok){
            callback_true(id_pool,response);
        }else if(isset(callback_false)){
            callback_false(id_pool,response);
        }
    });
}
function checkPoolSecretStatV(id_pool,callback_true,callback_false){
	var check_secret_stat_pool_path_table = Routing.generate('info_centre_check_pool_secret_stat_table')
	$.ajax({
	        url : check_secret_stat_pool_path_table,
	        type: 'post',
	        data : {'id_pool':id_pool}
	    }).done(function(response){
	    	if(isset(response.is_ok) && response.is_ok){
	    		callback_true(id_pool,response);
	    	}else if(isset(callback_false)){
	    		callback_false(id_pool,response);
	    	}
	    });
}
function onEventResetSelfDatep(event){
    resetSelfDatep($(this));
}
function resetSelfDatep(datepicker){
    btDatepReset(datepicker);
}
function setDatepStartDate(datepicker,date_start){
    btDatepSetStartDate(datepicker,date_start);
}
function setDatepEndDate(datepicker,date_end){
    btDatepSetEndDate(datepicker,date_end);
}
function setMinAndMaxForRange(event){
    if($(this).is('.range_part')){
        var value = $(this).val();
        var sup_of = $(this).attr('data-sup-of');
        var low_than = $(this).attr('data-low-than');
        if(isset(sup_of)){
            sup_of = JSON.parse('"'+sup_of+'"');
            sup_of = isArray(sup_of) ? sup_of : [sup_of];
            for(sup_of_selector of sup_of){
                $(sup_of_selector).attr('max',value);
            }
        }
        if(isset(low_than)){
            low_than = JSON.parse('"'+low_than+'"');
            low_than = isArray(low_than) ? low_than : [low_than];
            for(low_than_selector of low_than){
                $(low_than_selector).attr('min',value);
            }
        }
    }
}
function onInputChangeReplace(event){
    replaceInInputValue($(this));
}
function replaceInInputValue(input){
    var pattern_to_replace = $(input).attr('data-replace-pattern');
    if(isset(pattern_to_replace)){
        var pattern_to_replace_indicateur = $(input).attr('data-replace-pattern-indicateur');
        var regex_from_pattern = new RegExp(pattern_to_replace,pattern_to_replace_indicateur);
        var replace_in = $(input).val();
        var replace_by = $(input).attr('data-replace-by');
        replace_by = isset(replace_by) ? replace_by : "";
        var value_processed = replace_in.replace(regex_from_pattern,replace_by);
        $(input).val(value_processed).attr('value',value_processed);
    }
}

