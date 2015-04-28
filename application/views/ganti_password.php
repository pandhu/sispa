<div class="container" style="margin:0 auto;">
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<?php if($this->session->userdata('gagal_ganti')){?>
		<div class="alert alert-danger" role="alert"><?php echo $this->session->userdata('gagal_ganti')?></div>
		<?php
		$this->session->unset_userdata('gagal_ganti');
		}?>
		<?php if($this->session->userdata('berhasil_ganti')){?>
		<div class="alert alert-success" role="alert"><?php echo $this->session->userdata('berhasil_ganti')?></div>
		<?php
		$this->session->unset_userdata('berhasil_ganti');
		}?>
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Ganti Password</h3>
			</div>
			<div class="panel-body">
			<form role="form" method="post" action="<?php echo base_url()?>ganti_password/ganti">
					<fieldset>
						<div class="form-group">
							<input class="form-control" name="username" type="text" readonly value="<?php echo $user_data['username']?>">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password Lama" name="password-old" type="password" value="" autofocus required	> 
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password Baru" name="password-new" type="password" value="" required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Konfirmasi" name="password-confirm" type="password" value="" required>
						</div>
						<!-- Change this to a button or input when using this as a form -->
						<button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
</div>