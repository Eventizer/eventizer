<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--[if IE 8]> <html class="no-js lt-ie9" lang="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'content_language')?>" dir="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'dir_language')?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'content_language')?>" dir="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'dir_language')?>"> <!--<![endif]-->

<head>
	<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_head.tpl.php'));?>
</head>
<body>

<div class="content-row">
	<div class="row">
		<div class="columns large-12">
	
			<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/top_menu.tpl.php'));?>
	
			<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/path.tpl.php'));?>
	
			<div class="row">	
				 <?php if (isset($Result['sidemenu'])) : ?>
				 	<div class="columns large-2">
						<?php switch ($Result['sidemenu']) {
				   	    	case 'user': ?>
		    		       		<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/sidemenu/user.tpl.php')); ?>
		    	    	      	<?php break; ?>
		    	          	<?php default:
		    	          		break;
		    	          } ?>
				 	</div>
				 <?php endif; ?>	
			    <div class="columns <?=(isset($Result['sidemenu'])) ? 'large-10' : 'large-12' ?>">
			    	<?php echo $Result['content']; ?>
			    </div>
			</div>
	
			<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_author.tpl.php'));?>
	
		</div>
	</div>
</div>

<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_footer.tpl.php'));?>

</body>
</html>