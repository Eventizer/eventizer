<div class="container">
	<div class="row pt-25">
		<div class="col-xs-12">
			<img src="<?=__design('images/general/logo.png')?>" alt="Eventizer" title="Eventizer" />
		</div>
		<div class="col-xs-12 text-center">
			<h1>Installation</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
	
			<div class="panel panel-warning">
			  <div class="panel-body">You will need to grant write permissions on any of the red-marked folders. You can do this by changing its username to your web server's username or by changing permissions with a CHMOD 777 on the displayed files/folders.</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><b>Checking folders permission</b></div>
		 		<div class="panel-body">
					<form action="<?php echo erLhcoreClassDesign::baseurl('install/install')?>/1" method="POST" role="form">
					<div class="row">
						<div class="col-xs-12">
			
							<table>
							    <tr>
							        <td>I can write to &quot;cache/cacheconfig&quot; directory</td>
							        <td><?php echo is_writable("cache/cacheconfig") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>I can write to &quot;cache/translations&quot; directory</td>
							        <td><?php echo is_writable("cache/translations") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>I can write to &quot;cache/userinfo&quot; directory</td>
							        <td><?php echo is_writable("cache/userinfo") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>I can write to &quot;cache/compiledtemplates&quot; directory</td>
							        <td><?php echo is_writable("cache/compiledtemplates") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>I can write to &quot;settings/&quot; directory</td>
							        <td><?php echo is_writable("settings/") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>I can write to &quot;var/storage&quot; directory</td>
							        <td><?php echo is_writable("var/storage") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>I can write to &quot;var/userphoto&quot; directory</td>
							        <td><?php echo is_writable("var/userphoto") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>I can write to &quot;var/tmpfiles&quot; directory</td>
							        <td><?php echo is_writable("var/tmpfiles") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							        <tr>
							        <td>I can write to &quot;var/media&quot; directory</td>
							        <td><?php echo is_writable("var/media") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>I can write to &quot;var/events&quot; directory</td>
							        <td><?php echo is_writable("var/events") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>I can write to &quot;var/media_static&quot; directory</td>
							        <td><?php echo is_writable("var/media_static") ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'?></td>
							    </tr>
							    <tr>
							        <td>Is the php_curl extension installed</td>
							        <td><?php echo extension_loaded ('curl' ) ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
							    </tr>
							    <tr>
							        <td>Is the mbstring extension installed</td>
							        <td><?php echo extension_loaded ('mbstring' ) ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
							    </tr>
							    <tr>
							        <td>Is the php-pdo extension installed</td>
							        <td><?php echo extension_loaded ('pdo_mysql' ) ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
							    </tr>
							    <tr>
							        <td>Is the gd extension installed</td>
							        <td><?php echo extension_loaded ('gd' ) ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
							    </tr>
							    <tr>
							        <td>Is the json extension detected</td>
							        <td><?php echo function_exists('json_encode') ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
							    </tr>
							    <tr>
							        <td>Is the bcmath extension detected</td>
							        <td><?php echo extension_loaded('bcmath') ? '<span class="label label-success">Yes</span>' : '<span class="label label-warning">No, GEO detection will be disabled</span>'; ?></td>
							    </tr>        
							    <tr>
							        <td>Minimum 5.4 PHP</td>
							        <td><?php echo (version_compare(PHP_VERSION, '5.4.0','<')) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>'; ?></td>
							    </tr>
							</table>
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