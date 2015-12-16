<?php

class Mcontact extends CI_Model {

	public function __construct() {
        parent::__construct();
    }

    public function save_contact($data) {
    	$this->db->insert(MODEL_CONTACT, $data);
    }
}