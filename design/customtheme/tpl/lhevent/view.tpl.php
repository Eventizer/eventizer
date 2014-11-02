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
							<i><?=htmlspecialchars($item->address)?></i>
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
		<section id="content">
			<div class="row">
				<div class="property-list property-list-single grid-layout clearfix" id="property-list">
					<div class="col-sm-12 col-md-12">
						<div class="property-details box nopadding">
							<div class="panel_head2">
						           <h3><?=__t('event/view','Event details')?></h3>
						    </div>
						    <div class="p20">
								<div class="property-info">
									<?=$item->description?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3">
		<section id="sidebar" class="single-sidebar">
			<div class="row">
				<div class="aside-property-profile">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="panel panel-default panel-aside">
							<div class="panel-heading clearfix">
								<h4 class="panel-title"><?=__t('event/view','When & Where')?></h4>
							</div>
							<div class="panel-body">
									<div class="event-map">
    									<div id="map_canvas" style="height:231px; width:223px;"></div>	
									</div>
								<div class="event-address">
									<?=htmlspecialchars($item->address)?>
								</div>
								<div class="event-date">
									     <?=htmlspecialchars($item->start_date_front_long)?>
            						     <?php if ($item->end_date_front_long):?> - <?=htmlspecialchars($item->end_date_front_long)?>
            						     <?php endif;?>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default panel-aside">
							<div class="panel-heading clearfix">
								<h4 class="panel-title"><?=__t('event/view','Organizer')?></h4>
							</div>
							<div class="panel-body">
								<div class="organizer-info">
									<h4><?=htmlspecialchars($item->organizer_name)?></h4>
									<span><?=htmlspecialchars($item->organizer_description)?></span>
								</div>
							</div>
						</div>
						
						<ul class="list-group list-group-aside">
							<li class="list-group-item"><a href="#"><i class="fa fa-print mr10"></i>Print this page</a></li>
						</ul>
						
					
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<script type="text/javascript">
	var _lactq = _lactq || [];
	_lactq.push({'f':'init_single_page_map','a':[52, 22]});
</script>	