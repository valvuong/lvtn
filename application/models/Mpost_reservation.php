<?php

class Mpost_reservation extends CI_Model {

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

    private $table;

    public function __construct() {
        parent::__construct();
        $this->table = MODEL_RESERVATION_ROOM;
    }

    ///////////reservation/////////////////////
    public function create_reservation_post($info){
        $this->db->insert($this->table, $info);
    }
    public function update_reservation_post($info,$idBantin,$idUser){
        $this->db->where('idUser',$idUser);
        $this->db->where('idBantin',$idBantin);
        $this->db->update($this->table, $info);
    }
    public function check_reservation_post($idUser,$idBantin) {
        $this->db->select('*');
        $this->db->from($this->table);
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
    public function check_reservation_freeroom($idBantin) {
        $room = 0;
        $this->db->select('sophong');
        $this->db->from($this->table);
        $this->db->where('idBantin',$idBantin);
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $room += intval($value['sophong']);
        }
        return $room;
    }
    public function check_reservation_freepeople($idBantin) {
        $people = 0;
        $this->db->select('songuoi');
        $this->db->from($this->table);
        $this->db->where('idBantin',$idBantin);
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $people += intval($value['songuoi']);
        }
        return $people;
    }
    public function check_reservation_free($idBantin) {
        $this->db->select('songuoi');
        $this->db->select('sophong');
        $this->db->from(MODEL_POST);
        $this->db->where('id',$idBantin);
        $query = $this->db->get();
        $result = $query->row_array();
        if ($result['songuoi'] > $this->check_reservation_freepeople($idBantin) && $result['sophong'] > $this->check_reservation_freeroom($idBantin)) {
            return true;
        }
        else return false;
    }
//edit reservation
    public function get_reservation_num($idUser,$idBantin){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('idUser',$idUser);
        $this->db->where('idBantin',$idBantin);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result['0'];
    }


    public function get_posts_by_user($idUser) {
        $t = $this->table;
        $this->db->select($t.'.idBantin');
        $this->db->from($t);
        $this->db->where($t.'.idUser', $idUser);
        $this->db->order_by($t.'.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_reservation_post($idUser,$idBantin){
        $this->db->where('idUser',$idUser);
        $this->db->where('idBantin',$idBantin);
        $this->db->delete($this->table);
    }
//manage post reservation
    public function get_all($idUser){
        $this->db->select(MODEL_RESERVATION_ROOM.'.*');
        $this->db->select(MODEL_POST.'.tieude');
        $this->db->from($this->table);
        $this->db->where('idUser',$idUser);
        $this->db->join(MODEL_POST, MODEL_POST.'.id = '.MODEL_RESERVATION_ROOM.'.idBantin', 'left');
        $this->db->group_by(MODEL_RESERVATION_ROOM.'.idBantin');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
//show all reserve
    public function show_all($idBantin){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('idBantin',$idBantin);
        $query = $this->db->get();
        return $query->result_array();
    }
}

