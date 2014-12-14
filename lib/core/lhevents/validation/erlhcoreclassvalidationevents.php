<?php

class erLhcoreClassValidateEvents
{  
    public static function validateInput(& $Data)
    {
        if (! isset($_POST['csfr_token']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
            erLhcoreClassModule::redirect('kernel/csrf-missing');
        }
        
       $definition = array(
			'Title' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw'
			),
			'StartDate' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::REQUIRED, 'string'
			),
			'EndDate' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::REQUIRED, 'string'
			),
			'Address' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw'
			),
			'Country' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::REQUIRED, 'int'
			),
			'Postcode' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'FbLink' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'TwLink' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'Link' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'OrgName' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'Description' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw'
			),
			'OrgDesc' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
			),
			'Category' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'int'
			),
		);
	
   
        $form = new ezcInputForm(INPUT_POST, $definition);
        
        $Errors = array();
        
        if ($form->hasValidData('Title') && $form->Title != '' ) {
            $Data->title = $form->Title;
        } else {
            $Errors[] = __t('eventadmin/new','Please enter event name');
        }
        
        if ($form->hasValidData('StartDate') && $form->StartDate != '' ) {
            $Data->start_date = erLhcoreClassModuleFunctions::getTimestamp($form->StartDate,'d/m/Y');
        } else {
            $Errors[] = __t('eventadmin/new','Please enter event start date');
        }
        
        if ($form->hasValidData('EndDate') && $form->EndDate != '' ) {
            $Data->end_date = erLhcoreClassModuleFunctions::getTimestamp($form->EndDate,'d/m/Y');
        } else {
            $Errors[] = __t('eventadmin/new','Please enter event end date');
        }
        
        if ($Data->end_date < $Data->start_date) {
             $Errors[] = __t('eventadmin/new','End date must be greater or equal to start date');
        } 
        
        if ($form->hasValidData('Address') && $form->Address != '' ) {
            $Data->address = $form->Address;
        } else {
            $Errors[] = __t('eventadmin/new','Please enter event address');
        }
        
        if ($form->hasValidData('Country') && $form->Country != '' ) {
            $Data->country = $form->Country;
        } else {
            $Errors[] = __t('eventadmin/new','Please enter event country');
        }
        
        if ($form->hasValidData('Postcode') && $form->Postcode != '' ) {
            $Data->postcode = $form->Postcode;
        } 
        
        if ($form->hasValidData('FbLink') && $form->FbLink != '' ) {
            $Data->fb_link = $form->FbLink;
        } 
        
        if ($form->hasValidData('TwLink') && $form->TwLink != '' ) {
            $Data->tw_link = $form->TwLink;
        } 
        
        if ($form->hasValidData('Link') && $form->Link != '' ) {
            $Data->link = $form->Link;
        } 
        
        if ($form->hasValidData('OrgName') && $form->OrgName != '' ) {
            $Data->organizer_name = $form->OrgName;
        } 
        
        if ($form->hasValidData('Description') && $form->Description != '' ) {
            $Data->description = $form->Description;
        } else {
            $Errors[] = __t('eventadmin/new','Please enter event description');
        }
        
        if ($form->hasValidData('Category') && $form->Category != '' ) {
            $Data->cat_id = $form->Category;
        } else {
            $Errors[] = __t('eventadmin/new','Please enter event category');
        }
        
        
        if ($form->hasValidData('OrgDesc') && $form->OrgDesc != '' ) {
            $Data->organizer_description = $form->OrgDesc;
        } 
        
        if (empty($Errors)) {
            
            if ($_FILES["Image"]["error"] != 4) {
                if (isset($_FILES["Image"]) && is_uploaded_file($_FILES["Image"]["tmp_name"]) && $_FILES["Image"]["error"] == 0 && erLhcoreClassImageConverter::isPhoto('Image')) {
                    
                    if ($Data->id == null) {
                        $Data->saveThis();
                    }
                    
                    $Data->removePhoto();
                    $dir = 'var/events/' . $Data->id . '/images/';
                  
                    erLhcoreClassImageConverter::mkdirRecursive($dir);
                 
                    $Data->file = erLhcoreClassModuleFunctions::moveUploadedFile('Image', $dir);
                    $Data->file_path = $dir;
               
                } else {
                    $Errors[] = 'Incorrect photo file!';
                }
            }
            
            if (isset($_POST['DeletePhoto']) && $_POST['DeletePhoto'] == 1) {
                $Data->removePhoto();
            }
        }
        
        return $Errors;
    }


}

?>