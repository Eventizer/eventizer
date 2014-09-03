<?php 

try {
	
	$tpl = erLhcoreClassTemplate::getInstance( 'lhajax/eventizernews.tpl.php');
	$feed =  ezcFeed::parse(  'http://eventizer.org/article/newsrss' ); // $xml is a string
	

	$tpl->set('items', $feed->item);
	
	echo json_encode(array('error' => false, 'result' =>  $tpl->fetch()));
	
} catch (Exception $e) {
	print_r($e);
	echo json_encode(array('error' => true, 'result' =>  __t('ajax/eventizernews','No news for this moment')));
}


exit;
?>