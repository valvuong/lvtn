<h3 class="title"><?php echo mb_strtoupper($content['tieude'],'utf8'); ?></h3>
<div class="contact">
    <fieldset>
        <legend>Thông Tin Liên Hệ</legend>
        <p><strong>Tên Người Liên Hệ:</strong><span><?=$content['hoten']?></span></p>
        <div class="clear"></div>
        <p><strong>Địa Chỉ:</strong><span><?=$content['diachi']?></span></p>
        <div class="clear"></div>
        <p><strong>Số Điện Thoại:</strong><span><?=$content['sodienthoai']?></span></p>
        <div class="clear"></div>
        <p><Strong>Email:</strong><span><?=$content['email']?></span></p>
    </fieldset>
    <fieldset>
        <legend>Thông Tin Nhà Trọ</legend>
        <p><strong>Ngày Đăng:</strong><span><?=date('d/m/Y',strtotime($content['ngaydang']))?></span></p>
        <div class="clear"></div>
        <p><strong>Ngày Hết Hạn:</strong><span><?=date('d/m/Y',strtotime($content['hethan']))?></span></p>
        <div class="clear"></div>
        <p><strong>Diện Tích:</strong><span><?=$content['dientich']?> m<sup>2</sup></span></p>
        <div class="clear"></div>
        <p><strong>Giá Phòng:</strong><span><?=number_format($content['giaphong']*1000000)?> VNĐ</span></p>
        <div class="clear"></div>
        <p>
            <strong style="color: transparent">hidden text</strong>
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
        <p><strong>Quận:</strong><span><?=$content['tenquan']?></span></p>
    </fieldset>
</div>

<div class="detail-content">
    <h4 class="detail-title">Nội Dung Chi Tiết</h4>
    <div class="detail"><?=$content['noidung']?></div>
</div>

<div class="gallery">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php $i = 0 ?>
            <?php foreach($content['tenhinh'] as $image): ?>
                <div class="item <?php if($i==0) echo 'active'; ?>">
                    <img src="<?=asset_url()?>uploads/<?=$image['tenhinh']?>">
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
</div>

<style>
    .clear {
        clear: both;
    }
    #content {
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        padding: 9.5px;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 70%;
    }
    @media screen and (max-width: 900px) {
        #content {
            width: 90%;
        }
    }
    fieldset {
        width: 50%;
        display: inline-block;
        float: left;
    }
    fieldset legend {
        color: #ff0a61;
        text-align: center;
    }
    fieldset p strong, fieldset p span {
        float: left;
    }
    @media screen and (max-width: 600px) {
        #content {
            width: 100%;
        }
    }
    @media screen and (max-width: 700px) {
        fieldset {
            width: 100%;
        }
    }
    .contact {
        margin-top: 20px;
        display: inline-block;
        width: 100%;
    }
    .contact p {
        margin-bottom: 8px;
        font-size: 13px;
    }
    .contact p strong {
        display: inline-block;
        width: 35%;
        text-align: right;
        margin-right: 20px;
    }
    .item {
        height: 300px;
    }
    .item img {
        height: 100% !important;
        margin: 0 auto;
    }
    .title {
        background: none;
        color: #66BB6A;
        text-align: center;
        font-weight: bold;
    }
    .detail-content {
        width: 80%;
        margin: 0 auto;
        border-left: 5px solid #1b809e;
        padding-left: 5px;
    }
    .detail-title {
        margin-top: 20px;
        font-size: 23px;
        color: #1b809e;
    }
    .detail {
        text-align: justify;
    }

    .gallery {
        margin-top: 50px;
    }
    .carousel {
        display: inline-block;
        min-width: 480px;
        left: 50%;
        transform: translateX(-50%);
    }
    .carousel-inner {
        margin: 0 auto;
    }
    .carousel-control {
        width: 40px;
        height: 40px;
    }
    .carousel-control.left, .carousel-control.right {
        top: 50%;
        background-image: none;
    }
    .carousel-control.left {
        transform: translateX(-100%);
    }
    .carousel-control.right {
        transform: translateX(100%);
    }
    .glyphicon.size40 {
        font-size: 40px;
        color: #000000;
    }
</style>