<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basement extends Post_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index($id) {
		$f = $this->mpost->get_one($id);

        ///////////gmap///////////////       
        $data['content']['map'] = $this->index_gmap($f['kinhdo'],$f['vido']);
        //////////////////gmap///////////////

        $data['view'] = 'post/index_base';
        $data['content']['content'] = $f;
        $data['content']['additional'] = 'post/index_basement';
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
        $data['content']['additional'] = 'post/basement_form';
        $data['left_hidden'] = true;
        $this->load->library('form_validation');
        $main_rules = $this->set_form_rules();
        $rent_room_rules = array();

        $rules = array_merge($main_rules, $rent_room_rules);

        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $main_info = $this->get_main_input(5);
                $sub_info = array(
                    MODEL_POST_BASEMENT => array(
                        'anninh' => $this->input->post('security'),
                        'giogiac' => $this->input->post('time-off'),
                        'nhavesinh' => $this->input->post('rest-room'),
                        'amthap' => $this->input->post('amthap'),
                        'tiennghi' => $this->input->post('other-services'),
                        'xebuyt' => $this->input->post('bus')

                    )
                );
                $info = $main_info + $sub_info;
                $id = $this->mpost->create($info);
                redirect('tin-'.$id,'refresh');
            }
        }
		///////////gmap///////////////
        $data['content']['map'] = $this->gmap();
        ///////////gmap///////////////

        $this->load->view(LAYOUT, $data);
    }
}