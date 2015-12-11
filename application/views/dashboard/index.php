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
            var input = parentPrevious.find('input');
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
            tdInput.find('input').hide();
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
                                    <input class="form-control">
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
                                    <span><?php echo $info['sex'] ?></span>
                                    <input class="form-control">
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
                                    <input class="form-control">
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
                                    <input class="form-control">
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

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        <span class="badge">just now</span>
                        <i class="fa fa-fw fa-calendar"></i> Calendar updated
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">4 minutes ago</span>
                        <i class="fa fa-fw fa-comment"></i> Commented on a post
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">23 minutes ago</span>
                        <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">46 minutes ago</span>
                        <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">1 hour ago</span>
                        <i class="fa fa-fw fa-user"></i> A new user has been added
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">2 hours ago</span>
                        <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">yesterday</span>
                        <i class="fa fa-fw fa-globe"></i> Saved the world
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">two days ago</span>
                        <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                    </a>
                </div>
                <div class="text-right">
                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->