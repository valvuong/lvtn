<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->model(array('mdistrict','mpost'));
    }

	public function index($page=1)
	{
        $data['view'] = 'home';
        $data['content']['content'] = $this->mpost->get_all($page);
        $data['content']['pagination'] = array('welcome','index',$page);
        $data['content']['num_rows'] = $this->mpost->get_all_rows();
        $this->load->view(LAYOUT, $data);
	}

    public function contact() {
        $data['view'] = 'static_page/contact';
        $data['content']['content'] = '';
        $this->load->view(LAYOUT, $data);
    }

    public function about() {
        $data['view'] = 'static_page/about';
        $data['content']['content'] = '';
        $this->load->view(LAYOUT, $data);
    }

}
