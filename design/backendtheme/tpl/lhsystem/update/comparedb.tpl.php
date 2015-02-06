<?php if (!empty($links)) : ?>
<div class="alert-box alert"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/update','Missing updates from new versions.')?></div> 
    <ul>
        <?php foreach ($links as $link) : ?>
        	<li><a target="_blank" href="<?php echo $link['url']?>"><?php echo $link['name']?></a></li>
        <?php endforeach;?>
    </ul>
    <a class="button radius radius small" href="http://eventizer.org/How-to-upgrade-Eventizer-13c.html" target="_blank"><?= __t('system/update','Update instructions')?></a>
<?php else : ?>
    <div class="alert-box"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/update','You are running current version. No updates required')?></div>
<?php endif;?>