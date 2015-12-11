<script type="text/javascript" src="<?php echo js_url()?>main-filter.js"></script>
    <div id="left">
        <div class="panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title search-title"><i class="fa fa-filter"></i></span> LỌC KẾT QUẢ</h2>
            </div>
            <div class="panel-search">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chọn Chuyên Mục</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign"></i></span>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><label><input type="radio" name="category" value="">Tất cả</label></li>
                            <?php $query = $this->mcategory->get_all() ?>
                            <?php foreach($query as $row): ?>
                                <li><label><input type="radio" name="category" value="<?=$row['id']?>"
                                <?php if ($search_category == $row['id']) echo 'checked="checked"';
                                ?>> <?=$row['ten']?></label></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chọn Diện Tích</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign"></i></span>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><label><input type="radio" name="area" value="">Tất cả</label></li>
                            <?php $query = $this->db->get(SEARCH_AREA) ?>
                            <?php foreach($query->result_array() as $row): ?>
                                <li><label><input type="radio" name="area" value="<?=$row['value']?>"
                                    <?php if ($search_area == $row['value']) echo 'checked="checked"';
                                ?>><?=$row['text']?></label></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chọn Giá</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign"></i></span>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><label><input type="radio" name="price" value="">Tất cả</label></li>
                            <?php $query = $this->db->get(SEARCH_PRICE) ?>
                            <?php foreach($query->result_array() as $row): ?>
                                <li><label><input type="radio" name="price" value="<?=$row['value']?>"
                                    <?php if ($search_price == $row['value']) echo 'checked="checked"';
                                ?>><?=$row['text']?></label></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chọn Quận</h3>
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign"></i></span>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><label><input type="radio" name="district" value="">Tất cả</label></li>
                            <?php $query = $this->mdistrict->get_all() ?>
                            <?php foreach($query as $row): ?>
                                <li><label><input type="radio" name="district" value="<?=$row['idQ']?>"
                                    <?php if ($search_district == $row['idQ']) echo 'checked="checked"';
                                ?>><?=$row['tenquan']?></label></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>