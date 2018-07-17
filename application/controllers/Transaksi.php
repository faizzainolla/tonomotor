<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('setting_db');
    $this->load->model('transaksi_db');
  }

  function index()
  {

  }

  public function tambahtransaksi(){
    if ($this->input->post('btncari')=="cariid") {
        $idbrng = $this->input->post('idbarang');
        $query = $this->db->get_where('tb_barang',array('id_barang'=>$idbrng));
        $query2 = $this->db->select('id_barang');
        $query2 = $this->db->get('tb_barang');
        $query3 = $this->db->get('penjualan_temp');
        $query4 = $this->db->select_sum('sub_total');
        $query4 = $this->db->get('penjualan_temp');
        $this->load->view('header');
        $this->load->view('index',array('geturl'=>'',
                          'databyid'=>$query->result(),
                          'idbarang_select'=>$query2->result(),
                          'idcari'=>$idbrng,
                          'barang_temp'=>$query3->result(),
                          'total_harga'=>$query4->result()));
        $this->load->view('footer');
    }elseif ($this->input->post('btntambah')=="tambahtransaksi") {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('idbarang', 'ID Barang', 'trim|min_length[4]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('namabarang', 'Nama Barang', 'trim|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('hargabarang', 'Harga Barang', 'trim|min_length[4]|max_length[10]|xss_clean');
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|min_length[1]|max_length[5]|xss_clean');
        $this->form_validation->set_rules('subtotal', 'Sub Total', 'trim|min_length[3]|max_length[10]|xss_clean');
          if ($this->form_validation->run()==FALSE) {
              $this->db->select('id_barang');
              $query = $this->db->get('tb_barang');
              $this->load->view('header');
              $this->load->view('index',array('geturl'=>'','idbarang_select'=>$query->result()));
              $this->load->view('footer');
          }else {
              $id_barang = $this->input->post('idbarang');
              $nama_barang = $this->input->post('namabarang');
              $harga_barang = $this->input->post('hargabarang');
              $quantity = $this->input->post('quantity');
              $subtotal = $this->input->post('subtotal');
              $id = $this->input->post('id');
              $data = array('id_barang' => $id_barang,
                            'nama_barang' => $nama_barang,
                            'harga_barang' => $harga_barang,
                            'quantity' => $quantity,
                            'sub_total' => $subtotal,
                            'by_kasir' => 'kasir_1'
                          );
              if ($this->transaksi_db->masuk_temp($data,$id,$quantity)) {
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
          }
    }

  }

  public function selesai(){
    $query = $this->db->get('penjualan_temp');
    $this->load->view('header');
    $this->load->view('print_data',array('total'=>$this->input->post('total'),
                                         'bayar'=>$this->input->post('Bayar'),
                                         'kembali'=>$this->input->post('kembali'),
                                         'daftar_barang'=>$query->result()));
    $this->load->view('footer');
  }

  public function hapustrans(){
    $id = $this->uri->segment('3');
    $ambilquantitiy = $this->db->select('quantity,id_barang');
    $ambilquantitiy = $this->db->get_where('penjualan_temp',array('id'=>$id));
    $hasilambilquant = $ambilquantitiy->result();
    $oldquant = $this->db->select('quantity');
    $oldquant = $this->db->get_where('tb_barang',array('id_barang'=>$hasilambilquant[0]->id_barang));
    $hasiloldquant = $oldquant->result();
    $jumlahquantity = intval($hasilambilquant[0]->quantity) + intval($hasiloldquant[0]->quantity);
    $data = array('quantity'=>$jumlahquantity);
    if ($this->transaksi_db->hapus_temp($id) && $this->transaksi_db->semula_quantity($data,$hasilambilquant[0]->id_barang)) {
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
  }

  public function hapusalltemp(){
    if ($this->input->post('btnhome')=="home_dan_hapus") {
      if ($this->transaksi_db->hapus_all_temp()) {
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
    }
  }

}
