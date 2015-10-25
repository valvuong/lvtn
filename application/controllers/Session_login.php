<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessin_login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
    }
	public function index() {
		if($this->session->userdata('logged_in'))
		{
		  $session_data = $this->session->userdata('logged_in');
		  $data['username'] = $session_data['username'];
		  
		}
		else
		{
		  $data['username']="Xin chào khách";
		}
	}
}
?>