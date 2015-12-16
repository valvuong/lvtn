<?php

class Mpost extends CI_Model {

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
    private $kinhdo = 'kinhdo';
    private $vido = 'vido';

    public function __construct() {
        parent::__construct();
    }

    public function get_all_rows() {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_POST.' WHERE '.$this->hethan.' >= NOW()');
        $result = $query->row_array();
        return $result['total'];
    }

    public function get_all($page = 1, $sort, $field) {
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        $this->db->where($this->hethan." >=", date('Y-m-d'));
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.'.$this->quan, 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.'.$this->id, 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        $this->db->order_by(MODEL_POST.'.'.$field, $sort);
        $query = $this->db->get();
        return $query->result_array();
    }

    private function get_field_rows($id, $field_name) {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_POST.' WHERE '.$field_name.' = '.$id.' AND '.$this->hethan.' >= NOW()');
        $result = $query->row_array();
        return $result['total'];
    }

    private function get_by_field($id, $field_name, $page) {
        $this->db->select('*');
        $this->db->from(MODEL_POST);
        $this->db->where($field_name, $id);
        $this->db->where($this->hethan." >=", date('Y-m-d'));
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_district_rows($idD) {
        $result = $this->get_field_rows($idD, $this->quan);
        return $result;
    }

    public function get_by_district($idD, $page) {
        $result = $this->get_by_field($idD, $this->quan, $page);
        return $result;
    }

    public function get_category_rows($idC) {
        $result = $this->get_field_rows($idC, $this->chuyenmuc);
        return $result;
    }

    public function get_by_category($idC, $page, $sort = 1) {
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
        $sorts = array(
            1 => array($this->id, 'DESC'),
            2 => array($this->giaphong, 'ASC'),
            3 => array($this->giaphong, 'DESC'),
            4 => array($this->dientich, 'ASC'),
            5 => array($this->dientich, 'DESC')
        );
        $this->db->order_by(MODEL_POST.'.'.$sorts[$sort][0], $sorts[$sort][1]);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_one($id) {
        $this->db->select('*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_WARD.'.tenphuong');
        $this->db->select(MODEL_POST_PRICE.'.tiendien,'.MODEL_POST_PRICE.'.tiennuoc,'.MODEL_POST_PRICE.'.datcoc');
        $this->db->select(MODEL_POST_CONTACT.'.hoten,'.MODEL_POST_CONTACT.'.sodienthoai,'.MODEL_POST_CONTACT.'.diachi,'.MODEL_POST_CONTACT.'.email');
        $this->db->from(MODEL_POST);
        $this->db->where(MODEL_POST.'.'.$this->id, $id);
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan');
        $this->db->join(MODEL_WARD, MODEL_WARD.'.idP = '.MODEL_POST.'.phuong');
        $this->db->join(MODEL_POST_PRICE, MODEL_POST_PRICE.'.idBantin = '.$id, 'left');
        $this->db->join(MODEL_POST_CONTACT, MODEL_POST_CONTACT.'.idBantin = '.$id, 'left');
        $query = $this->db->get();
        $result = $query->result_array();

        $this->db->select(MODEL_POST_CATEGORY.'.bang_phu');
        $this->db->from(MODEL_POST_CATEGORY);
        $this->db->where(MODEL_POST_CATEGORY.'.id', $result[0]['chuyenmuc']);
        $query = $this->db->get();
        $r = $query->result_array();
        $t = $r[0]['bang_phu'];

        $this->db->select($t.'.*');
        $this->db->from($t);
        $this->db->where($t.'.idBantin', $id);
        $query = $this->db->get();
        $r = $query->result_array()[0];
        unset($r['id']);
        unset($r['idBantin']);
        $result[0]['thongtinbosung'] = $r;

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
        $data_mana = array(
            'idUser' => $this->session->userdata(LABEL_LOGIN)['id'],
            'idBantin' => $last_id
        );
        $this->db->insert(MODEL_MANAGE_POST, $data_mana);
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

                if ($this->upload->do_upload($field_name)) {
                    $data['idBantin'] = $id;
                    $fname = $file['name'][$key];
                    $fname = explode('.', $fname);
                    $extension = end($fname);
                    $data['tenhinh'] = $file_name.'.'.$extension;
                    $this->db->insert(MODEL_POST_UPLOAD, $data);
                } /*else {
                    $errors[] = $this->upload->display_errors();
                }*/
            }
        }
    }
    public function register_post($info){
        $this->db->insert('phong_dangky', $info);
    }
    public function update_register_post($info,$idBantin,$idUser){
        $this->db->where('idUser',$idUser);
        $this->db->where('idBantin',$idBantin);
        $this->db->update('phong_dangky', $info);
    }
    public function check_register_post($idUser,$idBantin) {
        $this->db->select('*');
        $this->db->from('phong_dangky');
        $this->db->where('idUser',$idUser);
        $this->db->where('idBantin',$idBantin);
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_register_num($idUser,$idBantin){
        $this->db->select('*');
        $this->db->from('phong_dangky');
        $this->db->where('idUser',$idUser);
        $this->db->where('idBantin',$idBantin);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result['0'];
    }
}