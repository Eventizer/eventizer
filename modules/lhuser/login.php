<?php
$currentUser = erLhcoreClassUser::instance();
$destination = $Params['user_parameters_unordered']['d'];
$instance = erLhcoreClassSystem::instance();

$tpl = erLhcoreClassTemplate::getInstance('lhuser/login.tpl.php');

if (! empty($destination)) {
    $redirect = $destination;
} else {
    $redirect = CSCacheAPC::getMem()->getSession('redirect_url');
}

if ($currentUser->isLogged() && $redirect != '') {
    header('Location: ' . erLhcoreClassModuleFunctions::urlDecode($redirect));
    exit();
} else {
    CSCacheAPC::getMem()->setSession('redirect_url', $redirect);
    $tpl->set('redirect_url', $redirect);
}

if (isset($_POST['Login'])) {
    try {
        if (! $currentUser->authenticate($_POST['Username'], $_POST['Password'], isset($_POST['rememberMe']) && $_POST['rememberMe'] == 1 ? true : false)) {
            $Error = erTranslationClassLhTranslation::getInstance()->getTranslation('user/login', 'Incorrect User ID or password');
            $tpl->set('errors', array(
                $Error
            ));
        } else {
            if ($redirect != '') {
                erLhcoreClassModule::redirect(erLhcoreClassModuleFunctions::urlDecode($redirect));
            } else {
                erLhcoreClassModule::redirect();
                exit();
            }
        }
    } catch (Exception $e) {
        $tpl->set('errors', array(
            $e->getMessage()
        ));
    }
}

$pagelayout = erConfigClassLhConfig::getInstance()->getOverrideValue('site', 'login_pagelayout');
if ($pagelayout != null)
    $Result['pagelayout'] = 'login';

$Result['content'] = $tpl->fetch();