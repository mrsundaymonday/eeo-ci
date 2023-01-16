<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class Rekeningperusahaan extends CI_Controller 
{
    
	function __construct() 
    {   	
		parent::__construct();		
	 $this->load->helper('url');
	 $this->load->library('form_validation');	
	 $this->load->model('Bank_m','BANK');	
	 $this->load->model('Branchbank_m','BRANCHBANK');	
	 $this->load->model('Rekeningbranchbank_m','REKENING');	
	 $this->load->model('Rekeningperusahaan_m','REKENINGUSAHA');	
     $this->load->model(array('Modul_m'));  
	 //$this->isLoggedIn(FALSE);
     }
 
    public function index()
    {		
         $data['menus']  = $this->Modul_m->menus();
        $data['content'] = 'master_rekeningperusahaan';
        $this->load->view('include/template', $data);	
    }
    
   
	function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->REKENINGUSAHA->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $action = "";
        foreach ($list as $value) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $action =  '<a href="#" class="btn-action" onclick="edit_data('.$value->id.')"><i class="fa fa-pencil"></i></a>';
            $action .=  '<a href="#" class="btn-action" onclick="delete_data('.$value->id.')"><i class="fa fa-trash"></i></a>';
            $row[] = $no;
            $row[] = $value->nama;
            $row[] = $value->nama_bank;
            $row[] = $value->nama_bankcabang;
            $row[] = $value->no_rekening;
            $row[] = "<div>".$action."</div>";
            $data[] = $row;
        }
         $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->REKENINGUSAHA->count_all(),
                        "recordsFiltered" => $this->REKENINGUSAHA->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function getrekeningperusahaan_byid($id){
        $query = $this->REKENINGUSAHA->get_by_id($id);
        if($query){
            echo json_encode($query);
        }
    }
    function rekeningperusahaan_update($id){
        $data = array(
            'id_perusahaan'=>$this->input->post('id_perusahaan'),
            'id_rek_bankbranch'=>$this->input->post('id_rek_bankbranch')
        );
        $update = $this->REKENINGUSAHA->rekeningperusahaan_update(array('id'=>$id),$data);
        if($update){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
    }
    
    function rekeningperusahaan_add(){
        $data = array(
            'id'=>'',
            'id_perusahaan'=>$this->input->post('id_perusahaan'),
            'id_rek_bankbranch'=>$this->input->post('id_rek_bankbranch')
        );
        $add = $this->REKENINGUSAHA->rekeningperusahaan_add($data);
        if($add){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
    }
    
    function rekeningperusahaan_delete($id)
	{
		$del = $this->REKENINGUSAHA->delete_by_id($id);
        if($del){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
	}
}