				<li class="float-right drop-down-menu">
					<a href="javascript:void(0)" class="click-dropdown"> 
						<?php 
						if($this->session->userdata('logged_in')) {
							$session_data=$this->session->userdata('logged_in');
							echo $session_data['username'];
						}
						else echo "Xin chào khách!"
						?> 
					</a>
					<ul>
						<li><a href="<?php 
							if($this->session->userdata('logged_in')){
								echo site_url('logout');
								echo '">Đăng xuất</a></li>';
							}
							else {
								echo site_url('dang-ki');
								echo '">Đăng kí</a></li>';
							}
							?>
					</ul>
				</li>