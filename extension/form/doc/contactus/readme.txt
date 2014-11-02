Form module
==============

What Is This?
-------------

This is sets of form modules. For example contact us form.

How To Use?
-----------------------

1. Copy files to extenshion folder, enable it in main system settings file (settings/settings.ini.php) by adding extension name in array extenshions. for example 	
	'extensions' => array (
				'form'
			),
2. Add classes in autoloads file (var/autoloads/lhextension_autoload.php). 
	//form
	'erLhcoreformClassValidation'									=> 'extension/form/lib/core/lhform/validation/formclassvalidation.php',
	'erLhcoreClassFormEmails'										=> 'extension/form/lib/core/lhform/lhcoreclassformemails.php',
3. Add module url in you website menu '/form/contactus'

Other information
-------------------------
Module will send emails to admin. Admin email can be changed in website settings file (settings/settings.ini.php), you can add other admin email in form settings file (parameter 'send_to'). 
If this parameter is empty, we use email from main settings file 

You also can enable/disable "Nature of query" in extenshion settings or add your own.

If you find a problem, incorrect comment, obsolete or improper code or such, please contact us.