<div id="right">
    <div class="panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title search-title"><span class="glyphicon glyphicon-search"></span> TÌM KIẾM</h2>
        </div>
        <div class="panel-search">
            <form action="<?=base_url().'post/search_by_select_post'?>" method="">
                <select class="btn btn-default" name="search-category">
                    <option value="0">Theo Chuyên Mục</option>
                    <?php $query = $this->mpost_category->get_all() ?>
                    <?php foreach($query as $row): ?>
                        <option value="<?=$row['id']?>"><?=$row['ten']?></option>
                    <?php endforeach ?>
                </select>
                <select class="btn btn-default" name="search-district">
                    <option value="0">Theo Quận</option>
                    <?php $query = $this->mdistrict->get_all() ?>
                    <?php foreach($query as $row): ?>
                        <option value="<?=$row['idQ']?>"><?=$row['tenquan']?></option>
                    <?php endforeach ?>
                </select>
                <select class="btn btn-default" name="search-area">
                    <option value="0">Theo Diện Tích</option>
                    <?php $query = $this->db->get(SEARCH_AREA) ?>
                    <?php foreach($query->result_array() as $row): ?>
                        <option value="<?=$row['value']?>"><?=$row['text']?></option>
                    <?php endforeach ?>
                </select>
                <select class="btn btn-default" name="search-price">
                    <option value="0">Theo Giá</option>
                    <?php $query = $this->db->get(SEARCH_PRICE) ?>
                    <?php foreach($query->result_array() as $row): ?>
                        <option value="<?=$row['value']?>"><?=$row['text']?></option>
                    <?php endforeach ?>
                </select>
                <select class="btn btn-default" name="search-distance">
                    <option value="0">Theo Khoảng cách</option>
                    <option value="0002"><2km</option>
                    <option value="0205">2-5km</option>
                    <option value="0599">>5km</option>
                    <option value="0005000"><5ph đi xe máy</option>
                    <option value="0520000">5-20ph đi xe máy</option>
                    <option value="2099000">>20ph đi xe máy</option>
                </select>
                <div class="text-center"><input type="submit" class="btn btn-default" value="Tìm Kiếm"></div>
            </form>
        </div>
    </div>
</div>

<style type="text/css">
    select.btn {
        width: 100%;
        margin-bottom: 10px;
    }
</style>