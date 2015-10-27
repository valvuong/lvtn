<?php

class Mpost extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_rows() {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_POST.' WHERE hethan >= NOW()');
        $result = $query->row_array();
        return $result['total'];
    }

    public function get_all($page = 1) {
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        $this->db->where("hethan >=", date('Y-m-d'));
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan', 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.id', 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.id');
        $this->db->order_by(MODEL_POST.'.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    private function get_field_rows($id, $field_name) {
        $this->db->select('*');
        $this->db->from(MODEL_POST);
        $this->db->where($field_name,$id);
        $this->db->where("hethan >=", date('Y-m-d'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function get_by_field($id, $field_name, $page) {
        $this->db->select('*');
        $this->db->from(MODEL_POST);
        $this->db->where($field_name,$id);
        $this->db->where("hethan >=", date('Y-m-d'));
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_district_rows($idD) {
        $result = $this->get_field_rows($idD, 'quan');
        return $result;
    }

    public function get_by_district($idD, $page) {
        $result = $this->get_by_field($idD, 'quan', $page);
        return $result;
    }

    public function get_category_rows($idC) {
        $result = $this->get_field_rows($idC, 'chuyenmuc');
        return $result;
    }

    public function get_by_category($idC, $page) {
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        $this->db->where('chuyenmuc', $idC);
        $this->db->where('hethan >=', date('Y-m-d'));
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan', 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.id', 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_one($id) {
        $this->db->select('tieude,chuyenmuc,giaphong,dientich,noidung,ngaydang,hethan');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_WARD.'.tenphuong');
        $this->db->select(MODEL_POST_PRICE.'.tiendien,'.MODEL_POST_PRICE.'.tiennuoc,'.MODEL_POST_PRICE.'.datcoc');
        $this->db->select(MODEL_POST_CONTACT.'.hoten,'.MODEL_POST_CONTACT.'.sodienthoai,'.MODEL_POST_CONTACT.'.diachi,'.MODEL_POST_CONTACT.'.email');
        $this->db->from(MODEL_POST);
        $this->db->where('id', $id);
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan');
        $this->db->join(MODEL_WARD, MODEL_WARD.'.idP = '.MODEL_POST.'.phuong');
        $this->db->join(MODEL_POST_PRICE, MODEL_POST_PRICE.'.idBantin = '.$id, 'left');
        $this->db->join(MODEL_POST_CONTACT, MODEL_POST_CONTACT.'.idBantin = '.$id, 'left');
        $query = $this->db->get();
        $result = $query->result_array();

        $this->db->select('tenhinh');
        $this->db->from(MODEL_POST_UPLOAD);
        $this->db->where('idBantin',$id);
        $query = $this->db->get();
        $result[0]['tenhinh'] = $query->result_array();

        return $result[0];
    }

    public function create($data) {
        $last_id = '';
        foreach($data as $table => $info) {
            if($table == ACTION_POST_UPLOAD) {
                $this->upload($info, $last_id);
            } elseif($table != MODEL_POST) {
                $info = array('idBantin' => $last_id) + $info;
                $this->db->insert($table, $info);
            } else {
                $this->db->insert($table, $info);
                $last_id = $this->db->insert_id();
            }
        }
        return $last_id;
    }

    private function upload($files, $id) {
        $config['upload_path'] = 'asset/uploads/post';
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

                $data['idBantin'] = $id;
                $fname = $file['name'][$key];
                $fname = explode('.', $fname);
                $extension = end($fname);
                $data['tenhinh'] = $file_name.'.'.$extension;
                $this->db->insert(MODEL_POST_UPLOAD, $data);

                $this->upload->do_upload($field_name);
            }
        }
    }
}