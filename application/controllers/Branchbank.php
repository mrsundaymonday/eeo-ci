<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class Branchbank extends CI_Controller 
{

	function __construct() 
    {   	
		parent::__construct();		
	 $this->load->helper('url');
	 $this->load->library('form_validation');	
	 $this->load->model('Bank_m','BANK');	
	 $this->load->model('Branchbank_m','BRANCHBANK');	
     $this->load->model(array('Modul_m'));  
	 //$this->isLoggedIn(FALSE);
     }
 
    public function index()
    {		
        $data['menus']  = $this->Modul_m->menus();
        $data['content'] = 'master/master_branchbank';
        $this->load->view('include/template', $data);	
    }
    
   
	function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->BRANCHBANK->get_datatables();

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
            $row[] = $value->nama_bank;
            $row[] = $value->nama;
            $row[] = $value->lokasi;
            $row[] = "<div>".$action."</div>";
            $data[] = $row;
        }
         $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->BRANCHBANK->count_all(),
                        "recordsFiltered" => $this->BRANCHBANK->count_filtered(),
                        "data" => $data,
                );
         
        //output to json format
        echo json_encode($output);
    }

    function getbranchbank_byid($id){
        $query = $this->BRANCHBANK->get_by_id($id);
        if($query){
            echo json_encode($query);
        }
    }
    function branchbank_update($id){
        $data = array(
            'nama'=>$this->input->post('nama')
        );
        $update = $this->BRANCHBANK->branchbank_update(array('id'=>$id),$data);
        if($update){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
    }
    
    function branchbank_add(){
        $data = array(
            'id'=>'',
            'id_bank'=>$this->input->post('id_bank'),
            'nama'=>$this->input->post('nama'),
            'lokasi'=>$this->input->post('lokasi')
        );
        $add = $this->BRANCHBANK->branchbank_add($data);
        if($add){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
    }
    
    function branchbank_delete($id)
	{
		$del = $this->BRANCHBANK->delete_by_id($id);
        if($del){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
	}
}