<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict'));
		$this->load->library(array('form_validation','user_agent','googlemaps'));
		$this->form_validation->set_error_delimiters('<div class="error">','</div>'); 
		if ($this->session->userdata(LABEL_LOGIN)) {
			$param = $this->session->userdata(LABEL_LOGIN)['id'];
			$f = $this->muser->get_profile($param);
			$this->display_name = $f[0]['name'];
		}
    }

    public function index() {
		
    }
	public function register() {
		if($this->session->userdata('logged_in') == false) {
	        $data['view'] = 'register/register';
			$data['title'] = 'Đăng kí tài khoản';
			
			$data['left_hidden'] = true;
			$data['right_hidden'] = true;
			/////////////////
			
			$this->load->helper('captcha');
				$vals = array(
					'word'          => '',
					'img_path'      => './asset/captcha/',
					'img_url'       => asset_url().'captcha',
					
					'img_width'     => '200',
					'img_height'    => 40,
					'expiration'    => 600,
					'word_length'   => 8,
					'font_size'     => 16,
					'img_id'        => 'Imageid',
					'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

					// White background and border, black text and red grid
					'colors'        => array(
							'background' => array(255, 255, 255),
							'border' => array(255, 255, 255),
							'text' => array(0, 0, 0),
							'grid' => array(255, 40, 40)
					)
			);
			$cap = create_captcha($vals);
			$data['content']['cap']= $cap;
			$data_captcha = array(
	        'captcha_time'  => $cap['time'],
	        'ip_address'    => $this->input->ip_address(),
	        'word'          => $cap['word']
			);
			$this->muser->save_captcha($data_captcha);
			////////////////////
			
			
			$rules = array(
	            array(
	                'field' => 'register-username',
	                'rules' => 'trim|required|min_length[3]|callback_check_username'
	            ),
	            array(
	                'field' => 'register-password',
	                'rules' => 'trim|required|min_length[5]'
	            ),
				array(
	                'field' => 'register-repassword',
	                'rules' => 'trim|required|min_length[5]|matches[register-password]'
	            ),
				array(
	                'field' => 'register-email',
	                'rules' => 'trim|required|valid_email|callback_check_email'
	            ),
				array(
	                'field' => 'captcha',
	                'rules' => 'trim|required|callback_check_captcha'
	            )
			);
			$this->form_validation->set_rules($rules);
			if($this->input->post('register')) {
	            if($this->form_validation->run()) {
	                $info = array(
	                	'register' => array(
	                        'username' => $this->input->post('register-username'),
							'email'    => $this->input->post('register-email'),
	                        'password' => md5($this->input->post('register-password')),
							'role'	   => 'ROLE_USER'
						),
						'avatar'   => $_FILES,
					);
				
					$id = $this->muser->create_user($info);
					$data['view'] = 'register/success';
					$data['content']['test'] = $_FILES;
				}
			}
			$this->load->view(LAYOUT, $data);
		}
		else redirect('','refresh'); 
    }
	
	public function check_username($username){
		if($this->muser->check_username($username)== true)
			return true;
		else {
			$this->form_validation->set_message('check_username', 'Tên này đã được đăng ký.');
			return false;
		}
	}
	
	public function check_email($email){
		if($this->muser->check_email($email)==true)
			return true;
		else {
			$this->form_validation->set_message('check_email', 'Email này đã được đăng ký.');
			return false;
		}
	}
	
	public function check_captcha($captcha){
		// First, delete old captchas
		$expiration = time() - 7200; // Two hour limit
		$this->muser->del_old_captcha($expiration);
		// Then see if a captcha exists:
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$result = $this->muser->check_captcha($binds);
		if($result->count == 0){
			$this->form_validation->set_message('check_captcha', 'Nhập lại mã bảo vệ');
			return false;
		}
		else 
			return true;
	}

	public function check_password() {
        if ($this->input->is_ajax_request()) {
            $oldpass = md5($this->input->post('oldpass'));
            $is_valid_pass = $this->muser->check_password($oldpass);
            $data['result'] = false;
            if ($is_valid_pass) {
                $data['result'] = true;
            }
            exit(json_encode($data));
        }
    }

    public function change_password() {
    	$this->muser->not_authenticated();
        if ($this->input->is_ajax_request()) {
            $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
            $newpass = md5($this->input->post('newpass'));
            $data = array('password'=>$newpass);
            $this->muser->change_info($idUser, $data);
            exit(true);
        } else {
        	if(!$this->session->userdata(LABEL_LOGIN)) {
				redirect('dang-nhap','refresh');
			}
			$data['view'] = 'dashboard/change_password';
			$data['content'] = '';
			$data['display_name'] = $this->display_name;
			$this->load->view('dashboard/main', $data);
        }
    }
		
//////////////login////////////////	

	public function login() {
		if($this->session->userdata('logged_in') == false){
	        $data['view'] = 'login/login';
			$data['title'] = 'Đăng nhập';
			$data['content']['login_fail']= false;
			$data['left_hidden'] = true;
			$data['right_hidden'] = true;
			if ($_SERVER['HTTP_REFERER'] == base_url().'dang-xuat') {
				$data['redirect'] = '';
			} else {
				$data['redirect'] = $_SERVER['HTTP_REFERER'];
			}	//get the previous page	
			$this->load->view(LAYOUT, $data);
		}
		else redirect('','refresh');	
	}

	function dologin(){
		if($this->session->userdata('logged_in') == false) {
			$data['view'] = 'login/login';
			$data['title'] = 'Đăng nhập';
			$data['content']['login_fail']= false;
			$data['left_hidden'] = true;
			$data['right_hidden'] = true;
			$data['redirect']=$this->input->post('redirect'); //save the previous page if login fail
			if($this->input->post('submit')) {
				$info = array(
						'username' => $this->input->post('login-username'),
						'password' => md5($this->input->post('login-password'))
					);
				$result = $this->muser->check_login($info);
				if($result) {
					$sess_array = array();
					foreach($result as $row)
					{
						$sess_array = array(
							'role' => $row->role,
							'username' => $row->username,
							'id' => $row->idUser,
							'avatar' => $row->avatar,
							'email' => $row->email,
							'phone' => '0912345678'
						);
					$this->session->set_userdata('logged_in', $sess_array);
					redirect($this->input->post('redirect'));  //redirect to the previous page
					}
				}
				else{
					$data['content']['login_fail']= true;
				}
			}
			$this->load->view(LAYOUT, $data);
		}
		else redirect('','refresh');

	}
	function logout(){
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('dang-nhap', 'refresh');
	}
	
	function update_profile($id)
	{
		$data['view'] = 'login/profile';
		$data['title'] = 'Cập nhật thông tin tài khoản';
		$data['left_hidden'] = true;
		$data['right_hidden'] = true;
		$data['content']['info']=$this->muser->get_profile($id);	
		
		$rules = array(
            array(
                'field' => 'profile-password',
                'rules' => 'trim|required|min_length[5]'
            ),
			array(
                'field' => 'profile-repassword',
                'rules' => 'trim|required|min_length[5]|matches[profile-password]'
            ),
			array(
                'field' => 'profile-name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'profile-sex',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'profile-address',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'profile-phone',
                'rules' => 'trim|required|numeric'
            ),
		);
		$this->form_validation->set_rules($rules);
		if($this->input->post('update')) {

            if($this->form_validation->run()) {
                $info = array(
						'id' => $id,
                        'password' => $this->input->post('profile-password'),
						'name' => $this->input->post('profile-name'),
						'sex' => $this->input->post('profile-sex'),
						'address' => $this->input->post('profile-address'),
						'phone' => $this->input->post('profile-phone'),
					);
				
				$this->muser->update_user($info);
				
				$data['view'] = 'register/success';
			}
			}
		$this->load->view(LAYOUT, $data);
    }

    public function forgot_password(){
    	$data['view'] = 'login/forgot_password';
		$data['title'] = 'Quên mật khẩu';
		$data['left_hidden'] = true;
		$data['right_hidden'] = true;
		$data['content']['message_display'] = 'aaaaaaaaaa';
		$this->load->view(LAYOUT, $data);
    }

    public function send_email() {
		// Check for validation
		$rules = array(
			'field' => 'forgot-password-email',
             'rules' => 'trim|required'
			);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$this->forgot_password();
		} else {

			// Storing submitted values
			$forgot_password_email = $this->input->post('forgot_password_email');
			// Configure email library
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.gmail.com';
			$config['smtp_port'] = 465;
			$config['smtp_user'] = '';
			$config['smtp_pass'] = '';

			// Load email library and passing configured values to email library
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			// Sender email address
			$this->email->from('transong.toan@gmail.com', 'toan');
			// Receiver email address
			$this->email->to($forgot_password_email);
			// Subject of email
			//$this->email->subject($subject);
			// Message in email
			//$this->email->message($message);

			if ($this->email->send()) {
				$data['message_display'] = 'Email Successfully Send !';
			} else {
				$data['message_display'] =  '<p class="error_msg">Invalid Gmail Account or Password !</p>';
			}
		$data['view'] = 'login/forgot_password';
		$data['title'] = 'Quên mật khẩu';
		$data['left_hidden'] = true;
		$data['right_hidden'] = true;
		$this->load->view(LAYOUT, $data);
		}
	}

	public function contact() {
        $data['view'] = 'static_page/contact';
        $data['content'] = '';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;

        $this->load->library('googlemaps');
        $config['center'] = '10.772223670808806,106.65842771530151';
        $config['zoom'] = '15';
        $this->googlemaps->initialize($config);
        $marker['position'] = '10.772223670808806,106.65842771530151';
        $this->googlemaps->add_marker($marker);
        $data['content']['map'] = $this->googlemaps->create_map();

        $this->load->library('form_validation');
        $rules = array(
            array(
                'field' => 'name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'email',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'message',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($rules);

        if ($this->input->post('contact-submit')) {
            if($this->form_validation->run()) {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $message = $this->input->post('message');
                $info = array(
                    'name'      => $name,
                    'email'     => $email,
                    'message'   => $message,
                    'read'      => 0,
                    'sendemail' => 0
                );
                $this->mcontact->save_contact($info);
            }
        }

        $this->load->view(LAYOUT, $data);
    }
    //////////////////////dashboard///////////////////
    public function dashboard() {
		$this->muser->not_authenticated();
		if ($this->input->is_ajax_request()) {
			$idUser = $this->session->userdata(LABEL_LOGIN)['id'];
            $field = $this->input->post('field');
            $value = $this->input->post('value');
            $data = array($field=>$value);
            $this->muser->change_info($idUser, $data);
            exit(true);
		} else {
			$data['view'] = 'dashboard/index';
			$param = $this->session->userdata(LABEL_LOGIN)['id'];
			$f = $this->muser->get_profile($param);
			$data['content']['info'] = $f[0];
			$data['display_name'] = $this->display_name;
			$this->load->view(DASHBOARD, $data);
		}
	}

	public function change_avatar() {
		$this->muser->not_authenticated();
		if ($this->input->is_ajax_request()) {
            $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
            $avatar_name = $this->session->userdata(LABEL_LOGIN)['avatar'];
            unlink('asset/uploads/user/'.$avatar_name);
            $config['upload_path'] = 'asset/uploads/user';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '1024';
            $this->load->library('upload');
            foreach ($_FILES as $key => $file)
            {
                $field_name = 'avatar';
                $_FILES[$field_name]['name'] = $file['name'];
                $_FILES[$field_name]['type'] = $file['type'];
                $_FILES[$field_name]['tmp_name'] = $file['tmp_name'];
                $_FILES[$field_name]['error'] = $file['error'];
                $_FILES[$field_name]['size'] = $file['size'];

                $file_name = uniqid($idUser.'_');
                $config['file_name'] = $file_name;
                $this->upload->initialize($config);

                if ($this->upload->do_upload($field_name)) {
                    $fname = $file['name'];
                    $fname = explode('.', $fname);
                    $extension = end($fname);
                    $tenhinh = $file_name.'.'.$extension;
                    $data = array('avatar'=>$tenhinh);
                    $this->muser->change_info($idUser, $data);
                    $user_session = $this->session->userdata(LABEL_LOGIN);
                    $user_session['avatar'] = $tenhinh;
                    $this->session->set_userdata(LABEL_LOGIN, $user_session );
                }
            }
            
            exit(true);
        } else {
        	$data['view'] = 'dashboard/change_avatar';
			$data['content'] = '';
			$data['display_name'] = $this->display_name;
			$this->load->view(DASHBOARD, $data);
        }
	}

	public function manage_market() {
		$this->muser->not_authenticated();
		$this->load->model(array('mmanage_market'));
		$data['view'] = 'dashboard/manage_market';
		$idUser = $this->session->userdata(LABEL_LOGIN)['id'];
		$idMarkets = array_reverse($this->mmanage_market->get_market_by_user($idUser));
		$markets = array();
		foreach ($idMarkets as $row) {
			$markets[] = $this->mmarket->get_by_id($row['idRaovat']);
		}
		$data['content'] = $markets;
		$data['display_name'] = $this->display_name;
		$this->load->view(DASHBOARD, $data);
	}

	public function delete_market() {
		$this->muser->not_authenticated();
		if ($this->input->is_ajax_request()) {
			$this->load->model(array('mmanage_market'));
			$idMarket = $this->input->post('idMarket');
			$idUser = $this->session->userdata(LABEL_LOGIN)['id'];
			if ($this->mmanage_market->check_owner($idUser, $idMarket)) {
				$images = $this->mmarket->get_images($idMarket);
				foreach ($images as $img) {
					unlink('asset/uploads/market/'.$img['tenhinh']);
				}
				$this->mmarket->delete_market($idMarket);
				exit(true);
			}
		}
	}

	public function manage_post() {
		$this->muser->not_authenticated();
		$this->load->model(array('mmanage_post'));
		$data['view'] = 'dashboard/manage_post';
		$idUser = $this->session->userdata(LABEL_LOGIN)['id'];
		$idPosts = array_reverse($this->mmanage_post->get_post_by_user($idUser));
		$posts = array();
		foreach ($idPosts as $row) {
			$posts[] = $this->mpost->get_by_id($row['idBantin']);
		}
		$data['content'] = $posts;
		$data['display_name'] = $this->display_name;
		$this->load->view(DASHBOARD, $data);
	}

	public function delete_post() {
		$this->muser->not_authenticated();
		if ($this->input->is_ajax_request()) {
			$this->load->model(array('mmanage_post'));
			$idPost = $this->input->post('idPost');
			$idUser = $this->session->userdata(LABEL_LOGIN)['id'];
			if ($this->mmanage_post->check_owner($idUser, $idPost)) {
				$images = $this->mpost->get_images($idPost);
				foreach ($images as $img) {
					unlink('asset/uploads/post/'.$img['tenhinh']);
				}
				$this->mpost->delete_post($idPost);
				exit(true);
			}
		}
	}

	public function manage_reservation(){
		$this->muser->not_authenticated();
		$this->load->model(array('mpost_reservation'));
        $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        $data['view'] = 'dashboard/manage_reservation';
		$data['content'] = $this->mpost_reservation->get_all($idUser);;
		$data['display_name'] = $this->display_name;
		$this->load->view('dashboard/main', $data);
    }

	public function manage_user() {
		$this->muser->not_admin();
		$data['view'] = 'dashboard/manage_user';
		$data['content'] = $this->muser->get_all();
		$data['display_name'] = $this->display_name;
		$this->load->view(DASHBOARD, $data);
	}

	public function delete_user() {
		if ($this->muser->is_admin()) {
			if ($this->input->is_ajax_request()) {
				$idUser = $this->input->post('idUser');
				$this->muser->delete_user($idUser);
				exit(true);
			}
		}
	}
/*
	public function manage_reservation() {
		$this->muser->not_authenticated();
		$data['view'] = 'dashboard/manage_reservation';
		$this->load->modeL(array('mpost_reservation'));
		$idUser = $this->session->userdata(LABEL_LOGIN)['id'];
		$idPosts = $this->mpost_reservation->get_posts_by_user($idUser);
		$posts = array();
		foreach ($idPosts as $row) {
			$posts[] = $this->mpost->get_by_id($row['idBantin']);
		}
		$data['content'] = $posts;
		$data['display_name'] = $this->display_name;
		$this->load->view(DASHBOARD, $data);
	}
*/
}
