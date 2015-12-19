<div class="list-header">
    <?php if($this->router->fetch_class() == 'post'): ?>
      <?php $method = $this->router->fetch_method() ?>
      <?php if($method == 'get_all'): ?>
        <div class="btn-group sort">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sắp Xếp Theo <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('nha-1') ?>">Mới Nhất</a></li>
              <li><a href="<?php echo site_url('nha-2') ?>">Giá Tăng</a></li>
              <li><a href="<?php echo site_url('nha-3') ?>">Giá Giảm</a></li>
              <li><a href="<?php echo site_url('nha-4') ?>">Diện Tích Tăng</a></li>
              <li><a href="<?php echo site_url('nha-5') ?>">Diện Tích Giảm</a></li>
          </ul>
        </div>
      <?php else: ?>
        <div class="btn-group sort">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sắp Xếp Theo <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
              <li><a href="<?php echo site_url($url_sort.'moinhat') ?>">Mới Nhất</a></li>
              <li><a href="<?php echo site_url($url_sort.'gia-tang') ?>">Giá Tăng Dần</a></li>
              <li><a href="<?php echo site_url($url_sort.'gia-giam') ?>">Giá Giảm Dần</a></li>
              <li><a href="<?php echo site_url($url_sort.'dientich-tang') ?>">Diện Tích Tăng</a></li>
              <li><a href="<?php echo site_url($url_sort.'dientich-giam') ?>">Diện Tích Giảm</a></li>
          </ul>
        </div>
      <?php endif ?>
    <?php endif ?>
</div>

<?php foreach($content as $row): ?>
<a data-toggle="tooltip" data-placement="right" 
data-html="true" title='<b><?=$row['tenquan']?></b><br /> <b><span style="color:#0087c7;"><?=$row['tieude']?></span></b><br />Nội dung: <?=$row['noidung']?><br />' 
rel="tooltip" class="post changecolor" href="<?=site_url('tin-'.$row['id'])?>">
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
        <p>
          <span class="font-bold">Khoảng Cách Tới ĐH Bách Khoa:</span> <?php echo $row['khoangcach']; ?> km
        </p>
        <p class="font-bold text-center" style="color: #ff5252">
            <?=$row['tenquan']?>
        </p>
    </div>
</a>
<?php endforeach; ?>
<!--Pagination-->
<?php $this->load->view('pagination') ?>