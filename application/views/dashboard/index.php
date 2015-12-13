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
        $('.cancel').click(function(){
            var thisElement = $(this);
            thisElement.parent().hide();
            thisElement.parent().prev().slideDown();
            var tdInput = thisElement.parent().parent().prev();
            tdInput.find('.edit-field').hide();
            tdInput.find('span').slideDown();
        });
    });
</script>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info"></i> Thông Tin Cá Nhân</h3>
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
                                    <span><?php echo $info['name'] ?></span>
                                    <input class="form-control edit-field">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit">Sửa</button>
                                    <div class="save-cancel">
                                        <button class="btn btn-success save">Lưu</button>
                                        <button class="btn btn-warning cancel">Hủy</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Giới Tính</th>
                                <td>
                                    <span><?php if($info['sex'] != null) {$gender = array('Nam', 'Nữ'); echo $gender[$info['sex']];} ?></span>
                                    <div class="form-group edit-field">
                                        <label><input type="radio" value="0" name="gender" <?php if($info['sex'] == 0) echo 'selected' ?>>Nam</label>
                                        <label><input type="radio" value="1" name="gender" <?php if($info['sex'] == 1) echo 'selected' ?>>Nữ</label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit">Sửa</button>
                                    <div class="save-cancel">
                                        <button class="btn btn-success save">Lưu</button>
                                        <button class="btn btn-warning cancel">Hủy</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Địa Chỉ</th>
                                <td>
                                    <span><?php echo $info['address'] ?></span>
                                    <input class="form-control edit-field">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit">Sửa</button>
                                    <div class="save-cancel">
                                        <button class="btn btn-success save">Lưu</button>
                                        <button class="btn btn-warning cancel">Hủy</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Số Điện Thoại</th>
                                <td>
                                    <span><?php echo $info['phone'] ?></span>
                                    <input class="form-control edit-field">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit">Sửa</button>
                                    <div class="save-cancel">
                                        <button class="btn btn-success save">Lưu</button>
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

<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">26</div>
                        <div>New Comments!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">12</div>
                        <div>New Tasks!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">124</div>
                        <div>New Orders!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">13</div>
                        <div>Support Tickets!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->