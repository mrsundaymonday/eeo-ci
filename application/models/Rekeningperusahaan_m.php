<?php
class Rekeningperusahaan_m extends CI_Model{

	var $table = 'tbl_mstr_rekening_perusahaan';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	 //set nama tabel yang akan kita tampilkan datanya
    //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
    // var $column_order = array(null,  'id_perusahaan','id_rek_bankbranch');
    // var $column_search = array('id_perusahaan','id_rek_bankbranch');

    var $column_order = array(null,  'nama', 'nama_bank','nama_bankcabang', '.no_rekening');
    var $column_search = array('nama', 'nama_bank','nama_bankcabang','no_rekening');

    var $order = array('id' => 'asc');
     
 
//     SELECT tbl_mstr_rekening_perusahaan.*,
//     tbl_mstr_perusahaan.nama,
//     tbl_mstr_bank.nama as nama_bank ,
//     tbl_mstr_branchbank.nama as nama_bankcabang,
//     tbl_mstr_rek_bankbranch.no_rekening
// FROM tbl_mstr_rekening_perusahaan
// join tbl_mstr_perusahaan    on  tbl_mstr_rekening_perusahaan.id_perusahaan = tbl_mstr_perusahaan.id 
// join tbl_mstr_rek_bankbranch on tbl_mstr_rekening_perusahaan.id_rek_bankbranch = tbl_mstr_rek_bankbranch.id
// join tbl_mstr_branchbank on tbl_mstr_rek_bankbranch.id_branchbank = tbl_mstr_branchbank.id
// join tbl_mstr_bank on tbl_mstr_branchbank.id_bank = tbl_mstr_bank.id




    private function _get_datatables_query()
    {
        // $column = array('k.id_kota','k.nm_kota', 'p.nm_propinsi');
        $this->db->select(' a.id , a.id_perusahaan , a.id_rek_bankbranch  , b.nama , e.nama as nama_bank,d.nama as nama_bankcabang,  c.no_rekening  ');
        $this->db->from('tbl_mstr_rekening_perusahaan as a');
        $this->db->join('tbl_mstr_perusahaan as b', 'a.id_perusahaan= b.id','left');
        $this->db->join('tbl_mstr_rek_bankbranch as c', 'a.id_rek_bankbranch = c.id','left');
        $this->db->join('tbl_mstr_branchbank as d', 'c.id_branchbank = d.id','left');       
        $this->db->join('tbl_mstr_bank as e', 'd.id_bank = e.id','left');       
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

	public function rekeningperusahaan_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function rekeningperusahaan_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

}