<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->model(array('mdistrict','mpost'));	
        $this->input->set_cookie(COOKIE_POST_SORT, 0, 86400);
    }

	public function index($page=1)
	{
        $class_name = $this->router->fetch_class();
        $method_name = $this->router->fetch_method();
        $data['view'] = 'home';
        if ($this->input->cookie(COOKIE_POST_SORT) == 0) {
            $data['content']['content'] = $this->mpost->get_all($page);
        } else {
            switch ($this->input->cookie(COOKIE_POST_SORT)) {
                case 1:
                    $data['content']['content'] = $this->mpost->post_sort($page, 'DESC', 'id');
                    break;
                case 2:
                    $data['content']['content'] = $this->mpost->post_sort($page, 'ASC', 'giaphong');
                    break;
                case 3:
                    $data['content']['content'] = $this->mpost->post_sort($page, 'ASC', 'dientich');
                    break;
            }
        }
        $data['content']['pagination'] = array($class_name, $method_name, $page);
        $data['content']['items_per_page'] = POSTS_PER_PAGE;
        $data['content']['num_rows'] = $this->mpost->get_all_rows();
        $data['content']['url_alias'] = '';
        $this->load->view(LAYOUT, $data);
	}

    public function contact() {
        $data['view'] = 'static_page/contact';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;
        $this->load->view(LAYOUT, $data);
    }

    public function about() {
        $data['view'] = 'static_page/about';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;
        $this->load->view(LAYOUT, $data);
    }

    public function create_post() {
        $data['view'] = 'post/create_post';
        $data['content']['content'] = '';
        $data['left_hidden'] = true;
        $this->load->view(LAYOUT, $data);
    }

    public function sort($value) {
        $this->input->set_cookie(COOKIE_POST_SORT, $value, 86400);
        redirect('','refresh');
    }
	
}
