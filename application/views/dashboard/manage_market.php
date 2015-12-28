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
					<th>Chỉnh Sửa</th>
					<th>Xóa</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($content as $k => $v): ?>
					<tr id="row_<?=$v['id']?>">
						<td class="text-center"><?=$k+1?></td>
						<td><a href="<?=site_url($v['id'].'-tin-vat')?>"><?php echo $v['tieude'] ?></a></td>
						<td class="text-center"><button><i class="fa fa-wrench"></i></button></td>
						<td class="text-center"><button class="delete" id="<?=$v['id']?>"><i class="fa fa-times"></i></button></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		delete_market();
	})
	function delete_market() {
		$('.delete').click(function(){
			var url = '<?=base_url()?>user/delete_market';
			var idMarket = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: url,
				data: {idMarket: idMarket},
				dataType: "json",
				success: function(data){
					console.log('delete successfully');
					$('#row_'+idMarket).remove();
				},
				error: function(){
					alert('error');
				}
			});
		});
	}
</script>