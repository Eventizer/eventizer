<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<img src="" alt="Eventizer" title="Eventizer" />
		</div>
		<div class="col-xs-12 text-center">
			<h1>Installation step 2</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Database settings</b></div>
		 		<div class="panel-body">
					<form action="<?php echo erLhcoreClassDesign::baseurl('install/install')?>/2" method="POST" autocomplete="off">
						<div class="row">
							<div class="col-xs-12">
								<?php if (isset($errors)) : ?>
									<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
								<?php endif; ?>
								
								
								<table>
								    <tr>
								        <td>Username</td>
								        <td><input type="text" name="DatabaseUsername" required class="form-control" value="<?php echo isset($db_username) ? htmlspecialchars($db_username) : ''?>" /></td>
								    </tr>
								    <tr>
								        <td>Password</td>
								        <td><input type="password" name="DatabasePassword" required class="form-control" value="<?php echo isset($db_password) ? htmlspecialchars($db_password) : ''?>" /></td>
								    </tr>
								    <tr>
								        <td>Host</td>
								        <td><input type="text" name="DatabaseHost" required class="form-control" value="<?php echo isset($db_host) ? htmlspecialchars($db_host) : '127.0.0.1' ?>"></td>
								    </tr>
								    <tr>
								        <td>Port</td>
								        <td><input type="text" name="DatabasePort" required class="form-control" value="<?php echo isset($db_port) ? htmlspecialchars($db_port) : '3306'?>"></td>
								    </tr>
								    <tr>
								        <td>Database name</td>
								        <td><input type="text" name="DatabaseDatabaseName" required class="form-control" value="<?php echo isset($db_name) ? htmlspecialchars($db_name) : ''?>"></td>
								    </tr>
								</table>
								<br>
							</div>
						</div>
					
						<div class="row">
							<div class="col-xs-12">
								<br />
								<input type="submit" class="btn btn-primary" value="Next" name="Install" />
							</div>
						</div>
					
					</form>
				</div>
			</div>
		</div>
	</div>
</div>