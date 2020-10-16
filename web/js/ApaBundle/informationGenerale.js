
$('#bilan_social_bundle_apabundle_informationgenerale_agentremufonctionnaire').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationgenerale_agentremucontnonperm').addClass('hidden');
$('#bilan_social_bundle_apabundle_informationgenerale_agentremucontperm').addClass('hidden');
/* Gestion des totaux pour les tableaux dans les informations générales */
/* Tableau 3.1.1 */

//$('input').maskNumber({
//  thousands: ' '
//});

$(document).ready(function(){
    
    $('#save').modal().show();
    
    $('.r311h').on('blur', sumAndWriteTotal);
    $('.r311f').on('blur', sumAndWriteTotal);
    $('.r3111h').on('blur', sumAndWriteTotal);
    $('.r3111f').on('blur', sumAndWriteTotal);
    $('.r3112h').on('blur', sumAndWriteTotal);
    $('.r3112f').on('blur', sumAndWriteTotal);
    $('.r3113h').on('blur', sumAndWriteTotal);
    $('.r3113f').on('blur', sumAndWriteTotal);
    $('.r3114h').on('blur', sumAndWriteTotal);
    $('.r3114f').on('blur', sumAndWriteTotal);
    /* Tableau 3.2.1 */

    $('.r321h').on('blur', sumAndWriteTotal);
    $('.r321f').on('blur', sumAndWriteTotal);
    $('.r321h').on('blur', sumAndWriteTotal);
    $('.r321f').on('blur', sumAndWriteTotal);
    $('.r3211h').on('blur', sumAndWriteTotal);
    $('.r3211f').on('blur', sumAndWriteTotal);
    $('.r3214h').on('blur', sumAndWriteTotal);
    $('.r3214f').on('blur', sumAndWriteTotal);

    /* Tableau 3.3.1 */
    $('.r331h').on('blur', sumAndWriteTotal);
    $('.r331f').on('blur', sumAndWriteTotal);
    
    
    $('input').each(function () {
        $(this).trigger('blur');
    });
    
    $('form').submit(function(){
        $(this).find(':submit').attr('disabled','disabled');
    });

});
function sumAndWriteTotal(event){
        var total = sumColValueByIndex($(this));
        var total_class = $(this).attr('class');
        total_class = total_class.match(/r\d{3,}[a-zA-Z]{1}/);
        total_class = 'total'+total_class;
        $('.'+total_class).val(total);
}
function sumColValueByIndex(input){
        var col_index = $(input).parents('td:first').prop('cellIndex')+1;
        var sum = 0;
        $(input).parents('tbody:first').find('tr td:nth-child('+col_index+') input').each(function(){
            var temp_val = $(this).val().replace(/,/g, ".");

            sum += Number(temp_val);
        });
    return sum;
}
function sumInputsValueByClass(class_str){
        var sum = 0;
        $('.'+class_str).each(function(){
            var temp_val = $(this).val();
            sum += Number(temp_val);
        });
    return sum;
}