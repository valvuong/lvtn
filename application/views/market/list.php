<div class="list-header market-header">
    <span class="glyphicon glyphicon-list-alt"></span>
    <div class="btn-group">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Loại <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <?php $query = $this->mmarket_category->get_all() ?>
        <?php foreach ($query as $row): ?>
            <li><a href="<?=site_url($row['id'].'-rao-vat-1')?>"><?=$row['tenloai']?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
</div>
<?php foreach($content as $row): ?>
    <a class="post ads" href="<?=site_url($row['id'].'-tin-vat')?>">
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
                <span><?php echo number_format($row['giaca']*1000000); ?> VNĐ</span>
            </p>
            <p>
                <span class="font-bold">Loại:</span>
                <span><?php echo $row['tenloai']; ?></span>
            </p>
        </div>
        <div class="clear-row"></div>
    </a>
<?php endforeach ?>
    <!--Pagination-->
<?php $this->load->view('pagination') ?>