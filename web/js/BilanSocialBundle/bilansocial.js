$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({"html":true})
    if(check_if_init_already_present()){
        $('.block').css('cursor','not-allowed');
        $('.cigbs-custom-file-upload').css('cursor','not-allowed');
        $('.cigbs-custom-file-upload').on('click',function(event){
            event.preventDefault();
            return false;
        });
        var data = $('.container_init').data();

        if(data.initsource == "n4ds"){
            var element_to_clear = {};
            var arrow_to_enabled = ["#non_vide", "#precision","#btn-bsInitType-apa","#arrow-n4ds"];
            var title_to_enabled = ["#excel","#niveau","#remplissage","#apa-n4ds"];
            var etape_light = '.etape';
            var etape_off = '';

            shortcut_light(element_to_clear,arrow_to_enabled,title_to_enabled,etape_light,etape_off);
        }else if(data.initsource == "bs-dgcl"){

            var element_to_clear = {};
            var arrow_to_enabled = ["#non_vide", "#btn_dgcl_oui"];
            var title_to_enabled = ["#excel","#dgcl"];
            var etape_light = '#etape1, #etape2';
            var etape_off = '#etape3, #etape4';

            shortcut_light(element_to_clear,arrow_to_enabled,title_to_enabled,etape_light,etape_off);
        }else if(data.initsource == "basecarr"){
            var element_to_clear = {};
            var arrow_to_enabled = ["#non_vide", "#precision","#btn-bsInitType-apa","#arrow-base-carriere"];
            var title_to_enabled = ["#excel","#niveau","#remplissage","#apa-base-carriere" ];
            var etape_light = '#etape';
            var etape_off = '';

            shortcut_light(element_to_clear,arrow_to_enabled,title_to_enabled,etape_light,etape_off);

        }else if(data.initsource == "bs-vide"){
            var element_to_clear = {};
            var arrow_to_enabled = ["#vide"];
            var title_to_enabled = ["#bs_vide"];
            var etape_light = '#etape1';
            var etape_off = '#etape4, #etape3, #etape2';

            shortcut_light(element_to_clear,arrow_to_enabled,title_to_enabled,etape_light,etape_off);

        }else if(data.initsource == "manu"){
            if(data.blapa){
                var element_to_clear = {};
                var arrow_to_enabled = ["#non_vide", "#precision","#btn-bsInitType-apa","#arrow-manu"];
                var title_to_enabled = ["#excel","#niveau","#remplissage","#apa-manu" ];
                var etape_light = '#etape';
                var etape_off = '';

                shortcut_light(element_to_clear,arrow_to_enabled,title_to_enabled,etape_light,etape_off);

            }else{
                var element_to_clear = {};
                var arrow_to_enabled = ["#non_vide", "#precision","#btn-bsInitType-cons"];
                var title_to_enabled = ["#excel","#niveau",'#btn-conso' ];
                var etape_light = '#etape1, #etape2, #etape3';
                var etape_off = '#etape4';

                shortcut_light(element_to_clear,arrow_to_enabled,title_to_enabled,etape_light,etape_off);

            }
        }
        var config = {

        }
    }else{

        $('.block').on('click', function(e){
            /*  e.preventDefault();*/
            if(check_if_init_exist()){
                var element = $(this).closest('.block')[0];
                if(check_if_actif(element)){
                    clear_input_file();
                    gestion(element);
                }else{
                    return false;
                }
            };
        });

        $('input[type="file"]').on('change', function(){
            gestion_modal($(this));
        });
        $('.cigbs-initbs-box.has_shortcut').on('click',function(event){
            if($(this).is(':not(.ACTIVE)')){
                $(this).find('.has_shortcut').trigger('click');
            }
        });
        $('.shortcut_n4ds').on("click", function(){
            var element_to_clear = ["#non_vide", "#precision","#btn-bsInitType-apa","#arrow-n4ds", "#excel","#niveau","#remplissage",'#apa-n4ds' ];
            clearAll(element_to_clear);
            var arrow_to_enabled = ["#non_vide", "#precision","#btn-bsInitType-apa","#arrow-n4ds"];
            var title_to_enabled = ["#excel","#niveau","#remplissage","#apa-n4ds"];
            var etape_light = '.etape';
            var etape_off = '';

            shortcut_light(element_to_clear,arrow_to_enabled,title_to_enabled,etape_light,etape_off);

        });
        $('.shortcut_dgcl').on("click", function(){

            var element_to_clear = ["#apa-manu","#apa-base-carriere","#apa-n4ds","#arrow-manu","#arrow-base-carriere","#arrow-n4ds","#btn-conso","#remplissage","#btn-bsInitType-cons","#btn-bsInitType-apa","#dgcl","#btn_dgcl_oui","#excel","#non_vide"];
            var arrow_to_enabled = ["#non_vide", "#btn_dgcl_oui"];
            var title_to_enabled = ["#excel","#dgcl"];
            var etape_light = '#etape1, #etape2';
            var etape_off = '#etape3, #etape4';

            shortcut_light(element_to_clear,arrow_to_enabled,title_to_enabled,etape_light,etape_off);


        });
    }

});

function shortcut_light(element_to_clear,arrow_to_enabled,title_to_enabled,etape_light,etape_off){


    clearAll(element_to_clear);


    $.each(arrow_to_enabled, function(k, v){
        $(v).removeClass('DESACTIVE');
        $(v).addClass('ACTIVE');
        find_current_element(v);

    });
    $.each(title_to_enabled, function(k, v){
        $(v).removeClass('DESACTIVE');
        $(v).addClass('ACTIVE cigbs-active');
        find_current_element(v);
    });

    $("#etape_container").find(etape_off).removeClass().addClass('etape etape_hide');
    $("#etape_container").find(etape_light).removeClass().addClass('etape etape_valide');
}
function clear_input_file(){
    var dgclFile = document.getElementById("file-dgcl");
    var n4dsApaFile = document.getElementById("file-n4ds-apa");
    var n4dsConsFile = document.getElementById("file-n4ds-cons");

    $(dgclFile).val('');
    $(n4dsApaFile).val('');
    $(n4dsConsFile).val('');
}
/**
 * Vérifie si la clé de la ligne passée en paramètre est présente dans la liste des clés à envoyer.
 * @param whitelistItems {Object}
 * @param pLineKey {String}
 * @returns {boolean}
 * @private
 */
function _checkIfItIsAWhitelistedLine(whitelistItems, pLineKey) {
    return whitelistItems[pLineKey];
}

function _formatStrDate(pStrDate) {
    if (!pStrDate || pStrDate.length !== 8) return pStrDate;
    return pStrDate.substr(0, 2) + "/" + pStrDate.substr(2, 2) + "/" + pStrDate.substr(4);
}

function _n4dsWorkStep(pLabel, pStep, pCallback) {
    console.log("_n4dsWorkStep=", pStep);
    if (pLabel) {
        $("#modal-n4ds-action-label").html(pLabel);
    }
    if (pStep != null) {
        $("#modal-n4ds-action-slider").css("width", pStep + "%");
        $("#modal-n4ds-action-slider").html(pStep + "%");
    }
    if (pCallback) {
        setTimeout(pCallback, 50);
    }
}

function doOnN4DSActionClick(pType) {
    // Test API
    if (typeof window.FileReader !== "function") {
        alert("L’api \"File\" n’est pas supportée par cette version de votre navigateur. Vous ne pouvez donc pas utiliser une source \"N4DS\".");
        return true;
    }
    var n4dsFile = document.getElementById("file-n4ds-apa");
    if (!n4dsFile.files[0]) {
        alert("Veuillez sélectionner un fichier \"N4DS\" avant de cliquer sur le bouton \"Importer\".");
        return true;
    }
    fill_value(1,0,0,"n4ds");
    _doSaveInitBS(

        function(pTargetURl) {
            n4dsFile = n4dsFile.files[0];
            //console.log("file", n4dsFile)
            // Remplissage des informations
            $("#modal-n4ds-action-filename").html(n4dsFile.name);
            $("#modal-n4ds-action-size").html(Math.round(n4dsFile.size / 1024) + ' ko');

            // Cleaning
            $("#modal-n4ds-action-siret").html("...");
            $("#modal-n4ds-action-dtdebut").html("...");
            $("#modal-n4ds-action-dtfin").html("...");
            $("#modal-n4ds-action-nbagent").html("...");
            _n4dsWorkStep(" ", 0);
            $('#modal-n4ds-action-btn-close').attr('disabled', true);
            $('#importMsg').hide();

            // Affichage de la modal d'information
            $('#modal-n4ds-action').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Début du traitement
            async.waterfall([
                    /**
                     * Lecture du fichier en mémoire
                     * @param pCallback
                     */
                    function (pCallback) {
                        const reader = new FileReader();

                        reader.onload = function (evt) {
                            console.debug("load done", evt.target);
                        };

                        reader.onloadstart = function () {
                            _n4dsWorkStep("Chargement du fichier...", 0);
                            appendSpînner('.modal-footer');
                        };

                        reader.onprogress = function (evt) {
                            const step = evt.loaded / n4dsFile.size * 40.0;
                            _n4dsWorkStep(null, step);
                        };

                        reader.onloadend = function (evt) {
                            _n4dsWorkStep(null, 40,
                                function () {
                                    pCallback(null, evt.target.result);
                                });
                        };

                        reader.onerror = function (evt) {
                            pCallback(evt);
                        };

                        reader.readAsText(n4dsFile, 'ISO-8859-1');
                    },
                    /**
                     * Chargement de la White list
                     * @param pRawFileData Contenu du fichier à nettoyer
                     * @param pCallback
                     */
                    function (pRawFileData, pCallback) {
                        _n4dsWorkStep("Chargement de la liste blanche des clefs à conserver...");
                        $.getJSON(Routing.generate("get_whitelist"))
                            .done(function (jsonData) {
                                _n4dsWorkStep(null, 45,
                                    function () {
                                        //console.log("WhiteList items", jsonData);
                                        pCallback(null, pRawFileData, jsonData);
                                    });
                            })
                            .fail(function (jqxhr, textStatus, error) {
                                pCallback(textStatus + ":" + error);
                            });
                    },
                    /**
                     * Nettoyage du fichier
                     * @param pRawFileData
                     * @param pWhiteList
                     * @param pCallback
                     */
                    function (pRawFileData, pWhiteList, pCallback) {
                        _n4dsWorkStep("Nettoyage du fichier avant envoi...");
                        // Transformation du texte chargé en un tableau de lignes
                        const linesIn = pRawFileData.split(/\r\n|\r|\n/g);
                        const div4Step = Math.round(linesIn.length / 10);
                        var step = 45;
                        var index = 0;
                        var infoData = {
                            nbAgent: 0,
                            siret: null,
                            dtDebutRef: null,
                            dtFinRef: null
                        };
                        var nbLineOnError = 0;

                        // Filtrage des lignes
                        async.filter(linesIn,
                            function (line, callback) {
                                // Comptage des agents
                                const cols = line.split(',');
                                // Si la ligne ne contient pas exactement 2 colonnes alors on la filtre (supprime)
                                if (cols.length !== 2) {
                                    nbLineOnError++;
                                    return callback(null, false);
                                }
                                //
                                // Récupération des données informations

                                if ("S30.G01.00.001" === cols[0]) { // Numéro d'inscription au répertoire  : OBLIGATOIRE => Indicateur de passage à un nouvel agent
                                    infoData.nbAgent++;
                                }
                                else if ("S10.G01.00.001.001" === cols[0]) { // Siren de l'émetteur de l'envoi : OBLIGATOIRE
                                    infoData.siret = cols[1].replace("'", "").replace("'", "");
                                }
                                else if ("S10.G01.00.001.002" === cols[0]) { // Nic : OBLIGATOIRE
                                    infoData.siret += cols[1].replace("'", "").replace("'", "");
                                }
                                else if ("S20.G01.00.003.001" === cols[0]) {  // Date de début de la période de référence de la déclaration  : OBLIGATOIRE
                                    infoData.dtDebutRef = _formatStrDate(cols[1].replace("'", "").replace("'", ""));
                                }
                                else if ("S20.G01.00.003.002" === cols[0]) { // Date de fin de la période de référence de la déclaration  : OBLIGATOIRE
                                    infoData.dtFinRef = _formatStrDate(cols[1].replace("'", "").replace("'", ""));
                                }

                                // Doit-on conserver la ligne ?
                                if (++index % div4Step === 0) {
                                    const localStep = (step += 2);
                                    _n4dsWorkStep(null, localStep,
                                        function () {
                                            return callback(null, _checkIfItIsAWhitelistedLine(pWhiteList.items, cols[0]));
                                        });
                                } else {
                                    return callback(null, _checkIfItIsAWhitelistedLine(pWhiteList.items, cols[0]));
                                }
                            },
                            function (err, results) {
                                if (err) {
                                    pCallback(err);
                                } else {
                                    _n4dsWorkStep(null, 65,
                                        function () {
                                            pCallback(null, results, infoData);
                                        });
                                }
                            });
                    },
                    /**
                     * Affichage des infos extraites du fichier
                     * @param pCleanFileData
                     * @param pInfoData
                     * @param pCallback
                     */
                    function (pCleanFileData, pInfoData, pCallback) {
                        //console.log("cleaned file", pCleanFileData);
                        $("#modal-n4ds-action-siret").html(pInfoData.siret);
                        $("#modal-n4ds-action-dtdebut").html(pInfoData.dtDebutRef);
                        $("#modal-n4ds-action-dtfin").html(pInfoData.dtFinRef);
                        $("#modal-n4ds-action-nbagent").html(pInfoData.nbAgent);
                        var dureeSec = pInfoData.nbAgent / 50;
                        _n4dsWorkStep("Envoi du fichier nettoyé - durée approximative du traitement : " + Math.round(dureeSec) + " seconde(s)...", 0,
                            function () {
                                pCallback(null, pCleanFileData);
                            });
                    },
                    /**
                     * Envoi du fichier nettoyé pour traitement serveur
                     * @param pCleanFileData
                     * @param pCallback
                     */
                    function (pCleanFileData, pCallback) {
                        //pCallback(null, pCleanFileData);
                        $.post(Routing.generate('import_send_file'), {fichier: pCleanFileData.join('\n')})
                            .progress(function (data) {
                                console.log("progress post:" + data);
                            })
                            .done(function (response) {
                                _n4dsWorkStep(null, 100,
                                    function () {
                                        //console.log("WhiteList items", jsonData);
                                        pCallback(null, response);
                                    });
                            })
                            .fail(function (jqxhr, textStatus, error) {
                                pCallback(textStatus + ":" + error);
                            });
                    }
                ],
                function (err, pPostResponse) {
                    _n4dsWorkStep(null, 100,
                        function () {
                            var hasError = false;
                            removeSpînner('.modal-footer');
                            if (err) {
                                $("#importMsg").addClass("alert-danger");
                                console.log(err);
                                $('#importMsg').html('Une erreur est survenue, si le problème persiste, veuillez contacter votre administrateur.');
                                hasError = true;
                            } else if (pPostResponse.message != "Import N4DS réussi") {
                                $("#importMsg").addClass("alert-danger");
                                $('#importMsg').html(pPostResponse.message);
                                hasError = true;
                            } else {
                                $("#importMsg").removeClass("alert-danger");
                                $("#importMsg").addClass("alert-success");
                                $('#importMsg').html("Fichier N4DS \"" + n4dsFile.name + "\" importé avec succès.");
                            }
                            $('#importMsg').show();
                            // Goto on close
                            var nextModal = function () {
                                if(!hasError){
                                    if(pPostResponse.saveOldData == true){
                                        $('#modal-apa-get-old-saved-data').modal({backdrop: "static", keyboard: false});
                                        $('#modal-apa-get-old-saved-data-btn-confirm').on('click', function() {
                                            
                                            $('#modal-apa-get-old-saved-data-btn-close').prop('disabled', true);
                                            $('#modal-apa-get-old-saved-data-btn-confirm').prop('disabled', true);
                                            appendSpînner('.modal-footer');
                                            $.ajax({
                                                url: Routing.generate('saved_old_data'),
                                                data: {
                                                  action: 'modal-apa-get-old-saved-data-btn-confirm'  
                                                },
                                                method: 'POST',
                                                async: true,
                                                success: function (response) {
                                                    $('.fa-spinner').css('display', 'none');
                                                    $('#modal-apa-get-old-saved-data').modal('hide');
                                                },
                                                complete: function (response) {
                                                    $('.fa-spinner').css('display', 'none');
                                                    $('#modal-apa-get-old-saved-data').modal('hide');
                                                }
                                            });
                                        });
                                    }
                                    if(pPostResponse.bsAnneeN == false){
                                        if(pPostResponse.typeBs == false){
                                            $('#modal-apa-redirect-info').modal({backdrop: "static", keyboard: false});
                                        }else{
                                            ajaxToBlockInit(pTargetURl);
                                        }
                                    }else if(pPostResponse.bsAnneeN == true){
                                        $('#modal-n4ds-annee-n').modal({backdrop: "static", keyboard: false});
                                    }
                                    $('#modal-confirm-redirect-apa-btn-close').click(function(){
                                        ajaxToBlockInit(pTargetURl);
                                    });
                                    $('#modal-n4ds-annee-n-btn-close').click(function(){
                                        if(pPostResponse.typeBs == false){
                                            $('#modal-apa-redirect-info').modal({backdrop: "static", keyboard: false});
                                        }else{
                                            ajaxToBlockInit(pTargetURl);
                                        }

                                    });
                                }else{
                                    ajaxDeleteInit(getGlobalVar('homeUrl'), pPostResponse.message);
                                }
                            };
                            $('#modal-n4ds-action-btn-close').off('click');
                            $('#modal-n4ds-action-btn-close').on('click',nextModal);

                            $('#modal-n4ds-action-btn-close').removeAttr('disabled');

                        });
                });
        });
}
function clearAll(element_to_clear){

    $.each(element_to_clear, function(k, v){
        var brother = find_brothers(v);

        if(brother.length > 1){
            $.each(brother, function(k1, v1){
                gestion_color(v1,'black');
                $(v1).removeClass('ACTIVE').addClass('DESACTIVE');
                $(v1).removeClass('selected').addClass('unselected');
                if($(v1).hasClass('cigbs-initbs-box')){
                    $(v1).removeClass('cigbs-active');
                }

                /*$(v1).css('opacity', 0.3);*/
            })
        }else{
            gestion_color(brother,'black');

            if($(brother).hasClass('etape1')){
                $(brother).removeClass('DESACTIVE').addClass('ACTIVE');
                $(brother).removeClass('unselected').addClass('unselected');

                /*$(brother).css('opacity', 0.3);*/
            }else{

                $(brother).removeClass('ACTIVE').addClass('DESACTIVE');
                $(brother).removeClass('selected').addClass('unselected');
                if($(brother).hasClass('cigbs-initbs-box')){
                    $(brother).removeClass('cigbs-active');
                }
                /*$(brother).css('opacity', 0.3);*/
            }

        }

    });
}
function gestion_etape(element){
    if($(element).hasClass('ACTIVE')){
        if($(element).hasClass('last')){
            if(!isEmpty($(element).attr("class").match(/\betape\S*/))){
                var etape = $(element).attr("class").match(/\betape\S*/)[0];
                var etapes = $('#etape_container').find('.etape');
                $.each(etapes, function(k,v){
                    if($(v).attr('id') == etape){
                        $(v).removeClass();
                        $(v).addClass('etape etape_valide');
                        if($(v).next('.etape') !== "undefined"){
                            var next =  $(v).next('.etape');
                            $(next).removeClass();
                            $(next).addClass('etape etape_hide');

                            $(next).nextAll('.etape').removeClass().addClass('etape etape_hide');
                        }

                    }
                });


            }
        }else{
            if(!isEmpty($(element).attr("class").match(/\betape\S*/))){
                var etape = $(element).attr("class").match(/\betape\S*/)[0];
                var etapes = $('#etape_container').find('.etape');
                $.each(etapes, function(k,v){

                    if($(v).attr('id') == etape){
                        /*console.log(k);*/
                        $(v).removeClass();
                        $(v).addClass('etape etape_valide');
                        if($(v).next('.etape') !== "undefined"){
                            var next =  $(v).next('.etape');
                            $(next).removeClass();
                            $(next).addClass('etape etape_active');
                            $(next).nextAll('.etape').removeClass().addClass('etape etape_waiting');
                        }
                    }
                });
            }
        }



    }else if($(element).hasClass('DESACTIVE')){
        if($(element).hasClass('last')){
        }else{
            if(!isEmpty($(element).attr("class").match(/\betape\S*/))){
                var etape = $(element).attr("class").match(/\betape\S*/)[0];
            }
        }

    }
}
function disabledAllContainer(){
    var row = $('.container_init').children('row');
}
function check_if_init_exist(){
    if($("#first_block").hasClass('ACTIVE')){
        return true;
    }else{
        return false;
    }
}
function check_if_actif(element){
   //  var parent_block = $(element).closest('div[class*="col-"]');
    var data = $('.container_init').data('idinitbs');
    element = $(element).is('p')? $(element).parent('div.cigbs-initbs-box') : element;
    if($(element).hasClass('ACTIVE') && isEmpty(data)){
        return true;
    }else{
        return false;
    }
}


function make_actif_next_row(element_to_enable){
    var parent_block = $(element_to_enable).closest('div[class*="col-"]');
    var id_parent_block = $(parent_block).attr('id');
    var element_to_activate = $('.container_init').find('.'+id_parent_block);


    if(element_to_activate.length > 0){
        clearAll(element_to_activate);
        $.each(element_to_activate, function(){
            if($(this).hasClass('cigbs-initbs-box')){
                $(this).addClass('cigbs-active').addClass('selected').removeClass('unselected');

            }
            $(this).addClass('ACTIVE');
            $(this).removeClass('DESACTIVE');
            $(this).removeClass('unselected');
            /*$(this).css('opacity', 1);*/

        });
    }
}

function find_brothers(element){
    var id = $(element).attr('id');
    var brothers_direct =  $('#'+id).siblings();
    return brothers_direct;
}

function find_children_direct(element){
    var id = $(element).attr("id");
    var element_to_enable = $('.container_init').find('.'+id);
    if(element_to_enable.length !== 0){
        find_children_of_brothers(element_to_enable);
    }
}
function check_if_init_already_present(){
    var data = $('.container_init').data("idinitbs");
    if(isEmpty(data)){
        return false;
    }else{
        return true;
    }
}
function find_children_of_brothers(brothers){

    $.each(brothers, function(index_bro, value_bro){
            var id = $(value_bro).attr("id");
            var element_to_disabled = $('.container_init').find('.'+id);



            if(element_to_disabled.length !== 0){
                $.each(element_to_disabled, function(){
                    if($(this).hasClass('cigbs-initbs-box')){
                        $(this).removeClass('cigbs-active');
                    }
                    $(this).removeClass('ACTIVE');
                    $(this).addClass('DESACTIVE');
                    $(this).removeClass('selected').addClass('unselected');
                    gestion_color($(this), 'black');
                    /*$(this).css('opacity', 0.3);*/
                    find_children_of_brothers($(this));

                });
            }else{
                return true;
            }

    });
}

function find_direct_brother(brothers){
    $.each(brothers, function(index, value){
        gestion_color(value, 'black');
        $(value).removeClass('selected').addClass('unselected');
        /*$(value).css('opacity', 0.3);*/
    })
}
function find_current_element(element){
    gestion_color(element,'#8cc63f');
    /*$(element).css('opacity', 1);*/
    $(element).addClass('selected').removeClass('unselected');
}

function gestion(element) {

    var brothers = find_brothers(element);

    make_actif_next_row(element);
    find_current_element(element);
    find_direct_brother(brothers);
    find_children_direct(element);
    find_children_of_brothers(brothers);
    gestion_etape(element);

}

function gestion_color(element, color){

    var parent_block = $(element).closest('div[class*="col-"]');
    var top = $(parent_block).find('.top');
    var bottom = $(parent_block).find('.bottom');
    var triangle = $(parent_block).find('.triangle_left, .triangle_right');

    var border_witdh = 1;

    if(color === "#8cc63f"){
        border_witdh = 2;
    }
    gestion_color_top(top,border_witdh,color);
    gestion_color_bottom(bottom,border_witdh,color);
    gestion_color_triangle(triangle,color);

}
function  gestion_color_top(top,border_witdh,color){

    if($(top).hasClass('left')){
        if(!$(top).hasClass('center')){
            $(top).css({'border-right': border_witdh+'px solid '+color});
        }

    }else if($(top).hasClass('right')){
        if(!$(top).hasClass('center')){
            $(top).css({'border-left':  border_witdh+'px solid '+color});
        }
    }
}
function  gestion_color_bottom(bottom,border_witdh, color){
    //console.log(bottom);
    if($(bottom).hasClass('left')){
        if($(bottom).hasClass('center')){
            $(bottom).css({'border-top':'0px solid '+color,'border-left':  border_witdh+'px solid '+color});
        }else{
            $(bottom).css({'border-top': border_witdh+'px solid '+color,'border-left':  border_witdh+'px solid '+color});
        }
    }else if($(bottom).hasClass('right')){
        if($(bottom).hasClass('center')){
            $(bottom).css({'border-top': border_witdh+'px solid '+color,'border-right': border_witdh+'px solid '+color});
        }else{
            $(bottom).css({'border-top': border_witdh+'px solid '+color,'border-right': border_witdh+'px solid '+color});
        }
    }

}

function ajaxToBlockInit(pTargetURl){
    $.ajax({
        url: Routing.generate('bilan_social_lock_initialisation'),
        method: 'POST',
        async: true,
        success: function (response) {
            window.location.replace(pTargetURl);
        }
    })
}
function  gestion_color_triangle(triangle,color){
    if(triangle.length > 0){
        $(triangle).css( "border-color", color + " transparent transparent transparent");
    }
}
function  initBsVide(event){

    var element = $(event.target);
    if(check_if_actif(element)){
        fill_value(0,0,0,"bs-vide");
        gestion_modal(element);
    }
}
function initConso(event){
    var element = $(event.target);
    if(check_if_actif(element)) {
        fill_value(1, 0, 0, "manu");
        gestion_modal(element);
    }
}
function initBaseCarriere(event){
    var element = $(event.target);
    if(check_if_actif(element)) {
        fill_value(1, 0, 1, "basecarr")
        gestion_modal(element);
    }
}
function  initDgcl(event){
    var element = $(event.target);
    if(check_if_actif(element)){

        gestion_modal(element);
    }
}
function initN4ds(event){
    var element = $(event.target);
    if(check_if_actif(element)){
        fill_value(1,0,0,"n4ds");
        gestion_modal(element);
    }
}

function initApa(event){
    var element = $(event.target);
    if(check_if_actif(element)){
       /* doOnManuActionClick(event);*/
        fill_value(1,1,1,"manu");
        gestion_modal(element);
    }
}
function initCons(event){
    var element = $(event.target);
    if(check_if_actif(element)){
        fill_value(1,1,0,"manu");
        gestion_modal(element);
    }
}
function gestion_modal(element){
    var parent_block = $(element).closest("div.ACTIVE");
    var function_callback = $(parent_block).data('function');
    console.log(function_callback);
    console.log(element);
    var modal = createBtpModal($(parent_block).data('name'),sfTrans($(parent_block).data('title')),sfTrans($(parent_block).data('trans')),{
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
                        window[function_callback](parent_block);
                        /*eval(function_callback);*/
                        closeBtpModal(modal);
                    }
                }
            }
        ]
    });
    openBtpModal(modal);
};
function fill_value(decla_agent, decla_bs, isBsTypeApa,initSource ){
    $('#decla-agent').val(decla_agent);
    $('#decla-bs').val(decla_bs);
    $('#isBsTypeAPA').val(isBsTypeApa);
    $('#bs-init-source').val(initSource);
}
function _doSaveInitBS(pCallback) {
    var file = null;
    var dgclFile = document.getElementById("file-dgcl");
    var n4dsApaFile = document.getElementById("file-n4ds-apa");

    if(!isEmpty(dgclFile)){
        if (isset(dgclFile.files) && dgclFile.files.length > 0) {
            dgclFile = dgclFile.files[0];
            if (dgclFile !== undefined) {
                file = dgclFile['type'];
            }
        }
    }

    if(!isEmpty(n4dsApaFile)){
        if (isset(n4dsApaFile.files) && n4dsApaFile.files.length > 0) {
            n4dsApaFile = n4dsApaFile.files[0];
            if (n4dsApaFile !== undefined) {
                file = n4dsApaFile['type'];
            }
        }
    }


    $.ajax({
        url: Routing.generate('bilan_social_saveInitialisation'),
        method: 'POST',
        dataType: 'json',
        data: {
            declaAgent: $('#decla-agent').val(),
            declaBS: $('#decla-bs').val(),
            isTypeAPA: $('#isBsTypeAPA').val(),
            bsInitSource: $('#bs-init-source').val(),
            file: file
        },
        async: true,
        success: function (response) {

            if (response.status === "success") {
                pCallback(response.targetUrl);
            }
            else {
                createBtpModal("failed", "Erreur lors de l'import", response.msg, "", [], "modal");
                $('#failed').modal().show();
            }
        }
    });
}
function doOnDGCLActionClick(element) {
    if(check_if_actif(element)) {
        // Test API
        if (typeof window.FileReader !== "function") {
            alert("L’api \"File\" n’est pas supportée par cette version de votre navigateur. Vous ne pouvez donc pas utiliser une source \"DGCL\".");
            return true;
        }
        var dgclFile = document.getElementById("file-dgcl");
        if (!dgclFile.files[0]) {
            alert("Veuillez sélectionner un fichier \"DGCL\" avant de cliquer sur le bouton \"Importer\".");
            return true;
        }
        fill_value(1,1,0,"bs-dgcl");

         var dgcl_wrapper = $(element);
        _doSaveInitBS(
            function (pTargetURl) {
                dgclFile = dgclFile.files[0];
                if (dgclFile['type'] !== 'text/plain') {
                    $('#messageJS').addClass("alert-danger");
                    $('#messageJS').html("Le format du fichier importé est incorrect.");
                    $('#messageJS').show();
                    return false;
                }
                $('#messageJS').hide();

                // Début du traitement
                async.waterfall([
                        function (pCallback) {
                            addSpinner(dgcl_wrapper,'Import DGCL en cours', true);
                            const reader = new FileReader();

                            reader.onload = function (evt) {
                                console.debug("load done", evt.target);
                            };

                            reader.onloadstart = function () {

                            };

                            reader.onprogress = function (evt) {

                            };

                            reader.onloadend = function (evt) {

                                pCallback(null, evt.target.result);

                            };

                            reader.onerror = function (evt) {
                                pCallback(evt);
                            };

                            reader.readAsText(dgclFile, 'ISO-8859-1');
                        },
                        /**
                         * Envoi du fichier nettoyé pour traitement serveur
                         * @param pCallback
                         */
                        function (pCleanFileData, pCallback) {
                            //pCallback(null, pCleanFileData);
                            $.post(Routing.generate('import_send_file_dgcl'), {fichier: pCleanFileData})
                                .progress(function (data) {
                                    console.log("progress post:" + data);
                                })
                                .done(function (response) {
                                    //console.log("ok");
                                    pCallback(null, response);
                                })
                                .fail(function (jqxhr, textStatus, error) {
                                    pCallback(textStatus + ":" + error);
                                });
                        }
                    ],
                    function (err, pPostResponse) {
                         removeSpinner(dgcl_wrapper);
                        var hasError = false;
                        if (err) {
                            $("#messageJS").addClass("alert-danger");
                            $('#messageJS').html('Une erreur est survenue, si le problème persiste, veuillez contacter votre administrateur.');
                            hasError = true;
                        } else if (pPostResponse.message == "incorrectFile") {
                            $('#messageJS').addClass("alert-danger");
                            $('#messageJS').html("Le format du fichier importé est incorrect.");
                            hasError = true;
                        } else if (pPostResponse.message == "wrongNmSiret") {
                            $("#messageJS").addClass("alert-danger");
                            $('#messageJS').html("Le numéro Siret du fichier DGCL ne correspond pas avec celui de votre collectivité.");
                            pPostResponse.message = "Le numéro Siret du fichier DGCL ne correspond pas avec celui de votre collectivité.";
                            hasError = true;
                        } else if (pPostResponse.message == "wrongYear") {
                            $("#messageJS").addClass("alert-danger");
                            $("#messageJS").html("Le fichier importé ne correspond à l'année de référence des enquêtes (année "+ pPostResponse.annee_campagne +")");
                            pPostResponse.message = "Le fichier importé ne correspond à l'année de référence des enquêtes (année "+ pPostResponse.annee_campagne +")";
                            hasError = true;
                        } else if (pPostResponse.message != "Import DGCL réussi") {
                            $("#messageJS").addClass("alert-danger");
                            $('#messageJS').html(pPostResponse.message);
                            hasError = true;
                        } else {
                            $("#messageJS").removeClass("alert-danger");
                            $("#messageJS").addClass("alert-success");
                            $('#messageJS').html("Fichier DGCL \"" + dgclFile.name + "\" importé avec succès.");
                        }
                        $('#messageJS').show();

                        if (!hasError) {
                            ajaxToBlockInit(pTargetURl);
                        } else {
                            ajaxDeleteInit(getGlobalVar('homeUrl'), pPostResponse.message);
                        }
                    });
            });
    }else{
        return false;
    }
}
function ajaxDeleteInit(pTargetURl, err){
    var modal = createBtpModal('prevent_reinit',sfTrans('erreur.modesaisie.flash'),err,{
        buttons:[
            {
                lbl:sfTrans("modal.btn.jaicompris"),
                attr:{
                    class:"btn btn-primary"
                },
                callbacks:{
                    click:function(){
                        var modal_footer = $(this).parent(':first');
                        addSpinner(modal_footer,'Traitement en cours',true);
                        $.ajax({
                            url: Routing.generate('bilan_social_delete_initialisation'),
                            method: 'POST',
                            async: true,
                            success: function (response) {
                                removeSpinner(modal_footer);
                                addSpinner(modal_footer,'Redirection en cours',true);
                                var url_home_init = Routing.generate('bilan_social_homepage');
                                window.location.replace(url_home_init);
                            },
                            complete: function(response){
                                removeSpinner(modal_footer);
                                closeBtpModal(modal);
                            }
                        });
                    }
                }
            }
        ],
        noClose : [
            {
                btn : false
            }
        ]
    });
    $(modal).modal({backdrop: 'static', keyboard: false});
    openBtpModal(modal);
}
function appendSpînner(appendTo){
    $(appendTo).append('<i class="bs-widget-spinner fa fa-spinner fa-pulse fa-2x fa-fw"></i>');
}
function removeSpînner(removeFrom){
    $('.bs-widget-spinner').hide();
    $(removeFrom).remove('.bs-widget-spinner');

}
function doOnManuActionClick(element) {

    if(check_if_actif(element)){
        if($(element).attr('id') == 'btn-conso'){
            fill_value(1, 0, 0, "manu"); //cons
        }else{
            fill_value(1, 0, 1, "manu"); //apa
        }

        _doSaveInitBS(
            function(pTargetURl) {
                window.location.replace(pTargetURl);
            });
    }else{
        return false;
    }
}
function doOnReinitBSClick() {
    appendSpînner('.modal-footer');
    $.ajax({
        url: Routing.generate('bilan_social_reinitialisation'),
        method: 'POST',
        async: true,
        success: function (response) {
            if (response.status === "success") {
                location.reload();
            }
            else {
                $("#importMsg").addClass("alert-danger");
                $('#importMsg').html(response.msg);
                $('#importMsg').show();
            }
        },
        complete: function(){
            removeSpînner('.modal-footer');
        }

    });
}
function doOnGenerateEmptyBSClick(element) {
    if(check_if_actif(element)){
        fill_value(0,0,0,"bs-vide");
        _doSaveInitBS(
            function(pTargetURl) {
                _bilanSocialVideWorkStep(" ", 0);
                $('#modal-bilan-social-vide-btn-close').attr('disabled', true);
                $('#BilanSocialVideMsg').hide();

                // Affichage de la modal d'information
                $('#modal-bilan-social-vide-action').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                // Début du traitement
                async.waterfall([
                        /**
                         * Appel de la fonction permettant de charger les agents provenant de la base temporaire
                         * @param pCallback
                         */
                        function (pCallback) {
                            appendSpînner('.modal-footer');
                            _bilanSocialVideWorkStep("Génération du bilan social à vide en cours... ", 40,
                                function () {
                                    pCallback(null);
                                });
                        },

                        /**
                         * Appel de la fonction permettant de charger les agents provenant de la base temporaire
                         * @param pCallback
                         */
                        function (pCallback) {
                            //pCallback(null, pCleanFileData);
                            $.post(Routing.generate('bilan_social_vide_generate'))
                                .progress(function (data) {
                                    console.log("progress post:" + data);
                                })
                                .done(function (response) {
                                    _bilanSocialVideWorkStep(null, 100,
                                        function () {
                                            //console.log("WhiteList items", jsonData);
                                            pCallback(null, response);
                                        });
                                })
                                .fail(function (jqxhr, textStatus, error) {
                                    pCallback(textStatus + ":" + error);
                                });
                        },
                        /**
                         * Affichage des infos extraites du fichier
                         * @param pCleanFileData
                         * @param pInfoData
                         * @param pCallback
                         */
                        /*function (pCleanFileData, pInfoData, pCallback) {
                            //console.log("cleaned file", pCleanFileData);
                            $("#modal-n4ds-action-siret").html(pInfoData.siret);
                            $("#modal-n4ds-action-dtdebut").html(pInfoData.dtDebutRef);
                            $("#modal-n4ds-action-dtfin").html(pInfoData.dtFinRef);
                            $("#modal-n4ds-action-nbagent").html(pInfoData.nbAgent);
                            var dureeSec = pInfoData.nbAgent / 50;
                            _n4dsWorkStep("Envoi du fichier nettoyé - durée approximative du traitement : " + Math.round(dureeSec) + " seconde(s)...", 0,
                                function () {
                                    pCallback(null, pCleanFileData);
                                });
                        },*/
                    ],
                    function (err, pPostResponse) {
                        _bilanSocialVideWorkStep(null, 100,
                            function () {
                                var hasError = false;
                                removeSpînner('.modal-footer');
                                if (err) {
                                    $("#BilanSocialVideMsg").addClass("alert-danger");
                                    $('#BilanSocialVideMsg').html('Une erreur est survenue, si le problème persiste, veuillez contacter votre administrateur.');
                                    hasError = true;
                                } else if (pPostResponse.msg != "Génération du bilan social à vide réussi") {
                                    $("#BilanSocialVideMsg").addClass("alert-danger");
                                    $('#BilanSocialVideMsg').html(pPostResponse.msg);
                                    hasError = true;
                                } else {
                                    $("#BilanSocialVideMsg").removeClass("alert-danger");
                                    $("#BilanSocialVideMsg").addClass("alert-success");
                                    $('#BilanSocialVideMsg').html(pPostResponse.msg);
                                }
                                $('#BilanSocialVideMsg').show();
                                // Goto on close
                                $('#modal-bilan-social-vide-btn-close').click(
                                    function () {
                                        if(!hasError){
                                            ajaxToBlockInit(pTargetURl);
                                        }else{
                                            ajaxDeleteInit(getGlobalVar('homeUrl'), pPostResponse.msg);
                                        }
                                    });
                                $('#modal-bilan-social-vide-btn-close').removeAttr('disabled');

                            });
                    });
            });
    }else{
        return false;
    }

}
function _bilanSocialVideWorkStep(pLabel, pStep, pCallback) {

    if (pLabel) {
        $("#modal-bilan-social-vide-action-label").html(pLabel);
    }
    if (pStep != null) {
        $("#modal-bilan-social-vide-action-slider").css("width", pStep + "%");
        $("#modal-bilan-social-vide-action-slider").html(pStep + "%");
    }
    if (pCallback) {
        setTimeout(pCallback, 50);
    }
}
function doOnBaseCarrActionClick(element) {
    if(check_if_actif(element)) {
        fill_value(1, 0, 1, "basecarr");
        _doSaveInitBS(
            function (pTargetURl) {
                _baseCarriereWorkStep(" ", 0);
                $('#modal-base-carriere-btn-close').attr('disabled', true);
                $('#importBaseCarriereMsg').hide();

                // Affichage de la modal d'information
                $('#modal-base-carriere-action').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                // Début du traitement
                async.waterfall([
                        /**
                         * Appel de la fonction permettant de charger les agents provenant de la base temporaire
                         * @param pCallback
                         */
                        function (pCallback) {
                            appendSpînner('.modal-footer');
                            _baseCarriereWorkStep("Chargement de la base carrière en cours... ", 40,
                                function () {
                                    pCallback(null);
                                });
                        },

                        /**
                         * Appel de la fonction permettant de charger les agents provenant de la base temporaire
                         * @param pCallback
                         */
                        function (pCallback) {
                            //pCallback(null, pCleanFileData);
                            $.post(Routing.generate('import_carriere_persist'))
                                .progress(function (data) {
                                    console.log("progress post:" + data);
                                })
                                .done(function (response) {
                                    _baseCarriereWorkStep(null, 100,
                                        function () {
                                            //console.log("WhiteList items", jsonData);
                                            pCallback(null, response);
                                        });
                                })
                                .fail(function (jqxhr, textStatus, error) {
                                    pCallback(textStatus + ":" + error);
                                });
                        },
                        /**
                         * Affichage des infos extraites du fichier
                         * @param pCleanFileData
                         * @param pInfoData
                         * @param pCallback
                         */
                        /*function (pCleanFileData, pInfoData, pCallback) {
                            //console.log("cleaned file", pCleanFileData);
                            $("#modal-n4ds-action-siret").html(pInfoData.siret);
                            $("#modal-n4ds-action-dtdebut").html(pInfoData.dtDebutRef);
                            $("#modal-n4ds-action-dtfin").html(pInfoData.dtFinRef);
                            $("#modal-n4ds-action-nbagent").html(pInfoData.nbAgent);
                            var dureeSec = pInfoData.nbAgent / 50;
                            _n4dsWorkStep("Envoi du fichier nettoyé - durée approximative du traitement : " + Math.round(dureeSec) + " seconde(s)...", 0,
                                function () {
                                    pCallback(null, pCleanFileData);
                                });
                        },*/
                    ],
                    function (err, pPostResponse) {
                        _baseCarriereWorkStep(null, 100,
                            function () {
                                var hasError = false;
                                removeSpînner('.modal-footer');
                                if (err) {
                                    $("#importBaseCarriereMsg").addClass("alert-danger");
                                    $('#importBaseCarriereMsg').html('Une erreur est survenue, si le problème persiste, veuillez contacter votre administrateur.');
                                    hasError = true;
                                } else if (pPostResponse.msg != "Import base carrière réussi") {
                                    $("#importBaseCarriereMsg").addClass("alert-danger");
                                    $('#importBaseCarriereMsg').html(pPostResponse.msg);
                                    hasError = true;
                                } else {
                                    $("#importBaseCarriereMsg").removeClass("alert-danger");
                                    $("#importBaseCarriereMsg").addClass("alert-success");
                                    $('#importBaseCarriereMsg').html(pPostResponse.msg);
                                }
                                $('#importBaseCarriereMsg').show();
                                // Goto on close
                                $('#modal-base-carriere-btn-close').click(
                                    function () {
                                        if (!hasError) {
                                            ajaxToBlockInit(pTargetURl);
                                        } else {
                                            ajaxDeleteInit(getGlobalVar('homeUrl'), pPostResponse.msg);
                                        }
                                    });
                                $('#modal-base-carriere-btn-close').removeAttr('disabled');

                            });
                    });
            });
    }else{
        return false;
    }
}
function _baseCarriereWorkStep(pLabel, pStep, pCallback) {
    //console.log("_baseCarriereWorkStep=", pStep);
    if (pLabel) {
        $("#modal-base-carriere-action-label").html(pLabel);
    }
    if (pStep != null) {
        $("#modal-base-carriere-action-slider").css("width", pStep + "%");
        $("#modal-base-carriere-action-slider").html(pStep + "%");
    }
    if (pCallback) {
        setTimeout(pCallback, 50);
    }
}