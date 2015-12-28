<?php

class Mpost_category extends CI_Model {
	
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table = MODEL_POST_CATEGORY;
    }

    public function get_all() {
        $t = $this->table;
        $this->db->select($t.'.*');
        $this->db->from($t);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_one($id) {
        $t = $this->table;
        $this->db->select($t.'.*');
        $this->db->from($t);
        $this->db->where($t.'.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_subtable($id) {
        $t = $this->table;
        $this->db->select($t.'.bang_phu');
        $this->db->from($t);
        $this->db->where($t.'.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
}