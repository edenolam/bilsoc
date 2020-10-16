/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 /*Fonction permettant de bloquer tout caractere spéciaux ainsi que les chiffres dans les inputs Text*/
   $(document).on('keydown', '.text', function (e) {
       var key = e.keyCode;
      if ( e.ctrlKey || e.altKey || (key === 18)) {
        e.preventDefault();
      } else {

        if (!((key === 8) || (key === 50) || (key === 55) || (key === 57) || (key === 32) || ( key === 9 ) || (key === 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
          e.preventDefault();
        }
      }
   });

   $(document).on('keypress', "input", function (e) {

            if ($(this).hasClass('positiveFloat')) {
                if (e.which !== 8 && e.which !== 0 && e.which !== 46 && e.which !== 44 && (e.which < 48 || e.which > 57)) {
                    e.preventDefault();
                }
            } else if ($(this).hasClass('positiveInteger')) {

                if($(this).hasClass('tel')){
                    if (e.which !== 8 && e.which !== 0 && e.which !== 107 && (e.which < 48 || e.which > 57) && e.which !== 43){
                        e.preventDefault();
                    }
                }else{
                    if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
                        e.preventDefault();
                    }
                }
               
            } else if ($(this).hasClass('positiveFloatRounded')) {

                if (e.which !== 8 && e.which !== 0 && e.which !== 46 && e.which !== 44 && (e.which < 48 || e.which > 57)) {

                    e.preventDefault();
                }
            } else if ($(this).hasClass('positiveFloat025Rounded')) {

                if (e.which !== 8 && e.which !== 0 && e.which !== 46 && e.which !== 44 && (e.which < 48 || e.which > 57)) {

                    e.preventDefault();
                }
            } else if ($(this).hasClass('positiveFloat010Rounded')) {

                if (e.which !== 8 && e.which !== 0 && e.which !== 46 && e.which !== 44 && (e.which < 48 || e.which > 57)) {

                    e.preventDefault();
                }
            } else if ($(this).hasClass('positiveFloat010Rounded')) {
                if (e.which !== 8 && e.which !== 0 && e.which !== 46 && e.which !== 44 && (e.which < 48 || e.which > 57)) {
                    e.preventDefault();
                }
            } else if ($(this).hasClass('positiveFloatRoundedIntegerUp')) {
                if (e.which !== 8 && e.which !== 0 && e.which !== 46 && e.which !== 44 && (e.which < 48 || e.which > 57)) {
                    e.preventDefault();
                }
            };
            return true;

        });



/*Cette fonction permet d'arrondir au chiffre le plus près y compris les 0.5 eg: 7.8 = 8 ou 7.4 = 7.5 ou 7.2 = 7*/
    function roundStep(value, step, up) {

        var res = value.replace(/,/g, ".");

        step || (step = 1.0);
        var inv = 1.0 / step;
        if(up === 1){
             return Math.ceil(res * inv) / inv;
        }else{
             return Math.round(res * inv) / inv;
        }

    }

    $(document).on('blur', 'input',  function (e) {

            if ($(this).hasClass('positiveFloat')) {
                if (e.which !== 8 && e.which !== 0 && e.which !== 46 && e.which !== 44 && (e.which < 48 || e.which > 57)) {
                    return false;
                } else {
                    var res = $(this).val().replace(/,/g, ".");
                    var RoundedNumber = (Math.round(res * 100) / 100).toFixed(2)
                    if (!isNaN(RoundedNumber)) {
                        $(this).val(RoundedNumber);
                    }else{
                        $(this).val('');
                    }
                }
            } else if ($(this).hasClass('positiveInteger')) {
                if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {

                    return false;
                }

            } else if ($(this).hasClass('positiveFloatRounded')) {
               var RoundedNumber = roundStep($(this).val(), 0.5);

                 if (!isNaN(RoundedNumber)) {
                        $(this).val(RoundedNumber);
                    }else{
                        $(this).val('');
                    }
            } else if ($(this).hasClass('positiveFloat025Rounded')) {
               var RoundedNumber = roundStep($(this).val(), 0.25);

                 if (!isNaN(RoundedNumber)) {
                        $(this).val(RoundedNumber);
                    }else{
                        $(this).val('');
                    }
            } else if ($(this).hasClass('positiveFloat010Rounded')) {
               var RoundedNumber = roundStep($(this).val(), 0.1);

                 if (!isNaN(RoundedNumber)) {
                        $(this).val(RoundedNumber);
                    }else{
                        $(this).val('');
                    }
            }
            else if ($(this).hasClass('positiveFloat001Rounded')) {
               var RoundedNumber = roundStep($(this).val(), 0.01);

                 if (!isNaN(RoundedNumber)) {
                        $(this).val(RoundedNumber);
                    }else{
                        $(this).val('');
                    }
            }
            else if ($(this).hasClass('positiveFloatRoundedIntegerUp')) {

                var RoundedNumber = roundStep($(this).val(), 1.0, 1);

                 if (!isNaN(RoundedNumber)) {
                        $(this).val(RoundedNumber);
                    }else{
                        $(this).val('');
                    }
            }
    });
    
    $(document).ready(function(e){
        var targets = $('.panel-body');
        var config = { childList:true };
        $(targets).each(function(k,target){
            // Create an observer instance linked to the callback function
            var observer = new MutationObserver(function(mutations){
                for(var mutation of mutations) {
                    if (mutation.type == 'childList') {
                        initRoundInput(target);
                        break;
                    }
                }
            });
            // Start observing the target node for configured mutations
            observer.observe(target, config);
        });
    })
    function initRoundInput(root_element){
        $(root_element).find('input').trigger('blur');
    }


$(document).on('keydown', function (e) {
        //bloque la touche entrée (13) et la touche Echap (27) sur tout le document !!
         if (e.which === 27) {
             e.preventDefault();
         }
});

$('.workinprogress').click(function(){
    $('#workInProgress').modal({backdrop: 'static', keyboard: false}).show();
});

$('.workinprogressMdpUpdate').click(function(){
    $('#workinprogressMdpUpdate').modal({backdrop: 'static', keyboard: false}).show();
});

