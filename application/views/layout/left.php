<div id="left" class="post-left">
    <div class="panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title search-title"><i class="fa fa-filter"></i></span> THEO QUẬN</h2>
        </div>
        <div class="panel-search">
            <ul>
                <?php $query = $this->mdistrict->get_all() ?>
                <?php foreach($query as $row): ?>
                    <li>
                        <a href="<?php echo site_url('nha-tro-'.$row['tenkhac']) ?>"><?php $name = $row['tenquan']; if(strlen($name) > 9) echo substr($name, 7); else echo $name; ?></a>
                        <span class="text-danger">[ <?php echo $this->mpost->get_num_every_district($row['idQ']) ?> ]</span>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>
