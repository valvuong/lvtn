$(function() {
    goTop();
    menuTask();
    clickDropdown();
    clickTask();
    header();
});

function menuTask() {
    var firstLiHeight = $('nav ul li:first-child').height();
    //var firstLiWidth = $('nav ul li:first-child').width();
    var nav = 'nav ul li.task > a';
    var navPadding = $(nav).css('padding-top');
    $(nav).height(parseInt(firstLiHeight)-2*parseInt(navPadding)+'px');
    //$(nav).css({"box-sizing": "border-box"});
}

function header() {
    var navheight = $('nav').height();
    $('header.header').css({"margin-top": navheight+"px"});
}

function clickDropdown() {
    var selector = '.drop-down-menu';
    var a = $(selector);
    a.on("click", function() {
        $(this).children("ul").toggleClass("open-ul");
    });
    //$(document).click(function(e) {
    //    if(!a.is(e.target) && a.has(e.target).length === 0) {
    //        a.children("ul").removeClass("open-ul");
    //    }
    //});
    $(document).on('click', function (e) {
        if ($(e.target).closest(selector).length === 0) {
            a.children("ul").removeClass("open-ul");
        }
    });
}

function clickTask() {
    var selector = '.task';
    var a = $(selector);
    a.on("click", function() {
        $(this).children("ul").toggleClass("open-task");
    });
    $(document).on('click', function (e) {
        if ($(e.target).closest(selector).length === 0) {
            a.children("ul").removeClass("open-task");
        }
    });
}

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function goTop() {
	var top = $('#gotop');
    $(window).scroll(function(){
        if($(this).scrollTop() != 0) {
            $(top).fadeIn();
        } else {
            $(top).fadeOut();
        }
    });
    $(top).click(function(e){
        $('body,html').animate({scrollTop: 0}, 500);
        e.preventDefault();
    });
}