/*--------------------------------------------------------------------------------
*	fichier : helper.js
*
*	fichier contenant des fonctions aidant à la création des vu par le js
*
*	dépendance :
*		- Jquery ~ 3.0.0
*		- FosJsRouting
*------------------------------------------------------------------------------------*/

/*
 * fonctions de gestion des variables et functions globales
 */

var GLOBAL_VAR_WRAPPER = {};

function getGlobalVar(var_name){
	var result = undefined;
	if(var_name!=null){
		if(isArray(var_name)){
			var temp_holder = GLOBAL_VAR_WRAPPER;
			for(var key of var_name){
				temp_holder = isset(temp_holder[key]) ? temp_holder[key] : undefined;
				if(!isset(temp_holder)) break;
			}
			result = temp_holder;
		}else{
			result = isset(GLOBAL_VAR_WRAPPER[var_name]) ? GLOBAL_VAR_WRAPPER[var_name] : undefined;
		}
	}
    return result; 
}

function setGlobalVar(var_name,var_value){
    GLOBAL_VAR_WRAPPER[var_name] = var_value;
}

function createGlobalFunction(function_name,function_body){
	window[function_name] = function_body;
}
/*
*	fonctions permettant de récupérer les informations du referer (serveur référent ou hôte)
*/
	setGlobalVar('windowRefererMapping',{
		'root':window.location,
		'parts':{
			'hostname':{
				'alias':['domain']
			},
			'host':{
				'alias':['fullhost']
			},
			'protocol':{
				'alias':[]
			},
			'port':{
				'alias':[]
			},
			'pathname':{
				'alias':['path']
			},
			'origin':{
				'alias':[]
			},
		},
		'partsGetterNameBody':'getLocal'
	});
	/*
	*	création des getter raccourcis pour les parties des données du referer
	*/
	/*(function(){
		var parts = getWindowRefererParts();
		for(var part_name in parts){
			part_data = parts[part_name];
			var partFunctNames = [part_name];
			if(isset(part_data.alias) && !isEmpty(part_data.alias)){
				partFunctNames = partFunctNames.concat(part_data.alias);
			}
			for(var name_key in partFunctNames){
				part_alias_name = partFunctNames[name_key];
				var function_name = getWindowRefererPartsGetterName(part_alias_name);
				var temp_function = (function(){
					var referer_root = getWindowRefererRoot();
					var temp_part_name = part_name;
					console.log('get uri part');
					console.log(temp_part_name);
					var part_data = referer_root[temp_part_name];
					return part_data;
				})
				createGlobalFunction(function_name,temp_function);
				//window[function_name] = function()
			}
		}
	})()*/
	createWindowRefererPartsGetter();
	function createWindowRefererPartsGetter(){
		var parts = getWindowRefererParts();
		for(var part_name in parts){
			part_data = parts[part_name];
			var partFunctNames = [part_name];
			if(isset(part_data.alias) && !isEmpty(part_data.alias)){
				partFunctNames = partFunctNames.concat(part_data.alias);
			}
			for(var name_key in partFunctNames){
				var part_alias_name = partFunctNames[name_key];
				createWindowRefererPartGetter(part_name,part_alias_name);
			}
		}
	}
	function createWindowRefererPartGetter(part_name,part_alias_name){
		var function_name = getWindowRefererPartsGetterName(part_alias_name);
		var temp_function = (function(){
			var referer_root = getWindowRefererRoot();
			var temp_part_name = part_name;
			var part_data = referer_root[temp_part_name];
			return part_data;
		})
		createGlobalFunction(function_name,temp_function);
	}
	function getWindowRefererMapping(){
		return getGlobalVar('windowRefererMapping');
	}
	function getWindowRefererRoot(){
		return getWindowRefererMapping()['root'];
	}
	function getWindowRefererParts(){
		return getWindowRefererMapping()['parts'];
	}
	function getWindowRefererPartsGetterBody(){
		return getWindowRefererMapping()['partsGetterNameBody'];
	}
	function getWindowRefererPartsGetterName(partName){
		var partsGetterNameBody = getWindowRefererPartsGetterBody();
		var function_name = partsGetterNameBody+''+capitalizeFirstLetter(partName.toLowerCase());
		return function_name;
	}
	function getLocalRefererData(partName){
		var referer_data = {};
		if(isset(partName)){
			var function_name = getWindowRefererPartsGetterName(partName);
			referer_data = function_name();
		}else{
			parts = getWindowRefererParts();
			referer_root = getWindowRefererRoot(); 
			for(var part_name in parts){
				part_value = referer_root[part_name];
				part_data = parts[part_name];
				var partNames = [part_name];
				if(isset(part_data.alias) && !isEmpty(part_data.alias)){
					partNames = partNames.concat(part_data.alias);
				}
				for(var partNameKey in partNames){
					var part_alias_name = partNames[partNameKey];
					referer_data[part_alias_name] = part_value;
				}
			}
		}
		return referer_data;
	}
/*
*	fonctions de création d'éléments html
*/ 
	function createElement(tag,inner,attr,extra,options){
		var to_prop = ['checked','multiple'];
		var tag_pattern = /^<.*>$/;
		var tag = tag_pattern.test(tag) ? tag :  '<'+tag+'></'+tag+'>';
		var element = $(tag);
	        if(!isEmpty(options)){
	            if(isset(options.innerConstraints)){
	                var constraints = options.innerConstraints;
	                for(var cons_key in constraints){
	                    var cons_value = constraints[cons_key];
	                    switch(cons_key){
	                        case 'isNotNull':
	                            inner = inner != null ? cons_value : inner;
	                            break;
	                        case 'isNull':
	                            inner = inner == null ? cons_value : inner;
	                            break;
	                    }
	                }
	            }
	        }
		$(element).html(inner);
		for(var attr_name in attr){
			var attr_value = attr[attr_name];
			if($.inArray(attr_name,to_prop)!=-1){
	                    $(element).prop(attr_name,attr_value);
			}else{
	                    $(element).attr(attr_name,attr_value);
			}
	                if(attr_name=="value"){
	                    $(element).val(attr_value);
	                }
	                if(attr_name=="style" && isEnumerable(attr_value)){
                            $.each(attr_value, function (k, v){
                                $(element).css(k,v); 
                            });
	                    
	                }
		}
		if(extra!=undefined){
			for(var extra_attr_name in extra){
				var extra_attr_value = extra[extra_attr_name];
				$(element).attr('data-'+extra_attr_name,extra_attr_value);
			}
		}
	        if(!isEmpty(options)){
	            if(isset(options.returnFormat)){
	                switch(options.returnFormat){
	                    case 'html':
	                        element = $(element).get(0);
	                        break;
	                    case 'text':
	                        for(var i in to_prop){
	                            var prop_name = to_prop[i];
	                            if($(element).prop(prop_name)==true){
	                                $(element).attr(prop_name,prop_name);
	                            }
	                        }
	                        element = $(element).prop('outerHTML');
	                        break;
	                    case 'jquery':
	                    default:
	                        element = $(element);
	                        break;
	                }
	            }
	        }
		return element;
	}
	function createElements(elements_params){
		var elements = [];
		for(var index in elements_params){
			var element_params = elements_params[index];
			var tag = element_params['tag'];
			var inner = element_params['inner'];
			var attr = element_params['attr'];
			var extra = element_params['extra'];
	                var options = element_params['options'];
			var element = createElement(tag,inner,attr,extra,options);
			elements.push(element);
		}
		return elements;
	}
	function createButton(text,attr,extra,options){
		attr.type = !isEmpty(attr.type) ? attr.type : "button";
		var button = createElement('<button></button>',text,attr,extra,options);
		return button;
	}
/*
* fonction de création d'input
*/
	function createInput(attr,extra,options){
		attr['type'] = attr['type']!=undefined ? attr['type'] : 'text';
		var input = undefined;
		if(attr['name']!=undefined){
			input = createElement('<input/>','',attr,extra,options);
		}
		return input;
	}
	function createInputHidden(attr,extra,options){
		attr['type'] = 'hidden';
		return createInput(attr,extra,options);
	}
	function createInputText(attr,extra,options){
		attr['type'] = 'text';
		return createInput(attr,extra,options);
	}
	function createInputDate(attr,extra,options){
		attr['type'] = 'date';
		return createInput(attr,extra,options);
	}
	function createInputNumber(attr,extra,options){
		attr['type'] = 'number';
		return createInput(attr,extra,options);
	}
	function createCheckbox(attr,extra,options){
		attr['type'] = 'checkbox';
		attr['checked'] = attr['checked']==1 || attr['checked']=='checked' ? true : false;
		return createInput(attr,extra,options);
	}
	function createSelect(attr,extra,options){
		return createElement('select','',attr,extra,options);
	}
/*
*	fonction autour de la création de formulaire
*/
	function createForm(attr,data,extra,options){
		var form = createElement('form','',attr,extra,options);
		for(inputs_group_key in data){
			var input_attr = {
				'name':inputs_group_key
			};
			var inputs_group = data[inputs_group_key];
			var inputs_stack = [];
			if(isEnumerable(inputs_group)){
				input_attr.name += '[]';
				for(input_key in inputs_group){
					input_value = inputs_group[input_key];
					input_attr.value = input_value;
					inputs_stack.push(createInputText(input_attr));
				}
			}else{
				input_value = inputs_group;
				input_attr.value = input_value;
				inputs_stack.push(createInputText(input_attr));
			}
			$(form).append(inputs_stack);
		}
		return form;
	}
	function createFormToAjax(action,method,data,attr,extra,options){
		attr = isObject(attr) ? $attr : {};
		attr.action = action;
		attr.method = method;
		attr.class = isEmpty(attr.class) ? 'hidden' : attr.class+" hidden";
		var form = createForm(attr,data,extra,options);
		$('body').append(form);
		return form;
	}
	$(document).ready(function(){

		$(document).on('click','.field_prototype_add_btn',addPrototypeBtnClicked);
		$(document).on('click','.field_a_prototype_remove_btn',removeSelfPrototype);
	})
	function addPrototypeBtnClicked(event){
		var target_field_id = $(this).attr('data-prototype-target');
		addFromPrototype($(target_field_id));
	}
	function addFromPrototype(form_field){
		var proto_html = $(form_field).attr('data-prototype');
		var current_nb = $(form_field).children('.form-group').length;
		var temp_key = 0;
		var key_ok = false;
		var i = 0;
		while(temp_key < current_nb && i < current_nb && !key_ok){
			$(form_field).children('.form-group').each(function(key, values){
				var temp_key_to_check = $(values).attr('data-key');
				if(temp_key_to_check==temp_key){
					key_ok = false;
					return false;
				}else{
					key_ok = true;
				} 
			});
			i++;
			if(!key_ok){
				temp_key++;
			}
		}
		var next_index = current_nb>=0 ? temp_key : 0;
		var element_html = proto_html.replace(/__name__/g,next_index);
		$(form_field).append(element_html);
	}
	function removeSelfPrototype(event){
		var form_group = $(this).parents('.form-group:first');
		$(form_group).remove();
	}
	function initInputWithProto(){
		$('div[data-prototype]').each(function(k_g,v_g){
			$(v_g).children('.form-group').each(function(k_i,v_i){
				$(this).attr('data-key',k_i);
			})
		})
	}

	function saveInputCurrentData(input){
		 $(input).data('old_val',$(input).val());
	}
	function getSavedInputData(input){
		return $(input).data('old_val');
	}
	$(document).on('focus','input',function(event){
        saveInputCurrentData($(this));
    });
/*
*	fonction de manipulation des éléments html
*/
	function addAttributeToElement(element,attributes){
		for(var attr_name in attributes){
			var attr_value = attributes[attr_name];
			switch(attr_name){
				case 'class':
					$(element).addClass(attr_value);
					break;
				default:
					$(element).attr(attr_name,attr_value);
					break;
			}
		}
	}
	function selectOneOnSelect(select_elmt,to_find,options){
		var options = isObject(options) ? options : {};
		var unselect_if_uncheck = isset(options.unselect) ? options.unselect : true;
		$(select_elmt).find('option').each(function(k,v){
			if($(v).val()==to_find){
				$(v).prop('selected',true);
			}else if(unselect_if_uncheck){
				$(v).prop('selected',false);
			}
		});
	}
/*
*	fonctions autour de bootstrapToggle
*/
	function initBoostrapToggle(element,options){
		options = options!=undefined ? options : {
			'on' : 'Oui',
	        'off' : 'Non',
	        'size' : 'small',
		}
		$(element).bootstrapToggle(options);
		return element;
	}
	function initBlurEvent(inputs, table){
	        inputs.each(function(){
	            $(this).blur(function(){
	                var cell_node = $(this).parent('td:first');
	                var value = $(this).val();
	                table.cell(cell_node).data(value);
	            });
	        });
	}

	function btToggleInput(input){
		$(input).bootstrapToggle('toggle');
		return input;
	}
/**
*	fonctions autour de modal bootstrap
*/

	/*
	*	fonction d'ouverture d'une modal
	*	@param HtmlElement, JqueryElement, JquerySelector la modal ou le selecteur de la modal
	*	@return JqueryElement, la modal si trouvée  sinon
	*/
	function openBtpModal(modal){
		modal = $(modal);
		if(isInDom(modal)){
			$('body').append(modal);
		}
		if(modal.length>0){
			$(modal).modal('show');
		}else{
			modal = undefined;
		}
		return modal;
	}
	/*
	*	fonction de fermeture d'une modal
	*	@param HtmlElement, JqueryElement, JquerySelector la modal ou le selecteur de la modal
	*	@return JqueryElement, la modal si trouvé fals sinon
	*/
	function closeBtpModal(modal){
		modal = $(modal);
		if(modal.length>0){
			$(modal).modal('hide');
			var modal_backdrop = $(modal).siblings('.modal-backdrop');
			if($(modal_backdrop).is('.in')){
				$(modal_backdrop).hide();
				$(document.body).css('overflow','auto');
			}
		}else{
			modal = undefined;
		}
		return modal;
	}
	/*
	* fonction de création d'une modal
	*/
	function createBtpModal(id,title,msg,options){
		id = !isEmpty(id) ? id : undefined;
		var modal = $('#'+id);
                if(options !== undefined){
                    if(options.replace == true){
                        $(modal).remove();
                        modal = $();
                    }
                }
                
		if($(modal).length==0){
			modal = createElement('div','',{'class':'modal fade','tabindex':'-1','role':'dialog','id':id});
			var modal_dialog = createElement('div','',{'class':'modal-dialog','role':'document'});
			var modal_content = createElement('div','',{'class':'modal-content'});
			var header = createElement('div','',{'class':'modal-header'});
			var title_elmt = createElement('h5',title,{'class':'modal-title'});
			var h_close = createButton('&times',{'class':'close','aria-label':'Close'},{'dismiss':'modal'});
			var body = createElement('div',msg,{'class':'modal-body'});
			var footer = createElement('div','',{class:'modal-footer'});
            if(!isEmpty(options)){
                if(!isEmpty(options.noClose)){
                    for(var btn_key in options.noClose){
                        var btn_option = options.noClose[btn_key];
                        if(btn_option.btn == false){
                            h_close = "";
                        }
                    }
                }
            }
			$(header).append(h_close,title_elmt);
			$(modal_content).append(header,body,footer);
			$(modal_dialog).append(modal_content);
			$(modal).append(modal_dialog);
			$('body').append(modal);
			if(!isEmpty(options)){
				if(!isEmpty(options.buttons)){
					for(var btn_key in options.buttons){
						var btn_params = options.buttons[btn_key];
						var btn = createButton(btn_params.lbl,btn_params.attr,btn_params.extra,btn_params.options);
						$(footer).append(btn);
						if(isset(btn_params.callbacks)){
							for(var event_key in btn_params.callbacks){
								var btn_callbacks  = isArray(btn_params.callbacks[event_key]) ? btn_params.callbacks[event_key]  : [btn_params.callbacks[event_key]];
								for(call_key in btn_callbacks){
									var callback = btn_callbacks[call_key];
									if(isCallable(callback)){
										$(btn).on(event_key,callback);
									}
								}
							}
						}
					}
				}
			}
		}
		return modal;
	}
	function destroyModal(modal){
		modal = $(modal);
		$(modal).remove();
	}
	/*
	*	fonction de création d'une modal de confirmation
	*/
	function createConfirmModal(id,title,msg,callbacks,options){
		var confirm_callback;
		var cancel_callback;
		if(!isset(title)){
			title = 'Confirmation';
		}
		if(!isset(msg)){
			msg = 'Confirmez-vous votre action ?';
		}
		if(isCallable(callbacks)){
			confirm_callback = callbacks;
		}else if(isArray(callbacks) && !isEmpty(callbacks)){
			confirm_callback = isset(callbacks[0]) ? callbacks[0] : undefined;
			cancel_callback = isset(callbacks[1]) ? callbacks[1] : undefined;
		}else if(idObject(callbacks) && !isEmpty(callbacks)){
			confirm_callback = isset(callbacks['confirm']) ? callbacks['confirm'] : undefined;
			cancel_callback = isset(callbacks['cancel']) ? callbacks['cancel'] : undefined;
		}
		var modal_options = {
			buttons:[
				{
					lbl:'annuler',
					attr:{class:'btn btn-danger','aria-label':'Close'},
					extra:{'dismiss':'modal'},
					callbacks:{
						click:cancel_callback
					}
				},{
					lbl:'confirmer',
					attr:{class:'btn btn-primary'},
					callbacks:{
						click:confirm_callback
					}
				}
			]
		};
		modal_options = mergePlainObject(modal_options, options);
		var modal = createBtpModal(id,title,msg,modal_options);
		return modal;
	}
/*
*	fonctions autour de dataTable
*/
	function dtcreateElement(tag,inner,attr,extra,options){
	        options = isset(options) ? options : {};
	        options.returnFormat = "text";
		var input = createElement(tag,inner,attr,extra,options);
	    return input;//$(input).prop('outerHTML');
	}
	function dtcreateCheckbox(attr,extra,options){
	        options = isset(options) ? options : {};
	        options.returnFormat = "text";
		var input = createCheckbox(attr,{toggle:'toggle'},options);
	    return input;//$(input).prop('outerHTML');
	}
	function dtcreateButton(inner,attr,extra,options){
	        options = isset(options) ? options : {};
	        options.returnFormat = "text";
		var input = createButton(inner,attr,extra,options);
	    return input;//$(input).prop('outerHTML');
	}
	function dtInitBootstrapOnCreatedCell(td,cellData,rowData, row_i, col_i){
		var input = $(td).find('input[type="checkbox"]');
	    initBoostrapToggle(input);
	    return input;
	}
	function dtInitBootstrapOnCreatedRow(row, data, dataIndex){
		var input = $(row).find('input[type="checkbox"].to-bt');
	    initBoostrapToggle(input);
	    return input;
	}
	function dtCheckboxToggle(input,table,options){
	    var checked = $(input).prop('checked');
	    var cell = $(input).parents('td:first');
	    var cell_data = checked ? 1 : 0;
	    var draw =  options!=undefined && options['draw']==false ? false : true;
	    var rePaging = options!=undefined && options['rePaging']==true ? true : false;
	    table.cell(cell).data(cell_data);
	    //$(input).bootstrapToggle('toggle');
	    if(draw){
	    	table.draw(rePaging);
	    }
	}
	function dtSelectAllVertical(btn_all,table,option){
		var coll_visi_index =  $(btn_all).parents('th:first').prop('cellIndex');
		var coll_index = table.column.index( 'fromVisible', coll_visi_index );
		var select_cells = table.cells(undefined,coll_index,{ 'search': 'applied' });
		var by_node = isset(option) && isset(option['by_node']) ? option['by_node']==true : false;
		if($(btn_all).hasClass('all')){
	        $(btn_all).removeClass('all').addClass('btn-primary').html('Tous');
	        select_cells.every(function(row_index,col_index,tab_loop_count,cell_loop_count){
	            if(by_node){
	            	$(this.node()).find('input').prop('checked',true).trigger('change');
	            }else{
	            	this.data(1);
	            }
	        });
	    }else{
	        $(btn_all).addClass('all').removeClass('btn-primary').html('Aucun');
	        select_cells.every(function(row_index,col_index,tab_loop_count,cell_loop_count){
	            if(by_node){
	            	$(this.node()).find('input').prop('checked',false).trigger('change');
	            }else{
	            	this.data(0);
	            }
	        });
	    }
	    table.draw(false);
	//    dtAdjustTable(table);
	}
	function dtSelectAllHorizontal(btn_all,table){
		var row_index =  table.row($(btn_all).parents('tr:first')).index();
	        var coll_visi_index =  $(btn_all).parents('td:first').prop('cellIndex');
	        var coll_index = table.column.index( 'fromVisible', coll_visi_index );
		var col_indexes = [];
		var nb_visi_coll = dtGetNbHeaderVisi(table);
		for(var visi_i = coll_visi_index;visi_i<nb_visi_coll;visi_i++){
			var col_index = table.column.index( 'fromVisible', visi_i );
			col_indexes.push(col_index);
		}
		var select_cells = table.cells(row_index,col_indexes,{ 'search': 'applied' });
		if($(btn_all).hasClass('all')){
	        $(btn_all).removeClass('all').addClass('btn-primary').html('Tous');
	        select_cells.every(function(row_index,col_index,tab_loop_count,cell_loop_count){
	            if($(this.node()).find('input[type="checkbox"]').length>0){
	            	this.data(1);
	            }
	            
	        });
	    }else{
	        $(btn_all).addClass('all').removeClass('btn-primary').html('Aucun');
	        select_cells.every(function(row_index,col_index,tab_loop_count,cell_loop_count){
	        	if($(this.node()).find('input[type="checkbox"]').length>0){
	            	this.data(0);
	            }
	        });
	    }
	    table.draw(false);
	//    dtAdjustTable(table);
	}
	function dtGetRowsBySelectedColl(table,coll_selector,data_selector){
		var result = [];
		var rows = table.rows({ 'search': 'applied' });
		rows.every(function(){
			var data = this.data();
	        if(this.data()[coll_selector]==1){
	        	if(data_selector==undefined){
	        		result.push(this.data());
	        	}else if(Array.isArray(data_selector)){
	        		var inter_result = {};
	        		for(var d_s in data_selector){
	        			inter_result[d_s]=this.data()[d_s];
	        		}
	        		result.push(inter_result);
	        	}else{
	        		result.push(this.data()[data_selector]);
	        	}
	        }
	        
	    });
	    return result;
	}
	function dtGetAllData(table,data_selector){
		var data = undefined;
		if(data_selector!=undefined){
			tab_data = table.rows().data();
			data=[];
			for(d_index in tab_data){
				data.push(tab_data[d_index][data_selector]);
			}
		}else{
			data = table.data();
		}
		return data;
	}
	function dtReturnZero(){
		return 0;
	}
	function dtGetNbHeaderVisi(table){
		var headers = table.table().header();
		var nb_header = $(headers).find('th').length;
		return nb_header;
	}
	function dtAjustHeader(table){
		if(table.fixedHeader != undefined){
			table.fixedHeader.adjust();
		}
	}
	function dtAdjustColumn(table){
		table.columns.adjust();
	}
	function dtAdjustTable(table){
		dtAdjustColumn(table);
		dtAjustHeader(table);
	}
	function dtHideShowColumn(table,to_show,to_hide){
		table.columns(to_hide).visible(false,false);
		table.columns(to_show).visible(true);
	        table.draw(false);
	}
	function dtMakeFullWidth(table){
		$(table).css('width','100%');
	}
/*
*	fonction autour du Datepicker Jquery UI
*/
	function jqDatepSetDate(datepicker, date){
		$(datepicker).datepicker('setDate', date);
	}
	function jqDatepReset(datepicker){
		jqDatepSetDate(datepicker,null);
	}
/*
*	fonction autour du Datepicker Bootstrap
*/
	function btDatepUpdateDate(datepicker, date){
		$(datepicker).datepicker('update', date);
	}
	function btDatepReset(datepicker){
		btDatepUpdateDate(datepicker,null);
	}
	function btDatepSetStartDate(datepicker,date){
		$(datepicker).datepicker('setStartDate',date);
	}
	function btDatepSetEndDate(datepicker,date){
		$(datepicker).datepicker('setEndDate',date);
	}

/*
*	fonctions de transformation de données
*/
	function boolToString(bool,if_true,if_false,else_val){
		var str_result = else_val;
		if(bool!=undefined){
            if(bool == 1 || bool === true){
               
                str_result = if_true;
            }else if(bool == 0 || bool === false ){
          	str_result = if_false;
            }
		}
		return str_result;
	}
	function boolToYesNoNa(bool){
		return boolToString(bool,'Oui','Non','Non renseigné');
	}
	function dataSwap(data,swapping_board){
		var d_return = undefined;
		for(swap_key in swapping_board){
			if(swap_key==data){
				d_return = swapping_board[swap_key];
				break;
			}
		}
		return d_return;
	}
	$(document).ready(function(){
		dateFormat.masks.isoShort = "yyyy-mm-dd";
		dateFormat.masks.short = 'dd/mm/yyyy';
	});
	
	function bsDateFormat(date,format_out,params){
		var date_obj = date instanceof  Date ? date : new Date(date);
		var date_out = '';
		var format_mask = '';
		switch(format_out){
			case 'full':
			case 'fullDate':
				format_mask = 'fullDate';
				break;
			case 'long':
			case 'longDate':
				format_mask = 'longDate';
			case 'medium':
			case 'mediumDate':
				format_mask = 'mediumDate';
				break;
			case 'short':
				format_mask = 'short';//'dd/mm/yyyy';
				break;
			case 'shortDate':
				format_mask = 'shortDate';
				break;
			case 'iso':
			case 'isoDate':
				format_mask = 'isoDate';
			case 'isoShort':
				format_mask = 'isoShort';
			default:
				format_mask = format_out;
				break;
		}
		date_out = date_obj.format(format_mask);
		return date_out;
	}
	function parseFloatNumber(number,nb_decimal){
		var parsed = number
		if(typeof number == 'string'){
			parsed = parsed.replace(',','.')
		}
		if(isset(nb_decimal) && nb_decimal!==false){
			parsed = parsed.toFixed(nb_decimal);
		}
		parsed = parseFloat(parsed);
		return parsed;
	}
	function mergePlainObject(obj, src) {
	    for (var key in src) {
	        if (src.hasOwnProperty(key)) obj[key] = src[key];
	    }
	    return obj;
	}
	function cloneObject(obj,deep){
		deep = isset(deep) ? deep : true;
		var clone;
		if(deep){
			clone = $.extend(true,{},obj);
		}else{
			clone = $.extend({},obj);
		} 
		return clone;
	}
	function capitalizeFirstLetter(string) {
	    return string.charAt(0).toUpperCase() + string.slice(1);
	}
/*
*	fonction liées aux colonnes à cacher/montrer
*/

/*
*	fonctions liées aux filtre et leurs applications
*/
	var default_filtre_element_ids = {
		filtres:'parametrageEnquete_filtres',
		conditions:'parametrageEnquete_conditions',
		parametres:'parametres',
		liste_filtres:'liste-filtres',
		add_filtre_btn:'add-filtre',
		apply_filtre_btn:'appl-filtre',
	}
	function setDefaultFiltreIds(filtre_element_ids){
		default_filtre_element_ids = filtre_element_ids!=undefined && filtre_element_ids!=false ?  {
			filtres : filtre_element_ids.filtres!=undefined ? filtre_element_ids.filtres : default_filtre_element_ids.filtres,
			conditions : filtre_element_ids.conditions!=undefined ? filtre_element_ids.conditions : default_filtre_element_ids.filtres.conditions,
			parametres  :filtre_element_ids.parametres!=undefined ? filtre_element_ids.parametres : default_filtre_element_ids.filtres.parametres,
		} : default_filtre_element_ids;
		return default_filtre_element_ids;
	}
	function getFiltreIds(filtre_element_ids){
		filtre_element_ids = filtre_element_ids!=undefined && filtre_element_ids!=false ?  {
			filtres : filtre_element_ids.filtres!=undefined ? filtre_element_ids.filtres : default_filtre_element_ids.filtres,
			conditions : filtre_element_ids.conditions!=undefined ? filtre_element_ids.conditions : default_filtre_element_ids.filtres.conditions,
			parametres  :filtre_element_ids.parametres!=undefined ? filtre_element_ids.parametres : default_filtre_element_ids.filtres.parametres,
		} : default_filtre_element_ids;
		return filtre_element_ids;
	}
	function getFiltreElement(filtre_element_name,filtre_element_ids){
		var filtre_element = false;
		if(filtre_element_name!=undefined){
			if(isset(filtre_element_ids) && isset(filtre_element_ids[filtre_element_name])){
				filtre_element = $('#'+filtre_element_ids[filtre_element_name])
			}else if(isset(default_filtre_element_ids[filtre_element_name])){
				filtre_element = $('#'+default_filtre_element_ids[filtre_element_name])
			}
		}
		return filtre_element;
	}
	function initFiltres(filtre_element_ids,callbacks){
		filtre_element_ids = setDefaultFiltreIds(filtre_element_ids);
		var filtre_elmt=getFiltreElement('filtres',filtre_element_ids);//$('#'+filtre_element_ids.filtres);
		var add_filtre_btn=getFiltreElement('add_filtre_btn',filtre_element_ids);//$('#'+filtre_element_ids.add_filtre_btn);
		var filtre_list_elmt=getFiltreElement('liste_filtres');
		var before_callback, on_function, after_callback;
		/*
		*	on filtres change
		*/
		$(filtre_elmt).on('change',function(event){
			before_callback = isset(callbacks) && isCallable(callbacks.early_filtre_change) ? callbacks.early_filtre_change : undefined;
			after_callback = isset(callbacks) && isCallable(callbacks.tardy_filtre_change) ? callbacks.tardy_filtre_change : undefined;
			OnFiltreFiltresChange(false,before_callback,after_callback);
		});
		/*
		*	on add filtre
		*/
		$(add_filtre_btn).on('click',function(event){
			on_function = isset(callbacks) && isCallable(callbacks.on_add_filtre) ? callbacks.on_add_filtre : undefined;
			after_callback = isset(callbacks) && isCallable(callbacks.tardy_add_filtre) ? callbacks.tardy_add_filtre : undefined;
			OnAddFiltre(false,on_function,after_callback);
		});
		/*
		*	on remove filtre
		*/
		$(filtre_list_elmt).on('click','.suppr',function(event){
			after_callback = isset(callbacks) && isCallable(callbacks.tardy_remove_filtre) ? callbacks.tardy_remove_filtre : undefined;
			onRemoveFiltre(this,false,after_callback);
		})
	}
	function OnFiltreFiltresChange(filtre_element_ids,before_callback,after_callback) {
            var filtre_element_ids = getFiltreIds(filtre_element_ids);

	    var filtre_elmt=$('#'+filtre_element_ids.filtres);
	    var condi_elmt=$('#'+filtre_element_ids.conditions);
	    var param_elmt=$('#'+filtre_element_ids.parametres);
	    var type = undefined;
	    if(isCallable(before_callback)){
	    	type = before_callback([filtre_elmt,condi_elmt,param_elmt]);
	    }else{
			$(param_elmt).css('visibility', 'hidden');
		    var typeFiltre = $(filtre_elmt).val();
		    var typeTmp = typeFiltre.split('-');
		    var type = typeTmp[0];
		    $(param_elmt).find('option').remove();
	    }
	    $.ajax({
	        url: Routing.generate('enquete_get_option_select'),
	        data: {type: type},
	        type: 'POST',
	        success: function (response) {
	            var arr = JSON.parse(response);
	            var container = $(param_elmt).parent();
	            var container_condition = $('#conditions');
	            if(isCallable(after_callback)){
	            	after_callback(arr,[filtre_elmt,condi_elmt,param_elmt]);
	            }
	            else{
	            	if ('text' == arr[0]['type']) {
		                $(param_elmt).remove();
		                param_elmt = createInputText({name:"parametres",id:filtre_element_ids.parametres,class:"form-control"});
						//condi_elmt = createSelect({name:"conditions",id:filtre_element_ids.parametres,class:"form-control",size:5,multiple:false});
                        $.each(arr[1], function (k, v) {
                            container_condition.append('<option value="' + v + '">' + k + '</option>');
                        });
		                container.append(param_elmt);
		               
		            } else {
		                $(param_elmt).remove();
		                param_elmt = createSelect({name:"parametres",id:filtre_element_ids.parametres,class:"form-control",size:5,multiple:false})
		                container.append(param_elmt);
                                $('#parametres').html('');
		                $.each(arr[0], function (k, v) {
                                    if(isObject(v)){
                                        $('#parametres').append('<option value="' + v.departement.idDepa + '">' + v.departement.libelle + '</option>');
                                    }else if('type' != k ) {
                                        $('#parametres').append('<option value="' + v + '">' + v + '</option>');
                                    }
		                });
		            }
                            container_condition.html('');
                            $.each(arr[1], function (k, v) {
                                container_condition.append('<option value="' + v + '">' + k + '</option>');
                            });
	            }
	            if(!isCallable(before_callback)){
	            	$(param_elmt).css('visibility', 'visible');
	            }
	        }
	    });
	}
	function OnAddFiltre(filtre_element_ids,on_function,after_callback){
		var filtre_element_ids = getFiltreIds(filtre_element_ids);

	    var filtre_elmt=$('#'+filtre_element_ids.filtres);
	    var condi_elmt=$('#conditions');
	    var param_elmt=$('#'+filtre_element_ids.parametres);
	    var liste_elmt=$('#'+filtre_element_ids.liste_filtres);
	    var apply_filtre_btn=$('#'+filtre_element_ids.apply_filtre_btn);

	    var filtre = $(filtre_elmt).find('option:selected').text();
	    var filtreVal = $(filtre_elmt).val();
	    var condition = $(condi_elmt).find('option:selected').text();
	    var condiVal = $(condi_elmt).val();
	    var parametre_text = $(param_elmt).find('option:selected').text();
            if(parametre_text == 'undefined' || parametre_text == null || parametre_text == ''){
                parametre_text = $('#parametres').val();
            }
	    var parametre_id = $(param_elmt).val();

		if(isCallable(on_function)){
			var ok = on_function([filtre_elmt,condi_elmt,param_elmt],[filtreVal,condiVal,parametre_id]);
			if(isCallable(after_callback)){
		    	after_callback(ok,[filtre_elmt,condi_elmt,param_elmt],[filtreVal,condiVal,parametre_id]);
		    }
		}else{
			$('.alert.alert-danger.display-none').hide();
	        $('.alert.alert-danger.display-none').find('p').html('');
	        if(filtreVal != undefined && condiVal != undefined && parametre_text != undefined && parametre_text != null && parametre_text != ''){
	            var row_elmt = $('<span class="filtre" ></span>');
	            var col_ico_elmt = $('<span class="suppr"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span>');
	            var col_filter_text_elmt = $('<span>' + filtre + ' ' + condition + ' ' + parametre_text + '</span>');
	            var col_value = $('<span class="filtre_applied"><input type="hidden" name="filtre" value="' + filtreVal + '"><input type="hidden" name="condition" value="' + condiVal + '"><input type="hidden" name="parametre" value="' + parametre_id + '"></span>');
                     $(row_elmt).css({"border-color": getRandomColor(), "border-width":"1px", "border-style":"solid", "margin":"2px","padding": "2px","border-radius": "5px", "display": "inline-block"});
	            $(row_elmt).append(col_ico_elmt,col_filter_text_elmt,col_value);
	            $(liste_elmt).children('table').append(row_elmt);
	            $(apply_filtre_btn).attr('disabled',false);
	            $(filtre_elmt).val('');
	            $(filtre_elmt).val('');
	            $(filtre_elmt).val('');
	            if(isCallable(after_callback)){
	            	after_callback(true,[filtre_elmt,condi_elmt,param_elmt],[filtreVal,condiVal,parametre_id]);
	            }
	        }else{
	        	if(isCallable(after_callback)){
	        		after_callback(false,[filtre_elmt,condi_elmt,param_elmt],[filtreVal,condiVal,parametre_id]);
	        	}else{
		            $('.alert.alert-danger.display-none').find('p').html('Toutes les conditions ne sont pas remplies, veuillez vérifier.');
		            $('.alert.alert-danger.display-none').show();
		        }
	        }
	    }
	}
	function onRemoveFiltre(btn_remove_row,filtre_element_ids,after_callback){
		$(btn_remove_row).parents('span:first').remove();
		if(isCallable(after_callback)){
			after_callback();
		}
	}
	function getFiltreApplied(){
		var filtres = [];
		var filtre_list = getFiltreElement('liste_filtres');
		$(filtre_list).find('.filtre_applied').each(function(){
	        filtres.push({
	            condition:$(this).find('input[name="condition"]').val(),
	            parametre:$(this).find('input[name="parametre"]').val(),
	            filtre:$(this).find('input[name="filtre"]').val()
	        });
	    });
	    return filtres;
	}
/*
*	fonctions de test
*/
	function isCallable(variable){
		return variable!=undefined && typeof variable === 'function';
	}
	function isset(variable){
		return variable!=undefined;
	}
	/*
	* vérifie si la variable est définie, une chaine vide, null ou vide si tableau|object
	*/
	function isEmpty(variable){
		return variable === undefined || variable === '' || variable === null || (isEnumerable(variable) && variable.length==0);
	}
	function isArray(variable){
		return variable !=undefined && Array.isArray(variable);
	}
	function isEnumerable(variable){
		return variable !=undefined && variable !== null && (Array.isArray(variable) || typeof variable === 'object');
	}
	function isObject(variable){
		return variable !=undefined && variable !== null && typeof variable === 'object';
	}
	function isPlainObject(variable) {
	  return variable !=undefined && typeof variable == 'object' && variable.constructor == Object;
	}
	function isValueIn(value_to_seek,seek_in){
		var value_is_in = false;
		if(isEnumerable(seek_in)){
			for(key in seek_in){
				value_is_in = seek_in[key] == value_to_seek;
				if(value_is_in){
					break;
				}
			}
		}
		return value_is_in;
	}
	function isKeyIn(key_to_seek,seek_in){
		var key_is_in = false;
		if(isEnumerable(seek_in)){
			for(key in seek_in){
				key_is_in = key == key_to_seek;
				if(key_is_in){
					break;
				}
			}
		}
		return key_is_in;
	}
	function isInDom(element){
		/*
		*	credit : SLaks (https://stackoverflow.com/users/34397/slaks)
		*	url : https://stackoverflow.com/a/3086084/10219450
		*	benchmark : https://jsperf.com/jquery-element-in-dom/
		*/
		return $.contains(document.documentElement, element[0]);
	}
	function isElement(element) {
		/*
		*	credit : Monarch Wadia (https://stackoverflow.com/users/1204556/monarch-wadia)
		*	url : https://stackoverflow.com/questions/384286/javascript-isdom-how-do-you-check-if-a-javascript-object-is-a-dom-object
		*/
		return element instanceof Element || element instanceof HTMLDocument || element instanceof jQuery;
	}
/*
*	fonction de traduction
*/
	function sfTrans(trans_key,default_value,params,domain){
		var msg = isset(default_value) ? default_value : trans_key;
		params = isset(params) ? params : {};
                domain = isset(domain) ? domain : undefined; 
                if(Translator != undefined){
			var temp_msg = Translator.trans(trans_key,params,domain);
			msg = !isEmpty(temp_msg) ? temp_msg : msg;
		}
		return msg;
	}

	languageDataTable = {
	    processing: "Traitement en cours...",
	    search: "Rechercher&nbsp;:",
	    lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
	    info: "Affichage collectivit&eacute; _START_ &agrave; _END_ sur _TOTAL_ collectivit&eacute;s",
	    infoEmpty: "Affichage collectivit&eacute; 0 &agrave; 0 sur 0 collectivit&eacute;s",
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

	setGlobalVar('languageDataTableBase',languageDataTable);

	function getLanguagaDataTableBase(lang_override){
		var lang_dt_base = getGlobalVar('languageDataTableBase');
		var lang_dt = cloneObject(lang_dt_base);
		if(isset(lang_override)){
			lang_dt = mergePlainObject(lang_dt,lang_override);
		}
		return lang_dt;
	}

/*
*	fonction autour du spinner
*/
	function addSpinner(element,msg,prepend,options){
		var spinner = $('<h4 class="helper_spinner" style=\'text-align:center\'><i class="fa fa-spinner fa-spin" aria-hidden="true"></i>'+msg+'</h4>');
		if(isset(options)){
			if(isset(options.empty) && options.empty===true){
				$(element).children().remove();
			}
		}
		if(prepend!=undefined && prepend===true){
			$(element).prepend(spinner);
		}else{
			$(element).append(spinner)
		}
		return spinner;
	}
	function removeSpinner(element,options){
		$(element).find('.helper_spinner').remove();
		if(isset(options)){
			if(isset(options.replaceBy)){
				$(element).html(options.replaceBy);
			}
		}
	}
	function removeASpinner(spinner_element){
		$(spinner_element).remove();
	}
/*
*	fonction d'affichage des messages cotes js
*/
	setGlobalVar('id_flash_message_container','flash_message_container');//var id_flash_message_container = 'flash_message_wrapper'
	setGlobalVar('flash_message_wrapper_default_class',{
		error:'alert-danger',
		warning:'alert-warning',
		notice:'alert-info',
		succes:'alert-success',
		default:'alert-info'
	});
	function getFlashDefaultClassList(flash_type){
		var class_list = getGlobalVar('flash_message_wrapper_default_class');
		class_list = !isset(flash_type) ? class_list : isset(class_list[flash_type]) ? class_list[flash_type] : undefined;
		return class_list
	}
	function getFlashDefaultClass(flash_type){
		var flash_message_wrapper_default_class = getGlobalVar('flash_message_wrapper_default_class');
		if(!isKeyIn(flash_type,flash_message_wrapper_default_class)){
			flash_type = 'default';
		}
		return getFlashDefaultClassList(flash_type);
	}
	/*var flash_message_wrapper_default_class = {
		error:'alert-danger',
		warning:'alert-warning',
		notice:'alert-info',
		succes:'alert-success'
	}*/
	/*
	*	fonction simulant l'affichage flash message dde symfony en javascript
	*
	*	3 syntaxes disponibles :
	*	I - liste de messages par type et filtres
	*		@param messages plainOBject 
	*		ex: {
	*				'error':['msg1','mesaage avec html <ul><li>elemnt 1</li><li>element 2</li></ul>'],
	*				'notice':['msg1','mesaage avec html <ul><li>elemnt 1</li><li>element 2</li></ul>'],
	*			}
	*		@param type_to_print string, array, plainObject, undefined
				filtre les messages à afficher selon le type (error,warning,notice,success)
					sans filtrage si undefined

		II - liste de messages pour un type
			@param Array messages
			ex: ['msg1','mesaage avec html <ul><li>elemnt 1</li><li>element 2</li></ul>']
			@param type_to_print string
				le type à afficher
					à default si undefined  
	*/
	function printFlashMessage(messages,type_to_print){
		var id_flash_container = getGlobalVar('id_flash_message_container');
		var flash_message_wrapper_default_class = getGlobalVar('flash_message_wrapper_default_class');
		var msg_container = $('#'+id_flash_container);
		var msg_to_print = {};
		type_to_print = !isset(type_to_print) ? undefined : isEnumerable(type_to_print)  ? type_to_print : {type_to_print};
		if(!isEmpty(messages)){
			if(isPlainObject($messages)){
				for(var message_type in messages){
					if(!isset(type_to_print) || isValueIn(message_type,type_to_print)){
						msg_to_print[message_type] = messages.message_type;
					}
				}
			}else if(isArray(messages)){
				var type_for = isset(type_to_print) ? type_to_print : 'default';
				msg_to_print[type_for] = messages;
			}else{
				var type_for = isset(type_to_print) ? type_to_print : 'default';
				msg_to_print[type_for] = [messages];
			}
			for(message_type in msg_to_print){
				var msg_alert_class = getFlashDefaultClass(message_type);
				var msg_type_wrapper = createElement('div','',{class:'flash_wrapper_'+message_type});
				for(msg_str_key in msg_to_print[message_type]){
					var msg = messages[message_type][msg_str_key];
					
					var msg_element = createElement('p',msg,{class:'flash_message '+message_type+' '+msg_alert_class});
					$(msg_type_wrapper).append(msg_element);
				}
			}
			$(msg_container).append(msg_type_wrapper);
		}
		return msg_container;
	}
	function emptyFlashMessage(type_to_remove){
		var id_flash_container = getGlobalVar('id_flash_message_container');
		var msg_container = $('#'+id_flash_container);
		if(isset(type_to_remove)){
			$(msg_container).find('.flash_wrapper_'+type_to_remove).remove();
		}else{
			$(msg_container).html('');
		}
		
		return msg_container;
	}
/*
* Fonctions autour des tableaux dynamiques (form collection + prototype)
*/
	function initBtnAddAProtoFormLine(element,post_callback){
		var data = {
			'post_callback':post_callback
		}
		$(element).on('click',null,data,addAProtoFormLine);
	}
	function initBtnsAddAProtoFormLine(elements){
		for(element_k in elements){
			var element = elements[element_k];
			var post_callback = null;
			if(isPlainObject(element)){
				post_callback = element.post_callback;
				element = element.element;
			}
			initBtnAddAProtoFormLine(element,post_callback);
		}
		
	}
	function addAProtoFormLine(event){
		var table = $(this).parents('table:first');
		var formBody = $(table).find('tbody');
		var data = event.data;
		post_callback = data.post_callback;
		/* get the number of lign tr inside the form  */
        var indexTr = $(formBody).find('tr').length;
        indexTr += 1;
        /* get the prototype of the current form */
        var formLine = $(formBody).data('prototype');
        /* replace all __name__ in prototype by the current index */
        var newFormLine = formLine.replace(/__name__/g, indexTr)
        var delete_btn = createButton('<span class="glyphicon glyphicon-trash"></span>',{'class':'remove btn btn-danger pull-right'})
        $(delete_btn).on('click',removeAProtoFormLine);
        var delete_box = $('<td></td>').append(delete_btn);
        var new_line = $('<tr>' + newFormLine + '</tr>');
        $(new_line).append(delete_box);
        $(formBody).append(new_line);
        $(document).change();
        if(isCallable(post_callback)) post_callback(formBody);
	}
	function initBtnsRemoveAProtoFormLine(){
		$('.remove').on('click',removeAProtoFormLine);
	}
	function removeAProtoFormLine(event){
		$(this).closest('tr').remove();
	}
/* 
* Fonction s'occupant du scroll 
*/
	setGlobalVar('scrollTopOffset',0);

	function saveScrollTop(){
	    var scroll_top = $(document).scrollTop();
	    setGlobalVar('scrollTopOffset',scroll_top);
	}
	function resetScrollTop(){
	    var scrollToTopVar = undefined;
	    
	    if(getGlobalVar('scrollTopOffset') !== undefined){
	        scrollToTopVar = getGlobalVar('scrollTopOffset');
	    }
	    $(document).scrollTop(scrollToTopVar);
	}
/*
*	fonctions permettant de lancer un écouteur periodique sur les cookies
*/
	setGlobalVar('waitForCookieDefaultOptions',{
		tickDelay : 1000,
		clearInterval : true,
		cookiePath : getLocalPathname(),
		cookieDomain : getLocalDomain()
	})
	setGlobalVar('waitForCookieListenerPile',{});

	function getWaitForCookieDefaultOptions(option_name){
		default_options = getGlobalVar('waitForCookieDefaultOptions');
		if(isset(option_name)){
			default_options = isset(default_options[option_name]) ? default_options[option_name] : undefined;
		}
		return default_options;
	}
	function getWaitForCookierDefaultPath(){
		return getWaitForCookieDefaultOptions('cookiePath');
	}
	function getWaitForCookierDefaultDomain(){
		return getWaitForCookieDefaultOptions('cookieDomain');
	}
	function getCookieListenerPile(){
		return getGlobalVar('waitForCookieListenerPile');
	}
	function setCookieListenerPile(waitForCookieListenerPile){
		setGlobalVar('waitForCookieListenerPile',waitForCookieListenerPile);
	}
	function makeCookieDataIntoKey(cookieData){
		cookieKey = undefined;
		if(isPlainObject(cookieData)){
			cookieKey = JSON.stringify(cookieData);
		}else{
			cookieKey = cookieData;
		}
		return cookieKey;
	}
	function getFromCookieListernerPile(cookieKey){
		var listener = undefined;
		cookieKey = makeCookieDataIntoKey(cookieKey);
		var cookieListenerPile = getcookieListenerPile();
		if(isset(cookieListenerPile[cookieKey])){
			listener = cookieListenerPile[cookieKey];
		}
		return listener;
	}
	function addToCookieListenerPile(cookieKey,listener){
		cookieKey = makeCookieDataIntoKey(cookieKey);
		var cookieListenerPile = getCookieListenerPile();
		var override = isset(cookieListenerPile[cookieKey]);
		cookieListenerPile[cookieKey] = listener;
		setCookieListenerPile(cookieListenerPile);
		return cookieKey;
	}
	function clearCookieListener(cookieKey){
		cookieKey = makeCookieDataIntoKey(cookieKey);
		var listener = getFromCookieListernerPile(cookieKey);
		window.clearInterval(listener);
	}
	function waitForCookie(cookieToSeek,onMatch,options){
		if(isCallable(onMatch)){
			options = isset(options) ? mergePlainObject(options,getWaitForCookieDefaultOptions()) : getWaitForCookieDefaultOptions();
			var tick_delay = options.tickDelay;
			var clear_interval = options.clearInterval;
			var timer = window.setInterval(function(){
				var isCookieOk = lookForCookie(cookieToSeek);
				if(isCookieOk){
					onMatch();
					if(clear_interval) window.clearInterval(timer);
					expireCookieFromListener(cookieToSeek);
				}
			},tick_delay);
			return addToCookieListenerPile(cookieToSeek,timer);
		}else{
			return false;
		}
	}
	function lookForCookie(cookieToSeek){
		cookieToSeek = isArray(cookieToSeek) ? cookieToSeek : Array(cookieToSeek);
		var there_is_your_cookie = false;
		for(var key in cookieToSeek){
			var temp_to_seek = cookieToSeek[key];
			var temp_cookie_name = temp_to_seek; 
			var temp_cookie_value = undefined;
			if(isPlainObject(temp_to_seek)){
				if(Object.keys(temp_to_seek).length > 0){
					temp_cookie_name = Object.keys(temp_to_seek)[0];
					temp_cookie_value = temp_to_seek[temp_cookie_name];
				}
			}
			var temp_cookie = getCookie(temp_cookie_name);
			if(isset(temp_cookie)){
				there_is_your_cookie = true;
				if(isset(temp_cookie_value)){
					if(temp_cookie!=temp_cookie_value){
						there_is_your_cookie = false;
						break;
					}
				}
			}else{
				there_is_your_cookie = false;
				break;
			}
		}
		return there_is_your_cookie;
	}
	function expireCookieFromListener(cookieToSeek){
		cookieToSeek = isArray(cookieToSeek) ? cookieToSeek : Array(cookieToSeek);
		for(var key in cookieToSeek){
			var temp_to_seek = cookieToSeek[key];
			var temp_cookie_name = temp_to_seek; 
			if(isPlainObject(temp_to_seek)){
				if(Object.keys(temp_to_seek).length > 0){
					temp_cookie_name = Object.keys(temp_to_seek)[0];
				}
			}
			expireCookie(temp_cookie_name);
		}
	}
	function waitForDownload(cookieName,spinner_wrapper_id, spinner_message, on_downloaded){
		expireCookie(cookieName);
		invalidCookie(cookieName);
		addSpinner(spinner_wrapper_id,spinner_message);
		var cookieToSeek = {};
		cookieToSeek[cookieName] = true;
		waitForCookie(cookieToSeek,function(){
			removeSpinner(spinner_wrapper_id);
			if(isCallable(on_downloaded)){
				on_downloaded();
			}
		});
	}
/*
*	fonctions de récupération et suppression des cookies
*/
	function getCookie( name ) {
	  var parts = document.cookie.split(name + "=");
	  if (parts.length == 2) return parts.pop().split(";").shift();
	}

	function expireCookie( cName , cPath, cDomain) {
		cPath = isset(cPath) ? cPath : getWaitForCookierDefaultPath();
		cDomain = isset(cDomain) ? cDomain : getWaitForCookierDefaultDomain();
	    document.cookie = 
	        encodeURIComponent(cName) + "=; expires=" + new Date( 0 ).toUTCString() + "; path="+cPath+"; domain="+cDomain;
	}
	function invalidCookie( cName , cPath, cDomain) {
		cPath = isset(cPath) ? cPath : getWaitForCookierDefaultPath();
		cDomain = isset(cDomain) ? cDomain : getWaitForCookierDefaultDomain();
	    document.cookie = 
	        encodeURIComponent(cName) + "=false; expires=" + new Date( 0 ).toUTCString() + "; path="+cPath+"; domain="+cDomain;
	}
/*
*	fonction de génération aléatoire de couleur
*/
	$(document).ready(randomColorOnLoad);
	
	function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
          color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    function randomColorOnLoad(){
    	/*
    	*	on docuement load
    	*/
    	applyRandomColor();
    	/*
    	*	on appenned element
    	*/
    	var observer = new MutationObserver(function(mutationsList){
    		for(var mutation of mutationsList) {
		        if (mutation.type == 'childList') {
		            applyRandomColor(mutation.target);
		        }
	    	}
	    });
	    var observerOptions = {
		  childList: true,
		  subtree: true
		}
    	var body = $('body').get(0);
    	observer.observe(body,observerOptions);
    }
    function applyRandomColor(root_elt){
    	root_elt = isset(root_elt) ? root_elt : $('body');
    	/*
    	*	on direct elements
    	*/
    	$(root_elt).find('.init_text_random_color').each(function(k,v){
    		var random_color = getRandomColor();
    		$(v).css('color',random_color)
    	});
    	$(root_elt).find('.init_back_random_color').each(function(k,v){
    		var random_color = getRandomColor();
    		$(v).css('background-color',random_color)
    	});
    	$(root_elt).find('.init_border_random_color').each(function(k,v){
    		var random_color = getRandomColor();
    		$(v).css('border-color',random_color)
    	});
    	/*
    	*	on child elements
    	*/
    	$(root_elt).find('.init_child_text_random_color>*').each(function(k,v){
    		var random_color = getRandomColor();
    		$(v).css('color',random_color)
    	});
    	$(root_elt).find('.init_child_back_random_color>*').each(function(k,v){
    		var random_color = getRandomColor();
    		$(v).css('background-color',random_color)
    	});
    	$(root_elt).find('.init_child_border_random_color>*').each(function(k,v){
    		var random_color = getRandomColor();
    		$(v).css('border-color',random_color)
    	});
    }
/*
*		fonction récupérant la couleur opposée à celle en entrée
*/
    function invertColor(hex) {
	    if (hex.indexOf('#') === 0) {
	        hex = hex.slice(1);
	    }
	    // convert 3-digit hex to 6-digits.
	    if (hex.length === 3) {
	        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
	    }
	    if (hex.length !== 6) {
	        throw new Error('Invalid HEX color.');
	    }
	    // invert color components
	    var r = (255 - parseInt(hex.slice(0, 2), 16)).toString(16),
	        g = (255 - parseInt(hex.slice(2, 4), 16)).toString(16),
	        b = (255 - parseInt(hex.slice(4, 6), 16)).toString(16);
	    // pad each with zeros and return
	    return '#' + padZero(r) + padZero(g) + padZero(b);
	}

	function padZero(str, len) {
	    len = len || 2;
	    var zeros = new Array(len).join('0');
	    return (zeros + str).slice(-len);
	}

/*
*	fonction permettant d'exécuter une fonction à partir de sont nom en chaine de caractère
*
*	credit : Mac 
*	link : https://stackoverflow.com/users/2158270/mac
*
*/
function executeFunctionByName( functionName, context /*, args */ ) {
    var args, namespaces, func;

    if( typeof functionName === 'undefined' ) { throw 'function name not specified'; }

    if( typeof eval( functionName ) !== 'function' ) { throw functionName + ' is not a function'; }

    if( typeof context !== 'undefined' ) { 
        if( typeof context === 'object' && context instanceof Array === false ) { 
            if( typeof context[ functionName ] !== 'function' ) {
                throw context + '.' + functionName + ' is not a function';
            }
            args = Array.prototype.slice.call( arguments, 2 );

        } else {
            args = Array.prototype.slice.call( arguments, 1 );
            context = window;
        }

    } else {
        context = window;
    }

    namespaces = functionName.split( "." );
    func = namespaces.pop();

    for( var i = 0; i < namespaces.length; i++ ) {
        context = context[ namespaces[ i ] ];
    }

    return context[ func ].apply( context, args );
}
/*
*	fonctions autour des progress bar
*/
setGlobalVar('progressBarTimerPile',[]);
setGlobalVar('progressBarElementTimerPile',[]);
function getProgressBarTimerPile(timer_index){
	var timer = getGlobalVar('progressBarTimerPile');
	if(isset(timer_index)){
		timer = isset(timer[timer_index]) ? timer[timer_index] : false;
	}
	return timer;
}
function setProgressBarTimerPile(pile){
	setGlobalVar('progressBarTimerPile',pile);
}
function addToProgressBarTimerPile(to_add){
	var pile = getProgressBarTimerPile();
	pile.push(to_add);
	setProgressBarTimerPile(pile);
}
function removeFromProgressBarTimerPile(index_timer){
	if(isset(index_timer)){
        index_timer = parseInt(index_timer);
        /*var progressBarPile =*/
        //setProgressBarTimerPile(progressBarPile);
		getProgressBarTimerPile().splice(index_timer, 1);
        removeFromProgressBarElementTimerPile(index_timer);
        var nb_timer = getProgressBarTimerPile().length;

        if (nb_timer > index_timer) {
            //var pb_element_timer_pile = getProgressBarElementTimerPile();

            for (var i = index_timer; i < nb_timer; i++) {
                var temp_pb_element = getProgressBarElementTimerPile(i);
                $(temp_pb_element).attr('data-pile-index-timer', i);
				$('#long_task_fiche_container div.bs_progress_bar[data-pile-index-timer="'+(i+1)+'"]').attr('data-pile-index-timer',i);
            }
        }
    }
}
function getProgressBarElementTimerPile(timer_index){
    var timer = getGlobalVar('progressBarElementTimerPile');
    if(isset(timer_index)){
    	if(isElement(timer_index)){
    		timer_index = $(timer_index).attr('data-pile-index-timer');
        }
        timer = isset(timer[timer_index]) ? timer[timer_index] : undefined;
    }
    return timer;
}
function setProgressBarElementTimerPile(pile){
    setGlobalVar('progressBarElementTimerPile',pile);
}
function addToProgressBarElementTimerPile(index_timer,pb_element_to_add){
    var pile = getProgressBarElementTimerPile();
    pile[index_timer]=pb_element_to_add;
    setProgressBarElementTimerPile(pile);
}
function removeFromProgressBarElementTimerPile(index_timer){
    if(isset(index_timer)) {
        getProgressBarElementTimerPile().splice(index_timer, 1);
    }
}
function initProgressBarElement(pb_element,options){
	/*var pre_pile_index_timer = $(pb_element).attr('data-pile-index-timer');
	if(isset(pre_pile_index_timer)){
        stopTimerFromPile(pre_pile_index_timer);
	}*/
	options = isset(options) ? options : {};
    var first_options = cloneObject(options);

    var pile_index_timer = getProgressBarTimerPile().length;
    $(pb_element).attr('data-pile-index-timer',pile_index_timer).addClass('initialized');
    var actual_pb_element = replacePbElementInPileByActual(pb_element);

    var delay = $(pb_element).attr('data-progress-delay');
    delay = isset(delay) ? delay : '10000';

    first_options.on_ajax_completed = function (pb_element_after, response) {
        var timer = setInterval(function () {
            actual_pb_element = replacePbElementInPileByActual(pb_element_after);
            checkStatusProgressBar(actual_pb_element,options);
        }, delay);
        addToProgressBarTimerPile(timer);
    };

    checkStatusProgressBar(pb_element, first_options);
}
function initProgressBar(options){
	$('.bs_progress_bar:not(.initialized)').each(function(k,v){
		initProgressBarElement(v,options);
	});
}
function initProgressBarOfElement(root_element,options){
	$(root_element).find('.bs_progress_bar:not(.initialized)').each(function(k,v){
		initProgressBarElement(v,options);
	});
}
function  initProgressBarOfDatatable(table_element,options){
	options = isset(options) ? options : {};
	options = mergePlainObject(options,{data_table_element:table_element});
    var dt_table_api = table_element.dataTable().api();
    var dt_rows = dt_table_api.rows(); // 'tr .bs_progress_bar:not(.initialized)'
	var pb_elements = $(dt_rows.nodes()).find('.bs_progress_bar:not(.initialized)');
	$(pb_elements).each(function(k,v){
        initProgressBarElement(v,options);
	});
}
function stopProgressBar(pb_element){
	var timer_index = $(pb_element).attr('data-pile-index-timer');
    stopTimerFromPile(timer_index);
}
function stopTimerFromPile(timer_index,options){
	if(isset(timer_index)) {
        var timer = getProgressBarTimerPile(timer_index);
        var on_stopped = isset(options) && isset(options.on_stopped) ? options.on_stopped : null;
        window.clearInterval(timer);
        removeFromProgressBarTimerPile(timer_index);
        if(isCallable(on_stopped)){
        	on_stopped(timer_index);
		}
        //removeFromProgressBarElementTimerPile(timer_index);
    }
}
function getPbValueToRefreshRow(){

    $('#table_task').DataTable().ajax.reload(null, false);
}
function getActualPbElementByElement(pb_element){
	var timer_index = $(pb_element).attr('data-pile-index-timer');
	return getActualPbElementByTimerIndex(timer_index);
}
function getActualPbElementByTimerIndex(timer_index){
	var pb_element = $('table.dataTable div.bs_progress_bar[data-pile-index-timer="'+timer_index+'"]');
	return $(pb_element).length == 1 ? pb_element : undefined;
}
function replacePbElementInPileByActual(pb_element){
    var timer_index = $(pb_element).attr('data-pile-index-timer')
	var actual_pb_element = getActualPbElementByTimerIndex(timer_index);
    actual_pb_element = isset(actual_pb_element) ? actual_pb_element : pb_element
    addToProgressBarElementTimerPile(timer_index,actual_pb_element);
    return actual_pb_element;
}
setGlobalVar('LONG_TASK_PROGRESS_BAR_ROW_FICHE_ATTR',{});
function getGlobalLongTaskAttrList(){
    return getGlobalVar('LONG_TASK_PROGRESS_BAR_ROW_FICHE_ATTR');
}
function setGlobalLongTaskAttrList(value){
    var task_list = getGlobalVar('LONG_TASK_PROGRESS_BAR_ROW_FICHE_ATTR');
    task_list = value;
 	setGlobalVar('LONG_TASK_PROGRESS_BAR_ROW_FICHE_ATTR',task_list);
}
setGlobalVar('LONG_TASK_PROGRESS_BAR_ROW_FICHE_ATTR_KEYS',{
	'data-progress-wait':0,
	'data-pile-index-timer':null,
	'is_initialized':{
		default : false,
		to_get : function(element){
			return $(element).is('.initialized');
		}
    },
	'data-task_key':null
})
function getAttrProgressBarForTask(task_key,attr_name){
	var task_list = getGlobalLongTaskAttrList();
	var task_attr = isset(task_list[task_key]) ? task_list[task_key] : null;
	if(isset(attr_name) && isset(task_attr)){
		task_attr = task_attr[attr_name];
	}
	return task_attr;
}
function setToLongTaskRowAttrs(taks_key,attrs,options){
    var task_list = getGlobalLongTaskAttrList();
    var force = isset(options) && isset(options.force) ? options.force : true;
    if(!isset(task_list[taks_key]) && force){
        task_list[taks_key] = attrs;
	}
    setGlobalLongTaskAttrList(task_list);
}
function setGlobalAttrFromProgressBar(pb_element){
	var task_key = $(pb_element).attr('data-task_key');
    if(isset(task_key)){
    	var task_attr = extractAttrFromProgressBar(pb_element);
    	setToLongTaskRowAttrs(task_key,task_attr);
    }
}
function extractAttrFromProgressBar(pb_element){
	var attrhish_keys = getGlobalVar('LONG_TASK_PROGRESS_BAR_ROW_FICHE_ATTR_KEYS');
	var task_attr = {};
	for(var attrhish_key in attrhish_keys){
		var attr_default = attrhish_keys[attrhish_key];
		var attr_value=attr_default;
		if(isObject(attr_default)){
			var attr_conf = attr_default;
			var attr_default = attr_conf.default;
			var to_get = attr_conf.to_get;
			if(isCallable(to_get)){
				attr_value = to_get(pb_element);
			}
		}else{
			var attr_value_from_element = $(pb_element).attr(attrhish_key);
			if(isset(attr_value_from_element)){
				attr_value = attr_value_from_element;
			}
		}
        task_attr[attrhish_key]=attr_value;
	}
	return task_attr;
}
function checkStatusProgressBar(pb_element,options){
	var on_ajax_completed = isset(options) && isset(options.on_ajax_completed) ? options.on_ajax_completed : null;
	var data_table_element = isset(options) && isset(options.data_table_element) ? options.data_table_element : null;
	var is_waiting = $(pb_element).is('[data-progress-wait="1"]');
	var is_in_datatable = $(pb_element).parents('table').is('.dataTable') || $(pb_element).parents('tr').is('[role="row"]') || isset(data_table_element);
	if(!is_waiting){
		$(pb_element).attr('data-progress-wait',1);
		var src = $(pb_element).attr('data-progress-src');
		var src_param = JSON.parse($(pb_element).attr('data-progress-src-param'));
		var index_in_response = $(pb_element).attr('data-index-in-response');
		var is_leading_bar = $(pb_element).attr('data-leading-progress-bar');
		if(!is_in_datatable || (is_in_datatable && (is_leading_bar==null || is_leading_bar!=false))){
			$.ajax({
		        url: src,
		        data: src_param,
		        type: 'POST',
		        success: function (response) {
		        	var data = isArray(response) ? response[index_in_response] : response;
		        	if(!is_in_datatable){
			        	var ratio = data.detailsCount != 0 ? ((data.detailsDoneCount + data.detailsErrorCount) / data.detailsCount) * 100 : 100;
			        	ratio = Math.floor(ratio);
			        	var count_infos = data.detailsDoneCount+' / '+data.detailsCount;
			        	var pb_wrapper = $(pb_element).parents('.long_task_fiche:first');
			        	if(data.detailsErrorCount>0){
			        		count_infos += '('+data.detailsErrorCount+' erreur(s))';
			        	}
			        	if(ratio>=100 && ["RUNNING","FINISHING"].indexOf(data.status)==-1){
			        		$(pb_element).parents('.long_task_fiche:first').replaceWith(data.ficheView);
			        		stopProgressBar(pb_element);
			        	}else{
			        		$(pb_element).find('.progress-bar').css('width',ratio+'%').text(ratio+'%');
			        		$(pb_wrapper).find('.counts_info_container').text(count_infos);
			        	}
			        }else{
		        		$(pb_element).attr('data-progress-wait',0);
		        		setGlobalAttrFromProgressBar($(pb_element));
			        	var dt_table = isset(data_table_element) ? data_table_element : $(pb_element).parents('table');
			        	if(!isEmpty(dt_table)) {
	                        var dt_table_api = $(dt_table).dataTable().api();
	                        var row_node = $(pb_element).parents('tr:first');
	                        var dt_row = dt_table_api.row(row_node);
	                        var row_index = dt_row.index();
	                        if(isset(dt_row) && !isEmpty(dt_row)) {
	                            dt_row.data(response);
	                            dt_table_api.draw(false);
	                            var after_draw_row = dt_table_api.row(row_index).node();
	                            pb_element = $(after_draw_row).find('.bs_progress_bar:first');
	                        }
	                    }
			        }
		        },
		        complete:function (response){
		        	$(pb_element).attr('data-progress-wait',0);
		        	if(isCallable(on_ajax_completed)){
	                    on_ajax_completed(pb_element,response);
					}
		        }
			});
		}
	}
}
function checkIfZeroOrNull(radioValue, idTable, idContainer) {
	if (radioValue == '1') {
		var valid = false;
	
		$('#' + idTable + ' input[type=text]').each(function() {
			if ($(this).val() != 0 && $(this).val() != null) {
				valid = true;
			}
		});

		if ($('#msgZeroOrNullAgent_' + idTable).length > 0) {
			$('#msgZeroOrNullAgent_' + idTable).remove();
		}

		if (valid == false) {
			$('#' + idContainer).append('<div style="color: red;" id="msgZeroOrNullAgent_' + idTable + '">Vous avez répondu "Oui" à la question mais n\'avez saisi aucune donnée dans le tableau concerné</div>');
		} else {
			$('#msgZeroOrNullAgent_' + idTable).remove();
		}
		
		return valid;
	} else {

		$('#msgZeroOrNullAgent_' + idTable).remove();
		return true;
	}
}

function getBrowserSetSticky(idIndTable){
    var incohHeight = $('#incoh').height();
    if (navigator.userAgent.search("Chrome") >= 0) {
        $('#'+idIndTable.id).stickyTableHeaders({fixedOffset: $('#incoh')});
    }
    else if (navigator.userAgent.search("Firefox") >= 0) {
        $('#' + idIndTable.id + ' thead').css({
            "position" : "sticky",
            "top": incohHeight
        });
    }   
}

$(document).ready(function(){
	initProgressBar();
    //setInterval(function(){ getPbValueToRefreshRow(); }, 30000);

});