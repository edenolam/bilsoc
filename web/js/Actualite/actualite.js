$(document).ready(function () {
    var table = $('#cdgs').DataTable(
            {
                "order": [],
                "columns": [
                    {"sortable": false},
                    {"sortable": false},
                ],
                language: {
                    processing: "Traitement en cours...",
                    search: "Rechercher&nbsp;:",
                    lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                    info: "Affichage centre de gestion _START_ &agrave; _END_ sur _TOTAL_ centre de gestions",
                    infoEmpty: "Affichage centre de gestion 0 &agrave; 0 sur 0 centre de gestions",
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
                }
            }
    );
    $('#table-actualite-en-cours').DataTable(
            {
                "lengthMenu": [5, 10, 15, 20],
                "pageLength": 5,
                "order": [],
                "columns": [
                    {"sortable": false},
                    {"sortable": false},
                    {"sortable": true},
                    {"sortable": true},
                    {"sortable": false},
                    {"sortable": false}
                    ,
                ],
                language: {
                    processing: "Traitement en cours...",
                    search: "Rechercher&nbsp;:",
                    lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                    info: "Affichage actualité _START_ &agrave; _END_ sur _TOTAL_ actualités en cours",
                    infoEmpty: "Affichage actualité 0 &agrave; 0 sur 0 actualités en cours",
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
                }
            }
    );
    $('#table-actualite-passe').DataTable(
            {
                "lengthMenu": [5, 10, 15, 20],
                "pageLength": 5,
                "order": [],
                "columns": [
                    {"sortable": false},
                    {"sortable": false},
                    {"sortable": true},
                    {"sortable": true},
                    {"sortable": false},
                    {"sortable": false}
                    ,
                ],
                language: {
                    processing: "Traitement en cours...",
                    search: "Rechercher&nbsp;:",
                    lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                    info: "Affichage actualité _START_ &agrave; _END_ sur _TOTAL_ actualités passées",
                    infoEmpty: "Affichage actualité 0 &agrave; 0 sur 0 actualités passées",
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
                }
            }
    );
    $('#table-actualite-futur').DataTable(
            {
                "lengthMenu": [5, 10, 15, 20],
                "pageLength": 5,
                "order": [],
                "columns": [
                    {"sortable": false},
                    {"sortable": false},
                    {"sortable": true},
                    {"sortable": true},
                    {"sortable": false},
                    {"sortable": false}
                    ,
                ],
                language: {
                    processing: "Traitement en cours...",
                    search: "Rechercher&nbsp;:",
                    lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                    info: "Affichage actualité _START_ &agrave; _END_ sur _TOTAL_ actualités à venir",
                    infoEmpty: "Affichage actualité 0 &agrave; 0 sur 0 actualités à venir",
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
                }
            }
    );

    var cpt = 0;
    var cptTotal = 0;
    table.$('input[type="checkbox"]').each(function () {

        cptTotal++;

        if (this.checked) {
            cpt++;
        }


    });

    if (cpt === cptTotal) {
        $('.all').prop('checked', true);
    } else {
        $('.all').prop('checked', false);
    }


    $('.all').on('change', function () {

        if (this.checked) {
            $('#listeCdg input[type="checkbox"]').each(function () {
                $(this).prop('checked', true);
                table.$('input[type="checkbox"]').each(function () {

                    $(this).attr('checked', 'false')
                    // If checkbox doesn't exist in DOM
                    if (!$.contains(document, this)) {
                        $(this).prop('checked', true);
                    }
                });
            });
        } else {
            $('#listeCdg input[type="checkbox"]').each(function () {
                $(this).prop('checked', false);
                table.$('input[type="checkbox"]').each(function () {

                    $(this).attr('checked', 'false')
                    // If checkbox doesn't exist in DOM
                    if (!$.contains(document, this)) {

                        $(this).prop('checked', false);

                    }
                });

            });
        }
        ;
    });

    $('form').on('submit', function (e) {
        var $form = $(this);
        // Iterate over all checkboxes in the table


        table.$('input[type="checkbox"]').each(function () {
            // If checkbox doesn't exist in DOM
            if (!$.contains(document, this)) {
                // If checkbox is checked
                if (this.checked) {
                    // Create a hidden element
                    $form.append(
                            $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', this.name)
                            .val(this.value)
                            );
                }
            }
        });
    });

});