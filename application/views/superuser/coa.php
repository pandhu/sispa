<div class="row">
	<button type="button" class="btn btn-primary input-btn" data-count="0" data-toggle="modal" style="margin-top:10px">Add New</button>
	<table class="table">
		<thead>
			<tr>
				<th>Nama</th><th>Kode</th><th>Jenis</th><th>Tipe</th><th>Saldo Normal</th><th>Indentasi</th><th>Edit</th><th>Delete</th>
			</tr>
		</thead>
		<?php 
		foreach ($coa as $c) { ?>
		<tr class="coa-<?php echo $c->id?>">

			<td class="nama-<?php echo $c->id?>" style="display:none"><?php echo $c->nama?></td>

			<td class="nama-value-<?php echo $c->id?>"><?php 
			$nama="";
			for ($i=0; $i < $c->indentasi; $i++) { 
				$nama = $nama.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			echo $nama.$c->nama?></td>
			<td class="kode-<?php echo $c->id?>"><?php echo $c->kode?></td>
			<td class="jenis-<?php echo $c->id?>"><?php echo $c->jenis?></td>
			<td class="tipe-<?php echo $c->id?>"><?php echo $c->tipe?></td>
			<td class="saldo-normal-<?php echo $c->id?>"><?php echo $c->saldo_normal?></td>
			<td class="indentasi-<?php echo $c->id?>"><?php echo $c->indentasi?></td>
			<td class="parent-<?php echo $c->id?>" style="display:none"><?php echo $c->parent?></td>
			<td>
				<button type="button" class="btn btn-primary edit-btn" data-count="<?php echo $c->id?>" data-toggle="modal">Edit</button>
			</td>
			<td>
				<button type="button" class="btn btn-danger delete-btn" data-count="<?php echo $c->id?>" data-toggle="modal">Delete</button>
			</td>
		</tr>

		<?php
		}//foreach
		?>
		<tbody>
			
		</tbody>
	</table>
	<!-- Large modal -->
	<div class="modal fade coa-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<h4 style="margin-left:20px">Edit COA</h4>
				<form  class="form-horizontal" style="margin:20px" method="POST" action="<?php echo base_url()?>coa/update">
					<input type="text" name="id" id="id-edit" style="display:none">

					<div class="form-group">
						<label for="nama" class="col-sm-2 control-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" id="nama-edit">
						</div>
					</div>
					<div class="form-group">
						<label for="kode" class="col-sm-2 control-label">Kode</label>
						<div class="col-sm-10">
							<input type="text" name="kode" class="form-control" id="kode-edit"/>
						</div>
					</div>
					<div class="form-group">
						<label for="jenis" class="col-sm-2 control-label">Jenis</label>
						<div class="col-sm-10">
							<input type="text" name="jenis" class="form-control" id="jenis-edit"/>
						</div>
					</div>

					<div class="form-group">
						<label for="saldo-normal" class="col-sm-2 control-label">Jenis</label>
						<div class="col-sm-10">
							<select name="jenis" class="form-control" id="jenis-edit">
								<option>Header</option>
								<option>Akun</option>
								<option>Jumlah</option>
							</select>

						</div>
					</div>

					<div class="form-group">
						<label for="saldo-normal" class="col-sm-2 control-label">Tipe</label>
						<div class="col-sm-10">
							<select name="tipe" class="form-control" id="tipe-edit">
								<option>Neraca</option>
								<option>Labarugi</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="saldo-normal" class="col-sm-2 control-label">Saldo Normal</label>
						<div class="col-sm-10">
							<select name="saldo-normal" class="form-control" id="saldo-normal-edit">
								<option>Debit</option>
								<option>Kredit</option>
							</select>

						</div>
					</div>
					<div class="form-group">
						<label for="parent" class="col-sm-2 control-label">Parent</label>
						<div class="col-sm-10">
							<select class="form-control " id="parent-edit" name="parent">
								<option value="None">None</option>
								<?php foreach ($coa as $c) { ?>
								<option value="<?php echo $c->nama?>"><?php echo $c->nama?></option>
								<?php	
								}?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="indentasi" class="col-sm-2 control-label">Indentasi</label>
						<div class="col-sm-10">
							<input type="text" name="indentasi" class="form-control" readonly 	id="indentasi-edit"/>
						</div>
					</div>
					
					<div class="form-group">
					    <div class="col-sm-offset-10 col-sm-2">
					      <button type="submit" class="btn btn-default">Save</button>
					    </div>
					</div>
  				</form>
			</div>
		</div>
	</div>

	<!-- Large modal -->
	<div class="modal fade coa-input" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<h4 style="margin-left:20px">Add COA</h4>
				<form  class="form-horizontal" style="margin:20px" method="POST" action="<?php echo base_url()?>coa/input">
					<input type="text" name="id" id="id-input" style="display:none">
					<div class="form-group">
						<label for="nama" class="col-sm-2 control-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" id="nama-input">
						</div>
					</div>
					<div class="form-group">
						<label for="kode" class="col-sm-2 control-label">Kode</label>
						<div class="col-sm-10">
							<input type="text" name="kode" class="form-control" id="kode-input"/>
						</div>
					</div>
					<div class="form-group">
						<label for="saldo-normal" class="col-sm-2 control-label">Jenis</label>
						<div class="col-sm-10">
							<select name="jenis" class="form-control" id="jenis-input">
								<option>Header</option>
								<option>Akun</option>
								<option>Jumlah</option>
							</select>

						</div>
					</div>
					
					<div class="form-group">
						<label for="saldo-normal" class="col-sm-2 control-label">Tipe</label>
						<div class="col-sm-10">
							<select name="tipe" class="form-control" id="tipe-input">
								<option>Neraca</option>
								<option>Labarugi</option>
							</select>

						</div>
					</div>
					<div class="form-group">
						<label for="saldo-normal" class="col-sm-2 control-label">Saldo Normal</label>
						<div class="col-sm-10">
							<select name="saldo-normal" class="form-control" id="saldo-normal-input">
								<option>Debit</option>
								<option>Kredit</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="parent" class="col-sm-2 control-label">Parent</label>
						<div class="col-sm-10">
							<select class="form-control" id="parent-input" name="parent">
								<option value="None">None</option>
								<?php foreach ($coa as $c) { ?>
								<option value="<?php echo $c->nama?>"><?php echo $c->nama?></option>
								<?php	
								}?>
							</select>
						</div>
					</div>
					<div class="form-group">
					    <div class="col-sm-offset-10 col-sm-2">
					      <button type="submit" class="btn btn-default">Save</button>
					    </div>
					</div>
  				</form>
			</div>
		</div>
	</div>

	<!-- Large modal -->
	<div class="modal fade coa-delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<h4 style="margin-left:20px">Delete COA</h4>
				<form  class="form-horizontal" style="margin:20px" method="POST" action="<?php echo base_url()?>coa/delete">
					<input type="text" name="id" id="id-delete" style="display:none">
					<div class="form-group">
						<label for="nama" class="col-sm-2 control-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" id="nama-delete">
						</div>
					</div>
					<div class="form-group">
						<label for="kode" class="col-sm-2 control-label">Kode</label>
						<div class="col-sm-10">
							<input type="text" name="kode" class="form-control" id="kode-delete"/>
						</div>
					</div>
					<div class="form-group">
						<label for="jenis" class="col-sm-2 control-label">Jenis</label>
						<div class="col-sm-10">
							<input type="text" name="jenis" class="form-control" id="jenis-delete"/>
						</div>
					</div>
					<div class="form-group">
						<label for="tipe" class="col-sm-2 control-label">Tipe</label>
						<div class="col-sm-10">
							<input type="text" name="tipe" class="form-control" id="tipe-delete"/>
						</div>
					</div>
					<div class="form-group">
						<label for="saldo-normal" class="col-sm-2 control-label">Saldo Normal</label>
						<div class="col-sm-10">
							<input type="text" name="saldo-normal" class="form-control" id="saldo-normal-delete"/>
						</div>
					</div>
					<div class="form-group">
						<label for="indentasi" class="col-sm-2 control-label">Indentasi</label>
						<div class="col-sm-10">
							<input type="text" name="indentasi" class="form-control" id="indentasi-delete"/>
						</div>
					</div>
					
					<div class="form-group">
					    <div class="col-sm-offset-10 col-sm-2">
					      <button type="submit" class="btn btn-danger">Delete</button>
					    </div>
					</div>
  				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.edit-btn').click(function(){
		var count = $(this).data('count');
		var nama, kode, jenis, tipe, indentasi, saldo_normal;
		//console.log($('.nama-'+count).html());
		$('#id-edit').val(count);
		$('#nama-edit').val($('.nama-'+count).html());
		$('#kode-edit').val($('.kode-'+count).html());
		$('#jenis-edit').val($('.jenis-'+count).html());
		$('#tipe-edit').val($('.tipe-'+count).html());
		$('#saldo-normal-edit').val($('.saldo-normal-'+count).html());
		$('#indentasi-edit').val($('.indentasi-'+count).html());
		$('#parent-edit').val($('.parent-'+count).html());
		$('.coa-edit').modal('show');
		console.log($('.parent-'+count).html());
	});

	$('.input-btn').click(function(){
		$('.coa-input').modal('show');
	});

	$('.delete-btn').click(function(){
		var count = $(this).data('count');
		var nama, kode, jenis, tipe, indentasi, saldo_normal;
		//console.log($('.nama-'+count).html());
		console.log(count);
		$('#id-delete').val(count);
		$('#nama-delete').val($('.nama-'+count).html());
		$('#kode-delete').val($('.kode-'+count).html());
		$('#jenis-delete').val($('.jenis-'+count).html());
		$('#tipe-delete').val($('.tipe-'+count).html());
		$('#saldo-normal-delete').val($('.saldo-normal-'+count).html());
		$('#indentasi-delete').val($('.indentasi-'+count).html());
		$('.coa-delete').modal('show');
	});
</script>