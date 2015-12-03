<div class="list-header">
    <div class="btn-group sort">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sắp Xếp Theo <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
          <li><a href="<?php echo site_url('nha-1') ?>">Mới Nhất</a></li>
          <li><a href="<?php echo site_url('nha-2') ?>">Giá Tăng Dần</a></li>
          <li><a href="<?php echo site_url('nha-3') ?>">Diện Tích Nhỏ</a></li>
      </ul>
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
<?php endforeach; ?>
<!--Pagination-->
<?php $this->load->view('pagination') ?>