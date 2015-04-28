<div class="row">
	<!--
	<form method="post" action="<?php echo base_url()?>jurnal/search" style="margin-top:10px">
		<div class="col-md-3 col-md-offset-9">
			<div class='col-md-8'>
		    	<input type="text" name="search" id="search_box" class='form-control search_box' placeholder="transaksi/no voucher"/>
		    </div>
		    <div class="col-md-4">
		   		<input type="submit" value="Search" class="form-control search_button" /><br />
			</div>
				<a class="col-md-4 col-md-offset-8 btn btn-default back" href='<?php echo base_url()?>jurnal' style="display:none">Back</a>

		</div>
	</form>
	-->
	<div style="clear:both"></div>
	<div id="searchresults" style="display:none">Search results :</div>
	
	<div id='result'>
	<table class="table">	
	<thead>
		<tr><th>No</th><th>Tanggal</th><th>No. Voucher</th><th>Transaksi</th><th>Debit Akun</th><th>Debit Value</th><th>Kredit Akun</th><th>Kredit Value</th>
		</tr>
	</thead>
	<?php 
	$voucher ="";
	$count = 1;
	foreach ($jurnal as $j) { ?>
		<?php if ($j->no_voucher != $voucher ) {	?>	
		<tr><td><?php echo $count++;?></td><td><?php echo $j->tanggal?></td><td><?php echo $j->no_voucher?></td><td><?php echo $j->transaksi?></td><td><?php echo $j->debit?></td><td><?php echo $j->debit_value?></td><td><?php echo $j->kredit?></td><td><?php echo $j->kredit_value?></td></tr>
		<?php } else { ?>
		<tr><td></td><td></td><td></td><td><?php echo $j->transaksi?></td><td><?php echo $j->debit?></td><td><?php echo $j->debit_value?></td><td><?php echo $j->kredit?></td><td><?php echo $j->kredit_value?></td></tr>
		<?php
		}  
		?>
	<?php
		$voucher = $j->no_voucher;
	}//foreach
	?>
	<tbody>
		
	</tbody>
	</table>
	</div>
</div>
<script>
$(function() {
 
    $(".search_button").click(function() {
        // getting the value that user typed
        var searchString    = $("#search_box").val();
        // forming the queryString
        var data            = 'search='+ searchString;

        // if searchString is not empty
        if(searchString) {
            // ajax call
            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>jurnal/search",
                data: data,
                beforeSend: function(html) { // this happens before actual call
                    console.log('search');
                    $("#result").html(''); 
                    $("#searchresults").show();
                    $(".word").html(searchString);
                    $(".back").show();
               },
               success: function(html){ // this happens after we get results
                    $("#result").show();
                    $("#result").append(html);
              }
            });    
        }
        return false;
    });
});
</script>