<?php
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
header('Content-type: text/javascript');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header('Cache-Control: no-store, no-cache, must-revalidate' );
header('Cache-Control: post-check=0, pre-check=0', false );
header('Pragma: no-cache' );

$tpl = erLhcoreClassTemplate::getInstance( 'lhevent/widget.tpl.php');


$theme->custom_container_css = "#widget_container .widget-title{
    font-size:16px;
    background-color:#42454e; 
    -webkit-border-top-left-radius: 7px;
    -webkit-border-top-right-radius: 7px;
    -moz-border-radius-topleft: 7px;
    -moz-border-radius-topright: 7px;
    border-top-left-radius: 7px;
    border-top-right-radius: 7px;
    text-align:center;
    color:#fff;
    margin:0px;
    padding:5px;
}
#widget_container table {
    padding:0px;
    margin:0px;
}
#widget_container td {
    padding:6px 2px;
    text-align:center;
}
#widget_container td a{
    padding:2px 5px;
}
#widget_container td a:hover{
    background:#cecece;
}

#widget_container .events_container {
    border:1px solid #ccc;border-top:0px;
    padding:15px;
    display:none;
}
#widget_container .events_container.show {
    display:block;
}
#widget_container .events_container small {
    text-align:center;
}
#widget_container .ev-events-item div{
    color:#ccc;
    font-size:12px;
}
#widget_container .ev-events-item h3{
   font-size:16px;
   font-weight:bold;
}
#widget_container .ev-events-item p{
   font-size:13px;
   color:red;
    margin-bottom:0px;
}
";
$tpl->set('theme',$theme );
$tpl->set('items',erLhcoreClassModelEvents::getList() );

echo  $tpl->fetch();
exit;
?>