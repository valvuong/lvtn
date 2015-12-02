<link rel="stylesheet" type="text/css" href="<?php echo css_url() ?>post-article.css">
<script type="text/javascript" src="<?php echo js_url()?>gmap_distant.js"></script>

<h3 class="title"><?php echo mb_strtoupper($content['tieude'],'utf8'); ?></h3>
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
    </fieldset>

    <?php $this->load->view($additional, $content['thongtinbosung']); ?>

    <fieldset>
        <legend style="width: 189px">Thông Tin Liên Hệ</legend>
        <p><strong>Tên Người Liên Hệ:</strong><span><?=$content['hoten']?></span></p>
        <div class="clear"></div>
        <p><strong>Địa Chỉ:</strong><span><?=$content['diachi']?></span></p>
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