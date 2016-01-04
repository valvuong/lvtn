<?php

class Mcontact extends CI_Model {

	private $table;
	public function __construct() {
        parent::__construct();
        $this->table = MODEL_CONTACT;
    }

    public function save_contact($data) {
    	$this->db->insert($this->table, $data);
    }

    public function get_all() {
    	$this->db->select('*');
    	$this->db->from($this->table);
    	$this->db->order_by('id', 'DESC');
    	$query = $this->db->get();
    	return $query->result_array();
    }
}