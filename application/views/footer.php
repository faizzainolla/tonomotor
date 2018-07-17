
<script src="<?=base_url('asset/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('asset/chosen/chosen.jquery.min.js')?>"></script>
<script>
var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
</script>
  </body>
</html>
