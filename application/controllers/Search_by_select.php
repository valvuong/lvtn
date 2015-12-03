<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_by_select extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model(array('mdistrict','msearch_by_select'));
    }

    public function index($page=1) {
        $search_category = $this->input->get_post('search-category');
        $search_district = $this->input->get_post('search-district');
        $search_area = $this->input->get_post('search-area');
        $search_price = $this->input->get_post('search-price');


        $result     =   $this->msearch_by_select->get_search_by_select_content(
                            $search_category,$search_district,$search_area,$search_price,$page);
        $num_rows   = $this->msearch_by_select->get_search_by_select_rows(
                            $search_category,$search_district,$search_area,$search_price);

        if ($result != false) {

        }
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['content']['content'] = $result;
        $data['left_hidden'] = true;
        $data['right_view'] = 'layout/right';
        $data['right_content']['content'] = '';
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $num_rows;
        $data['content']['url_alias'] = 'Search_by_select/index/';
        echo $num_rows;
        $this->load->view(LAYOUT, $data);
    }
}
?>