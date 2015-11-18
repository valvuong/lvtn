<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model(array('mfilter','mdistrict','msearch'));
    }

    public function index($page=1){
    	$key_word = $this->input->get('search');
    	$result 	= $this->msearch->get_data_from_search($key_word,$page);
    	$num_rows 	= $this->msearch->get_all_rows_from_search($key_word);
    	if ($result != false) {

    	}
    	$class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'search';
        $data['content']['key_word'] = $key_word;
        $data['content']['content'] = $result;
        $data['content']['pagination'] = array($class_name, $method_name, $page);
      	$data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $num_rows;
        $data['content']['url_alias'] = 'search/get_search_content/';
        echo $num_rows;
        $this->load->view(LAYOUT, $data);
    }

}