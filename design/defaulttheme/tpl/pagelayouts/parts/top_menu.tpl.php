<?php $currentUser = erLhcoreClassUser::instance(); ?>
<?php $userData = $currentUser->getUserData(true); ?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
    	<li class="name">
      		<h1><a href="<?=__url('/')?>"><i class="fa fa-home fa-fw"></i>&nbsp; <?=__t('pagelayout/pagelayout','Home')?></a></h1>
    	</li>
     	<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    	<li class="toggle-topbar menu-icon"><a href="#"><span><?=__t('pagelayout/pagelayout','Menu')?></span></a></li>
  	</ul>

	<section class="top-bar-section">
		<ul class="left">
			<li class="divider"></li>
			<?php if ($currentUser->hasAccessTo('lharticleadmin','edit')) : ?>
				<li><a href="<?=__url('articleadmin/liststatic')?>"><?=__t('pagelayout/pagelayout','Static articles')?></a></li>
				<li class="divider"></li>
			<?php endif; ?>
			<?php if ($currentUser->hasAccessTo('lharticleadmin','edit')) : ?>
				<li><a href="<?=__url('articleadmin/managecategories')?>"><?=__t('pagelayout/pagelayout','Articles categories')?></a></li>
				<li class="divider"></li>
			<?php endif; ?>		
		</ul>
		<ul class="right">
		   	<?php if ($currentUser->hasAccessTo('lhsystem','use')) : ?>
				<li><a href="<?=__url('system/configuration')?>"><i class="fa fa-cog fa-fw"></i>&nbsp; <?=__t('pagelayout/pagelayout','Settings')?></a></li>
				<li class="divider"></li>
			<?php endif; ?>
			<li class="has-dropdown">
        		<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp; <?=htmlspecialchars($userData->name.' '.$userData->surname)?></a>
        		<ul class="dropdown">
          			<li><a href="<?=__url('user/account')?>"><i class="fa fa-user fa-fw"></i>&nbsp; <?=__t('pagelayout/pagelayout','Profile')?></a></li>
		   			<li class="divider"></li>
					<li><a href="<?=__url('user/logout')?>"><i class="fa fa-sign-out"></i>&nbsp; <?=__t('pagelayout/pagelayout','Logout')?></a></li>
        		</ul>
      		</li>
		</ul>
	</section>
</nav>

<?php unset($currentUser,$userData);?>