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
										
											<h1 class="card-heading">Chỉnh sửa tài khoản</h1>
											
										</div>
									</div>
									<div class="card-inner">
										<p class="text-center">
											<span class="avatar avatar-inline avatar-lg">
												<img alt="profile" src="<?php echo asset_url()?>image/avatar-001.jpg">
											</span>
										</p>
							<?php foreach ($info as $row): ?>
							<?php 
							$session_data=$this->session->userdata('logged_in');
							echo form_open_multipart('user/update_profile/'.$session_data['id']); ?>
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<?php
															
															$field_name = 'profile_username';
															$data= array(
																'id' => $field_name,
																'name' => $field_name,
																'class' => $input_class,
																'readonly'=>'readonly',
																'value' => set_value($field_name, $row['username']),
																
															);
															echo form_input($data);
															echo form_error($field_name);
															?>
														<label class="floating-label" for="profile-username">Tên đăng nhập</label>
														
													</div>
												</div>
											</div>
											
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<?php
															$field_name = 'profile-email';
															$data= array(
																'id' => $field_name,
																'name' => $field_name,
																'class' => $input_class,
																'readonly'=>'readonly',
																'value' => set_value($field_name,$row['email'])
															);
															echo form_input($data);
															echo form_error($field_name);
															?>
														<label class="floating-label" for="profile-email">Email</label>
														
													</div>
												</div>
											</div>
											
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<?php
															$field_name = 'profile-password';
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
														<label class="floating-label" for="profile-password">Mật khẩu</label>
														
													</div>
												</div>
											</div>
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<?php
															$field_name = 'profile-repassword';
															$data= array(
																'id' => $field_name,
																'name' => $field_name,
																'class' => $input_class,
																'type' => 'password'
															);
															echo form_input($data);
															echo form_error($field_name);
															?>
														<label class="floating-label" for="profile-repassword">Nhập lại mật khẩu</label>
													</div>
												</div>
											</div>
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<?php
															$field_name = 'profile-name';
															$data= array(
																'id' => $field_name,
																'name' => $field_name,
																'class' => $input_class,
																'value' => set_value($field_name,$row['name']),
															);
															echo form_input($data);
															echo form_error($field_name);
															?>
														<label class="floating-label" for="profile-name">Tên đầy đủ</label>
														
													</div>
												</div>
											</div>
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
													<label  for="profile-sex">Giới tính</label>
														<?php
															$field_name = 'profile-sex';
															$sex = array(
																'Nam'         => 'Nam',
																'Nữ'           => 'Nữ',
															);
															echo form_dropdown($field_name, $sex, $row['sex']);
															echo form_error($field_name);
															?>
													</div>
												</div>
											</div>
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<?php
															$field_name = 'profile-address';
															$data= array(
																'id' => $field_name,
																'name' => $field_name,
																'class' => $input_class,
																'value' => set_value($field_name,$row['address']),
															);
															echo form_input($data);
															echo form_error($field_name);
															?>
														<label class="floating-label" for="profile-address">Địa chỉ</label>
														
													</div>
												</div>
											</div>
											<div class="form-group form-group-label">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<?php
															$field_name = 'profile-phone';
															$data= array(
																'id' => $field_name,
																'name' => $field_name,
																'class' => $input_class,
																'value' => set_value($field_name,$row['phone']),
															);
															echo form_input($data);
															echo form_error($field_name);
															?>
														<label class="floating-label" for="profile-phone">Số điện thoai</label>
														
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<div class="submit">
															<input type="submit" value="Cập nhật thông tin" name="update" class="btn btn-block ">
														</div>
														
													</div>
												</div>
											</div>
								<?php endforeach ?>			
								
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