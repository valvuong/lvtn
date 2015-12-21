<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));
    }

	public function index() {
        redirect('home/1','refresh');
	}
	
}
