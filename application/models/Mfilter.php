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

/// filter by category ////
    public function get_filter_rows($category, $area, $price, $district) {
        if ($area < 10000) {
            $min_area = $area / 100;
            $max_area = $area % 100;
        }
        else if ($area > 10000) {
            $min_area = $area / 1000;
            $max_area = $area % 1000;
        }
        if ($price < 100) {
            $min_price = $price / 10;
            $max_price = $price % 10;
        }
        else if ($price > 100) {
            $min_price = $price / 100;
            $max_price = $price % 100;
        }
        $this->db->select('*');
        $this->db->from(MODEL_POST);
        if ($category != '') {
            $this->db->where($this->chuyenmuc, $category);
        }
        if ($area != '') {
            $this->db->where($this->dientich.' >=', $min_area);
            $this->db->where($this->dientich.' <=', $max_area);
        }
        if ($price != '') {
            $this->db->where($this->giaphong.' >=', $min_price);
            $this->db->where($this->giaphong.' <=', $max_price);
        }   
        if ($district != '') {
            $this->db->where($this->quan, $district);
        }
        $this->db->where($this->hethan." >=", date('Y-m-d'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_filter_content($category, $area, $price, $district, $page) {
        if ($area < 10000) {
            $min_area = $area / 100;
            $max_area = $area % 100;
        }
        else if ($area > 10000) {
            $min_area = $area / 1000;
            $max_area = $area % 1000;
        }
        if ($price < 100) {
            $min_price = $price / 10;
            $max_price = $price % 10;
        }
        else if ($price > 100) {
            $min_price = $price / 100;
            $max_price = $price % 100;
        }
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        if ($category != '') {
            $this->db->where($this->chuyenmuc, $category);
        }
        if ($area != '') {
            $this->db->where($this->dientich.' >=', $min_area);
            $this->db->where($this->dientich.' <=', $max_area);
        }
        if ($price != '') {
            $this->db->where($this->giaphong.' >=', $min_price);
            $this->db->where($this->giaphong.' <=', $max_price);
        }   
        if ($district != '') {
            $this->db->where($this->quan, $district);
        }
        $this->db->where($this->hethan." >=", date('Y-m-d'));
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan', 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.id', 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        $query = $this->db->get();
        return $query->result_array();
    }
 }