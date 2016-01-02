<head>
	<script type="text/javascript" src="<?php echo dashboard_url() ?>js/manage-post.js"></script>
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
					<th>Số Lượng Đăng Kí</th>
					<th>Xóa</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($content as $k => $v): ?>
					<tr id="row_<?=$v['id']?>">
						<td class="text-center"><?=$k+1?></td>
						<td><a href="<?=site_url('tin-'.$v['id'])?>"><?php echo $v['tieude'] ?></a></td>
						<td class="text-center"><?php echo count($this->mpost_reservation->get_users_by_post($v['id'])); ?></td>
						<td class="text-center"><button class="delete" id="<?=$v['id']?>"><i class="fa fa-times"></i></button></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>