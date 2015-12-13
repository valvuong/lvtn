<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_market_by_select extends CI_Controller {
    private $header_message;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model(array('mdistrict','msearch_by_select'));
        $this->header_message = "CHIA SẺ, BUÔN BÁN, TRAO ĐỔI ĐỒ DÙNG CÁ NHÂN";
    }
public function index($page=1) {
        $search_category = $this->input->get_post('search-category');
        $search_status = $this->input->get_post('search-status');
        $search_price = $this->input->get_post('search-price');


        $result     =   $this->msearch_by_select->get_search_market_by_select_content(
                            $search_category,$search_status,$search_price,$page);
        $num_rows   = $this->msearch_by_select->get_search_market_by_select_rows(
                           $search_category,$search_status,$search_price);

        if ($result != false) {

        }
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'market/list';
        $data['left_view'] = 'market/left';
        $data['left_content'] = '';
        $data['right_view'] = 'market/right';
        $data['right_content'] = '';
        $data['content']['content'] = $result;
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = ADS_PER_PAGE;
        $data['content']['num_rows'] = $num_rows;
        $data['content']['url_alias'] = 'Search_market_by_select';
        $data['content']['label_list'] = 'TẤT CẢ TIN RAO VẶT';
        $data['header_message'] = $this->header_message;
        $this->load->view(LAYOUT, $data);
    }
}
?>