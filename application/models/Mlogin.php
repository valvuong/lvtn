<?php

class Mlogin extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	public function check_login($data) {
		$this->db->select('username');
		$this->db->from(MODEL_USER);
		$this->db->where('username',$data['username']);
		$this->db->where('password',$data['password']);
		$query = $this->db->get();
        return $query->result_array();
	}
}
