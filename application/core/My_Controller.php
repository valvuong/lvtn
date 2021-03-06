<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mpost'));
    }

    protected function set_form_rules() {
        $rules = array(
            array(
                'field' => 'title',
                'rules' => 'required'
            ),
            array(
                'field' => 'area',
                'rules' => 'required|numeric|min_length[1]|greater_than[0]'
            ),
            array(
                'field' => 'price',
                'rules' => 'required|numeric|min_length[1]|greater_than[0]'
            ),
            array(
                'field' => 'expired_date',
                'rules' => 'required|callback_match_date'
            ),
            array(
                'field' => 'content_post',
                'rules' => 'required'
            ),
            array(
                'field' => 'name_contact',
                'rules' => 'required'
            ),
            array(
                'field' => 'phone',
                'rules' => 'required'
            ),
            array(
                'field' => 'address',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'rules' => 'valid_email'
            ),
            array(
                'field' => 'mon_re',
                'rules' => 'is_natural'
            ),
            array(
                'field' => 'lng',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'lat',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'distant',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'limit-people',
                'rules' => 'required|is_natural'
            ),
            array(
                'field' => 'limit-room',
                'rules' => 'required|is_natural'
            )
        );
        return $rules;
    }

    protected function get_main_input($c) {
        $info = array(
            MODEL_POST => array(
                'tieude'     => $this->input->post('title'),
                'quan'       => $this->input->post('district'),
                'phuong'     => $this->input->post('ward'),
                'chuyenmuc'  => $c,
                'giaphong'   => $this->input->post('price'),
                'dientich'   => $this->input->post('area'),
                'noidung'    => $this->input->post('content_post'),
                'ngaydang'   => date('Y-m-d'),
                'hethan'     => date('Y-m-d', strtotime($this->input->post('expired_date'))),
                'kinhdo'     => $this->input->post('lat'),
                'vido'       => $this->input->post('lng'),
                'khoangcach' => $this->input->post('distant'),
                'sophong'    => $this->input->post('limit-room'),
                'songuoi'    => $this->input->post('limit-people')
            ),
            MODEL_POST_PRICE => array(
                'tiendien' => $this->input->post('e_price')===NULL ? 0:1,
                'tiennuoc' => $this->input->post('w_price')===NULL ? 0:1,
                'datcoc'   => $this->input->post('pre_pay')===NULL ? 0:$this->input->post('mon_re')
            ),
            MODEL_POST_CONTACT => array(
                'hoten'       => $this->input->post('name_contact'),
                'sodienthoai' => $this->input->post('phone'),
                'diachi'      => $this->input->post('address'),
                'email'       => $this->input->post('email')
            ),
            ACTION_POST_UPLOAD => $_FILES,
        );
        return $info;
    }

    public function match_date($date) {
        return (bool)preg_match('/^(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}$/', $date);
    }

    protected function gmap() {
        $this->load->library('googlemaps');
        $config['center'] = 'auto';
        $config['onclick'] = '
                if (markers_map) {
                    for (i in markers_map) {
                        markers_map[i].setMap(null);
                    }
                    markers_map.length = 0;
                }
                var marker = new google.maps.Marker({
                    map:       map,
                    position:  event.latLng
                }); 
                markers_map.push(marker);
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();

                var p1 = new google.maps.LatLng(10.772223670808806, 106.65842771530151 );//bach khoa
                var p2 = new google.maps.LatLng(lat, lng);

                $(\'#distant\').val((google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2));
                $(\'#lat\').val(lat);
                $(\'#lng\').val(lng);
                ';
        
        $config['zoom'] = 'auto';
        $this->googlemaps->initialize($config);
        
        return $this->googlemaps->create_map();
    }

    protected function index_gmap($lng,$lat) {
        $this->load->library('googlemaps');
        $config['center'] = $lng.','.$lat;
        $config['directions'] = 'true';
        $config['directionsStart'] = '10.772223670808806, 106.65842771530151';
        $config['directionsEnd'] = $lng.','.$lat;
        $this->googlemaps->initialize($config);

        return $this->googlemaps->create_map();
    }
}