$(function(){
    getfilter();
    showmore();
});

function getfilter() {
    $("input[type='radio']").change( function() {
        var data = {};
        data['category'] = $("input[name='category']:checked").val();
        data['area'] = $("input[name='area']:checked").val();
        data['price'] = $("input[name='price']:checked").val();
        data['district'] = $("input[name='district']:checked").val();

            $.ajax({
                type    : "POST",
                url     : 'filter/filter',
                data    : {data:data},
                success: function(result){                        
                    $('#content').html(result);
                }
            });
    });
}

function showmore() {
    $(document).on('click','.show_more',function(){
        var data = {};
        data['category'] = $("input[name='category']:checked").val();
        data['area'] = $("input[name='area']:checked").val();
        data['price'] = $("input[name='price']:checked").val();
        data['district'] = $("input[name='district']:checked").val();
        var page = $(this).attr('id');
        var add = 'filter/filter' + '/' +page;
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url: add,
            data: {data:data},
            success:function(result){
                $('#show_more_main'+page).remove();
                $('#content').append(result);
            }
        }); 
    });
}