$(function(){
    editor();
    preview();
    price();
});

function editor() {
    CKEDITOR.replace( 'ad-content' );
    CKEDITOR.config.height = '400px';
    CKEDITOR.config.removePlugins = 'image';
}

function preview() {
    var selector = "#market_upload";
    $(selector).change(function(){
        readURL(this);
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var selector = '#preview';
        var n = input.files.length;
        n = n > 8 ? 8:n;
        $(selector).empty();
        for(i = 0; i < n; i++) {
            var ext = input.files[i].name.split('.').pop();
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

function price() {
    $('#ad-price').on('change keyup',function(){
        var p = $(this).val();
        var price = parseFloat(p);
        if (!isNaN(price) && price != 0) {
            formatPrice = price * 1000000;
            $('#pri').text(formatNumber(formatPrice));
        } else {
            $('#pri').text('');
        }
    });
}