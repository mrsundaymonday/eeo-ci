<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class Rekeningbranchbank extends CI_Controller 
{

	function __construct() 
    {   	
		parent::__construct();		
	 $this->load->helper('url');
	 $this->load->library('form_validation');	
	 $this->load->model('Bank_m','BANK');	
	 $this->load->model('Branchbank_m','BRANCHBANK');	
	 $this->load->model('Rekeningbranchbank_m','REKENING');	
     $this->load->model(array('Modul_m'));  
	 //$this->isLoggedIn(FALSE);
     }
 
    public function index()
    {		
        $data['menus']  = $this->Modul_m->menus();
        $data['content'] = 'master/master_rekeningbranchbank';
        $this->load->view('include/template', $data);	
    }
    
   
	function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->REKENING->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $action = "";
        foreach ($list as $value) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $action =  '<a href="#" class="btn-action" onclick="edit_data('.$value->id_rek.')"><i class="fa fa-pencil"></i></a>';
            $action .=  '<a href="#" class="btn-action" onclick="delete_data('.$value->id_rek.')"><i class="fa fa-trash"></i></a>';
            $row[] = $no;
            $row[] = $value->nama_bank;
            $row[] = $value->nama;
            $row[] = $value->lokasi;
            $row[] = $value->no_rekening;
            $row[] = "<div>".$action."</div>";
            $data[] = $row;
        }
         $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->REKENING->count_all(),
                        "recordsFiltered" => $this->REKENING->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function getdata_byid($id){
        $query = $this->REKENING->get_by_id($id);
        if($query){
            echo json_encode($query);
        }
    }
    function data_update($id){
        $data = array(
            'id_branchbank'=>$this->input->post('id_branchbank'),
            'no_rekening'=>$this->input->post('no_rekening')
        );
        $update = $this->REKENING->data_update(array('id'=>$id),$data);
        if($update){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
    }
    
    function data_add(){
        $data = array(
            'id'=>'',
            'id_branchbank'=>$this->input->post('id_branchbank'),
            'no_rekening'=>$this->input->post('no_rekening')
        );
        $add = $this->REKENING->data_add($data);
        if($add){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
    }
    
    function data_delete($id)
	{
		$del = $this->REKENING->data_delete($id);
        if($del){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
	}
}