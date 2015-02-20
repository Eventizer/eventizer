<div class="box-body">
    <div class="hide" id="db-status-updating">
    <?php $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('user/account','Updating...'); ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
    </div>
    
    <div  id="db-status-checked" class="box-body">
    		<ul class="list-unstyled">
    		<?php 
    		$hasError = false;
    		$queries = array();
    		foreach ($tables as $table => $status) :
    		$queries = array_merge($queries,$status['queries']);
    		$hasError = $status['error'] == true ? true : $hasError;
    		if ($status['error'] == true) : ?>
    			<li><div class="callout  <?php echo $status['error'] == false ? 'callout-info' : 'callout-danger'?>"><?php echo $table?> - <?php echo $status['status']?></div></li>
    		<?php endif; endforeach;?>
    		</ul>
    		<?php if ($hasError == false) : ?>
    			<label class="callout callout-info"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('update/statusdb','Your database does not require any updates')?></label>
    		<?php endif; ?>
    		
    		<?php if ($hasError) : ?>
    		<a class="btn btn-primary" onclick="app.updateDatabaseStructure(); return false;"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('update/statusdb','Update database')?></a>
    		<?php endif;?>
     </div>
     
	<?php if ( !empty($queries) ) : ?>
	   <br />
    	<div class="box box-solid">
        	<div class="box-header">
        	   <h3 class="box-title"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('update/statusdb','Queries which will be executed on update')?></h3>
        	</div>
        	<div class="box-body">
        		<ul class="list-unstyled">
        			<?php foreach ($queries as $query) : ?>
        				<li class="fs-12"><?php echo $query;?></li>
        			<?php endforeach; ?>
        		</ul>
        	</div>
    	</div>
	<?php endif; ?>

</div>
