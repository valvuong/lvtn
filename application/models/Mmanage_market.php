<?php

class Mmanage_market extends CI_Model {

	private $table;

	public function __construct() {
		parent::__construct();
		$this->table = MODEL_MANAGE_MARKET;
	}

	public function create($idUser, $idMarket) {
		$data = array(
			'idUser' => $idUser,
			'idRaovat' => $idMarket
		);
		$this->db->insert($this->table, $data);
	}

	public function check_owner($idUser, $idMarket) {
		$t = $this->table;
		$this->db->select($t.'.*');
		$this->db->from($t);
		$this->db->where(array('idUser'=>$idUser, 'idRaovat'=>$idMarket));
		$query = $this->db->get();
		if (!empty($query->row_array())) {
			return true;
		}
		return false;
	}

	public function get_market_by_user($idUser) {
		$t = $this->table;
		$this->db->select($t.'.idRaovat');
		$this->db->from($t);
		$this->db->where($t.'.idUser', $idUser);
		$query = $this->db->get();
		return $query->result_array();
	}
}