<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_db extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }

  public function updatequantity($sesudah,$id_quantity){
    $this->db->set($sesudah);
    $this->db->where('id',$id_quantity);
    if ($this->db->update('tb_barang',$sesudah)) {
      return true;
    }
  }

  public function masuk_temp($data,$id_quantity,$quantity){
    $query = $this->db->get_where('tb_barang',array('id'=>$id_quantity));
    $oldquantity = $query->result();
    $hitung = intval($oldquantity[0]->quantity) - intval($quantity);
    $sesudah = array('quantity' => intval($hitung));
    if ($this->db->insert('penjualan_temp',$data) && $this->updatequantity($sesudah,$id_quantity)) {
      return true;
    }
  }

  public function hapus_temp($id){
    if ($this->db->delete('penjualan_temp','id = ' . $id)) {
      return true;
    }
  }

  public function semula_quantity($data,$id_barang){
    $this->db->set($data);
    $this->db->where('id_barang',$id_barang);
    if ($this->db->update('tb_barang',$data)) {
      return true;
    }
  }

  public function hapus_all_temp(){
    if ($this->db->empty_table('penjualan_temp')) {
      return true;
    }
  }

}
