<?php

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','file'));
        $this->load->database();
        $this->load->model(array('mward','mmarket_category','muser'));
    }

    public function get_ward() {
        $id = $this->input->post('q');
        $data = $this->mward->get_by_district($id);
        foreach($data as $row) {
            $result[$row['idP']] = $row['tenphuong'];
        }
        exit(json_encode($result));
    }

    public function change_avatar() {
        if ($this->session->userdata(LABEL_LOGIN)) {
            $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
            $avatar_name = $this->session->userdata(LABEL_LOGIN)['avatar'];
            unlink('asset/uploads/user/'.$avatar);
            $config['upload_path'] = 'asset/uploads/user';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '1024';
            $this->load->library('upload');
            foreach ($_FILES as $key => $file)
            {
                $field_name = 'avatar';
                $_FILES[$field_name]['name'] = $file['name'];
                $_FILES[$field_name]['type'] = $file['type'];
                $_FILES[$field_name]['tmp_name'] = $file['tmp_name'];
                $_FILES[$field_name]['error'] = $file['error'];
                $_FILES[$field_name]['size'] = $file['size'];

                $file_name = uniqid($idUser.'_');
                $config['file_name'] = $file_name;
                $this->upload->initialize($config);

                if ($this->upload->do_upload($field_name)) {
                    $fname = $file['name'];
                    $fname = explode('.', $fname);
                    $extension = end($fname);
                    $tenhinh = $file_name.'.'.$extension;
                    $data = array('avatar'=>$tenhinh);
                    $this->db->where('idUser', $idUser);
                    $this->db->update(MODEL_USER, $data);
                    $this->session->userdata(LABEL_LOGIN)['avatar'] = $tenhinh;
                }
            }
            
            exit(true);
        }
    }

    public function get_adCate() {
        $id = $this->input->post('q');
        $data = $this->mmarket_category->get_sub_category($id);
        foreach($data as $row) {
            $result[$row['id']] = $row['tenloai'];
        }
        exit(json_encode($result));
    }
}