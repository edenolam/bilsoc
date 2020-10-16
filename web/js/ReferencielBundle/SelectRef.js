$(document).ready(function ()
{

    $('select').on('change', function () {
        var route = this.value;
        if (route != 0) {
            $.ajax({
                type: "POST",
                url: Routing.generate(route),
                async: true,
                success: function (response) {
                    $('#result').html(response);
                }
            })
        }

    })
    $(document).on('click', "button", function (event) {



        event.preventDefault();


        var route = this.value;

        var param = this.getAttribute("data-param");
        var value = this.getAttribute("data-param-value");

        var MonObject = {};

        MonObject[param] = value;



        $.ajax({
            type: "GET",
            url: Routing.generate(route, MonObject),
            async: true,
            success: function (response) {
                $('#result').html(response);
            }
        })

    });



});