<div class="container" style="margin:60px auto;">
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<?php if($this->session->userdata('gagal_login')){?>
		<div class="alert alert-danger" role="alert"><?php echo $this->session->userdata('gagal_login')?></div>
		<?php
		$this->session->unset_userdata('gagal_login');
		}?>
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Please Sign In</h3>
			</div>
			<div class="panel-body">
			<form role="form" method="post" action="<?php echo base_url()?>login_master/auth">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="Username" name="username" type="text" autofocus>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password" name="password" type="password" value="">
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