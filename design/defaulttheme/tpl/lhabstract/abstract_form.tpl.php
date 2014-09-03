<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>

<?php foreach ($object->getFields() as $fieldName => $attr) : ?>
	<?php if (!isset($attr['hide_edit'])) : ?>
		<?php if ($attr['type'] == 'checkbox') : ?>
		<label><?php echo erLhcoreClassAbstract::renderInput($fieldName, $attr, $object)?> <?php echo htmlspecialchars($attr['trans']);?><?php echo $attr['required'] == true ? ' *' : ''?><br/><br/></label>
		<?php else : ?>
		<label><?php echo htmlspecialchars($attr['trans']);?><?php echo $attr['required'] == true ? ' *' : ''?></label>
		<?php echo erLhcoreClassAbstract::renderInput($fieldName, $attr, $object)?>
		<?php endif;?>
	<?php endif;?>
<?php endforeach;?>

<br />

<ul class="button-group radius">
	<li><input type="submit" class="small button" name="SaveClient" value="<?=__t('system/button','Save')?>"/></li>
	<li><input type="submit" class="small button" name="UpdateClient" value="<?=__t('system/button','Update')?>"/></li>
	<li><input type="submit" class="small button" name="CancelAction" value="<?=__t('system/button','Cancel')?>"/></li>
</ul>