
<?=form_open('pengaturan/masukdata',array('class'=>'form-horizontal'));?>
<fieldset>

<!-- Form Name -->
<legend>Tambah Daftar Barang</legend>
<div class="form-group">
  <div class="col-md-6">
  <?=validation_errors();?>
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="idbarang">ID Barang :</label>
  <div class="col-md-3">
  <input id="idbarang" name="idbarang" placeholder="" class="form-control input-md" required="" type="text" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="namabarang">Nama Barang :</label>
  <div class="col-md-5">
  <input id="namabarang" name="namabarang" placeholder="" class="form-control input-md" required="" type="text">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="hargasatuan">Harga  Satuan(Rp) :</label>
  <div class="col-md-3">
  <input id="hargasatuan" name="hargasatuan" placeholder="" class="form-control input-md" required="" type="number">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="quantity">Quantity :</label>
  <div class="col-md-2">
  <input id="quantity" name="quantity" placeholder="" class="form-control input-md" type="number" min="1" max="99999" required>

  </div>
</div>

<div class="form-group">
      <div class="col-md-8 col-md-offset-4">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button name="kirimbarang" type="submit" class="btn btn-primary" value="kirimbrng">Kirim</button>
      </div>
    </div>

</fieldset>
<?=form_close();?>

<?php
if (@$berhasilmasuk!='') {

  ?>
  <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Well done!</strong> Data Berhasil Di Masukan Dengan Data Sebagai Berikut :
    <p><strong>ID Barang : </strong><?=$berhasilmasuk['id_barang'];?></p>
    <p><strong>Nama Barang : </strong><?=$berhasilmasuk['nama_barang'];?></p>
    <p><strong>Harga Satuan : </strong><?=$berhasilmasuk['harga_satuan'];?></p>
    <p><strong>Quantity : </strong><?=$berhasilmasuk['quantity'];?></p>
  </div>

  <?php
}
 ?>
