<?php
session_start();
include 'functions.php';

function doDB($keyword,$toTagID,$toTagTable,$toTagDB)
{

	$con;
	$db;
	
	$con = mysql_connect($GLOBALS['databaseLocation'], $GLOBALS['databaseUsername'], $GLOBALS['databasePassword']) or die("ohoh");
	$db = mysql_select_db($GLOBALS['tagDatabaseName'], $con) or die(mysql_error());
	
	$myQuery = 'SELECT * FROM '.$GLOBALS["tagTable_keywords"].' WHERE keyword = "'.$keyword.'" AND userID = "'.$GLOBALS['currentUserID'].'"';	
	$res = mysql_query($myQuery);
	$row = mysql_fetch_assoc($res);
	
	$keywordID = $row['id'];

	$tempValues = 'VALUES(';
	$tempValues = $tempValues.'"'.$keywordID.'", ';
	$tempValues = $tempValues.'"'.$GLOBALS['currentUserID'].'" , ';
	$tempValues = $tempValues.'"'.$toTagID.'" , ';
	$tempValues = $tempValues.'"'.$GLOBALS['taggableDataTables'][$toTagTable].'", ';
	$tempValues = $tempValues.'"'.$GLOBALS['taggableDataDB'][$toTagDB];
	$tempValues = $tempValues.'")';
	
	$myQuery = "INSERT INTO `".$GLOBALS["tagTable_tags"].'` (`keywordID` ,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`)'.$tempValues;
	mysql_query($myQuery) or die("ERROR");
	echo("task_success");

}


if(isset($_POST['action']) && !empty($_POST['action'])) 
{
	$action = $_POST['action'];
	
	for($i=0; $i<count($action);$i++)
	{
		$action[$i] = antiAttack($action[$i]);
	}
	
	doDB($action[0],$action[1],$action[2],$action[3]);	
	
} // End If Isset









?>