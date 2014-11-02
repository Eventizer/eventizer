<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<?php include_once(erLhcoreClassDesign::designtpl('lhuser/form/user.tpl.php'));?>
            
<label><?=__t('user/account','Disabled')?></label> 
<input type="checkbox" value="on" name="UserDisabled" <?=($userData->disabled == 1) ? 'checked="checked"' : '' ?> />

<br />
<br />

<label><?=__t('user/account','User group')?></label>
<?php echo erLhcoreClassRenderHelper::renderCombobox( array (
	'input_name'     		=> 'DefaultGroup[]',	                 
	'selected_id'    		=> $userData->user_groups_id,                      
	'css_class'    			=> 'h100',                      
	'multiple' 		 		=> true,                     
	'list_function'  		=> 'erLhcoreClassModelGroup::getList',
	'list_function_params'  => array('filternot' => array('id' => 3))
)); ?>