<script src="<?php echo asset_url() ?>ckeditor/ckeditor.js"></script>

<script type="text/javascript" src="<?php echo asset_url() ?>js/post-form.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo css_url() ?>main-form.css">
<link rel="stylesheet" type="text/css" href="<?php echo css_url() ?>post-form.css">

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
$text_right = 'text-right';
$float_left = 'float-left';
?>
<h2 class="dt">ĐĂNG TIN PHÒNG TRỌ</h2>
<?php echo form_open_multipart('post/form', array('id'=>'post-form')) ?>
    <?php echo form_input(array('type' => 'hidden', 'id' => 'url_ajax', 'name' => 'url_ajax', 'value' => base_url().'ajax/get_ward')) ?>

    <fieldset>
        <legend style="width: 235px">THÔNG TIN BÀI ĐĂNG</legend>

        <div class="<?=$form_group?>">
            <?php
            $field_name = 'title';
            echo form_label('Tiêu Đề'.$required.':', $field_name, array('class'=>$label_class));
            $data= array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => $input_class,
                'minlength'=>'15',
                'maxlength'=>'100',
                'value' => set_value($field_name)
            );
            echo form_input($data);
            ?>
        </div>

        <div class="<?=$form_group?>">
            <?php $field_name = 'district' ?>
            <?php echo form_label('Quận'.$required, '', array('class' => $label_class.' '.$stage_1)) ?>
            <select id=<?=$field_name?> name=<?=$field_name?> onchange="showWard(this.value)" class="selectpicker" data-width="150px">
                <?php $query = $this->mdistrict->get_all() ?>
                <?php foreach($query as $row): ?>
                    <?php $name = explode(" ", $row['tenquan']) ?>
                    <option value="<?=$row['idQ'];?>"><?php if(count($name) > 2) echo $name[1].' '.$name[2]; else echo $name[0].' '.$name[1];?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="<?=$form_group?>">
            <?php $field_name = 'ward' ?>
            <?php echo form_label('Phường'.$required, '', array('class' => $label_class.' '.$stage_1)) ?>
            <select id=<?=$field_name?> name=<?=$field_name?> class="selectpicker"></select>
        </div>

        <div class="<?=$form_group?>">
            <?php
            $field_name = 'area';
            echo form_label('Diện Tích'.$required, $field_name, array('class'=>$label_class.' '.$stage_1));
            $data = array(
                'type' => 'number',
                'name' => $field_name,
                'id' => $field_name,
                'placeholder' => 'VD: 10.5',
                'class' => $input_class,
                'style' => 'display: inline-block;width: 150px',
                'step' => '0.1',
                'min' => '0',
                'value' => set_value($field_name)
            );
            echo form_input($data);
            ?>
            <span>m<sup>2</sup></span>
        </div>

        <div class="<?=$form_group?>">
            <?php
            $field_name = 'price';
            echo form_label('Giá Phòng'.$required, $field_name, array('class'=>$label_class.' '.$stage_1));
            $data = array(
                'type' => 'number',
                'name' => $field_name,
                'id '=> $field_name,
                'placeholder' => 'VD: 2.5',
                'class' => $input_class,
                'style' => 'display: inline-block;width: 150px',
                'step' => '0.1',
                'maxlength' => '50',
                'min' => '0',
                'value' => set_value($field_name)
            );
            echo form_input($data);
            ?>
            <span id="pri"></span> VNĐ/tháng
        </div>

        <div class="<?=$form_group?>">
            <?php echo form_label('', '', array('class' => $stage_1)) ?>
            <div class="<?=$stage_2?>">
                <?php
                $normal_label = 'normal-label';
                $checkbox_class = 'checkbox-primary';
                $label_checkbox_primary = 'label-checkbox-primary';
                ?>
                <div class="row">
                    <?php
                    $field_name = 'e_price';
                    $data = array(
                        'id' => $field_name,
                        'name' => $field_name,
                        'class' => $checkbox_class,
                        'checked' => set_checkbox($field_name,$field_name)
                    );
                    echo form_checkbox($data);
                    echo form_label('Bao gồm tiền điện', $field_name, array('class'=>$label_checkbox_primary));
                    ?>
                </div>
                <div class="row">
                    <?php
                    $field_name = 'w_price';
                    $data = array(
                        'id' => $field_name,
                        'name' => $field_name,
                        'class' => $checkbox_class,
                        'checked' => set_checkbox($field_name,$field_name)
                    );
                    echo form_checkbox($data);
                    echo form_label('Bao gồm tiền nước', $field_name, array('class'=>$label_checkbox_primary));
                    ?>
                </div>
                <div class="row">
                    <?php
                    $field_name = 'pre_pay';
                    $data = array(
                        'id' => $field_name,
                        'name' => $field_name,
                        'class' => $checkbox_class,
                        'checked' => set_checkbox($field_name,$field_name)
                    );
                    echo form_checkbox($data);
                    echo form_label('Đặt cọc trước', $field_name, array('class'=>$label_checkbox_primary));
                    ?>
                    <input value=<?=set_value('mon_re')?> class=<?=$input_class?> id="mon_re" name="mon_re" type="number" min="1" disabled style="height: 32px;padding-left: 12px;padding-right: 5px;width: 60px;margin: 0 10px;display: inline-block"><span>tháng</span>
                </div>
            </div>
        </div>

        <div class="<?=$form_group?>">
<!--            <link rel="stylesheet" href="https://rawgit.com/FezVrasta/bootstrap-material-design/master/dist/css/material.min.css" />-->
            <link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--            <script type="text/javascript" src="https://rawgit.com/FezVrasta/bootstrap-material-design/master/dist/js/material.min.js"></script>-->

            <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>datepicker/css/bootstrap-material-datetimepicker.css">
            <script type="text/javascript" src="<?php echo asset_url() ?>datepicker/js/moment.min.js"></script>
            <script type="text/javascript" src="<?php echo asset_url() ?>datepicker/js/bootstrap-material-datetimepicker.js"></script>

            <?php
            echo form_label('Ngày Hết Hạn'.$required.':', '', array('class'=>$label_class.' '.$stage_1));
            $field_name = 'expired_date';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'placeholder' => 'Hãy click vào đây',
                'class' => $input_class.' '.$stage_2,
                'value' => set_value($field_name),
                'pattern' => '(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-([0-9]{4})'
            );
            echo form_input($data);
            ?>
        </div>

        <div class="<?=$form_group?>">
            <?php
            echo form_label('Nội Dung'.$required.':', 'info', array('class'=>$label_class));
            $field_name = 'content_post';
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'class' => "form-control",
                'minlength' => "30",
                'maxlength' => "3000",
            );
            echo form_textarea($data);
            ?>
        </div>

        <div class="<?=$form_group?>">
            <?php echo form_label('Hình ảnh'.$required.':', '', array('class'=>$label_class)) ?>

            <div class="<?=$form_group?> upload-warning">
                <?php
                echo form_label(
                    '<span class="glyphicon glyphicon-upload"></span>Tải hình lên',
                    'upload-file',
                    array(
                        'class'=>'upload-file',
                        'id' => 'upload-label',
                        'data-toggle' => "tooltip"
                    )
                );
                $data = array(
                    'id' => 'upload-file',
                    'name' => 'upload_file[]',
                    'accept' => 'image/jpeg, image/gif, image/png, image/jpg',
                    'multiple' => true
                );
                echo form_upload($data);
                ?>
                <span class="warning">Bạn chỉ có thể tải tối đa 8 hình, mỗi hình không quá 1M với các định dạng ipg, gif, jpeg, png.</span>
            </div>
        </div>

        <div class="<?=$form_group?>" id="preview"></div>
    </fieldset>

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
                    'placeholder' => ''
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
            <div class="<?=$stage_1.' '.$text_right ?>">Xe Buýt</div>
            <div class="<?=$stage_2 ?>">
                <?php
                $field_name = 'bus';
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
    </fieldset>

    <fieldset>
        <legend style="width: 215px">THÔNG TIN LIÊN HỆ</legend>

        <div class="<?=$form_group?>">
            <?php
            $field_name = 'name_contact';
            echo form_label('Tên Người Liên Hệ'.$required.':',$field_name,array('class'=>$label_class));
            $data = array(
                'id' => $field_name,
                'name' => $field_name,
                'placeholder' => '',
                'class' => $input_class,
                'maxlength'=>'50',
                'value' => set_value($field_name)
            );
            echo form_input($data);
            ?>
        </div>

        <div class="<?=$form_group?>">
            <?php
            $field_name = 'phone';
            echo form_label('Số Điện Thoại'.$required.':',$field_name,array('class'=>$label_class));
            $data = array(
                'id' => $field_name,
                'class' => $input_class,
                'name' => $field_name,
                'placeholder' => '',
                'maxlength'=>'20',
                'value' => set_value($field_name)
            );
            echo form_input($data);
            ?>
            <div id="name_tooltip" class="tooltip" style="left: 128px">
                <div id="name_tooltip_triangle" class="triangle">&nbsp;</div>
                <div class="tooltip_content" style="width: 270px">
                    <span id="tooltip_content">Điền đầy đủ mã vũng nếu là số điện thoại cố định.</span>
                </div>

            </div>
        </div>

        <div class="<?=$form_group?>">
            <?php
            $field_name = 'address';
            echo form_label('Địa Chỉ'.$required.':',$field_name,array('class'=>$label_class));
            $data = array(
                'name' => $field_name,
                'id' => $field_name,
                'placeholder' => 'VD: 232/3 Lý Thường Kiệt, P.15, Q.10',
                'class' => $input_class,
                'value' => set_value($field_name)
            );
            echo form_input($data);
            ?>
        </div>

        <div class="<?=$form_group?>">
            <?php
            $field_name = 'email';
            echo form_label('Email:',$field_name,array('class'=>$label_class));
            $data = array(
                'name' => $field_name,
                'id' => $field_name,
                'placeholder' => 'example@abc.com',
                'class' => $input_class,
                'maxlength' => '30',
                'value' => set_value($field_name)
            );
            echo form_input($data);
            ?>

            <div id="name_tooltip" class="tooltip" style="display: none">
                <div id="name_tooltip_triangle" class="triangle">&nbsp;</div>
                <div class="tooltip_content" style="width: 210px">
                    <span id="tooltip_content">Ví dụ: <span style="color: red">example@abc.com</span></span>
                </div>
            </div>
        </div>
    </fieldset>

    <div class="<?=$form_group?>">
        <div class="submit">
            <input type="submit" value="Đăng tin" name="submit" class="btn btn-primary btn-lg">
        </div>
    </div>
<?php echo form_close() ?>