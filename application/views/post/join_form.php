<?php
$required = '<span style="color: red">*</span>';
$form_group = 'form-group';
$input_class = 'form-control';
$label_class = 'form-label';
$stage_1 = 'stage-1';
$stage_2 = 'stage-2';
$text_right = 'text-right';
$float_left = 'float-left';
$normal_label = 'normal-label';
$checkbox_class = 'checkbox-primary';
$label_checkbox_primary = 'label-checkbox-primary';
$bigger = 'bigger';
?>
<fieldset>
    <legend style="width: 230px">THÔNG TIN BỔ SUNG</legend>
    
    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">An Ninh</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'security';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $input_class,
                'value' => set_value($field_name),
                'placeholder' => 'VD: gần đồn công an, hoặc gần đồn dân phòng'
            );
            echo form_input($data);
            ?>
        </div>
    </div>

    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">Giờ Giấc</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'time-off';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $input_class,
                'value' => set_value($field_name),
                'placeholder' => 'VD: đóng cửa vào lúc 23h'
            );
            echo form_input($data);
            ?>
        </div>
    </div>

    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">Hiện Tại Đã Có</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'available-nums';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $input_class,
                'type' => 'number',
                'value' => (!empty(set_value($field_name)))?set_value($field_name):0,
                'style' => 'width:100px;display: inline-block',
                'min' => 0
            );
            echo form_input($data);
            ?>
            Người
        </div>
    </div>

    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">Cần Thêm</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'male-need';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $input_class,
                'type' => 'number',
                'value' => (!empty(set_value($field_name)))?set_value($field_name):0,
                'style' => 'width: 100px;display: inline-block',
                'min' => 0
            );
            echo form_input($data);
            ?>
            Nam
            <?php
            $field_name = 'female-need';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $input_class,
                'type' => 'number',
                'value' => (!empty(set_value($field_name)))?set_value($field_name):0,
                'style' => 'width: 100px;display: inline-block',
                'min' => 0
            );
            echo form_input($data);
            ?>
            Nữ
        </div>
    </div>

    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">Cho Phép Nấu Nướng</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'cook';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $checkbox_class,
                'checked' => set_checkbox($field_name, $field_name)
            );
            echo form_checkbox($data);
            echo form_label('', $field_name, array('class' => $label_checkbox_primary.' '.$bigger));
            ?>
        </div>
    </div>

    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">Ở Chung Với Chủ</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'with-host';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $checkbox_class,
                'checked' => set_checkbox($field_name, $field_name)
            );
            echo form_checkbox($data);
            echo form_label('', $field_name, array('class' => $label_checkbox_primary.' '.$bigger));
            ?>
        </div>
    </div>

    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">Nhà Vệ Sinh Riêng</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'wc';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $checkbox_class,
                'checked' => set_checkbox($field_name, $field_name)
            );
            echo form_checkbox($data);
            echo form_label('', $field_name, array('class' => $label_checkbox_primary.' '.$bigger));
            ?>
        </div>
    </div>

    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">Có Ban Công</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'balcony';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $checkbox_class,
                'checked' => set_checkbox($field_name, $field_name)
            );
            echo form_checkbox($data);
            echo form_label('', $field_name, array('class' => $label_checkbox_primary.' '.$bigger));
            ?>
        </div>
    </div>

    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">Có Chỗ Để Xe</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'parking';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $checkbox_class,
                'checked' => set_checkbox($field_name, $field_name)
            );
            echo form_checkbox($data);
            echo form_label('', $field_name, array('class' => $label_checkbox_primary.' '.$bigger));

            /*$field_name = 'parking-limit';
            $data = array(
                'type' => 'number',
                'id' => $field_name,
                'name' => $field_name,
                'class' => $input_class,
                'min' => 0,
                'value' => set_checkbox($field_name),
                'style' => 'width: 70px;display: inline-block'
            );*/
            ?>
            <!-- <span class="after-checkbox">Tối Đa <?php echo form_input($data); ?> Chiếc</span> -->
        </div>
    </div>

    <div class="<?=$form_group?>">
        <div class="<?=$stage_1.' '.$text_right ?>">Các Tuyến Xe Buýt Gần Đó</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'bus';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $input_class,
                'value' => set_value($field_name),
                'placeholder' => 'VD: 50, 80, 100'
            );
            echo form_input($data);
            ?>
        </div>
    </div>
</fieldset>