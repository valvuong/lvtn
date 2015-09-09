<?php

class Mcategory extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from('chuyenmuc');
        $query = $this->db->get();
        return $query->result_array();
    }
}