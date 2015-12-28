<style type="text/css">
	table.table tr th,
	table.table tr td {
		text-align: center;
	}
</style>

<?php if($this->muser->is_admin()): 
$gender = array('Nam', 'Nữ');
?>
<div class="col-lg-12">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>STT</th>
					<th>Username</th>
					<th>Email</th>
					<th>Tên</th>
					<th>Giới Tính</th>
					<th>Địa Chỉ</th>
					<th>Role</th>
					<th>Xóa</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($content as $k => $v): ?>
					<tr id="row_<?=$v['idUser']?>">
						<td><?=$k+1?></td>
						<td><?=$v['username']?></td>
						<td><?=$v['email']?></td>
						<td><?=$v['name']?></td>
						<td><?php echo $v['sex'] == null?'':$gender[$v['sex']] ?></td>
						<td><?=$v['address']?></td>
						<td class="double-click">
							<?=$v['role']?>
						</td>
						<td>
						<?php if($v['role'] != 'ROLE_ADMIN'): ?>
							<button class="delete" id="<?=$v['idUser']?>"><i class="fa fa-times"></i></button>
						<?php endif ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?php endif ?>

<script type="text/javascript">
	$(function(){
		delete_user();
	});
	function delete_user() {
		$('.delete').click(function(){
			var idUser = $(this).attr('id');
			var url = '<?=base_url()?>user/delete_user';
			$.ajax({
				url: url,
				type: "POST",
				data: {idUser: idUser},
				dataType: "json",
				success: function(data) {
					console.log('remove successfully');
					$('#row_'+idUser).remove();
				},
				error: function() {
					alert('error');
				}
			});
		});
	}
</script>