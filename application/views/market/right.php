<div id="right">
    <div class="panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title search-title"><span class="glyphicon glyphicon-search"></span> TÌM KIẾM</h2>
        </div>
        <div class="panel-search">
            <form action="" method="">
                <select class="selectpicker" name="search-category">
                    <option value="0">Theo Loại</option>
                    <?php $query = $this->mmarket_category->get_all() ?>
                    <?php foreach($query as $row): ?>
                        <option value="<?=$row['id']?>"><?=$row['tenloai']?></option>
                    <?php endforeach ?>
                </select>
                <select class="selectpicker" name="search-price">
                    <option value="0">Theo Giá</option>
                    <option></option>
                </select>
                <select class="selectpicker" name="search-status">
                    <option value="0">Theo Tình Trạng</option>
                    <option value="1">Mới</option>
                    <option value="2">Đã Sử Dụng</option>
                </select>
                <div class="text-center"><input type="submit" class="btn btn-default" value="Tìm Kiếm"></div>
            </form>
        </div>
    </div>
</div>