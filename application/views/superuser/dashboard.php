<div class="row">
	<!-- /.col-lg-12 -->
	<h2>Selamat Datang di Superuser Area SISPA </h2><br/>
	<div class="row">
		<div class="table-wrapper col-md-6">
			<form method="POST" action="<?php echo base_url()?>superuser/save_event_detail">
				<table class="table ">
					<tr>
						<td>Acara</td>
						<td><input class="form-control" name="description" value="<?php echo $event_data->description?>"/></td>
					</tr>

					<tr>
						<td>Support</td>
						<td><input class="form-control" name="support" value="<?php echo $event_data->support?>"/></td>
					</tr>
					<tr>
						<td>Penanggung Jawab</td>
						<td><input class="form-control" name="pj" value="<?php echo $event_data->pj?>"/></td>
					</tr>
					<tr>
						<td>Partner of Audit Study Division	</td>
						<td><input class="form-control" name="kabiro_ki" value="<?php echo $event_data->kabiro_ki?>"/></td>
					</tr>
					<tr>
						<td>Auditor Penanggung Jawab</td>
						<td><input class="form-control" name="auditor" value="<?php echo $event_data->auditor?>"/></td>
					</tr>
					<tr>
						<td>Tanggal Penyerahan</td>
						<td>
							<div class="form-group">
								<div class='input-group date' id='penyerahan'>
									<input type='text' name="penyerahan" value="<?php echo $event_data->penyerahan?>" class="date-input form-control" data-date-format="YYYY/MM/DD" placeholder="Tanggal Transaksi"/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>Tanggal Penyelesaian</td>
						<td>
							<div class="form-group">
								<div class='input-group date' id='penyelesaian'>
									<input type='text' name="penyelesaian" value="<?php echo $event_data->penyelesaian?>" class="date-input form-control" data-date-format="YYYY/MM/DD" placeholder="Tanggal Transaksi"/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>Paneanggung Jawab Keuangan Acara</td>
						<td><input class="form-control" name="pj_keuangan" value="<?php echo $event_data->pj_keuangan?>" /></td>
					</tr>
				</table>
				<input class="btn" type="submit" value="Save" style="float:right; margin-right: 10px;"/>
			</form>
		</div>
	</div>
</div>
<script>
	$(function () {
		$('#penyerahan').datetimepicker({
			pickTime: false
		});
		$('#penyelesaian').datetimepicker({
			pickTime: false
		});
	});
</script>