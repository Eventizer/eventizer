<section id="content">
	<div class="row">
		<div class="property-list full-listing clearfix list-layout" id="property-list">
			<div class="col-sm-12 col-md-12 the-title text-left">
				<h2><?=__t('event/list','Latest events')?></h2>
			</div>
			<div class="col-sm-12 col-md-12">
				<div class="filter-bar clearfix">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<?=__t('event/list','Showing')?>:<span><?=$pages->current_page*count($items)?></span> <?=__t('event/list','of')?> <span><?=$pages->items_total?></span> <?=__t('event/list','results')?>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6"></div>
					</div>
				</div>
			</div>
		<?php if ($pages->items_total > 0):?>	
			<?php foreach ($items as $item):?>
			    <?php include(erLhcoreClassDesign::designtpl('lhevent/parts/list_item.tpl.php'));?>
			<?php endforeach;?>
		<?php else:?>
			<div class="col-xs-12">
	     		 <?php $msg = __t('event/list','No events found')?>
	     		 <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_notification.tpl.php')); ?>
	     	</div>
		<?php endif;?>
		</div>
	</div>
	
	 <div class="row">
		<div class=" col-sm-12 col-md-12">
			   <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
	     </div>
	</div>
</section>
	