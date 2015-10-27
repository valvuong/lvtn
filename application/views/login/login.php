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
											<?php 
											
											if($login_fail==true): ?>
											<h1 class="card-heading">Sai tên hoặc mật khẩu</h1>
											
											<?php else: ?> <h1 class="card-heading">Đăng nhập</h1>
											<?php endif ?>
										</div>
									</div>
									<div class="card-inner">
										<p class="text-center">
											<span class="avatar avatar-inline avatar-lg">
												<img alt="Login" src="<?php echo asset_url()?>image/avatar-001.jpg">
											</span>
										</p>
							<?php echo form_open_multipart('user/login') ?>
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">		
															<?php
															$field_name = 'login-username';
															$data= array(
																'id' => $field_name,
																'name' => $field_name,
																'class' => $input_class,
																'minlength'=>'3',
																'maxlength'=>'15',
																'value' => set_value($field_name)
															);
															echo form_input($data);
															?>
														<label class="floating-label" for= "<?=$field_name?>"> Tài khoản</label>
													</div>
												</div>
											</div>
			
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<?php
															$field_name = 'login-password';
															$data= array(
																'id' => $field_name,
																'name' => $field_name,
																'class' => $input_class,
																'minlength'=>'3',
																'maxlength'=>'15',
																'value' => set_value($field_name),
																'type' => 'password'
															);
															echo form_input($data);
															?>
														<label class="floating-label" for="login-password">Mật khẩu</label>

														
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<div class="submit">
															<input type="submit" value="Đăng nhập" name="submit" class="btn btn-block ">
														</div>
														
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<div class="checkbox checkbox-adv">
															<label for="login-remember">
																<input class="access-hide" id="login-remember" name="login-remember" type="checkbox">Duy trì đăng nhập
																<span class="circle"></span><span class="circle-check"></span><span class="circle-icon icon"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
								
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix">
							

							<p class="margin-no-top pull-left"><a class="btn btn-flat btn-blue waves-attach" href="javascript:void(0)">Hỗ trợ</a></p>
							<p class="margin-no-top pull-right"><a class="btn btn-flat btn-blue waves-attach" href="<?=site_url('dang-ki')?>">Đăng kí</a></p>
							<?php echo $this->session->userdata('last_page');
									echo current_url(); echo site_url('dang-nhap');?>
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
