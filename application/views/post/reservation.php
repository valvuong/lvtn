<?php if($this->session->userdata(LABEL_LOGIN)) { 
     if (!$this->mpost_reservation->check_reservation_post($this->session->userdata(LABEL_LOGIN)['id'], $this->uri->segment(3))) { ?>
    <!-- Modal reservation Post-->
    <div id="reservation-post" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Đăng Kí Đặt Trước</h4>
          </div>
          <div class="modal-body">
            <form id='reservation-form' action="post/create_reservation_post" method="get">
                <div class="form-group">
                    <label>Số Phòng Muốn Đăng Kí: 
                        Tât cả: <span style='color:red'><?=$content['sophong']?></span>
                        Còn trống: <span style='color:red'>
                        <?=$content['sophong'] - intval($this->mpost_reservation->check_reservation_freeroom($this->uri->segment(3))) ?>
                        </span></label>
                    <input type="number" name="reservation-nums-room" class="form-control" min="0" max=
                    "<?=$content['sophong'] - intval($this->mpost_reservation->check_reservation_freeroom($this->uri->segment(3))) ?>">
                </div>
                <div class="form-group">
                    <label>Số Người Muốn Đăng Kí:
                        Tất cả: <span style='color:red'><?=$content['songuoi']?></span>
                        Có thể đăng ký: <span style='color:red'>
                            <?=$content['songuoi']- intval($this->mpost_reservation->check_reservation_freepeople($this->uri->segment(3))) ?>
                    </span> </label>
                    <input type="number" name="reservation-nums-people" class="form-control" min="0" max="<?=$content['songuoi']- intval($this->mpost_reservation->check_reservation_freepeople($this->uri->segment(3))) ?>">
                </div>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="reservation-name" value='<?=$this->session->userdata(LABEL_LOGIN)['username']?>' class="form-control">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="reservation-phone" value='<?=$this->session->userdata(LABEL_LOGIN)['phone']?>' class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="reservation-email" value='<?=$this->session->userdata(LABEL_LOGIN)['email']?>' class="form-control">
                </div>
                <div class='form-group'>
                    <input type='hidden' name='idBantin' value='<?=$this->uri->segment(3)?>'>
                </div>
                <div class="modal-footer">
                    <button type="submit" id='submit-reservation-post' class="btn btn-default" data-dismiss="modal">Đăng Kí</button>
                  </div>
            </form>
          </div>
        </div>

      </div>
    </div>
    <?php } else { ?>
        <!-- Update Modal reservation Post-->
    <div id="update-reservation-post" class="modal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sủa Tin Đăng Kí Đặt Trước</h4>
          </div>
          <div class="modal-body">
            <form id='update-reservation-form' action="post/update_reservaion_post" method="get">
                <div class="form-group">
                    <label>Số Phòng Muốn Đăng Kí</label>
                    <input type="number" name="update-reservation-nums-room" value='<?=$this->mpost_reservation->get_reservation_num($this->session->userdata(LABEL_LOGIN)['id'], $this->uri->segment(3))['sophong'] ?>' class="form-control" min="0">
                </div>
                <div class="form-group">
                    <label>Số Người Muốn Đăng Kí</label>
                    <input type="number" name="update-reservation-nums-people" value='<?=$this->mpost_reservation->get_reservation_num($this->session->userdata(LABEL_LOGIN)['id'], $this->uri->segment(3))['songuoi'] ?>' class="form-control" min="0">
                </div>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="update-reservation-name" value='<?=$this->session->userdata(LABEL_LOGIN)['username']?>' class="form-control">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="update-reservation-phone" value='<?=$this->session->userdata(LABEL_LOGIN)['phone']?>' class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="update-reservation-email" value='<?=$this->session->userdata(LABEL_LOGIN)['email']?>' class="form-control">
                </div>
                <div class='form-group'>
                    <input type='hidden' name='idBantin' value='<?=$this->uri->segment(3)?>'>
                </div>
                <div class="modal-footer">
                    <button type="submit" id='submit-update-reservation-post' class="btn btn-default" data-dismiss="modal">Cập nhật</button>
                  </div>
            </form>
          </div>
        </div>

      </div>
    </div>
     <!-- Delete Modal reservation Post-->
    <div id="delete-reservation-post" class="modal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Bạn muốn huỷ đặt trước tin này?</h4>
          </div>
          <div class="modal-body">
            <form id='delete-reservation-form' action="post/update_reservaion_post" method="get">
                <div class='form-group'>
                    <input type='hidden' name='idBantin' value='<?=$this->uri->segment(3)?>'>
                </div>
                <div class="modal-footer">
                    <button type="submit" id='submit-delete-reservation-post' class="btn btn-default" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-default"
                    data-dismiss="modal">Huỷ bỏ</button>
                  </div>
            </form>
          </div>
        </div>

      </div>
    </div>
<?php } } ?>
<script>
$(document).ready(function(){
    $('#submit-reservation-post').click(function(){
        $.ajax({
            url: '<?=base_url()?>' + 'post/create_reservation_post', //this is the submit URL
            type: 'GET', //or POST
            data: $('#reservation-form').serialize(),
            success: function(data){
                 alert('Đăng ký đặt phòng trước thành công');
                 location.reload();
            }
        });
    });
});
$(document).ready(function(){
    $('#submit-update-reservation-post').click(function(){
        $.ajax({
            url: '<?=base_url()?>' + 'post/update_reservation_post', //this is the submit URL
            type: 'GET', //or POST
            data: $('#update-reservation-form').serialize(),
            success: function(data){
                 alert('Cập nhật thành công');
                 location.reload();
            }
        });
    });
});
$(document).ready(function(){
    $('#submit-delete-reservation-post').click(function(){
        $.ajax({
            url: '<?=base_url()?>' + 'post/delete_reservation_post', //this is the submit URL
            type: 'GET', //or POST
            data: $('#delete-reservation-form').serialize(),
            success: function(data){
                 alert('Huỷ đặt trước thành công!');
                 location.reload();
            }
        });
    });
});
</script>