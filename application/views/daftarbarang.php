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
          <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Quantity</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;

              foreach ($data_barang as $barang) {
                ?>
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$barang->id_barang;?></td>
                  <td><?=$barang->nama_barang;?></td>
                  <td><?="Rp." . " " . number_format($barang->harga_satuan,2,',','.');?></td>
                  <td><?=$barang->quantity;?></td>
                  <th>
                    <a href="<?=base_url('pengaturan/edit_barang/') . $barang->id;?>" class="btn btn-primary btn-xs" onclick="return confirm('Yakin Akan Di Edit ?')">Edit <span class="glyphicon glyphicon-pencil"></span> </a>
                    <a href="<?=base_url('pengaturan/delete_barang/') . $barang->id;?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Akan Di Hapus ?')">Delete <span class="glyphicon glyphicon-remove"></span></a>
                  </th>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <?=validation_errors();?>
      <?php
      if (@$edit_db!='') {
        ?>
        <div class="panel panel-default">
          <div class="panel-body">
            <?=form_open('pengaturan/updatedata',array('class'=>'form-horizontal'));?>
            <fieldset>

            <!-- Form Name -->
            <legend>Edit Daftar Barang</legend>
            <div class="form-group">
              <div class="col-md-6">
              <?=validation_errors();?>
              </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="idbarang">ID Barang :</label>
              <div class="col-md-3">
                <input type="hidden" name="id" value="<?=$edit_db[0]->id;?>">
              <input id="idbarang" name="idbarang" placeholder="" class="form-control input-md" required="" type="text" required="" value="<?=$edit_db[0]->id_barang;?>">
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="namabarang">Nama Barang :</label>
              <div class="col-md-5">
              <input id="namabarang" name="namabarang" placeholder="" class="form-control input-md" required="" type="text" value="<?=$edit_db[0]->nama_barang;?>">

              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="hargasatuan">Harga  Satuan(Rp) :</label>
              <div class="col-md-3">
              <input id="hargasatuan" name="hargasatuan" placeholder="" class="form-control input-md" required="" type="number" value="<?=$edit_db[0]->harga_satuan;?>">
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="quantity">Quantity :</label>
              <div class="col-md-2">
              <input id="quantity" name="quantity" placeholder="" class="form-control input-md" type="number" min="1" max="99999" required="" value="<?=$edit_db[0]->quantity;?>">

              </div>
            </div>

            <div class="form-group">
                  <div class="col-md-8 col-md-offset-4">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button name="editbarang" type="submit" class="btn btn-primary" value="editbrng">Kirim Edit</button>
                  </div>
                </div>

            </fieldset>
            <?=form_close();?>
          </div>
        </div>
        <?php
      }
       ?>
    </div>
	</div>
</div>
