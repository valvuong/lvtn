$(function() {
    getWard();
//    reload();
    loadImg();
//    bigView();
    goTop();
//    delCook();
    datepicker();
//    priceEvent();
//    prePay();
});

function submitPost() {
    $('#postNews').submit(function(){
        var title = $('#title').val();
    });
}

function prePay(){
    $('#prePay').change(function(){
        if($(this).is(':checked')) $('#monRe').attr('disabled',false);
        else $('#monRe').attr('disabled',true);
    });
}

function priceEvent() {
    $('#price').on('change keyup',function(){
        var p = $(this).val();
        var price = parseFloat(p);
        if (!isNaN(price) && price != 0) {
            formatPrice = price * 1000000;
            $('#pri').text(formatNumber(formatPrice));
            $('#priceEx').show();
        } else {
            $('#pri').text('');
            $('#priceEx').hide();
        }
    });
}

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function datepicker() {
    $('#datepicker').datepicker({
        changeMonth: true,
        minDate: 0,
        dateFormat: 'dd-mm-yy',
        showAnim: 'slideDown'
    });
}

function sort(val) {
    setCookie("sort", val, 1);
    var url = $(location).attr('href');
    window.location = url;
}

function delCook() {
    $('.menu a').each(function(){
        $(this).click(function(){
            setCookie("sort","",-1);
        });
    });
}

function getWard() {
    var a = $("#district option:selected").val();
    showWard(a);
}

function showWard(code) {
    $.ajax({
       type: 'GET',
       url: '',
       data: 'q='+code
    }).done(function(data){
        $("#ward").empty();
        var foo = $.parseJSON(data);
        $.each(foo, function(key, value){
            $('<option>').val(key).text(value).appendTo('#ward');
        });
    });
}

function reload() {
    $('#reload').click(function(e){
        $('#captcha').attr('src','modules/CaptchaSecurityImages.php');
        e.preventDefault();
    });
}

function loadImg() {
    $("#uploadFile").change(function(){
        $('#preview').empty();
        readURL(this);
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var n = input.files.length;
        n = n > 8 ? 8:n;
        for(i = 0; i < n; i++) {
            var ext = input.files[i].name.split('.').pop();
            var size = input.files[i].size;
            if(size < 1000000 && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').append('<img src="' + e.target.result + '">');
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
    }
}

function bigView() {
    var firstLabel = '.smallGallery > label:first-child';
    var a = $(firstLabel).attr('for');
    $('.bigView input:radio').each(function(){
        if($(this).is('#'+a)) $(this).attr('checked', true);
    });
    $(firstLabel + ' img').addClass('smallGa');

    $('.smallGallery label').click(function(){
        $('.smallGallery label').each(function(){
            $(this).find('img').removeClass('smallGa');
        });
        $(this).find('img').addClass('smallGa');
    });
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

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}