<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>

<?php foreach ($object->getFields() as $fieldName => $attr) : ?>
	<?php if (!isset($attr['hide_edit'])) : ?>
		<div class="form-group">
		<?php if ($attr['type'] == 'checkbox') : ?>
		<label><?php echo erLhcoreClassAbstract::renderInput($fieldName, $attr, $object)?> <?php echo htmlspecialchars($attr['trans']);?><?php echo $attr['required'] == true ? ' *' : ''?><br/><br/></label>
		<?php else : ?>
		<label><?php echo htmlspecialchars($attr['trans']);?><?php echo $attr['required'] == true ? ' *' : ''?></label>
		<?php echo erLhcoreClassAbstract::renderInput($fieldName, $attr, $object)?>
		<?php endif;?>
		</div>
	<?php endif;?>
<?php endforeach;?>

<br />

