<div class="col-md-12">
	<div class="box box-primary">
	    <div class="box-body table-responsive">
            <form method="post" action="<?=erLhcoreClassDesign::baseurl('system/edit')?>/<?=$systemconfig->identifier?>">
                <div class="box-body">
    				<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
    				<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
    				<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
                
                    
                    <div class="form-group">
				        <label><?=__t('systemconfig/edit','Identifier');?></label>
                        <input class="form-control" type="text" disabled="disabled" value="<?=htmlspecialchars($systemconfig->identifier);?>" />
                    </div>
                    
                    <?php if ( $systemconfig->type == erLhcoreClassModelSystemConfig::SITE_ACCESS_PARAM_ON ) : ?>
                    
                    
                    <?php foreach (erConfigClassLhConfig::getInstance()->getSetting('site','available_site_access') as $siteaccess) : 
                    $siteaccessOptions = erConfigClassLhConfig::getInstance()->getSetting('site_access_options',$siteaccess);	
                    ?>
                    <div class="form-group">
				        <label><?=erTranslationClassLhTranslation::getInstance()->getTranslation('systemconfig/edit','Values applies to');?> - <?=htmlspecialchars($siteaccess);?></label>
                        <input class="form-control" name="Value<?=$siteaccess?>" type="text" value="<?=isset($systemconfig->data[$siteaccess]) ? htmlspecialchars($systemconfig->data[$siteaccess]) : ''?>" />
                    </div>
                    <?php endforeach;?>
                    	
                    
                    <?php else : ?>
                    <input class="form-control" type="text" name="ValueParam" value="<?=htmlspecialchars($systemconfig->value);?>" />
                    <?php endif;?>
                 </div>
			     <div class="box-footer">
                    <input type="submit" class="btn btn-primary" name="UpdateConfig" value="<?=__t('system/edit','Update')?>"/>
                    <input type="submit" class="btn btn-primary" name="UpdateConfigAndExit" value="<?=__t('system/edit','Update and exit')?>"/>
                 </div>
            </form>
         </div>
      </div>
</div>