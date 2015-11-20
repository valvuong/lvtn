<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form'));
	}

	public function index() {
		if($this->session->userdata('logged_in')) {
			$this->load->view('dashboard/main');
		}$this->load->view('dashboard/main');
	}
}