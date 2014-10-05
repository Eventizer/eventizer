 <?php
$timestamp = erLhcoreClassModuleFunctions::getTimestamp($_POST['date']);

$list = erLhcoreClassModelEvents::getList(array(
    'filtergte' => array(
        'end_date' => $timestamp
    ),
    'filterlte' => array(
        'start_date' => $timestamp
    ),
    'offset' => 0,
    'limit' => 10
));
echo json_encode($list);
exit();
?>
	    