<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengaturan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('setting_db');
  }

  function index()
  {

  }

  public function masukdata(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('idbarang', 'ID Barang', 'trim|required|min_length[4]|max_length[12]|xss_clean');
    $this->form_validation->set_rules('namabarang', 'Nama Barang', 'trim|required|min_length[3]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('hargasatuan', 'Harga Satuan', 'trim|required|min_length[4]|max_length[12]|xss_clean');
    $this->form_validation->set_rules('quantity', 'quantity', 'trim|required|min_length[1]|max_length[5]|xss_clean');
    if ($this->form_validation->run()==FALSE) {
      $this->load->view('header');
      $this->load->view('index',array('geturl'=>'tambah_daftar','berhasilmasuk'=>''));
      $this->load->view('footer');
    }else {
      if ($this->input->post('kirimbarang')=='kirimbrng') {
        $id_barang = $this->input->post('idbarang');
        $nama_barang = $this->input->post('namabarang');
        $harga_satuan = $this->input->post('hargasatuan');
        $quantity = $this->input->post('quantity');
        $data = array('id_barang' => $id_barang ,
                      'nama_barang' => $nama_barang,
                      'harga_satuan' => $harga_satuan,
                      'quantity' => $quantity);
        if ($this->setting_db->masukdb($data)) {
          $this->load->view('header');
          $this->load->view('index',array('geturl'=>'tambah_daftar',
                                          'berhasilmasuk'=>$data,
                                        ));
          $this->load->view('footer');
        }
      }
    }

  }

  public function daftar_barang(){
    $query = $this->db->get('tb_barang');
    $data['data_barang'] = $query->result();
    $this->load->view('header');
    $this->load->view('daftarbarang',$data);
    $this->load->view('footer');
  }

  public function edit_barang(){
    $id = $this->uri->segment('3');
    $query = $this->db->get_where('tb_barang',array('id'=>$id));
    $query2 = $this->db->get('tb_barang');
    $data['edit_db'] = $query->result();
    $data['data_barang'] = $query2->result();
    $this->load->view('header');
    $this->load->view('daftarbarang',$data);
    $this->load->view('footer');
  }

  public function updatedata(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('idbarang', 'ID Barang', 'trim|required|min_length[4]|max_length[12]|xss_clean');
    $this->form_validation->set_rules('namabarang', 'Nama Barang', 'trim|required|min_length[3]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('hargasatuan', 'Harga Satuan', 'trim|required|min_length[4]|max_length[12]|xss_clean');
    $this->form_validation->set_rules('quantity', 'quantity', 'trim|required|min_length[1]|max_length[5]|xss_clean');
    if ($this->form_validation->run()==FALSE) {
        $query = $this->db->get('tb_barang');
        $barang['data_barang'] = $query->result();
        $this->load->view('header');
        $this->load->view('daftarbarang',$barang);
        $this->load->view('footer');
    }elseif($this->input->post('editbarang')=='editbrng') {
        $id = $this->input->post('id');
        $id_barang = $this->input->post('idbarang');
        $nama_barang = $this->input->post('namabarang');
        $harga_satuan = $this->input->post('hargasatuan');
        $quantity = $this->input->post('quantity');
        $data = array('id_barang' => $id_barang,
                      'nama_barang' => $nama_barang,
                      'harga_satuan' => $harga_satuan,
                      'quantity' => $quantity);
        if ($this->setting_db->updatedb($id,$data)) {
            $query = $this->db->get('tb_barang');
            $barang['data_barang'] = $query->result();
            $this->load->view('header');
            $this->load->view('daftarbarang',$barang);
            $this->load->view('footer');
        }
    }
  }

  public function delete_barang(){
    $id = $this->uri->segment('3');
    if ($this->setting_db->deletedb($id)) {
      $query = $this->db->get('tb_barang');
      $barang['data_barang'] = $query->result();
      $this->load->view('header');
      $this->load->view('daftarbarang',$barang);
      $this->load->view('footer');
    }
  }

}
