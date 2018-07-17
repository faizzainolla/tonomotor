<div class="container-fluid">
  <div class="row">
    <div class="col-md-12" id="kasirheader"><h5><a href="<?=base_url();?>" class="btn btn-primary btn-lg btn-block">Pogram Kasir PHP-Rookie</a></h5></div>
  </div>
	<div class="row">
		<div class="col-md-3">
      <?php $this->load->view('menu'); ?>
</div>
		<div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-body">
          <?php
          if ($geturl=="tambah_daftar") {
            $this->load->view('tambahbarang');

          }else{
          $this->load->view('transaksi');
          $this->load->view('totalbayar');
          }
          ?>
        </div>
      </div>
    </div>
	</div>
</div>
