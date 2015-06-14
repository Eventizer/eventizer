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
						<a href="<?=$url?><?=$Result['sidebarData']['append']?>/(category)/<?=$cat->id?>"><?=$cat->name?></a>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
<?php endif;?>