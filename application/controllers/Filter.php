<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('mfilter');
    }

    public function filter($page=1) {
        $data = $this->input->get_post('data');
        if (!isset($data['category']))
            $category = '';
        else $category = $data['category'];
        if (!isset($data['area']))
            $area = '';
        else $area = $data['area'];
        if (!isset($data['price']))
            $price = '';
        else $price = $data['price'];
        if (!isset($data['district']))
            $district = '';
        else $district = $data['district'];
        $html = $this->build_filter_html($page,$category, $area, $price, $district);
        echo $html;
    }

    public function build_filter_html($page, $category, $area, $price, $district){
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content'] = $this->mfilter->get_filter_content($category, $area, $price, $district, $page);
        $data['page'] = $page + 1;
        $html = $this->load->view("filter", $data, TRUE);
        return $html;
    }
}
?>