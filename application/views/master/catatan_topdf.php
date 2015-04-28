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
	<form method="post" action="<?php echo base_url()?>catatan/search" style="margin-top:10px">
		<div class="col-md-6">
			<div class="col-md-8">
				<div class='col-md-8'>
		    		<input type="text" name="search" id="search_box" class='form-control search_box' placeholder="catatan/no voucher"/>
		    	</div>
		    	<div class="col-md-4">
		   			<input type="submit" value="Search" class="form-control search_button" /><br />
				</div>
			</div>
			<a class="col-md-4 btn btn-default back" href='<?php echo base_url()?>catatan' style="display:none">Back</a>

		</div>
	</form>
	-->
	<div style="clear:both"></div>
	<div class="col-md-6">
		<div id="result">
		<table class="table table-catatan">
			<thead>
				<tr>
					<th>No Jurnal</th><th>Catatan</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($catatan as $c) {?>
				<tr><td><?php echo $c->no_jurnal?></td><td><?php echo $c->catatan?></td></tr>	
			<?php
				}//foreach 
			?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<script>
$(function() {
 
    $(".search_button").click(function() {
        // getting the value that user typed
        var searchString    = $("#search_box").val();
        // forming the queryString
        var data            = 'search='+ searchString;
       	console.log(data);
        // if searchString is not empty
        if(searchString) {
            // ajax call
            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>catatan/search",
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
              }
            });    
        }
        return false;
    });
});
</script>
</body>