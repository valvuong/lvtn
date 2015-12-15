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

    public function change_password() {
        if ($this->session->userdata(LABEL_LOGIN)) {
            $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
            $newpass = $this->input->post('newpass');
            $data = array('password'=>$newpass);
            $this->db->where('idUser', $idUser);
            $this->db->update(MODEL_USER, $data);
            exit(true);
        }
    }

    public function change_info() {
        if ($this->session->userdata(LABEL_LOGIN)) {
            $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
            $field = $this->input->post('field');
            $value = $this->input->post('value');
            $data = array($field=>$value);
            $this->db->where('idUser', $idUser);
            $this->db->update(MODEL_USER, $data);
            exit(true);
        }
    }
}