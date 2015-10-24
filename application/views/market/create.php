<link rel="stylesheet" type="text/css" href="<?php echo css_url()?>main-form.css">
<link rel="stylesheet" type="text/css" href="<?php echo css_url()?>market-create.css">
<script src="<?php echo asset_url()?>ckeditor/ckeditor.js"></script>
<script src="<?php echo js_url()?>market-create.js"></script>
<?php
$form_group = 'form-group';
$input_class = 'form-control';
$label_class = 'form-label';
$required = '<span style="color: red">*</span>';
$stage_1 = 'stage-1';
$stage_2 = 'stage-2';
?>
<h2 class="dt">ĐĂNG TIN RAO VẶT</h2>
<?php echo form_open_multipart('market/create', array('id'=>'market-form')) ?>
    <div class=<?=$form_group?>>
        <?php
        $field_name = 'ad-title';
        echo form_label('Tiêu Đề'.$required.':', $field_name, array('class'=>$label_class));
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
        <?php $field_name = 'ad-category' ?>
        <?php echo form_label('Danh Mục'.$required, '', array('class'=>$label_class.' '.$stage_1)) ?>
        <select name=<?=$field_name?> class="selectpicker">
            <?php $query = $this->mmarket->get_cate() ?>
            <?php foreach($query as $row): ?>
                <option value="<?=$row['id']?>"><?=$row['tenloai']?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class=<?=$form_group?>>
        <?php
        $field_name = 'ad-price';
        echo form_label('Giá Cả'.$required, $field_name, array('class'=>$label_class.' '.$stage_1));
        $data = array(
            'type' => 'number',
            'name' => $field_name,
            'id '=> $field_name,
            'placeholder' => 'VD: 2.5',
            'class' => $input_class,
            'style' => 'display: inline-block;width: 150px',
            'step' => '0.1',
            'min' => '0',
            'value' => set_value($field_name)
        );
        echo form_input($data);
        ?>
        <span id="pri"></span> VNĐ
    </div>

    <div class=<?=$form_group?>>
        <?php
        $field_name = 'ad-status';
        echo form_label('Tình Trạng'.$required, '', array('class'=>$label_class.' '.$stage_1));
        ?>
        <select name=<?=$field_name?> class="selectpicker">
            <option value="0">Mới</option>
            <option value="1">Đã Sử Dụng</option>
        </select>
    </div>

    <div class=<?=$form_group?>>
        <?php
        $field_name = 'ad-content';
        echo form_label('Nội Dung'.$required.':', $field_name, array('class'=>$label_class));
        $data = array(
            'id' => $field_name,
            'name' => $field_name,
            'class' => $input_class
        );
        echo form_textarea($data);
        ?>
    </div>

    <div class=<?=$form_group?>>
        <?php echo form_label('Hình Ảnh Đại Diện:', '', array('class'=>$label_class)) ?>

        <div class="row upload">
            <?php
            $field_name = 'market_upload';
            echo form_label('<span class="glyphicon glyphicon-upload"></span>Tải hình lên', $field_name, array('class'=>$field_name));
            $data = array(
                'id' => $field_name,
                'name' => $field_name.'[]',
                'accept' => 'image/jpeg, image/gif, image/png, image/jpg',
                'multiple' => true
            );
            echo form_upload($data);
            ?>
        </div>
    </div>

    <div class=<?=$form_group?> id="preview"></div>

    <div class=<?=$form_group?>>
        <div class="submit">
            <input type="submit" value="Đăng Tin" name="submit" class="btn btn-primary btn-lg">
        </div>
    </div>
<?php echo form_close(); ?>