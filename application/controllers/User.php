<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','muser'));
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
	                        'password' => $this->input->post('register-password'),
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
		
//////////////login////////////////	

	public function login() {
		if($this->session->userdata('logged_in') == false){
	        $data['view'] = 'login/login';
			$data['title'] = 'Đăng nhập';
			$data['content']['login_fail']= false;
			$data['left_hidden'] = true;
			$data['right_hidden'] = true;
			$data['redirect'] = $_SERVER['HTTP_REFERER'];	//get the previous page	
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
						'password' => $this->input->post('login-password')
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
		redirect('', 'refresh');
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
			$config['smtp_user'] = 'transong.toan@gmail.com';
			$config['smtp_pass'] = 'Trymybestto1to1to1';

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
		if(!$this->session->userdata(LABEL_LOGIN)) {
			redirect('dang-nhap','refresh');
		}
		$data['view'] = 'dashboard/index';
		$param = $this->session->userdata(LABEL_LOGIN)['id'];
		$f = $this->muser->get_profile($param);
		$data['content']['info'] = $f[0];
		$data['display_name'] = $this->display_name;
		$this->load->view('dashboard/main', $data);
	}

	public function change_password() {
		if(!$this->session->userdata(LABEL_LOGIN)) {
			redirect('dang-nhap','refresh');
		}
		$data['view'] = 'dashboard/change_password';
		$data['content'] = '';
		$data['display_name'] = $this->display_name;
		$this->load->view('dashboard/main', $data);
	}

	public function change_avatar() {
		if(!$this->session->userdata(LABEL_LOGIN)) {
			redirect('dang-nhap','refresh');
		}
		$data['view'] = 'dashboard/change_avatar';
		$data['content'] = '';
		$data['display_name'] = $this->display_name;
		$this->load->view('dashboard/main', $data);
	}

	public function market() {
		if(!$this->session->userdata(LABEL_LOGIN)) {
			redirect('dang-nhap','refresh');
		}
		$data['view'] = 'dashboard/change_avatar';
		$data['content'] = '';
		$data['display_name'] = $this->display_name;
		$this->load->view('dashboard/main', $data);
	}

	public function post() {
		if(!$this->session->userdata(LABEL_LOGIN)) {
			redirect('dang-nhap','refresh');
		}
		$data['view'] = 'dashboard/change_avatar';
		$data['content'] = '';
		$data['display_name'] = $this->display_name;
		$this->load->view('dashboard/main', $data);
	}
}
