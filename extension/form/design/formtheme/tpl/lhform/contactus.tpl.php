<section id="content">
    <div class="feedback-form">
    	<div class="title-bar clearfix">
    		<h1><?=erTranslationClassLhTranslation::getInstance()->getTranslation('form/contactus','Feedback')?></h1>
    	</div>
    	
    	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
    	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
    	
    	<?php if ($messageSend == false):?>	
    	<div class="form-content pt-20 blog-item blog-single">
    	<div class="media-list">
				<div class="media box">
					<div class="media-body">
                	    <form action="<?=erLhcoreClassDesign::baseurl('form/contactus')?>" method="post" class="form-horizontal">
                	    		<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
                	    		
                	            <div class="form-group">
                	            	<label class="col-sm-3"><?=__t('form/contactus','Name')?><span class="requared">*</span></label>
                	        	    <div class="col-sm-9">
                						<input type="text" name="FormName" class="form-control" value="<?=htmlspecialchars($form_data['FormName'])?>" />
                					</div>
                	            </div>
                	            
                	            <div class="form-group">
                	            	<label class="col-sm-3"><?=__t('form/contactus','E-mail')?><span class="requared">*</span></label>
                	        	    <div class="col-sm-9">
                						<input type="text" name="FormEmail" class="form-control" value="<?=htmlspecialchars($form_data['FormEmail'])?>" />
                					</div>
                	            </div>
                
                	            <?php if (erLhcoreClassForm::getInstance()->getSetting('nature_of_query','enabled') === true):?>
                		            <div class="form-group">
                		            	<label class="col-sm-3"><?=__t('form/contactus','Nature of query ')?><span class="requared">*</span></label>
                		        	    <div class="col-sm-9">
                							<select name="QueryNature" class="form-control" >
                								<option value=""><?=__t('form/contactus','Select')?></option>
                								<?php foreach (erLhcoreClassForm::getInstance()->getSetting('nature_of_query', 'queries') as $item):?>
                									<option value="<?=$item?>" <?php if ($form_data['QueryNature'] == $item):?>selected<?php endif;?> ><?=$item?></option>
                								<?php endforeach;?>
                							</select>
                						</div>
                		            </div>
                	            <?php endif;?>
                	            
                	            <div class="form-group">
                	            	<label class="col-sm-3"><?=__t('form/contactus','Your message')?><span class="requared">*</span></label>
                	        	    <div class="col-sm-9">
                						<textarea  name="FormText" class="form-control" ><?=htmlspecialchars($form_data['FormText'])?></textarea>
                					</div>
                	            </div>
                	            
                	            <div class="form-group">
                	            	<label class="col-sm-3"><?=__t('form/contactus','Captcha image')?></label>
                	        	    <div class="col-sm-9">
                	        	    	<img src="<?=erLhcoreClassDesign::baseurl('captcha/image/feedback_form')?>" alt="" />
                					</div>
                	            </div>
                	            
                	            <div class="form-group">
                	            	<label class="col-sm-3"><?=__t('form/contactus','Captcha code')?></label>
                	        	    <div class="col-sm-4">
                	        	    	<input type="text" value=""  class="form-control"  name="CaptchaCode" />
                					</div>
                	            </div>
                	            
                	            <div class="form-group">
                	            	<div class="col-sm-12">
                	            		* - <?=__t('form/contactus','Required fields')?> 
                					</div>
                	            </div>
                	        
                	        	<div class="pt-30">
                	                <input class="btn btn-yellow" type="submit" value="<?=__t('form/contactus','Send')?>" name="SendRequest" />
                	            </div>
                	    </form>
                    </div>
                </div>
    	    </div>
    	</div>
    	<?php endif;?>
    </div>
</section>