<?php
$tpl = erLhcoreClassTemplate::getInstance('lhsystem/check.tpl.php');

$action = (string)$Params['user_parameters_unordered']['action'] ;

if (in_array($action, array('status','statusdb','updatedb'))) {
    if (!isset($_SERVER['HTTP_X_CSRFTOKEN']) || !$currentUser->validateCSFRToken($_SERVER['HTTP_X_CSRFTOKEN'])) {
        echo json_encode(array('error' => 'true', 'result' => 'Invalid CSRF Token' ));
        exit;
    }

    $tpl = erLhcoreClassTemplate::getInstance( 'lhsystem/update/statusdb.tpl.php');

    $contentData = ApiClient::executeRequest('https://raw.githubusercontent.com/Eventizer/eventizer/master/doc/update_db/structure.json');

    if ((string)$Params['user_parameters_unordered']['action'] == 'statusdbdoupdate'){
        erLhcoreClassUpdate::doTablesUpdate(json_decode($contentData,true));
    }

    $tables = erLhcoreClassUpdate::getTablesStatus(json_decode($contentData,true));
    $tpl->set('tables',$tables);
    echo json_encode(array('result' => $tpl->fetch()));
    exit;
}

$message = array();
if (! is_writable("cache/cacheconfig"))
    $message[] = "cache/cacheconfig is not writable";

if (! is_writable("settings/"))
    $message[] = "settings/ is not writable";

if (! is_writable("cache/translations"))
    $message[] = "cache/translations is not writable";

if (! is_writable("cache/userinfo"))
    $message[] = "cache/userinfo is not writable";

if (! is_writable("cache/compiledtemplates"))
    $message[] = "cache/compiledtemplates is not writable";

if (! is_writable("var/tmpfiles"))
    $message[] = "var/tmpfiles is not writable";

if (! extension_loaded('pdo_mysql'))
    $message[] = "php-pdo extension not detected. Please install php extension";

if (! extension_loaded('curl'))
    $message[] = "php_curl extension not detected. Please install php extension";

if (! extension_loaded('mbstring'))
    $message[] = "mbstring extension not detected. Please install php extension";

if (! extension_loaded('gd'))
    $message[] = "gd extension not detected. Please install php extension";

if (! function_exists('json_encode'))
    $message[] = "json support not detected. Please install php extension";

if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    $message[] = "Minimum 5.4.0 PHP version is required";
}


$tpl->set('version',  erLhcoreClassUpdate::version());
$tpl->set('release',  ApiClient::getSystemRelease());

$tpl->set('messages', $message);

$Result['submenu'] = 'developer';
$Result['menu'] = 'settings';
$Result['title'] = array(
    'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/check', 'System check'),
    'small_title' => __t('system/check', 'System status and updates')
);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array(
        'url' => __url('system/developer'),
        'title' => __t('system/index', 'Developer tools')
    ),
    array(
        'title' => __t('system/index', 'System check')
    )
);

?>