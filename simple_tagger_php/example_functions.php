<?php

function printTaggableData1($toTagTable,$toTagDB)
{

	$con = mysql_connect($GLOBALS['databaseLocation'], $GLOBALS['databaseUsername'], $GLOBALS['databasePassword']) or die("ohoh");
	$db = mysql_select_db($GLOBALS['taggableDataDB'][$toTagDB], $con) or die(mysql_error());

	$myQuery = 'SELECT * FROM '.$GLOBALS['taggableDataTables'][$toTagTable];	
	$res = mysql_query($myQuery);
	$num = mysql_num_rows($res);	
		
	mysql_close($con);

	for($i=0; $i<$num;$i++)
	{
		$row = mysql_fetch_assoc($res);
		
		echo('<div class="returnedData">');
			echo('<img alt="Tag" src="'.$row['location'].'" class="myid_'.$row['id']." anImg myloc_".$toTagTable.' myhold_'.$toTagDB.' taggable" />');
		echo("</div>");
	}
}


function printTaggableData2($toTagTable,$toTagDB)
{

	$con = mysql_connect($GLOBALS['databaseLocation'], $GLOBALS['databaseUsername'], $GLOBALS['databasePassword']) or die("ohoh");
	$db = mysql_select_db($GLOBALS['taggableDataDB'][$toTagDB], $con) or die(mysql_error());
	
	$myQuery = 'SELECT * FROM '.$GLOBALS['taggableDataTables'][$toTagTable];	
	$res = mysql_query($myQuery);
	$num = mysql_num_rows($res);	
		
	mysql_close($con);
	

	echo('<ul class="articleList"><li>');
		
	for($i=0; $i<$num;$i++)
	{
		$row = mysql_fetch_assoc($res);
		
		echo('<ul class="returnedData"> ');
			echo('<li class="myid_'.$row['id']." anArticle myloc_".$toTagTable.' myhold_'.$toTagDB.' taggable" >'."<h3>".$row['title']."</h3><br/>".$row['text'].'</li>');
		echo("</ul>");
	}
	echo("</li></ul>");
}

?>




