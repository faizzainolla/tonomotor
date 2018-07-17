<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {

  }


  public function homepage(){
    $query = $this->db->select('id_barang');
    $query = $this->db->get('tb_barang');
    $query2 = $this->db->get('penjualan_temp');
    $query3 = $this->db->select_sum('sub_total');
    $query3 = $this->db->get('penjualan_temp');
    $this->load->view('header');
    $this->load->view('index',array('geturl'=>'',
                      'idbarang_select'=>$query->result(),
                      'barang_temp'=>$query2->result(),
                      'total_harga'=>$query3->result()));
    $this->load->view('footer');
  }

  public function geturi(){
    $url = $this->uri->segment('3');
    $this->load->view('header');
    $this->load->view('index',array('geturl'=>$url));
    $this->load->view('footer');
  }

}
