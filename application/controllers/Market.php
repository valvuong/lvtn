<?php

class Market extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mmarket'));
    }

    public function index() {

    }

    public function create() {
        $data['view'] = 'market/create';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;

        $this->load->library('form_validation');
        $rules = array(
            array(
                'field' => 'ad-title',
                'rule' => 'required'
            ),
            array(
                'field' => 'ad-content',
                'rule' => 'required'
            )
        );
        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $info = array();
                $id = $this->mmarket->create($info);
                redirect('market/index'.$id,'refresh');
            }
        }
        $this->load->view(LAYOUT,$data);
    }
}