<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

  public function __construct(){
  	parent::__construct();
    $this->load->model('model1');
    $this->load->helper('url_helper');

  }

  public function index($tablename=""){
		echo $tablename;
    $data['all_data'] = $this->model1->get_dims();

    $this->load->view('header');
		$this->load->view('content',$data);
    $this->load->view('footer');
  }

  public function update(){
    $data['all_data'] = $this->model1->get_dims();
    $data['jerarquia'] = $this->input->post('jerarquia');
    $data['medida'] = $this->input->post('medida');
    $data['dimension'] = $this->input->post('dimension');
     $this->load->view('header');
     $this->load->view('content',$data);
     $this->load->view('footer');
    //echo $this->input->post('jerarquia');
  }

  public function get_query(){
    $meta_data = $this->model1->get_meta_data();
    $data['tiempo'] = $this->input->post('jerarquia');
    $data['producto'] = $this->input->post('medida');
    $data['tienda'] = $this->input->post('dimension');

    // generate results from model1 $resultt = process_query($data);
     $result['query'] = $this->model1->process_query($data);
     $result['fields'] = $data;
     $this->load->view('header');
     $this->load->view('meta_data',$meta_data);
     $this->load->view('result',$result);
     $this->load->view('footer');
    //echo $this->input->post('jerarquia');
  }

  public function prueba(){
    $meta_data = $this->model1->get_meta_data();
    $this->load->view('header');
    $this->load->view('meta_data',$meta_data);
    $this->load->view('footer');
  }

	public function seetable($table_name = "wkf_activity"){
		$data['table'] = $this->model1->any_table($table_name);
		$this->load->view('welcome_message',$data);
		echo "hola";
	}

}
