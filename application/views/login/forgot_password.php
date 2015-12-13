<style type="text/css"> 
.error { 
    color:red; 
    font-weight:bold; 
} 
</style>  
	<!-- css -->
	<link href="<?php echo asset_url()?>css/base.min.css" rel="stylesheet">
	<link href="<?php echo asset_url()?>css/project.min.css" rel="stylesheet">
<!-- js -->
<script src="<?php echo asset_url()?>js/base.min.js"></script>
<script src="<?php echo asset_url()?>js/project.min.js"></script>
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
		<?php echo form_open_multipart('user/send_email') ?>
			<div class="form-group form-group-label">
				<div class="row">
					<div class="col-md-10 col-md-push-1">
						<?php
							$field_name = 'forgot-password-email';
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
		</div>
	</div>
	<div> <?php 
	if (isset($message_display))
	echo $message_display; ?> </div>
<?php echo form_close(); ?>