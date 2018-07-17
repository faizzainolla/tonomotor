<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_db extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function masukdb($data){
    if ($this->db->insert('tb_barang',$data)) {
      return true;
    }
  }

  public function updatedb($id,$data){
    $this->db->set($data);
    $this->db->where('id',$id);
    if ($this->db->update('tb_barang',$data)) {
      return true;
    }
  }

  public function deletedb($id){
    if ($this->db->delete('tb_barang','id = ' . $id)) {
      return true;
    }
  }

}
