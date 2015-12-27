<?php

class Mmarket_category extends CI_Model {

	private $table;
	
    public function __construct() {
        parent::__construct();
        $this->table = MODEL_MARKET_CATEGORY;
    }

    public function get_all() {
    	$this->db->select('*');
    	$this->db->from($this->table);
    	$query = $this->db->get();
    	return $query->result_array();
    }

    public function get_one($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_sub_category($idC) {
        $this->db->select('*');
        $this->db->from(MODEL_MARKET_SUB_CATEGORY);
        $this->db->where('idRLoai', $idC);
        $query = $this->db->get();
        return $query->result_array();
    }
}