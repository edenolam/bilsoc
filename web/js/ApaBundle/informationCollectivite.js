$(document).ready(function(){
   
      /* Gestion affichages des questions collectivité */
    $(document).on('click', '.panel-heading span.clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    });
    $('.calculTot').on('change', function(e){
        calculTotaux($(this));
    });

    init217();

    $('.calculTot').trigger('change');

    
});

function  calculTotaux(element) {
    var dataName = $(element).data('name');

    var inputsToCalcul = $(document).find("[data-name='" + dataName + "']");
    var total_temp = 0;
    inputsToCalcul.each(function() {
        var value = $( this ).val();
        if(value == ""){
            value = 0;
        }
        total_temp += parseInt(value);
    });
     if(total_temp == ""){
         total_temp = 0;
     }
    $('.'+dataName+'_tot').html(total_temp);

}
function init217(){
    var inputs = $('.ind217').find('input:checked');
    if(inputs.length !== 0){
        inputs.each(function(){
            showhideField217($(this));
        });
    }
}
function showhideField217(element){
    var data_name = $(element).parents('.ind217').data('name');
    if($(element).val() === "1"){
        $('.'+data_name).removeClass('hidden');
        $('.'+data_name).parents('tr:first').removeClass('hidden');
    }else{
        $('.'+data_name).addClass('hidden');
        $('.'+data_name).find('input:checked').prop('checked',false);
        $('.'+data_name).parents('tr:first').addClass('hidden');
    }
}

    
   