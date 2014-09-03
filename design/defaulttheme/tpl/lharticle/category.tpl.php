<h1><?=htmlspecialchars($categoryData->name)?></h1>

<?php if ($pages->items_total > 0) : ?> 
	
	<?php foreach ($items as $item):?>
		<h2><a href="<?=$item->url?>"><?=htmlspecialchars($item->name)?></a></h2>
		
		<div class="row">
			<div class="columns large-12">
				<?php if($item->has_photo):?>
					<div class="left">
						<a href="<?=$item->url?>"><img src="<?=$item->thumbcontent_article?>" alt="" /></a>
					</div>
				<?php endif;?> 
				<?=$item->intro;?>
			</div>
		</div>
		
		<hr />
	<?php endforeach;?>
	
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
	
<?php endif;?>