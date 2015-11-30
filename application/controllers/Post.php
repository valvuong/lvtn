<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mpost'));
    }

    public function index($id) {
        $query = $this->db->query('SELECT '.MODEL_POST.'.chuyenmuc FROM '.MODEL_POST.' WHERE '.MODEL_POST.'.id = '.$id);
        $result = $query->row_array();
        $query = $this->db->query('SELECT '.MODEL_POST_CATEGORY.'.link AS url FROM '.MODEL_POST_CATEGORY.' WHERE '.MODEL_POST_CATEGORY.'.id = '.$result['chuyenmuc']);
        $result = $query->row_array();
        $url = explode("/", $result['url'])[0].'/index/'.$id;
        redirect($url,'refresh');
    }

    public function show_by_district($page=1, $idD) {
        $data['view'] = 'home';
        $data['content']['content'] = $this->mpost->get_by_district($idD, $page);
        $this->load->view(LAYOUT, $data);
    }
    
    public function show_by_category($page=1, $idC) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['content']['content'] = $this->mpost->get_by_category($idC, $page);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $idC);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_category_rows($idC);
        $data['content']['url_alias'] = 'tin-vat-';
        $this->load->view(LAYOUT, $data);
    }
}