<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url()?>favicon.ico">

  <title><?php echo $title?> | SI SPA</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Custom styles for this template -->
      <link href="carousel.css" rel="stylesheet">
    </head>
    <body>
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
</body>