<?php foreach($content as $row): ?>
<a class="post" href="<?=site_url(array('post','index',$row['id']))?>">
    <div class="thumbnail">
        <img src="<?=uploads_url()?>post/<?=$row['tenhinh']?>">
    </div>
    <div id="middle">
        <h4><?php echo mb_strtoupper($row['tieude'],'utf8') ?></h4>
        <p>
            <span class="font-bold">Giá phòng:</span> <?php echo number_format($row['giaphong']*1000000); ?> VNĐ |
            <span class="font-bold">Diện tích:</span> <?php echo $row['dientich']; ?> m<sup>2</sup>
        </p>
        <p>
            <span class="font-bold">Ngày đăng:</span>
            <span>
            <?php
            $date = strtotime($row['ngaydang']);
            $formatDate = date('d/m/Y',$date);
            echo $formatDate;
            ?>
            </span> |
            <span class="font-bold">Ngày hêt hạn:</span>
            <span>
            <?php
            $date = strtotime($row['hethan']);
            $formatDate = date('d/m/Y',$date);
            echo $formatDate;
            ?>
            </span> |
            <span class="font-bold">Còn lại:</span>
            <?php
            $now = time();
            $expried =  floor((strtotime($row['hethan']) - $now)/86400)+1;
            if($expried > 0) echo $expried.' ngày';
            ?>
        </p>
        <p class="font-bold text-center" style="color: #ff5252">
            <?=$row['tenquan']?>
        </p>
    </div>
</a>
<?php endforeach ?>
<!--Pagination-->
<?php $this->load->view('pagination') ?>