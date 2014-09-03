<?php if (isset($pages) && $pages->num_pages > 1) : ?>

	<div class="row">	
		<div class="columns large-6">
			<?=__t('core/paginator','Page')?> <?=$pages->current_page?> <?=__t('core/paginator','of')?> <?=$pages->num_pages?>, <?=__t('core/paginator','Total')?>: <?=$pages->items_total?>
		</div>
		<div class="columns large-6">
		
			<div class="right">
				<ul class="pagination">
	
			    <?php if($pages->current_page != 1): ?>
			        <li class="arrow"><a href="<?=$pages->serverURL.$pages->prev_page.$pages->querystring?>">&laquo;</a></li>
			    <?php endif;?>
	
	    		<?php if($pages->num_pages > 10): ?>
	    			
				    <?php if($pages->range[0] > 1): ?>				    
				    	<?php $i = 1; ?>
				    	<?php $pageURL = $i > 1 ? '/(page)/'.$i : ''; ?>				    	
				    	<?php if($i == $pages->current_page) : ?>
				    	   <li class="current"><a title="<?=__t('core/paginator','Go to page')?> <?=$i?> <?=__t('core/paginator','of')?> <?=$pages->num_pages?>" href="#"><?=$i?></a></li>
				    	<?php else : ?>
				           <li><a title="<?=__t('core/paginator','Go to page')?> <?=$i?> <?=__t('core/paginator','of')?> <?=$pages->num_pages?>" href="<?=$pages->serverURL.$pageURL.$pages->querystring?>"><?=$i?></a></li>
				        <?php endif; ?>
				        <li class="unavailable"><a href="">&hellip;</a></li>				        
				    <?php endif; ?>
	
			        <?php for($i=$pages->range[0];$i<=$pages->lastArrayNumber;$i++): ?>
			        	<?php if($i > 0): ?>
			        		<?php $pageURL = $i > 1 ? '/(page)/'.$i : ''; ?>
							<?php if($i == $pages->current_page): ?>
								<li class="current"><a title="<?=__t('core/paginator','Go to page')?> <?=$i?> <?=__t('core/paginator','of')?> <?=$pages->num_pages?>" href="#"><?=$i?></a></li>
				    		<?php else : ?>
				    			<li><a title="<?=__t('core/paginator','Go to page')?> <?=$i?> <?=__t('core/paginator','of')?> <?=$pages->num_pages?>" href="<?=$pages->serverURL.$pageURL.$pages->querystring?>"><?=$i?></a></li>
				    		<?php endif; ?>
				    	<?php endif; ?>
				    <?php endfor; ?>
				    
				    <?php if($pages->lastArrayNumber < $pages->num_pages): ?>
				    	<?php $i = $pages->num_pages; ?>
				    	<?php $pageURL = $i > 1 ? '/(page)/'.$i : ''; ?>
				     	<li class="unavailable"><a href="">&hellip;</a></li>
				     	<?php if($i == $pages->current_page): ?>				
							<li class="current"><a title="<?=__t('core/paginator','Go to page')?> <?=$i?> <?=__t('core/paginator','of')?> <?=$pages->num_pages?>" href="#"><?=$i?></a></li>
						<?php else: ?>
				            <li><a title="<?=__t('core/paginator','Go to page')?> <?=$i?> <?=__t('core/paginator','of')?> <?=$pages->num_pages?>" href="<?=$pages->serverURL.$pageURL.$pages->querystring?>"><?=$i?></a></li>
					   <?php endif; ?>
					<?php endif; ?>
	
	   			<?php else: ?>
	   				<?php for($i=1;$i<=$pages->num_pages;$i++): ?>
	   					<?php $pageURL = $i > 1 ? '/(page)/'.$i : ''; ?>
						<?php if ($i == $pages->current_page): ?>
	            			<li class="current"><a href="#"><?php echo $i?></a></li>
						<?php else: ?>
			    			<li><a href="<?=$pages->serverURL.$pageURL.$pages->querystring;?>"><?=$i?></a></li>
	    				<?php endif; ?>
	    			<?php endfor; ?>
	    		<?php endif; ?>
	
	    		<?php if($pages->current_page != $pages->num_pages): ?>
	    			<li class="arrow"><a href="<?=$pages->serverURL.'/(page)/'.$pages->next_page.$pages->querystring?>">&raquo;</a></li>
	    		<?php endif;?>
	
	    		</ul>
			</div>
		</div>
	</div>

<?php endif;?>