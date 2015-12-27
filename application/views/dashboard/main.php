<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUẢN LÝ TÀI KHOẢN</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo bootstrap_url()?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo asset_url()?>dashboard/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!-- <link href="css/plugins/morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="<?php echo asset_url()?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="icon" type="image/png" href="<?php echo image_url() ?>icon.png">

    <!-- jQuery -->
    <script src="<?php echo js_url()?>jquery-2.1.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo bootstrap_url()?>js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="js/plugins/morris/raphael.min.js"></script> -->
    <!-- <script src="js/plugins/morris/morris.min.js"></script> -->
    <!-- <script src="js/plugins/morris/morris-data.js"></script> -->
</head>

<body>
<?php
if ($display_name == null) {
    $display_name = $this->session->userdata(LABEL_LOGIN)['username'];
}
?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('home') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Quay Lại Trang Chủ</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo $display_name ?></strong></h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $display_name ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?=site_url('dang-xuat') ?>"><i class="fa fa-fw fa-power-off"></i> Thoát</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <?php
                    $method = $this->router->fetch_method();
                    ?>
                    <li class="<?php if($method == 'dashboard') echo 'active' ?>">
                        <a href="<?php echo site_url('user/dashboard'); ?>"><i class="fa fa-info"></i> Thông Tin Tải Khoản</a>
                    </li>
<<<<<<< HEAD
                    <li>
                        <a href="<?php echo site_url('user/market'); ?>"><i class="fa fa-fw fa-edit"></i> Quản lý bài đăng chỗ ở</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('dashboard/manage_post_reservation'); ?>"><i class="fa fa-fw fa-edit"></i> Quản lý đăng ký đặt trước</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(''); ?>"><i class="fa fa-fw fa-edit"></i> Quản lý phương tiện học tập</a>
=======
                    <li class="<?php if($method == 'change_password') echo 'active' ?>">
                        <a href="<?php echo site_url('user/change_password'); ?>"><i class="fa fa-lock"></i> Đổi Mật Khẩu</a>
                    </li>
                    <li class="<?php if($method == 'change_avatar') echo 'active' ?>">
                        <a href="<?php echo site_url('user/change_avatar'); ?>"><i class="fa fa-picture-o"></i> Đổi Ảnh Đại Diện</a>
                    </li>
                    <li  class="<?php if($method == 'manage_market') echo 'active' ?>">
                        <a href="<?php echo site_url('user/manage_market'); ?>"><i class="fa fa-fw fa-pencil"></i> Phương Tiện Học Tập</a>
                    </li>
                    <li  class="<?php if($method == 'manage_post') echo 'active' ?>">
                        <a href="<?php echo site_url('user/manage_post'); ?>"><i class="fa fa-fw fa-home"></i> Tin Nhà Trọ</a>
>>>>>>> 10bf313b1b5f88e2926f409c3a7d3b66db68cf7a
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?php $this->load->view($view, $content) ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
