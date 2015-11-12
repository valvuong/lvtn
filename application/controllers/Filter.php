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
         //$result = $this->mfilter->filter($val);
         //$result = array("val" => $val);
         //echo json_encode ($result) ;
        $html = $this->build_filter_html(1,$val);
        echo $html;
    }

    public function build_filter_html($page=1, $idC){
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content'] = $this->mpost->get_by_category($idC, $page);
        $data['pagination'] = array($class_name, $method_name, $page, $idC);
        $data['items_per_page'] = POSTS_PER_PAGE;
        $data['num_rows'] = $this->mpost->get_category_rows($idC);
        $html = $this->load->view("home", $data, TRUE);
        return $html;
        
    }

    public function show_by_category($page=1, $idC) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['content']['content'] = $this->mpost->get_by_category($idC, $page);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $idC);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_category_rows($idC);
        $this->load->view(LAYOUT, $data);
    }
}
?>