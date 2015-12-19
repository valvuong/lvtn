<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mpost'));
    }

    public function index($id) {
        $query = $this->db->query(
            'SELECT '.MODEL_POST_CATEGORY.'.link AS url FROM '.MODEL_POST.
            ' LEFT JOIN '.MODEL_POST_CATEGORY.
            ' ON '.MODEL_POST_CATEGORY.'.id = '.MODEL_POST.'.chuyenmuc'.
            ' WHERE '.MODEL_POST.'.id = '.$id);
        $result = $query->row_array();
        
        $url = explode("/", $result['url'])[0].'/index/'.$id;
        redirect($url, 'refresh');
    }

    public function get_all($page=1) {
        if(!$this->session->userdata(LABEL_LOGIN)) {
            redirect('dang-nhap','refresh');
        }
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['left_view'] = 'layout/left';
        $data['left_content'] = '';
        $data['right_view'] = 'layout/right';
        $data['right_content'] = '';
        switch ($this->input->cookie(COOKIE_POST_SORT)) {
            case 0:
            case 1:
                $sort = 'DESC';
                $field = 'id';
                break;
            case 2:
                $sort = 'ASC';
                $field = 'giaphong';
                break;
            case 3:
                $sort = 'DESC';
                $field = 'giaphong';
                break;
            case 4:
                $sort = 'ASC';
                $field = 'dientich';
                break;
            case 5:
                $sort = 'DESC';
                $field = 'dientich';
                break;
        }
        $data['content']['content'] = $this->mpost->get_all($page, $sort, $field);
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_all_rows();
        $data['content']['url_alias'] = 'home/';
        $this->load->view(LAYOUT, $data);
    }

    public function show_by_district($page=1, $idD) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['left_view'] = 'layout/left';
        $data['left_content'] = '';
        $data['right_view'] = 'layout/right';
        $data['right_content'] = '';
        $data['content']['content'] = $this->mpost->get_by_district($idD, $page);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $idD);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_district_rows($idD);
        $url_alias = $this->uri->segment(1).'/';
        $data['content']['url_alias'] = $url_alias;
        $data['content']['url_sort'] = 'loai-'.$idD.'-';
        $this->load->view(LAYOUT, $data);
    }
    
    public function show_by_category($page=1, $idC, $sort = 1) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['left_view'] = 'layout/left';
        $data['left_content'] = '';
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
                $url_alias = 'loai-'.$idC.'-gia-giam-';
                break;
            case 4:
                $url_alias = 'loai-'.$idC.'-dientich-tang-';
                break;
            case 5:
                $url_alias = 'loai-'.$idC.'-dientich-giam-';
                break;
        }
        $data['content']['url_alias'] = $url_alias;
        $data['content']['url_sort'] = 'loai-'.$idC.'-';
        $this->load->view(LAYOUT, $data);
    }

    public function create_post() {
        if(!$this->session->userdata(LABEL_LOGIN)) {
            redirect('dang-nhap','refresh');
        }
        $data['view'] = 'post/create_post';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $this->load->view(LAYOUT, $data);
    }

    public function register_post() {
            $info = array(
                'idBantin'=> $this->input->get_post('idBantin'),
                'idUser' => $this->session->userdata(LABEL_LOGIN)['id'],
                'sophong' => $this->input->get_post('register-nums-room'),
                'songuoi' => $this->input->get_post('register-nums-people'),
                'ten' => $this->input->get_post('register-name'),
                'sodienthoai' => $this->input->get_post('register-phone'),
                'email' => $this->input->get_post('register-email')
            );
            $this->mpost->register_post($info);
    }

    public function update_register_post() {
        $idBantin =  $this->input->get_post('idBantin');
        $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        $info = array(
            'sophong' => $this->input->get_post('update-register-nums-room'),
            'songuoi' => $this->input->get_post('update-register-nums-people'),
            'ten' => $this->input->get_post('update-register-name'),
            'sodienthoai' => $this->input->get_post('update-register-phone'),
            'email' => $this->input->get_post('update-register-email')
        );
        $this->mpost->update_register_post($info,$idBantin,$idUser);
    }

    public function check_register_post() {
        $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        return $this->mpost->check_register_post($idUser);
    }
}