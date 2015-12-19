<style type="text/css">
    .table>tbody>tr>td,
    .table>tbody>tr>th {
        vertical-align: middle;
    }
    .save-cancel {
        display: none;
    }
    .form-control {
        display: none;
    }
    .form-group {
        display: none;
        margin: 0;
    }
    label {
        margin: 0;
    }
    .min-width {
        min-width: 355px;
    }
</style>

<script type="text/javascript">
    $(function(){
        $('.edit').click(function(){
            var thisElement = $(this);
            var parent = thisElement.parent();
            var parentPrevious = parent.prev();
            var span = parentPrevious.find('span');
            span.hide();
            var input = parentPrevious.find('.edit-field');
            input.slideDown();
            input.val($.trim(parentPrevious.text()));
            thisElement.hide();
            thisElement.next().slideDown();
        });
        $('.cancel, .save').click(function(){
            var thisElement = $(this);
            thisElement.parent().hide();
            thisElement.parent().prev().slideDown();
            var tdInput = thisElement.parent().parent().prev();
            tdInput.find('.edit-field').hide();
            tdInput.find('span').slideDown();
        });
    });
    function save(field) {
        var input_field = $('#'+field);
        var value = input_field.val();
        var url = $('#url_ajax').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {field: field, value: value},
            dataType: "json",
            success: function(data) {
                if (field == 'sex') {
                    var text = ['Nam', 'Nữ'];
                    $(input_field).prev('span').text(text[value]);
                } else {
                    $(input_field).prev('span').text(value);
                }
                $(input_field).hide();
                $(input_field).prev('span').slideDown();
            },
            error: function() {
                alert('error');
            }
        });
    }
</script>

<!-- Page Heading -->
<input type="hidden" value="<?php echo base_url().'ajax/change_info' ?>" id="url_ajax">
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info"></i> Thông Tin Tải Khoản</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>Tên Đăng Nhập</th>
                                <td colspan="2"><?php echo $info['username'] ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td colspan="2"><?php echo $info['email'] ?></td>
                            </tr>
                            <tr>
                                <th>Tên Hiển Thị</th>
                                <td class="min-width">
                                    <span class="name"><?php echo $info['name'] ?></span>
                                    <input class="form-control edit-field" id="name">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit">Sửa</button>
                                    <div class="save-cancel">
                                        <button class="btn btn-success save" onclick="save('name')">Lưu</button>
                                        <button class="btn btn-warning cancel">Hủy</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Giới Tính</th>
                                <td>
                                    <span><?php if($info['sex'] != null) {$gender = array('Nam', 'Nữ'); echo $gender[$info['sex']];} ?></span>
                                    <select id="sex" class="form-group edit-field">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit">Sửa</button>
                                    <div class="save-cancel">
                                        <button class="btn btn-success save" onclick="save('sex')">Lưu</button>
                                        <button class="btn btn-warning cancel">Hủy</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Địa Chỉ</th>
                                <td>
                                    <span><?php echo $info['address'] ?></span>
                                    <input class="form-control edit-field" id="address">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit">Sửa</button>
                                    <div class="save-cancel">
                                        <button class="btn btn-success save" onclick="save('address')">Lưu</button>
                                        <button class="btn btn-warning cancel">Hủy</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Số Điện Thoại</th>
                                <td>
                                    <span><?php echo $info['phone'] ?></span>
                                    <input class="form-control edit-field" id="phone">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit">Sửa</button>
                                    <div class="save-cancel">
                                        <button class="btn btn-success save" onclick="save('phone')">Lưu</button>
                                        <button class="btn btn-warning cancel">Hủy</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->