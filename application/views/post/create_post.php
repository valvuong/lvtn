<link rel="stylesheet" type="text/css" href="<?php echo css_url() ?>create-post.css">

<h2 class="label-cate">hãy chọn chuyên mục cần đăng</h2>

<ul class="list-cate">
	<?php $query = $this->mcategory->get_all() ?>
    <?php foreach ($query as $row): ?>
        <li>
            <a href="<?php echo site_url('dang-tin-'.$row['url_name']) ?>">
                <?=$row['ten']?>
            </a>
        </li>
    <?php endforeach ?>
</ul>