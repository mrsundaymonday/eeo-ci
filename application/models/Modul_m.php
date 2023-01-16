<?php
class Modul_m extends CI_Model{

    var $tblmodul_katagori = 'modul_katagori';
    var $tblmodul_menu = 'modul_menu';

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
  }

  function menus() {
    $this->db->order_by('order_by','asc');
    return $this->db->get('modul_katagori mk')->result();

}  
function submenus() {
    $this->db->select('mm.icon,mm.function,mm.nama_menu,mk.function as mk_function');
    $this->db->join("modul_katagori mk",'mm.id_katagori = mk.id');
    $this->db->where('mk.function',$this->uri->segment(1));
    return $this->db->get('modul_menu mm')->result();
}

public function getall()
{  $this->db->order_by('order_by','asc');
return $this->db->get($this->tblmodul_katagori)->result();
}

public function getall_menu($data)
{ 
    $this->db->order_by('nama_menu','asc');
    $this->db->where('id_katagori',$data);
    return $this->db->get($this->tblmodul_menu)->result();
}


public function get_by_id($id)
{
  $this->db->where('id',$id);
  return $this->db->get($this->tblmodul_katagori)->row();
}

public function modul_katagori_add($data)
{
  $this->db->insert($this->tblmodul_katagori, $data);
  return $this->db->insert_id();
}

public function modul_katagori_update($where, $data)
{
  $this->db->update($this->tblmodul_katagori, $data, $where);
  return $this->db->affected_rows();
}

public function modul_katagori_delete($id)
{
  $this->db->where('id', $id);
  $this->db->delete($this->tblmodul_katagori);
}

}