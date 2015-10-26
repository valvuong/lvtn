<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Market extends CI_Controller {
    private $header_message;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mmarket'));
        $this->header_message = "CHIA SẺ, BUÔN BÁN, TRAO ĐỔI ĐỒ DÙNG CÁ NHÂN";
    }

    public function index($id) {
        $data['view'] = 'market/view';
        $data['content']['content'] = $this->mmarket->get_one($id);
        $data['left_hidden'] = true;
    }

    public function get_all($page = 1) {
        $data['view'] = 'market/list';
        $data['content']['content'] = $this->mmarket->get_all($page);
        $data['content']['pagination'] = array('market','get_all',$page);
        $data['content']['num_rows'] = $this->mmarket->get_all_rows();
        $data['header_message'] = $this->header_message;
        $this->load->view(LAYOUT, $data);
    }

    public function create() {
        $data['view'] = 'market/create';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;
        $data['header_message'] = $this->header_message;

        $this->load->library('form_validation');
        $rules = array(
            array(
                'field' => 'ad-title',
                'rules' => 'required'
            ),
            array(
                'field' => 'ad-content',
                'rules' => 'required'
            ),
            array(
                'field' => 'ad-price',
                'rules' => 'required'
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
                        'noidung' => $this->input->post('ad-content'),
                        'giaca' => $this->input->post('ad-price'),
                        'tinhtrang' => $this->input->post('ad-status'),
                        'ngaydang' => date('Y-m-d')
                    )
                );
                if(isset($_FILES['market_upload']) && !empty($_FILES['market_upload']['name'][0])) {
                    $info[ACTION_MARKET_UPLOAD] = $_FILES;
                }
                $id = $this->mmarket->create($info);
//                redirect('market/index/'.$id,'refresh');
            }
        }
        $this->load->view(LAYOUT, $data);
    }
}