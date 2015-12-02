<div class="list-header">
    <span class="glyphicon glyphicon-list-alt"></span>
    <div class="form-group sort">
      <!-- <select class="form-control" id="post-sort">
        <option value="0" <?php if($this->input->cookie(COOKIE_POST_SORT) == 0) echo 'selected' ?>>Sắp Xếp Theo</option>
        <option value="1" <?php if($this->input->cookie(COOKIE_POST_SORT) == 1) echo 'selected' ?>>Mới Nhất</option>
        <option value="2" <?php if($this->input->cookie(COOKIE_POST_SORT) == 2) echo 'selected' ?>>Giá Tăng Dần</option>
        <option value="3" <?php if($this->input->cookie(COOKIE_POST_SORT) == 3) echo 'selected' ?>>Diện Tích Nhỏ</option>
      </select> -->
      <span>Sắp Xếp Theo</span>
      <ul>
          <li><a href="<?php echo site_url('welcome/sort/1') ?>">Mới Nhất</a></li>
          <li><a href="<?php echo site_url('welcome/sort/2') ?>">Giá Tăng Dần</a></li>
          <li><a href="<?php echo site_url('welcome/sort/3') ?>">Diện Tích Nhỏ</a></li>
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
<?php endforeach ?>
<!--Pagination-->
<?php $this->load->view('pagination') ?>