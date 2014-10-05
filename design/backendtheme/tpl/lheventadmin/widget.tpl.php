<div class="col-xs-12">
    <div class="box  box-primary">
      
       <div class="box-body table-responsive">
       
            <form enctype="multipart/form-data" action="<?=__url('eventadmin/widget')?>" method="post" autocomplete="off">
    			<div class="box-body">
    			    <?php include_once(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
    				<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
    				<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
    				<?php include_once(erLhcoreClassDesign::designtpl('lheventadmin/form/widget.tpl.php'));?>
    			</div>
    			<div class="box-footer">
    				<input type="submit" class="btn btn-primary" name="saveAction" value="<?=__t('system/button','Save')?>"/>
    				<input type="submit" class="btn btn-default" name="cancelAction" value="<?=__t('system/button','Cancel')?>"/>
    			</div>
    		</form>
                                            
        </div><!-- /.box-body -->
     </div>
</div>