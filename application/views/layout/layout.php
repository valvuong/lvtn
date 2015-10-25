<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="application/json">
    <meta content="text/html">
    <meta content="application/javascript">
    <title><?php echo isset($title) ? $title : 'Hỗ trợ sinh viên'; ?></title>
	
	
	
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/search.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/header.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cookie">

    <script type="text/javascript" src="<?php echo asset_url()?>js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url()?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url()?>bootstrap-select/bootstrap-select.js"></script>
    <script type="text/javascript" src="<?php echo asset_url()?>js/main.js"></script>
    <script type="text/javascript" src="<?php echo asset_url()?>js/search-filter.js"></script>

    <link rel="icon" type="image/png" href="<?php echo asset_url(); ?>image/icon.png">

</head>
<body>
    <a href="#" id="gotop" class="fbtn"><span class="icon glyphicon glyphicon-chevron-up"></span></a>

    <nav>
        <div id="cssmenu">
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
                <li><a href="<?=site_url()?>">Chợ</a></li>
				
                <li class="float-right task">
                    <a href="javascript:void(0)" class="click-dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                    <ul>
                        <li><a href="<?=site_url('buon-ban')?>">Buôn Bán</a></li>
                        <li><a href="<?=site_url('dang-tin')?>">Đăng Tin</a></li>
                        <li><a href="<?=site_url('dang-ki')?>">Đăng Kí</a></li>
                        <li><a href="<?=site_url('dang-nhap')?>">Đăng Nhập</a></li>
                    </ul>
                </li>
				<?php $this->load->view('user');?>
            </ul>
        </div>
    </nav>

    <?php $this->load->view('layout/header'); ?>

    <div class="body-content container">
        <?php if(!isset($left_hidden)): ?>
            <div id="left">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title search-title">Tìm Kiếm</h2>
                    </div>
                    <div class="panel-search">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Chọn Chuyên Mục</h3>
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign"></i></span>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <?php $query = $this->mcategory->get_all() ?>
                                    <?php foreach($query as $row): ?>
                                        <li><label><input type="checkbox" name="category[]" value="<?=$row['id']?>"><?=$row['ten']?></label></li>
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
                                    <?php $query = $this->db->get('dientich') ?>
                                    <?php foreach($query->result_array() as $row): ?>
                                        <li><label><input type="checkbox" name="category[]" value="<?=$row['value']?>"><?=$row['text']?></label></li>
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
                                    <?php $query = $this->db->get('giaphong') ?>
                                    <?php foreach($query->result_array() as $row): ?>
                                        <li><label><input type="checkbox" name="category[]" value="<?=$row['value']?>"><?=$row['text']?></label></li>
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
                                    <?php $query = $this->mdistrict->get_all() ?>
                                    <?php foreach($query as $row): ?>
                                        <li><label><input type="checkbox" name="category[]" value="<?=$row['idQ']?>"><?=$row['tenquan']?></label></li>
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
</body>
</html>