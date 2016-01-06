<?php

class Mmarket extends CI_Model {

    private $id = 'id';
    private $idUser = 'idUser';
    private $tieude = 'tieude';
    private $loai = 'loai';
    private $loaisp = 'loaisp';
    private $noidung = 'noidung';
    private $giaca = 'giaca';
    private $tinhtrang = 'tinhtrang';
    private $sodienthoai = 'sodienthoai';
    private $tenlienhe = 'tenlienhe';
    private $ngaydang = 'ngaydang';

    public function __construct() {
        parent::__construct();
    }
    ////////////////////////////////
    public function get_cate() {
        $this->db->select('*');
        $this->db->from(MODEL_MARKET_CATEGORY);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_one($id) {
        $this->db->select(MODEL_MARKET.'.*');
        $this->db->select(MODEL_MARKET_SUB_CATEGORY.'.tenloai AS tenloaisp');
        $this->db->select(MODEL_MARKET_CATEGORY.'.tenloai');
        $this->db->from(MODEL_MARKET);
        $this->db->join(MODEL_MARKET_SUB_CATEGORY, MODEL_MARKET_SUB_CATEGORY.'.id = '.MODEL_MARKET.'.'.$this->loaisp, 'left');
        $this->db->join(MODEL_MARKET_CATEGORY, MODEL_MARKET_CATEGORY.'.id = '.MODEL_MARKET.'.'.$this->loai, 'left');
        $this->db->where(MODEL_MARKET.'.'.$this->id, $id);
        $query = $this->db->get();
        $result = $query->row_array();

        $result['tenhinh'] = $this->get_images($id);
        return $result;
    }

    public function create($data) {
        $last_id = '';
        $this->db->insert(MODEL_MARKET, $data[MODEL_MARKET]);
        $last_id = $this->db->insert_id();
        if(isset($data[ACTION_MARKET_UPLOAD])) {
            $this->do_upload($data[ACTION_MARKET_UPLOAD], $last_id);
        }
        $data_mana = array(
            'idUser' => $this->session->userdata(LABEL_LOGIN)['id'],
            'idRaovat' => $last_id
        );
        $this->db->insert(MODEL_MANAGE_MARKET, $data_mana);
        return $last_id;
    }

    private function do_upload($files, $id) {
        $config['upload_path'] = 'asset/uploads/market';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']	= '1024';
        $this->load->library('upload');
        foreach ($files as $field_name => $file)
        {
            foreach($file['name'] as $key => $image_name) {
                $_FILES[$field_name]['name'] = $file['name'][$key];
                $_FILES[$field_name]['type'] = $file['type'][$key];
                $_FILES[$field_name]['tmp_name'] = $file['tmp_name'][$key];
                $_FILES[$field_name]['error'] = $file['error'][$key];
                $_FILES[$field_name]['size'] = $file['size'][$key];

                $file_name = uniqid($id.'_');
                $config['file_name'] = $file_name;
                $this->upload->initialize($config);

                $data['idCho'] = $id;
                $fname = $file['name'][$key];
                $fname = explode('.', $fname);
                $extension = end($fname);
                $data['tenhinh'] = $file_name.'.'.$extension;
                $this->db->insert(MODEL_MARKET_UPLOAD, $data);

                $this->upload->do_upload($field_name);
            }
        }
    }

    public function get_all_rows() {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_MARKET);
        $result = $query->row_array();
        return $result['total'];
    }

    public function show_what($page) {
        $this->db->select(MODEL_MARKET.'.'.$this->id);
        $this->db->select(MODEL_MARKET.'.'.$this->tieude);
        $this->db->select(MODEL_MARKET.'.'.$this->giaca);
        $this->db->select(MODEL_MARKET.'.'.$this->ngaydang);
        $this->db->select(MODEL_MARKET.'.'.$this->tinhtrang);
        $this->db->select(MODEL_MARKET_UPLOAD.'.tenhinh');
        $this->db->select(MODEL_MARKET_CATEGORY.'.tenloai');
        $this->db->from(MODEL_MARKET);
        $this->db->join(MODEL_MARKET_UPLOAD, MODEL_MARKET_UPLOAD.'.idCho = '.MODEL_MARKET.'.'.$this->id, 'left');
        $this->db->join(MODEL_MARKET_CATEGORY, MODEL_MARKET_CATEGORY.'.id = '.MODEL_MARKET.'.'.$this->loai,'left');
        $this->db->limit(ADS_PER_PAGE, ADS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_MARKET.'.'.$this->id);
        $this->db->order_by(MODEL_MARKET.'.'.$this->id,'DESC');
    }

    public function get_all($page = 1) {
        $this->show_what($page);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_cate_rows($cate_id) {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_MARKET.' WHERE '.MODEL_MARKET.'.'.$this->loai.' = '.$cate_id);
        $result = $query->row_array();
        return $result['total'];
    }

    public function get_by_category($page = 1, $cate_id) {
        $this->show_what($page);
        
        $this->db->where(MODEL_MARKET.'.'.$this->loai, $cate_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_subcate_rows($subcate_id) {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_MARKET.' WHERE '.MODEL_MARKET.'.'.$this->loaisp.' = '.$subcate_id);
        $result = $query->row_array();
        return $result['total'];
    }

    public function get_by_subcategory($page = 1, $subcate_id) {
        $this->show_what($page);

        $this->db->where(MODEL_MARKET.'.'.$this->loaisp, $subcate_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_search_rows($category, $search_subcategory, $status, $price) {
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
        if ($status != -1) {
            $this->db->where($this->tinhtrang, $status);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_search_content($category, $search_subcategory, $status, $price,  $page) {
        if ($price < 100) {
            $min_price = $price / 10;
            $max_price = $price % 10;
        }
        else if ($price > 100) {
            $min_price = $price / 100;
            $max_price = $price % 100;
        }

        //$this->show_what($page);
        $this->db->select(MODEL_MARKET.'.'.$this->id);
        $this->db->select(MODEL_MARKET.'.'.$this->tieude);
        $this->db->select(MODEL_MARKET.'.'.$this->giaca);
        $this->db->select(MODEL_MARKET.'.'.$this->ngaydang);
        $this->db->select(MODEL_MARKET.'.'.$this->tinhtrang);
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
        if ($status != -1) {
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

    public function get_by_id($id) {
        $t = MODEL_MARKET;
        $this->db->select($t.'.id');
        $this->db->select($t.'.tieude');
        $this->db->from($t);
        $this->db->where($t.'.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function delete_market($id) {
        $this->db->delete(MODEL_MARKET, array('id' => $id)); 
    }

    public function get_images($id) {
        $t = MODEL_MARKET_UPLOAD;
        $this->db->select($t.'.tenhinh');
        $this->db->from($t);
        $this->db->where($t.'.idCho', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}