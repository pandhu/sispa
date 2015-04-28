<div class="row">
	<button type="button" class="btn btn-primary add-btn" data-user="0" data-toggle="modal" style="margin-top:10px">Add</button>

	<table class="table">
		<thead>
			<tr>
				<th>Username</th>
				<th>Userlevel</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($akun as $a ) {?>			
			<tr>
				<td id="<?php echo $a->username?>"><?php echo $a->username?></td>
				<td><?php if ($a->user_level == 1) echo 'User'; else echo 'Super User' ?></td>
				<td>				
					<button type="button" class="btn btn-primary delete-btn" data-user="<?php echo $a->username?>" data-toggle="modal">Delete</button>
				</td>
			</tr>

			<?php 
			}//foreach
			?>
		</tbody>
	</table>
	<div class="modal fade akun-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<h4 style="margin-left:20px">Tambah Akun</h4>
				<form  class="form-horizontal" style="margin:20px" method="POST" action="<?php echo base_url()?>akun/add">
					<input type="text" name="id" id="id-edit" style="display:none">
					<div class="form-group">
						<label for="nama" class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="text" name="username" class="form-control" id="nama-edit">
						</div>
					</div>
					<div class="form-group">
						<label for="kode" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="text" name="password" class="form-control" id="kode-edit"/>
						</div>
					</div>
					<div class="form-group">
						<label for="kode" class="col-sm-2 control-label">User Level</label>
						<div class="col-sm-10">
							<select class="form-control" name="user_level">
								<option value="0">Super User</option>
								<option value="1" selected>User</option>
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
	<div class="modal fade akun-delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<h4 style="margin-left:20px">Delete username</h4>
					<form  class="form-horizontal" style="margin:20px" method="POST" action="<?php echo base_url()?>akun/delete">
						<input type="text" name="id" id="id-delete" style="display:none">
						<div class="form-group">
							<label for="nama" class="col-sm-2 control-label" >Username</label>
							<div class="col-sm-10">
								<input readonly type="text" name="username" class="form-control" id="nama-delete">
							</div>
							<div class="form-group">
								<div class="col-sm-offset-10 col-sm-2">
									<button type="submit" class="btn btn-danger" style="margin-top:10px">Delete</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
</div>
<script>
	$('.add-btn').click(function(){
		$('.akun-add').modal('show');
	});

	$('.delete-btn').click(function(){
		var username = $(this).data('user');
		$('#nama-delete').val(username);
		$('.akun-delete').modal('show');
	});
</script>