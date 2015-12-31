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
					<th>Khóa</th>
					<th>Xóa</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($content as $k => $v): ?>
					<?php if($v['idUser'] != $this->session->userdata(LABEL_LOGIN)['id']): ?>
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
								<?php 
								if($v['locked']){
									$unlock = '';
									$lock = 'hide';
								} else {
									$lock = '';
									$unlock = 'hide';
								}
								if($v['role'] == 'ROLE_ADMIN') {
									$unlock = 'hide';
									$lock = 'hide';
								}
								?>
								<button class="btn btn-default unlock <?=$unlock?>" id="<?=$v['idUser']?>">Mở Khóa</button>
								<button class="btn btn-danger lock <?=$lock?>" id="<?=$v['idUser']?>">Khóa</button>
							</td>
							<td>
							<?php if($v['role'] != 'ROLE_ADMIN'): ?>
								<button class="delete" id="<?=$v['idUser']?>"><i class="fa fa-times"></i></button>
							<?php endif ?>
							</td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?php endif ?>

<script type="text/javascript">
	$(function(){
		delete_user();
		lock_user();
		unlock_user();
	});

	function lock_user() {
		$('.lock').click(function(){
			var idUser = $(this).attr('id');
			var url = '<?=base_url()?>user/lock_user';
			var lock_button = $(this);
			var unlock_button = lock_button.prev('.unlock');
			$.ajax({
				url: url,
				type: "POST",
				data: {idUser: idUser},
				success: function(data) {
					lock_button.addClass('hide');
					unlock_button.removeClass('hide');
				},
				error: function() {
					alert('error');
				}
			});
		});
	}

	function unlock_user() {
		$('.unlock').click(function(){
			var idUser = $(this).attr('id');
			var url = '<?=base_url()?>user/unlock_user';
			var unlock_button = $(this);
			var lock_button = unlock_button.next('.lock');
			$.ajax({
				url: url,
				type: "POST",
				data: {idUser: idUser},
				success: function(data) {
					unlock_button.addClass('hide');
					lock_button.removeClass('hide');
				},
				error: function() {
					alert('error');
				}
			});
		});
	}

	function delete_user() {
		$('.delete').click(function(){
			if (window.confirm("Bạn Muốn Xóa Thành Viên Này?")) {
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
			}
		});
	}
</script>