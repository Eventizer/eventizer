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
								<form role="form" action="<?=__url('event/myevents')?>" method="get" class="form-search clearfix">
							        <?php include_once(erLhcoreClassDesign::designtpl('lhevent/parts/sidebar/search.tpl.php'));?>
								</form>
							</div>
						</div>
					</div>
					<?php $url = __url('event/myevents')?>
				    <?php include_once(erLhcoreClassDesign::designtpl('lhevent/parts/sidebar/categories.tpl.php'));?>
					
				</div>
			</div>
		</div>
		
	</section>

</section>