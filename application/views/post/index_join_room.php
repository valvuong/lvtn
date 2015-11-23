<fieldset>
    <legend>Thông Tin Bổ Sung</legend>
    <?php if(!empty($anninh)): ?>
	    <p><strong>An Ninh</strong><span><?php echo $anninh ?></span></p>
	    <div class="clear"></div>
	<?php endif; ?>
	<?php if(!empty($naunuong)): ?>
	    <p><strong>Nấu Nướng</strong><span><?php echo $naunuong ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($chungchu)): ?>
	    <p><strong><!-- Chung Chủ Nhà --></strong><span><?php echo $chungchu ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($giogiac)): ?>
	    <p><strong><!-- Giờ Giấc --></strong><span><?php echo $giogiac ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($nhavesinh)): ?>
	    <p><strong><!-- Nhà Vệ Sinh --></strong><span><?php echo $nhavesinh ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($xebuyt)): ?>
	    <p><strong><!-- Các Tuyến Xe Buýt --></strong><span><?php echo $xebuyt ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($bancong)): ?>
	    <p><strong><!-- Ban Công --></strong><span><?php echo $bancong ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($chodexe)): ?>
	    <p><strong><!-- Chỗ Để Xe --></strong><span><?php echo $chodexe ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($daco)): ?>
	    <p><strong><!-- Số Lượng Tối Đa Cho Ở --></strong><span>Đã Có <?php echo $daco ?> Người</span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($nu)): ?>
	    <p><strong><!-- Chỉ Cho Ở --></strong><span>Hiện Tại Cần <?php echo $nu ?> Nữ</span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($nam)): ?>
	    <p><strong><!-- Chỉ Cho Ở --></strong><span>Hiện Tại Cần <?php echo $nam ?> Nam</span></p>
	    <div class="clear"></div>
    <?php endif; ?>
</fieldset>