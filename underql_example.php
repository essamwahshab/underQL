<?php

require_once('UQLConnection.php');
require_once('UQLAbstractEntity.php');
require_once('UQLQuery.php');
require_once('UQLQueryPath.php');
require_once('UQLMap.php');
require_once('UQLFilter.php');
require_once('UQLFilterEngine.php');
require_once('UQLInsertQuery.php');
require_once('UQLUpdateQuery.php');
require_once('UQLDeleteQuery.php');


$c = new UQLConnection('localhost','abdullaheid_db','root','root','utf8');
$c->startConnection();
$a = new UQLAbstractEntity('users',$c);
$path = new UQLQueryPath($c,$a);
$add = new UQLInsertQuery($c,$a);
$d = new UQLDeleteQuery($c,$a);



$the_users_filter = new UQLFilter($a->getEntityName());

$the_users_filter->name('xss',UQL_FILTER_IN);
$the_users_filter->name('zebra',UQL_FILTER_OUT);
$the_users_filter->email('email',UQL_FILTER_IN);

$add->name = "Welcome";
$add->email = "cs.abdullah@hotmail.com";

function ufilter_xss($name,$value,$in_out,$params = null)
{
  return "[:$value:]";
}

function ufilter_zebra($name,$value,$in_out,$params = null)
{
  return "<b>$value</b>";
}
function ufilter_email($name,$value,$in_out,$params = null)
{
  return "(@$value@)";
}

$add->insert();


//$path->plugin->toXML();

//function UQLPlugin_toXML(/*UQLQueryPath*/$object)
//{
	
//}
//UQLEnvironment // to link all data that releated to different classes // singlton
?>