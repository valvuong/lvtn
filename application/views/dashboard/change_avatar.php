<div class="form-group">
	<form action="" method="post">
		<input type="hidden" value="<?php echo base_url().'user/change_avatar' ?>" id="url_ajax">
	    <input type="file" name="img" class="file">
	    <div class="input-group col-xs-12">
		    <input type="text" class="form-control input-lg" style="opacity: 0">
			<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
			<span class="input-group-btn">
				<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Tải Ảnh Lên</button>
			</span>
			<input type="text" class="form-control input-lg" style="opacity: 0">
	    </div>
	    <div class="preview text-center"></div>
	    <div class="text-center"><input type="submit" class="btn btn-primary upload" value="Đăng Ảnh"></div>
	</form>
	<div class="success-upload">Thay Đổi Ảnh Thành Công</div>
</div>
<style type="text/css">
	.file {
		visibility: hidden;
		position: absolute;
	}
	.preview {
		padding: 10px;
	}
	.preview img {
		max-width: 200px;
	}
	.upload {
		display: none;
	}
	.success-upload {
		color: green;
		font-size: 20px;
		display: none;
	}
</style>
<script type="text/javascript">
	$(function(){
		triggerBrowse();
		loadImg();
		upload();
	});
	function upload() {
		$('.upload').click(function(event){
			event.preventDefault();
			var input = $(".file");
			
		    // var url = $('#url_ajax').val();
		    
			if (files && files[0]) {
				var url = $('#url_ajax').val();
				var ext = files[0].name.split('.').pop().toLowerCase();
	            var size = files[0].size;
	            if(size < 1000000 && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
	            	var form = new FormData();
				    $.each(files, function(key, value){
				        form.append(key, value);
				    });
	            	$.ajax({
						type: "POST",
				        url: url,
				        data: form,
				        dataType: "json",
				        enctype: 'multipart/form-data',
				        processData: false,
				        contentType: false,
				        success: function(data) {
				            $('.success-upload').show();
				        },
				        error: function() {
				            alert('upload error');
				        }
					});
	            }
			}
		});
	}
	function triggerBrowse() {
		$('.browse').click(function(){
			$('.file').trigger('click');
		});
	}
	function loadImg() {
	    $(".file").change(function(event){
	    	files = event.target.files;
	        readURL(this);
	        $('.upload').show();
	    });
	}
	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var selector = '.preview';
	        $(selector).empty();
	        var ext = input.files[0].name.split('.').pop().toLowerCase();
            var size = input.files[0].size;
            if(size < 1000000 && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(selector).append('<img src="' + e.target.result + '">');
                }
                reader.readAsDataURL(input.files[0]);
            }
	    }
	}
</script>