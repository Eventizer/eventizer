<div class="col-md-12">
	<div class="box box-primary">
	<div class="box-header"></div>
	<div class="box-body table-responsive">
		<?php $childCategories = erLhcoreClassModelArticleCategory::getList(array( 'filter' => array('parent_id' => (int)$category->id))); ?>
		<?php if (!empty($childCategories)) : ?>
		
		<div class="dataTables_wrapper form-inline">
			<form action="<?=__url('article/managecategories')?>" method="post">
				<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
					<thead>
						<tr>
						    <th><?=__t('article/managecategories','ID')?></th>
						    <th><?=__t('article/managecategories','Name')?></th>    
						    <th><?=__t('article/managecategories','Position')?></th>
						    <th width="1%">&nbsp;</th>
						    <th width="1%">&nbsp;</th>  
						</tr>
					</thead>
					
					<? foreach ($childCategories as $categorychild) : ?>
				    	<tr>
					        <td width="1%"><?=$categorychild->id?></td>
					        <td><a href="<?=__url('article/managecategories')?>/<?=$categorychild->id?>"><?=htmlspecialchars($categorychild->name)?></a></td>     
					        <td><?=$categorychild->pos?></td>      
					        <td><a class="button tiny radius" href="<?=__url('article/editcategory')?>/<?=$categorychild->id?>" title="<?=__t('system/button','Edit')?>"><i class="fa fa-edit"></i></a></td>       
					        <td>
					        	<?php if($categorychild->system):?>
					        		&nbsp;
					        	<?php else:?>
					        		<a class="button tiny csfr-required " onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('article/deletecategory')?>/<?=$categorychild->id?>" title="<?=__t('system/button','Delete')?>" ><i class="fa fa-fw fa-trash-o"></i></a>
					        	<?php endif;?>
					        </td>       
				    	</tr>
					<? endforeach; ?>
				</table>
			</form>
		</div>
		<?php endif;?>
		
		<div class="box-footer">
			<a class="btn btn-primary" href="<?=__url('article/newcategory')?>/<?=(int)$category->id?>"><?=__t('system/button','New category')?></a>
			<?php if ((int)$category->id > 0) : ?>
			<a class="btn btn-primary" href="<?=__url('article/editcategory')?>/<?=(int)$category->id?>"><?=__t('system/button','Edit category')?></a>
			<?php endif;?>
		</div>
		
		
		<?php if ((int)$category->id > 0) : ?>
		
			<div class="box-header">
				<h3 class="box-title"><?=__t('article/managecategories','Articles')?></h3>
			</div>
		
			<?php if (!empty($list)) : ?>
			<form action="<?=__url('article/managesubcategories')?>/<?=$category->id?>" method="post">
			    <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
			    <thead>
			    <tr>
			        <th><?=__t('article/managecategories','ID')?></th>
			        <th><?=__t('article/managecategories','Name')?></th>
			        <th width="1%"><?=__t('article/managecategories','Modified')?></th>
			        <th width="1%"><?=__t('article/managecategories','Position')?></th>
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
			            <td><a class="button tiny radius " href="<?=__url('article/edit')?>/<?=$article->id?>" title="<?=__t('system/button','Edit')?>"><i class="fa fa-edit"></i></a></td>       
			            <td>
			            	<?php if($article->system == 1):?>
			            		&nbsp;
			            	<?php else:?>
			            		<a class="button tiny  csfr-required" onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('article/delete')?>/<?=$article->id?>" title="<?=__t('system/button','Delete')?>"><i class="fa fa-fw fa-trash-o"></i></a>
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
			<div class="box-footer">
				<a class="btn btn-primary radius " href="<?=__url('article/new')?>/<?=$category->id?>"><?=__t('system/button','New')?></a>
			</div>
		<?php endif; ?>
		
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>
	</div>
</div>
</div>