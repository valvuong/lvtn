<?php

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','file'));
        $this->load->database();
        $this->load->model(array('mward','mmarket_category','muser'));
    }

    public function get_ward() {
        $id = $this->input->post('q');
        $data = $this->mward->get_by_district($id);
        foreach($data as $row) {
            $result[$row['idP']] = $row['tenphuong'];
        }
        exit(json_encode($result));
    }

    public function get_adCate() {
        $id = $this->input->post('q');
        $data = $this->mmarket_category->get_sub_category($id);
        foreach($data as $row) {
            $result[$row['id']] = $row['tenloai'];
        }
        exit(json_encode($result));
    }
}