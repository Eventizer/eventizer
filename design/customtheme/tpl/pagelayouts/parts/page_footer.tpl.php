<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/page_footer_block.tpl.php'));?>

<script type="text/javascript" language="javascript" src="<?=erLhcoreClassDesign::designJS('js/jquery.js;js/bootstrap/bootstrap.min.js;js/core.js;js/app.js;js/system.js')?>"></script>
<?=isset($Result['additional_js']) ? $Result['additional_js'] : ''?>

<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/debug.tpl.php'));?>