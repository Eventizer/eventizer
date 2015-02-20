<?php

try {

$cfgSite = erConfigClassLhConfig::getInstance();

if ($cfgSite->getSetting( 'site', 'installed' ) == true)
{
    $Params['module']['functions'] = array('install');
    include_once('modules/lhkernel/nopermission.php');

    $Result['pagelayout'] = 'install';
    $Result['path'] = array(array('title' => 'Eventizer installation'));
    return $Result;

    exit;
}

$instance = erLhcoreClassSystem::instance();

if ($instance->SiteAccess != 'site_admin') {
    header('Location: ' .erLhcoreClassDesign::baseurldirect('site_admin/install/install') );
    exit;
}

$tpl = new erLhcoreClassTemplate( 'lhinstall/install1.tpl.php');

switch ((int)$Params['user_parameters']['step_id']) {

	case '1':
	   
		$Errors = array();
        if (!is_writable("cache/cacheconfig"))
	       $Errors[] = "cache/cacheconfig is not writable";
	    if (!is_writable("settings/"))
	       $Errors[] = "settings/ is not writable";
		if (!is_writable("cache/translations"))
	       $Errors[] = "cache/translations is not writable";
		if (!is_writable("cache/userinfo"))
	       $Errors[] = "cache/userinfo is not writable";
		if (!is_writable("cache/compiledtemplates"))
	       $Errors[] = "cache/compiledtemplates is not writable";
		if (!is_writable("var/storage"))
	       $Errors[] = "var/storage is not writable";
		if (!is_writable("var/userphoto"))
	       $Errors[] = "var/userphoto is not writable";
		if (!is_writable("var/tmpfiles"))
	       $Errors[] = "var/tmpfiles is not writable";
		if (!is_writable("var/media_static"))
		    $Errors[] = "var/media_static is not writable";
		if (!is_writable("var/media"))
		    $Errors[] = "var/media is not writable";
		if (!is_writable("var/events"))
		    $Errors[] = "var/events is not writable";
		if (!extension_loaded ('pdo_mysql' ))
	       $Errors[] = "php-pdo extension not detected. Please install php extension";
		
		if (!extension_loaded('curl'))
			$Errors[] = "php_curl extension not detected. Please install php extension";	
		
		if (!extension_loaded('mbstring'))
			$Errors[] = "mbstring extension not detected. Please install php extension";	
		
		if (!extension_loaded('gd'))
			$Errors[] = "gd extension not detected. Please install php extension";	
		
		if (!function_exists('json_encode'))
			$Errors[] = "json support not detected. Please install php extension";	
		
		if (version_compare(PHP_VERSION, '5.4.0','<')) {
			$Errors[] = "Minimum 5.4.0 PHP version is required";	
		}

	    if (count($Errors) == 0)
	        $tpl->setFile('lhinstall/install2.tpl.php');
	  break;

	  case '2':
		$Errors = array();

		$definition = array(
            'DatabaseUsername' => new ezcInputFormDefinitionElement(
                ezcInputFormDefinitionElement::REQUIRED, 'string'
            ),
            'DatabasePassword' => new ezcInputFormDefinitionElement(
                ezcInputFormDefinitionElement::REQUIRED, 'string'
            ),
            'DatabaseHost' => new ezcInputFormDefinitionElement(
                ezcInputFormDefinitionElement::REQUIRED, 'string'
            ),
            'DatabasePort' => new ezcInputFormDefinitionElement(
                ezcInputFormDefinitionElement::REQUIRED, 'int'
            ),
            'DatabaseDatabaseName' => new ezcInputFormDefinitionElement(
                ezcInputFormDefinitionElement::REQUIRED, 'string'
            ),
        );

	   $form = new ezcInputForm( INPUT_POST, $definition );


	   if ( !$form->hasValidData( 'DatabaseUsername' ) )
       {
           $Errors[] = 'Please enter database username';
       }

	   if ( !$form->hasValidData( 'DatabasePassword' ) )
       {
           $Errors[] = 'Please enter database password';
       }

	   if ( !$form->hasValidData( 'DatabaseHost' ) || $form->DatabaseHost == '' )
       {
           $Errors[] = 'Please enter database host';
       }

	   if ( !$form->hasValidData( 'DatabasePort' ) || $form->DatabasePort == '' )
       {
           $Errors[] = 'Please enter database post';
       }

	   if ( !$form->hasValidData( 'DatabaseDatabaseName' ) || $form->DatabaseDatabaseName == '' )
       {
           $Errors[] = 'Please enter database name';
       }

       if (count($Errors) == 0)
       {
           try {
           	$db = ezcDbFactory::create( "mysql://{$form->DatabaseUsername}:{$form->DatabasePassword}@{$form->DatabaseHost}:{$form->DatabasePort}/{$form->DatabaseDatabaseName}" );
           } catch (Exception $e) {
                  $Errors[] = 'Cannot login with provided logins. Returned message: <br/>'.$e->getMessage();
           }
       }

	       if (count($Errors) == 0){

	           $cfgSite = erConfigClassLhConfig::getInstance();
	           $cfgSite->setSetting( 'db', 'host', $form->DatabaseHost);
	           $cfgSite->setSetting( 'db', 'user', $form->DatabaseUsername);
	           $cfgSite->setSetting( 'db', 'password', $form->DatabasePassword);
	           $cfgSite->setSetting( 'db', 'database', $form->DatabaseDatabaseName);
	           $cfgSite->setSetting( 'db', 'port', $form->DatabasePort);

	           $cfgSite->setSetting( 'site', 'secrethash', substr(md5(time() . ":" . mt_rand()),0,10));

	           $cfgSite->save();

	           $tpl->setFile('lhinstall/install3.tpl.php');
	       } else {

	          $tpl->set('db_username',$form->DatabaseUsername);
	          $tpl->set('db_password',$form->DatabasePassword);
	          $tpl->set('db_host',$form->DatabaseHost);
	          $tpl->set('db_port',$form->DatabasePort);
	          $tpl->set('db_name',$form->DatabaseDatabaseName);

	          $tpl->set('errors',$Errors);
	          $tpl->setFile('lhinstall/install2.tpl.php');
	       }
	  break;

	case '3':

	    $Errors = array();

	    if ($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
    		$definition = array(
                'AdminUsername' => new ezcInputFormDefinitionElement(
                    ezcInputFormDefinitionElement::REQUIRED, 'string'
                ),
                'AdminPassword' => new ezcInputFormDefinitionElement(
                    ezcInputFormDefinitionElement::REQUIRED, 'string'
                ),
                'AdminPassword1' => new ezcInputFormDefinitionElement(
                    ezcInputFormDefinitionElement::REQUIRED, 'string'
                ),
                'AdminEmail' => new ezcInputFormDefinitionElement(
                    ezcInputFormDefinitionElement::REQUIRED, 'validate_email'
                ),
                'AdminName' => new ezcInputFormDefinitionElement(
                    ezcInputFormDefinitionElement::OPTIONAL, 'string'
                ),
                'AdminSurname' => new ezcInputFormDefinitionElement(
                    ezcInputFormDefinitionElement::OPTIONAL, 'string'
                )
            );

    	    $form = new ezcInputForm( INPUT_POST, $definition );


    	    if ( !$form->hasValidData( 'AdminUsername' ) || $form->AdminUsername == '')
            {
                $Errors[] = 'Please enter admin username';
            }

            if ($form->hasValidData( 'AdminUsername' ) && $form->AdminUsername != '' && strlen($form->AdminUsername) > 10)
            {
                $Errors[] = 'Maximum 10 characters for admin username';
            }

    	    if ( !$form->hasValidData( 'AdminPassword' ) || $form->AdminPassword == '')
            {
                $Errors[] = 'Please enter admin password';
            }

    	    if ($form->hasValidData( 'AdminPassword' ) && $form->AdminPassword != '' && strlen($form->AdminPassword) > 10)
            {
                $Errors[] = 'Maximum 10 characters for admin password';
            }

    	    if ($form->hasValidData( 'AdminPassword' ) && $form->AdminPassword != '' && strlen($form->AdminPassword) <= 10 && $form->AdminPassword1 != $form->AdminPassword)
            {
                $Errors[] = 'Passwords missmatch';
            }


    	    if ( !$form->hasValidData( 'AdminEmail' ) )
            {
                $Errors[] = 'Wrong email address';
            }


           

            if (count($Errors) == 0) {

               $tpl->set('admin_username',$form->AdminUsername);
               $adminEmail = '';
               if ( $form->hasValidData( 'AdminEmail' ) ) {
               		$tpl->set('admin_email',$form->AdminEmail);
               		$adminEmail = $form->AdminEmail;
               }
    	       $tpl->set('admin_name',$form->AdminName);
    	       $tpl->set('admin_surname',$form->AdminSurname);

    	       /*DATABASE TABLES SETUP*/
    	       $db = ezcDbInstance::get();

    	       //create event categories
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_abstract_country` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(200) NOT NULL,
                  `iso_code` varchar(3) NOT NULL,
                  `position` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
                ) DEFAULT CHARSET=utf8;");
        	   
    	       
        	   //insert countries
        	   $db->query("INSERT INTO `lh_abstract_country` (`id`, `name`, `iso_code`, `position`) VALUES
                    (1, 'Afghanistan', 'AF', 0),
                    (2, 'Åland Islands', 'AX', 0),
                    (3, 'Albania', 'AL', 0),
                    (4, 'Algeria', 'DZ', 0),
                    (5, 'American Samoa', 'AS', 0),
                    (6, 'Andorra', 'AD', 0),
                    (7, 'Angola', 'AO', 0),
                    (8, 'Anguilla', 'AI', 0),
                    (10, 'Antigua and Barbuda', 'AG', 0),
                    (11, 'Argentina', 'AR', 0),
                    (12, 'Armenia', 'AM', 0),
                    (13, 'Aruba', 'AW', 0),
                    (14, 'Australia', 'AU', 0),
                    (15, 'Austria', 'AT', 0),
                    (16, 'Azerbaijan', 'AZ', 0),
                    (17, 'Bahamas', 'BS', 0),
                    (18, 'Bahrain', 'BH', 0),
                    (19, 'Bangladesh', 'BD', 0),
                    (20, 'Barbados', 'BB', 0),
                    (21, 'Belarus', 'BY', 0),
                    (22, 'Belgium', 'BE', 0),
                    (23, 'Belize', 'BZ', 0),
                    (24, 'Benin', 'BJ', 0),
                    (25, 'Bermuda', 'BM', 0),
                    (26, 'Bhutan', 'BT', 0),
                    (27, 'Bolivia', 'BO', 0),
                    (28, 'Bosnia and Herzegovina', 'BA', 0),
                    (29, 'Botswana', 'BW', 0),
                    (30, 'Bouvet Island', 'BV', 0),
                    (31, 'Brazil', 'BR', 0),
                    (33, 'Brunei', 'BN', 0),
                    (34, 'Bulgaria', 'BG', 0),
                    (35, 'Burkina Faso', 'BF', 0),
                    (36, 'Burma (Myanmar)', 'MM', 0),
                    (37, 'Burundi', 'BI', 0),
                    (38, 'Cambodia', 'KH', 0),
                    (39, 'Cameroon', 'CM', 0),
                    (40, 'Canada', 'CA', 0),
                    (41, 'Cape Verde', 'CV', 0),
                    (42, 'Cayman Islands', 'KY', 0),
                    (43, 'Central African Republic', 'CF', 0),
                    (44, 'Chad', 'TD', 0),
                    (45, 'Chile', 'CL', 0),
                    (46, 'China', 'CN', 0),
                    (47, 'Christmas Island', 'CX', 0),
                    (48, 'Cocos (Keeling) Islands', 'CC', 0),
                    (49, 'Colombia', 'CO', 0),
                    (50, 'Comoros', 'KM', 0),
                    (51, 'Congo, Dem. Republic', 'CD', 0),
                    (52, 'Congo, Republic', 'CG', 0),
                    (53, 'Cook Islands', 'CK', 0),
                    (54, 'Costa Rica', 'CR', 0),
                    (55, 'Croatia', 'HR', 0),
                    (56, 'Cuba', 'CU', 0),
                    (57, 'Cyprus', 'CY', 0),
                    (58, 'Czech Republic', 'CZ', 0),
                    (59, 'Denmark', 'DK', 0),
                    (60, 'Djibouti', 'DJ', 0),
                    (61, 'Dominica', 'DM', 0),
                    (63, 'East Timor', 'TL', 0),
                    (64, 'Ecuador', 'EC', 0),
                    (65, 'Egypt', 'EG', 0),
                    (66, 'El Salvador', 'SV', 0),
                    (67, 'Equatorial Guinea', 'GQ', 0),
                    (68, 'Eritrea', 'ER', 0),
                    (69, 'Estonia', 'EE', 0),
                    (70, 'Ethiopia', 'ET', 0),
                    (71, 'Falkland Islands', 'FK', 0),
                    (72, 'Faroe Islands', 'FO', 0),
                    (73, 'Fiji', 'FJ', 0),
                    (74, 'Finland', 'FI', 0),
                    (75, 'France', 'FR', 0),
                    (79, 'Gabon', 'GA', 0),
                    (80, 'Gambia', 'GM', 0),
                    (81, 'Georgia', 'GE', 0),
                    (82, 'Germany', 'DE', 0),
                    (83, 'Ghana', 'GH', 0),
                    (84, 'Gibraltar', 'GI', 0),
                    (85, 'Greece', 'GR', 0),
                    (86, 'Greenland', 'GL', 0),
                    (87, 'Grenada', 'GD', 0),
                    (88, 'Guadeloupe', 'GP', 0),
                    (89, 'Guam', 'GU', 0),
                    (90, 'Guatemala', 'GT', 0),
                    (91, 'Guernsey', 'GG', 0),
                    (92, 'Guinea', 'GN', 0),
                    (93, 'Guinea-Bissau', 'GW', 0),
                    (94, 'Guyana', 'GY', 0),
                    (95, 'Haiti', 'HT', 0),
                    (97, 'Honduras', 'HN', 0),
                    (99, 'Hungary', 'HU', 0),
                    (100, 'Iceland', 'IS', 0),
                    (101, 'India', 'IN', 0),
                    (102, 'Indonesia', 'ID', 0),
                    (103, 'Iran', 'IR', 0),
                    (104, 'Iraq', 'IQ', 0),
                    (105, 'Ireland', 'IE', 0),
                    (106, 'Israel', 'IL', 0),
                    (107, 'Italy', 'IT', 0),
                    (108, 'Ivory Coast', 'CI', 0),
                    (109, 'Jamaica', 'JM', 0),
                    (110, 'Japan', 'JP', 0),
                    (111, 'Jersey', 'JE', 0),
                    (112, 'Jordan', 'JO', 0),
                    (113, 'Kazakhstan', 'KZ', 0),
                    (114, 'Kenya', 'KE', 0),
                    (115, 'Kiribati', 'KI', 0),
                    (116, 'Korea, Dem. Republic ', 'KP', 0),
                    (117, 'Kuwait', 'KW', 0),
                    (118, 'Kyrgyzstan', 'KG', 0),
                    (119, 'Laos', 'LA', 0),
                    (120, 'Latvia', 'LV', 0),
                    (121, 'Lebanon', 'LB', 0),
                    (122, 'Lesotho', 'LS', 0),
                    (123, 'Liberia', 'LR', 0),
                    (124, 'Libya', 'LY', 0),
                    (125, 'Liechtenstein', 'LI', 0),
                    (126, 'Lithuania', 'LT', 0),
                    (127, 'Luxemburg', 'LU', 0),
                    (128, 'Macau', 'MO', 0),
                    (129, 'Macedonia', 'MK', 0),
                    (130, 'Madagascar', 'MG', 0),
                    (131, 'Malawi', 'MW', 0),
                    (132, 'Malaysia', 'MY', 0),
                    (133, 'Maldives', 'MV', 0),
                    (134, 'Mali', 'ML', 0),
                    (135, 'Malta', 'MT', 0),
                    (136, 'Man Island', 'IM', 0),
                    (137, 'Marshall Islands', 'MH', 0),
                    (138, 'Martinique', 'MQ', 0),
                    (139, 'Mauritania', 'MR', 0),
                    (140, 'Mauritius', 'MU', 0),
                    (141, 'Mayotte', 'YT', 0),
                    (142, 'Mexico', 'MX', 0),
                    (143, 'Micronesia', 'FM', 0),
                    (144, 'Moldova', 'MD', 0),
                    (145, 'Monaco', 'MC', 0),
                    (146, 'Mongolia', 'MN', 0),
                    (147, 'Montenegro', 'ME', 0),
                    (148, 'Montserrat', 'MS', 0),
                    (149, 'Morocco', 'MA', 0),
                    (150, 'Mozambique', 'MZ', 0),
                    (151, 'Namibia', 'NA', 0),
                    (152, 'Nauru', 'NR', 0),
                    (153, 'Nepal', 'NP', 0),
                    (154, 'Netherlands', 'NL', 0),
                    (155, 'Netherlands Antilles', 'AN', 0),
                    (156, 'New Caledonia', 'NC', 0),
                    (157, 'New Zealand', 'NZ', 0),
                    (158, 'Nicaragua', 'NI', 0),
                    (159, 'Niger', 'NE', 0),
                    (160, 'Nigeria', 'NG', 0),
                    (161, 'Niue', 'NU', 0),
                    (162, 'Norfolk Island', 'NF', 0),
                    (163, 'Northern Mariana Islands', 'MP', 0),
                    (164, 'Norway', 'NO', 0),
                    (165, 'Oman', 'OM', 0),
                    (166, 'Pakistan', 'PK', 0),
                    (167, 'Palau', 'PW', 0),
                    (168, 'Palestinian Territories', 'PS', 0),
                    (169, 'Panama', 'PA', 0),
                    (170, 'Papua New Guinea', 'PG', 0),
                    (171, 'Paraguay', 'PY', 0),
                    (172, 'Peru', 'PE', 0),
                    (173, 'Philippines', 'PH', 0),
                    (174, 'Pitcairn', 'PN', 0),
                    (175, 'Poland', 'PL', 0),
                    (176, 'Portugal', 'PT', 0),
                    (177, 'Puerto Rico', 'PR', 0),
                    (178, 'Qatar', 'QA', 0),
                    (179, 'Reunion Island', 'RE', 0),
                    (180, 'Romania', 'RO', 0),
                    (181, 'Russian Federation', 'RU', 0),
                    (182, 'Rwanda', 'RW', 0),
                    (183, 'Saint Barthelemy', 'BL', 0),
                    (184, 'Saint Kitts and Nevis', 'KN', 0),
                    (185, 'Saint Lucia', 'LC', 0),
                    (186, 'Saint Martin', 'MF', 0),
                    (187, 'Saint Pierre and Miquelon', 'PM', 0),
                    (188, 'Saint Vincent and the Grenadines', 'VC', 0),
                    (189, 'Samoa', 'WS', 0),
                    (190, 'San Marino', 'SM', 0),
                    (191, 'São Tomé and Príncipe', 'ST', 0),
                    (192, 'Saudi Arabia', 'SA', 0),
                    (193, 'Senegal', 'SN', 0),
                    (194, 'Serbia', 'RS', 0),
                    (195, 'Seychelles', 'SC', 0),
                    (196, 'Sierra Leone', 'SL', 0),
                    (197, 'Singapore', 'SG', 0),
                    (198, 'Slovakia', 'SK', 0),
                    (199, 'Slovenia', 'SI', 0),
                    (200, 'Solomon Islands', 'SB', 0),
                    (201, 'Somalia', 'SO', 0),
                    (202, 'South Africa', 'ZA', 0),
                    (203, 'South Georgia and the South Sandwich Islands', 'GS', 0),
                    (204, 'South Korea', 'KR', 0),
                    (205, 'Spain', 'ES', 0),
                    (206, 'Sri Lanka', 'LK', 0),
                    (207, 'Sudan', 'SD', 0),
                    (208, 'Suriname', 'SR', 0),
                    (209, 'Svalbard and Jan Mayen', 'SJ', 0),
                    (210, 'Swaziland', 'SZ', 0),
                    (211, 'Sweden', 'SE', 0),
                    (212, 'Switzerland', 'CH', 0),
                    (213, 'Syria', 'SY', 0),
                    (214, 'Taiwan', 'TW', 0),
                    (215, 'Tajikistan', 'TJ', 0),
                    (216, 'Tanzania', 'TZ', 0),
                    (217, 'Thailand', 'TH', 0),
                    (218, 'Togo', 'TG', 0),
                    (219, 'Tokelau', 'TK', 0),
                    (220, 'Tonga', 'TO', 0),
                    (221, 'Trinidad and Tobago', 'TT', 0),
                    (222, 'Tunisia', 'TN', 0),
                    (223, 'Turkey', 'TR', 0),
                    (224, 'Turkmenistan', 'TM', 0),
                    (226, 'Tuvalu', 'TV', 0),
                    (227, 'Uganda', 'UG', 0),
                    (228, 'Ukraine', 'UA', 0),
                    (229, 'United Arab Emirates', 'AE', 0),
                    (230, 'United Kingdom', 'GB', 1),
                    (231, 'United States', 'US', 0),
                    (232, 'Uruguay', 'UY', 0),
                    (233, 'Uzbekistan', 'UZ', 0),
                    (234, 'Vanuatu', 'VU', 0),
                    (235, 'Vatican City State', 'VA', 0),
                    (236, 'Venezuela', 'VE', 0),
                    (237, 'Vietnam', 'VN', 0),
                    (242, 'Yemen', 'YE', 0),
                    (243, 'Zambia', 'ZM', 0),
                    (244, 'Zimbabwe', 'ZW', 0);");

               //create email templates        	   
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_abstract_email_templates` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `name` varchar(100) NOT NULL,
                      `subject_en_en` text NOT NULL,
                      `content_en_en` text NOT NULL,
                      `from_name` varchar(250) NOT NULL,
                      `from_email` varchar(250) NOT NULL,
                      PRIMARY KEY (`id`)
                    )  DEFAULT CHARSET=utf8;");

        	   //insert email template data
        	   $db->query("INSERT INTO `lh_abstract_email_templates` (`id`, `name`, `subject_en_en`, `content_en_en`, `from_name`, `from_email`) VALUES
                        (1, 'Password Reset Request', 'Password Reset Request', 'Dear {name} {surname},\r\n\r\nThere was recently a request to change the password on your user profile.\r\n\r\nIf you requested this password change, please <a href=\"{url_recovery}\">click here</a> to reset your password.', 'Demo', 'noreply@example.com'),
                        (2, 'New password request', 'New password request', 'Dear {name} {surname},\r\n\r\nYour new password is: {new_password}', 'Demo', 'noreply@example.com'),
                        (3, 'Registration activate', 'Registration activate', 'Dear {name} {surname},\r\n\r\nTo activate your account click link below:\r\n\r\n<a href=\"{url_confirm}\">Click here</a>', 'Demo', 'noreply@example.com'),
                        (4, 'Registration complete', 'Registration complete', 'Dear {name} {surname},\r\n\r\nYou have successfully activated an account.', 'Demo', 'noreply@example.com');");

        	   //create event categories
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_abstract_event_category` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(200) NOT NULL,
                  `image_path` varchar(255) NOT NULL,
                  `image` varchar(255) NOT NULL,
                  `position` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
                ) DEFAULT CHARSET=utf8;");
        	   
        	   //insert default categories data
        	   $db->query("INSERT INTO `lh_abstract_event_category` (`id`, `name`, `image_path`, `image`, `position`) VALUES
                    (1, 'Art', 'var/storage/eventcategories/2014y/11/06/1/', 'F3ma6oizWKh91415270386.jpg', 0),
                    (2, 'Sport', 'var/storage/eventcategories/2014y/11/06/2/', 'ULItxlCPgpYPhqM1415270551.jpg', 0),
                    (3, 'Music', 'var/storage/eventcategories/2014y/11/06/3/', '1gaxMSeeuQspfU81415270725.jpg', 0),
                    (4, 'Food and drink', 'var/storage/eventcategories/2014y/11/06/4/', 'aXYGuHdb6exnEAA1415270772.jpg', 0),
                    (5, 'Parties', 'var/storage/eventcategories/2014y/11/06/5/', '52KH93C4S2b2ZA1415270922.jpg', 0);");
        	   

        	   //create url alias table
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_abstract_url_alias` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `url_alias` varchar(100) NOT NULL,
                  `url_destination_en_en` varchar(100) NOT NULL,
                  PRIMARY KEY (`id`)
                )  DEFAULT CHARSET=utf8;");
        	  
               //create article table
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_article` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(250) NOT NULL,
                  `intro` text NOT NULL,
                  `body` text NOT NULL,
                  `alias_url` varchar(150) NOT NULL,
                  `alternative_url` varchar(150) NOT NULL,
                  `file_name` varchar(100) NOT NULL,
                  `category_id` int(11) NOT NULL,
                  `category_id_parent` int(11) NOT NULL,
                  `has_photo` tinyint(4) NOT NULL,
                  `pos` int(11) NOT NULL DEFAULT '0',
                  `open_new_page` tinyint(4) NOT NULL,
                  `hide` tinyint(4) NOT NULL,
                  `system` tinyint(4) NOT NULL,
                  `mtime` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
                ) DEFAULT CHARSET=utf8;");

        	   //create article categories table
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_article_category` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `name` varchar(100) NOT NULL,
                      `intro` text NOT NULL,
                      `url_alternative` varchar(100) NOT NULL,
                      `parent_id` mediumint(9) NOT NULL,
                      `pos` int(11) NOT NULL,
                      `system` tinyint(4) NOT NULL,
                      `type` int(1) NOT NULL,
                      PRIMARY KEY (`id`)
                ) DEFAULT CHARSET=utf8 ;");

        	   //insert default categories
        	   $db->query("INSERT INTO `lh_article_category` (`id`, `name`, `intro`, `url_alternative`, `parent_id`, `pos`, `system`, `type`) VALUES
                    (1, 'About us', '', '', 0, 0, 0, 2),
                    (2, 'Using our system', '', '', 0, 0, 0, 2),
                    (4, 'Other information', '', '', 0, 0, 0, 2),
                    (5, 'How  to post events', '', '', 2, 0, 0, 0),
                    (6, 'About', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h3>Header</h3>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '', 1, 0, 0, 0),
                    (7, 'About us', '', '/About-6c.html', 0, 2, 0, 1),
                    (8, 'Events', '', '/event/list', 0, 4, 0, 1),
                    (9, 'Contact us', '', '/form/contactus', 0, 3, 0, 1);");

        	   //create static article table 
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_article_static` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name_en_en` varchar(200) NOT NULL,
                  `content_en_en` text NOT NULL,
                  `file_name` varchar(200) NOT NULL,
                  `mtime` int(11) NOT NULL,
                  `system` tinyint(4) NOT NULL,
                  `active` tinyint(4) NOT NULL,
                  PRIMARY KEY (`id`)
                ) DEFAULT CHARSET=utf8;");
        	  
               //create mail tasks table 
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_cron_mailer_mail` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `status` int(11) NOT NULL,
                  `type` tinyint(4) NOT NULL,
                  `send_time` int(11) NOT NULL,
                  `email` varchar(200) NOT NULL,
                  `name` varchar(200) NOT NULL,
                  `email_subject` varchar(250) NOT NULL,
                  `email_content` text NOT NULL,
                  `params` varchar(250) NOT NULL,
                  `created` int(11) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `status` (`status`)
                ) DEFAULT CHARSET=utf8;");

        	   //create event table
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_events` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `cat_id` int(11) NOT NULL,
                  `title` varchar(255) NOT NULL,
                  `start_date` int(11) NOT NULL,
                  `end_date` int(11) NOT NULL,
                  `address` varchar(255) NOT NULL,
                  `postcode` varchar(100) NOT NULL,
                  `country` int(11) NOT NULL,
                  `description` text NOT NULL,
                  `organizer_name` varchar(255) NOT NULL,
                  `organizer_description` text NOT NULL,
                  `fb_link` varchar(255) NOT NULL,
                  `tw_link` varchar(255) NOT NULL,
                  `link` varchar(255) NOT NULL,
                  `file` varchar(255) NOT NULL,
                  `file_path` varchar(255) NOT NULL,
                  `variations` text NOT NULL,
                  `mtime` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
                ) DEFAULT CHARSET=utf8;");
        	  

        	   // Forgot password table
        	   $db->query("CREATE TABLE IF NOT EXISTS `lh_forgotpasswordhash` (
                `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `user_id` INT NOT NULL ,
                `hash` VARCHAR( 40 ) NOT NULL ,
                `created` INT NOT NULL
                ) DEFAULT CHARSET=utf8;");
        	   
        	   
               //Administrators group
               $db->query("CREATE TABLE IF NOT EXISTS `lh_group` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(50) NOT NULL,
                  `system` tinyint(4) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `system` (`system`)
                ) DEFAULT CHARSET=utf8;");

               // Admin group
               $GroupData = new erLhcoreClassModelGroup();
               $GroupData->name    = "Administrators";
               $GroupData->system = 1;
               erLhcoreClassUser::getSession()->save($GroupData);

               // Precreate registered group
               $GroupDataRegistered = new erLhcoreClassModelGroup();
               $GroupDataRegistered->name = "Registered users";
               $GroupDataRegistered->system = 1;
               erLhcoreClassUser::getSession()->save($GroupDataRegistered);

               // Precreate anonymous group
               $GroupDataAnonymous = new erLhcoreClassModelGroup();
               $GroupDataAnonymous->name = "Anonymous users";
               $GroupDataAnonymous->system = 1;
               erLhcoreClassUser::getSession()->save($GroupDataAnonymous);

               //Administrators role
               $db->query("CREATE TABLE IF NOT EXISTS `lh_role` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(50) NOT NULL,
                  `system` tinyint(4) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `system` (`system`)
                ) DEFAULT CHARSET=utf8;");

               // Administrators role
               $Role = new erLhcoreClassModelRole();
               $Role->name = 'Administrators';
               $Role->system = 1;
               erLhcoreClassRole::getSession()->save($Role);

               // Registered user
               $RoleRegistered = new erLhcoreClassModelRole();
               $RoleRegistered->name = 'Registered users';
               $RoleRegistered->system = 1;
               erLhcoreClassRole::getSession()->save($RoleRegistered);

               // Anonymous user
               $RoleAnonymous = new erLhcoreClassModelRole();
               $RoleAnonymous->name = 'Anonymous users';
               $RoleAnonymous->system = 1;
               erLhcoreClassRole::getSession()->save($RoleAnonymous);
               
               //Assing group role
               $db->query("CREATE TABLE IF NOT EXISTS `lh_grouprole` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `group_id` int(11) NOT NULL,
                  `role_id` int(11) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `group_id` (`role_id`,`group_id`)
                ) DEFAULT CHARSET=utf8;");

               // Assign admin role to admin group
               $GroupRole = new erLhcoreClassModelGroupRole();
               $GroupRole->group_id =$GroupData->id;
               $GroupRole->role_id = $Role->id;
               erLhcoreClassRole::getSession()->save($GroupRole);

               // Assign registered role to registered group
               $GroupRoleRegistered = new erLhcoreClassModelGroupRole();
               $GroupRoleRegistered->group_id =$GroupDataRegistered->id;
               $GroupRoleRegistered->role_id = $RoleRegistered->id;
               erLhcoreClassRole::getSession()->save($GroupRoleRegistered);

               // Assign anonymous role to anonymous group
               $GroupRoleAnonymous = new erLhcoreClassModelGroupRole();
               $GroupRoleAnonymous->group_id =$GroupDataAnonymous->id;
               $GroupRoleAnonymous->role_id = $RoleAnonymous->id;
               erLhcoreClassRole::getSession()->save($GroupRoleAnonymous);

               // Users
                 $db->query("CREATE TABLE IF NOT EXISTS `lh_users` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `password` varchar(40) NOT NULL,
                      `email` varchar(100) NOT NULL,
                      `name` varchar(100) NOT NULL,
                      `surname` varchar(100) NOT NULL,
                      `disabled` tinyint(4) NOT NULL,
                      `lastactivity` int(11) NOT NULL,
                      `time_zone` varchar(200) NOT NULL,
                      `activate_hash` varchar(200) NOT NULL,
                      `system` tinyint(4) NOT NULL,
                      `org_name` varchar(255) NOT NULL,
                      `org_description` varchar(255) NOT NULL,
                      `org_www` varchar(255) NOT NULL,
                      `org_fb` varchar(255) NOT NULL,
                      `org_tw` varchar(255) NOT NULL,
                      `created` int(11) NOT NULL,
                      `file_name` varchar(255) NOT NULL,
                      `file` varchar(255) NOT NULL,
                      `variations` text NOT NULL,
                      PRIMARY KEY (`id`),
                      KEY `system` (`system`)
                    )  DEFAULT CHARSET=utf8;");

                $UserData = new erLhcoreClassModelUser();

                $UserData->setPassword($form->AdminPassword);
                $UserData->email   = $form->AdminEmail;
                $UserData->name    = $form->AdminName;
                $UserData->surname = $form->AdminSurname;
                $UserData->username = $form->AdminUsername;
                $UserData->system = 1;

                erLhcoreClassUser::getSession()->save($UserData);
                
                // Create anonymous user
                $UserDataAnonymous = new erLhcoreClassModelUser();
                $UserDataAnonymous->setPassword(erLhcoreClassModelForgotPassword::randomPassword());
                $UserDataAnonymous->email   = $form->AdminEmail;
                $UserDataAnonymous->name = 'Anonymous';
                $UserDataAnonymous->surname = 'Anonymous';
                $UserDataAnonymous->username = 'anonymous';
                $UserDataAnonymous->system = 1;
                erLhcoreClassUser::getSession()->save($UserDataAnonymous);
                
                // Remember user table
                $db->query("CREATE TABLE IF NOT EXISTS `lh_users_remember` (
				 `id` int(11) NOT NULL AUTO_INCREMENT,
				 `user_id` int(11) NOT NULL,
				 `mtime` int(11) NOT NULL,
				 PRIMARY KEY (`id`)
				) DEFAULT CHARSET=utf8;");


                //system config table
                $db->query("CREATE TABLE IF NOT EXISTS `lh_system_config` (
                  `identifier` varchar(50) NOT NULL,
                  `value` text NOT NULL,
                  `type` tinyint(1) NOT NULL DEFAULT '0',
                  `explain` varchar(250) NOT NULL,
                  `hidden` int(11) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`identifier`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                
                //insert default system configuration data
                 $db->query("INSERT INTO `lh_system_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
                ('full_image_quality', '93', 0, 'Full image quality', 0),
                ('max_photo_size', '5120', 0, 'Maximum photo size in kilobytes', 0),
                ('normal_thumbnail_quality', '93', 0, 'Converted normal thumbnail quality', 0),
                ('normal_thumbnail_width_x', '400', 0, 'Normal size thumbnail width - x', 0),
                ('normal_thumbnail_width_y', '400', 0, 'Normal size thumbnail width - y', 0),
                ('smtp_data', '', 0, 'SMTP configuration', 1),
                ('thumbnail_quality_default', '93', 0, 'Converted small thumbnail image quality', 0),
                ('thumbnail_scale_algorithm', 'croppedThumbnail', 0, 'It can be \"scale\" or \"croppedThumbnail\" - makes perfect squares, or \"croppedThumbnailTop\" makes perfect squares, image cropped from top', 0),
                ('thumbnail_width_x', '120', 0, 'Small thumbnail width - x', 0),
                ('thumbnail_width_y', '130', 0, 'Small thumbnail width - Y', 0),
                ('watermark_data', 'a:9:{s:17:\"watermark_enabled\";b:0;s:21:\"watermark_enabled_all\";b:0;s:9:\"watermark\";s:0:\"\";s:6:\"size_x\";i:200;s:6:\"size_y\";i:50;s:18:\"watermark_disabled\";b:1;s:18:\"watermark_position\";s:12:\"bottom_right\";s:28:\"watermark_position_padding_x\";i:10;s:28:\"watermark_position_padding_y\";i:10;}', 0, 'Not shown public, editing is done in watermark module', 1);
                     ");
                
                
                // User groups table
                $db->query("CREATE TABLE IF NOT EXISTS `lh_groupuser` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `group_id` int(11) NOT NULL,
                  `user_id` int(11) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `group_id` (`group_id`),
                  KEY `user_id` (`user_id`),
                  KEY `group_id_2` (`group_id`,`user_id`)
                ) DEFAULT CHARSET=utf8;");

                // Assign admin user to admin group
                $GroupUser = new erLhcoreClassModelGroupUser();
                $GroupUser->group_id = $GroupData->id;
                $GroupUser->user_id = $UserData->id;
                erLhcoreClassUser::getSession()->save($GroupUser);
                
                // Assign Anonymous user to anonymous group
                $GroupUserAnonymous = new erLhcoreClassModelGroupUser();
                $GroupUserAnonymous->group_id = $GroupDataAnonymous->id;
                $GroupUserAnonymous->user_id = $UserDataAnonymous->id;
                erLhcoreClassUser::getSession()->save($GroupUserAnonymous);

                //Assign default role functions
                $db->query("CREATE TABLE IF NOT EXISTS `lh_rolefunction` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `role_id` int(11) NOT NULL,
                  `module` varchar(100) NOT NULL,
                  `function` varchar(100) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `role_id` (`role_id`)
                ) DEFAULT CHARSET=utf8;");

                // Admin role and function
                $RoleFunction = new erLhcoreClassModelRoleFunction();
                $RoleFunction->role_id = $Role->id;
                $RoleFunction->module = '*';
                $RoleFunction->function = '*';
                erLhcoreClassRole::getSession()->save($RoleFunction);

                // registered rules and functions
                $permissionsArray = array(
                    array('module' => 'lhuser',  'function' => 'selfedit'),
                    array('module' => 'lhsystem','function' => 'use'),
                );

                foreach ($permissionsArray as $paramsPermission) {
                    $RoleFunctionOperator = new erLhcoreClassModelRoleFunction();
                    $RoleFunctionOperator->role_id = $RoleRegistered->id;
                    $RoleFunctionOperator->module = $paramsPermission['module'];
                    $RoleFunctionOperator->function = $paramsPermission['function'];
                    erLhcoreClassRole::getSession()->save($RoleFunctionOperator);
                }

               $cfgSite = erConfigClassLhConfig::getInstance();
	           $cfgSite->setSetting( 'site', 'installed', true);
	           $cfgSite->setSetting( 'site', 'templatecache', true);
	           $cfgSite->setSetting( 'site', 'templatecompile', true);
	           $cfgSite->setSetting( 'site', 'modulecompile', true);
	           $cfgSite->setSetting( 'user_settings', 'default_user_group', $GroupDataRegistered->id);
	           $cfgSite->setSetting( 'user_settings', 'anonymous_user_id', $UserDataAnonymous->id);
	           $cfgSite->save();

	           ApiClient::setSystemInstall();
    	       $tpl->setFile('lhinstall/install4.tpl.php');

            } else {

               $tpl->set('admin_username',$form->AdminUsername);
               if ( $form->hasValidData( 'AdminEmail' ) ) $tpl->set('admin_email',$form->AdminEmail);
    	       $tpl->set('admin_name',$form->AdminName);
    	       $tpl->set('admin_surname',$form->AdminSurname);

    	       $tpl->set('errors',$Errors);

    	       $tpl->setFile('lhinstall/install3.tpl.php');
            }
	    } else {
	        $tpl->setFile('lhinstall/install3.tpl.php');
	    }

	    break;

	case '4':
	    $tpl->setFile('lhinstall/install4.tpl.php');
	    break;

	default:
	    $tpl->setFile('lhinstall/install1.tpl.php');
		break;
}

$Result['content'] = $tpl->fetch();
$Result['pagelayout'] = 'install';
$Result['path'] = array(array('title' => 'Eventizer installation'));

} catch (Exception $e){
	echo "Make sure that &quot;cache/*&quot; is writable and then <a href=\"".erLhcoreClassDesign::baseurl('install/install')."\">try again</a>";
	exit;
}


?>