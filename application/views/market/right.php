<div id="right">
    <div class="panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title search-title"><span class="glyphicon glyphicon-search"></span> TÌM KIẾM</h2>
        </div>
        <div class="panel-search">
            <form action="Search_market_by_select" method="">
                <select class="btn btn-default" name="search-category" onchange="getSubCate(this.value)">
                    <option value="0">Theo Danh Mục</option>
                    <?php $query = $this->mmarket_category->get_all() ?>
                    <?php foreach($query as $row): ?>
                        <option value="<?=$row['id']?>"><?=$row['tenloai']?></option>
                    <?php endforeach ?>
                </select>

                <input type="hidden" id="url_ajax" value="<?php echo base_url().'ajax/get_adCate' ?>">
                <select class="btn btn-default" name="search-subcategory" id="search-subcategory"></select>

                <select class="btn btn-default" name="search-price">
                    <option value="0">Theo Giá</option>
                    <?php $query = $this->db->get(SEARCH_PRICE) ?>
                    <?php foreach($query->result_array() as $row): ?>
                        <option value="<?=$row['value']?>"><?=$row['text']?></option>
                    <?php endforeach ?>
                </select>
                
                <select class="btn btn-default" name="search-status">
                    <option value="0">Theo Tình Trạng</option>
                    <option value="1">Mới</option>
                    <option value="2">Đã Sử Dụng</option>
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

<script type="text/javascript">
    $(function(){
        getSubCate(0);
    });
    function getSubCate(value) {
        var selector = "#search-subcategory";
        if (value != 0) {
            var url = $('#url_ajax').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {q: value},
                dataType: "json",
                success: function(data) {
                    $(selector).empty();
                    $('<option>').val(0).text('Theo Loại').appendTo(selector);
                    $.each(data, function(key, value){
                        $('<option>').val(key).text(value).appendTo(selector);
                    });
                },
                error: function() {
                    alert('error');
                }
            });
        } else {
            $(selector).empty();
            $('<option>').val(0).text('Theo Loại').appendTo(selector);
        }
    }
</script>