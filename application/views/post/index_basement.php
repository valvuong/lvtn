<fieldset>
    <legend style="width: 194px">Thông Tin Bổ Sung</legend>
    <p><strong>An Ninh:</strong><span><?=$anninh?></span></p>
    <div class="clear"></div>
    <p><strong>Giờ Giấc:</strong><span><?=$giogiac?></span></p>
    <div class="clear"></div>
    <p><strong>Nhà Vệ Sinh:</strong><span><?=$nhavesinh?></span></p>
    <div class="clear"></div>
    <p><strong>Tiện Nghi:</strong><span><?=$tiennghi?></span></p>
    <div class="clear"></div>
    <p><strong>Ẩm thấp:</strong><span>
        <?php 
        if(!isset($amthap)) 
            echo 'Không bị ẩm thấp';
        else echo 'Có bị ẩm thấp';
    ?>
    </span></p>
    <div class="clear"></div>
    <p><strong>Thông thoáng:</strong><span>
        <?php 
        if(!isset($amthap)) 
            echo 'Ban ngày hơi nóng';
        else echo 'Thoáng mát';
    ?>
    </span></p>
    <div class="clear"></div>
    <p><strong>Xe Buýt:</strong><span><?=$xebuyt?></span></p>
    <div class="clear"></div>
</fieldset>