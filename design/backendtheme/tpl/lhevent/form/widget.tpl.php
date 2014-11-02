<div class="row">
    <div class="col-xs-6"> 
        <div class="form-group">   
        	<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('eventadmin/widget','Choose prefered http mode');?></label>
    	    <select id="HttpMode" class="form-control">         
    	            <option value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('eventadmin/widget','Based on site (default)');?></option>
    	            <option value="http:">http:</option>
    	            <option value="https:">https:</option>      
    	    </select>
	    </div>    
    </div>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="form-group">   
            <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('eventadmin/widget','Choose a language');?></label>
            <select id="LocaleID" class="form-control">
                <?php foreach ($locales as $locale ) : ?>
                <option value="<?php echo $locale?>/"><?php echo $locale?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="row">
        	<div class="col-xs-6">
	        	<div class="row">
			        	<div class="col-xs-6">
			        	    <div class="form-group">   
			        		   <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('eventadmin/widget','Widget width')?></label>
			        		   <input class="form-control" type="text" id="id_widget_width" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('eventadmin/widget','Widget width in pixels')?>" value="300" />
			        		  </div>
			        	</div>
			     </div>
        	</div>
        </div>

    </div>
    
    <div class="col-xs-6">       
         
	</div>
</div>



<p class="explain"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('eventadmin/widget','Copy the code from the text area to the page where you want your widget to appear');?></p>
<textarea style="width:100%;height:180px;font-size:12px;" id="HMLTContent" ><?php echo htmlspecialchars('<script type="text/javascript" src="http://'.$_SERVER['HTTP_HOST'].erLhcoreClassDesign::baseurl('event/widget').'"></script>')?></textarea>


<script type="text/javascript">
	var _lactq = _lactq || [];
	_lactq.push({'f':'widgetEmbedCode','a':['<?=erConfigClassLhConfig::getInstance()->getSetting( 'site', 'default_site_access' ); ?>/','<?php echo $_SERVER['HTTP_HOST']?><?php echo erLhcoreClassDesign::baseurldirect()?>']});
</script>