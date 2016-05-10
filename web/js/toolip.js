yii.gii = (function ($) {

    var initHintBlocks = function () {
        $('.hint-block').each(function () {
            var $hint = $(this);
            $hint.parent().find('label').addClass('help').popover({
                html: true,
                trigger: 'hover',
                placement: 'top',
                content: $hint.html()
            });
        });
    };

    return {
        init: function () {
            initHintBlocks();
        }
    };
})(jQuery);

var initHintBlocksXiaolu = function () {
    $('.hint-block').each(function () {
        var $hint = $(this);
        $hint.parent().find('label').addClass('help').popover({
            html: true,
            trigger: 'hover',
            placement: 'top',
            content: $hint.html()
        });
    });
};

// get current URL path and assign 'active' class
var pathname = window.location.pathname+window.location.search;
$('#nav-left-menu  a[href="'+pathname+'"]').addClass('a-active').parent().parent('ul').addClass('in').attr('aria-expanded', true);

$('#login-dropdown').click(function () {
    var open = $(this).hasClass('open');
    if (open) {
        $(this).removeClass('open');
    }else {
        $(this).addClass('open');
    }
});