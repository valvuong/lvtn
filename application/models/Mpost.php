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
    private $khoangcach = 'khoangcach';

    public function __construct() {
        parent::__construct();
    }

    ////////////////////////////////////////////////////////////////
    public function get_all_rows() {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_POST.' WHERE '.$this->hethan.' >= NOW()');
        $result = $query->row_array();
        return $result['total'];
    }


    public function get_all($page = null, $sort = null, $field = null) {
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        if ($page != null && $sort != null && $field != null) {
            $this->db->where(MODEL_POST.'.'.$this->hethan.' >=', date('Y-m-d'));
        }
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.'.$this->quan, 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.'.$this->id, 'left');
        if ($page != null) {
            $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        }
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        if ($field != null && $sort != null) {
            $this->db->order_by(MODEL_POST.'.'.$field, $sort);
        } else {
            $this->db->order_by(MODEL_POST.'.'.$this->id, 'DESC');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    private function get_field_rows($id, $field_name) {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_POST.' WHERE '.$field_name.' = '.$id.' AND '.$this->hethan.' >= NOW()');
        $result = $query->row_array();
        return $result['total'];
    }

    private function get_by_field($id, $field_name, $page, $sort) {
        $this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        $this->db->where(MODEL_POST.'.'.$field_name, $id);
        $this->db->where(MODEL_POST.'.'.$this->hethan.' >=', date('Y-m-d'));
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.'.$this->quan, 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.'.$this->id, 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        $sorts = array(
            1 => array($this->id, 'DESC'),
            2 => array($this->giaphong, 'ASC'),
            3 => array($this->giaphong, 'DESC'),
            4 => array($this->dientich, 'ASC'),
            5 => array($this->dientich, 'DESC'),
            6 => array($this->khoangcach, 'ASC'),
            7 => array($this->khoangcach, 'DESC')
        );
        $this->db->order_by(MODEL_POST.'.'.$sorts[$sort][0], $sorts[$sort][1]);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_district_rows($idD) {
        $result = $this->get_field_rows($idD, $this->quan);
        return $result;
    }

    public function get_by_district($idD, $page, $sort=1) {
        $result = $this->get_by_field($idD, $this->quan, $page, $sort);
        return $result;
    }

    public function get_category_rows($idC) {
        $result = $this->get_field_rows($idC, $this->chuyenmuc);
        return $result;
    }

    public function get_by_category($idC, $page, $sort = 1) {
        $result = $this->get_by_field($idC, $this->chuyenmuc, $page, $sort);
        return $result;
    }

    public function get_one_by_subtable($subtable, $id) {
        $this->db->select($subtable.'.*');
        $this->db->from($subtable);
        $this->db->where($subtable.'.idBantin', $id);
        $query = $this->db->get();
        return $query->row_array();
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
        $result = $query->row_array();

        $r = $this->mpost_category->get_subtable($result['chuyenmuc']);
        $t = $r['bang_phu'];

        $r = $this->get_one_by_subtable($t, $id);
        unset($r['id']);
        unset($r['idBantin']);
        $result['thongtinbosung'] = $r;

        $result['reservation'] = $this->get_reservation($id);
        $result['tenhinh'] = $this->get_images($id);

        return $result;
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
    ///////////search///////////////////////////

    public function get_search_room_by_select_rows($category, $district, $area, $price,$distance) {
        if ($area < 10000) {
            $min_area = (int)($area / 100);
            $max_area = $area % 100;
        }
        else if ($area > 10000) {
            $min_area = (int)($area / 1000);
            $max_area = $area % 1000;
        }
        if ($price < 100) {
            $min_price = (int)($price / 10);
            $max_price = $price % 10;
        }
        else if ($price > 100) {
            $min_price = (int)($price / 100);
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
            $min_area = (int)($area / 100);
            $max_area = $area % 100;
        }
        else if ($area > 10000) {
            $min_area = (int)($area / 1000);
            $max_area = $area % 1000;
        }
        if ($price < 100) {
            $min_price = (int)($price / 10);
            $max_price = $price % 10;
        }
        else if ($price > 100) {
            $min_price = (int)($price / 100);
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
        $result['result'] = $query->result_array();

        $this->db->select('tenquan');
        $this->db->from(MODEL_DISTRICT);
        $this->db->where('idQ', $district);
        $query = $this->db->get();
        $d = $query->row_array();
        $result['search_district'] = $d['tenquan'];

        $this->db->select('ten');
        $this->db->from(MODEL_POST_CATEGORY);
        $this->db->where('id', $category);
        $query = $this->db->get();
        $d = $query->row_array();
        $result['search_category'] = $d['ten'];

        $this->db->select('text');
        $this->db->from(SEARCH_AREA);
        $this->db->where('value', $area);
        $query = $this->db->get();
        $d = $query->row_array();
        $result['search_area'] = $d['text'];

        $this->db->select('text');
        $this->db->from(SEARCH_PRICE);
        $this->db->where('value', $price);
        $query = $this->db->get();
        $d = $query->row_array();
        $result['search_price'] = $d['text'];

        if ($distance == '0002') $result['search_distance'] = '<2km';

        else if ($distance == '0205') $result['search_distance'] = '2-5km';
        else if ($distance == '0599') $result['search_distance'] = '>5km';
        else $result['search_distance'] = '';
        return $result;
    }


    public function get_num_every_district($idD) {
        $query = $this->db->query('SELECT COUNT(*) as total FROM '.MODEL_POST.' WHERE quan= '.$idD.' AND '.$this->hethan.' >= NOW()');
        $result = $query->row_array();
        return $result['total'];
    }
    public function get_by_id($id) {
        $t = MODEL_POST;
        $this->db->select($t.'.id');
        $this->db->select($t.'.tieude');
        $this->db->from($t);
        $this->db->where($t.'.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_previous_post($id) {
        $t = MODEL_POST;
        $this->db->select($t.'.id');
        $this->db->from($t);
        $this->db->where(array('id <' => $id, 'hethan >=' => date('Y-m-d')));
        $this->db->limit(1);
        $this->db->order_by($t.'.id', 'DESC');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_next_post($id) {
        $t = MODEL_POST;
        $this->db->select($t.'.id');
        $this->db->from($t);
        $this->db->where(array('id >' => $id, 'hethan >=' => date('Y-m-d')));
        $this->db->limit(1);
        $this->db->order_by($t.'.id', 'ASC');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_category($id) {
        $t = MODEL_POST;
        $this->db->select($t.'.chuyenmuc');
        $this->db->from($t);
        $this->db->where($t.'.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['chuyenmuc'];
    }

    public function delete_post($id) {
        $this->db->delete(MODEL_POST, array('id' => $id)); 
    }

    public function get_images($id) {
        $t = MODEL_POST_UPLOAD;
        $this->db->select($t.'.tenhinh');
        $this->db->from($t);
        $this->db->where($t.'.idBantin', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_reservation($id) {
        $this->db->select(MODEL_RESERVATION_ROOM.'.*');
        $this->db->from(MODEL_RESERVATION_ROOM);
        $this->db->where(MODEL_RESERVATION_ROOM.'.idBantin',$id);
        $query = $this->db->get();
        return $query->result_array();
    }
}