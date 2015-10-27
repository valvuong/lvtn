<?php

class Mregister extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	public function create($data) {
        $last_id = '';
		$this->db->insert('user',$data);
		$last_id = $this->db->insert_id();
        return $last_id;
    }
}
