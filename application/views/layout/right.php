<div id="right">
    <div class="panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title search-title"><span class="glyphicon glyphicon-search"></span> TÌM KIẾM</h2>
        </div>
        <div class="panel-search">
            <form action="" method="">
                <select class="selectpicker" name="search-category">
                    <option value="0">Theo Chuyên Mục</option>
                    <?php $query = $this->mcategory->get_all() ?>
                    <?php foreach($query as $row): ?>
                        <option value="<?=$row['id']?>"><?=$row['ten']?></option>
                    <?php endforeach ?>
                </select>
                <select class="selectpicker" name="search-district">
                    <option value="0">Theo Quận</option>
                    <?php $query = $this->mdistrict->get_all() ?>
                    <?php foreach($query as $row): ?>
                        <option value="<?=$row['idQ']?>"><?=$row['tenquan']?></option>
                    <?php endforeach ?>
                </select>
                <select class="selectpicker" name="search-area">
                    <option value="0">Theo Diện Tích</option>
                    <?php $query = $this->db->get(SEARCH_AREA) ?>
                    <?php foreach($query->result_array() as $row): ?>
                        <option value="<?=$row['value']?>"><?=$row['text']?></option>
                    <?php endforeach ?>
                </select>
                <select class="selectpicker" name="search-price">
                    <option value="0">Theo Giá</option>
                    <?php $query = $this->db->get(SEARCH_PRICE) ?>
                    <?php foreach($query->result_array() as $row): ?>
                        <option value="<?=$row['value']?>"><?=$row['text']?></option>
                    <?php endforeach ?>
                </select>
                <div class="text-center"><input type="submit" class="btn btn-default" value="Tìm Kiếm"></div>
            </form>
        </div>
    </div>
</div>