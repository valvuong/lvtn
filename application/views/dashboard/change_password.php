<div class="col-lg-6">
	<input type="hidden" value="<?php echo base_url().'ajax/change_password' ?>" id="url_ajax">
	<div class="form-group">
		<label>Mật Khẩu Mới</label>
		<input type="password" class="form-control" id="new-pass" min="8">
	</div>
	<div class="form-group">
		<label>Nhập Lại Mật Khẩu</label>
		<input type="password" class="form-control" id="confirm-pass" min="8">
	</div>
	<div class="form-group">
		<button class="btn btn-primary" id="confirm">Xác Nhận</button>
	</div>
	<div class="success-change">
		Thay Đổi Thành Công
	</div>
	<div class="error">
		fasdfasdfasdfsaf
	</div>
</div>
<style type="text/css">
	.error {
		display: none;
		color: red;
	}
	.success-change {
		display: none;
		color: green;
		font-size: 25px;
	}
</style>
<script type="text/javascript">
	$(function(){
		$('button#confirm').click(function(){
			var url = $('#url_ajax').val();
			var newpass = $('#new-pass').val();
			var confirmpass = $('#confirm-pass').val();
			var errorShow = $('.error');
			var changeable = true;
			if (newpass.length < 8) {
				errorShow.text('Mật Khẩu phải chứa ít nhất 8 kí tự');
				errorShow.show();
				changeable = false;
			} else {
				if (confirmpass !== newpass) {
					errorShow.text('Mật Khẩu nhập lại không khớp');
					errorShow.show();
					changeable = false;
				}
			}
			if (changeable) {
				$.ajax({
					type: "POST",
			        url: url,
			        data: {newpass: newpass},
			        dataType: "json",
			        success: function(data) {
			            $('.success-change').show();
			        },
			        error: function() {
			            alert('error');
			        }
				});
			}
		});
	});
</script>