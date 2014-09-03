<section class="content-header">
	<h1>
         <?=(isset($Result['title']))?$Result['title']:''?>
         <small><?=(isset($Result['small_title']))?$Result['small_title']:''?></small>
    </h1>

	<?php if (isset($Result['path'])) :
	$pathElementCount = count($Result['path'])-1;
	if ($pathElementCount >= 0):
	?>
	<ol  class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
	<li><a rel="home" itemprop="url" href="<?=__url()?>"><span itemprop="title"><i class="fa fa-dashboard"></i>&nbsp;<?=__t('pagelayout/pagelayout','Home')?></span></a></li>
	<?php foreach ($Result['path'] as $key => $pathItem) : if (isset($pathItem['url']) && $pathElementCount != $key) { ?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<a href="<?php echo $pathItem['url']?>" itemprop="url"><span itemprop="title"><?php echo htmlspecialchars($pathItem['title'])?></span></a></li><?php } else { ?><li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php echo htmlspecialchars($pathItem['title'])?></span>
		</li>
		<?php }; ?>
	<?php endforeach; ?>
	</ol><?php endif; ?>
	<?php endif;?>
</section>

