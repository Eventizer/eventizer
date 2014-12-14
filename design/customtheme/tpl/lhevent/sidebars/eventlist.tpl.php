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
								<form role="form" action="<?=__url('event/list')?>" method="get" class="form-search clearfix">
									<div class="form-group col-lg-12">
										<label for="searchInput"><?=__t('event/list','Search Property')?></label> <input type="text" name="searchText" placeholder="<?=__t('event/list','Search')?>" id="searchInput" class="form-control" value="<?=(isset($Result['filterParams']))?$Result['filterParams']['input_form']->searchText:''?>" />
									</div>

									<div class="form-group col-lg-12">
										<button class="btn btn-flat-green" name="Submit" type="submit"><?=__t('event/list','Refine Search')?></button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<?php if(isset($Result['sidebarData']['categories']) && !empty($Result['sidebarData']['categories'])):?>
						<div class="panel panel-default panel-search">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><?=__t('event/list','Categories')?></a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse " >
								<div class="panel-body">
									<div class="checkbox-group">
										<?php foreach ($Result['sidebarData']['categories'] as $cat):?>
										<div class="checkbox">
											<a href="<?=__url('event/list')?><?=$Result['sidebarData']['append']?>/(category)/<?=$cat->id?>"><?=$cat->name?></a>
										</div>
										<?php endforeach;?>
									</div>
								</div>
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		
	</section>

</section>