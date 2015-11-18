<?php
 class Msearch extends CI_Model {
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

    public function get_data_from_search($key_word,$page=1) {
    	$this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        $this->db->where("hethan>=", date('Y-m-d'));
        $this->db->like('tieude', $key_word); 
        $this->db->or_like('noidung', $key_word);
		// WHERE tieude LIKE '%$key_word%' OR noidung LIKE '%$key_word%'
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan', 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.id', 'left');
        $this->db->limit(POSTS_PER_PAGE, POSTS_PER_PAGE*($page-1));
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        $this->db->order_by(MODEL_POST.'.'.$this->id, 'DESC');
        $query = $this->db->get();
        $data['all_rows'] = $query->num_rows();
    	if($query) {
    	 	return $query->result_array();

		}
			else
				return false;
    }

    public function get_all_rows_from_search($key_word){
    	$this->db->select(MODEL_POST.'.*');
        $this->db->select(MODEL_DISTRICT.'.tenquan');
        $this->db->select(MODEL_POST_UPLOAD.'.tenhinh');
        $this->db->from(MODEL_POST);
        $this->db->where("hethan>=", date('Y-m-d'));
        $this->db->like('tieude', $key_word); 
        $this->db->or_like('noidung', $key_word);
		// WHERE tieude LIKE '%$key_word%' OR noidung LIKE '%$key_word%'
        $this->db->join(MODEL_DISTRICT, MODEL_DISTRICT.'.idQ = '.MODEL_POST.'.quan', 'left');
        $this->db->join(MODEL_POST_UPLOAD, MODEL_POST_UPLOAD.'.idBantin = '.MODEL_POST.'.id', 'left');
        $this->db->group_by(MODEL_POST.'.'.$this->id);
        $this->db->order_by(MODEL_POST.'.'.$this->id, 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

 }

 ?>