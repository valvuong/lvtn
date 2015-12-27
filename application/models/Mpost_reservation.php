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
    public function delete_reservation_post($idUser,$idBantin){
        $this->db->where('idUser',$idUser);
        $this->db->where('idBantin',$idBantin);
        $this->db->delete($this->table);
    }
//manage post reservation
    public function get_all($idUser){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('idUser',$idUser);
        $query = $this->db->get();
        return $query->result_array();
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

