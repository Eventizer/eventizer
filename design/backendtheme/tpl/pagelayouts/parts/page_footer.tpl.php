<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script type="text/javascript" src="<?=erLhcoreClassDesign::designJS('js/jquery-ui-1.10.3.min.js;js/bootstrap.min.js;js/AdminLTE/app.js;js/core.js;js/app.js;js/system.js;js/bootstrap/bootstrap-datepicker.js', false)?>"></script>

<?=isset($Result['additional_js']) ? $Result['additional_js'] : ''?>

<?php include_once(erLhcoreClassDesign::designtpl('pagelayouts/parts/debug.tpl.php'));?>