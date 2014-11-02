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
						    <?php foreach (erLhcoreClassModelArticleCategory::getList(array('limit'=>5,'sort'=>'pos DESC', 'filter'=>array('type'=>1,'parent_id'=>0))) as $category):?>
							<li><a href="<?=$category->url_path?>"><?=$category->name?></a></li>
							<?php endforeach;?>
						</ul>
						
						<?php /*<ul class="nav navbar-nav navbar-right">
						<?php if (!erLhcoreClassUser::instance()->isLogged()): ?>
							<li><a class="btn btn-flat-info" href="<?=__url('user/login')?>" class="btn btn-flat-info"><?=__t('pagelayout/front','Sign In')?></a></li>
							<li><a class="btn btn-flat-warning" href="<?=__url('user/registration')?>" class="btn btn-flat-warning"><?=__t('pagelayout/front','Sign Up')?></a></li>
						<?php else: ?>
							<li><a class="btn btn-flat-info" href="<?=__url('user/account')?>"><?=__t('pagelayout/front','My account')?></a></li>
							<li><a class="btn btn-flat-warning" href="<?=__url('user/logout')?>"><?=__t('pagelayout/front','Logout')?></a></li>
						<?php endif; ?> 
						</ul>*/?>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>

