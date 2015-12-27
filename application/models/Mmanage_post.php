<?php

class Mmanage_post extends CI_Model {

	private $table;
	public function __construct() {
		parent::__construct();
		$this->table = MODEL_MANAGE_POST;
	}

	public function get_post_by_user($idUser) {
		$t = $this->table;
		$this->db->select($t.'.idBantin');
		$this->db->from($t);
		$this->db->where($t.'.idUser', $idUser);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function create($idUser, $idPost) {
		$data = array(
			'idUser' => $idUser,
			'idBantin' => $idPost
		);
		$this->db->insert($this->table, $data);
	}

	public function check_owner($idUser, $idPost) {
		$t = $this->table;
		$this->db->select($t.'.*');
		$this->db->from($t);
		$this->db->where(array('idUser'=>$idUser, 'idBantin'=>$idPost));
		$query = $this->db->get();
		if (!empty($query->row_array())) {
			return true;
		}
		return false;
	}
}