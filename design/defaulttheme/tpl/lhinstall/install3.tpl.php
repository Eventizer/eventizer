<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<img src="" alt="Eventizer" title="Eventizer" />
		</div>
		<div class="col-xs-12 text-center">
			<h1>Installation step 3</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Initial application settings</b></div>
		 		<div class="panel-body">
                    <form action="<?php echo erLhcoreClassDesign::baseurl('install/install')?>/3" method="post" autocomplete="off" >
                    
                    <?php if (isset($errors)) : ?>
                    	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
                    <?php endif; ?>
                    
                    <table>
                        <tr>
                            <td>Admin username*</td>
                            <td><input type="text" name="AdminUsername" required class="form-control" value="<?php isset($admin_username) ? print htmlspecialchars($admin_username) : ''?>" /></td>
                        </tr>
                        <tr>
                            <td>Admin password*</td>
                            <td><input type="password" name="AdminPassword" required class="form-control" value="" /></td>
                        </tr>
                        <tr>
                            <td>Admin password repeat*</td>
                            <td><input type="password" name="AdminPassword1" required class="form-control" value="" /></td>
                        </tr>
                        <tr>
                            <td>E-mail*</td>
                            <td><input type="text" name="AdminEmail" required class="form-control" value="<?php isset($admin_email) ? print htmlspecialchars($admin_email) : ''?>"></td>
                        </tr>
                        <tr>
                            <td>Your name</td>
                            <td><input type="text" name="AdminName"  class="form-control" value="<?php isset($admin_name) ? print htmlspecialchars($admin_name) : ''?>"></td>
                        </tr>
                        <tr>
                            <td>Your surname</td>
                            <td><input type="text" name="AdminSurname"  class="form-control" value="<?php isset($admin_surname) ? print htmlspecialchars($admin_surname) : ''?>"></td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Finish installation" name="Install">
                    <br /><br />
                    
                    </form>
                   </div>
			</div>
		</div>
	</div>
</div>