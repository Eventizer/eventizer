<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?=__t('system/check','System status')?></h3>
		</div>
		<div class="box-body table-responsive">
		    <div class="row">
    		    <div class="col-md-6">
    			     <div class="dataTables_wrapper form-inline"><?=__t('system/check','Current system version')?>:&nbsp;<b><?=$version?></b></div>
    			</div>
			</div>
			<?php if ($version < $release->version/100):?>
    			<div class="dataTables_wrapper form-inline"><?=__t('system/check','New version')?>:&nbsp;<b><span class="badge bg-green"><?=$release->version/100?></span></b></div>
    			<hr />
    			<div><b><?=$release->name?></b></div>
    			<div class="dataTables_wrapper form-inline"><?=$release->description?></div>
    			<div class="dataTables_wrapper form-inline"><?=__t('system/check','Change log')?>:
    			     <div><?=$release->change_log?></div>
    			</div>
    			<br />
    			 <?=__t('system/check','More information how to upgrade view')?> <a class="btn btn-primary" href="http://eventizer.org/How-to-upgrade-Eventizer-13c.html" target="_blank"><?= __t('system/update','Update instructions')?></a>
    			
    		 <?php else:?>
    		      <br />
    		      <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?=__t('system/check','You have the system updated to the latest version. No new updates at this moment')?>
                   </div>
			 <?php endif;?>
    	    <hr />
    		<div class="row">
    			  <div class="col-md-12">
    			     <b><?=__t('system/check','Database structure check')?>:&nbsp;</b>
    			     <span id="status-db"><?=__t('system/timezone','Comparing current database structure, please wait...')?></span>
    			  </div>
    		</div>
    		
    		
    	   <script type="text/javascript">
            	var _lactq = _lactq || [];
            	_lactq.push({'f':'init_checkDBVersion','a':['']});
            </script>
			
		</div>

		<div class="box-header">
			<h3 class="box-title"><?=__t('system/check','Checking folders permission')?></h3>
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


