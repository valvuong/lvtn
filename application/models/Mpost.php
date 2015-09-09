<?php

class Mpost extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllNumRow() {
        $query = $this->db->query('SELECT COUNT(*) as total FROM bantin');
        $result = $query->row_array();
        return $result['total'];
    }

    public function getAllPerPage($page) {
        $this->db->select('*');
        $this->db->from('bantin');
        $this->db->join('quan','quan.id = bantin.quan','left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getNumRowByDistrict($idD) {
        $this->db->select('*');
        $this->db->from('bantin');
        $this->db->where('quan',$idD);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getAllByDistrictPerPage($idD, $page) {
        $this->db->select('*');
        $this->db->from('bantin');
        $this->db->where('quan',$idD);
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getNumRowByCategory($idC) {
        $this->db->select('*');
        $this->db->from('bantin');
        $this->db->where('phuong',$idC);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getAllByCategory($idC) {
        $this->db->select('*');
        $this->db->from('bantin');
        $this->db->where('phuong',$idC);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPostById($id) {
        $this->db->select('*');
        $this->db->from('bantin');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function create($data) {
        $this->db->insert('post',$data);
    }
}