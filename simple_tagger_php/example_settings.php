<?php
if(session_id() == ''){session_start();}

$userDatabase = "dataTagger";
$userTable = "all_users";

$databaseLocation = "localhost";
$databaseUsername = "root";
$databasePassword = "root";

$currentUserID = $_SESSION['s_UserID'];

$tagTable_keywords = "simpleTagger_keywords";
$tagTable_tags = "simpleTagger_tags";


$tagDatabaseName = "dataTagger";


$dataTables = array();
$taggableDataDB = array();

$taggableDataTables[] = "simpleTagger_photos";
$taggableDataTables[] = "simpleTagger_dummyArticles";

$taggableDataDB [] = "dataTagger";
$taggableDataDB [] = "testData";

?>