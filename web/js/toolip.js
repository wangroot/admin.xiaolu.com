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
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

// get current URL path and assign 'active' class

var params = encodeURIComponent(getParameterByName('r'));
if(params){
    var pathname = window.location.pathname+'?r='+params;
    $('#menu-content  a[href="'+pathname+'"]').addClass('a-active');
}else {
    $('#menu-content .admin-home').addClass('a-active');
}

$(function () {
    $('#dropdown-menu-click').click(function () {

        var open = $(this).hasClass('open');
        if (open) {
            $(this).removeClass('open');
            $(this).find('.dropdown-menu').css("display", "none");
        }else {
            $(this).addClass('open');
            $(this).find('.dropdown-menu').css({"display":"block", "top": "48px"});
        }
    });

    $("#user-logout").click(function () {
        var $this = $(this);
        var url = $this.attr('data-url');
        var value = $this.attr('data-param');
        $.ajax({
            type: "POST",
            url: url,
            data: {_csrf:value},
            success: function () {

            },
            dataType: "json"
        });
    });
});