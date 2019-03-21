$(document).ready(function () {

    $('.titleTask').click( function () {
        $(this).next('.insideTask').toggle('slow');
    });

});