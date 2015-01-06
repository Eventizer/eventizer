<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-body table-responsive">
			<div class="dataTables_wrapper form-inline">System version <?=$version?>v</div>
		</div>

		<div class="box-header">
			<h3 class="box-title">Checking folders permission</h3>
		</div>
		<div class="box-body table-responsive">
			<div class="dataTables_wrapper form-inline">
				<table class="table">
					<tr>
						<td>I can write to "cache/cacheconfig" directory</td>
						<td><?php echo is_writable("cache/cacheconfig") ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'?></td>
					</tr>
					<tr>
						<td>I can write to &quot;cache/translations&quot; directory</td>
						<td><?php echo is_writable("cache/translations") ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'?></td>
					</tr>
					<tr>
						<td>I can write to &quot;cache/userinfo&quot; directory</td>
						<td><?php echo is_writable("cache/userinfo") ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'?></td>
					</tr>
					<tr>
						<td>I can write to &quot;cache/compiledtemplates&quot; directory</td>
						<td><?php echo is_writable("cache/compiledtemplates") ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'?></td>
					</tr>
					<tr>
						<td>I can write to &quot;settings/&quot; directory</td>
						<td><?php echo is_writable("settings/") ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'?></td>
					</tr>
					<tr>
						<td>I can write to &quot;var/tmpfiles&quot; directory</td>
						<td><?php echo is_writable("var/tmpfiles") ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'?></td>
					</tr>
					<tr>
						<td>Is the php_curl extension installed</td>
						<td><?php echo extension_loaded ('curl' ) ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'; ?></td>
					</tr>
					<tr>
						<td>Is the mbstring extension installed</td>
						<td><?php echo extension_loaded ('mbstring' ) ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'; ?></td>
					</tr>
					<tr>
						<td>Is the php-pdo extension installed</td>
						<td><?php echo extension_loaded ('pdo_mysql' ) ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'; ?></td>
					</tr>
					<tr>
						<td>Is the gd extension installed</td>
						<td><?php echo extension_loaded ('gd' ) ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'; ?></td>
					</tr>
					<tr>
						<td>Is the json extension detected</td>
						<td><?php echo function_exists('json_encode') ? '<span class="badge bg-green">Yes</span>' : '<span class="badge bg-red">No</span>'; ?></td>
					</tr>
					<tr>
						<td> Your php version <?php echo phpVersion(); ?>. Minimum 5.4 PHP</td>
						<td><?php echo (version_compare(PHP_VERSION, '5.4.0','<')) ? '<span class="badge bg-red">No</span>' : '<span class="badge bg-green">Yes</span>'; ?></td>
					</tr>
				</table>
				<br>
			</div>
		</div>
	</div>
</div>