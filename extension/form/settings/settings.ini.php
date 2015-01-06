<?php 
/**
 * form configuration file
 */
	return array(
	    'version' => 0.1,
	    'name' => 'Contact form',
	    'description' => 'This is sets of contact form modules.',
		'nature_of_query' => array(
			'enabled' => true,
			'send_to' => '',
			'queries' => array (
				'Registration problems',
				'Login or password',
				'Other'				
			)			
		)
	);

?>