<!DOCTYPE html>

<html>
<head>
<title><?php if (isset($Result['path'])) : ?>
<?php 
$ReverseOrder = $Result['path'];
krsort($ReverseOrder);
foreach ($ReverseOrder as $pathItem) : ?><?php echo htmlspecialchars($pathItem['title']).' '?>&laquo;<?php echo ' ';endforeach;?>
<?php endif; ?> - Eventizer</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="icon" type="image/png" href="<?php echo erLhcoreClassDesign::design('images/favicon.ico')?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo erLhcoreClassDesign::design('images/favicon.ico')?>">
<meta name="Keywords" content="" />
<meta name="Description" content="<?php echo erConfigClassLhConfig::getInstance()->getOverrideValue( 'site', 'description' )?>" />
<meta name="robots" content="noindex, nofollow">
<meta name="copyright" content="Eventizer, eventizer.org">
<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_head_css.tpl.php'));?>


</head>
<body>

<div class="content-row">
    <div class="row">
        <div class="columns twelve pt10">
            <?php echo $Result['content']; ?>
        </div>
    </div>
</div>

</body>
</html>