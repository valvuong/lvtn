<style type="text/css">
	strong {
		min-height: 1px;
	}
</style>
<fieldset>
    <legend style="width: 194px">Thông Tin Bổ Sung</legend>
    <?php if(!empty($anninh)): ?>
	    <p><strong>An Ninh</strong><span><?php echo $anninh ?></span></p>
	    <div class="clear"></div>
	<?php endif; ?>
	<?php if(!empty($naunuong)): ?>
	    <p><strong>Nấu Nướng</strong><span><?php echo $naunuong ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($chungchu)): ?>
	    <p><strong>Chung Chủ Nhà</strong><span><?php echo $chungchu ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($giogiac)): ?>
	    <p><strong>Giờ Giấc</strong><span><?php echo $giogiac ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($nhavesinh)): ?>
	    <p><strong>Nhà Vệ Sinh</strong><span><?php echo $nhavesinh ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($xebuyt)): ?>
	    <p><strong>Các Tuyến Xe Buýt Gần Đó:</strong><span><?php echo $xebuyt ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($bancong)): ?>
	    <p><strong>Ban Công</strong><span><?php echo $bancong ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($chodexe)): ?>
	    <p><strong>Chỗ Để Xe</strong><span><?php echo $chodexe ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($soluong)): ?>
	    <p><strong>Số Người Tối Đa Cho Ở</strong><span><?php echo $soluong ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
    <?php if(!empty($chicho)): ?>
	    <p><strong>Chỉ Cho Ở</strong><span><?php echo $chicho ?></span></p>
	    <div class="clear"></div>
    <?php endif; ?>
</fieldset>