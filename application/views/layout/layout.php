<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="application/json">
    <meta content="text/html">
    <meta content="application/javascript">
    <title><?php echo isset($title) ? $title : 'Hỗ trợ sinh viên'; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>js/jquery-ui-1.11.4.custom/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>js/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>js/jquery-ui-1.11.4.custom/jquery-ui.structure.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/One.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/search.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/pagination.css">

    <script type="text/javascript" src="<?php echo asset_url()?>js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url()?>js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url()?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url()?>js/bootstrap-select.js"></script>
<!--    <script type="text/javascript" src="--><?php //echo asset_url(); ?><!--js/function.js"></script>-->
<!--    <script type="text/javascript" src="--><?php //echo asset_url(); ?><!--js/time.js"></script>-->
    <script type="text/javascript" src="<?php echo asset_url()?>js/search-filter.js"></script>

    <link rel="icon" type="image/png" href="<?php echo asset_url(); ?>image/icon.png">
    <script>
        $(function(){
            $('.selectpicker').selectpicker({
                size: 6
            });
        })
    </script>
</head>
<body class="container">
    <a href="#" id="gotop"><img src="<?php echo asset_url() ?>image/top.png"></a>
    <?php $this->load->view('layout/header'); ?>

    <nav>
        <div id="cssmenu">
            <ul>
                <li class="">
                    <a href="<?=site_url('welcome') ?>">Trang Chủ</a>
                </li>
                <li class="drop-down-menu last">
                    <a href="javascript:void(0)">Chuyên mục</a>
                    <ul>
                        <?php $query = $this->mcategory->getAll() ?>
                        <?php foreach ($query as $row): ?>
                            <li><a href="<?php echo site_url(array('post','showPostsByCategory',$row['id'])) ?>"><?=$row['ten']?></a></li>
                        <?php endforeach ?>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="body-content">
        <?php if(!isset($left)): ?>
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
                                    <?php $query = $this->mcategory->getAll() ?>
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
                                    <?php $query = $this->mdistrict->getAll() ?>
                                    <?php foreach($query as $row): ?>
                                        <li><label><input type="checkbox" name="category[]" value="<?=$row['id']?>"><?=$row['ten']?></label></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if(!isset($right)): ?>
            <div id="right">
                <div class="right">
                    <p>Tìm Kiếm</p>
                    <div class="search">
                        <form id="search" onsubmit="index.php" method="GET">
                            <select class="selectpicker" name="district" data-width="100%">
                                <option value="0" selected>Chọn Quận</option>
                                <?php $query = $this->mdistrict->getAll() ?>
                                <?php foreach($query as $row): ?>
                                    <option value="<?=$row['id']?>"><?=$row['ten']?></option>
                                <?php endforeach ?>
                            </select>
                            <select class="selectpicker" name="area" data-width="100%">
                                <option value="0" selected>Chọn diện tích</option>
                                <option value="30"><30 m2</option>
                                <option value="3050">30 - 50 m2</option>
                                <option value="5080">50 - 80 m2</option>
                                <option value="80100">80 - 100 m2</option>
                                <option value="100150">100 - 150 m2</option>
                                <option value="150200">150 - 200 m2</option>
                                <option value="200250">200 - 250 m2</option>
                                <option value="250">> 250 m2</option>
                            </select>
                            <select class="selectpicker" name="price" data-width="100%">
                                <option value="0" selected>Chọn giá</option>
                                <option value="1"> < 1 tr </option>
                                <option value="13"> 1 - 3 tr </option>
                                <option value="35"> 3 - 5 tr </option>
                                <option value="57"> 5 - 7 tr </option>
                                <option value="710"> 7 - 10 tr </option>
                                <option value="10"> > 10 tr </option>
                            </select>
                            <input class="btn btn-primary" type="submit" name="mod" value="Search">
                        </form>
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