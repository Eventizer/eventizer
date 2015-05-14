<?php

class erLhcoreClassValidateUsers
{
    public static function validatePassword(& $objectData) {
        if (! isset($_POST['csfr_token']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
            erLhcoreClassModule::redirect('kernel/csrf-missing');
        }
        
        $definition = array(
            'Password' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
            'Password1' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw')
        );
        
        $form = new ezcInputForm(INPUT_POST, $definition);
        
        $Errors = array();
        
        if ($form->hasInputField('Password') && (! $form->hasInputField('Password1') || $form->Password != $form->Password1)) {
            $Errors['Password'] = erTranslationClassLhTranslation::getInstance()->getTranslation('user/account', 'Passwords mismatch');
        }
        
        if ((!$form->hasInputField('Password') && $form->Password == '') || ($form->hasInputField('Password1') && $form->Password1 == '')) {
            $Errors['Password'] = erTranslationClassLhTranslation::getInstance()->getTranslation('user/account', 'Enter new passwords');
        }
        
        // Update only if neccesary
        if ($form->hasInputField('Password') && $form->hasInputField('Password1') && $form->Password != '' && $form->Password1 != '') {
            $objectData->setPassword($form->Password);
        }
        
        return $Errors;
        
    }

    public static function validateInput(& $objectData, $validate_pass = true)
    {
        if (! isset($_POST['csfr_token']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
            erLhcoreClassModule::redirect('kernel/csrf-missing');
        }
        
        $definition = array(
            'Name' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
            'Surname' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
            'orgDescription' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
            'orgTW' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
            'orgFB' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
            'orgWWW' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
            'orgName' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
            'Email' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'validate_email'),
            'Password' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
            'Password1' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw')
        );
        
        $form = new ezcInputForm(INPUT_POST, $definition);
        
        $Errors = array();
        
        if (! $form->hasValidData('Name') || $form->Name == '') {
            $Errors[] = __t('user/form', 'Please enter name');
        } else {
            $objectData->name = $form->Name;
        }
        
        if (! $form->hasValidData('Surname') || $form->Surname == '') {
            $Errors[] = __t('user/form', 'Please enter surname');
        } else {
            $objectData->surname = $form->Surname;
        }
        
        if (! $form->hasValidData('orgName') || $form->orgName == '') {
            $Errors[] = __t('user/form', 'Please enter organizer name');
        } else {
            $objectData->org_name = $form->orgName;
        }
        
        if ($form->hasValidData('orgWWW') || $form->orgWWW != '') {
            $objectData->org_www = erLhcoreClassModuleFunctions::addhttp($form->orgWWW);
        }
        
        if ($form->hasValidData('orgFB') || $form->orgFB != '') {
            $objectData->org_fb = erLhcoreClassModuleFunctions::addhttp($form->orgFB);
        }
        
        if ($form->hasValidData('orgTW') || $form->orgTW != '') {
            $objectData->org_tw = erLhcoreClassModuleFunctions::addhttp($form->orgTW);
        }
        
        if ($form->hasValidData('orgDescription') || $form->orgDescription != '') {
            $objectData->org_description = $form->orgDescription;
        }
       
        if (isset($_FILES['UserPhoto']) && $_FILES["UserPhoto"]["error"] != 4 && $_FILES['UserPhoto'] != '') {
            if (isset($_FILES["UserPhoto"]) && is_uploaded_file($_FILES["UserPhoto"]["tmp_name"]) && $_FILES["UserPhoto"]["error"] == 0 && erLhcoreClassImageConverter::isPhoto('UserPhoto')) {
                $dir = 'var/tmpfiles/';
                $file = erLhcoreClassModuleFunctions::moveUploadedFile('UserPhoto', $dir);
                $objectData->changePhotoUrl($dir . '/' . $file);
                unlink($dir . '/' . $file);
            }
        }
        
        if (! $form->hasValidData('Email')) {
            $Errors[] = __t('user/form', 'Please enter a valid email address');
        } else {
            
            if ($objectData->id == null) {
                
                if ($form->hasValidData('Email') && self::userEmailExists($form->Email) === true) {
                    $Errors[] = __t('user/form', 'Email address already registered');
                } else {
                    $objectData->email = $form->Email;
                }
            } else {
                
                if ($form->hasValidData('Email') && $form->Email != $objectData->email && self::userEmailExists($form->Email) === true) {
                    $Errors[] = __t('user/form', 'Email address already registered');
                } else {
                    $objectData->email = $form->Email;
                }
            }
        }
        
        if ($validate_pass === true) {
            if ($objectData->id == null) {
                
                if (! $form->hasValidData('Password') || ! $form->hasValidData('Password1') || $form->Password == '' || $form->Password1 == '' || $form->Password != $form->Password1) {
                    $Errors[] = __t('user/form', 'Passwords do not match');
                } else {
                    $objectData->setPassword($form->Password);
                }
            } else {
                
                if ($form->hasInputField('Password') && (! $form->hasInputField('Password1') || $form->Password != $form->Password1)) {
                    $Errors['Password'] = erTranslationClassLhTranslation::getInstance()->getTranslation('user/account', 'Passwords mismatch');
                }
                
                // Update only if neccesary
                if ($form->hasInputField('Password') && $form->hasInputField('Password1') && $form->Password != '' && $form->Password1 != '') {
                    $objectData->setPassword($form->Password);
                }
            }
        }
        
        return $Errors;
    }
}

?>