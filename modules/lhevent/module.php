<?php
$Module = array(
    "name" => "Event module",
    'variable_params' => true
);

$ViewList = array();

$ViewList['widget'] = array(
    'params' => array()
);

$ViewList['showeventajax'] = array(
    'params' => array()
);

$ViewList['list'] = array(
    'params' => array(),
    'uparams' => array('searchText','Submit','category'),
);

$ViewList['view'] = array(
    'params' => array('id')
);

$ViewList['events'] = array(
    'params' => array(),
    'script' => 'admin/events.php',
    'functions' => array(
        'administrate_event'
    )
);

$ViewList['new'] = array(
    'params' => array(),
    'script' => 'admin/new.php',
    'functions' => array(
        'administrate_event'
    )
);

$ViewList['edit'] = array(
    'params' => array(
        'event_id'
    ),
    'script' => 'admin/edit.php',
    'functions' => array(
        'administrate_event'
    )
);

$ViewList['widget'] = array(
    'params' => array(),
    'script' => 'admin/widget.php',
    'functions' => array(
        'administrate_event'
    )
);

$ViewList['remove'] = array(
    'params' => array(
        'id'
    ),
    'script' => 'admin/remove.php',
    'uparams' => array(
        'csfr'
    ),
    'functions' => array(
        'administrate_event'
    )
);

$FunctionList['use'] = array(
    'explain' => 'Allow user to use event module'
);
$FunctionList['administrate_event'] = array(
    'explain' => 'Allow user to administrate event module'
);
?>