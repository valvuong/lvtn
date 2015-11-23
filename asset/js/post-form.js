$(function(){
    getWard();
    loadImg();
    editor();
    priceEvent();
    prePay();
    datepicker();
    selectepicker();
    // fsubmit();
});

function datepicker() {
    $('#expired_date').bootstrapMaterialDatePicker({
        time: false,
        format : 'DD-MM-YYYY',
        minDate : new Date()
    });
}

function selectepicker() {
    $('.selectpicker').selectpicker({
        size: 6
    });
}

function prePay(){
    var mon_re = '#mon_re';
    var pre_pay = '#pre_pay';
    $(pre_pay).change(function(){
        if($(this).is(':checked')) $(mon_re).attr('disabled',false);
        else $(mon_re).attr('disabled',true);
    });
    if($(pre_pay).is(':checked')) $(mon_re).attr('disabled',false);
}

function getWard() {
    var a = $("#district option:selected").val();
    showWard(a);
}

function showWard(code) {
    var url = $('#url_ajax').val();
    $.ajax({
        type: "POST",
        url: url,
        data: {q: code},
        dataType: "json",
        success: function(data) {
            var ward = "#ward";
            $(ward).empty();
            $.each(data, function(key, value){
                $('<option>').val(key).text(value).appendTo('#ward');
            });
            $(ward).selectpicker("refresh");
        },
        error: function() {
            alert('error');
        }
    });
}

function loadImg() {
    $("#upload-file").change(function(){
        readURL(this);
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var selector = '#preview';
        var n = input.files.length;
        n = input.files.length;
        $(selector).empty();
        for(i = 0; i < n; i++) {
            var ext = input.files[i].name.split('.').pop().toLowerCase();
            var size = input.files[i].size;
            if(size < 1000000 && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(selector).append('<img src="' + e.target.result + '">');
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
}

function editor() {
    CKEDITOR.replace("content_post");
    CKEDITOR.config.removePlugins = 'image';
    CKEDITOR.config.height = '400px';
}

function priceEvent() {
    $('#price').on('change keyup',function(){
        var p = $(this).val();
        var price = parseFloat(p);
        if (!isNaN(price) && price != 0) {
            formatPrice = price * 1000000;
            $('#pri').text(formatNumber(formatPrice));
            //$('#priceEx').show();
        } else {
            $('#pri').text('');
            //$('#priceEx').hide();
        }
    });
}

function checkUpload() {
    var selector = "#upload-file";
    if(!$(selector).val()) {
        return false;
    }
    return true;
}

function fsubmit() {
    $('input[type=submit]').click(function() {
        if(checkUpload()) {
            $('form').submit();
            return true;
        } else {
            var tooltipSelector = $('#upload-label');
            tooltipSelector.tooltip({
                title: 'Hãy tải hình lên',
                placement: 'top'
            });
            tooltipSelector.tooltip('show');
            $(window).scrollTop(tooltipSelector.offset().top-150);
            setTimeout(function(){tooltipSelector.tooltip('hide')},2000)
            return false;
        }
    });
}