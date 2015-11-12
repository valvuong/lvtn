<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gmap extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','form'));
        $this->load->model(array('mdistrict','muser'));
		$this->load->library(array('form_validation','user_agent'));
		$this->load->library('googlemaps');
		
    }
	
	public function show() {
		$this->load->library('googlemaps');
		$config['center'] = 'auto';
		$config['onclick'] = '
				alert(\'Ban da click: \' + event.latLng.lat() + \', \' + event.latLng.lng());
				var lat = event.latLng.lat();
				var lng = event.latLng.lng();
				jQuery.ajax({
					type: "POST",
					url: "http://localhost:7777/htdocs/LVTN3/lvtn/lvtn/user/test",
					data: {lat:lat},
					success: function(res){					
						alert(res);
				}})
				';
		
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '10.7, 106.6'; 
		$this->googlemaps->add_marker($marker);
		
		$data['map'] = $this->googlemaps->create_map();