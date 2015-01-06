<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-body table-responsive">
			<div class="dataTables_wrapper form-inline">
				<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
					
					<thead>
						<tr>
				        	<th width="20%"><?=__t('system/developer','Name')?></th>
					    	<th><?=__t('system/developer','Description')?></th>
				   			<th width="3%">&nbsp;</th>
						</tr>
					</thead>
			    	<tr>
			        	<td>
			        		<?=__t('system/developer','Clear cache')?>
				        </td>
				        <td>
			        		<?=__t('system/developer','This is a way to clear the cache.')?>
				        </td>
				        <td>
				        	<a class="btn btn-primary btn-sm" href="<?=__url('system/expirecache')?>" title="<?=__t('system/button','Clear cache')?>"><?=__t('system/button','Run')?><i class="fa fa-fw fa-arrow-right"></i></a>
				        </td>
				    </tr>
				    <tr>
			        	<td>
			        		<?=__t('system/developer','System check')?>
				        </td>
				        <td>
			        		<?=__t('system/developer','Make sure the application is properly configured and updated.')?>
				        </td>
				        <td>
				        	<a class="btn btn-primary btn-sm" href="<?=__url('system/check')?>" title="<?=__t('system/button','Clear cache')?>"><?=__t('system/button','Run')?><i class="fa fa-fw fa-arrow-right"></i></a>
				        </td>
				    </tr>
				</table>
			</div>
		</div>
		
	
		<?php if (!empty($extensions)):?>
    		<div class="box-header">
    			<h3 class="box-title"><?=__t('system/developer','Extensions')?></h3>
    		</div>
    		<div class="box-body table-responsive">
    			<div class="dataTables_wrapper form-inline">
    				<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
    					<thead>
    						<tr>
    				        	<th width="20%"><?=__t('system/developer','Name')?></th>
    					    	<th><?=__t('system/developer','Description')?></th>
    				   			<th width="3%">&nbsp;</th>
    						</tr>
    					</thead>
    					<?php foreach ($extensions as $extension):?>
        			    	<tr>
        			        	<td>
        			        		<?=$extension['name']?>
        				        </td>
        				        <td>
        			        		<?=$extension['description']?>
        			        		
        				        </td>
        				        <td>
        				            <?php if (isset($extension['settings_url']) && $extension['settings_url']):?>
        				        	   <a class="btn btn-primary btn-sm" href="<?= $extension['settings_url']?>" title="<?=__t('system/button','Settings')?>"><?=__t('system/button','Settings')?><i class="fa fa-fw fa-arrow-right"></i></a>
        				        	<?php endif;?>
        				        </td>
        				    </tr>
        				 <?php endforeach;?>
    				 
    				</table>
    			</div>
    		</div>
		<?php endif;?>
	</div>
</div>