jQuery(document).ready(function($) {
    jQuery('ul.sf-menu').superfish();

    $('.tableWrapper tr').hover(
            function() {
                $(this).addClass('row_hover');
            },
            function() {
                $(this).removeClass('row_hover');
            }
    );

    $("input[type=submit], button, .uibutton").button();

    $('span.custom.radio').on('click', 'a', function() {
        if ($(this).parents('span').hasClass('checked')) {
            $(this).parents('span').removeClass('checked');
        } else {
            $(this).parents('span').addClass('checked');
        }
    });

    $("#tabs").tabs({cookie: {}});
});