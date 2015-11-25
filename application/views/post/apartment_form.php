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
?>
    <fieldset>
        <legend style="width: 230px">THÔNG TIN BỔ SUNG</legend>
        <?php
        $bigger = 'bigger';
        ?>
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
            <div class="<?=$stage_1.' '.$text_right ?>">Có Tất Cả Là</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'all-room';
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
                Phòng
                <?php
                $field_name = 'bed-room';
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
                Phòng Ngủ
            </div>
        </div>

        <div class="<?=$form_group?>">
            <div class="<?=$stage_1.' '.$text_right ?>">Dịch Vụ Giặt Ủi</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'laundry';
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
            <div class="<?=$stage_1.' '.$text_right ?>">Các Dịch Vụ Khác</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'other-services';
                $data = array(
                    'id' => $field_name,
                    'name' => $field_name,
                    'class' => $input_class,
                    'value' => set_value($field_name),
                    'placeholder' => 'Vd: có thang máy, hầm để xe,... '
                );
                echo form_input($data);
                ?>
            </div>
        </div>

    </fieldset>