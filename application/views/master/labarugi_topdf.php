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
	<table class="table table-hover">
		<?php 
		$count = 0;
		foreach ($labarugi as $ll) { ?>
			<tr>
				<td><?php $nama="";
				for ($i=0; $i < $ll->indentasi; $i++) { 
					$nama = $nama.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				echo $nama.$ll->nama;
				?>
				</td>
				<td><?php $nama="";
				for ($i=0; $i < $ll->indentasi; $i++) { 
					$nama = $nama.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				echo $nama.$value[$count];
				?></td>
			</tr>
		<?php	
		$count++;
		} //foreach
		?>
	</table>
</div>
</body>