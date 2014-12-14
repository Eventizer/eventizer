<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--[if IE 8]> <html class="no-js lt-ie9" lang="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'content_language')?>" dir="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'dir_language')?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'content_language')?>" dir="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'dir_language')?>"> <!--<![endif]-->

<head>
	<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_head.tpl.php'));?>
</head>
<body>
<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/user_menu.tpl.php'));?>

<div class="container">
	<div class="row box-padding">
       <?php if (isset($Result['sidebartype']) && $Result['sidebartype'] == 'left'):?>
    	   <div class="col-md-3">
    	       <?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/sidebar.tpl.php'));?>
    	   </div>
	   <?php endif;?>
	   
	   <div class="  <?php if (isset($Result['sidebartype'])):?>col-md-9 <?php else:?>col-md-12  <?php endif;?>">
	       <?=$Result['content']?>
	   </div>
	   
	   <?php if (isset($Result['sidebartype']) && $Result['sidebartype'] == 'right'):?>
    	   <div class="col-md-3">
    	       <?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/sidebar.tpl.php'));?>
    	   </div>
	   <?php endif;?>
	</div>
</div>

<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_footer.tpl.php'));?>

</body>
</html>