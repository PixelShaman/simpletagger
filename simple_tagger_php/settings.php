<?php 
 if(session_id() == ""){session_start();} 

 $databaseLocation="localhost"; //The address of your MySQL server 
 $databaseUsername="root"; //The username for your databases
 $databasePassword="root"; //The password for your databases 

 $currentUserID=$_SESSION["s_UserID"]; //This is reference to the variable you use to check the currently logged in user ID  

 $tagTable_keywords="simpleTagger_keywords"; //This is the name of the table that will store your users' tag keywords with
 $tagTable_tags="simpleTagger_tags"; //This is the name of the table that will store your users' item tags with 

 $tagDatabaseName="dataTagger"; // This should be the database name you will use to store tags and keywords 

 $dataTables=array(); //This is the array holding reference to your data tables and should be used as the myloc_ value
 $taggableDataDB=array(); //array holding reference to your databases and should be used as the myhold_ value 
 
 $setup_run = 0; // Change this variable to 0 if you wish to install the databases manually 

 $taggableDataTables[]="simpleTagger_photos"; //The array positions for this table. Reference this table with :myloc_0
 $taggableDataTables[]="simpleTagger_dummyArticles"; //The array positions for this table. Reference this table with :myloc_1 

 $taggableDataDB[]="dataTagger"; //The array positions for this database. Reference this database with :myhold_0
 $taggableDataDB[]="testData"; //The array positions for this database. Reference this database with :myhold_1
?>