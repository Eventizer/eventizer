<div class="prop-item col-sm-6 col-md-3">
	<div class="thumbnail">
		<a class="thumbnail-img thumbscrubber smooth" href="<?=$item->url?>" title="<?=htmlspecialchars($item->title)?>">
			<?php if($item->photo_thumb):?>
				<img alt="<?=htmlspecialchars($item->title)?>" src="<?=$item->photo_thumb?>" />
			<?php else:?>
				<img width="100%" alt="<?=htmlspecialchars($item->title)?>" src="<?=__design('images/nophoto/no-thumbnail.png')?>" />
			<?php endif;?>
		</a>
		<div class="thumbnail-body">
			<a href="<?=$item->url?>">
				<div class="caption">
					<h3><?=htmlspecialchars($item->title)?></h3>
					<span class="prop-address"><?=htmlspecialchars($item->address)?></span>
				</div>
			</a>
		</div>
	</div>
</div>