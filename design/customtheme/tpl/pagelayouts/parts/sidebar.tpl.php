<?php //@TODO need greater flexibility to insert sidebar?>
<?php if (isset($Result['sidebar'])) : ?>
	<?php switch ($Result['sidebar']) {
    	case 'event_list': ?>
            <?php include_once(erLhcoreClassDesign::designtpl('lhevent/sidebars/eventlist.tpl.php'));?>
      	<?php break; ?>
    	<?php case 'organizer_profile': ?>
            <?php include_once(erLhcoreClassDesign::designtpl('lhorganizer/sidebars/organizer_profile.tpl.php'));?>
      	<?php break; ?>
      	
      	<?php default: ?>
        <?php break; ?>   
           
      <?php } ?>
<?php else:?>
 <?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/sidebar_default.tpl.php'));?>
<?php endif; ?>
