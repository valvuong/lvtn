<fieldset>
    <legend style="width: 194px">Thông Tin Bổ Sung</legend>
    <p><strong>An Ninh:</strong><span><?=$anninh?></span></p>
    <div class="clear"></div>
    <p><strong>Giờ giấc:</strong><span><?=$giogiac?></span></p>
    <div class="clear"></div>
    <p><strong>Giặt ủi:</strong><span><?php
        if(isset($giatui))
            echo 'Có';
        else echo 'Không';
        ?>
    </span></p>
    <div class="clear"></div>
    <p><strong>Số Phòng Tất Cả:</strong><span><?=$sophong?></span></p>
    <div class="clear"></div>
    <p><strong>Số Phòng Ngủ:</strong><span><?=$phongngu?></span></p>
    <div class="clear"></div>
    <p><strong>Tiện Nghi:</strong><span><?=$tiennghi?></span></p>
    <div class="clear"></div>
</fieldset>