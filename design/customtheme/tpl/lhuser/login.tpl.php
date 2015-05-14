<div class="row">
    <div class="col-xs-12">
        <div class="form-signin-block ">
            <h1><?=__t('user/login','Log in')?></h1>
              <div class="row pb-15">
			     <div class="col-sm-12 text-center">
                     <a  href="<?=__url('user/registration')?><?=isset($redirect_url)?'/(d)/'.$redirect_url:''?>"><?=__t('user/login','Or, sign up')?></a>
                 </div>
              </div>
              <div class="row">
			     <div class="col-sm-12 text-left">
                    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
                 </div>
              </div>
            <form method="post" action="<?=__url('user/login')?><?=isset($redirect_url)?'/(d)/'.$redirect_url:''?>">
             <div class="form-group"><input required placeholder="<?=erTranslationClassLhTranslation::getInstance()->getTranslation('user/login','Username');?>" class="form-control" type="text" name="Username" value="<?=$Username?>" /></div>
				 <div class="form-group"><input required placeholder="<?=erTranslationClassLhTranslation::getInstance()->getTranslation('user/login','Password');?>" class="form-control" type="password" name="Password" value="" /></div>
				 <div class="form-group">
				    <div class="row">
				        <div class="col-sm-7">
        				 	<label class="checkbox">
        		          		<input type="checkbox" name='remember' value="1" <?php if($remember == 1):?>checked<?php endif;?>> <?=erTranslationClassLhTranslation::getInstance()->getTranslation('user/login','Remember me');?>
        		        	</label>
        		        </div>
        		        <div class="col-sm-5">
        		              <input class="btn btn-lg btn-primary btn-block" type="submit" value="<?=erTranslationClassLhTranslation::getInstance()->getTranslation('user/login','Login');?>" name="Login" />
        		        </div>
		        	</div>
		        </div>
		         <div class="row">
			         <div class="col-sm-12 text-left">
				        <a class="text-left" href="<?=erLhcoreClassDesign::baseurl('user/forgotpassword')?>"><?=erTranslationClassLhTranslation::getInstance()->getTranslation('user/login','Password remind')?></a>
				     </div>
				 </div>
            </form>
        </div>
    </div>
</div>