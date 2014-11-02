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
	       <?=$Result['content']?>
	 
</div>

<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_footer.tpl.php'));?>

</body>
</html>