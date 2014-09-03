<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--[if IE 8]> <html class="no-js lt-ie9" lang="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'content_language')?>" dir="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'dir_language')?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'content_language')?>" dir="<?=erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'dir_language')?>"> <!--<![endif]-->

<head>
	<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_head.tpl.php'));?>
</head>
<body class="skin-blue">
<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_header.tpl.php'));?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/sidebar.tpl.php'));?>

<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
           	
			<?php //include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/top_menu.tpl.php'));?>
	
			<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/path.tpl.php'));?>
		<section class="content">              
			<div class="row">
				     <!-- Main content -->
			    	<?php echo $Result['content']; ?>
			</div>
		</section>
</div>			
			<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_author.tpl.php'));?>
	
	    </aside><!-- /.right-side -->

<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_footer.tpl.php'));?>

</body>
</html>