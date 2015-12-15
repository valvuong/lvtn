<fieldset>
    <legend style="width: 194px">Thông Tin Bổ Sung</legend>
    <p><strong>An Ninh:</strong><span><?=$anninh?></span></p>
    <div class="clear"></div>
    <p><strong>Giờ giấc:</strong><span><?=$giogiac?></span></p>
    <div class="clear"></div>
    <p><strong>Ở tầng thứ:</strong><span><?=$sotang?></span></p>
    <div class="clear"></div>
    <p><strong>Số phòng ngủ tất cả:</strong><span><?=$phongngu?></span></p>
    <div class="clear"></div>
    <p><strong>Số phòng còn trống:</strong><span><?=$controng?></span></p>
    <div class="clear"></div>
    <p><strong>Chỉ cho:</strong><span><?=$chicho?></span></p>
    <div class="clear"></div>

    <p><strong>Giặt ủi:</strong><span><?php
        if(isset($giatui))
            echo 'Có';
        else echo 'Không';
        ?>
    </span></p>
    <div class="clear"></div>
    <p><strong>Thang máy:</strong><span><?php
        if(isset($thangmay))
            echo 'Có';
        else echo 'Không';
        ?>
    </span></p>
    <div class="clear"></div>
    <p><strong>Tiện Nghi:</strong><span><?=$tiennghi?></span></p>
    <div class="clear"></div>
</fieldset>