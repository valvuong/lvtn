<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','muser'));
		$this->load->library(array('form_validation','user_agent'));
		$this->form_validation->set_error_delimiters('<div class="error">','</div>'); 
		
    }

    public function index() {
		
    }
	public function register() {
        $data['view'] = 'register/register';
		$data['content']='';
		$data['left_hidden'] = true;
		$data['right_hidden'] = true;
		
		
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
            )
		);
		$this->form_validation->set_rules($rules);
		if($this->input->post('register')) {
		
            if($this->form_validation->run()) {
                $info = array(
                        'username' => $this->input->post('register-username'),
						'email'    => $this->input->post('register-email'),
                        'password' => $this->input->post('register-password'),
						'role'	   => 'ROLE_USER'
					);
			
				$id = $this->muser->create_user($info);
				$data['view'] = 'register/success';
			}
			}
		$this->load->view(LAYOUT, $data);
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
	
	public function login() {
        $data['view'] = 'login/login';
		$data['content']['login_fail']= false;
		$data['left_hidden'] = true;
		$data['right_hidden'] = true;
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
						'id' => $row->id
					);
				$this->session->set_userdata('logged_in', $sess_array);
				redirect('welcome');
				}
			}
				else{
					$data['content']['login_fail']= true;
				}
			}		
		$this->load->view(LAYOUT, $data);	
	}
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('', 'refresh');
	}
	
	function update_profile($id)
	{
		$data['view'] = 'login/profile';
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
}
