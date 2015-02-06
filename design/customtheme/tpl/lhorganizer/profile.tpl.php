<div class="text-center pb-25">
    <?php if ($item->has_photo):?>
        <img class="br" src="<?=$item->photow_150?>" alt="<?=htmlspecialchars($item->org_name)?>" />
    <?php endif;?>
    <h1 ><?=htmlspecialchars($item->org_name)?></h1>
    <?php if ($item->org_www != ''):?>
        <div><a  target="_blank" href="<?=$item->org_www?>"><?=htmlspecialchars($item->org_www)?></a></div>
    <?php endif;?>
    <?php if ($item->org_fb != ''):?>
        <div><a target="_blank" href="<?=$item->org_fb?>"><?=htmlspecialchars($item->org_fb)?></a></div>
    <?php endif;?>
    <?php if ($item->org_tw != ''):?>
        <div><a target="_blank" href="<?=$item->org_tw?>"><?=htmlspecialchars($item->org_tw)?></a></div>
    <?php endif;?>
    
    <?php if ($item->org_description != ''):?>
        <div class="text-justify"><?=$item->org_description?></div>
    <?php endif;?>
</div>

<section id="content">
	<div class="row">
		<div class="property-list full-listing clearfix list-layout" id="property-list">
			
			<div class="col-sm-12 col-md-12 the-title text-left">
			     <ul class="profile-tab">
				    <li <?php if($tab == 'live'):?>class="active"<?php endif;?>><a href="<?=__url('organizer/profile')?>/<?=$item->id?>/(tab)/live"><?=__t('event/list','Live events')?> (<?=$live_count?>)</a></li>
				    <li <?php if($tab == 'past'):?>class="active"<?php endif;?>><a href="<?=__url('organizer/profile')?>/<?=$item->id?>/(tab)/past"><?=__t('event/list','Past events')?> (<?=$past_count?>)</a></li>
				 </ul>
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
	