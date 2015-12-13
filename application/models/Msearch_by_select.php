<?php

class Msearch_by_select extends CI_Model {
    private $id = 'id';
    private $idUser = 'idUser';
    private $tieude = 'tieude';
    private $loai = 'loai';
    private $quan = 'quan';
    private $noidung = 'noidung';
    private $giaca = 'giaca';
    private $tinhtrang = 'tinhtrang';
    private $sodienthoai = 'sodienthoai';
    private $tenlienhe = 'tenlienhe';
    private $ngaydang = 'ngaydang';




    private $phuong = 'phuong';
    private $chuyenmuc = 'chuyenmuc';
    private $giaphong = 'giaphong';
    private $dientich = 'dientich';
    private $khoangcach = 'khoangcach';
    private $hethan = 'hethan';
    private $kinhdo = 'kinhdo';
    private $vido = 'vido';
	public function __construct() {
        parent::__construct();
    }

/// filter by category ////
    public function get_search_room_by_select_rows($category, $district, $area, $price,$distance) {
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
        if ($distance < 1000) {
            $min_distance = $distance / 100;
            $max_distance = $distance % 100;
        }
        else if ($distance > 1000) {
            $min_distance = ($distance / 100000)/1000;
            $max_distance = ($distance % 100000)/1000;
        }
        $this->db->select('*');
        $this->db->from(MODEL_POST);
        if ($category != 0) {
            $this->db->where($this->chuyenmuc, $category);
        }
        if ($area != 0) {
            $this->db->where($this->dientich.' >=', $min_area);
            $this->db->where($this->dientich.' <=', $max_area);
        }
        if ($price != 0) {
            $this->db->where($this->giaphong.' >=', $min_price);
            $this->db->where($this->giaphong.' <=', $max_price);
        }
        if ($distance != 0) {
            if ($distance < 1000) {
                $this->db->where($this->khoangcach.' >=', $min_distance);
                $this->db->where($this->khoangcach.' <=', $max_distance);
            }
        }    
        if ($district != 0) {
            $this->db->where($this->quan, $district);
        }
        $this->db->where($this->hethan." >=", date('Y-m-d'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_search_room_by_select_content($category, $district, $area, $price, $distance, $page) {
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
        if ($distance < 1000) {
            $min_distance = (int)($distance / 100);
            $max_distance = $distance % 100;
        }
        else if ($distance > 1000) {
            $min_distance = ($distance / 100000)/1000;
            $max_distance = ($distance % 100000)/1000;
        }
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        if ($category != 0) {
            $this->db->where($this->chuyenmuc, $category);
        }
        if ($area != 0) {
            $this->db->where($this->dientich.' >=', $min_area);
            $this->db->where($this->dientich.' <=', $max_area);
        }
        if ($price != 0) {
            $this->db->where($this->giaphong.' >=', $min_price);
            $this->db->where($this->giaphong.' <=', $max_price);
        }
        if ($distance != 0) {
            if ($distance < 1000) {
                $this->db->where($this->khoangcach.' >=', $min_distance);
                $this->db->where($this->khoangcach.' <=', $max_distance);
            }
        }      
        if ($district != 0) {
            $this->db->where($this->quan, $district);
        }
        $this->db->where($this->hethan." >=", date('Y-m-d'));
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan', 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.id', 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        $this->db->order_by(MODEL_POST.'.'.$this->id, 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /////////////////////////////////////////////
    public function get_search_market_by_select_rows($category, $status, $price) {
        if ($price < 100) {
            $min_price = $price / 10;
            $max_price = $price % 10;
        }
        else if ($price > 100) {
            $min_price = $price / 100;
            $max_price = $price % 100;
        }
        $this->db->select('*');
        $this->db->from(MODEL_MARKET);
        if ($category != 0) {
            $this->db->where($this->loai, $category);
        }
        if ($price != 0) {
            $this->db->where($this->giaca.' >=', $min_price);
            $this->db->where($this->giaca.' <=', $max_price);
        }
        if ($status != 0) {
            $this->db->where($this->tinhtrang, $status);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_search_market_by_select_content($category, $status, $price,  $page) {
        if ($price < 100) {
            $min_price = $price / 10;
            $max_price = $price % 10;
        }
        else if ($price > 100) {
            $min_price = $price / 100;
            $max_price = $price % 100;
        }

        $this->db->select(MODEL_MARKET.'.'.$this->id);
        $this->db->select(MODEL_MARKET.'.'.$this->tieude);
        $this->db->select(MODEL_MARKET.'.'.$this->giaca);
        $this->db->select(MODEL_MARKET.'.'.$this->ngaydang);
        $this->db->select(MODEL_MARKET_UPLOAD.'.tenhinh');
        $this->db->select(MODEL_MARKET_CATEGORY.'.tenloai');
        $this->db->from(MODEL_MARKET);
        if ($category != 0) {
            $this->db->where($this->loai, $category);
        }
        if ($price != 0) {
            $this->db->where($this->giaca.' >=', $min_price);
            $this->db->where($this->giaca.' <=', $max_price);
        }
        if ($status != 0) {
            $this->db->where($this->tinhtrang, $status);
        }
        
        $this->db->join(MODEL_MARKET_UPLOAD, MODEL_MARKET_UPLOAD.'.idCho = '.MODEL_MARKET.'.'.$this->id, 'left');
        $this->db->join(MODEL_MARKET_CATEGORY, MODEL_MARKET_CATEGORY.'.id = '.MODEL_MARKET.'.'.$this->loai,'left');
        $this->db->limit(ADS_PER_PAGE, ADS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_MARKET.'.'.$this->id);
        $this->db->order_by(MODEL_MARKET.'.'.$this->id,'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
 }