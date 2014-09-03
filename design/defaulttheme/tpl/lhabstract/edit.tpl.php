<h1><?=__t('system/buttons','Edit')?> - <?=htmlspecialchars($object_trans['name'])?></h1>

<form enctype="multipart/form-data" action="<?=__url('abstract/edit')?>/<?=$identifier?>/<?=$object->id?>" method="post">
	<?php include_once(erLhcoreClassDesign::designtpl('lhabstract/abstract_form.tpl.php'));?>
</form>