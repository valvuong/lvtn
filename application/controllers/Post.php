<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mpost'));
    }

    public function index($id) {
        $f = $this->mpost->get_one($id);
        $data['view'] = 'post/index';
        $data['content']['content'] = $f;
        $data['left_hidden'] = true;
        $data['title'] = $f['tieude'];
        $this->load->view(LAYOUT, $data);
    }

    private function set_form_rules() {
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
            )
        );
        return $rules;
    }

    private function get_main_input() {
        $info = array(
            MODEL_POST => array(
                'tieude' => $this->input->post('title'),
                'quan' => $this->input->post('district'),
                'phuong' => $this->input->post('ward'),
                'chuyenmuc' => 2,
                'giaphong' => $this->input->post('price'),
                'dientich' => $this->input->post('area'),
                'noidung' => $this->input->post('content_post'),
                'ngaydang' => date('Y-m-d'),
                'hethan' => date('Y-m-d',strtotime($this->input->post('expired_date'))),
                'kinhdo' => $this->input->post('lat'),
                'vido' => $this->input->post('lng')
            ),
            MODEL_POST_PRICE => array(
                'tiendien' => $this->input->post('e_price')===NULL ? 0:1,
                'tiennuoc' => $this->input->post('w_price')===NULL ? 0:1,
                'datcoc'   => $this->input->post('pre_pay')===NULL ? 0:$this->input->post('mon_re')
            ),
            MODEL_POST_CONTACT => array(
                'hoten' => $this->input->post('name_contact'),
                'sodienthoai' => $this->input->post('phone'),
                'diachi' => $this->input->post('address'),
                'email' => $this->input->post('email')
            ),
            ACTION_POST_UPLOAD => $_FILES,
        );
        return $info;
    }

    public function rent_room() {
        $data['view'] = 'post/rent_room';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;
        $this->load->library('form_validation');
        $main_rules = $this->set_form_rules();
        $rent_room_rules = array();

        $rules = array_merge($main_rules, $rent_room_rules);

        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $main_info = $this->get_main_input();
                $sub_info = array(
                    MODEL_POST_RENTROOM => array(
                        'anninh' => $this->input->post('security'),
                        'naunuong' => $this->input->post('cook')===NULL ? 0:1,
                        'chungchu' => $this->input->post('with-host')===NULL ? 0:1,
                        'giogiac' => $this->input->post('time-off'),
                        'nhavesinh' => $this->input->post('wc')===NULL ? 0:1,
                        'xebuyt' => $this->input->post('bus'),
                        'khoangcach' => 0,
                        'bancong' => $this->input->post('balcony')===NULL ? 0:1,
                        'chodexe' => $this->input->post('parking')===NULL ? 0:$this->input->post('parking-limit'),
                        'soluong' => $this->input->post('limit'),
                        'chicho' => $this->input->post('gender-only')===NULL ? "":$this->input->post('gender-only')
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

    public function match_date($date) {
        return (bool)preg_match('/^(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}$/', $date);
    }

    public function join() {
        $data['view'] = 'post/join';
        $data['content']['content'] = '';
        $data['content']['title'] = 'ĐĂNG TIN Ở GHÉP';
        $data['left_hidden'] = true;
        $this->load->library('form_validation');
        $main_rules = $this->set_form_rules();
        $rent_room_rules = array();

        $rules = array_merge($main_rules, $rent_room_rules);

        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $main_info = $this->get_main_input();
                $sub_info = array(
                    MODEL_POST_JOIN => array(
                        'anninh' => $this->input->post('security'),
                        'naunuong' => $this->input->post('cook')===NULL ? 0:1,
                        'chungchu' => $this->input->post('with-host')===NULL ? 0:1,
                        'giogiac' => $this->input->post('time-off'),
                        'nhavesinh' => $this->input->post('wc')===NULL ? 0:1,
                        'xebuyt' => $this->input->post('bus'),
                        'khoangcach' => 0,
                        'bancong' => $this->input->post('balcony')===NULL ? 0:1,
                        'chodexe' => $this->input->post('parking')===NULL ? 0:$this->input->post('parking-limit'),
                        'daco' => $this->input->post('available-nums'),
                        'nu' => $this->input->post('female-need'),
                        'nam' => $this->input->post('male-need')
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

    public function show_by_district($page=1, $idD) {
        $data['view'] = 'home';
        $data['content']['content'] = $this->mpost->get_by_district($idD, $page);
        $this->load->view(LAYOUT, $data);
    }

    public function show_by_category($page=1, $idC) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['content']['content'] = $this->mpost->get_by_category($idC, $page);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $idC);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_category_rows($idC);
        $data['content']['url_alias'] = 'tin-vat-';
        $this->load->view(LAYOUT, $data);
    }
}