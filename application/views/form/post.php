<?php
$required = '<span style="color: red">*</span>';
$this->load->helper('captcha');
$formGroup = 'form-group';
$inputClass = 'form-control';
$title = form_error('title');
$email = form_error('email');
?>
<h2 class="dt">ĐĂNG TIN PHÒNG TRỌ</h2>
<?php echo form_open_multipart('post/form', array('id'=>'postNews')) ?>
    <div class="ai_row">
        <?php echo form_label('Tiêu Đề'.$required.':','title',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <?php
            $data= array(
                'name' => 'title',
                'id'=>'title',
                'placeholder' => '',
                'class' => $inputClass,
                'minlength'=>'15',
                'maxlength'=>'100',
                'value' => set_value('title')
            );
            echo form_input($data);
            ?>

            <div id="name_tooltip" class="tooltip" style="left: 430px">
                <div id="name_tooltip_triangle" class="triangle">&nbsp;</div>
                <span></span>
                <div class="tooltip_content" style="width: 160px">
                    <span id="tooltip_content">Ví dụ: <span style="color: red">Cho thuê nhà trọ ở quận 12</span> hoặc <span style="color: red">Tìm Nam /Nữ ở ghép 500k/người, Q.Tân Phú</span></span>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row">
        <?php echo form_label('Tên Người Liên Hệ'.$required.':','username',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <?php
            $data = array(
                'name'=>'username',
                'id'=>'username',
                'placeholder' => '',
                'class' => $inputClass,
                'maxlength'=>'50'
            );
            echo form_input($data);
            ?>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row hethan">
        <?php echo form_label('Ngày Hết Hạn'.$required.':','',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <?php
            $data = array(
                'name'=>'datepicker',
                'id'=>'datepicker',
                'placeholder' => 'Hãy click vào đây',
                'class' => $inputClass,
                'pattern'=>'(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-([0-9]{4})',
                'style'=>'width: 110px'
            );
            echo form_input($data);
            ?>

            <div id="name_tooltip" class="tooltip" style="left: 125px">
                <div id="name_tooltip_triangle" class="triangle">&nbsp;</div>
                <div class="tooltip_content" style="width: 300px">
                    <span id="tooltip_content">Nếu để trống thì mặc định là 1 tháng. Hãy điền đúng định dạng: DD-MM-YYYY. VD: <?php echo date('d-m-Y'); ?></span>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row">
        <?php echo form_label('Số Điện Thoại'.$required.':','phone',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <?php
            $data = array(
                'name'=>'phone',
                'id'=>'phone',
                'placeholder' => '',
                'class' => $inputClass,
                'maxlength'=>'20',
                'style'=>'width: 115px'
            );
            echo form_input($data);
            ?>

            <div id="name_tooltip" class="tooltip" style="left: 128px">
                <div id="name_tooltip_triangle" class="triangle">&nbsp;</div>
                <div class="tooltip_content" style="width: 270px">
                    <span id="tooltip_content">Điền đầy đủ mã vũng nếu là số điện thoại cố định.</span>
                </div>
                <div class="clear"></div>
            </div>

        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row">
        <?php echo form_label('Email:','email',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <?php
            $data = array(
                'name'=>'email',
                'id'=>'email',
                'placeholder' => 'example@abc.com',
                'class' => $inputClass,
                'maxlength'=>'30'
            );
            echo form_input($data);
            ?>

            <div id="name_tooltip" class="tooltip" style="display: none">
                <div id="name_tooltip_triangle" class="triangle">&nbsp;</div>
                <div class="tooltip_content" style="width: 210px">
                    <span id="tooltip_content">Ví dụ: <span style="color: red">example@abc.com</span></span>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row">
        <div class="ai_label"></div>

        <div class=<?=$formGroup?>>
            <span>Quận<span style="color: red">*</span></span>
            <select id="district" name="district" onchange="showWard(this.value)" class="selectpicker" data-width="150px">
                <?php $query = $this->mdistrict->getAll() ?>
                <?php foreach($query as $row): ?>
                    <?php $name = explode(" ", $row['ten']) ?>
                    <option value="<?=$row['id'];?>"><?php if(count($name) > 2) echo $name[1].' '.$name[2]; else echo $name[0].' '.$name[1];?></option>
                <?php endforeach; ?>
            </select>

            <span>Phường<span style="color: red">*</span></span>
            <select id="ward" name="ward" class="selectpicker"></select>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row" style="margin-top: 23px">
        <?php echo form_label('Địa Chỉ'.$required.':','',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <?php
            $data = array(
                'name'=>'subAddress',
                'id'=>'subAddress',
                'placeholder' => 'VD: 232/3 Lý Thường Kiệt, P.15, Q.10',
                'class' => $inputClass,
                'style' => 'width: 255px'
            );
            echo form_input($data);
            ?>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row">
        <?php echo form_label('Chuyên Mục'.$required.':','',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <select name="category" class="selectpicker">
                <?php $query = $this->mcategory->getAll() ?>
                <?php foreach($query as $row): ?>
                    <option value="<?=$row['id']?>"><?=$row['ten']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row">
        <?php echo form_label('Diện Tích'.$required.':','area',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <?php
            $data = array(
                'type' => 'number',
                'name'=>'area',
                'id'=>'area',
                'placeholder' => 'VD: 10.5',
                'class' => $inputClass,
                'style' => 'width: 70px',
                'step' => '0.1',
                'maxlength' => '10',
                'min' => '0'
            );
            echo form_input($data);
            ?>
            <span>m<sup>2</sup></span>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row">
        <?php echo form_label('Giá Phòng'.$required.':','price',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <?php
            $data = array(
                'type' => 'number',
                'name'=>'price',
                'id'=>'price',
                'placeholder' => 'VD: 2.5',
                'class' => $inputClass,
                'style' => 'width: 60px',
                'step' => '0.1',
                'maxlength' => '50',
                'min' => '0'
            );
            echo form_input($data);
            ?>
            <span id="pri"></span>VNĐ
        </div>

        <div id="priceEx">
            <label><input type="checkbox" name="ePrice" value="1">Bao gồm tiền điện</label>
            <label><input type="checkbox" name="wPrice" value="1">Bao gồm tiền nước</label>
            <label style="display: inline-block"><input type="checkbox" name="prePay" id="prePay" value="1">Đặt cọc trước</label><span style="margin-left: 20px"><input id="monRe" name="monRe" type="number" min="1" disabled style="width: 35px">tháng</span>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row smallIssue">
        <label class="ai_label" style="top: -60px">Các Tiện Ích Khác:</label>

        <div class=<?=$formGroup?>>
            <label><input type="checkbox" name="dexe" value="1">Có Chỗ Để Xe</label>
            <label><input type="checkbox" name="santhuong" value="1">Có Sân Thượng</label>
            <label><input type="checkbox" name="gantruong" value="1">Gần Trường Đại Học Bách Khoa TPHCM</label>
            <label><input type="checkbox" name="gantramxe" value="1">Gần Trạm Xe Bus</label>
            <label><input type="checkbox" name="songchung" value="1">Sống Chung Với Chủ Nhà</label>
            <label><input type="checkbox" name="nauan" value="1">Có Cho Nấu Ăn</label>
            <label><input type="checkbox" name="net" value="1">Có Internet</label>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row smallIssue">
        <label class="ai_label" style="top: -20px">Yêu Cầu Đối Với Người Thuê:</label>

        <div class=<?=$formGroup?>>
            <label><input type="checkbox" name="hutthuoc" value="1">Không Hút Thuốc</label>
            <label><input type="checkbox" name="nhau" value="1">Không Ăn Nhậu Trong Phòng</label>
            <label><input type="checkbox" name="vekhuya" value="1">Không Về Khuya</label>
            <label><input type="checkbox" name="svthue" value="1">Chỉ Cho Sinh Viên Thuê</label>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row">
        <?php echo form_label('Nội Dung'.$required.':', 'content', array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <textarea id="content" name="content" class="form-control"
                      minlength="30" maxlength="3000"
                      cols="65" rows="10"
                      placeholder="Điền nội dung thông tin chi tiết về nhà trọ bạn muốn/cho thuê. Tối thiểu 30 kí tự, tối đa 3000 kí tự."><?php if(isset($_POST['content'])) echo $_POST['content']; ?></textarea>

            <div id="name_tooltip" class="tooltip" style="left: 450px;">
                <div id="name_tooltip_triangle" class="triangle" style="">&nbsp;</div>
                <span></span>
                <div class="tooltip_content" style="width: 145px;border: none;text-align: justify;background: #E6DFB2;color: rgb(20, 19, 19);text-align: justify">
                    <span id="tooltip_content">Ví dụ: Nhà có vị trí thuận lợi, gần công viên, gần trường học, diện tích 15m<sup>2</sup>, ở riêng với chủ nhà, có chỗ để xe, an ninh...</span>
                </div>
                <div class="clear"></div>
            </div>

        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row">
        <?php echo form_label('Hình ảnh'.$required.':', '', array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <?php echo form_label('<img src="'.asset_url().'image/upload-512.png">Tải hình lên','uploadFile', array('class'=>'uploadFile')) ?>
            <input type="file" id="uploadFile" name="uploadFile[]" accept="image/jpeg, image/gif, image/png, image/jpg" multiple>
            <?php
            $data = array(
                'id' => 'uploadFile',
                'name' => 'uploadFile[]',
                'accept' => 'image/jpeg, image/gif, image/png, image/jpg'
            );
            echo form_upload($data);
            ?>
            <span class="warning">Bạn chỉ có thể tải tối đa 8 hình, mỗi hình không quá 1M với các định dạng ipg, gif, jpeg, png.</span>
        </div>

        <div class="clear"></div>
    </div>

    <div class="ai_row" id="preview"></div>

    <div class="ai_row">
        <?php echo form_label('Mã an toàn'.$required.':','security_code',array('class'=>'ai_label')) ?>

        <div class=<?=$formGroup?>>
            <img src="modules/CaptchaSecurityImages.php" id="captcha" style="float: left">
            <a href="#" id="reload" title="reload" style="float: left"><img src="<?=asset_url()?>image/reload.png" style="width: 35px"></a>
            <input class="input_short" id="security_code" name="security_code" type="text" style="position:relative;top: 5px;width: 90px">
        </div>

        <div class="clear"></div>
    </div>
    <div class="ai_row">
        <div class="click">
            <input type="submit" value="Đăng tin" name="submit" class="btn btn-primary btn-lg">
        </div>
    </div>
<?php echo form_close() ?>