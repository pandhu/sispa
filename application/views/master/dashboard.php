<div class="row">
	<div class="base_url" style="display:none"><?php echo base_url()?></div>
	<!-- /.col-lg-12 -->
	<h2>Selamat Datang di Masteruser Area SISPA </h2><br/>
	<button type="button" class="btn btn-primary add-btn" data-toggle="modal">Tambah Event</button>
	<table class="table">
		<thead>
			<tr>
				<th>Event</th>
				<th>Penanggung Jawab</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$ii = 1; 
				foreach ($event as $ee) { ?>
				<tr>
					<td class="description-<?php echo $ee->id_event?>"><?php echo $ee->description?></td>
					<td class="pj-<?php echo $ee->id_event?>"><?php echo $ee->pj?></td>
					<td class="kabiro_ki-<?php echo $ee->id_event?>" style="display:none"><?php echo $ee->kabiro_ki?></td>
					<td class="auditor-<?php echo $ee->id_event?>" style="display:none"><?php echo $ee->auditor?></td>
					<td class="penyerahan-<?php echo $ee->id_event?>" style="display:none"><?php echo $ee->penyerahan?></td>
					<td class="penyelesaian-<?php echo $ee->id_event?>" style="display:none"><?php echo $ee->penyelesaian?></td>
					<td class="pj_keuangan-<?php echo $ee->id_event?>" style="display:none"><?php echo $ee->pj_keuangan?></td>
					<td class=""></td>
					<td>				
						<button type="button" class="btn btn-primary detil-btn" data-count="<?php echo $ee->id_event?>" data-toggle="modal">Detil</button>
					</td>
					<td><a class="btn btn-danger" href="">Delete</a></td>
				</tr>
			<?php 
			$ii++;
			}//foreach
			?>
		</tbody>
	</table>

</div>

	<div class="modal fade event-detil" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<h4 style="margin-left:20px">Event Detil</h4>
				<form  class="form-horizontal" style="margin:20px">
					<div class="form-group">
						<label for="jenis" class="col-sm-4 control-label">Nama Acara</label>
						<div class="col-sm-8">
							<input type="text" name="jenis" class="form-control" id="description" readonly />
						</div>
					</div>
					<div class="form-group">
						<label for="jenis" class="col-sm-4 control-label">Penanggung Jawab</label>
						<div class="col-sm-8">
							<input type="text" name="jenis" class="form-control" id="pj" readonly />
						</div>
					</div>
					<div class="form-group">
						<label for="jenis" class="col-sm-4 control-label">Penanggung Jawab Keuangan Acara</label>
						<div class="col-sm-8">
							<input type="text" name="jenis" class="form-control" id="pj_keuangan" readonly />
						</div>
					</div>
					<div class="form-group">
						<label for="jenis" class="col-sm-4 control-label">Partner of Audit Study Division </label>
						<div class="col-sm-8">
							<input type="text" name="jenis" class="form-control" id="kabiro_ki" readonly />
						</div>
					</div>
					<div class="form-group">
						<label for="jenis" class="col-sm-4 control-label">Auditor Penanggung Jawab</label>
						<div class="col-sm-8">
							<input type="text" name="jenis" class="form-control" id="auditor" readonly />
						</div>
					</div>
					<div class="form-group">
						<label for="jenis" class="col-sm-4 control-label">Tanggal Penyerahan</label>
						<div class="col-sm-8">
							<input type="text" name="jenis" class="form-control" id="penyerahan" readonly />
						</div>
					</div>
					<div class="form-group">
						<label for="jenis" class="col-sm-4 control-label">Tanggal Penyelesaian</label>
						<div class="col-sm-8">
							<input type="text" name="jenis" class="form-control" id="penyelesaian" readonly />
						</div>
					</div>
				</form>
				<div class="modal-footer">
		        <a href="" id="btn-jurnal" class="btn btn-primary">Jurnal</a>
		        <a href="" id="btn-bukubesar" class="btn btn-primary">Buku Besar</a>
		        <a href="" id="btn-catatan" class="btn btn-primary">Catatan</a>
		        <a href="" id="btn-neraca" class="btn btn-primary">Neraca</a>
		        <a href="" id="btn-labarugi" class="btn btn-primary">Labarugi</a>
		        <a href="" id="btn-topdf" class="btn btn-primary">To PDF</a>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		     </div>
			</div>
		</div>
	</div>

	<div class="modal fade add-event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<h4 style="margin-left:20px">Tambah Event</h4>
				<form  class="form-horizontal" style="margin:20px" method="POST" action="<?php echo base_url()?>masteruser/tambah_acara">
					<div class="form-group">
						<label for="description" class="col-sm-4 control-label">Nama Acara</label>
						<div class="col-sm-8">
							<input type="text" name="description" class="form-control" id="description" />
						</div>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah">

				</form>
				<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		     </div>
			</div>
		</div>
	</div>

	<div class="modal fade download-pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<h4 style="margin-left:20px">Download PDF</h4>
				<a href="<?php echo base_url()?>assets/pdfs/jurnal.pdf" id="btn-jurnal" class="btn btn-primary">Jurnal</a>
		        <a href="" id="btn-bukubesar" class="btn btn-primary">Buku Besar</a>
		        <a href="" id="btn-catatan" class="btn btn-primary">Catatan</a>
		        <a href="" id="btn-neraca" class="btn btn-primary">Neraca</a>
		        <a href="" id="btn-labarugi" class="btn btn-primary">Labarugi</a>
				<div class="modal-footer">
		     		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		     	</div>
			</div>
		</div>
	</div>

<script>
	$('.detil-btn').click(function(){
		var base_url = $('.base_url').html();
		console.log(base_url);
		var count = $(this).data('count');
		$('#description').val($('.description-'+count).html());
		$('#pj').val($('.pj-'+count).html());
		$('#pj_keuangan').val($('.pj_keuangan-'+count).html());
		$('#kabiro_ki').val($('.kabiro_ki-'+count).html());
		$('#auditor').val($('.auditor-'+count).html());
		$('#penyerahan').val($('.penyerahan-'+count).html());
		$('#penyelesaian').val($('.penyelesaian-'+count).html());
		$('#btn-jurnal').attr("href", base_url+"masteruser/detail/jurnal/"+count);
		$('#btn-bukubesar').attr("href", base_url+"masteruser/detail/buku_besar/"+count);
		$('#btn-catatan').attr("href", base_url+"masteruser/detail/catatan/"+count);
		$('#btn-neraca').attr("href", base_url+"masteruser/detail/neraca/"+count);
		$('#btn-labarugi').attr("href", base_url+"masteruser/detail/labarugi/"+count);
		$('#btn-topdf').attr("href", base_url+"masteruser/generatepdf/"+count);
		$('.event-detil').modal('show');
	});

	$('.add-btn').click(function(){
		$('.add-event').modal('show');
	});
	$('#btn-topdf').click(function(e){
		e.preventDefault();
		// Using the core $.ajax() method
		var urlgen = $(this).attr('href');
		$.ajax({
		 	
		    // The URL for the request
		    url: urlgen,
		 
		    type: "GET",
		    // Code to run regardless of success or failure
		    complete: function() {
		        $('.download-pdf').modal('show');
		    }
		});
	
	});
</script>