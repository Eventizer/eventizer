<div class="row box-padding pb-0">
    <div class="col-md-12">
        <div class="property-details box ">
             <div class="row ">
                 <div class="col-md-3 text-center">
                    <?php if($item->photo_thumb):?>
        					<img alt="<?=htmlspecialchars($item->title)?>" src="<?=$item->photo_thumb?>" />
        			<?php endif;?>
        		</div>
        		<div class="col-md-9">
        			<div class="title-bar single  clearfix">
						<h1><?=htmlspecialchars($item->title)?></h1>
						<i><?=htmlspecialchars($item->event_location)?></i>
					</div>
					<div class="event-start">
					     <div><?=__t('event/view','Start')?>:<i class="pl-5"><?=htmlspecialchars($item->start_date_front_long)?></i></div>
					     <?php if ($item->end_date_front_long):?>
					          <?=__t('event/view','End')?>:<i class="pl-5"><?=htmlspecialchars($item->end_date_front_long)?></i>
					     <?php endif;?>
					</div>
        		</div>
        	</div>
        </div>
    </div>
</div>
<div class="row box-padding pt-0">
	<div class="col-md-9">
	   <?=erLhcoreClassEventDispatcher::getInstance()->dispatch('event.event_view_top_additional_content_block',array());?>	
		<section id="content">
			<div class="row">
				<div class="property-list property-list-single grid-layout clearfix" id="property-list">
					<div class="col-sm-12 col-md-12">
						<div class="property-details box nopadding mb-0">
							<div class="panel_head2">
						           <h3><?=__t('event/view','Event details')?></h3>
						    </div>
						    <div class="p20">
								<div class="property-info">
									<?=$item->description?>
								</div>
								<?php if ($item->fb_link != ''):?>
								<div class="fb-link">
									<?=erLhcoreClassBBCode::make_clickable(htmlspecialchars($item->fb_link))?>
								</div>
								<?php endif?>
								
								<?php if ($item->tw_link != ''):?>
								<div class="tw-link">
									<?=erLhcoreClassBBCode::make_clickable(htmlspecialchars($item->tw_link))?>
								</div>
								<?php endif?>
								
								<?php if ($item->link != ''):?>
								<div class="link">
									<?=erLhcoreClassBBCode::make_clickable(htmlspecialchars($item->link))?>
								</div>
								<?php endif?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?=erLhcoreClassEventDispatcher::getInstance()->dispatch('event.event_view_additional_content_block',array());?>	
	</div>
	<div class="col-md-3">
	    <?php include(erLhcoreClassDesign::designtpl('lhevent/sidebars/eventview.tpl.php')); ?>
	</div>
</div>

<script type="text/javascript">
	var _lactq = _lactq || [];
	_lactq.push({'f':'init_single_page_map','a':['<?=htmlspecialchars($item->event_location)?>']});
</script>	