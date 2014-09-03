<div class="box-body">
<?php foreach($items as $item):?>
	<?php $link = $item->link?>
	<?php $published = $item->published->date->format( 'Y-m-d' );?>
	<div class="item">
		<div class="message">
			<a target="_blank" href="<?=htmlspecialchars($link[0]->href)?>"><?=htmlspecialchars($item->title->text)?><small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?=$published?></small></a>
			<p><?=htmlspecialchars($item->description->text)?></p>
		</div>
	</div>
	<hr />
<?php endforeach;?>
</div>
<div class="box-footer clearfix">
	<a class="pull-right btn btn-default" href="http://eventizer.org/News-1c.html" target="_blank" ><?=__t('ajax/eventizernews','View all news')?> <i class="fa fa-arrow-circle-right"></i></a>
</div>