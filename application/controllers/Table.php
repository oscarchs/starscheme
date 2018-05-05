<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Controller{
	public function __construct(){
  	parent::__construct();
    $this->load->model('model1');
    $this->load->helper('url_helper');
  }

	public function t($table_name = "wkf_activity"){
		$data['table'] = $this->model1->any_table($table_name);
		$this->load->view('welcome_message',$data);
    echo "hola";
  }
}
