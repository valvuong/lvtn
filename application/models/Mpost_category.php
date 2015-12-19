<?php

class Mpost_category extends CI_Model {

	private $id = 'id';
	private $tenloai = 'tenloai';
	
    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select(MODEL_CATEGORY.'.*');
        $this->db->from(MODEL_CATEGORY);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_one($id) {
        $this->db->select(MODEL_CATEGORY.'.ten,'.MODEL_CATEGORY.'.url_name');
        $this->db->from(MODEL_CATEGORY);
        $query = $this->db->get();
        return $query->result_array();
    }
}