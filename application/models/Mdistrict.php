<?php

class Mdistrict extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('*');
        $this->db->from(MODEL_DISTRICT);
        $this->db->order_by('tenquan DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}