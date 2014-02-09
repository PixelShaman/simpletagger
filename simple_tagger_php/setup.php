<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<title>The Simple Content Tagger</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link type="text/css" rel="stylesheet" href="/css/style.css"/>
	<link type="text/css" rel="stylesheet" href="/css/tag_styles.css"/>
	
	<style type="text/css">
		#images{
			width:300px;
		}
		
		h3{
			 text-shadow: -1px 0 1px #444444;
		}
		.keywordHandle{
		    float: right;
			height: 10px;
		    padding: 4px;
		    width: 10px;
		}
	</style>
	
</head>

<body>

<div id="header">
	<div id="header_inner">
		
	</div>
</div>

<div id="content" class="noInstall">
	<div id="content_inner">
		<div id="content_area">
		<ul id="nav">
			<li class="active"><a href="/index.php">Examples</a></li>
			<li><a href="/installer.php">Installer</a></li>
			<li><a href="/readme.php">Read me</a></li>
		</ul>
			<div class="intro_text">

		<div class="blueTheme" id="images">
					<div class="returnedData">
					<img class="myid_1 anImg myloc_0 myhold_0 taggable ui-droppable" src="/example images/raspberrys.png" alt="Tag"><ul class="itemTags"><li class="itemTag"><span class="keywordHeader"><img alt="pix" src="/simple_tagger_scripts/pix.gif"></span> <span class="keyword myhold_0 dtbl_0 taggedid_1">Content</span> <span class="keywordHandle myhold_0 dtbl_0 taggedid_1" alt="Delete Keyword" onclick="removeTag($(this))"><img src="images/x002.png" alt="handle"></span></li><li class="itemTag"><span class="keywordHeader"><img alt="pix" src="/simple_tagger_scripts/pix.gif"></span> <span class="keyword myhold_0 dtbl_0 taggedid_1">Tagger</span> <span class="keywordHandle myhold_0 dtbl_0 taggedid_1" alt="Delete Keyword" onclick="removeTag($(this))"><img src="images/x002.png" alt="handle"></span></li><li class="itemTag"><span class="keywordHeader"><img alt="pix" src="/simple_tagger_scripts/pix.gif"></span> <span class="keyword myhold_0 dtbl_0 taggedid_1">Installed</span> <span class="keywordHandle myhold_0 dtbl_0 taggedid_1" alt="Delete Keyword" onclick="removeTag($(this))"><img src="images/x002.png" alt="handle"></span></li>



</ul></div>				</div>
				<h3> Simple tagger has been installed!</h3>
				<p>
<?php

	$msqladd = $_POST["mysqlAddress"];
	$dbAUsername = $_POST["mysqlUsername"];
	$dbAPassword= $_POST["mysqlPassword"];
	$tagDatabase = $_POST["mysqlTagDb"];
	$userIDVar = $_POST['mysqlUserVar'];

	
	$dolPos = (string)strpos($userIDVar, "$");
	
	if($dolPos == "0")
	{
		$userIDVar = $userIDVar;
	}else{
		$userIDVar = "$".$userIDVar;
	}
	
	$userIDVar = stripslashes($userIDVar);
	

	
	$allTaggableTablesRaw = $_POST["hdnTablesSub"];
	$allTaggableTables = "";	
	
	$allTaggableDBsRaw = $_POST["hdnDBsSub"];
	$allTaggableDBs = "";		
	
	$allTables = explode("%", $allTaggableTablesRaw);
	$allDBs = explode("%", $allTaggableDBsRaw);
	
	$content = "<?php";
	$content=$content." \n if(session_id() == ".'""'."){session_start();}";
	$content=$content." \n";
	$content=$content."\n $"."databaseLocation"."=".'"'.$msqladd.'"'."; //The address of your MySQL server ";
	$content=$content."\n $"."databaseUsername"."=".'"'.$dbAUsername.'"'."; //The username for your databases";
	$content=$content."\n $"."databasePassword"."=".'"'.$dbAPassword.'"'."; //The password for your databases";
	$content=$content." \n";
	$content=$content."\n $"."currentUserID"."=".$userIDVar."; //This is reference to the variable you use to check the currently logged in user ID ";
	$content=$content." \n";
	$content=$content."\n $"."tagTable_keywords"."=".'"'."simpleTagger_keywords".'"'."; //This is the name of the table that will store your users' tag keywords with";
	$content=$content."\n $"."tagTable_tags"."=".'"'."simpleTagger_tags".'"'."; //This is the name of the table that will store your users' item tags with";
	$content=$content." \n";
	$content=$content."\n $"."tagDatabaseName"."=".'"'.$tagDatabase.'"'."; // This should be the database name you will use to store tags and keywords";
	$content=$content." \n";
	$content=$content."\n $"."dataTables"."=".''."array()".''."; //This is the array holding reference to your data tables and should be used as the myloc_ value";
	$content=$content."\n $"."taggableDataDB"."=".''."array()".''."; //array holding reference to your databases and should be used as the myhold_ value";
	$content=$content." \n";
	$content=$content." \n $"."setup_run = "."1; // Change this variable to 0 if you wish to install the databases manually";
	$content=$content." \n";
	
	for ($i = 1 ; $i<count($allTables);$i++)
	{
		$content=$content."\n $"."taggableDataTables[]"."=".'"'.$allTables[$i].'"'."; //The array positions for this table. Reference this table with :myloc_".($i-1)."";			
	}	

	$content=$content." \n";
	
	
	for ($i = 1 ; $i<count($allDBs);$i++)
	{
		$content=$content."\n $"."taggableDataDB[]"."=".'"'.$allDBs[$i].'"'."; //The array positions for this database. Reference this database with :myhold_".($i-1)."";			
	}	
	$content = $content."\n?>";

	$filename = 'settings.php';
	
	if (file_exists($filename)) {
		unlink($filename) or die("There was a problem, check this script has write access to the php_functions folder");
	}
	
	
	file_put_contents($filename, $content);

	$dbInstallQuery = "CREATE DATABASE IF NOT EXISTS ".$tagDatabase;
	
	$exampleTableQuery = array();
 
	
	$exampleTableQuery[] = 'CREATE TABLE IF NOT EXISTS `simpleTagger_keywords` (
	`id` int(11) NOT NULL auto_increment,
	`keyword` varchar(150) UNIQUE,
	`userID` int(11),
	PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	';
	
	$exampleTableQuery[] = 'CREATE TABLE IF NOT EXISTS `simpleTagger_tags` (
	`id` int(11) NOT NULL auto_increment,
	`keywordID` int(11),
	`userID` int(11),
	`dataTaggedID` int(11),
	`dataTaggedTable` varchar(150),
	`dataTaggedDatabase` varchar(150),
	PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	';
	
	$exampleTableQuery[] = 'CREATE TABLE IF NOT EXISTS `simpleTagger_dummyArticles` (
	`id` int(11) NOT NULL auto_increment,
	`text` varchar(255),
	`title` varchar(100),
	PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	';
	
	$exampleTableQuery[] = 'CREATE TABLE IF NOT EXISTS `simpleTagger_photos` (
	`id` int(11) NOT NULL auto_increment,
	`caption` varchar(250),
	`location` varchar(250),
	`userid` int(11),
	PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	';
	
	$con = mysql_connect($msqladd,$dbAUsername, $dbAPassword) or die("There has been an error whilst connecting to the database.");
	mysql_query($dbInstallQuery,$con);
	$db = mysql_select_db($tagDatabase, $con) or die(mysql_error());


	for ($i=0; $i < count($exampleTableQuery); $i ++)
	{
		mysql_query($exampleTableQuery[$i]);
	}

	
	
	$testKeywords = 'SELECT * FROM `simpleTagger_keywords`';
	$resTestKeywords = mysql_query($testKeywords);
	$numTestKeywords = mysql_num_rows($resTestKeywords);
	
	$newKeywordArray = array();

	
	if($numTestKeywords < 1)
	{
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Anything","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Absolutely","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Tag","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Database","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Driven","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Tagging","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Ajax","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Realtime","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Updates","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Easily","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Customisable","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Design","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Simple","1")';
		$newKeywordArray[] =  'INSERT INTO `simpleTagger_keywords` (`keyword`,`userID`) VALUES ("Setup","1")';
		
		for ($i=0; $i < count($newKeywordArray); $i ++)
		{
			mysql_query($newKeywordArray[$i]);
		}
		
	}
	
	$testTag = 'SELECT * FROM `simpleTagger_tags`';
	$resTestTag = mysql_query($testTag);
	$numTestTag = mysql_num_rows($resTestTag);
	
	$newTagArray = array();
	
	if($numTestTag < 1)
	{
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("3","1","1","simpleTagger_photos","dataTagger")';
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("2","1","1","simpleTagger_photos","dataTagger")';
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("1","1","1","simpleTagger_photos","dataTagger")';
		
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("13","1","1","simpleTagger_dummyArticles","dataTagger")';
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("14","1","1","simpleTagger_dummyArticles","dataTagger")';
		
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("10","1","2","simpleTagger_dummyArticles","dataTagger")';
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("11","1","2","simpleTagger_dummyArticles","dataTagger")';
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("12","1","2","simpleTagger_dummyArticles","dataTagger")';
				
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("8","1","3","simpleTagger_dummyArticles","dataTagger")';
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("7","1","3","simpleTagger_dummyArticles","dataTagger")';
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("9","1","3","simpleTagger_dummyArticles","dataTagger")';
		
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("4","1","4","simpleTagger_dummyArticles","dataTagger")';
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("5","1","4","simpleTagger_dummyArticles","dataTagger")';
		$newTagArray[] =  'INSERT INTO `simpleTagger_tags` (`keywordID`,`userID`,`dataTaggedID`,`dataTaggedTable`,`dataTaggedDatabase`) VALUES ("6","1","4","simpleTagger_dummyArticles","dataTagger")';

		for ($i=0; $i < count($newTagArray); $i ++)
		{
			mysql_query($newTagArray[$i]);
		}

	}
	
	
	$testPhotos = 'SELECT * FROM `simpleTagger_photos`';
	$resTestPhotos = mysql_query($testPhotos);
	$numTestPhotos = mysql_num_rows($resTestPhotos);
	
	if($numTestPhotos < 1)
	{
		$photoEntry1 =  'INSERT INTO `simpleTagger_photos` (`caption`,`location`,`userid`) VALUES ("A lovely picture","example images/raspberrys.png","1")';
		mysql_query($photoEntry1);
	}
	
	
	$Articles = 'SELECT * FROM `simpleTagger_dummyArticles`';
	$resArticles = mysql_query($Articles);
	$numArticles = mysql_num_rows($resArticles);
	
	if($numArticles < 1)
	{
		$Article1 =  'INSERT INTO `simpleTagger_dummyArticles` (`text`,`title`) VALUES ("Once you have installed the package with the installer, all you need to do is include the script libraries and call a few lines of code!","Simple Setup!")';
		$Article2 =  'INSERT INTO `simpleTagger_dummyArticles` (`text`,`title`) VALUES ("The code has been split into chunks for easy customisation. No advanced PHP knowledge is needed to get started, but you have full control!","Customisable")';
		$Article3 =  'INSERT INTO `simpleTagger_dummyArticles` (`text`,`title`) VALUES ("Creating keywords and tags happens on the fly. There is no need to reload the page as all the work is done in the background!","Ajax based!")';
		$Article4 =  'INSERT INTO `simpleTagger_dummyArticles` (`text`,`title`) VALUES ("The tags are stored in their own local database on your system, so you can plug them into any content already existing on your site!","Database Driven!")';		
		mysql_query($Article1);
		mysql_query($Article2);
		mysql_query($Article3);
		mysql_query($Article4);
	}
	
	mysql_close($con);
	
	
?>
					<br/>
					You have <?php echo(count($allTables)-1);?> tables referenced in <?php echo(count($allDBs)-1)?> databases, so head over to the <a href="/readme.php">readme</a> page to learn how to use them in your new Simple Tagger.<br/><br/>
					
					<br/>	
					At this point everything should be installed on your own or hosted server. This guide will give you a quick
					tutorial on how to start tagging your own content!
					<br/><br/>
					If the installation was successful and you are happy with your settings it is <span class="red">very important</span> that you either remove the 
					<span class="dir">installer.php</span> and <span class="dir">setup.php</span> files from your server / workspace or secure them with admin credentials until they are needed again.		
					</p>
				</div>			
			</div>
		</div>
	</div>
</body>
</html>








