<title><?php if (isset($Result['path'])):?><?php $ReverseOrder = $Result['path']; krsort($ReverseOrder);foreach ($ReverseOrder as $pathItem) : ?><?=htmlspecialchars($pathItem['title']).' '?>&laquo;<?php echo ' ';endforeach;?><?php endif; ?><?=erConfigClassLhConfig::getInstance()->getSetting( 'site', 'title' )?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" type="image/png" href="<?=erLhcoreClassDesign::design('images/favicon.ico')?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?=erLhcoreClassDesign::design('images/favicon.ico')?>">
<meta name="Keywords" content="" />
<meta name="Description" content="<?=erConfigClassLhConfig::getInstance()->getOverrideValue( 'site', 'description' )?>" />
<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_head_css.tpl.php'));?>
<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_head_js.tpl.php'));?>