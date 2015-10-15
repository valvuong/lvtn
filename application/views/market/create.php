<link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/main-form.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/market-create.css">
<script src="<?php echo asset_url()?>ckeditor/ckeditor.js"></script>
<script>
    $(function(){
        CKEDITOR.replace( 'ad-content' );
        CKEDITOR.config.removePlugins = 'about';
    });
</script>
<?php
$form_group = 'form-group';
$input_class = 'form-control';
$label_class = 'form-label';
$required = '<span style="color: red">*</span>';
?>
<h2 class="dt">??NG TIN RAO V?T</h2>
<?php echo form_open_multipart('market/create') ?>
    <div class=<?=$form_group?>>
        <?php
        $field_name = 'ad-title';
        echo form_label('Tiêu ??'.$required.':', $field_name, array('class'=>$label_class));
        $data = array(
            'id' => $field_name,
            'name' => $field_name,
            'class' => $input_class,
            'value' => set_value($field_name)
        );
        echo form_input($data);
        ?>
    </div>

    <div class=<?=$form_group?>>
        <?php
        $field_name = 'ad-content';
        echo form_label('N?i Dung'.$required.':', $field_name, array('class'=>$label_class));
        $data = array(
            'id' => $field_name,
            'name' => $field_name,
            'class' => $input_class,
            'value' => set_value($field_name)
        );
        echo form_textarea($data);
        ?>
    </div>

    <div class=<?=$form_group?>>
        <div class="submit">
            <input type="submit" value="??ng Tin" name="submit" class="btn btn-primary btn-lg">
        </div>
    </div>
<?php echo form_close(); ?>