<?php

class Mmarket extends CI_Model {
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
        $this->db->select('*');
        $this->db->from(MODEL_MARKET);
        $this->db->where('idCho',$id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function create($data) {
        $last_id = '';
        $this->db->insert(MODEL_MARKET, $data[MODEL_MARKET]);
        $last_id = $this->db->insert_id();
        if(isset($data[ACTION_MARKET_UPLOAD])) {
            $this->do_upload($data[ACTION_MARKET_UPLOAD], $last_id);
        }
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
                $data['tenhinh'] = $file_name;
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
        $this->db->select(MODEL_MARKET.'.id,'.MODEL_MARKET.'.tieude,'.MODEL_MARKET.'.giaca,'.MODEL_MARKET.'.ngaydang');
        $this->db->select(MODEL_MARKET_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_MARKET);
        $this->db->join(MODEL_MARKET_UPLOAD, MODEL_MARKET_UPLOAD.'.idCho = '.MODEL_MARKET.'.id', 'left');
        $this->db->limit(ADS_PER_PAGE, ADS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_MARKET.'.id');
        $query = $this->db->get();
        return $query->result_array();
    }
}