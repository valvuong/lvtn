<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Market extends CI_Controller {
    private $header_message;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mmarket','mmarket_category'));
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
        $data['right_hidden'] = true;
        $data['content']['content'] = $this->mmarket->get_all($page);
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = ADS_PER_PAGE;
        $data['content']['num_rows'] = $this->mmarket->get_all_rows();
        $data['content']['url_alias'] = 'tin-vat-';
        $data['content']['label_list'] = 'TẤT CẢ TIN RAO VẶT';
        $data['header_message'] = $this->header_message;
        $this->load->view(LAYOUT, $data);
    }

    public function create() {
        if (!$this->session->userdata('logged_in')) {
            $data['view'] = 'market/create';
            $data['content']['content'] = '';
            $data['left_hidden'] = true;
            $data['right_hidden'] = true;
            $data['header_message'] = $this->header_message;

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
                            'idUser' => 45,
                            'tieude' => $this->input->post('ad-title'),
                            'loai' => $this->input->post('ad-category'),
                            'quan' => $this->input->post('ad-district'),
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
                   redirect($id.'-tin-vat','refresh');
                }
            }
            $this->load->view(LAYOUT, $data);
        } else {
            redirect('dang-nhap','refresh');
        }
    }

    public function get_by_category($page = 1, $cate_id) {
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'market/list';
        $data['left_view'] = 'market/left';
        $data['left_content'] = '';
        $data['right_hidden'] = true;
        $data['content']['content'] = $this->mmarket->get_by_category($page, $cate_id);
        $data['content']['pagination'] = array($class_name, $method_name, $page, $cate_id);
        $data['content']['items_per_page'] = ADS_PER_PAGE;
        $data['content']['num_rows'] = $this->mmarket->get_cate_rows($cate_id);
        $data['content']['url_alias'] = $cate_id.'-rao-vat-';
        $data['header_message'] = $this->header_message;
        $query = $this->db->query('SELECT tenloai FROM '.MODEL_MARKET_CATEGORY.' WHERE id = '.$cate_id);
        $result = $query->row_array();
        $data['content']['label_list'] = $result['tenloai'];
        $this->load->view(LAYOUT, $data);
    }
}