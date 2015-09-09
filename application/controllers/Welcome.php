<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->database();
        $this->load->model(array('mdistrict','mpost','mcategory'));
    }

	public function index($page=1)
	{
        $data['view'] = 'home';
        $data['content']['content'] = $this->mpost->getAllPerPage($page);
        $data['content']['pagination'] = array('welcome','index',$page);
        $data['content']['num_rows'] = $this->mpost->getAllNumRow();
        $this->load->view(LAYOUT, $data);
	}

}
