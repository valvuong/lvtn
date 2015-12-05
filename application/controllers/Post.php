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
        $data['left_hidden'] = true;
        $data['right_view'] = 'layout/right';
        $data['right_content'] = '';
        $this->load->view(LAYOUT, $data);
    }
    
    public function show_by_category($page=1, $idC, $sort = 1) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['left_hidden'] = true;
        $data['right_view'] = 'layout/right';
        $data['right_content'] = '';
        $data['content']['content'] = $this->mpost->get_by_category($idC, $page, $sort);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $idC);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_category_rows($idC);
        switch ($sort) {
            case 1:
                $url_alias = 'loai-'.$idC.'-';
                break;
            case 2:
                $url_alias = 'loai-'.$idC.'-gia-tang-';
                break;
            case 3:
                $url_alias = 'loai-'.$idC.'-dientich-tang-';
                break;
        }
        // $url_alias = 'loai-'.$idC.'-';
        $data['content']['url_alias'] = $url_alias;
        $data['content']['url_sort'] = 'loai-'.$idC.'-';
        $this->load->view(LAYOUT, $data);
    }
}