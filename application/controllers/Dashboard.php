<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model(array('muser'));
	}

	public function index() {
		if(!$this->session->userdata(LABEL_LOGIN)) {
			redirect('dang-nhap','refresh');
		}
		$data['view'] = 'dashboard/index';
		$param = $this->session->userdata(LABEL_LOGIN)['id'];
		$f = $this->muser->get_profile($param);
		$data['content']['info'] = $f[0];
		$data['display_name'] = $f[0]['name'];
		$this->load->view('dashboard/main', $data);
	}

	public function change_password() {
		if(!$this->session->userdata(LABEL_LOGIN)) {
			redirect('dang-nhap','refresh');
		}
		$data['view'] = 'dashboard/change_password';
		$data['content'] = '';
		$this->load->view('dashboard/main', $data);
	}

	public function change_avatar() {
		if(!$this->session->userdata(LABEL_LOGIN)) {
			redirect('dang-nhap','refresh');
		}
		$data['view'] = 'dashboard/change_avatar';
		$data['content'] = '';
		$this->load->view('dashboard/main', $data);
	}

	public function market() {
		
	}

	public function post() {
		
	}
}