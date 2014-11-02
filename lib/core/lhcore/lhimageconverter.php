<?php

class erLhcoreClassImageConverter {
      
   public $converter;
   private static $instance = null;
   
   function __construct()
   {
       $conversionSettings = array();
       
       if (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'imagemagic_enabled' ) == true)
       {
           $conversionSettings[] = new ezcImageHandlerSettings( 'imagemagick', 'erLhcoreClassGalleryImagemagickHandler' );
       }
       
       $conversionSettings[] =  new ezcImageHandlerSettings( 'gd','erLhcoreClassGalleryGDHandler' );
       
        $this->converter = new ezcImageConverter(
                new ezcImageConverterSettings(
                    $conversionSettings
                )
            );

            $filterNormal = array();
            
            $filterNormal[] = new ezcImageFilter( 
                        'scale',
                        array( 
                            'width'     => (int)erLhcoreClassModelSystemConfig::fetch('normal_thumbnail_width_x')->current_value,                        
                            'height'     => (int)erLhcoreClassModelSystemConfig::fetch('normal_thumbnail_width_y')->current_value,                        
                            'direction' => ezcImageGeometryFilters::SCALE_DOWN,
                        )
                    );
                    
            $dataWatermark = erLhcoreClassModelSystemConfig::fetch('watermark_data')->data;  
            $filterWatermarkAll = array(); 
              
            if ($dataWatermark['watermark_disabled'] == false)
            {
            	$method = 'watermarkAbsolute';
            	if ($dataWatermark['watermark_position'] == 'top_left')	{
            		$posX = $dataWatermark['watermark_position_padding_x'];
            		$posY = $dataWatermark['watermark_position_padding_y'];
            	} elseif ( $dataWatermark['watermark_position'] == 'top_right' ) {            		
            		$posX = -$dataWatermark['watermark_position_padding_x']-$dataWatermark['size_x'];
            		$posY = $dataWatermark['watermark_position_padding_y'];
            	} elseif ( $dataWatermark['watermark_position'] == 'bottom_left' ) {
            		$posX = $dataWatermark['watermark_position_padding_x'];
            		$posY = -$dataWatermark['watermark_position_padding_y']-$dataWatermark['size_y'];            		
            	} elseif ( $dataWatermark['watermark_position'] == 'bottom_right' ) {
            		$posX = -$dataWatermark['watermark_position_padding_x']-$dataWatermark['size_x'];
            		$posY = -$dataWatermark['watermark_position_padding_y']-$dataWatermark['size_y'];            		
            	} elseif ( $dataWatermark['watermark_position'] == 'center_center' ) {
            		$posX = $dataWatermark['watermark_position_padding_x'];
            		$posY = $dataWatermark['watermark_position_padding_y']; 
            		$method = 'watermarkCenterAbsolute';
            	}
            	
            	$waterMarkFilter = new ezcImageFilter(
            	$method,
	            	array(
		            	'image' => erLhcoreClassSystem::instance()->SiteDir.'/var/watermark/'.$dataWatermark['watermark'],
		            	'posX' => $posX,
		            	'posY' => $posY,
	            	)
            	);
            	$filterNormal[] = $waterMarkFilter;
            } 
                       
            $this->converter->createTransformation(
                'thumbbig',
                $filterNormal,
                array( 
                    'image/jpeg',
                    'image/png',
                ),
                new ezcImageSaveOptions(array('quality' => (int)erLhcoreClassModelSystemConfig::fetch('normal_thumbnail_quality')->current_value))
            );
            
            if ($dataWatermark['watermark_disabled'] == false && $dataWatermark['watermark_enabled_all'] == true){
            	$filterWatermarkAll[] = $waterMarkFilter;
            }    
                       
            $this->converter->createTransformation( 'jpeg', $filterWatermarkAll,
                array( 
                    'image/jpeg',
                    'image/png',
                    //Supported by GD
//                   'image/tiff',                    
//                   'image/tga',
//                   'image/svg+xml',
//                   'image/svg+xml',
                    'image/gif',
                ),
                new ezcImageSaveOptions(array('quality' => (int)erLhcoreClassModelSystemConfig::fetch('full_image_quality')->current_value))
            ); 
            
            $this->converter->createTransformation(
            	'thumbarticle',
            	array(
            		new ezcImageFilter(
            			erLhcoreClassModelSystemConfig::fetch('thumbnail_scale_algorithm')->current_value,
            			array(
            				'width'     => 100,
            				'height'    => 100,
            				'direction' => ezcImageGeometryFilters::SCALE_DOWN,
            			)
            		),
            	),
            	array(
            		'image/jpeg',
            		'image/png',
            	),
            	new ezcImageSaveOptions(array('quality' => (int)erLhcoreClassModelSystemConfig::fetch('thumbnail_quality_default')->current_value))
            );
            
            $this->converter->createTransformation(
            	'thumbcontentarticle',
            	array(
            		new ezcImageFilter(
            		'scale',
            			array(
            				'width'     => 300,
            				'height'    => 300,
            				'direction' => ezcImageGeometryFilters::SCALE_DOWN,
            			)
            		),
            	),
            	array(
            		'image/jpeg',
            		'image/png',
            	),
            	new ezcImageSaveOptions(array('quality' => (int)95))
            );
            
            
            $this->converter->createTransformation(
            	'photo_thumb',
            	array(
            		new ezcImageFilter(
            		'scale',
            			array(
            				'width'     => 270,
            				'height'    => 210,
            				'direction' => ezcImageGeometryFilters::SCALE_DOWN,
            			)
            		),
            	),
            	array(
            		'image/jpeg',
            		'image/png',
            	),
            	new ezcImageSaveOptions(array('quality' => (int)95))
            );
            
            $this->converter->createTransformation(
            	'featuredlogo',
            	array(
            		new ezcImageFilter(
            		'scale',
            			array(
            				'width'     => 100,
            				'height'    => 100,
            				'direction' => ezcImageGeometryFilters::SCALE_DOWN,
            			)
            		),
            	),
            	array(
            		'image/jpeg',
            		'image/png',
            	),
            	new ezcImageSaveOptions(array('quality' => (int)95))
            );
            
            $this->converter->createTransformation(
            	'logo_75_50',
            	array(
            		new ezcImageFilter(
            		'scale',
            			array(
            				'width'     => 70,
            				'height'    => 55,
            				'direction' => ezcImageGeometryFilters::SCALE_DOWN,
            			)
            		),
            	),
            	array(
            		'image/jpeg',
            		'image/png',
            	),
            	new ezcImageSaveOptions(array('quality' => (int)95))
            );
            
            $this->converter->createTransformation(
            	'logo_35_35',
            	array(
            		new ezcImageFilter(
            		'scale',
            			array(
            				'width'     => 35,
            				'height'    => 35,
            				'direction' => ezcImageGeometryFilters::SCALE_DOWN,
            			)
            		),
            	),
            	array(
            		'image/jpeg',
            		'image/png',
            	),
            	new ezcImageSaveOptions(array('quality' => (int)95))
            );
                    
        }
   
   
    public static function getInstance()  
    {
        if ( is_null( self::$instance ) )
        {          
            self::$instance = new erLhcoreClassImageConverter();            
        }
        return self::$instance;
    }
    
    public static function isPhoto($file)
    { 
       if ($_FILES[$file]['error'] == 0)
       {       
           try {
               $image = new ezcImageAnalyzer( $_FILES[$file]['tmp_name'] );            
               if ($image->data->size < ((int)erLhcoreClassModelSystemConfig::fetch('max_photo_size')->current_value*1024) && $image->data->width > 10 && $image->data->height > 10)
               {                   
                   return true;                   
                   
               } else 
               
               return false;
           } catch (Exception $e) {
               return false;
           }
       
       } else {
           return false;
       } 
    }
    
    public static function handleUpload(& $image,$params = array())
    {        
        $photoDir = $params['photo_dir'];
        $fileNamePhysic = $params['file_name_physic'];
        $fileSession = $params['file_session'];
        
        $config = erConfigClassLhConfig::getInstance();
        
        if ($config->getSetting( 'site', 'file_storage_backend' ) == 'filesystem')
        {
            erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumbbig', $_FILES[$params['post_file_name']]['tmp_name'], $photoDir.'/normal_'.$fileNamePhysic ); 
            erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumb', $_FILES[$params['post_file_name']]['tmp_name'], $photoDir.'/thumb_'.$fileNamePhysic ); 
           	       
            chmod($photoDir.'/normal_'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
            chmod($photoDir.'/thumb_'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
           
            $dataWatermark = erLhcoreClassModelSystemConfig::fetch('watermark_data')->data;	       
            // If watermark have to be applied we use conversion othwrwise just upload original to avoid any quality loose.
            if ($dataWatermark['watermark_disabled'] == false && $dataWatermark['watermark_enabled_all'] == true) {	       	
            	erLhcoreClassImageConverter::getInstance()->converter->transform( 'jpeg', $_FILES[$params['post_file_name']]['tmp_name'], $photoDir.'/'.$fileNamePhysic ); 
            } else  {
           		move_uploaded_file($_FILES[$params['post_file_name']]["tmp_name"],$photoDir.'/'.$fileNamePhysic);
            }
           
            chmod($photoDir.'/'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
           
            $image->filesize = filesize($photoDir.'/'.$fileNamePhysic);
            $image->total_filesize = filesize($photoDir.'/'.$fileNamePhysic)+filesize($photoDir.'/thumb_'.$fileNamePhysic)+filesize($photoDir.'/normal_'.$fileNamePhysic);
            $image->filepath = $params['photo_dir_photo'];
           
            $imageAnalyze = new ezcImageAnalyzer( $photoDir.'/'.$fileNamePhysic ); 	       
            $image->pwidth = $imageAnalyze->data->width;
            $image->pheight = $imageAnalyze->data->height;
            $image->filename = $fileNamePhysic;
            
        } elseif ($config->getSetting( 'site', 'file_storage_backend' ) == 'amazons3') { 
            $fileNamePhysic = erLhcoreClassModelForgotPassword::randomPassword(5).time().$fileNamePhysic;  

            erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumbbig', $_FILES[$params['post_file_name']]['tmp_name'], 'var/tmpupload/normal_'.$fileNamePhysic );                         
            erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumb', $_FILES[$params['post_file_name']]['tmp_name'], 'var/tmpupload/thumb_'.$fileNamePhysic ); 
                       
            $dataWatermark = erLhcoreClassModelSystemConfig::fetch('watermark_data')->data;	       
            // If watermark have to be applied we use conversion othwrwise just upload original to avoid any quality loose.
            if ($dataWatermark['watermark_disabled'] == false && $dataWatermark['watermark_enabled_all'] == true) {	       	
            	erLhcoreClassImageConverter::getInstance()->converter->transform( 'jpeg', $_FILES[$params['post_file_name']]['tmp_name'], 'var/tmpupload/'.$fileNamePhysic ); 
            } else  {
           		move_uploaded_file($_FILES[$params['post_file_name']]["tmp_name"],'var/tmpupload/'.$fileNamePhysic);
            }
                        
            $image->filesize = filesize('var/tmpupload/'.$fileNamePhysic);
            $image->total_filesize = filesize('var/tmpupload/'.$fileNamePhysic)+filesize('var/tmpupload/thumb_'.$fileNamePhysic)+filesize('var/tmpupload/normal_'.$fileNamePhysic);
            $image->filepath = $params['photo_dir_photo'];
            
            $imageAnalyze = new ezcImageAnalyzer( 'var/tmpupload/'.$fileNamePhysic ); 	       
            $image->pwidth = $imageAnalyze->data->width;
            $image->pheight = $imageAnalyze->data->height;
                       
            S3::setAuth($config->getSetting( 'amazons3', 'aws_access_key' ), $config->getSetting( 'amazons3', 'aws_secret_key'));            
            S3::putObject(S3::inputFile('var/tmpupload/thumb_' . $fileNamePhysic, false), $config->getSetting( 'amazons3', 'bucket' ), $photoDir . '/thumb_'.$fileNamePhysic, S3::ACL_PUBLIC_READ);
            S3::putObject(S3::inputFile('var/tmpupload/normal_' . $fileNamePhysic, false), $config->getSetting( 'amazons3', 'bucket' ), $photoDir . '/normal_'.$fileNamePhysic, S3::ACL_PUBLIC_READ);
            S3::putObject(S3::inputFile('var/tmpupload/' . $fileNamePhysic, false), $config->getSetting( 'amazons3', 'bucket' ), $photoDir . '/'.$fileNamePhysic, S3::ACL_PUBLIC_READ);
            
            $image->filename = $fileNamePhysic;
            
            unlink('var/tmpupload/'.$fileNamePhysic);
            unlink('var/tmpupload/normal_'.$fileNamePhysic);
            unlink('var/tmpupload/thumb_'.$fileNamePhysic);
        }
    }
    
    // Handles uploads from archive
    public static function handleUploadLocal(& $image,$params = array())
    {
        $photoDir = $params['photo_dir'];
        $fileNamePhysic = $params['file_name_physic'];
        $fileSession = $params['file_session'];
        $pathExtracted = $params['post_file_name'];
        $album = $params['album'];
        
        $config = erConfigClassLhConfig::getInstance();
        
        if ($config->getSetting( 'site', 'file_storage_backend' ) == 'filesystem')
        {
            $wwwUser = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'default_www_user' );
       		$wwwUserGroup = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'default_www_group' );
       		    
            erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumbbig', $pathExtracted, $photoDir.'/normal_'.$fileNamePhysic );
        	erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumb',$pathExtracted, $photoDir.'/thumb_'.$fileNamePhysic );
        					    	
        	$dataWatermark = erLhcoreClassModelSystemConfig::fetch('watermark_data')->data;	       
    		// If watermark have to be applied we use conversion othwrwise just upload original to avoid any quality loose.
    		if ($dataWatermark['watermark_disabled'] == false && $dataWatermark['watermark_enabled_all'] == true) {	       	
    				erLhcoreClassImageConverter::getInstance()->converter->transform( 'jpeg', $pathExtracted, $photoDir.'/'.$fileNamePhysic ); 
    		} else  {
    				rename($pathExtracted,$photoDir.'/'.$fileNamePhysic);
    		}
    		
        	chown($photoDir.'/'.$fileNamePhysic,$wwwUser);
        	chown($photoDir.'/normal_'.$fileNamePhysic,$wwwUser);
        	chown($photoDir.'/thumb_'.$fileNamePhysic,$wwwUser);
        	
        	chgrp($photoDir.'/'.$fileNamePhysic,$wwwUserGroup);
        	chgrp($photoDir.'/normal_'.$fileNamePhysic,$wwwUserGroup);
        	chgrp($photoDir.'/thumb_'.$fileNamePhysic,$wwwUserGroup);
        					    					    	
        	chmod($photoDir.'/'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
        	chmod($photoDir.'/normal_'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
        	chmod($photoDir.'/thumb_'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
        	
        	$image->filesize = filesize($photoDir.'/'.$fileNamePhysic);
        	$image->total_filesize = filesize($photoDir.'/'.$fileNamePhysic)+filesize($photoDir.'/thumb_'.$fileNamePhysic)+filesize($photoDir.'/normal_'.$fileNamePhysic);
        	$image->filepath = $params['photo_dir_photo'];
    
        	$imageAnalyze = new ezcImageAnalyzer( $photoDir.'/'.$fileNamePhysic );
        	$image->pwidth = $imageAnalyze->data->width;
        	$image->pheight = $imageAnalyze->data->height;
        	$image->hits = 0;
        } elseif ($config->getSetting( 'site', 'file_storage_backend' ) == 'amazons3') { 

            erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumbbig', $pathExtracted, 'var/tmpupload/normal_'.$fileNamePhysic );
        	erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumb',$pathExtracted, 'var/tmpupload/thumb_'.$fileNamePhysic );

        	$dataWatermark = erLhcoreClassModelSystemConfig::fetch('watermark_data')->data;	       
    		// If watermark have to be applied we use conversion othwrwise just upload original to avoid any quality loose.
    		if ($dataWatermark['watermark_disabled'] == false && $dataWatermark['watermark_enabled_all'] == true) {	       	
    				erLhcoreClassImageConverter::getInstance()->converter->transform( 'jpeg', $pathExtracted, $pathExtracted ); 
    		}

        	$image->filesize = filesize($pathExtracted);
        	$image->total_filesize = filesize($pathExtracted)+filesize('var/tmpupload/normal_'.$fileNamePhysic )+filesize('var/tmpupload/thumb_'.$fileNamePhysic);
        	$image->filepath = $params['photo_dir_photo'];

        	$imageAnalyze = new ezcImageAnalyzer( $pathExtracted );
        	$image->pwidth = $imageAnalyze->data->width;
        	$image->pheight = $imageAnalyze->data->height;
        	$image->hits = 0;

        	S3::setAuth($config->getSetting( 'amazons3', 'aws_access_key' ), $config->getSetting( 'amazons3', 'aws_secret_key'));            
            S3::putObject(S3::inputFile('var/tmpupload/thumb_' . $fileNamePhysic, false), $config->getSetting( 'amazons3', 'bucket' ), $photoDir . '/thumb_' . $fileNamePhysic, S3::ACL_PUBLIC_READ);
            S3::putObject(S3::inputFile('var/tmpupload/normal_' . $fileNamePhysic, false), $config->getSetting( 'amazons3', 'bucket' ), $photoDir . '/normal_' . $fileNamePhysic, S3::ACL_PUBLIC_READ);
            S3::putObject(S3::inputFile($pathExtracted, false), $config->getSetting( 'amazons3', 'bucket' ), $photoDir . '/' . $fileNamePhysic, S3::ACL_PUBLIC_READ);

        	unlink($pathExtracted);
            unlink('var/tmpupload/normal_'.$fileNamePhysic);
            unlink('var/tmpupload/thumb_'.$fileNamePhysic);
        }
    }
    
    // Handles uploads from batch
    public static function handleUploadBatch(& $image,$params = array())
    {
        $photoDir = $params['photo_dir'];
        $fileNamePhysic = $params['file_name_physic'];
        $imagePath = $params['post_file_name'];

        $config = erConfigClassLhConfig::getInstance();

        if ($config->getSetting( 'site', 'file_storage_backend' ) == 'filesystem')
        {
            erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumbbig', $imagePath, $photoDir.'/normal_'.$fileNamePhysic );
        	erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumb',$imagePath, $photoDir.'/thumb_'.$fileNamePhysic );
        					    	
        	$dataWatermark = erLhcoreClassModelSystemConfig::fetch('watermark_data')->data;	       
    		// If watermark have to be applied we use conversion othwrwise just upload original to avoid any quality loose.
    		if ($dataWatermark['watermark_disabled'] == false && $dataWatermark['watermark_enabled_all'] == true) {	       	
    				erLhcoreClassImageConverter::getInstance()->converter->transform( 'jpeg', $imagePath, $imagePath ); 
    				chmod($imagePath,$config->getSetting( 'site', 'StorageFilePermissions' ));
    		}
    		
        	chmod($photoDir.'/normal_'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
        	chmod($photoDir.'/thumb_'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
        	
        	$image->filesize = filesize($imagePath);
            $image->total_filesize = $image->filesize;
    
        	$imageAnalyze = new ezcImageAnalyzer( $imagePath ); 	       
            $image->pwidth = $imageAnalyze->data->width;
            $image->pheight = $imageAnalyze->data->height;
    
        	$image->hits = 0;
        	 	
        } elseif ($config->getSetting( 'site', 'file_storage_backend' ) == 'amazons3') { 

            erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumbbig', $imagePath, $photoDir.'/normal_'.$fileNamePhysic );
        	erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumb',$imagePath, $photoDir.'/thumb_'.$fileNamePhysic );
        					    	
        	$dataWatermark = erLhcoreClassModelSystemConfig::fetch('watermark_data')->data;	       
    		// If watermark have to be applied we use conversion othwrwise just upload original to avoid any quality loose.
    		if ($dataWatermark['watermark_disabled'] == false && $dataWatermark['watermark_enabled_all'] == true) {	       	
    				erLhcoreClassImageConverter::getInstance()->converter->transform( 'jpeg', $imagePath, $imagePath ); 
    				chmod($imagePath,$config->getSetting( 'site', 'StorageFilePermissions' ));
    		}
    		
        	chmod($photoDir.'/normal_'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
        	chmod($photoDir.'/thumb_'.$fileNamePhysic,$config->getSetting( 'site', 'StorageFilePermissions' ));
        	
        	$image->filesize = filesize($imagePath);
            $image->total_filesize = $image->filesize;

        	$imageAnalyze = new ezcImageAnalyzer( $imagePath ); 	       
            $image->pwidth = $imageAnalyze->data->width;
            $image->pheight = $imageAnalyze->data->height;
            
        	$image->hits = 0;
    
        	S3::setAuth($config->getSetting( 'amazons3', 'aws_access_key' ), $config->getSetting( 'amazons3', 'aws_secret_key'));            
            S3::putObject(S3::inputFile($photoDir.'/thumb_'.$fileNamePhysic, false), $config->getSetting( 'amazons3', 'bucket' ), $photoDir . '/thumb_' . $fileNamePhysic, S3::ACL_PUBLIC_READ);
            S3::putObject(S3::inputFile($photoDir.'/normal_'.$fileNamePhysic, false), $config->getSetting( 'amazons3', 'bucket' ), $photoDir . '/normal_' . $fileNamePhysic, S3::ACL_PUBLIC_READ);
            S3::putObject(S3::inputFile($imagePath, false), $config->getSetting( 'amazons3', 'bucket' ), $photoDir . '/' . $fileNamePhysic, S3::ACL_PUBLIC_READ);
        	
            // Delete created variations, because they are in cloud now
            unlink($photoDir.'/normal_'.$fileNamePhysic);
        	unlink($photoDir.'/thumb_'.$fileNamePhysic);
        }
    }
    
    public static function isPhotoLocal($filePAth)
    {              
           try {
               $image = new ezcImageAnalyzer( $filePAth );            
               if ($image->data->size < ((int)erLhcoreClassModelSystemConfig::fetch('max_photo_size')->current_value*1024) && $image->data->width > 10 && $image->data->height > 10)
               {                   
                   return true;                   
                   
               } else                
               return false;
           } catch (Exception $e) {
               return false;
           }  
    }
    
    // Borowed from coppermine gallery
    public static function sanitizeFileName($str)
    {  
       static $forbidden_chars;
      if (!is_array($forbidden_chars)) {
        $mb_utf8_regex = '[\xE1-\xEF][\x80-\xBF][\x80-\xBF]|\xE0[\xA0-\xBF][\x80-\xBF]|[\xC2-\xDF][\x80-\xBF]';
        if (function_exists('html_entity_decode')) {
          $chars = html_entity_decode('$/\\:*?&quot;&#39;&lt;&gt;|` &amp;', ENT_QUOTES, 'UTF-8');
        } else {
          $chars = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;', '&nbsp;', '&#39;'), array('&', '"', '<', '>', ' ', "'"), $CONFIG['forbiden_fname_char']);
        }
        preg_match_all("#$mb_utf8_regex".'|[\x00-\x7F]#', $chars, $forbidden_chars);
      }
      /**
       * $str may also come from $_POST, in this case, all &, ", etc will get replaced with entities.
       * Replace them back to normal chars so that the str_replace below can work.
       */
      $str = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $str);;
      $return = str_replace($forbidden_chars[0], '-', $str);
      $return = str_replace(array(')','('), array('',''), $return);
      $return = str_replace(' ', '-', $return);
    
      /**
      * Fix the obscure, misdocumented "feature" in Apache that causes the server
      * to process the last "valid" extension in the filename (rar exploit): replace all
      * dots in the filename except the last one with an underscore.
      */
      // This could be concatenated into a more efficient string later, keeping it in three
      // lines for better readability for now.
      $extension = strtolower(ltrim(substr($return,strrpos($return,'.')),'.'));
      $filenameWithoutExtension = str_replace('.' . $extension, '', $return);
      $return = str_replace('.', '-', $filenameWithoutExtension) .'.' . $extension;
      return $return;
    }
    
    public static function getExtension($fileName) {
        return current(end(explode('.',$fileName)));
    }
    
    public static function mkdirRecursive($path, $chown = false) {        
        $partsPath = explode('/',$path);
        $pathCurrent = '';
        
        $config = erConfigClassLhConfig::getInstance();
        $wwwUser = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'default_www_user' );
   		$wwwUserGroup = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'default_www_group' );
   		   		
        foreach ($partsPath as $key => $path)
        {
            $pathCurrent .= $path . '/';
            if ( !is_dir($pathCurrent) ) {
                mkdir($pathCurrent,$config->getSetting( 'site', 'StorageDirPermissions' ));
                if ($chown == true){
                    chown($pathCurrent,$wwwUser);
				    chgrp($pathCurrent,$wwwUserGroup);
                }
            }
        }
    }
    
    public static function hasFiles($sourceDir)
    {
        if ( !is_dir( $sourceDir ) )
        {
             return true;
        }
        
        $elements = array();
        $d = @dir( $sourceDir );
        if ( !$d )
        {
            return true;
        }

        while ( ( $entry = $d->read() ) !== false )
        {
            if ( $entry == '.' || $entry == '..' )
            {
                continue;
            }
                        
            return true;            
        }      
        
        return false;
    }

    public static function removeRecursiveIfEmpty($basePath,$removePath)
    {
        $removePath = trim($removePath,'/');
        $partsRemove = explode('/',$removePath);
        
        $pathElementsCount = count($partsRemove);               
        foreach ($partsRemove as $part) {
    		// We found some files/folders, so we have to exit    		
    		if (self::hasFiles( $basePath . implode('/',$partsRemove) ) === true) {
    		    return ;
    		} else {     		
    		    //Folder is empty, delete this folder
    		    @rmdir($basePath . implode('/',$partsRemove));
    		}
    		array_pop($partsRemove);		
        } 
    }
}

?>