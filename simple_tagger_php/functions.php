<?php

include 'settings.php';

function antiAttack($input){
	$input = trim(strip_tags(addslashes($input)));
	return $input;
}

function loadKeywordList(){

	$con = mysql_connect($GLOBALS['databaseLocation'], $GLOBALS['databaseUsername'], $GLOBALS['databasePassword']) or die("ohoh");
	$db = mysql_select_db($GLOBALS['tagDatabaseName'], $con) or die(mysql_error());
	
	$myQuery = 'SELECT * FROM `'.$GLOBALS['tagTable_keywords'].'` WHERE `userID` = "'.$GLOBALS['currentUserID'].'"';
	$res = mysql_query($myQuery);
	$num = mysql_num_rows($res);	
	
	
	echo('<ul id="tagList">');
	for($i=0; $i<$num;$i++)
	{
		$row = mysql_fetch_assoc($res);
		echo('<li class="tagListItem"><span class="keywordHeader"><img src="simple_tagger_scripts/pix.gif" alt="pix"/></span><span class="keyword">'.$row['keyword'].'</span><span onClick="deleteKeyword($(this))" alt="Delete Keyword" class="keywordHandle"><img src="images/x002.png"></span></li>');
	}
	echo('</ul>');
}

function loadItemTagList($rowID,$toTagTable,$toTagDB)
{
	$con = mysql_connect($GLOBALS['databaseLocation'], $GLOBALS['databaseUsername'], $GLOBALS['databasePassword']) or die("ohoh");
	$db = mysql_select_db($GLOBALS['tagDatabaseName'], $con) or die(mysql_error());
		
	$myQuery=('SELECT * FROM '.$GLOBALS['tagTable_tags'].', '.$GLOBALS['tagTable_keywords'].' WHERE '.$GLOBALS['tagTable_tags'].'.userID = "'.$GLOBALS['currentUserID'].'" AND '.$GLOBALS['tagTable_tags'].'.dataTaggedID = "'.$rowID.'" AND '.$GLOBALS['tagTable_tags'].'.dataTaggedTable = "'.$GLOBALS['taggableDataTables'][$toTagTable].'" AND '.$GLOBALS['tagTable_tags'].'.dataTaggedDatabase= "'.$GLOBALS['taggableDataDB'][$toTagDB].'" AND '.$GLOBALS['tagTable_tags'].'.keywordID = '.$GLOBALS['tagTable_keywords'].'.id');                            
	
	$res = mysql_query($myQuery);
	while ($row = mysql_fetch_assoc($res)) {
			echo('<li class="itemTag"><span class="keywordHeader"><img src="simple_tagger_scripts/pix.gif" alt="pix"/></span> <span class="keyword myhold_'.$toTagDB.' dtbl_'.$toTagTable.' taggedid_'.$rowID.'">'.$row['keyword'].'</span> <span onClick="removeTag($(this))" alt="Delete Keyword" class="keywordHandle myhold_'.$toTagDB.' dtbl_'.$toTagTable.' taggedid_'.$rowID.'"><img alt="handle" src="images/x002.png"/></span></li>' );
	}
}


if(isset($_POST['action']) && !empty($_POST['action'])) 
{
	$action = $_POST['action'];
	
	
	for($i=0; $i<count($action);$i++)
	{
		$action[$i] = antiAttack($action[$i]);
	}
	
	if($action[0]== "loadKeywords")
	{
		loadKeywordList();	
	}
	
	if($action[0] == "loadTags")
	{
		loadItemTagList($action[1],$action[2],$action[3]);	
	}
	
	
} // End If Isset






?>




