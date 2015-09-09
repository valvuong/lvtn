<?php foreach($content as $row): ?>
<a class="news" href="<?=site_url(array('post','index',$row['id']))?>">
    <img src="<?=asset_url()?>image/house.png">
    <div id="middle">
        <h5><?php echo mb_strtoupper($row['tieude'],'utf8') ?></h5>
        <p><span style="font-weight: bold">Giá phòng:</span> <?php echo number_format($row['giaphong']*1000000); ?> VNĐ | <span style="font-weight: bold">Diện tích:</span> <?php echo $row['dientich']; ?> m<sup>2</sup> </p>
        <p>
            <span style="font-weight: bold">Ngày đăng:</span>
            <span>
            <?php
            $date = strtotime($row['ngaydang']);
            $formatDate = date('d/m/Y',$date);
            echo $formatDate;
            ?>
            </span> |
            <span style="font-weight: bold">Ngày hêt hạn:</span>
            <span>
            <?php
            $date = strtotime($row['hethan']);
            $formatDate = date('d/m/Y',$date);
            echo $formatDate;
            ?>
            </span> |
            <span style="font-weight: bold">Còn lại:</span>
            <?php
            $expried =  intval(date('d',strtotime($row['hethan']))) - intval(date('d',strtotime($row['ngaydang'])));
            if($expried > 0) echo $expried.' ngày';
            else echo 'Hôm nay';
            ?>
        </p>
    </div>
    <div id="last">
        <p>
            <?php
            $_quan = explode(' ', $row['ten']);
            $n = count($_quan);
            if($n > 2) $i = 1;
            else $i = 0;
            $quan = '';
            while($i < $n) {
                $quan .= $_quan[$i].' ';
                $i++;
            }
            echo trim($quan);
            ?>
        </p>
    </div>
</a>
<?php endforeach ?>
<!--Pagination-->
<?php $this->load->view('pagination') ?>