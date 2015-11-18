<div class="list-header">
    <span class="glyphicon glyphicon-list-alt"></span>
    <div class="form-group sort">
      <select class="form-control" id="post-sort">
        <option value="0">Sắp Xếp Theo</option>
        <option value="1">Mới Nhất</option>
        <option value="2">Giá Rẻ</option>
        <option value="3">Diện Tích Nhỏ</option>
      </select>
    </div>
</div>
<?php foreach($content as $row): ?>
<a class="post" href="<?=site_url('tin-'.$row['id'])?>">
    <div class="thumbnail">
        <img src="<?=uploads_url()?>post/<?=$row['tenhinh']?>">
    </div>
    <div id="middle">
        <h4><?php echo mb_strtoupper($row['tieude'],'utf8') ?></h4>
        <p>
            <span class="font-bold">Giá Phòng:</span> <?php echo number_format($row['giaphong']*1000000); ?> VNĐ |
            <span class="font-bold">Diện Tích:</span> <?php echo $row['dientich']; ?> m<sup>2</sup>
        </p>
        <p>
            <span class="font-bold">Ngày Đăng:</span>
            <span>
            <?php
            $date = strtotime($row['ngaydang']);
            $formatDate = date('d/m/Y',$date);
            echo $formatDate;
            ?>
            </span> |
            <span class="font-bold">Ngày Hêt Hạn:</span>
            <span>
            <?php
            $date = strtotime($row['hethan']);
            $formatDate = date('d/m/Y',$date);
            echo $formatDate;
            ?>
            </span> |
            <span class="font-bold">Còn Lại:</span>
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