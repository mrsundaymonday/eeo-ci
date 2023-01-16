<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Dashboard extends CI_Controller 
{

	function __construct() {   	
		parent::__construct();		
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model(array('Modul_m'));

	 //$this->isLoggedIn(FALSE);
	}

	public function index()
	{
		 $data['menus']  = $this->Modul_m->menus();
	 	 $data['content'] = 'indexadmin';
		 $this->load->view('include/template', $data);
	     //echo '<pre>'; print_r($data); die;
	}

}