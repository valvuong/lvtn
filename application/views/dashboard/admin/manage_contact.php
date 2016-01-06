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
					<th>Người Gửi</th>
					<th>Email</th>
					<th>Nội Dung</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($content as $k => $v): ?>
					<tr id="row_<?=$v['id']?>">
						<td class="text-center"><?=$k+1?></td>
						<td class="text-center"><?php echo $v['name'] ?></td>
						<td class="text-center"><?php echo $v['email'] ?></td>
						<td><?php echo $v['message'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>