<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Full_house extends Post_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index($id) {
		$f = $this->mpost->get_one($id);
        $data['view'] = 'post/index_base';
        $data['content']['content'] = $f;
        $data['content']['additional'] = 'post/index_full_house';
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
        $data['content']['additional'] = 'post/full_house_form';
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
                    MODEL_POST_FULL_HOUSE => array(
                        'anninh' => $this->input->post('security'),
                        'solau' => $this->input->post('floor'),
                        'sophong' => $this->input->post('all-room'),
                        'phongngu' => $this->input->post('bed-room'),
                        'nhavesinh' => $this->input->post('rest-room'),
                        'xebuyt' => $this->input->post('bus')
                    )
                );
                $info = $main_info + $sub_info;
                $id = $this->mpost->create($info);
                redirect('tin-'.$id,'refresh');
            }
        }
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