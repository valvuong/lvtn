<?php

class Muser extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	public function check_login($data) {
		$this->db->select('username');
		$this->db->select('role');
		$this->db->from(MODEL_USER);
		$this->db->where('username',$data['username']);
		$this->db->where('password',$data['password']);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	public function check_username($username) {
		$this->db->select('username');
		$this->db->from(MODEL_USER);
		$this->db->where('username',$username);		
		$query = $this->db->get();
		if($query -> num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function check_email($email) {
		$this->db->select('email');
		$this->db->from(MODEL_USER);
		$this->db->where('email',$email);		
		$query = $this->db->get();
		if($query -> num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function create_user($data) {
        $last_id = '';
		$this->db->insert('user',$data);
		$last_id = $this->db->insert_id();
        return $last_id;
    }
}
