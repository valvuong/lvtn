<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','mpost','mcontact'));	
    }

	public function index($page=1)
	{
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        $data['left_hidden'] = true;
        $data['right_view'] = 'layout/right';
        $data['right_content']['content'] = '';
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
        }
        $data['content']['content'] = $this->mpost->get_all($page, $sort, $field);
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_all_rows();
        $data['content']['url_alias'] = '';
        $this->load->view(LAYOUT, $data);
	}

    public function contact() {
        $data['view'] = 'static_page/contact';
        $data['content'] = '';
        $data['left_hidden'] = true;
        $data['right_hidden'] = true;

        $this->load->library('googlemaps');
        $config['center'] = '10.772223670808806,106.65842771530151';
        $config['zoom'] = '15';
        $this->googlemaps->initialize($config);
        $marker['position'] = '10.772223670808806,106.65842771530151';
        $this->googlemaps->add_marker($marker);
        $data['content']['map'] = $this->googlemaps->create_map();

        $this->load->library('form_validation');
        $rules = array(
            array(
                'field' => 'name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'email',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'message',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($rules);

        if ($this->input->post('contact-submit')) {
            if($this->form_validation->run()) {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $message = $this->input->post('message');
                $info = array(
                    'name'      => $name,
                    'email'     => $email,
                    'message'   => $message,
                    'read'      => 0,
                    'sendemail' => 0
                );
                $this->mcontact->save_contact($info);
            }
        }

        $this->load->view(LAYOUT, $data);
    }

    public function create_post() {
        if(!$this->session->userdata(LABEL_LOGIN)) {
            redirect('dang-nhap','refresh');
        }
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
        redirect('','refresh');
    }
	
}
