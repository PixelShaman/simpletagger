<?php
session_start();
include 'functions.php';

function removeTag($taggedID,$keyword,$taggedTable,$taggedDB) 
{
	$con = mysql_connect($GLOBALS['databaseLocation'], $GLOBALS['databaseUsername'], $GLOBALS['databasePassword']) or die("There has been an error whilst connecting to the database.");
	$db = mysql_select_db($GLOBALS['tagDatabaseName'], $con) or die(mysql_error());
 	$myQuery = 'DELETE '.$GLOBALS['tagTable_tags'].' FROM '.$GLOBALS['tagTable_tags'].', '.$GLOBALS['tagTable_keywords'].' WHERE ('.$GLOBALS['tagTable_tags'].'.keywordID = '.$GLOBALS['tagTable_keywords'].'.id) AND '.$GLOBALS['tagTable_tags'].'.dataTaggedID = '.$taggedID.' AND '.$GLOBALS['tagTable_tags'].'.dataTaggedTable = "'.$GLOBALS["taggableDataTables"][$taggedTable].'" AND '.$GLOBALS['tagTable_tags'].'.userID = '.$GLOBALS['currentUserID'].' AND '.$GLOBALS['tagTable_keywords'].'.keyword = "'.$keyword.'" AND '.$GLOBALS['tagTable_tags'].'.dataTaggedDatabase = "'.$GLOBALS["taggableDataDB"][$taggedDB].'"';
	$res = mysql_query($myQuery) or die("ERROR");

	echo("task_success");
}

function deleteTheKeyword($keyword){ 

	$con = mysql_connect($GLOBALS['databaseLocation'], $GLOBALS['databaseUsername'], $GLOBALS['databasePassword']) or die("There has been an error whilst connecting to the database.");
	$db = mysql_select_db($GLOBALS['tagDatabaseName'], $con) or die(mysql_error());
	
	$myQuery='SELECT * FROM '.$GLOBALS['tagTable_keywords'].' WHERE userID = "'.$GLOBALS['currentUserID'].'" AND keyword = "'.$keyword.'"';
	$res = mysql_query($myQuery) or die("ERROR");
	$row = mysql_fetch_assoc($res);
	$thisKeywordID=$row['id'];
	

	
	$myQuery2 = 'DELETE FROM '.$GLOBALS['tagTable_keywords'].' WHERE userID = "'.$GLOBALS['currentUserID'].'" AND id = "'.$thisKeywordID.'"';
	$res = mysql_query($myQuery2) or die("ERROR");

	$myQuery3 = 'DELETE FROM '.$GLOBALS['tagTable_tags'].' WHERE keywordID = "'.$thisKeywordID.'" AND userID = "'.$GLOBALS['currentUserID'].'"';
	$res = mysql_query($myQuery3) or die("ERROR");

	
	echo("task_success");

}



if(isset($_POST['action']) && !empty($_POST['action'])) 
{
	$action = $_POST['action'];
	
	for($i=0; $i<count($action);$i++)
	{
		$action[$i] = antiAttack($action[$i]);
	}
	
	
	if($action[0]=="tag")
	{
		removeTag($action[1],$action[2],$action[3],$action[4]);	
	}
		else if ($action[0] == "keyword")
		{
			deleteTheKeyword($action[1]);
		
		}else
		{
		 // Nothing
		}
	
} // End If Isset






?>