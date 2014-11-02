<?php

/**
 * Validator helpers
 * Functions to validate form data
 * 
 * */
class erLhcoreformClassValidation {
	
	/**
	 * contact us validation function
	 * 
	 * @param unknown $data        	
	 * @return multitype:NULL
	 */
	public static function validateContactUs($data, $params = array()) {
		if (! isset ( $_POST ['csfr_token'] ) || ! erLhcoreClassUser::instance ()->validateCSFRToken ( $_POST ['csfr_token'] )) {
			erLhcoreClassModule::redirect ( 'kernel/csrf-missing' );
		}
		
		$definition = array (
				'FormName' => new ezcInputFormDefinitionElement ( ezcInputFormDefinitionElement::REQUIRED, 'string' ),
				'FormEmail' => new ezcInputFormDefinitionElement ( ezcInputFormDefinitionElement::REQUIRED, 'validate_email' ),
				'FormText' => new ezcInputFormDefinitionElement ( ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw' ),
				'CaptchaCode' => new ezcInputFormDefinitionElement ( ezcInputFormDefinitionElement::REQUIRED, 'string' ) 
		);
		
		if (erLhcoreClassForm::getInstance()->getSetting('nature_of_query', 'enabled') === true) {
			$definition['QueryNature'] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw');
		}
		
		
		$form = new ezcInputForm ( INPUT_POST, $definition );
		$Errors = array ();
		
		if (erLhcoreClassForm::getInstance()->getSetting('nature_of_query', 'enabled') === true) {
			if (! $form->hasValidData ( 'QueryNature' ) || $form->QueryNature == '') {
				$Errors [] = erTranslationClassLhTranslation::getInstance ()->getTranslation ( 'feedback/form', 'Please enter nature of query!' );
				$data->QueryNature = '';
			} else {
				$data->QueryNature = $form->QueryNature;
			}
		}
		
		if (! $form->hasValidData ( 'FormName' ) || $form->FormName == '') {
			$Errors [] = erTranslationClassLhTranslation::getInstance ()->getTranslation ( 'feedback/form', 'Please enter name!' );
			$data->FormName = '';
		} else {
			$data->FormName = $form->FormName;
		}
		
		if (! $form->hasValidData ( 'FormEmail' )) {
			$Errors [] = erTranslationClassLhTranslation::getInstance ()->getTranslation ( 'feedback/form', 'Invalid e-mail address!' );
			$data->FormEmail = '';
		} else {
			$data->FormEmail = $form->FormEmail;
		}
		
		if (! $form->hasValidData ( 'FormText' ) || $form->FormText == '') {
			$Errors [] = erTranslationClassLhTranslation::getInstance ()->getTranslation ( 'feedback/form', 'Please enter text!' );
			$data->FormText = ''; 
		} else {
			$data->FormText = $form->FormText;
		}
		
		if (! $form->hasValidData ( 'CaptchaCode' ) || $form->CaptchaCode == '' || $form->CaptchaCode != $_SESSION [$_SERVER ['REMOTE_ADDR']] ['feedback_form']) {
			$Errors [] = erTranslationClassLhTranslation::getInstance ()->getTranslation ( 'feedback/form', 'Please enter captcha code!' );
			$data->CaptchaCode = '';
		} else {
			$data->CaptchaCode = $form->CaptchaCode;
		}
		
		return $Errors;
	}
}

?>