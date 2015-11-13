<?php

class Mfilter extends CI_Model {
	private $id = 'id';
    private $tieude = 'tieude';
    private $quan = 'quan';
    private $phuong = 'phuong';
    private $chuyenmuc = 'chuyenmuc';
    private $giaphong = 'giaphong';
    private $dientich = 'dientich';
    private $noidung = 'noidung';
    private $ngaydang= 'ngaydang';
    private $hethan = 'hethan';

	public function __construct() {
        parent::__construct();
    }

    private function get_field_rows($id, $field_name) {
        $this->db->select('*');
        $this->db->from(MODEL_POST);
        $this->db->where($field_name, $id);
        $this->db->where($this->hethan." >=", date('Y-m-d'));
        $query = $this->db->get();
        return $query->num_rows();
    }
/// filter by category ////
    public function get_category_rows($idC) {
        $result = $this->get_field_rows($idC, $this->chuyenmuc);
        return $result;
    }

    public function get_by_category($idC, $page) {
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        $this->db->where(MODEL_POST.'.'.$this->chuyenmuc, $idC);
        $this->db->where(MODEL_POST.'.'.$this->hethan.' >=', date('Y-m-d'));
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan', 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.id', 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        $query = $this->db->get();
        return $query->result_array();
    }
//// filter by area ////
    public function get_area_rows() {
        $this->db->select('*');
        $this->db->from(MODEL_POST);
        $this->db->where($this->hethan." >=", date('Y-m-d'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_by_area($idA, $page) {
    	if ($idA < 10000) {
    		$minA = $idA / 100;
    		$maxA = $idA % 100;
    	}
    	else if ($idA > 10000) {
    		$minA = $idA / 1000;
    		$maxA = $idA % 1000;
    	}
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        $this->db->where(MODEL_POST.'.'.$this->dientich.' >=', $minA);
        $this->db->where(MODEL_POST.'.'.$this->dientich.' <=', $maxA);
        $this->db->where(MODEL_POST.'.'.$this->hethan.' >=', date('Y-m-d'));
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan', 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.id', 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        $query = $this->db->get();
        return $query->result_array();
    }
//// filter by price ////
    public function get_area_rows() {
        $this->db->select('*');
        $this->db->from(MODEL_POST);
        $this->db->where($this->hethan." >=", date('Y-m-d'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_by_area($idA, $page) {
    	if ($idA < 10000) {
    		$minA = $idA / 100;
    		$maxA = $idA % 100;
    	}
    	else if ($idA > 10000) {
    		$minA = $idA / 1000;
    		$maxA = $idA % 1000;
    	}
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        $this->db->where(MODEL_POST.'.'.$this->dientich.' >=', $minA);
        $this->db->where(MODEL_POST.'.'.$this->dientich.' <=', $maxA);
        $this->db->where(MODEL_POST.'.'.$this->hethan.' >=', date('Y-m-d'));
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan', 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.id', 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
 }