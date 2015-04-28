<div class="row" style="padding-top:10px">
	<form method="post" action="<?php echo base_url()?>buku_besar/search" id="buku" style="margin-top:10px">
		<select class='form-control akun-input' name='akun_selected' id='selAkun'>
			<option selected disabled>Akun</option>
			<?php foreach ($akun as $akun_item) { ?>
			<option value='<?php echo htmlentities($akun_item->nama, ENT_QUOTES)?>'><?php echo $akun_item->nama?>
			</option>
			<?php } //foreach akun?>
		</select>
	</form>
	<div id="result" class=""></div>
</div>
<script>
$(function() {
 
    $(".akun-input").change(function() {
        // getting the value that user typed
        var searchString    = $("#selAkun").val();
        // forming the queryString
        console.log();
        var data            = $('#buku').serialize();
        // if searchString is not empty
        if(searchString) {
            // ajax call
            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>buku_besar/search",
                data: data,
                beforeSend: function(html) { // this happens before actual call
                    $("#result").html(''); 
                    $("#searchresults").show();
                    $(".word").html(searchString);
                    $(".back").show();
               },
               success: function(html){ // this happens after we get results
                    $("#result").show();
                    $("#result").append(html);
                    console.log("sudah");
                    $('#saldo').insertAfter('#kode-akun');
              }
            });    
        }
        return false;
    });
});
</script>