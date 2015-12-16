<link rel="stylesheet" type="text/css" href="<?php echo css_url() ?>ad-article.css">

<?php
$status = array(0=>'Mới', 1=>'Đã Sử Dụng');
?>

<h3 class="ad-title"><?php echo mb_strtoupper($content['tieude'],'utf8'); ?></h3>
<div class="ad-contact">
    <div class="sub">
        <p><strong>Tên Liên Hệ:</strong><span><?=$content['tenlienhe']?></span></p>
        <div class="clear"></div>
        <p><strong>Số Điện Thoại:</strong><span><?=$content['sodienthoai']?></span></p>
        <div class="clear"></div>
        <p><strong>Giá Phòng:</strong><span><?=number_format($content['giaca']*1000000)?> VNĐ</span></p>
        <div class="clear"></div>
        <p><strong>Tình Trạng:</strong><span><?=$status[$content['tinhtrang']]?></span></p>
        <div class="clear"></div>
        <p><strong>Ngày Đăng:</strong><span><?=date('H:i d/m/Y',strtotime($content['ngaydang']))?></span></p>
        <div class="clear"></div>
        <p>
            <strong>Loại:</strong>
            <span>
                <a href="<?php echo site_url('rao-vat-'.$content['loai']) ?>"><?=$content['tenloai']?></a>,
                <a href="<?php echo site_url('') ?>"><?=$content['tenloaisp']?></a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
</div>
<div class="content">
    <?php echo $content['noidung'] ?>
</div>
<?php if (!empty($content['tenhinh'])): ?>
    <div class="ad-gallery">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php $i = 0 ?>
                <?php foreach($content['tenhinh'] as $image): ?>
                    <div class="item <?php if($i==0) echo 'active'; ?>">
                        <img src="<?=uploads_url()?>market/<?=$image['tenhinh']?>">
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
<?php endif; ?>