<?php
$Module = array(
    "name" => "Event social comments"
);

$ViewList = array();

$ViewList['settings'] = array(
    'script' => 'admin/settings.php',
    'params' => array(),
    'functions' => array(
        'administrate'
    )
);

$FunctionList['administrate'] = array(
    'explain' => 'Allow system administrator use module [administrate]'
);

?>