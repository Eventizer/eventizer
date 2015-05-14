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
						<a class="navbar-brand" href="<?=__url('/')?>"><img height="30" src="<?=erLhcoreClassDesign::design('images/logo.png')?>" alt="<?=erConfigClassLhConfig::getInstance()->getOverrideValue( 'site', 'title' )?>" title="<?=erConfigClassLhConfig::getInstance()->getOverrideValue( 'site', 'title' )?>"/></a>
					</div>
					<div class="collapse navbar-collapse" id="collapse">
						<ul class="nav navbar-nav navbar-left">
						    <?php foreach (erLhcoreClassModelArticleCategory::getList(array('limit'=>5,'sort'=>'pos DESC', 'filter'=>array('type'=>1,'parent_id'=>0))) as $category):?>
							<li><a href="<?=$category->url_path?>"><?=$category->name?></a></li>
							<?php endforeach;?>
						</ul>
						
						<?php if (erLhcoreClassUser::instance()->hasAccessTo('lhuser','authenticate')) : ?>	
    						<ul class="nav navbar-nav navbar-right">
    						<?php if (!erLhcoreClassUser::instance()->isLogged()): ?>
    							<li><a class="btn btn-flat-info" href="<?=__url('user/login')?>" class="btn btn-flat-info"><?=__t('pagelayout/front','Sign In')?></a></li>
    						<?php else: ?>
    							<li class="dropdown">
    							  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=erLhcoreClassUser::instance()->getUserData(true)?><b class="caret"></b></a>
    							   <ul class="dropdown-menu">
                	                    <li><a href="<?=erLhcoreClassDesign::baseurl('event/myevents')?>"><?=__t('pagelayout/front','My events');?></a></li>
                	                  <li class="divider"></li>
                	                  <li><a href="<?=__url('user/editaccount')?>"><?=__t('pagelayout/front','My account')?></a></li>
                	                  <li><a href="<?=__url('user/logout')?>"><?=__t('pagelayout/front','Logout')?></a></li>
                	                </ul>
    							</li>
    						<?php endif; ?> 
    					       	<?php if (erLhcoreClassUser::instance()->hasAccessTo('lhevent','create')) : ?>	
    						      <li><a class="btn btn-flat-warning" href="<?=__url('event/create')?>"><?=__t('pagelayout/front','Create Event')?></a></li>
    						    <?php endif; ?>
    						</ul>
						<?php endif;?>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>

