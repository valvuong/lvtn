<div class="form-group">
    <input type="file" name="img[]" class="file">
    <div class="input-group col-xs-12">
		<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
		<span class="input-group-btn">
			<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Tải Ảnh Lên</button>
		</span>
		<input type="text" class="form-control input-lg" style="opacity: 0">
		<div class="preview"></div>
    </div>
</div>
<style type="text/css">
	.file {
		visibility: hidden;
		position: absolute;
	}
</style>
<script type="text/javascript">
	$(function(){
		$('.browse').click(function(){
			$('.file').trigger('click');
		});
	});
</script>