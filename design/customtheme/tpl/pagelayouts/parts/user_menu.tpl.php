<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name"><h1><a href="<?=__url('/')?>">Home</a></h1></li>
		<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li> 
	 </ul>	 
	<section class="top-bar-section">
		<ul class="right"> 
			<?php if (erLhcoreClassUser::instance()->isLogged()): ?>				
				<li><a href="<?=__url('user/account')?>"><?=__t('user/login','My account')?></a></li>
 				<li class="divider"></li>
				<li><a href="<?=__url('user/logout')?>"><?=__t('user/login','Logout')?></a></li>
			<?php else: ?>
				<li><a href="<?=__url('user/registration')?>"><?=__t('user/login','Registration')?></a></li>
				<li class="divider"></li>
				<li><a href="<?=__url('user/login')?>"><?=__t('user/login','Login')?></a></li>
			<?php endif; ?> 
		</ul>
	</section> 	   
</nav>