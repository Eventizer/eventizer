<?php

return array (
		
        'erLhcoreClassModule'   						=> 'lib/core/lhcore/lhmodule.php',
        'erLhcoreClassSystem'   						=> 'lib/core/lhcore/lhsys.php',
        'erLhcoreClassDesign'   						=> 'lib/core/lhcore/lhdesign.php',
		'erLhcoreClassURL'      						=> 'lib/core/lhcore/lhurl.php',
		'erLhcoreClassLog'      						=> 'lib/core/lhcore/lhlog.php',
        'erLhcoreClassLazyDatabaseConfiguration' 		=> 'lib/core/lhcore/lhdb.php',
		'erLhcoreClassTransfer' 						=> 'lib/core/lhcore/lhtransfer.php',
        'erLhcoreClassRenderHelper' 					=> 'lib/core/lhcore/lhrenderhelper.php',
		'erTranslationClassLhTranslation' 				=> 'lib/core/lhcore/lhtranslation.php',
		'erLhcoreClassCharTransform' 	    			=> 'lib/core/lhcore/lhchartransform.php',
		'erLhcoreClassSiteaccessGenerator'				=> 'lib/core/lhcore/lhsiteaccessgenerator.php',
		'erLhcoreClassModuleFunctions'			 		=> 'lib/core/lhcore/lhmodulefunctions.php',
		'erLhcoreClassMail'			 					=> 'lib/core/lhcore/lhmail.php',
		'erLhcoreClassImageConverter'               	=> 'lib/core/lhcore/lhimageconverter.php',
		'erLhcoreClassGalleryImagemagickHandler'    	=> 'lib/core/lhcore/lhgalleryconverterhandler.php',
		'erLhcoreClassGalleryGDHandler'             	=> 'lib/core/lhcore/lhgallerygdconverterhandler.php',
		'erLhcoreClassSearchHandler'	        		=> 'lib/core/lhcore/lhsearchhandler.php',
		'erLhcoreClassInputForm'	            		=> 'lib/core/lhcore/lhform.php',
        'erLhcoreClassTemplate' 						=> 'lib/core/lhtpl/tpl.php',
		'erLhcoreClassCacheStorage' 					=> 'lib/core/lhtpl/tpl.php',
        'erConfigClassLhConfig' 						=> 'lib/core/lhconfig/lhconfig.php',
		'erConfigClassLhCacheConfig' 					=> 'lib/core/lhconfig/lhcacheconfig.php',
		'erLhcoreClassBBCode'       					=> 'lib/core/lhbbcode/lhbbcode.php',
		'erLhcoreClassAbstract' 		 				=> 'lib/core/lhabstract/lhabstract.php',        
		'lhPaginator'           						=> 'lib/core/lhexternal/lhpagination.php',
		'PHPMailer'             						=> 'lib/core/lhexternal/class.phpmailer.php',
		'erLhcoreClassUser'         					=> 'lib/core/lhuser/lhuser.php',
		'ezcAuthenticationDatabaseCredentialFilter' 	=> 'lib/core/lhuser/lhauthenticationdatabasecredentialfilter.php',
 		'erLhcoreClassRole'     						=> 'lib/core/lhpermission/lhrole.php',
        'erLhcoreClassModules'  						=> 'lib/core/lhpermission/lhmodules.php',
        'erLhcoreClassRoleFunction'  					=> 'lib/core/lhpermission/lhrolefunction.php',
        'erLhcoreClassGroupRole'  						=> 'lib/core/lhpermission/lhgrouprole.php',
		'erLhcoreClassSystemConfig'						=> 'lib/core/lhsystemconfig/lhsystemconfig.php',
        'erLhcoreClassTrait'					        =>  'lib/core/lhcore/lhclasstrait.php',
        'erLhcoreClassEventDispatcher'			        =>  'lib/core/lhcore/lheventdispatcher.php',
        'erLhcoreClassUpdate'		         	        =>  'lib/core/lhcore/lhupdate.php',
		
        'erLhcoreClassModelUser'            			=> 'lib/models/lhuser/erlhcoreclassmodeluser.php',
        'erLhcoreClassValidateUsers'					=> 'lib/core/lhuser/validation/erlhcoreclassvalidationuser.php',
		'erLhcoreClassModelUserRemember' 				=> 'lib/models/lhuser/erlhcoreclassmodeluserremember.php',
        'erLhcoreClassModelGroup'           			=> 'lib/models/lhuser/erlhcoreclassmodelgroup.php',
        'erLhcoreClassModelGroupUser'       			=> 'lib/models/lhuser/erlhcoreclassmodelgroupuser.php',
        'erLhcoreClassModelForgotPassword'  			=> 'lib/models/lhuser/erlhcoreclassmodelforgotpassword.php',
        'erLhcoreClassModelUserSetting'  	   			=> 'lib/models/lhuser/erlhcoreclassmodelusersetting.php',
        'erLhcoreClassModelGroupRole'   				=> 'lib/models/lhpermission/erlhcoreclassmodelgrouprole.php',
        'erLhcoreClassModelRole'        				=> 'lib/models/lhpermission/erlhcoreclassmodelrole.php',
        'erLhcoreClassModelRoleFunction'				=> 'lib/models/lhpermission/erlhcoreclassmodelrolefunction.php',
		'erLhcoreClassModelSystemConfig'				=> 'lib/models/lhsystemconfig/erlhcoreclassmodelconfig.php',
    
        // Files upload
        'UploadHandler'                                 => 'lib/core/lhcore/UploadHandler.php',
        'erLhcoreClassFileUpload'                       => 'lib/core/lhcore/lhfileupload.php',
				
        // Articles
        'erLhcoreClassArticle' 	  						=> 'lib/core/lharticle/lharticle.php',
		'erLhcoreClassModelArticleStatic' 				=> 'lib/models/lharticle/erlhcoreclassmodelarticlestatic.php',		
		'erLhcoreClassModelArticleCategory'  			=> 'lib/models/lharticle/erlhcoreclassmodelarticlecategory.php',
		'erLhcoreClassModelArticle'          			=> 'lib/models/lharticle/erlhcoreclassmodelarticle.php',		
		'CKEditor' 	  									=> 'lib/core/lharticle/ckeditor_php5.php',
		'CKFinder' 	  									=> 'lib/core/lharticle/ckfinder_php5.php',
		        
		// Abstract modules
		'erLhAbstractModelEmailTemplate' 				=> 'lib/models/lhabstract/erlhabstractmodelemailtemplate.php',
		'erLhAbstractModelUrlAlias'						=> 'lib/models/lhabstract/erlhabstractmodelurlalias.php',
		'erLhAbstractModelCountry' 						=> 'lib/models/lhabstract/erlhabstractmodelcountry.php',
		'erLhAbstractModelEventCategory' 				=> 'lib/models/lhabstract/erlhabstractmodeleventcategory.php',
		
		// External libs
		'Facebook'                              		=> 'lib/core/lhexternal/facebook/facebook.php',
		'SphinxClient'        		        			=> 'lib/core/lhexternal/sphinxapi.php',
			
		// Mail cron
		'erLhcoreClassCronMailer' 	  					=> 'lib/core/lhcronmailer/lhcronmailer.php',
		'erLhcoreClassModelCronMailerMail' 				=> 'lib/models/lhcronmailer/erlhcoreclassmodelcronmailermail.php',
				
		//Events
		'erLhcoreClassEvents'							=>  'lib/core/lhevents/lhevents.php',
		'erLhcoreClassModelEvents'						=>  'lib/models/lhevents/erlhcoreclassmodelevents.php',
		'erLhcoreClassModelSavedEvents'					=>  'lib/models/lhevents/erlhcoreclassmodelsavedevents.php',
    
        //event validation
        'erLhcoreClassValidateEvents'					=>  'lib/core/lhevents/validation/erlhcoreclassvalidationevents.php',
    
    
        //API
        'ApiClient' 	  					            => 'lib/core/lhcore/lhapiclient.php',
        
);

?>