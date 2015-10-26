<link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/pagination.css">
<?php
$num_pages = ceil($num_rows/POSTS_PER_PAGE);
$current_page = $pagination[2];
$next_page = $pagination;
$next_page[2]++;
$previous_page = $pagination;
$previous_page[2]--;
if($num_pages > 5) {
    if($current_page >= 4) {
        $start = $current_page - 2;
        $nums = $current_page + 2;
        $distance = $num_pages - $current_page;
        if($distance <= 1) {
            switch($distance) {
                case 0:
                    $start = $current_page - 4;
                    $nums = $current_page;
                    break;
                case 1:
                    $start = $current_page - 3;
                    $nums = $current_page + 1;
                    break;
            }
        }
    } else {
        $start = 1;
        $nums = 5;
    }
} else {
    $nums = $num_pages;
    $start = 1;
}
?>
<?php if($num_rows > POSTS_PER_PAGE): ?>
    <ul class="pagination pagination-lg">
        <li<?php echo ($pagination[2] == 1)?' class="disabled"':''?>><a href="<?=site_url($previous_page)?>">&laquo;</a></li>
        <?php for($i=$start;$i<=$nums;$i++): ?>
            <?php $pagination[2] = $i ?>
            <?php if($i == $current_page) { ?>
                <li class="active"><a><?=$i?></a></li>
            <?php } else { ?>
                <li><a href="<?=site_url($pagination)?>"><?=$i?></a></li>
            <?php } ?>
        <?php endfor ?>
        <li<?php echo ($current_page == $num_pages)?' class="disabled"':''?>><a href="<?=site_url($next_page)?>">&raquo;</a></li>
    </ul>
<?php endif ?>