<?php

class Mmarket extends CI_Model {

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

    public function __construct() {
        parent::__construct();
    }

    public function get_cate() {
        $this->db->select('*');
        $this->db->from(MODEL_MARKET_CATEGORY);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_one($id) {
        $this->db->select(MODEL_MARKET.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_MARKET_CATEGORY.'.tenloai');
        $this->db->from(MODEL_MARKET);
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_MARKET.'.'.$this->quan, 'left');
        $this->db->join(MODEL_MARKET_CATEGORY, MODEL_MARKET_CATEGORY.'.id = '.MODEL_MARKET.'.'.$this->loai, 'left');
        $this->db->where(MODEL_MARKET.'.'.$this->id, $id);
        $query = $this->db->get();
        $result = $query->result_array();

        $this->db->select('tenhinh');
        $this->db->from(MODEL_MARKET_UPLOAD);
        $this->db->where('idCho', $id);
        $query = $this->db->get();
        $result[0]['tenhinh'] = $query->result_array();
        return $result[0];
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

    public function get_all($page = 1) {
        $this->db->select(MODEL_MARKET.'.'.$this->id);
        $this->db->select(MODEL_MARKET.'.'.$this->tieude);
        $this->db->select(MODEL_MARKET.'.'.$this->giaca);
        $this->db->select(MODEL_MARKET.'.'.$this->ngaydang);
        $this->db->select(MODEL_MARKET_UPLOAD.'.tenhinh');
        $this->db->select(MODEL_MARKET_CATEGORY.'.tenloai');
        $this->db->from(MODEL_MARKET);
        $this->db->join(MODEL_MARKET_UPLOAD, MODEL_MARKET_UPLOAD.'.idCho = '.MODEL_MARKET.'.'.$this->id, 'left');
        $this->db->join(MODEL_MARKET_CATEGORY, MODEL_MARKET_CATEGORY.'.id = '.MODEL_MARKET.'.'.$this->loai,'left');
        $this->db->limit(ADS_PER_PAGE, ADS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_MARKET.'.'.$this->id);
        $this->db->order_by(MODEL_MARKET.'.'.$this->id,'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_cate_rows($cate_id) {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_MARKET.' WHERE '.MODEL_MARKET.'.'.$this->loai.' = '.$cate_id);
        $result = $query->row_array();
        return $result['total'];
    }

    public function get_by_category($page = 1, $cate_id) {
        $this->db->select(MODEL_MARKET.'.'.$this->id);
        $this->db->select(MODEL_MARKET.'.'.$this->tieude);
        $this->db->select(MODEL_MARKET.'.'.$this->giaca);
        $this->db->select(MODEL_MARKET.'.'.$this->ngaydang);
        $this->db->select(MODEL_MARKET_UPLOAD.'.tenhinh');
        $this->db->select(MODEL_MARKET_CATEGORY.'.tenloai');
        $this->db->from(MODEL_MARKET);
        $this->db->join(MODEL_MARKET_UPLOAD, MODEL_MARKET_UPLOAD.'.idCho = '.MODEL_MARKET.'.'.$this->id, 'left');
        $this->db->join(MODEL_MARKET_CATEGORY, MODEL_MARKET_CATEGORY.'.id = '.MODEL_MARKET.'.'.$this->loai,'left');
        $this->db->where(MODEL_MARKET.'.loai',$cate_id);
        $this->db->limit(ADS_PER_PAGE, ADS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_MARKET.'.'.$this->id);
        $this->db->order_by(MODEL_MARKET.'.'.$this->id,'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}