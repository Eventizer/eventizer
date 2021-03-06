<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        	<label><?=__t('eventadmin/new','Title')?><span class="required">*</span></label>
        	<input type="text" name="Title" class="form-control"  value="<?=htmlspecialchars($event->title)?>" />
        </div>
  
    </div>
</div>

<div class="row">
   <div class="col-md-6">     
        <div class="form-group">
        	<label><?=__t('eventadmin/new','Start date')?><span class="required">*</span></label>
        	<input type="text" name="StartDate" class="form-control" id="StartDate" value="<?=htmlspecialchars($event->start_date_front)?>" />
        </div>
    </div>
    <div class="col-md-6">   
        <div class="form-group">
    	   <label><?=__t('eventadmin/new','End date')?><span class="required">*</span></label>
    	   <input type="text" name="EndDate" class="form-control" id="EndDate"  value="<?=htmlspecialchars($event->end_date_front)?>" />
        </div>
    </div>
</div>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group">
        	<label><?=__t('eventadmin/new','Address')?><span class="required">*</span></label>
        	<input type="text" name="Address" class="form-control"  value="<?=htmlspecialchars($event->address)?>" />
        </div>
    </div>
</div>

<div class="row">
   <div class="col-md-6">     
        <div class="form-group">
        	<label><?=__t('eventadmin/new','Country')?><span class="required">*</span></label>
        	<?=erLhcoreClassRenderHelper::renderCombobox(array(
        	   'list_function'=>'erLhAbstractModelCountry::getList', 
               'display_name'=>'name',
               'css_class' => 'form-control',
               'input_name' => 'Country',
        	   'selected_id' => $event->country))?>
        </div>
    </div>
    <div class="col-md-6">   
        <div class="form-group">
    	   <label><?=__t('eventadmin/new','Postcode')?></label>
    	   <input type="text" name="Postcode" class="form-control"  value="<?=htmlspecialchars($event->postcode)?>" />
        </div>
    </div>
</div>

<div class="row">
   <div class="col-md-6">     
        <div class="form-group">
        	<label><?=__t('eventadmin/new','Facebook link')?></label>
        	<input type="text" name="FbLink" class="form-control"  value="<?=htmlspecialchars($event->fb_link)?>" />
        </div>
    </div>
    <div class="col-md-6">   
        <div class="form-group">
    	   <label><?=__t('eventadmin/new','Twitter link')?></label>
    	   <input type="text" name="TwLink" class="form-control"  value="<?=htmlspecialchars($event->tw_link)?>" />
        </div>
    </div>
</div>

<div class="row">
   <div class="col-md-6">     
        <div class="form-group">
        	<label><?=__t('eventadmin/new','Website link')?></label>
        	<input type="text" name="Link" class="form-control"  value="<?=htmlspecialchars($event->link)?>" />
        </div>
    </div>
    <div class="col-md-6">   
        <div class="form-group">
    	   <label><?=__t('eventadmin/new','Organizer name')?> <small><?=__t('eventadmin/new','This will override event organizer name') ?></small></label>
    	   <input type="text" name="OrgName" class="form-control"  value="<?=htmlspecialchars($event->organizer_name)?>" />
        </div>
    </div>
</div>

<div class="row">
   <div class="col-md-6">     
        <div class="form-group">
        	<label><?=__t('eventadmin/new','Category')?><span class="required">*</span></label>
        	<?=erLhcoreClassRenderHelper::renderCombobox(array(
        	   'list_function'=>'erLhAbstractModelEventCategory::getList', 
               'display_name'=>'name',
               'css_class' => 'form-control',
               'input_name' => 'Category',
        	   'selected_id' => $event->cat_id))?>
        </div>
    </div>
    <div class="col-md-6">   
        
    </div>
</div>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group">
        	<label><?=__t('eventadmin/new','Event decription')?><span class="required">*</span></label>
        	<?php
				$oFCKeditor = new CKEditor() ;        
				$oFCKeditor->basePath = erLhcoreClassDesign::design('js/ckeditor').'/' ;
				CKFinder::SetupCKEditor($oFCKeditor, erLhcoreClassDesign::design('js/ckfinder/'));   
				$oFCKeditor->config['height'] = 300;
				$oFCKeditor->config['width'] = '100%';        
				$oFCKeditor->editor('EDescription',$event->description) ;    
			?> 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">   
        <div class="form-group">
    	   <label><?=__t('eventadmin/new','Organizer description')?> <small><?=__t('eventadmin/new','This will override event organizer description') ?></small></label>
    	   <?php
				$oFCKeditor = new CKEditor() ;        
				$oFCKeditor->basePath = erLhcoreClassDesign::design('js/ckeditor').'/' ;
				CKFinder::SetupCKEditor($oFCKeditor, erLhcoreClassDesign::design('js/ckfinder/'));   
				$oFCKeditor->config['height'] = 300;
				$oFCKeditor->config['width'] = '100%';        
				$oFCKeditor->editor('OrgDesc',$event->organizer_description) ;    
			?> 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">   
        <div class="form-group">
    	   <label><?=__t('eventadmin/new','Event photo')?></label>
    	   <input name="Image" type="file"/>
    	   <?php if($event->photo_thumb):?>
    	   <br />
    	   <img src="<?=$event->photo_thumb?>" />
    	   <label><input type="checkbox" value="1" name="DeletePhoto" /><?=__t('eventadmin/new','Remove image')?></label>
    	   <?php endif;?>
        </div>
    </div>
</div>


<script type="text/javascript">
	var _lactq = _lactq || [];
	_lactq.push({'f':'ckeditor','a':['ckeditor']});
	_lactq.push({'f':'ckeditor','a':['ckeditor2']});
	_lactq.push({'f':'datepicker','a':['StartDate']});
	_lactq.push({'f':'datepicker','a':['EndDate']});
</script>