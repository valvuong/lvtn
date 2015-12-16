<style type="text/css"> 
.error { 
    color:red; 
    font-weight:bold; 
} 
</style>  
	<!-- css -->
	<link href="<?php echo asset_url()?>css/base.min.css" rel="stylesheet">
	<link href="<?php echo asset_url()?>css/project.min.css" rel="stylesheet">
	<script src="<?php echo asset_url() ?>ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo asset_url() ?>js/register.js"></script>
<?php
$required = '<span style="color: red">*</span>';
$form_group = 'form-group';
$input_class = 'form-control';
$label_class = 'form-label';
$title_error = form_error('title');
$email_error = form_error('email');
$area_error = form_error('area');
?>					
<div class="card">
	<div class="card-main">
		<div class="card-header">
			<div class="card-inner">
			
				<div class="card-heading">ĐĂNG KÝ TÀI KHOẢN </div>
				
			</div>
		</div>
		<div class="card-inner">
			<p class="text-center">
				<span id=preview class="avatar avatar-inline avatar-lg">
					<img alt="register" src="<?php echo asset_url()?>image/avatar-001.jpg">
				</span>
			</p>
		</div>
<?php echo form_open_multipart('user/register') ?>
<!--///////////////////// -->
			<div class="<?=$form_group?>">
	            <div class="<?=$form_group?> upload-warning">
	                <?php
	                echo form_label(
	                    '<span class="glyphicon glyphicon-upload"></span>Chọn ảnh đại diện',
	                    'upload-file',
	                    array(
	                        'class'=>'upload-file',
	                        'id' => 'upload-label',
	                        'data-toggle' => "tooltip"
	                    )
	                );
	                $data = array(
	                    'id' => 'upload-file',
	                    'name' => 'upload_file[]',
	                    'accept' => 'image/jpeg, image/gif, image/png, image/jpg',
	                    'required' => 'required'
	                );
	                echo form_upload($data);
	                ?>
	            </div>
	        </div>
<!--///////////////////////////////-->
				<div class="form-group form-group-label">
					<div class="row">
						<div class="col-md-10 col-md-push-1">		
								<?php
								$field_name = 'register-username';
								$data= array(
									'id' => $field_name,
									'name' => $field_name,
									'class' => $input_class,
									'minlength'=>'5',
									'value' => set_value($field_name)
								);
								echo form_input($data);
								echo form_error($field_name);
								?>
							<label class="floating-label" for= "<?=$field_name?>"> Tên đăng nhập</label>
						</div>
					</div>
				</div>
				
				<div class="form-group form-group-label">
					<div class="row">
						<div class="col-md-10 col-md-push-1">
							<?php
								$field_name = 'register-email';
								$data= array(
									'id' => $field_name,
									'name' => $field_name,
									'class' => $input_class,
									
									'value' => set_value($field_name),
									'type' => 'email'
								);
								echo form_input($data);
								echo form_error($field_name);
								?>
							<label class="floating-label" for="register-password">Email</label>
							
						</div>
					</div>
				</div>
				
				<div class="form-group form-group-label">
					<div class="row">
						<div class="col-md-10 col-md-push-1">
							<?php
								$field_name = 'register-password';
								$data= array(
									'id' => $field_name,
									'name' => $field_name,
									'class' => $input_class,
									'minlength'=>'5',
									'type' => 'password'
								);
								echo form_input($data);
								echo form_error($field_name);
								?>
							<label class="floating-label" for="register-password">Mật khẩu</label>
							
						</div>
					</div>
				</div>
				<div class="form-group form-group-label">
					<div class="row">
						<div class="col-md-10 col-md-push-1">
							<?php
								$field_name = 'register-repassword';
								$data= array(
									'id' => $field_name,
									'name' => $field_name,
									'class' => $input_class,
									'type' => 'password'
								);
								echo form_input($data);
								echo form_error($field_name);
								?>
							<label class="floating-label" for="register-password">Nhập lại mật khẩu</label>
						</div>
					</div>
				</div>
				<div class="form-group form-group-label">
					<div class="row">
						<div class="col-md-10 col-md-push-1 data-width="25%">
							<?php
								$field_name = 'captcha';
								$data= array(
									'id' => $field_name,
									'name' => $field_name,
									'class' => $input_class
								);
								echo form_input($data);
								echo form_error($field_name);
							?>
						<label class="floating-label" for="captcha">Nhập mã bảo vệ</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class=" row col-md-10 col-md-push-1">
						<center><?php echo $cap['image']; ?></center>
						</br>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-10 col-md-push-1">
							<div class="submit">
								<input type="submit" value="Đăng ký" name="register" class="btn btn-block ">
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<!-- js -->
<script src="<?php echo asset_url()?>js/base.min.js"></script>
<script src="<?php echo asset_url()?>js/project.min.js"></script>
