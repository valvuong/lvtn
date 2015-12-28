<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="application/json">
    <meta content="text/html">
    <meta content="application/javascript">
    <title><?php echo isset($title) ? $title : 'Hỗ trợ sinh viên'; ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo bootstrap_url()?>css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url()?>style.css">

    <script type="text/javascript" src="<?php echo js_url()?>jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="<?php echo bootstrap_url()?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url()?>bootstrap-select/bootstrap-select.js"></script>
    <script type="text/javascript" src="<?php echo js_url()?>main.js"></script>
    <script type="text/javascript" src="<?php echo js_url()?>search-filter.js"></script>
    
    <link rel="icon" type="image/png" href="<?php echo image_url() ?>icon.png">
</head>
<body class="container">
    <a href="#" id="gotop" class="fbtn"><span class="x-icon glyphicon glyphicon-chevron-up"></span></a>

    <nav>
        <div class="cssmenu">
            <ul>
                <li><a href="<?=site_url('nha-0') ?>">Trang Chủ</a></li>
                <li class="drop-down-menu">
                    <a href="javascript:void(0)" class="click-dropdown">Chuyên Mục</a>
                    <ul>
                        <?php $query = $this->mpost_category->get_all() ?>
                        <?php foreach ($query as $row): ?>
                            <li>
                                <a href="<?php echo site_url('loai-'.$row['id']) ?>">
                                    <?=$row['ten']?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li><a href="<?=site_url('tin-vat')?>">Phương Tiện Học Tập</a></li>
                <?php if(!$this->session->userdata(LABEL_LOGIN)): ?>
                    <li class="float-right href-none-after">
                        <a href="<?=site_url('dang-nhap')?>" title="Đăng Nhập"><i class="fa fa-lock"></i></a>
                    </li>
                <?php else: ?>
                    <li class="float-right href-none-after more-ops" style="position: relative">
                        <a href="javascript:void(0)" style="padding: 14px 10px"><span class="glyphicon glyphicon-option-vertical"></span></a>
                        <ul class="more-options href-none-before">
                            <li><a href="<?php echo site_url('dang-xuat')?>">Thoát</a></li>
                            <li><a href="<?php echo site_url('tai-khoan')?>">Tài Khoản</a></li>
                        </ul>
                    </li>
                    <li class="float-right avatar-icon">
                        <a href="<?=site_url('tai-khoan')?>">
                            <img src="<?php echo uploads_url().'user/'.$this->session->userdata(LABEL_LOGIN)['avatar'] ?>">
                        </a>
                    </li>
                <?php endif; ?>
                <!-- <li class="float-right task href-none-after">
                    <a href="javascript:void(0)" class="click-dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                    <ul>
                        <li><a href="<?=site_url('buon-ban')?>">Rao Vặt</a></li>
                        <li><a href="<?=site_url('dang-tin')?>">Đăng Tin</a></li>
                        <?php if(!$this->session->userdata(LABEL_LOGIN)): ?>
                            <li><a href="<?=site_url('dang-ki')?>">Đăng Kí</a></li>
                            <li><a href="<?=site_url('dang-nhap')?>">Đăng Nhập</a></li>
                        <?php else: ?>
                            <li><a href="<?=site_url('dang-xuat')?>">Đăng Xuất</a></li>
                            <li><a href="<?=site_url('tai-khoan')?>">Tài Khoản</a></li>
                        <?php endif; ?>
                    </ul>
                </li> -->
                <li class="drop-down-menu float-right">
                    <a href="javascript:void(0)" class="click-dropdown">Đăng Tin</a>
                    <ul>
                        <li class="href-none-after"><a href="<?=site_url('buon-ban')?>">Phương Tiện Học Tập</a></li>
                        <li class="href-none-after"><a href="<?=site_url('dang-tin')?>">Nhà Trọ</a></li>
                    </ul>
                </li>
                <!-- <li class="float-right search-main">
                    <form action="search" method="get">
                        <input type="text" name="search" placeholder="Nhập Từ Khóa">
                        <span class="glyphicon glyphicon-search"></span>
                    </form>
                </li> -->
            </ul>
        </div>
    </nav>

    <?php $this->load->view('layout/header'); ?>

    <div class="body-content">
        <?php if(!isset($left_hidden)) {
            $this->load->view($left_view, $left_content);    
        } ?>

        <?php if(!isset($right_hidden)){
            $this->load->view($right_view, $right_content);
        } ?>

        <?php
        $content_class = 'float-left';
        if (isset($left_hidden)) {
            if (!isset($right_hidden)) {
                $content_class = 'float-right';
            } else {
                $content_class .= ' main-center';
            }
        }
        ?>

        <div id="content" class="<?=$content_class?>">
            <?php $this->load->view($view, $content) ?>
        </div>

    </div>
    <?php $this->load->view('layout/footer') ?>


    <?php
    // for post-sort
    $this_class_name = $this->router->fetch_class();
    $this_method_name = $this->router->fetch_method();
    if ($this_class_name != 'post' && $this_method_name != 'get_all') {
        $this->input->set_cookie(COOKIE_POST_SORT, 0, 0);
    }
    ?>

    
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<?php if($view == 'post/index_base')
    $this->load->view('post/reservation',$content); ?>
</body>
</html>