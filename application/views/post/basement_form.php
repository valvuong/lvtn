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
        <div class="<?=$stage_1.' '.$text_right ?>">Chỉ Cho</div>
        <div class="<?=$stage_2 ?>">
            <?php
            $field_name = 'gender-only';
            ?>
            <label class="radio">
                <input value="Nữ Ở" type="radio" name="<?=$field_name?>">
                <span class="outer"><span class="inner"></span></span>Nữ Ở
            </label>
            <label class="radio">
                <input value="Nam Ở" type="radio" name="<?=$field_name?>">
                <span class="outer"><span class="inner"></span></span>Nam Ở
            </label>
            <label class="radio">
                <input value="0" type="radio" name="<?=$field_name?>">
                <span class="outer"><span class="inner"></span></span>Tùy Ý
            </label>
        </div>
        </div>

        <div class="<?=$form_group?>">
            <div class="<?=$stage_1.' '.$text_right ?>">Nhà vệ sinh trong phòng</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'rest-room';
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
            <div class="<?=$stage_1.' '.$text_right ?>">Ẩm thấp</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'amthap';
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
            <div class="<?=$stage_1.' '.$text_right ?>">Thông thoáng</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'thongthoang';
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
            <div class="<?=$stage_1.' '.$text_right ?>">Tiện nghi</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'other-services';
                $data = array(
                    'id' => $field_name,
                    'name' => $field_name,
                    'class' => $input_class,
                    'value' => set_value($field_name),
                    'placeholder' => 'Vd: phòng có máy lạnh, có quạt máy... '
                );
                echo form_input($data);
                ?>
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