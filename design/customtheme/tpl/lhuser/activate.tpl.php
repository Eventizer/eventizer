<div class="row">
	<div class="col-xs-12">
		<div class="form-signin-block ">
			<h1  class=" pb-15"><?=__t('user/activate','Account activation')?></h1>
			<div class="row">
				<div class="col-sm-12 text-left">
		         <?php if($userData !== false): ?>
                	 <?php $msg = __t('user/activate','Your account activated. Now you can log in')?>
                	 <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_notification.tpl.php'));?>
                	 <div class="text-center">
                	   <a href="<?=__url('user/login')?><?=(isset($d) && $d != '')?'/(d)/'.$d:''?>" class="btn btn-success btn-block" ><?=__t('modal/notlogged','Log in')?></a>
                	 </div>
                <?php else: ?>
                	  <?php $errors = array(__t('user/activate','Activate code not found or was used already'))?>
                	 <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
                <?php endif;?>
               
             </div>
			</div>

		</div>
	</div>
</div>



