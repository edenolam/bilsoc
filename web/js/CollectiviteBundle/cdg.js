$(document).ready(function () {
    $('input').removeAttr('readonly');
//    $('.toggle-dept').bootstrapToggle();
//    afficherDepartements();
    var button = '<td><button type="button" class="remove btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>';
    $('#add-contact').on('click', function () {
        /* get the number of lign tr inside the form  */
        var indexTr = $(document).find('.form8 tr:has(input)').length;
        if (indexTr !== 3) {
            indexTr += 1;
            /* get the prototype of the current form */
            var formLine = $('.form8').data('prototype');
            /* replace all __name__ in prototype by the current index */
            var newFormLine = formLine.replace(/__name__/g, indexTr)

            $('.form8').append('<tr>' + newFormLine + button + '</tr>');
            $(document).change();
        }
    });
    $(document).on('click', '.remove', function (e) {
        $(this).closest('tr').remove();
    });

    $('#select-cdg').change(function () {
        afficherDepartements();
        
        var val = $(this).val();
        if(val == 'default') {
            $('#modifier-dept').addClass('disabled');
        } else {
            $('#modifier-dept').removeClass('disabled');
        }
    });

    $('#modifier-dept').click(function (e) {
        if(!$(this).hasClass('disabled')) {
            var idCdg = $('#select-cdg').val();
            var checkboxes = [];
            $.each($('.toggle-dept'), function () {
                if ($(this).is(':checked')) {
                    checkboxes.push($(this).attr('id'));
                }
            });
            $.ajax({
                url: Routing.generate('cdg_enregistrer_departements_ajax'),
                data: {idCdg: idCdg, departements: checkboxes},
                method: 'POST',
                success: function (response) {
                    window.location.reload();
                }
            });
        } else {
            e.preventDefault(); 
        }
    });

    $('#recherche-dept').keyup(function () {
        parametre = $(this).val();
        tri(parametre);
    });

    $('form[name="bilan_social_bundle_collectivitebundle_cdg"]').submit(function (e) {

        $(document).change();
        var inputRadio = $('.form8').find('input:radio');
        var NbInput = inputRadio.length;
        var NbNoChecked = 0;
        var NbTr = $('.form8').find('tr');
        $(inputRadio).each(function () {
            if ($(this).is(':checked') === false) {
                NbNoChecked += 1;
            }
        })
        if (NbTr.length !== 0) {
            if (NbInput == NbNoChecked) {
                alert('aucun contact par défaut selectionné');
                e.preventDefault();
            }
        }





    });

    $(document).on('change', function (e) {

        var NbReferent = 0;

        $('div.referent-cdg > div > label > input').each(function () {
            if ($(this).prop('checked') === true) {
                NbReferent += 1;
            }
        });
        if (NbReferent > 1) {
            $('div.referent-cdg > div > label > input').each(function () {
                $(this).prop('checked', false);
//            $('#myModal').modal('show');
            });
        }

    });

    var RadioClicked = '';
    $('#mytable10').on('click', 'div.referent-cdg > div > label > input', function (event) {
        $(document).change();
        RadioClicked = $(this);
        $(RadioClicked).prop('checked', true);
    });
});

function afficherDepartements() {
    if($('#select-cdg').val() != 'default') {
        $('#dept-wrapper').hide();
        $('input[type=checkbox]').bootstrapToggle('off');
        var idCdg = $('#select-cdg').val();
        $.ajax({
            url: Routing.generate('cdg_infos_departements_ajax'),
            data: {idCdg: idCdg},
            method: 'POST',
            success: function (response) {
                var arr = JSON.parse(response);
                $.each(arr, function (k, v) {
                    $('#' + v).bootstrapToggle('on');
                });
                $('#dept-wrapper').show();
            }
        });
    } else {
        $('#dept-wrapper').hide();
    }
}

function tri(parametre) {
    if (parametre != '') {
        $("#table-cdg-dept tbody tr").each(function (index) {
            $row = $(this);
            arg = parametre.toLowerCase();
            var textTdTmp = $row.find("td:not(:last-child)").text();
            var textTd = textTdTmp.toLowerCase();

            if (textTd.indexOf(arg) < 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    } else {
        $("#table-cdg-dept tbody tr").show();
    }
}