<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_by_select extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model(array('mdistrict','msearch_by_select'));
    }

    public function index($page=1) {
        $search_category = $this->input->get_post('search-category');
        $search_district = $this->input->get_post('search-district');
        $search_area = $this->input->get_post('search-area');
        $search_price = $this->input->get_post('search-price');
        $search_distance = $this->input->get_post('search-distance');


        $result     =   $this->msearch_by_select->get_search_room_by_select_content(
                            $search_category,$search_district,$search_area,$search_price,$search_distance,$page);
        $num_rows   = $this->msearch_by_select->get_search_room_by_select_rows(
                            $search_category,$search_district,$search_area,$search_price,$search_distance);

        if ($result != false) {

        }
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['content']['content'] = $result;
        $data['left_view'] = 'layout/left';
        $data['left_content']['search_category'] = $search_category;
        $data['left_content']['search_district'] = $search_district;
        $data['left_content']['search_area'] = $search_area;
        $data['left_content']['search_price'] = $search_price;
        $data['right_view'] = 'layout/right';
        $data['right_content']['content'] = '';
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $num_rows;
        $data['content']['url_alias'] = 'Search_by_select';
        $this->load->view(LAYOUT, $data);
    }
}
?>