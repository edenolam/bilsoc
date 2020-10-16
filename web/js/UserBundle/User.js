$(document).ready(function () {

    $('.btn-reinit').click(function () {
        var identifiant = $('#identifiant').val();
        if ('' != identifiant) {
            $.ajax({
                url: Routing.generate('reset_password_ajax'),
                method: 'POST',
                data: {'identifiant': identifiant},
                async: true,
                success: function (response) {
//                    console.log(response);
                    if ('no_id' == response.data) {
                        if($('#messageJS').hasClass('alert-success')) {
                            $('#messageJS').removeClass('alert-success');
                        }
                        $('#messageJS').addClass('alert-danger');
                        $('#messageJS').html("Pour réinitialiser votre mot de passe, vous devez indiquer votre identifiant.");
                        $('#messageJS').show();
                    } else if ('no_email' == response.data) {
                        if($('#messageJS').hasClass('alert-success')) {
                            $('#messageJS').removeClass('alert-success');
                        }
                        $('#messageJS').addClass('alert-danger');
                        $('#messageJS').html(response.message);
                        if (response.infocdg !== null) {
                            $('#messageCDG').html('');
                            response.infocdg.forEach(inFoCdgFunction)
                            $('#messageCDG').show();
                        }
                        $('#messageJS').show();
                    } else {
                        if($('#messageJS').hasClass('alert-danger')) {
                            $('#messageJS').removeClass('alert-danger');
                        }
                        $('#messageJS').addClass('alert-success');
                        $('#messageJS').html(response.message);
                        $('#messageJS').show();
                    }
                }
            });
        } else {
            $('#messageJS').addClass('alert alert-danger fade in');
            $('#messageJS').html("Pour réinitialiser votre mot de passe, vous devez indiquer votre identifiant.");
            $('#messageJS').show();
        }
    });
    $('.btn-dismiss').click(function () {
        $('#messageJS').hide();
        $('#identifiant').val('');
    });
    
    $("#reinit_account_password_first, #password_reset_password_first").on('keyup', changePasswordProgressBar);
    $("#change_password_password_first, #change_password_password_second").on('keyup', changePasswordProgressBar);
    $('#btn-reset-psw').click(function(e){
        if($('#password_reset_password_first').val() != ''){
            $('#errorPsw').hide();
            var pswStrength = $('#password-progress-bar').attr('aria-valuenow');
            pswStrength = parseInt(pswStrength);
            if(pswStrength < 100){
                $('#errorPsw').show();
                e.preventDefault();
            }
        }
//        if($('#change_password_password_first').val() != ''){
//            $('#errorPsw').hide();
//            var pswStrength = $('#password-progress-bar').attr('aria-valuenow');
//            pswStrength = parseInt(pswStrength);
//            
//            
//            if(pswStrength < 100 || ($('#change_password_oldPassword').val() === $('#change_password_password_first').val() ) ){
//                $('#errorPsw').show();
//                e.preventDefault();
//            }
//        }
        
    });
    $('#reinit-account').click(function(e){
        if($('#reinit_account_password_first').val() != ''){
            $('#errorPsw').hide();
            var pswStrength = $('#password-progress-bar').attr('aria-valuenow');
            pswStrength = parseInt(pswStrength);
            if(pswStrength < 100){
                $('#errorPsw').show();
                e.preventDefault();
            }
        }
    });

    function inFoCdgFunction(item, index) {
        divCDG = document.getElementById("messageCDG");
        if (index % 5 === 0 && index !== 0) {
            divCDG.innerHTML = divCDG.innerHTML + "--------------------------------------------------------------------------- <br>";
        }

        divCDG.innerHTML = divCDG.innerHTML + item + "<br>";
    }
});