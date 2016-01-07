<head>
	<script type="text/javascript">
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
	</script>
</head>

<style type="text/css">
	table.table tr th{
		text-align: center;
	}
</style>

<div class="col-lg-12">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tiêu Đề</th>
					<th>Xóa</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($content as $k => $v): ?>
					<tr id="row_<?=$v['id']?>">
						<td class="text-center"><?=$k+1?></td>
						<td><a href="<?=site_url('tin-'.$v['id'])?>"><?php echo $v['tieude'] ?></a></td>
						<td class="text-center"><button class="delete" id="<?=$v['id']?>"><i class="fa fa-times"></i></button></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>