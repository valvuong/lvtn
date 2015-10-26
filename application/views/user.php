				<li class="float-right drop-down-menu">
					<a href="javascript:void(0)" class="click-dropdown">
						<?php 
						if($this->session->userdata('logged_in')) {
							$session_data=$this->session->userdata('logged_in');
							echo $session_data['username'];
						}
						else echo "Chào khách!"
						?> 
					</a>
					<ul>
						<li><a href="<?php
						$session_data=$this->session->userdata('logged_in');
						echo site_url('user/update_profile/'.$session_data['id']);
						?>"> Chỉnh sửa </a>
					<ul>
						<li><a href="<?php 
							if($this->session->userdata('logged_in')){
								echo site_url('logout');
								echo '">Đăng xuất</a></li>';
							}
							else {
								echo site_url('dang-ki');
								echo '">Đăng kí mới</a></li>';
							}
							?>
					</ul>
				</li>