<section id="header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?=__url('/')?>">Eventizer</a>
					</div>
					<div class="collapse navbar-collapse" id="collapse">
						<ul class="nav navbar-nav navbar-left">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Property Pages </a>
							</li>
							<li><a href="about.html">About Us</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
						
						<ul class="nav navbar-nav navbar-right">
						<?php if (!erLhcoreClassUser::instance()->isLogged()): ?>
							<li><a class="btn btn-flat-info" href="<?=__url('user/login')?>" class="btn btn-flat-info"><?=__t('pagelayout/front','Sign In')?></a></li>
							<li><a class="btn btn-flat-warning" href="<?=__url('user/registration')?>" class="btn btn-flat-warning"><?=__t('pagelayout/front','Sign Up')?></a></li>
						<?php else: ?>
							<li><a class="btn btn-flat-info" href="<?=__url('user/account')?>"><?=__t('pagelayout/front','My account')?></a></li>
							<li><a class="btn btn-flat-warning" href="<?=__url('user/logout')?>"><?=__t('pagelayout/front','Logout')?></a></li>
						<?php endif; ?> 
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>

