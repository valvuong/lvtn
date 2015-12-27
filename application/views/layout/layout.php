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

    <?php if($this->muser->is_authenticated()): ?>
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
    <?php endif ?>

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
<?php if($this->muser->is_authenticated()) { 
     if (!$this->mpost_reservation->check_reservation_post($this->session->userdata(LABEL_LOGIN)['id'], $this->uri->segment(3))) { ?>
    <!-- Modal reservation Post-->
    <div id="reservation-post" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Đăng Kí Đặt Trước</h4>
          </div>
          <div class="modal-body">
            <form id='reservation-form' action="post/create_reservation_post" method="get">
                <div class="form-group">
                    <label>Số Phòng Muốn Đăng Kí</label>
                    <input type="number" name="reservation-nums-room" class="form-control" min="0">
                </div>
                <div class="form-group">
                    <label>Số Người Muốn Đăng Kí</label>
                    <input type="number" name="reservation-nums-people" class="form-control" min="0">
                </div>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="reservation-name" value='<?=$this->session->userdata(LABEL_LOGIN)['username']?>' class="form-control">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="reservation-phone" value='<?=$this->session->userdata(LABEL_LOGIN)['phone']?>' class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="reservation-email" value='<?=$this->session->userdata(LABEL_LOGIN)['email']?>' class="form-control">
                </div>
                <div class='form-group'>
                    <input type='hidden' name='idBantin' value='<?=$this->uri->segment(3)?>'>
                </div>
                <div class="modal-footer">
                    <button type="submit" id='submit-reservation-post' class="btn btn-default" data-dismiss="modal">Đăng Kí</button>
                  </div>
            </form>
          </div>
        </div>

      </div>
    </div>
    <?php } else { ?>
        <!-- Update Modal reservation Post-->
    <div id="update-reservation-post" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sủa Tin Đăng Kí Đặt Trước</h4>
          </div>
          <div class="modal-body">
            <form id='update-reservation-form' action="post/update_reservaion_post" method="get">
                <div class="form-group">
                    <label>Số Phòng Muốn Đăng Kí</label>
                    <input type="number" name="update-reservation-nums-room" value='<?=$this->mpost_reservation->get_reservation_num($this->session->userdata(LABEL_LOGIN)['id'], $this->uri->segment(3))['sophong'] ?>' class="form-control" min="0">
                </div>
                <div class="form-group">
                    <label>Số Người Muốn Đăng Kí</label>
                    <input type="number" name="update-reservation-nums-people" value='<?=$this->mpost_reservation->get_reservation_num($this->session->userdata(LABEL_LOGIN)['id'], $this->uri->segment(3))['songuoi'] ?>' class="form-control" min="0">
                </div>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="update-reservation-name" value='<?=$this->session->userdata(LABEL_LOGIN)['username']?>' class="form-control">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="update-reservation-phone" value='<?=$this->session->userdata(LABEL_LOGIN)['phone']?>' class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="update-reservation-email" value='<?=$this->session->userdata(LABEL_LOGIN)['email']?>' class="form-control">
                </div>
                <div class='form-group'>
                    <input type='hidden' name='idBantin' value='<?=$this->uri->segment(3)?>'>
                </div>
                <div class="modal-footer">
                    <button type="submit" id='submit-update-reservation-post' class="btn btn-default" data-dismiss="modal">Cập nhật</button>
                  </div>
            </form>
          </div>
        </div>

      </div>
    </div>
<?php } } ?>
<script>
$(document).ready(function(){
    $('#submit-reservation-post').click(function(){
        $.ajax({
            url: '<?=base_url()?>' + 'post/create_reservation_post', //this is the submit URL
            type: 'GET', //or POST
            data: $('#reservation-form').serialize(),
            success: function(data){
                 alert('Đăng ký đặt phòng trước thành công');
                 location.reload();
            }
        });
    });
});
$(document).ready(function(){
    $('#submit-update-reservation-post').click(function(){
        $.ajax({
            url: '<?=base_url()?>' + 'post/update_reservation_post', //this is the submit URL
            type: 'GET', //or POST
            data: $('#update-reservation-form').serialize(),
            success: function(data){
                 alert('Cập nhật thành công');
                 location.reload();
            }
        });
    });
});
</script>
</body>
</html>