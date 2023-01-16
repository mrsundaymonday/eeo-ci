<?php
class Rekeningbranchbank_m extends CI_Model{

	var $table = 'tbl_mstr_rek_bankbranch';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    var $column_order = array(null,  'b.nama_bank','bb.nama','bb.lokasi','rb.no_rekening');
    var $column_search = array('b.nama','bb.nama','bb.lokasi','rb.no_rekening');
    var $order = array('bb.nama' => 'asc');
       
    private function _get_datatables_query()
    {
        $this->db->select('bb.*,rb.id as id_rek,b.nama as nama_bank,rb.no_rekening');        
        $this->db->join('tbl_mstr_branchbank bb','bb.id= rb.id_branchbank');  
        $this->db->join('tbl_mstr_bank b','bb.id_bank= b.id');          
        $this->db->from('tbl_mstr_rek_bankbranch rb');
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
	public function getall()
	{
	$this->db->from($this->table);
	$query=$this->db->get();
	return $query->result();
	}


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function data_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function data_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function data_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

}