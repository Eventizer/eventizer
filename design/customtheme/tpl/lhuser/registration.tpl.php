<div class="row">
    <div class="col-xs-12">
        <div class="form-signin-block ">
            <h1><?=__t('user/registration','Sign up')?></h1>
              <div class="row pb-15">
			     <div class="col-sm-12 text-center">
                     <span class="pr-5"><?=__t('user/login','Have account?')?></span>&nbsp;<a  href="<?=erLhcoreClassDesign::baseurl('user/login')?>"><?=__t('user/login','Log in')?></a>
                 </div>
              </div>
              <div class="row">
			     <div class="col-sm-12 text-left">
                    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
                    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
                 </div>
              </div>
            <form action="<?=__url('user/registration')?>" method="post" autocomplete="off">
            	
            	<div class="row">
            	    <div class="columns large-12">
            	    	<?php include_once(erLhcoreClassDesign::designtpl('lhuser/form/user.tpl.php'));?>
            	    </div>
            	</div>
            	
            	<input type="submit" class="btn btn-lg btn-primary btn-block" name="registerAction" value="<?=__t('system/button','Confirm')?>"/>
            	
            </form>
        </div>
    </div>
</div>