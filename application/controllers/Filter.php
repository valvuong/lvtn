<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','muser','mfilter','mpost'));
    }

    public function filter() {
         $val = $this->input->get_post('val');
         $name = $this->input->get_post('name');
        $html = $this->build_filter_html_area(1,$val);
        echo $html;
    }

    public function build_filter_html_category($page=1, $idC){
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content'] = $this->mfilter->get_by_category($idC, $page);
        $data['pagination'] = array($class_name, $method_name, $page, $idC);
        $data['items_per_page'] = POSTS_PER_PAGE;
        $data['num_rows'] = $this->mfilter->get_category_rows($idC);
        $data['url_alias'] = '';
        $html = $this->load->view("home", $data, TRUE);
        return $html;
        
    }
    public function build_filter_html_area($page=1, $idA){
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content'] = $this->mfilter->get_by_area($idA, $page);
        $data['pagination'] = array($class_name, $method_name, $page, $idA);
        $data['items_per_page'] = POSTS_PER_PAGE;
        $data['num_rows'] = $this->mfilter->get_area_rows();
        $data['url_alias'] = '';
        $html = $this->load->view("home", $data, TRUE);
        return $html;
        
    }
    public function build_filter_html_price($page=1, $idC){
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content'] = $this->mpost->get_by_category($idC, $page);
        $data['pagination'] = array($class_name, $method_name, $page, $idC);
        $data['items_per_page'] = POSTS_PER_PAGE;
        $data['num_rows'] = $this->mpost->get_category_rows($idC);
        $data['url_alias'] = '';
        $html = $this->load->view("home", $data, TRUE);
        return $html;
        
    }
    public function build_filter_html_district($page=1, $idC){
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content'] = $this->mpost->get_by_category($idC, $page);
        $data['pagination'] = array($class_name, $method_name, $page, $idC);
        $data['items_per_page'] = POSTS_PER_PAGE;
        $data['num_rows'] = $this->mpost->get_category_rows($idC);
        $data['url_alias'] = '';
        $html = $this->load->view("home", $data, TRUE);
        return $html;
        
    }
}
?>