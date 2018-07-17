<?=form_open('transaksi/selesai',array('class'=>'form-horizontal'));?>
<div class="col-md-6">
<div class="form-group">
  <label class="col-md-3 control-label" for="total">Total :</label>
  <div class="col-md-8">
  <input id="total" name="total" placeholder="" class="form-control input-md" type="text" value="<?="Rp." . " " . number_format($total_harga[0]->sub_total,2,',','.');?>" readOnly="true">
  <input type="hidden" id="total_hidden" value="<?=$total_harga[0]->sub_total;?>">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="Bayar">Bayar (Rp) :</label>
  <div class="col-md-8">
  <input id="Bayar" name="Bayar" placeholder="" class="form-control input-md" type="text" required>

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-3 control-label" for="kembali">Kembali (Rp) :</label>
  <div class="col-md-8">
  <input id="kembali" name="kembali" placeholder="" class="form-control input-md" type="text" readOnly="true">

  </div>
</div>
</div>
<button name="selesaitrans" type="submit" onclick="return confirm('Yakin Sudah Selesai ?')" class="btn btn-primary pull-right col-md-5" value="kirimbrng" style="height:100px;"><h1>Selesai <span class="glyphicon glyphicon-ok"></span></h1></button>
<?=form_close();?>
