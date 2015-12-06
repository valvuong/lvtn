<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form'));
	}

	public function index() {
		if($this->session->userdata(LABEL_LOGIN)) {
			$data['view'] = 'dashboard/index';
			$this->load->view('dashboard/main', $data);
		} else {
			redirect('dang-nhap','refresh');
		}
	}

	public function market() {
		
	}

	public function post() {
		
	}
}