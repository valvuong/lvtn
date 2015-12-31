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

	public function user_locked_page() {
		$data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $data['content'] = '';
        $data['view'] = 'user/user_locked';
        $this->load->view(LAYOUT, $data);
	}
	
}
