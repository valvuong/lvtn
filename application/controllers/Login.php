<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mcategory','mlogin'));
    }

    public function index() {
        $data['view'] = 'login/login';
		$data['content']['login_fail']= false;
		$data['left_hidden'] = true;
		$data['right_hidden'] = true;

		if($this->input->post('submit')) {
                $info = array(
                        'username' => $this->input->post('login-username'),
                        'password' => $this->input->post('login-password')
					);
		if($this->mlogin->check_login($info))
			redirect('welcome','refresh');
		else {
			$data['content']['login_fail']= true;
			$this->load->view(LAYOUT, $data);
		}
		}
		$this->load->view(LAYOUT, $data);
		
	}
}
?>