<?php
	$this->assign('title','LAUDO Secure Example');
	$this->assign('nav','secureexample');

	$this->display('_Header.tpl.php');
?>

<div class="container">

	<?php if ($this->feedback) { ?>
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?php $this->eprint($this->feedback); ?>
		</div>
	<?php } ?>
	
	<!-- #### this view/tempalate is used for multiple pages.  the controller sets the 'page' variable to display differnet content ####  -->
	
	<?php if ($this->page == 'login') { ?>
	
		<div class="hero-unit">
			<h1>Login do Sistema</h1>
			<p>Informe o seu usuário e senha para autenticar-se no sistema. 
			<!-- The default credentials are <strong>demo/pass</strong> and <strong>admin/pass</strong>.--></p>
			<p>
				<!--a href="secureuser" class="btn btn-primary btn-large">Visit User Page</a>
				<a href="secureadmin" class="btn btn-primary btn-large">Visit Admin Page</a-->
				<?php if (isset($this->currentUser)) { ?>
					<a href="logout" class="btn btn-primary btn-large">Logout</a>
				<?php } ?>
			</p>
		</div>
	
		<form class="well" method="post" action="login">
			<fieldset>
			<legend>Entre com seu CPF ou CRM e a sua senha.</legend>
				<div class="control-group">
				<input id="username" name="username" type="text" placeholder="Usuário..." />
				</div>
				<div class="control-group">
				<input id="password" name="password" type="password" placeholder="Senha..." />
				</div>
				<div class="control-group">
				<button type="submit" class="btn btn-primary">Login</button>
				</div>
			</fieldset>
		</form>
	
	<?php } else { ?>
	
		<div class="hero-unit">
			<h1>Secure <?php $this->eprint($this->page == 'userpage' ? 'User' : 'Admin'); ?> Page</h1>
			<p>This page is accessible only to <?php $this->eprint($this->page == 'userpage' ? 'authenticated users' : 'administrators'); ?>.  
			You are currently logged in as '<strong><?php $this->eprint($this->currentUser->Username); ?></strong>'</p>
			<p>
				<a href="secureuser" class="btn btn-primary btn-large">Visit User Page</a>
				<a href="secureadmin" class="btn btn-primary btn-large">Visit Admin Page</a>
				<a href="logout" class="btn btn-primary btn-large">Logout</a>
			</p>
		</div>
	<?php } ?>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>