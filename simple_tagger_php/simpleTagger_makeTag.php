<?php
session_start();
include 'functions.php';


function doDB($keyword)
{
	$keyword=str_replace('\"',"",$keyword);
	$keyword=str_replace("\'","",$keyword);
	
	$con = mysql_connect($GLOBALS['databaseLocation'], $GLOBALS['databaseUsername'], $GLOBALS['databasePassword']) or die("There has been an error whilst connecting to the database.");
	$db = mysql_select_db($GLOBALS['tagDatabaseName'], $con) or die(mysql_error());
	
	$tempValues = 'VALUES(';
	$tempValues = $tempValues.'"'.$keyword.'", "'.$GLOBALS['currentUserID'].'" )';
	$myQuery = "INSERT INTO `".$GLOBALS["tagTable_keywords"]."` (`keyword` ,`userID`)".$tempValues;
	$res = mysql_query($myQuery);

	echo("task_success");

}


if(isset($_POST['action']) && !empty($_POST['action'])) 
{
	$action = $_POST['action'];
	
	
	for($i=0; $i<count($action);$i++)
	{
		$action[$i] = antiAttack($action[$i]);
	}
	
	doDB($action);	
	
} // End If Isset








?>


