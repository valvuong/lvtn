<?php

class Mward extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('*');
        $this->db->from(MODEL_WARD);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_by_district($id) {
        $this->db->select('*');
        $this->db->from(MODEL_WARD);
        $this->db->where('idQ',$id);
        $query = $this->db->get();
        return $query->result_array();
    }
}