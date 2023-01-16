<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class Master extends CI_Controller 
{

	function __construct() 
    {   	
		parent::__construct();		
      $this->load->helper('url');
      $this->load->library('form_validation');	
      $this->load->Model('Perusahaan_m','COMP');
      $this->load->Model('Branchbank_m','BRANCHBANK');
      $this->load->Model('Modul_m');	
	 //$this->isLoggedIn(FALSE);
    }

  public function index()
  {		
    $data['menus'] = $this->Modul_m->menus();
    $data['submenus']  = $this->Modul_m->submenus();
   
    $data['content'] = 'master/dashboardmaster';    
    $this->load->view('include/template', $data); 
    }

public function mstrperusahaan()
{		
    $data['menus'] = $this->Modul_m->menus();
    $data['content'] = 'master/master_perusahaan';
    $this->load->view('include/template', $data);	
}	


public function mstrjabatan()
{		
    $data['menus'] = $this->Modul_m->menus();
    $data['content'] = 'master/master_jabatan';
    $this->load->view('include/template', $data);	
}	


public function mstrbank()
{		
    $data['menus'] = $this->Modul_m->menus();
    $data['content'] = 'master/master_bank';
    $this->load->view('include/template', $data);	
}	

public function mstrbranchbank()
{		
    $data['menus'] = $this->Modul_m->menus();
    $data['content'] = 'master/master_branchbank';
    $this->load->view('include/template', $data);	
}	


public function mstrrekbank()
{		
    $data['menus'] = $this->Modul_m->menus();
    $data['branch']  = $this->BRANCHBANK->getall();    
    $data['content'] = 'master/master_rekeningbranchbank';
    $this->load->view('include/template', $data);	
}	


public function mstrrekbankcomp()
{		
    $data['menus'] = $this->Modul_m->menus();
    $data['content'] = 'master/master_rekeningperusahaan';
    $this->load->view('include/template', $data);	
}	




}