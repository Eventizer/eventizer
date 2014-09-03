<h1><?=__t('articleadmin/managecategories','Manage categories')?> <?php if ($category->id > 0) : ?> - <?=htmlspecialchars($category->name)?><?php endif;?></h1>

<?php $childCategories = erLhcoreClassModelArticleCategory::getList(array( 'filter' => array('parent_id' => (int)$category->id))); ?>
<?php if (!empty($childCategories)) : ?>

<form action="<?=__url('articleadmin/managecategories')?>" method="post">
	<table cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr>
			    <th><?=__t('articleadmin/managecategories','ID')?></th>
			    <th><?=__t('articleadmin/managecategories','Name')?></th>    
			    <th><?=__t('articleadmin/managecategories','Position')?></th>
			    <th width="1%">&nbsp;</th>
			    <th width="1%">&nbsp;</th>  
			</tr>
		</thead>
		
		<? foreach ($childCategories as $categorychild) : ?>
	    	<tr>
		        <td width="1%"><?=$categorychild->id?></td>
		        <td><a href="<?=__url('articleadmin/managecategories')?>/<?=$categorychild->id?>"><?=htmlspecialchars($categorychild->name)?></a></td>     
		        <td><?=$categorychild->pos?></td>      
		        <td><a class="button tiny radius" href="<?=__url('articleadmin/editcategory')?>/<?=$categorychild->id?>"><?=__t('system/button','Edit')?></a></td>       
		        <td>
		        	<?php if($categorychild->system):?>
		        		&nbsp;
		        	<?php else:?>
		        		<a class="button tiny radius alert csfr-required " onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('articleadmin/deletecategory')?>/<?=$categorychild->id?>"><?=__t('system/button','Delete')?></a>
		        	<?php endif;?>
		        </td>       
	    	</tr>
		<? endforeach; ?>
	</table>
</form>
<?php endif;?>

<ul class="button-group radius">
	<li><a class="button small" href="<?=__url('articleadmin/newcategory')?>/<?=(int)$category->id?>"><?=__t('system/button','New category')?></a></li>
	<?php if ((int)$category->id > 0) : ?>
	<li><a class="button small" href="<?=__url('articleadmin/editcategory')?>/<?=(int)$category->id?>"><?=__t('system/button','Edit category')?></a></li>
	<?php endif;?>
</ul>

<?php if ((int)$category->id > 0) : ?>

	<div class="header-list">
		<h1><?=__t('articleadmin/managecategories','Articles')?></h1>
	</div>

	<?php if (!empty($list)) : ?>
	<form action="<?=__url('article/managesubcategories')?>/<?=$category->id?>" method="post">
	    <table cellpadding="0" cellspacing="0" width="100%">
	    <thead>
	    <tr>
	        <th><?=__t('articleadmin/managecategories','ID')?></th>
	        <th><?=__t('articleadmin/managecategories','Name')?></th>
	        <th width="1%"><?=__t('articleadmin/managecategories','Modified')?></th>
	        <th width="1%"><?=__t('articleadmin/managecategories','Position')?></th>
	        <th width="1%">&nbsp;</th>
	        <th width="1%">&nbsp;</th>      
	    </tr>
	    </thead>
	    <? foreach ($list as $article) :?>
	        <tr>
	            <td width="1%"><?=$article->id?></td>
	            <td><?=$article->name?></td> 
	            <td nowrap><?=date("Y-m-d H:i:s",$article->mtime)?></td>               
	            <td><?=$article->pos?></td>
	            <td><a class="button tiny radius " href="<?=__url('articleadmin/edit')?>/<?=$article->id?>"><?=__t('system/button','Edit')?></a></td>       
	            <td>
	            	<?php if($article->system == 1):?>
	            		&nbsp;
	            	<?php else:?>
	            		<a class="button tiny radius alert csfr-required" onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('articleadmin/delete')?>/<?=$article->id?>"><?=__t('system/button','Delete')?></a>
	            	<?php endif; ?>
	            </td>       
	        </tr>
	    <? endforeach; ?>
	    </table>
	    
	<?php if (isset($pages)) : ?>
	    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
	<? endif;?>
	</form>
	<?php endif; ?>
	
	<a class="button radius small" href="<?=__url('articleadmin/new')?>/<?=$category->id?>"><?=__t('system/button','New')?></a>

<?php endif; ?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>