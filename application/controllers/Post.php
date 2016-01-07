<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->muser->not_authenticated();
        $this->load->helper(array('form'));
        $this->load->model(array('mpost_reservation','mmanage_post'));
    }

    public function index($id) {
        $idCate = $this->mpost->get_category($id);
        $result = $this->mpost_category->get_one($idCate);
        
        $url = 'post/index_'.$result['link'].'/'.$id;
        redirect($url, 'refresh');
    }

    public function get_all($page=1) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['left_view'] = 'layout/left';
        $data['left_content'] = '';
        $data['right_view'] = 'layout/right';
        $data['right_content'] = '';
        switch ($this->input->cookie(COOKIE_POST_SORT)) {
            case 0:
            case 1:
                $sort = 'DESC';
                $field = 'id';
                break;
            case 2:
                $sort = 'ASC';
                $field = 'giaphong';
                break;
            case 3:
                $sort = 'DESC';
                $field = 'giaphong';
                break;
            case 4:
                $sort = 'ASC';
                $field = 'dientich';
                break;
            case 5:
                $sort = 'DESC';
                $field = 'dientich';
                break;
            case 6:
                $sort = 'ASC';
                $field = 'khoangcach';
                break;
            case 7:
                $sort = 'DESC';
                $field = 'khoangcach';
                break;
        }
        $data['content']['content'] = $this->mpost->get_all($page, $sort, $field);
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_all_rows();
        $data['content']['url_alias'] = 'home/';
        $data['content']['url_alias_extend'] = '';
        $this->load->view(LAYOUT, $data);
    }

    public function show_by_district($page=1, $idD, $sort = 1) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['left_view'] = 'layout/left';
        $data['left_content'] = '';
        $data['right_view'] = 'layout/right';
        $data['right_content'] = '';
        $data['content']['content'] = $this->mpost->get_by_district($idD, $page, $sort);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $idD);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_district_rows($idD);
        $segment_1 = $this->uri->segment(1);
        $segment_2 = $this->uri->segment(2);
        $url_alias = $segment_1;
        if ($segment_2 != NULL && !is_numeric($segment_2)) {
            $url_alias .= '/'.$segment_2;
        }
        $data['content']['url_alias'] = $url_alias.'/';
        $data['content']['url_sort'] = $segment_1;
        $data['content']['url_alias_extend'] = '';
        $this->load->view(LAYOUT, $data);
    }
    
    public function show_by_category($page=1, $idC, $sort = 1) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['left_view'] = 'layout/left';
        $data['left_content'] = '';
        $data['right_view'] = 'layout/right';
        $data['right_content'] = '';
        $data['content']['content'] = $this->mpost->get_by_category($idC, $page, $sort);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $idC);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_category_rows($idC);
        switch ($sort) {
            case 1:
                $url_alias = 'loai-'.$idC.'-';
                break;
            case 2:
                $url_alias = 'loai-'.$idC.'-gia-tang-';
                break;
            case 3:
                $url_alias = 'loai-'.$idC.'-gia-giam-';
                break;
            case 4:
                $url_alias = 'loai-'.$idC.'-dientich-tang-';
                break;
            case 5:
                $url_alias = 'loai-'.$idC.'-dientich-giam-';
                break;
            case 6:
                $url_alias = 'loai-'.$idC.'-khoangcach-tang-';
                break;
            case 7:
                $url_alias = 'loai-'.$idC.'-khoangcach-giam-';
                break;
        }
        $data['content']['url_alias'] = $url_alias;
        $data['content']['url_alias_extend'] = '';
        $data['content']['url_sort'] = 'loai-'.$idC.'-';
        $this->load->view(LAYOUT, $data);
    }

    public function create_reservation_post() {
            $info = array(
                'idBantin'=> $this->input->get_post('idBantin'),
                'idUser' => $this->session->userdata(LABEL_LOGIN)['id'],
                'sophong' => $this->input->get_post('reservation-nums-room'),
                'songuoi' => $this->input->get_post('reservation-nums-people'),
                'ten' => $this->input->get_post('reservation-name'),
                'sodienthoai' => $this->input->get_post('reservation-phone'),
                'email' => $this->input->get_post('reservation-email')
            );
            $this->mpost_reservation->create_reservation_post($info);
    }

    public function update_reservation_post() {
        $idBantin =  $this->input->get_post('idBantin');
        $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        $info = array(
            'sophong' => $this->input->get_post('update-reservation-nums-room'),
            'songuoi' => $this->input->get_post('update-reservation-nums-people'),
            'ten' => $this->input->get_post('update-reservation-name'),
            'sodienthoai' => $this->input->get_post('update-reservation-phone'),
            'email' => $this->input->get_post('update-reservation-email')
        );
        $this->mpost_reservation->update_reservation_post($info,$idBantin,$idUser);
    }
// check if this user reserves or not
    public function check_reservation_post() {
        $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        return $this->mpost_reservation->check_reservation_post($idUser);
    }
    public function check_reservation_free(){
        $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        return $this->mpost_reservation->check_reservation_free($idUser);
    }
    public function delete_reservation_post() {
        $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        $idBantin = $this->input->get_post('idBantin');
        $this->mpost_reservation->delete_reservation_post($idUser,$idBantin);
    }
//
    public function show_all_reservation_post() {
        $idBantin = $this->input->get_post('idBantin');
        return $this->mpost_reservation->show_all($idBantin);
    }

    
    

    public function search_by_select_post($page=1) {
        $search_category = $this->input->get_post('search-category');
        $search_district = $this->input->get_post('search-district');
        $search_area = $this->input->get_post('search-area');
        $search_price = $this->input->get_post('search-price');
        $search_distance = $this->input->get_post('search-distance');


        $result     =   $this->mpost->get_search_room_by_select_content(
                            $search_category,$search_district,$search_area,$search_price,$search_distance,$page);
        $num_rows   = $this->mpost->get_search_room_by_select_rows(
                            $search_category,$search_district,$search_area,$search_price,$search_distance);

        if ($result != false) {

        }
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['content']['content'] = $result['result'];
        $data['left_view'] = 'layout/left';
        $data['content']['search_category'] = $result['search_category'];
        $data['content']['search_district'] = $result['search_district'];
        $data['content']['search_area'] = $result['search_area'];
        $data['content']['search_price'] = $result['search_price'];
        $data['content']['search_distance'] = $result['search_distance'];
        $data['right_view'] = 'layout/right';
        $data['right_content']['content'] = '';
        $data['left_content']['content'] = '';
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $num_rows;
        $data['content']['url_alias'] = 'post/Search_by_select_post/';
        $data['content']['url_alias_extend'] = '?search-category='.$search_category.'&search-district='.$search_district.'&search-area='.$search_area.
        '&search-price='.$search_price.'&search-distance='.$search_distance;
        $data['content']['url_sort'] = 'loai-';
        $this->load->view(LAYOUT, $data);
    }

    
    /////////rent_room
    public function index_rent_room($id) {
        $f = $this->mpost->get_one($id);

        ///////////gmap///////////////       
        $data['content']['map'] = $this->index_gmap($f['kinhdo'],$f['vido']);
        //////////////////gmap///////////////
        
        $data['view'] = 'post/index_base';
        $data['content']['content'] = $f;
        $data['content']['additional'] = 'post/index_rent_room';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $data['title'] = $f['tieude'];
        $this->load->view(LAYOUT, $data);
    }

    public function create_rent_room() {
        $this->muser->if_locked();
        $data['view'] = 'post/base_form';
        $data['content']['content'] = '';
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content']['action'] = $class_name.'/'.$method_name;
        $data['content']['additional'] = 'post/rent_room_form';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
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
                        'bancong' => $this->input->post('balcony')===NULL ? "":"Có Ban Công",
                        'chodexe' => $this->input->post('parking')===NULL ? 0:"Có Chỗ Để Xe",
                        'chicho' => $this->input->post('gender-only')===NULL ? "":$this->input->post('gender-only')
                    )
                );
                $info = $main_info + $sub_info;
                $id = $this->mpost->create($info);
                $this->insert_manage($id);
                redirect('tin-'.$id,'refresh');
            }
        }
        ///////////gmap///////////////
        $data['content']['map'] = $this->gmap();
        ///////////gmap///////////////

        $this->load->view(LAYOUT, $data);
    }
    ///////join///////////
    public function index_join($id) {
        $f = $this->mpost->get_one($id);
        $data['view'] = 'post/index_base';
        $data['content']['content'] = $f;
        $data['content']['additional'] = 'post/index_join_room';
        $data['content']['map'] = $this->index_gmap($f['kinhdo'],$f['vido']);
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $data['title'] = $f['tieude'];
        $this->load->view(LAYOUT, $data);
    }

    public function create_join() {
        $this->muser->if_locked();
        $data['view'] = 'post/base_form';
        $data['content']['content'] = '';
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content']['action'] = $class_name.'/'.$method_name;
        $data['content']['additional'] = 'post/join_form';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $this->load->library('form_validation');
        $main_rules = $this->set_form_rules();
        $join_rules = array();

        $rules = array_merge($main_rules, $join_rules);

        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $main_info = $this->get_main_input(2);
                $sub_info = array(
                    MODEL_POST_JOIN => array(
                        'anninh' => $this->input->post('security'),
                        'naunuong' => $this->input->post('cook')===NULL ? "":"Cho Nấu Nướng",
                        'chungchu' => $this->input->post('with-host')===NULL ? "":"Ở Chung Với Chủ",
                        'giogiac' => $this->input->post('time-off'),
                        'nhavesinh' => $this->input->post('wc')===NULL ? "":"Có Nhà Vệ Riêng",
                        'xebuyt' => $this->input->post('bus'),
                        'bancong' => $this->input->post('balcony')===NULL ? "":"Có Ban Công",
                        'chodexe' => $this->input->post('parking')===NULL ? 0:"Có Chỗ Để Xe",//$this->input->post('parking-limit'),
                        'daco' => $this->input->post('available-nums'),
                        'nu' => $this->input->post('female-need'),
                        'nam' => $this->input->post('male-need')
                    )
                );
                $info = $main_info + $sub_info;
                $id = $this->mpost->create($info);
                $this->insert_manage($id);
                redirect('tin-'.$id,'refresh');
            }
        }
        ///////////gmap///////////////
        $data['content']['map'] = $this->gmap();
        //////////////////gmap///////////////

        $this->load->view(LAYOUT, $data);
    }

    ///////////apartment///////////////
    public function index_apartment($id) {
        $f = $this->mpost->get_one($id);

        ///////////gmap///////////////       
        $data['content']['map'] = $this->index_gmap($f['kinhdo'],$f['vido']);
        //////////////////gmap///////////////

        $data['view'] = 'post/index_base';
        $data['content']['content'] = $f;
        $data['content']['additional'] = 'post/index_apartment';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $data['title'] = $f['tieude'];
        $this->load->view(LAYOUT, $data);
    }

    public function create_apartment() {
        $this->muser->if_locked();
        $data['view'] = 'post/base_form';
        $data['content']['content'] = '';
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content']['action'] = $class_name.'/'.$method_name;
        $data['content']['additional'] = 'post/apartment_form';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $this->load->library('form_validation');
        $main_rules = $this->set_form_rules();
        $rent_room_rules = array();

        $rules = array_merge($main_rules, $rent_room_rules);

        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $main_info = $this->get_main_input(3);
                $sub_info = array(
                    MODEL_POST_APARTMENT => array(
                        'anninh' => $this->input->post('security'),
                        'giogiac' => $this->input->post('time-off'),
                        'giatui' => $this->input->post('laundry')===NULL ? 0:1,
                        'thangmay' => $this->input->post('lift')===NULL ? 0:1,
                        'sotang' => $this->input->post('floor'),
                        'phongngu' => $this->input->post('bed-room'),
                        'controng' => $this->input->post('free-room'),
                        'tiennghi' => $this->input->post('other-services'),
                        'chicho' => $this->input->post('gender-only')===NULL ? "":$this->input->post('gender-only')
                    )
                );
                $info = $main_info + $sub_info;
                $id = $this->mpost->create($info);
                $this->insert_manage($id);
                redirect('tin-'.$id,'refresh');
            }
        }
        ///////////gmap///////////////
        $data['content']['map'] = $this->gmap();
        ///////////gmap///////////////

        $this->load->view(LAYOUT, $data);
    }

    ////////////////basement/////////////
    public function index_basement($id) {
        $f = $this->mpost->get_one($id);

        ///////////gmap///////////////       
        $data['content']['map'] = $this->index_gmap($f['kinhdo'],$f['vido']);
        //////////////////gmap///////////////

        $data['view'] = 'post/index_base';
        $data['content']['content'] = $f;
        $data['content']['additional'] = 'post/index_basement';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $data['title'] = $f['tieude'];
        $this->load->view(LAYOUT, $data);
    }

    public function create_basement() {
        $this->muser->if_locked();
        $data['view'] = 'post/base_form';
        $data['content']['content'] = '';
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content']['action'] = $class_name.'/'.$method_name;
        $data['content']['additional'] = 'post/basement_form';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
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
                        'nhavesinh' => $this->input->post('rest-room')===NULL?0:1,
                        'amthap' => $this->input->post('amthap')===NULL ? 0:1,
                        'tiennghi' => $this->input->post('other-services'),
                        'xebuyt' => $this->input->post('bus'),
                        'thongthoang' => $this->input->post('thongthoang')===NULL ? 0:1,
                        'chicho' => $this->input->post('gender-only')===NULL ? "":$this->input->post('gender-only')
                    )
                );
                $info = $main_info + $sub_info;
                $id = $this->mpost->create($info);
                $this->insert_manage($id);
                redirect('tin-'.$id,'refresh');
            }
        }
        ///////////gmap///////////////
        $data['content']['map'] = $this->gmap();
        ///////////gmap///////////////

        $this->load->view(LAYOUT, $data);
    }

    ////////////fullhouse///////////
    public function index_full_house($id) {
        $f = $this->mpost->get_one($id);

        ///////////gmap///////////////       
        $data['content']['map'] = $this->index_gmap($f['kinhdo'],$f['vido']);
        //////////////////gmap///////////////

        $data['view'] = 'post/index_base';
        $data['content']['content'] = $f;
        $data['content']['additional'] = 'post/index_full_house';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $data['title'] = $f['tieude'];
        $this->load->view(LAYOUT, $data);
    }

    public function create_full_house() {
        $this->muser->if_locked();
        $data['view'] = 'post/base_form';
        $data['content']['content'] = '';
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['content']['action'] = $class_name.'/'.$method_name;
        $data['content']['additional'] = 'post/full_house_form';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $this->load->library('form_validation');
        $main_rules = $this->set_form_rules();
        $rent_room_rules = array();

        $rules = array_merge($main_rules, $rent_room_rules);

        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $main_info = $this->get_main_input(4);
                $sub_info = array(
                    MODEL_POST_FULL_HOUSE => array(
                        'anninh' => $this->input->post('security'),
                        'solau' => $this->input->post('floor'),
                        'sophong' => $this->input->post('all-room'),
                        'phongngu' => $this->input->post('bed-room'),
                        'nhavesinh' => $this->input->post('rest-room'),
                        'xebuyt' => $this->input->post('bus'),
                        'controng' => $this->input->post('free-room'),
                        'chicho' => $this->input->post('gender-only')===NULL ? "":$this->input->post('gender-only')
                    )
                );
                $info = $main_info + $sub_info;
                $id = $this->mpost->create($info);
                $this->insert_manage($id);
                redirect('tin-'.$id,'refresh');
            }
        }
        ///////////gmap///////////////
        $data['content']['map'] = $this->gmap();
        ///////////gmap///////////////

        $this->load->view(LAYOUT, $data);
    }

    public function create_post() {
        $this->muser->if_locked();
        $data['view'] = 'post/create_post';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $this->load->view(LAYOUT, $data);
    }

    public function sort($value) {
        // $referrer = $this->agent->referrer();
        $this->input->set_cookie(COOKIE_POST_SORT, $value, 0);
        $GLOBALS['post_sort'] = true;
        redirect('home','refresh');
    }

    public function insert_manage($idPost) {
        $this->mmanage_post->create($this->session->userdata(LABEL_LOGIN)['id'], $idPost);
    }
}