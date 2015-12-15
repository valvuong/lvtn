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
            <div class="<?=$stage_1.' '.$text_right ?>">Số Lầu</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'floor';
                $data = array(
                    'id' => $field_name,
                    'name' => $field_name,
                    'type' => 'number',
                    'class' => $input_class,
                    'value' => (!empty(set_value($field_name)))?set_value($field_name):0,
                    'style' => 'width: 100px;display: inline-block',
                    'min' => 0
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
            </div>
        </div>

        <div class="<?=$form_group?>">
            <div class="<?=$stage_1.' '.$text_right ?>">Bao Gồm</div>
            <div class="<?=$stage_2 ?>">
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
                <?php
                $field_name = 'rest-room';
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
                Nhà vệ sinh
            </div>
        </div>

        <div class="<?=$form_group?>">
            <div class="<?=$stage_1.' '.$text_right ?>">Còn trống</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'free-room';
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