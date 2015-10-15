<?php

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->database();
        $this->load->model(array('mward'));
    }

    public function get_ward() {
        $id = $this->input->post('q');
        $data = $this->mward->get_by_district($id);
        foreach($data as $row) {
            $result[$row['idP']] = $row['tenphuong'];
        }
        exit(json_encode($result));
    }
}