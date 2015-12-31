$(function(){
	delete_post();
});
function delete_post() {
	$('.delete').click(function(){
		if (window.confirm("Bạn Có Chắc Muốn Xóa Bài Này?")) {
			var url = '<?=base_url()?>user/delete_post';
			var idPost = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: url,
				data: {idPost: idPost},
				dataType: "json",
				success: function(data){
					console.log('delete successfully');
					$('#row_'+idPost).remove();
				},
				error: function(){
					alert('error');
				}
			});
		}
	});
}