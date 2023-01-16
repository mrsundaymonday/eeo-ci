<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class Perusahaan extends CI_Controller 
{

	function __construct() {   	
		parent::__construct();		
	 $this->load->helper('url');
	 $this->load->library('form_validation');	
	 $this->load->model('Perusahaan_m','COMP');	
     $this->load->model(array('Modul_m'));  
	 //$this->isLoggedIn(FALSE);
 }
 
    public function index()
    {		
        $data['menus']  = $this->Modul_m->menus();
        $data['content'] = 'master_perusahaan';
        $this->load->view('include/template', $data);	
    }
    
   
	function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->COMP->get_datatables();
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
            $row[] = $value->kode;
            $row[] = $value->nama;
            $row[] = $value->npwp;
            $row[] = $value->alamat_npwp;
            $row[] = $value->alamat_workshop;
            $row[] = $value->no_telp;
            $row[] = $value->no_hp;
            $row[] = $value->email;
            $row[] = $value->penanggung_jawab;
            $row[] = $value->id_jabatan;
            $row[] = "<div>".$action."</div>";
            $data[] = $row;
        }
         $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->COMP->count_all(),
                        "recordsFiltered" => $this->COMP->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    function getperusahaan_byid($id){
        $query = $this->COMP->get_by_id($id);
        if($query){
            echo json_encode($query);
        }
    }
    function perusahaan_update($id){
        $data = array(
            'kode'=>$this->input->post('kode'),
            'nama'=>$this->input->post('nama'),
            'npwp'=>$this->input->post('npwp'),
            'alamat_npwp'=>$this->input->post('alamat_npwp'),
            'alamat_workshop'=>$this->input->post('alamat_workshop'),
            'no_telp'=>$this->input->post('no_telp'),
            'no_hp'=>$this->input->post('no_hp'),
            'email'=>$this->input->post('email'),
            'penanggung_jawab'=>$this->input->post('penanggung_jawab'),
            'id_jabatan'=>$this->input->post('id_jabatan')                                                            
        );
        $update = $this->COMP->perusahaan_update(array('id'=>$id),$data);
        if($update){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
    }
    
    function perusahaan_add(){
        $data = array(
            'id'=>'',
            'kode'=>$this->input->post('kode'),
            'nama'=>$this->input->post('nama'),
            'npwp'=>$this->input->post('npwp'),
            'alamat_npwp'=>$this->input->post('alamat_npwp'),
            'alamat_workshop'=>$this->input->post('alamat_workshop'),
            'no_telp'=>$this->input->post('no_telp'),
            'no_hp'=>$this->input->post('no_hp'),
            'email'=>$this->input->post('email'),
            'penanggung_jawab'=>$this->input->post('penanggung_jawab'),
            'id_jabatan'=>$this->input->post('id_jabatan')                                                            
        );
        $add = $this->COMP->perusahaan_add($data);
        if($add){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
    }
    
    function perusahaan_delete($id)
	{
		$del = $this->COMP->delete_by_id($id);
        if($del){
            echo json_encode(TRUE);
        }else{
            echo json_encode(FALSE);
        }
	}
}