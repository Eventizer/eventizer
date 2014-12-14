<div class="<?=($count <= 2)?'col-sm-6':'col-sm-4'?> text-centered pb-25">
	<a style="background-image:url('<?=$cat->image_fullpath?>')" href="<?=__url('event/list')?>/(category)/<?=$cat->id?>" title="<?=htmlspecialchars($cat->name)?>" class="top-category-item"><span><?=htmlspecialchars($cat->name)?></span></a>
</div>