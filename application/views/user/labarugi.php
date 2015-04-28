<div class="row">
	<h2>
		Labarugi
	</h2>
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