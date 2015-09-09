<?php

class Mdistrict extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from('quan');
        $this->db->order_by('ten DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}