<div class="prop-item col-sm-6 col-md-6">
	<div class="thumbnail">
		<div class="thumbnail-img thumbscrubber smooth">
			<a href="<?=$item->url?>">
				<?php if($item->photo_thumb):?>
					<img alt="<?=htmlspecialchars($item->title)?>" src="<?=$item->photo_thumb?>" />
				<?php else:?>
					<img width="100%" alt="<?=htmlspecialchars($item->title)?>" src="<?=__design('images/nophoto/no-thumbnail.png')?>" />
				<?php endif;?>
			</a>
		</div>
		<div class="thumbnail-body">
			<div class="caption">
				<h3>	
					<a href="<?=$item->url?>">
						<?=htmlspecialchars($item->title)?>
					</a>
				</h3>
				<span class="prop-address"><?=htmlspecialchars($item->address)?></span>
				<div class="prop-price hide">
					$125 <span>/ mo</span>
				</div>
			</div>
			<ul class="list-unstyled feature-list">
				<li><?=htmlspecialchars(date('Y-m-d H:i:s',$item->start_date))?></li>
				<li class="hide">13 laisvu vietu</li>
			</ul>
			
			<div class="link-group hide">
				<a href="#"></a> <a class="btn btn-flat-success" href="#"><i class="fa fa-star"></i> Save</a> <a class="btn btn-flat-warning" href="#"><i class="fa fa-envelope"></i> Contact Agent</a>
			</div>
		</div>
	</div>
</div>