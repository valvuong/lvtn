<?php

class Mmarket_category extends CI_Model {

	private $id = 'id';
	private $tenloai = 'tenloai';
	
    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
    	$this->db->select('*');
    	$this->db->from(MODEL_MARKET_CATEGORY);
    	$query = $this->db->get();
    	return $query->result_array();
    }
}