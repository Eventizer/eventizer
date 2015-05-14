<section id="sidebar" class="single-sidebar">
	<div class="row">
		<div class="aside-property-profile">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default panel-aside">
					
					<div class="panel-body">
					        <div id="msg"></div>
					        <?php if ($issaved == 1):?>
								<a href="<?=__url('event/savedevents')?>" id="save_event" class="btn btn-default btn-lg btn-block"><?=__t('event/view','View saved events')?></a>
					        <?php else:?>
    							 <a href="#" id="save_event" <?php if (erLhcoreClassUser::instance()->isLogged()): ?>onclick="app.saveEvent(<?=$item->id?>)"<?php endif;?> class="btn btn-default btn-lg btn-block"  data-toggle="modal" data-target="#save-event"><?=__t('event/view','Save This Event')?></a>
					        <?php endif;?>
							<div class="pt-15"><?=$saved?>&nbsp;<?=__t('event/view','saved this event')?></div>
							<div class="count_subview"></div>
                            <div class="summary_subview"></div>
					</div>
					<?php if (!erLhcoreClassUser::instance()->isLogged()): ?>
    					<?php $modal['header'] = __t('event/view','Save This Event')?>
    					<?php $modal['contnet'] = __t('event/view','Log in or sign up to save events you are interested in.')?>
    					<?php include_once(erLhcoreClassDesign::designtpl('lhkernel/modal_not_logged.tpl.php'));?>
					<?php endif;?>
				</div>
				
			
				<div class="panel panel-default panel-aside">
					<div class="panel-heading clearfix">
						<h4 class="panel-title"><?=__t('event/view','When & Where')?></h4>
					</div>
					<div class="panel-body">
							<div class="event-map">
								<div id="map_canvas" style="height:231px; width:223px;"></div>	
							</div>
						<div class="event-address">
							<?=htmlspecialchars($item->event_location)?>
						</div>
						<div class="event-date">
							     <?=htmlspecialchars($item->start_date_front_long)?>
    						     <?php if ($item->end_date_front_long):?> - <?=htmlspecialchars($item->end_date_front_long)?><?php endif;?>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default panel-aside">
					<div class="panel-heading clearfix">
						<h4 class="panel-title"><?=__t('event/view','Organizer')?></h4>
					</div>
					<div class="panel-body">
						<div class="organizer-info">
							<h4><?=htmlspecialchars($item->organizer_name_front)?></h4>
							<span><?=$item->organizer_description_front?></span>
							<hr />
							<div class="text-center"></div>
							<div><a href="<?=__url('organizer/profile')?>/<?=$item->org_id?>/(tab)/live"><?=__t('event/view','View organizer profile')?></a></div>
						</div>
					</div>
				</div>
				
				<ul class="list-group list-group-aside">
					<li class="list-group-item"><a href="#" onclick="window.print();return false;"><i class="fa fa-print mr10"></i><?=__t('event/vew','Print this page')?></a></li>
					<?=erLhcoreClassEventDispatcher::getInstance()->dispatch('event.event_view_sidebar_links',array('event' => $item));?>	
				</ul>
			</div>
		</div>
	</div>
</section>