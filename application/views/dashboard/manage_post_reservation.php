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
                    <th>Chỉnh Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($content as $k => $v): ?>
                    <tr>
                        <td class="text-center"><?=$k+1?></td>
                        <td><a href="<?=site_url('tin-'.$v['idBantin'])?>"><?php echo $v['idBantin'] ?></a></td>
                        <td class="text-center"><button><i class="fa fa-wrench"></i></button></td>
                        <td class="text-center"><button><i class="fa fa-times"></i></button></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <button class="btn btn-primary load-more">Tải Thêm</button>
</div>