<?php
	session_start();
	include 'simple_tagger_php/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>The Simple Content Tagger</title>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="jui/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="simple_tagger_scripts/script.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css"/>
	<link type="text/css" rel="stylesheet" href="css/tag_styles.css"/>
	
	<script type="text/javascript">
	//<!--	
		$(document).ready(function() {

			$("#table_adder li").each(function(index) {
				$(this).find(".tableMinus").click(function() {
					removeDBTable($(this));
				});
			});
			
			$("#db_adder li").each(function(index) {
				$(this).find(".dbMinus").click(function() {
					removeDB($(this));
				});	
			});			
		});
		
		function addNewDB()
		{
			$("#db_adder").prepend('<li><p>The database name holding the taggable data table <br/><span>eg: dataTagger</span></p><input type="text"/><img class="dbMinus" src="images/rm.png" alt="remove database"/> </li>');
				
			$("#db_adder li").each(function(index) {
				$(this).find(".dbMinus").click(function() {
					removeDB($(this));
				});	
			});
		}
		
		function addNewDBTable()
		{
			$("#table_adder").prepend('<li><p>The table name holding the taggble data <br/><span>eg: userPics</span></p><input type="text"/><img class="tableMinus" src="images/rm.png" alt="remove table"/> </li>');
				
			$("#table_adder li").each(function(index) {
				$(this).find(".tableMinus").click(function() {
					removeDBTable($(this));
				});	
			});
		}
		
		function removeDB(theObject)
		{
			$(theObject).parent().remove();
		}
		
		function removeDBTable(theObject)
		{
			$(theObject).parent().remove();
		}
		
		function installMe(){
			
			var hdnTableString = "";
			var hdnDBString = "";
			
			$("#table_adder input").each(function(index) {

				hdnTableString = hdnTableString + "%" + $(this).val();
			});
			
			$("#db_adder input").each(function(index) {

				hdnDBString = hdnDBString + "%" + $(this).val();
			});

			$("#hdnTablesToSubmit").val(hdnTableString);
			$("#hdnDBsToSubmit").val(hdnDBString);
			document.forms["installerForm"].submit();
		}
		//-->
	</script>
	
</head>

<body>

<div id="header">
	<div id="header_inner">
	</div>
</div>


<div id="content" class="installerPage">
	<div id="content_inner">
		<div id="content_area">
		
		
		<ul id="nav">
			<li ><a href="index.php">Examples</a></li>
			<li class="active"><a href="installer.php">Installer</a></li>
			<li><a href="readme.php">Read me</a></li>
		</ul>
		 		
		<div class="blueTheme" id="images">
			<div class="returnedData">
				<img class="myid_2 anImg myloc_0 myhold_0 taggable ui-droppable" src="example images/raspberrys.png" alt="Tag" />
				<ul class="itemTags">
					<li class="itemTag">
						<span class="keywordHeader">
							<img alt="pix" src="simple_tagger_scripts/pix.gif" />
						</span> 
						<span class="keyword myhold_0 dtbl_0 taggedid_2">
							Tag
						</span> 
						<span class="keywordHandle myhold_0 dtbl_0 taggedid_2"  onclick="removeTag($(this))">
							<img src="images/x002.png" alt="handle" />
						</span>
					</li>
					<li class="itemTag">
						<span class="keywordHeader">
							<img alt="pix" src="simple_tagger_scripts/pix.gif" />
						</span>
						<span class="keyword myhold_0 dtbl_0 taggedid_2">
							Absolutely
						</span>
						<span class="keywordHandle myhold_0 dtbl_0 taggedid_2"  onclick="removeTag($(this))">
							<img src="images/x002.png" alt="handle" />
						</span>
					</li>
					<li class="itemTag">
						<span class="keywordHeader">
							<img alt="pix" src="simple_tagger_scripts/pix.gif"/>
						</span>
						<span class="keyword myhold_0 dtbl_0 taggedid_2">
							Anything
						</span>
						<span class="keywordHandle myhold_0 dtbl_0 taggedid_2" onclick="removeTag($(this))">
							<img src="images/x002.png" alt="handle"/>
						</span>
					</li>
				</ul>
				</div>
			</div>
		
			<div class="intro_text">
				<h3> Installer</h3>
				<form method="post" id="installerForm" action="simple_tagger_php/setup.php">
					<p class="installer_introText">
						<br/>	
						This installer will walk you through the process of getting started and will <b>need write access</b> to change the
						<span class="dir">settings.php</span> file inside the <span class="dir">simple_tagger_php</span> folder.<br/><br/>
						Just fill in the form below, if you are having trouble using the installer you can edit the <span class="dir">
						settings.php</span> file inside the <span class="dir">simple_tagger_php</span> folder manually.<br/><br/>
						<span class="red">If you want to use the examples just add your tables and databases onto the list below whilst leaving the defaults in the list.</span>
						<br/><br/>
					</p>
					<h3 id="sqlSettingsHead">Your MySQL Settings</h3>
					

						<ul id="installer_steps">
							<li>
								<p>					<br/>What is your database server address ?<br/><span>eg: localhost</span> </p>
								<input type="text" value=<?php echo($GLOBALS['databaseLocation']); ?> name="mysqlAddress" />
							</li>
							
							<li>
								<p>What is your MySQL username?<br/><span>eg: root</span> </p>
								<input type="text" value=<?php echo($GLOBALS['databaseUsername']); ?> name="mysqlUsername" />
							</li>
							
							<li>
								<p>What is your MySQL password?<br/><span>eg: root</span> </p>
								<input type="password" value=<?php echo($GLOBALS['databaseUsername']); ?> name="mysqlPassword" />
							</li>
							
							<li>
								<p>What is the name of the database you would like to add your new tags to?<br/><span>eg: dataTagger</span> </p>
								<input type="text" value=<?php echo($GLOBALS['tagDatabaseName']); ?> name="mysqlTagDb" />
							</li>						
							
							<li>
								<p>Which <b>Session Variable</b> is your currently logged in users ID's stored with ? <br/><span>eg: $_SESSION["UserID"]</span> </p>
								<input type="text" value='$_SESSION["s_UserID"]' name="mysqlUserVar" />
							</li>
						</ul>		
					
					
					
					<h3 class="dbAdderTextHead">Add Databases</h3>
					<p class="dbAdderText"><br/>
						Here is where you need to add the <b>Databases</b> containing the tables of data you wish to tag.<br/> Just click on the <b>green plus icon</b><img class="tablePlus" src="images/gp.png" alt="add table"/> to add a new database and the 
						<b class="red"> red minus icon</b> <img class="tableMinus" src="images/rm.png" alt="remove table"/> to remove it.
						<br/>
						<br/>
					</p>
					<p class="large">
						<img class="dbPlus" src="images/gp.png" alt="add table" onclick="addNewDB()"/> 
						<br/>
						<br/>
					</p>
					<ul id="db_adder">
						<?php
							for($i=0;$i<count($GLOBALS['taggableDataDB']);$i++ )
							{
								echo('
									<li>
										<p>The database name holding the taggable data table <br/><span>eg: dataTagger</span></p>
										<input type="text" value='.$GLOBALS['taggableDataDB'][$i].'  />
										<br/>
										<img class="dbMinus" src="images/rm.png" alt="remove database" />
									</li>
								');
							}
						?>
					</ul>

					<h3>Add Tables</h3>
					<p class="tableAdderText"><br/>
						Below you can add the <b>Tables</b> that hold the data you want to tag <span class="subText">(don't worry about which database they belong to just yet.)
						</span><br/><br/> Just click on the <b>green plus icon</b><img class="tablePlus" src="images/gp.png" alt="add table"/> to add a new table and the 
						<b class="red"> red minus icon</b> <img class="tableMinus" src="images/rm.png" alt="remove table"/> to remove it.
						<br/>
											<br/>
					</p>

					<p class="large">
						<img class="tablePlus" src="images/gp.png" alt="add table" onclick="addNewDBTable()"/>
						<br/>
						<br/>
					</p>
					
					
					<ul id="table_adder">
						<?php
							for($i=0;$i<count($GLOBALS['taggableDataTables']);$i++ )
							{
								echo('
									<li>
										<p>The table name holding the taggable data <br/><span>eg: userPics</span></p>
										<input type="text" value='.$GLOBALS['taggableDataTables'][$i].'  />
										<br/>
										<img class="tableMinus" src="images/rm.png" alt="remove table"/>
									</li>
								');
							}
						?>
					</ul>
					
					<p class="installer_closingText">
						And thats all there is to the setup. Remember, if you are having trouble using the installer you can edit the <span class="dir">
						settings.php</span> file inside the <span class="dir">simple_tagger_php</span> folder manually.<br/><br/>
					</p>
					<input id="hdnTablesToSubmit" type="hidden" name="hdnTablesSub"/>
					<input id="hdnDBsToSubmit" type="hidden" name="hdnDBsSub"/>
					<a href="#" onclick="installMe()" id="installButton">Install</a>
				</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>








