<div class="col-lg-6">
	<div class="old-pass">
		<input type="hidden" value="<?php echo base_url().'ajax/check_password' ?>" id="url_ajax_oldpass">
		<div class="form-group">
			<label>Mật Khẩu Cũ</label>
			<input type="password" class="form-control" id="old-pass">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" id="confirm-oldpass">Xác Nhận</button>
		</div>
	</div>
	<div class="new-pass">
		<input type="hidden" value="<?php echo base_url().'ajax/change_password' ?>" id="url_ajax_newpass">
		<div class="form-group">
			<label>Mật Khẩu Mới</label>
			<input type="password" class="form-control" id="new-pass">
		</div>
		<div class="form-group">
			<label>Nhập Lại Mật Khẩu</label>
			<input type="password" class="form-control" id="confirm-pass">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" id="confirm-newpass">Xác Nhận</button>
		</div>
		<div class="success-change">
			Thay Đổi Thành Công
		</div>
	</div>
	<div class="error"></div>
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
	.new-pass {
		display: none;
	}
</style>
<script type="text/javascript">
	$(function(){
		$('button#confirm-oldpass').click(function(){
			var url = $('#url_ajax_oldpass').val();
			var oldpass = $('#old-pass').val();
			var errorShow = $('.error');
			var newPassField = $('.new-pass');
			var oldPassField = $('.old-pass');
			$.ajax({
				type: "POST",
				url: url,
				data: {oldpass: oldpass},
				dataType: "json",
				success: function(data) {
					if (!data['result']) {
						errorShow.text('Mật Khẩu Không Đúng');
						errorShow.show();
					} else {
						oldPassField.hide();
						newPassField.show();
						errorShow.hide();
					}
				},
				error: function() {
					alert('error');
				}
			});
		});
		$('button#confirm-newpass').click(function(){
			var url = $('#url_ajax_newpass').val();
			var newpass = $('#new-pass').val();
			var confirmpass = $('#confirm-pass').val();
			var errorShow = $('.error');
			var changeable = true;
			if (newpass.length < 5) {
				errorShow.text('Mật Khẩu phải chứa ít nhất 5 kí tự');
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