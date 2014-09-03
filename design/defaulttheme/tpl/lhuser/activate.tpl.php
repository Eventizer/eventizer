<h1><?=__t('user/activate','Activate Account')?></h1>

<hr />

<?php if($userData !== false): ?>
	<h4><?=__t('user/activate','Your account activated')?></h4>	
<?php else: ?>
	<h4><?=__t('user/activate','Activate code not found or was used already')?></h4>
<?php endif;?>