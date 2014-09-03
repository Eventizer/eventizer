<h1><?=__t('system/configuration','System configuration')?></h1>

<?php $currentUser = erLhcoreClassUser::instance(); ?>

<div class="row">
	<div class="columns small-6">
		<fieldset>
			<legend><?=__t('system/configuration','Settings')?></legend>
			<ul class="side-nav">
		    <?php if ($currentUser->hasAccessTo('lhsystem','configuresmtp')) : ?>
		    	<li><a href="<?=__url('system/smtp')?>"><?=__t('system/configuration','SMTP settings')?></a></li>
		    <?php endif; ?>	
		    <?php if ($currentUser->hasAccessTo('lhabstract','use')) : ?>
		    	<li><a href="<?=__url('abstract/list')?>/EmailTemplate"><?=__t('system/configuration','Email templates')?></a></li>
		    	<li><a href="<?=__url('abstract/list')?>/UrlAlias"><?=__t('system/configuration','Url alias')?></a></li>
		    	<li><a href="<?=__url('abstract/list')?>/Country"><?=__t('system/configuration','Countrys')?></a></li>
		     <?php endif; ?> 
			</ul>
		</fieldset>
	</div>
	<div class="columns small-6">
		<fieldset>
			<legend><?=__t('system/configuration','Users and their permissions')?></legend>
			<ul class="side-nav">
			    <?php if ($currentUser->hasAccessTo('lhuseradmin','list')) : ?>
			    	<li><a href="<?=__url('useradmin/list')?>"><?=__t('system/configuration','Users')?></a></li>
			    <?php endif; ?>
			    <?php if ($currentUser->hasAccessTo('lhuseradmin','grouplist')) : ?>
			    	<li><a href="<?=__url('useradmin/grouplist')?>"><?=__t('system/configuration','List of groups')?></a></li>
			    <?php endif; ?>
			    <?php if ($currentUser->hasAccessTo('lhpermission','list')) : ?>
			    	<li><a href="<?=__url('permission/roles')?>"><?=__t('system/configuration','List of roles')?></a></li>
			    <?php endif; ?>
			</ul>
		</fieldset>
	</div>
</div>

<hr />

<div class="row">
	<div class="columns small-6 end">
		<fieldset>
			<legend><?=__t('system/configuration','Other')?></legend>
			<ul class="side-nav">
				<?php if ($currentUser->hasAccessTo('lhsystem','expirecache')) : ?>
					<li><a href="<?=__url('system/expirecache')?>"><?=__t('pagelayout/pagelayout','Clean cache')?></a></li>
				<?php endif; ?>
			</ul>
		</fieldset>
	</div>
</div>