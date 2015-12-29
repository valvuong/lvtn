<link rel="stylesheet" type="text/css" href="<?php echo css_url() ?>post-article.css">

<h3 class="title"><?php echo mb_strtoupper($content['tieude'],'utf8'); ?></h3>
<!---facebook api -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!---end facebook api -->
<div>
<?php
$idPost = $content['id'];
if ($this->muser->is_authenticated()) {
    $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        if ($this->mpost_reservation->check_reservation_post($idUser, $this->uri->segment(3))) {
        ?>
            <button type="button" class="btn btn-primary main-center" data-toggle="modal" data-target="#update-reservation-post">Sửa Đăng Kí</button>
            <button type="button" class="btn btn-danger main-center" data-toggle="modal" data-target="#delete-reservation-post">Hủy Đăng Kí</button>
        <?php
        } else if (!$this->mpost_reservation->check_reservation_free($this->uri->segment(3))) {
        ?>
        <button type="button" disabled class="btn btn-primary main-center" data-toggle="modal" data-target="#reservation-post">Không Thể Đăng Kí Trước</button>
        <?php 
        } else {
    ?>
    <button type="button" class="btn btn-primary main-center" data-toggle="modal" data-target="#reservation-post">Đăng Kí Trước</button>
    <?php
    }
    if ($this->mmanage_post->check_owner($idUser, $idPost)) { ?>
        <div class="table-responsive">
            <h3 class="text-center">Những Người Đặt Trước Tin Này</h3>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Số Phòng</th>
                        <th>Số Người</th>
                        <th>Tên</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($content['reservation'] as $k => $v): ?>
                    <tr>
                        <td><?=$k+1?></td>
                        <td><?php echo $v['sophong'] ?></td>
                        <td><?php echo $v['songuoi'] ?></td>
                        <td><?php echo $v['ten'] ?></td>
                        <td><?php echo $v['sodienthoai'] ?></td>
                        <td><?php echo $v['email'] ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
?>
</div>
<div class="contact">
    <fieldset>
        <legend style="width: 189px">Thông Tin Nhà Trọ</legend>
        <p><strong>Ngày Đăng:</strong><span><?=date('d/m/Y',strtotime($content['ngaydang']))?></span></p>
        <div class="clear"></div>
        <p><strong>Ngày Hết Hạn:</strong><span><?=date('d/m/Y',strtotime($content['hethan']))?></span></p>
        <div class="clear"></div>
        <p><strong>Diện Tích:</strong><span><?=$content['dientich']?> m<sup>2</sup></span></p>
        <div class="clear"></div>
        <p>
            <strong>Giá Phòng:</strong>
            <span><?=number_format($content['giaphong']*1000000)?> VNĐ</span>
            <span>
                <?php
                if((intval($content['tiendien']) + intval($content['tiennuoc'])) > 0 ) {
                    echo '(Bao gồm ';
                    if(intval($content['tiendien']) > 0) echo 'tiền điện';
                    if(intval($content['tiennuoc']) > 0) {
                        if(intval($content['tiendien']) > 0)
                            echo ', tiền nước';
                        else echo 'tiền nước';
                    }
                    echo ')';
                }
                ?>
            </span>
        </p>
        <div class="clear"></div>
        <p><strong>Đặt Cọc:</strong><span><?php if($content['datcoc'] > 0) echo $content['datcoc'].' tháng'; else echo 'không có'; ?></span></p>
        <div class="clear"></div>
        <p><strong>Phường:</strong><span><?=$content['tenphuong']?></span></p>
        <div class="clear"></div>
        <p><strong>Quận/Huyện:</strong><span><?=$content['tenquan']?></span></p>
        <div class="clear"></div>
        <p><strong>Cách Đại Học Bách Khoa:</strong><span><?=$content['khoangcach']?> km</span></p>
        <div class="clear"></div>
        <p><strong>Địa Chỉ:</strong><span><?=$content['diachi']?></span></p>
        <div class="clear"></div>
        <p><strong>Số Người Có Thể Ở:</strong><span><?=$content['songuoi']?></span></p>
        <div class="clear"></div>
        <p><strong>Số Phòng:</strong><span><?=$content['sophong']?></span></p>
        <div class="clear"></div>
    </fieldset>

    <?php 
    if ($content['thongtinbosung'] != null) {
        $this->load->view($additional, $content['thongtinbosung']);
    } 
    ?>

    <fieldset>
        <legend style="width: 189px">Thông Tin Liên Hệ</legend>
        <p><strong>Tên Người Liên Hệ:</strong><span><?=$content['hoten']?></span></p>
        <div class="clear"></div>
        <p><strong>Số Điện Thoại:</strong><span><?=$content['sodienthoai']?></span></p>
        <div class="clear"></div>
        <p><Strong>Email:</strong><span><?=$content['email']?></span></p>
    </fieldset>
</div>

<div class="detail-content">
    <fieldset>
        <legend style="width: 189px">Nội Dung Chi Tiết</legend>
        <div class="detail"><?=$content['noidung']?></div>
    </fieldset>
    <!-- <h4 class="detail-title"></h4> -->
</div>

<div class="gallery">
    <fieldset>
        <legend style="width: 105px">Hình Ảnh</legend>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php $i = 0 ?>
                <?php foreach($content['tenhinh'] as $image): ?>
                    <div class="item <?php if($i==0) echo 'active'; ?>">
                        <img src="<?=uploads_url()?>post/<?=$image['tenhinh']?>">
                    </div>
                    <?php $i++ ?>
                <?php endforeach ?>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-circle-arrow-left size40" aria-hidden="true"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-circle-arrow-right size40" aria-hidden="true"></span>
            </a>
        </div>
    </fieldset>
</div>

<div class="map">
    <head><?php echo $map['js'];?></head>
    <fieldset>
        <legend style="width: 100px">BẢN ĐỒ</legend>
        <div><?php echo $map['html'];?></div>
    </fielset>
</div>
<!--facebook-->
<div class="fb-like" data-href="https://google.com" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
<div class="fb-comments" data-href="http://google.com" data-numposts="5"></div>
<!--facebook-->
<div class="paging">
    <?php
    // for PREVIOUS post
    $result = $this->mpost->get_previous_post($idPost);
    if($result != null) {
        ?>
        <a href="<?php echo site_url('tin-'.$result['id']) ?>"><span aria-hidden="true">←</span>Tin Trước</a>
        <?php
    }
    // for NEXT post
    $result = $this->mpost->get_next_post($idPost);
    if($result != null) {
        ?>
        <a class="float-right" href="<?php echo site_url('tin-'.$result['id']) ?>">Tin Kế Tiếp<span aria-hidden="true">→</span></a>
        <?php 
    } 
    ?>
</div>
