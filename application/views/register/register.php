<style type="text/css"> 
.error { 
    color:red; 
    font-weight:bold; 
} 
</style>  
	<!-- css -->
	<link href="<?php echo asset_url()?>css/base.min.css" rel="stylesheet">

	<!-- css for this project -->
	<link href="<?php echo asset_url()?>css/project.min.css" rel="stylesheet">
<?php
$required = '<span style="color: red">*</span>';
$form_group = 'form-group';
$input_class = 'form-control';
$label_class = 'form-label';
$stage_1 = 'stage-1';
$stage_2 = 'stage-2';
$title_error = form_error('title');
$email_error = form_error('email');
$area_error = form_error('area');
?>
<div class="avoid-fout page-brand">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-lg-push-4 col-sm-6 col-sm-push-3">
					<section class="content-inner">
						<div class="card-wrap">
							<div class="card">
								<div class="card-main">
									<div class="card-header">
										<div class="card-inner">
										
											<h1 class="card-heading">Đăng ký tài khoản</h1>
											
										</div>
									</div>
									<div class="card-inner">
										<p class="text-center">
											<span class="avatar avatar-inline avatar-lg">
												<img alt="register" src="<?php echo asset_url()?>image/avatar-001.jpg">
											</span>
										</p>
							<?php echo form_open_multipart('user/register') ?>
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
						</div>
						
					</section>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
	<!-- js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="<?php echo asset_url()?>js/base.min.js"></script>

	<!-- js for this project -->
	<script src="<?php echo asset_url()?>js/project.min.js"></script>
	
</div>
