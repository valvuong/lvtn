<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Market extends CI_Controller {
    
    private $header_message;

    public function __construct() {
        parent::__construct();
        $this->muser->not_authenticated();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mmarket','mmarket_category','mmanage_market'));
        $this->header_message = "CHIA SẺ, BUÔN BÁN, TRAO ĐỔI ĐỒ DÙNG CÁ NHÂN";
    }

    public function index($id) {
        $f = $this->mmarket->get_one($id);
        $data['view'] = 'market/index';
        $data['content']['content'] = $f;
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;
        $data['title'] = $f['tieude'];
        $this->load->view(LAYOUT, $data);
    }

    public function get_all($page = 1) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'market/list';
        $data['left_view'] = 'market/left';
        $data['left_content'] = '';
        $data['right_view'] = 'market/right';
        $data['right_content'] = '';
        $data['content']['content'] = $this->mmarket->get_all($page);
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = ADS_PER_PAGE;
        $data['content']['num_rows'] = $this->mmarket->get_all_rows();
        $data['content']['url_alias'] = 'tin-vat-';
        $data['content']['url_alias_extend'] = '';
        $data['content']['label_list'] = 'TẤT CẢ TIN RAO VẶT';
        $data['header_message'] = $this->header_message;
        $this->load->view(LAYOUT, $data);
    }

    public function create() {
        $this->muser->if_locked();
        $data['view'] = 'market/create';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;

        $this->load->library('form_validation');
        $rules = array(
            array(
                'field' => 'ad-title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'ad-content',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'ad-price',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'ad-phone',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'ad-contact-name',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $info = array(
                    MODEL_MARKET => array(
                        'tieude' => $this->input->post('ad-title'),
                        'loai' => $this->input->post('ad-category'),
                        'loaisp' => $this->input->post('ad-sub-category'),
                        'noidung' => $this->input->post('ad-content'),
                        'giaca' => $this->input->post('ad-price'),
                        'tinhtrang' => $this->input->post('ad-status'),
                        'sodienthoai' => $this->input->post('ad-phone'),
                        'tenlienhe' => $this->input->post('ad-contact-name'),
                        'ngaydang' => date('Y-m-d H:i:s')
                    )
                );
                if(isset($_FILES['market_upload']) && !empty($_FILES['market_upload']['name'][0])) {
                    $info[ACTION_MARKET_UPLOAD] = $_FILES;
                }
                $id = $this->mmarket->create($info);
                $this->insert_manage($id);
               redirect($id.'-tin-vat','refresh');
            }
        }
        $this->load->view(LAYOUT, $data);
    }

    public function insert_manage($id) {
        $idUser = $this->session->userdata(LABEL_LOGIN)['id'];
        $this->mmanage_market->create($idUser, $id);
    }

    public function get_by_category($page = 1, $cate_id) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'market/list';
        $data['left_view'] = 'market/left';
        $data['left_content'] = '';
        $data['right_view'] = 'market/right';
        $data['right_content'] = '';
        $data['content']['content'] = $this->mmarket->get_by_category($page, $cate_id);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $cate_id);
        $data['content']['items_per_page'] = ADS_PER_PAGE;
        $data['content']['num_rows'] = $this->mmarket->get_cate_rows($cate_id);
        $data['content']['url_alias'] = $cate_id.'-rao-vat-';
        $data['content']['url_alias_extend'] = '';
        $result = $this->mmarket_category->get_one($cate_id);
        $data['content']['label_list'] = $result['tenloai'];
        $this->load->view(LAYOUT, $data);
    }

    public function get_by_subcategory($subcate_id, $page = 1) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'market/list';
        $data['left_view'] = 'market/left';
        $data['left_content'] = '';
        $data['right_view'] = 'market/right';
        $data['right_content'] = '';
        $data['content']['content'] = $this->mmarket->get_by_subcategory($page, $subcate_id);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $subcate_id);
        $data['content']['items_per_page'] = ADS_PER_PAGE;
        $data['content']['num_rows'] = $this->mmarket->get_subcate_rows($subcate_id);
        $data['content']['url_alias'] = $class_name.'/'.$method_name.'/'.$subcate_id.'/';
        $data['content']['url_alias_extend'] = '';

        $query = $this->db->query(
            'SELECT '.MODEL_MARKET_SUB_CATEGORY.'.tenloai AS tenloaisp, '.MODEL_MARKET_CATEGORY.'.tenloai'.
            ' FROM '.MODEL_MARKET_SUB_CATEGORY.
            ' LEFT JOIN '.MODEL_MARKET_CATEGORY.
            ' ON '.MODEL_MARKET_CATEGORY.'.id = '.MODEL_MARKET_SUB_CATEGORY.'.idRLoai'.
            ' WHERE '.MODEL_MARKET_SUB_CATEGORY.'.id = '.$subcate_id);
        $result = $query->row_array();
        $data['content']['label_list'] = $result['tenloai'].' - '.$result['tenloaisp'];
        $this->load->view(LAYOUT, $data);
    }
    public function search_by_select($page=1) {
        $search_category = $this->input->get_post('search-category');
        $search_subcategory = $this->input->get_post('search-subcategory');
        $search_status = $this->input->get_post('search-status');
        $search_price = $this->input->get_post('search-price');


        $result = $this->mmarket->get_search_content(
                            $search_category,$search_subcategory,$search_status,$search_price,$page);
        $num_rows = $this->mmarket->get_search_rows(
                           $search_category,$search_subcategory,$search_status,$search_price);

        if ($result != false) {

        }
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'market/list';
        $data['left_view'] = 'market/left';
        $data['left_content'] = '';
        $data['right_view'] = 'market/right';
        $data['right_content'] = '';
        $data['content']['content'] = $result;
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = ADS_PER_PAGE;
        $data['content']['num_rows'] = $num_rows;
        $data['content']['url_alias'] = 'market/Search_by_select/';
        $data['content']['url_alias_extend'] = '?search-category='.$search_category.'&search-subcategory='.$search_subcategory.
        '&search-price='.$search_price.'&search-status='.$search_status;
        $data['content']['label_list'] = 'TẤT CẢ TIN RAO VẶT';
        $data['header_message'] = 'CHIA SẺ, BUÔN BÁN, TRAO ĐỔI ĐỒ DÙNG CÁ NHÂN';
        $this->load->view(LAYOUT, $data);
    }
}