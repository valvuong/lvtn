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
    <link rel="stylesheet" type="text/css" href="<?php echo css_url()?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url()?>main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url()?>footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url()?>search.css">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url()?>menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url()?>header.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cookie">

    <script type="text/javascript" src="<?php echo js_url()?>jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="<?php echo bootstrap_url()?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url()?>bootstrap-select/bootstrap-select.js"></script>
    <script type="text/javascript" src="<?php echo js_url()?>main.js"></script>
    <script type="text/javascript" src="<?php echo js_url()?>search-filter.js"></script>
    
    <link rel="icon" type="image/png" href="<?php echo image_url() ?>icon.png">
</head>
<body>
    <a href="#" id="gotop" class="fbtn"><span class="x-icon glyphicon glyphicon-chevron-up"></span></a>

    <nav>
        <div class="cssmenu">
            <ul>
                <li><a href="<?=site_url('') ?>">Trang Chủ</a></li>
                <li class="drop-down-menu">
                    <a href="javascript:void(0)" class="click-dropdown">Chuyên Mục</a>
                    <ul>
                        <?php $query = $this->mcategory->get_all() ?>
                        <?php foreach ($query as $row): ?>
                            <li>
                                <a href="<?php echo site_url('loai-'.$row['id']) ?>">
                                    <?=$row['ten']?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li><a href="<?=site_url('tin-vat')?>">Rao Vặt</a></li>
                <?php if(!$this->session->userdata('logged_in')): ?>
                    <li class="float-right href-none-after">
                        <a href="<?=site_url('dang-nhap')?>" title="Đăng Nhập"><i class="fa fa-lock"></i></a>
                    </li>
                <?php else: ?>
                    <li class="float-right avatar-icon href-none-after">
                        <a href="<?=site_url('tai-khoan')?>"><img src="<?php echo image_url() ?>avatar-001.jpg"></a>
                    </li>
                <?php endif; ?>
                <!-- <li class="float-right task href-none-after">
                    <a href="javascript:void(0)" class="click-dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                    <ul>
                        <li><a href="<?=site_url('buon-ban')?>">Rao Vặt</a></li>
                        <li><a href="<?=site_url('dang-tin')?>">Đăng Tin</a></li>
                        <?php if(!$this->session->userdata('logged_in')): ?>
                            <li><a href="<?=site_url('dang-ki')?>">Đăng Kí</a></li>
                            <li><a href="<?=site_url('dang-nhap')?>">Đăng Nhập</a></li>
                        <?php else: ?>
                            <li><a href="<?=site_url('dang-xuat')?>">Đăng Xuất</a></li>
                            <li><a href="<?=site_url('tai-khoan')?>">Tài Khoản</a></li>
                        <?php endif; ?>
                    </ul>
                </li> -->
                <li class="float-right"><a href="<?=site_url('buon-ban')?>">Rao Vặt</a></li>
                <li class="float-right"><a href="<?=site_url('dang-tin')?>">Đăng Tin</a></li>
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

    <div class="body-content container">
        <?php if(!isset($left_hidden)): ?>
        <script type="text/javascript" src="<?php echo js_url()?>main-filter.js"></script>
            <div id="left">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title search-title"><span class="glyphicon glyphicon-search"></span> TÌM KIẾM</h2>
                    </div>
                    <div class="panel-search">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Chọn Chuyên Mục</h3>
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign"></i></span>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li><label><input type="radio" name="category" value="">Tất cả</label></li>
                                    <?php $query = $this->mcategory->get_all() ?>
                                    <?php foreach($query as $row): ?>
                                        <li><label><input type="radio" name="category" value="<?=$row['id']?>"><?=$row['ten']?></label></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Chọn Diện Tích</h3>
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign"></i></span>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li><label><input type="radio" name="area" value="">Tất cả</label></li>
                                    <?php $query = $this->db->get(SEARCH_AREA) ?>
                                    <?php foreach($query->result_array() as $row): ?>
                                        <li><label><input type="radio" name="area" value="<?=$row['value']?>"><?=$row['text']?></label></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Chọn Giá</h3>
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign"></i></span>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li><label><input type="radio" name="price" value="">Tất cả</label></li>
                                    <?php $query = $this->db->get(SEARCH_PRICE) ?>
                                    <?php foreach($query->result_array() as $row): ?>
                                        <li><label><input type="radio" name="price" value="<?=$row['value']?>"><?=$row['text']?></label></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Chọn Quận</h3>
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign"></i></span>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li><label><input type="radio" name="district" value="">Tất cả</label></li>
                                    <?php $query = $this->mdistrict->get_all() ?>
                                    <?php foreach($query as $row): ?>
                                        <li><label><input type="radio" name="district" value="<?=$row['idQ']?>"><?=$row['tenquan']?></label></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <div id="content">
            <?php $this->load->view($view, $content) ?>
        </div>

    </div>
    <?php $this->load->view('layout/footer') ?>
    <a id="example1" href="happy.jpg"><img alt="example1" src="happy.jpg" /></a>
</body>
</html>

<script>
    $("a#example1").fancybox();
</script>