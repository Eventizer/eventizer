<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lharticleadmin/newstatic.tpl.php');

$articleStaticData = new erLhcoreClassModelArticleStatic();

$_SESSION['has_access_to_editor'] = 1;

if ( isset($_POST['cancelArticleStaticAction']) ) {
 	erLhcoreClassModule::redirect('articleadmin/liststatic');
 	exit;
}

if ( isset($_POST['saveArticleStaticAction']) ) {
	
	$errors = erLhcoreClassModelArticleStatic::validateInput($articleStaticData);
		
 	if (empty($errors)) { 		
        $articleStaticData->saveThis();
        erLhcoreClassModule::redirect('articleadmin/liststatic');	       
	} else {
    	$tpl->set('errors',$errors);
	}
	
}

$tpl->set('articleStaticData',$articleStaticData);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
	array('url' => __url('articleadmin/staticlist'),'title' => __t('articleadmin/liststatic','Static articles')),
	array('title' =>  __t('articleadmin/newstatic','New static article'))
);

?>