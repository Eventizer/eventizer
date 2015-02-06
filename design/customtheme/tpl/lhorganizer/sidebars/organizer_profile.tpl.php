<?php if ($Result['organizer']->org_fb != '' && $Result['organizer']->org_tw != ''):?>
    <ul id="myTab" class="nav nav-tabs mb-10" role="tablist">
      <li role="presentation" class="active"><a href="#fb" id="fb-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><?=__t('organizer/profile','FB')?></a></li>
      <li role="presentation" class=""><a href="#tw" role="tab" id="tw-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><?=__t('organizer/profile','TW')?></a></li>
    </ul>
<?php endif;?>
<?php erLhcoreClassModelSystemConfig::fetch('facebook_app_id')?>
<?php erLhcoreClassModelSystemConfig::fetch('twitter_app_id')?>
<div id="myTabContent" class="tab-content">

    <?php if(erLhcoreClassModelSystemConfig::getSetting('facebook_app_id')):?>
        <?php if ($Result['organizer']->org_fb != ''):?>
            <div role="tabpanel" class="tab-pane fade active in" id="fb" aria-labelledby="fb-tab">
                <iframe width="263" src="//www.facebook.com/plugins/likebox.php?href=<?=urlencode($Result['organizer']->org_fb)?>&amp;width=263&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=<?=erLhcoreClassModelSystemConfig::getSetting('facebook_app_id')->value?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:290px;" allowTransparency="true"></iframe>
            </div>
        <?php endif;?>
    <?php endif;?>
    
    <?php if(erLhcoreClassModelSystemConfig::getSetting('twitter_app_id')):?>
        <?php if ($Result['organizer']->org_tw != ''):?>
            <div role="tabpanel" class="tab-pane" id="tw" aria-labelledby="tw-tab">
                <a class="twitter-timeline" data-screen-name="<?=htmlspecialchars($Result['organizer']->tw_name)?>" href="https://twitter.com/<?=htmlspecialchars($Result['organizer']->tw_name)?>" data-widget-id="<?=erLhcoreClassModelSystemConfig::getSetting('twitter_app_id')->value?>">Tweets by @<?=htmlspecialchars($Result['organizer']->tw_name)?></a>
                <script type="text/javascript">
                	window.twttr = (function (d, s, id) {
                		var t, js, fjs = d.getElementsByTagName(s)[0];
                		if (d.getElementById(id)) return;
                		js = d.createElement(s); js.id = id;
                		js.src= "https://platform.twitter.com/widgets.js";
                		fjs.parentNode.insertBefore(js, fjs);
                		return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
                	}(document, "script", "twitter-wjs"));
                </script>
           </div>
       <?php endif;?>
    <?php endif;?>
 </div>

