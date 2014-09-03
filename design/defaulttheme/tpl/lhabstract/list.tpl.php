<h1><?=htmlspecialchars($object_trans['name'])?></h1>

<?php if ($pages->items_total > 0) : ?>
	<table cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr>
	    	<?php foreach ($fields as $field) : ?>
	    		<?php if (!isset($field['hidden'])) : ?>
	        		<th nowrap <?php echo isset($field['width']) ? "width=\"{$field['width']}%\"" : ''?>><?php echo $field['trans']?></th>
	        	<?php endif;?>
	    	<?php endforeach;?>
	    	<th width="1%">&nbsp;</th>
	    	<?php if (!isset($hide_delete)) : ?>
	   			<th width="1%">&nbsp;</th>
	    	<?php endif;?>
			</tr>
		</thead>

		<?php if (!isset($items)){
	    	$paramsFilter = array('offset' => $pages->low, 'limit' => $pages->items_per_page);

	    	if ( isset($sort) && !empty($sort) ) {
	        	$paramsFilter['sort'] = $sort;
	    	}

	    	$paramsFilter = array_merge($paramsFilter,$filter_params);
	    	$items = call_user_func('erLhAbstractModel'.$identifier.'::getList',$paramsFilter);
		}

		foreach ($items as $item) : ?>
	    	<tr>
	        	<?php foreach ($fields as $key => $field) : ?>

	        	<?php if (!isset($field['hidden'])) : ?>
	        	<td>
	        	<?php if (isset($field['frontend']))
		            echo htmlspecialchars($item->{$field['frontend']});
		        else
		            echo htmlspecialchars($item->$key);
		        ?></td>
	       		<?php endif;?>

	        <?php endforeach;?>
	        <td><a class="button tiny radius" href="<?=__url('abstract/edit')?>/<?=$identifier.'/'.$item->id?>"><?=__t('system/button','Edit')?></a></td>

	        <?php if (!isset($hide_delete)) : ?>
	        	<td><a class="button tiny radius alert csfr-required" onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('abstract/delete')?>/<?=$identifier.'/'.$item->id?>"><?=__t('system/button','Delete')?></a></td>
	        <?php endif;?>

	    </tr>
	<?php endforeach; ?>
	</table>

	<br>

	<?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>
	
<?php else:?>
	<p><?=__t('system/buttons','Empty')?></p>
<?php endif;?>

<?php if (!isset($hide_add)) : ?>
	<div class="new-record-control">
		<a class="small button radius" href="<?=__url('abstract/new')?>/<?=$identifier?>"><?=__t('system/button','New')?></a>
	</div>
	<br>
<?php endif;?>