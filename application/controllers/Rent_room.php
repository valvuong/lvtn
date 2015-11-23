<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rent_room extends Post_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index($id) {
		$f = $this->mpost->get_one($id);
        $data['view'] = 'post/index_base';
        $data['content']['content'] = $f;
        $data['content']['additional'] = 'post/index_rent_room';
        $data['left_hidden'] = true;
        $data['title'] = $f['tieude'];
        $this->load->view(LAYOUT, $data);
	}

	public function create() {
        $data['view'] = 'post/base_form';
        $data['content']['content'] = '';
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content']['action'] = $class_name.'/'.$method_name;
        $data['content']['additional'] = 'post/rent_room_form';
        $data['left_hidden'] = true;
        $this->load->library('form_validation');
        $main_rules = $this->set_form_rules();
        $rent_room_rules = array();

        $rules = array_merge($main_rules, $rent_room_rules);

        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $main_info = $this->get_main_input(1);
                $sub_info = array(
                    MODEL_POST_RENTROOM => array(
                        'anninh' => $this->input->post('security'),
                        'naunuong' => $this->input->post('cook')===NULL ? "":"Cho Nấu Nướng",
                        'chungchu' => $this->input->post('with-host')===NULL ? "":"Ở Chung Với Chủ",
                        'giogiac' => $this->input->post('time-off'),
                        'nhavesinh' => $this->input->post('wc')===NULL ? "":"Có Nhà Vệ Riêng",
                        'xebuyt' => $this->input->post('bus'),
                        'khoangcach' => 0,
                        'bancong' => $this->input->post('balcony')===NULL ? "":"Có Ban Công",
                        'chodexe' => $this->input->post('parking')===NULL ? 0:$this->input->post('parking-limit'),
                        'soluong' => $this->input->post('limit'),
                        'chicho' => $this->input->post('gender-only')===NULL ? "":$this->input->post('gender-only')
                    )
                );
                $info = $main_info + $sub_info;
                $id = $this->mpost->create($info);
                // redirect('tin-'.$id,'refresh');
            }
        }//var_dump($_FILES);
		///////////gmap///////////////
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
				$(\'#lat\').val(lat);
				$(\'#lng\').val(lng);
				';
		
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);
		
		$data['content']['map'] = $this->googlemaps->create_map();
		//////////////////gmap///////////////

        $this->load->view(LAYOUT, $data);
    }
}