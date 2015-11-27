$(function(){
    loadImg();
    // fsubmit();
});
function loadImg() {
    $("#upload-file").change(function(){
        readURL(this);
    });
}

function readURL(input) {
    if (input.files[0]) {
        var selector = '#preview';
        $(selector).empty();
            var ext = input.files[0].name.split('.').pop().toLowerCase();
            var size = input.files[0].size;
            if(size < 1000000 && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(selector).append('<img src="' + e.target.result + '">');
                }
                reader.readAsDataURL(input.files[0]);
            }

    }
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