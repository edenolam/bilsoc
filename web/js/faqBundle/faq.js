$(document).ready(function () {


    $("#categoriesSelect").on('change', function () {
        categorie = $(this).val();
        $('#bilan_social_bundle_faqbundle_faq_categorie').val(categorie);
    });

    $("#categoriesInput").on('change', function () {
        categorie = $(this).val();
        $('#bilan_social_bundle_faqbundle_faq_categorie').val(categorie);
    });

    $('#bilan_social_bundle_faqbundle_faq_existCategorie :input').on('change', function () {
        var value = $(this).val();
        if (value === '1') {
            $('.categoriesInput').addClass('hidden');
            $('.categorieExist').removeClass('hidden');
        } else if (value === '0') {
            $('.categorieExist').addClass('hidden');
            $('.categoriesInput').removeClass('hidden');
        }
    })


    $('#search').click(function (e) {
        var filter = $('#searchSelect').val();
        var value = $('#inputSearch').val();

        var object = {
            'value': value,
            'filter': filter
        }
        var url = Routing.generate('faq_search_client', object);

        window.location.href = url;
    });
    
    $('.readFaq').on('click', function() {
        $(this).find('span').toggleClass('buttonplus buttonmoins');
    });
    
    $('#bilan_social_bundle_faqbundle_import_excel_faq_document_file').on('change', function() {
        if($('#bilan_social_bundle_faqbundle_import_excel_faq_document_file').val() != '') {
            $('#bilan_social_bundle_faqbundle_import_excel_faq_importer').attr('disabled', false);
        }
    });
    
    $('#bilan_social_bundle_faqbundle_import_excel_faq_importer').on('click', function() {
        var modal_footer = $('#bilan_social_bundle_faqbundle_import_excel_faq_importer').closest('.modal-footer');
        addSpinner($(modal_footer),'Traitement en cours',true);
    });
});

function sendFaq() {
    var test = $('.categoriesInput').hasClass('hidden');

    if(test== false && $('#categoriesInput').val() == "") alert('Catégorie obligatoire');


}
