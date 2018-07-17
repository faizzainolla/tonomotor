<script>
$(document).ready(function(){
$('input[name="quantity"]').change(function() {
    var harga = parseInt($('input[name="hargabarang"]').val());
    var quantity = parseInt($('input[name="quantity"]').val());
    var hasil = harga * quantity;
    $('input[name="subtotal"]').val(hasil);
});
$('input[name="Bayar"]').keyup(function() {
    var total = parseInt($('#total_hidden').val());
    var bayar = parseInt($('input[name="Bayar"]').val());
    var kembali = bayar - total;
    $('input[name="kembali"]').val("Rp. " + kembali);
});
$('#btntambah').attr('disabled',true);

    $('#quantity').change(function(){
        if($(this).val().length !=0){
            $('#btntambah').attr('disabled', false);
        }
        else
        {
            $('#btntambah').attr('disabled', true);
        }
    })
});

</script>
  <?=form_open('transaksi/tambahtransaksi',array('class'=>'form-horizontal'));?>
<fieldset>
<!-- Form Name -->
<legend>Transaksi</legend>
<div class="col-md-6">

  <div class="form-group">
    <div class="col-md-6">
    <?=validation_errors();?>
    </div>
  </div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="idbarang">ID Barang :</label>
  <div class="col-md-3">

  <select data-placeholder="Pilih ID Barang.." class="chosen-select" id="idbarang" name="idbarang" style="width:100px;" tabindex="2">
          <option value=""></option>
          <?php foreach ($idbarang_select as $key): ?>
            <option value="<?=$key->id_barang;?>" <?php if (@$idcari==$key->id_barang) {echo"selected";} ?>><?=$key->id_barang;?></option>
          <?php endforeach; ?>
  </select>
  </div>
  <div class="col-md-3">
  <button name="btncari" type="submit" class="btn btn-primary" value="cariid"><span class="glyphicon glyphicon-search"></span></button>
</div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="namabarang">Nama Barang :</label>
  <div class="col-md-8">
  <input id="namabarang" name="namabarang" placeholder="" class="form-control input-md" type="text" value="<?=@$databyid[0]->nama_barang;?>" readOnly="true">
  <input type="hidden" name="id" value="<?=@$databyid[0]->id;?>">
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="hargabarang">Harga Barang :</label>
  <div class="col-md-8">
  <input id="hargabarang" name="hargabarang" placeholder="" class="form-control input-md" type="text" value="<?=@$databyid[0]->harga_satuan;?>" readOnly="true">

  </div>
</div>

</div>
<div class="col-md-6">
  <div class="form-group">
    <label class="col-md-3 control-label" for="quantity">Quantity :</label>
    <div class="col-md-3">
    <input id="quantity" name="quantity" class="form-control input-md" type="number" min="1" max="<?=@$databyid[0]->quantity;?>">
    </div>
    <div class="col-md-2">
      <a href="#" class="btn btn-success disabled">Max <?=@$databyid[0]->quantity;?></a>
    </div>

  </div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="subtotal">Sub-Total :</label>
  <div class="col-md-8">
  <input id="subtotal" name="subtotal" placeholder="" class="form-control input-md" type="text" readOnly="true">

  </div>
</div>

<!-- Text input-->

</div>
<div class="col-md-6">
  <div class="form-group">
    <label class="col-md-3 control-label" for="kembali"></label>
    <div class="col-md-8">
    <button id="btntambah" name="btntambah" type="submit" class="btn btn-primary" value="tambahtransaksi"><span class="glyphicon glyphicon-shopping-cart"></span>Tambah</button>
  </div>
</div>
</div>
</fieldset>
<?=form_close();?>

<legend>Daftar Barang</legend>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>No</th>
      <th>Id Barang</th>
      <th>Nama Barang</th>
      <th>Harga Satuan</th>
      <th>Quantity</th>
      <th>Sub-Total</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($barang_temp as $key_barang) {
      ?>
      <tr>
        <td><?=$no++;?></td>
        <td><?=$key_barang->id_barang;?></td>
        <td><?=$key_barang->nama_barang;?></td>
        <td><?="Rp. " . " " . number_format($key_barang->harga_barang,2,',','.');?></td>
        <td><?=$key_barang->quantity;?></td>
        <td><?="Rp. " . " " . number_format($key_barang->sub_total,2,',','.');?></td>
        <td>

          <a href="<?=base_url('transaksi/hapustrans/') . $key_barang->id;?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Akan Di Hapus ?')">Hapus <span class="glyphicon glyphicon-remove"></span></a>
        </td>
      </tr>
      <?php
    } ?>
  </tbody>
</table>
<hr />
