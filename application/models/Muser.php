<?php

class Muser extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	public function check_login($data) {
		$this->db->select('*');
		$this->db->from(MODEL_USER);
		$this->db->where('username',$data['username']);
		$this->db->where('password',$data['password']);
		$query = $this->db->get();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function check_username($username) {
		$this->db->select('username');
		$this->db->from(MODEL_USER);
		$this->db->where('username',$username);		
		$query = $this->db->get();
		if($query -> num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function check_email($email) {
		$this->db->select('email');
		$this->db->from(MODEL_USER);
		$this->db->where('email',$email);		
		$query = $this->db->get();
		if($query -> num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function create_user($data) {
        $last_id = '';
        foreach($data as $table => $info){
        	if($table == 'avatar') {
                $this->upload_avatar($info,$last_id);
            } else {
				$this->db->insert('user',$info);
				$last_id = $this->db->insert_id();
			}
		}
	    return $last_id;
    }

    private function upload_avatar($files,$id) {
        $config['upload_path'] = 'asset/uploads/user';
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
                    $fname = $file['name'][$key];
                    $fname = explode('.', $fname);
                    $extension = end($fname);
                    $data['avatar'] = $file_name.'.'.$extension;
                    $this->db->where('idUser',$id);
					$this->db->update('user',$data);
                } /*else {
                    $errors[] = $this->upload->display_errors();
                }*/
                $file_datas[] = $this->upload->data();
            }
        }
    }
	
	public function get_profile($id) {
		$this->db->select('username');
		$this->db->select('email');
		$this->db->select('name');
		$this->db->select('sex');
		$this->db->select('address');
		$this->db->select('phone');
		$this->db->from(MODEL_USER);
		$this->db->where('idUser',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function update_user($data) {
		$id = $data['id'];
		$this->db->where('id',$id);
		$this->db->update('user',$data);
    }
	
	public function save_captcha($data){
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
	}
	
	public function del_old_captcha($expiration){
		$this->db->where('captcha_time < ', $expiration)->delete('captcha');
	}
	
	public function check_captcha($binds){
		$sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
		$query = $this->db->query($sql, $binds);
		return $query->row();
	}
	

	public function check_password($pass) {
		$idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        $this->db->select(MODEL_USER.'.password');
        $this->db->from(MODEL_USER);
        $this->db->where(MODEL_USER.'.idUser', $idUser);
        $query = $this->db->get();
        $result = $query->row_array();
        if ($pass == $result['password']) {
            return true;
        }
        return false;
	}

	public function change_info($idUser, $data) {
		$this->db->where('idUser', $idUser);
        $this->db->update(MODEL_USER, $data);
	}

	////////////contact////////////
	public function save_contact($data) {
    	$this->db->insert(MODEL_CONTACT, $data);
    }
}
