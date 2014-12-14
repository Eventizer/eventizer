
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<section id="content">
				<div class="row">
					<div class="property-list grid-layout clearfix">
						<div class="col-sm-12 col-md-12 the-title text-centered">
							<h2 class="uppercase"><?=__t('front/default','Newest events')?></h2>
						<?php /*	<span>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</span>*/?>
						</div>
					
						<?php foreach ($items as $item):?>
    				   		 <?php include(erLhcoreClassDesign::designtpl('lhfront/parts/list_item.tpl.php'));?>
    					<?php endforeach;?>
						
					</div>
				</div>
			</section>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<section id="content" class="top-categories">
				<div class="row">
						<div class="col-sm-12 col-md-12 the-title text-centered">
							<h2 class="uppercase"><?=__t('front/default','Top categories')?></h2>
						</div>
						<?php $count = 1?>
						<?php foreach ($categories as $cat):?>
    				   		 <?php include(erLhcoreClassDesign::designtpl('lhfront/parts/top_category.tpl.php'));?>
    				   		 <?php $count++?>
    					<?php endforeach;?>
					</div>
			</section>
		</div>
	</div>
</div>



<?php /*
<!-- Place this tag where you want the widget to render. -->
<div id="widget_container"></div>

<script type="text/javascript">
var eventWidget = {};
eventWidget.opt = {widget_width:'300'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = '//dev.eventizer.org/event/widget'
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
*/?>