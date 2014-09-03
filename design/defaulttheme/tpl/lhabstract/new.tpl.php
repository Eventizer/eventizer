<h1><?=htmlspecialchars($object_trans['name'])?></h1>

<form method="post" enctype="multipart/form-data" action="<?=__url('abstract/new')?>/<?=$identifier?>">
	<?php include_once(erLhcoreClassDesign::designtpl('lhabstract/abstract_form.tpl.php'));?>
</form>