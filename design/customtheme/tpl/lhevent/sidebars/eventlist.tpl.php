<section id="sidebar">
	<section id="aside-property-search">
		<div class="property-list-search aside">
			<div class="inner">
				<div id="accordion" class="panel-group">
					<div class="panel panel-default panel-search">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a href="#collapseOne" data-parent="#accordion" data-toggle="collapse"><?=__t('event/list','Refine Search')?></a>
							</h4>
						</div>
						<div class="panel-collapse collapse in" id="collapseOne">
							<div class="panel-body">
								<form role="form" action="<?=(isset($Result['sidebarData']['posturl']) && $Result['sidebarData']['posturl'] != '')?$Result['sidebarData']['posturl']:__url('event/list')?>" method="get" class="form-search clearfix">
							        <?php include_once(erLhcoreClassDesign::designtpl('lhevent/parts/sidebar/search.tpl.php'));?>
								</form>
							</div>
						</div>
					</div>
					<?php $url = __url('event/list')?>
				    <?php include_once(erLhcoreClassDesign::designtpl('lhevent/parts/sidebar/categories.tpl.php'));?>
					
				</div>
			</div>
		</div>
		
	</section>
</section>