<?php

class Mfilter extends CI_Model {
	public function __construct() {
        parent::__construct();
    }

    public function filter($data){
    	$this->db->select('*');
		$this->db->from(MODEL_POST);
		$this->db->where('chuyenmuc',$data);
		$query = $this->db->get();
		return $query -> result_array();
    }

    
 }