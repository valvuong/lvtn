<?php

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mcategory','mregister'));
    }

    public function index() {
        $data['view'] = 'register/register';
		$data['content']='';
		$data['left_hidden'] = true;
		$data['right_hidden'] = true;
		
		$this->load->library('form_validation');
		$rules = array(
            array(
                'field' => 'register-username',
                'rules' => 'trim|required|min_length[3]'
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
                'rules' => 'trim|required|valid_email'
            )
		);
		$this->form_validation->set_rules($rules);
		if($this->input->post('register')) {
		
            if($this->form_validation->run()) {
                $info = array(
                        'username' => $this->input->post('register-username'),
						'email'    => $this->input->post('register-email'),
                        'password' => $this->input->post('register-password')
					);
			$id = $this->mregister->create($info);
			$data['view'] = 'register/success';
			}
		}
		$this->load->view(LAYOUT, $data);
    }
}