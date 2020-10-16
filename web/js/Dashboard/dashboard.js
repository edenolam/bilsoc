$(document).ready(function(){
    $('input:checkbox').trigger('click');
    $('.panel-body.slide-up').slideUp();
    $('#btn-dept').click(function(){
        var valDepts = $('.checkbox-dept:checked');
        var arrDepts = [];
        $.each(valDepts, function(){
            arrDepts.push($(this).val());
        });
        $('#charts-wrapper').html('<h4 style=\'text-align:center\'><i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Chargement des données en cours</h4>');
        $.ajax({
            url: Routing.generate('dashboard_enquete_departements'),
            method: 'POST',
            dataType: 'json',
            data: {'departements':arrDepts},
            async: true,
            success: function (response) {
                $('#charts-wrapper').html(response['template']);
                loadCharts(response['compteurBs'],response['compteurEff'],response['nbBsTransmis'],response['nbEnCours'],response['nbValid'],response['nbNonValid'],response['nbEnCoursNonValid'],response['nbNvelleTrans'],response['nbNonConn'],response['nbNonSaisi'],response['nbReinit']);
                $('.panel-body.slide-up').slideUp();
                $('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                if(!isEmpty(response['urlMap'])){
                    //loadMap(response['urlMap']);
                }else{
                    var msg_map = isset(response['msg_map']) ? response['msg_map'] : 'Aucune données à charger';
                    //$('#map').html(msg_map);
                }
                
            }
        });
    });
    
    $('.checkbox-all-dept').click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    
    $(document).on('click', '.panel-heading span.clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body.slide-up').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            $this.parents('.panel').find('.panel-body.slide-up').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    })
});