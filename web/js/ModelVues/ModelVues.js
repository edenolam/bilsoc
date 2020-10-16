$(document).ready(function(){
    $('#submit-modele').click(function(e){
        if ($('input[type=checkbox]:checked').length <= 0) {
            $('.alert.alert-success').hide();
            $('#messageJS').html('Vous devez sélectionner au moins une information à afficher au sein du tableau.');
            $('#messageJS').show();
            e.preventDefault();
        }
    });
});