<?php foreach($content as $row): ?>
    <a class="post" href="<?=site_url(array('market','index',$row['id']))?>">
        <div class="thumbnail">
            <?php if(empty($row['tenhinh'])): ?>
                <img src="<?=uploads_url()?>tmp/camera.png">
            <?php else: ?>
                <img src="<?=uploads_url()?>market/<?=$row['tenhinh']?>">
            <?php endif; ?>
        </div>
        <div id="middle">
            <h4><?php echo mb_strtoupper($row['tieude'],'utf8') ?></h4>
            <p>
                <span class="font-bold">Ngày Đăng:</span>
                <span>
                <?php
                $date = strtotime($row['ngaydang']);
                $formatDate = date('H:i d/m/Y',$date);
                echo $formatDate;
                ?>
                </span>
            </p>
            <p>
                <span class="font-bold">Giá Cả:</span>
                <span>
                <?php echo number_format($row['giaca']*1000000); ?> VNĐ
                </span>
            </p>
        </div>
        <div class="clear-row"></div>
    </a>
<?php endforeach ?>
    <!--Pagination-->
<?php $this->load->view('pagination') ?>