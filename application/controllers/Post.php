<?php

class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mcategory','mpost'));
    }

    public function index($id) {
        $data['view'] = 'home';
        $data['content']['content'] = $this->mpost->getPostById($id);
        $this->load->view(LAYOUT, $data);
    }

    public function form() {
        $data['view'] = 'form/post';
        $data['content'] = '';
        $data['left'] = false;
        $data['right'] = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title','Tiêu đề','trim|required|min_length[5]');
        $this->form_validation->set_rules('email','Email','trim|valid_email');
        if($this->form_validation->run()) {
            $info = array(
                'tieude' => $this->input->post('title', TRUE),
                'email' => $this->input->post('email', TRUE),
                'sodienthoai' => $this->input->post('phone', TRUE),
                'loai' => $this->input->post('category', TRUE)
            );
            $this->mpost->create($info);
            redirect('welcome','refresh');
        }
        $this->load->view(LAYOUT, $data);
    }

    public function showPostsByDistrict($idD) {
        $data['view'] = '';
        $data['content']['content'] = $this->mpost->getAllByDistrict($idD);
        $this->load->view(LAYOUT, $data);
    }

    public function showPostsByCategory($idC) {
        $data['view'] = '';
        $data['content']['content'] = $this->mpost->getAllByCategory($idC);
        $this->load->view(LAYOUT, $data);
    }
}