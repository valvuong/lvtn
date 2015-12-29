<style type="text/css">
    table.table tr th{
        text-align: center;
    }
</style>

<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu Đề</th>
                    <th>Số Phòng</th>
                    <th>Số Người</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($content as $k => $v): ?>
                    <tr id="row_<?=$v['idBantin']?>">
                        <td class="text-center"><?=$k+1?></td>
                        <td><a href="<?=site_url('tin-'.$v['idBantin'])?>"><?php echo $v['tieude'] ?></a></td>
                        <td class="text-center"><?=$v['sophong']?></td>
                        <td class="text-center"><?=$v['songuoi']?></td>
                        <td class="text-center"><button class="delete" id="<?=$v['idBantin']?>"><i class="fa fa-times"></i></button></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        delete_reservation();
    });
    function delete_reservation() {
        $('.delete').click(function(){
            if (window.confirm("Bạn Muốn Hủy Đăng Kí Tin Này")) {
                var url = '<?=base_url()?>post/delete_reservation_post';
                var idBantin = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {idBantin: idBantin},
                    success: function(data){
                        alert('Thành công');
                        $('#row_'+idBantin).remove();
                    }
                });
            }
        });
    }
</script>