<div class="row">
    <div class="col-xs-12">
        <div class="form-signin-block ">
            <h1><?=__t('user/forgotpassword','Password reminder')?></h1>
              <div class="row">
			     <div class="col-sm-12 text-left">
                    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
                 </div>
              </div>
                <form method="post" action="<?=__url('user/forgotpassword')?>">
                	<div class="form-group">
                	   <input type="text" name="Email" value="" class="form-control" placeholder="<?=__t('user/forgotpassword','Email')?>" required/>
                    </div>
                    
                	<input type="submit" name="Forgotpassword" class="btn btn-lg btn-primary btn-block" value="<?=__t('system/button','Restore password')?>" />
                </form>
            </div>
    </div>
</div>