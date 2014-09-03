<h1><?=htmlspecialchars($articleData->name)?></h1>

<div class="row">
	<div class="columns large-12">

		<?php if($articleData->has_photo):?>
			<div class="left">
				<img src="<?=$articleData->thumbcontent_article?>" alt="" />
			</div>
		<?php endif;?> 
	
		<?=$articleData->intro;?>
		
	</div>
</div>

<?php if($articleData->body != ''):?>
	<div class="row">
		<div class="columns large-12">
			<?=$articleData->body?>
		</div>
	</div>
<?php endif;?>