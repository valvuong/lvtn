<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mpost'));
    }

    public function index($id) {
        $data['view'] = 'post/index';
        $data['content']['content'] = $this->mpost->get_one($id);
        $data['left_hidden'] = true;
        $this->load->view(LAYOUT, $data);
    }

    public function form() {
        $data['view'] = 'post/form';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;
        $this->load->library('form_validation');
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
            )
        );

        $this->form_validation->set_rules($rules);

        if($this->input->post('submit')) {
            if($this->form_validation->run()) {
                $info = array(
                    MODEL_POST => array(
                        'tieude' => $this->input->post('title'),
                        'quan' => $this->input->post('district'),
                        'phuong' => $this->input->post('ward'),
                        'chuyenmuc' => $this->input->post('category'),
                        'giaphong' => $this->input->post('price'),
                        'dientich' => $this->input->post('area'),
                        'noidung' => $this->input->post('content_post'),
                        'ngaydang' => date('Y-m-d'),
                        'hethan' => date('Y-m-d',strtotime($this->input->post('expired_date')))
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
                    ACTION_POST_UPLOAD => $_FILES
                );
                $id = $this->mpost->create($info);
                redirect('post/index/'.$id,'refresh');
            }
        }

        $this->load->view(LAYOUT, $data);
    }

    public function match_date($date) {
        return (bool)preg_match('/^(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}$/', $date);
    }

    public function show_by_district($page=1, $idD) {
        $data['view'] = '';
        $data['content']['content'] = $this->mpost->get_by_district($idD, $page);
        $this->load->view(LAYOUT, $data);
    }

    public function show_by_category($page=1, $idC) {
        $data['view'] = 'home';
        $data['content']['content'] = $this->mpost->get_by_category($idC, $page);
        $data['content']['pagination'] = array('post','show_by_category',$page, $idC);
        $data['content']['num_rows'] = $this->mpost->get_category_rows($idC);
        $this->load->view(LAYOUT, $data);
    }
}