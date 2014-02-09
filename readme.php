<?php
	session_start();
	include 'simple_tagger_php/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

	<!--[if IE ]>
   		<style type="text/css">
			#content_area{
				position:relative;
   			}
   			
			#sidebar_right{
				padding-left:10px;
				padding-top:2px;
				left:25px;
			}
   		</style>
	<![endif]-->

	<title>The Simple Content Tagger</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="jui/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="simple_tagger_scripts/script.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css"/>
	<link type="text/css" rel="stylesheet" href="css/tag_styles.css"/>
</head>
<body>

<div id="header">
	<div id="header_inner">
	</div>
</div>
<div id="content" class="readmePage">
	<div id="content_inner">
		<div id="content_area">
				<ul id="nav">
			<li ><a href="index.php">Examples</a></li>
			<li class="active"><a href="installer.php">Installer</a></li>
			<li><a href="readme.php">Read me</a></li>
		</ul>
			<div class="intro_text">
				<h3> Quick Start Guide</h3>
				<p class="readme_introText">
					<br/>	
					At this point everything should be installed on your own or hosted server. This guide will give you a quick
					tutorial on how to start tagging your own content!
					<br/><br/>
					If the installation was successful and you are happy with your settings it is <span class="red">very important</span> that you either remove the 
					<span class="dir">installer.php</span> and <span class="dir">setup.php</span> files from your server / workspace or secure them with admin credentials until they are needed again.
				</p>
					<br/><br/>
				<h4 class="dir">Step 1. What To Include</h4><br/>
				<p class="readme_introText">
					With this plugin you can tag any kind of content you choose. But in order to do so you need to have a few things included on your
					web pages first.
				</p>
					<br/>
				<p>
					First off you will need to include just 1 PHP file at the top of any pages you wish to use tags on :<br/>
				</p>
						<div class="code">
							include 'simple_tagger_php/functions.php';
						</div>
					<br/>
				<p>
					You will also need jQuery and jQueryUI (included) on your page too : 
				</p>
				
				<div class="code">

					&lt;script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"&gt;&lt;/script&gt;<br/>
					&lt;script type="text/javascript" src="jui/js/jquery-ui-1.8.23.custom.min.js"&gt;&lt;/script&gt;<br/>
				</div>
				<br/>				
				<p>
					And finally the Simple Tagger plugin script and CSS stylesheet : <br/>
				</p>
				<div class="code">
					&lt;script type="text/javascript" src="simple_tagger_scripts/script.js"&gt;&lt;/script&gt;<br/>
					&lt;link type="text/css" rel="stylesheet" href="css/tag_styles.css"/&gt;
				</div>
				<br/>
				<br/>
				<h4 class="dir">Step 2. Setting up your content</h4><br/>
				<p>
					In order to make your content taggable it must contain HTML classes which are formatted in a certain way. This will allow the
					tag to know which database, table and user(if required) the content belongs to.				
					<br/><br/>
				</p>
					<ul class="articleList">
						<li>
							<ul class="returnedData"> 
								<li class="myid_4 anArticle myloc_1 myhold_0 taggable">
									<h3>Database Driven!</h3>
									<br/>
										The keywords are stored in their own local database on your system, so you can plug them into any content on your already existing site!
								</li>
								
								<li>
									<ul class="itemTags">
										<li class="itemTag">
											<span class="keyword dtbl_1 taggedid_4">
												Interesting
											</span>
											
											<span class="keywordHandle dtbl_1 taggedid_4 taggedhold_0"> 
												<img src="images/x002.png" alt="handle"/>
											</span>
										</li>
										<li class="itemTag">
											<span class="keyword dtbl_1 taggedid_4">
												Article
											</span>
											<span class="keywordHandle dtbl_1 taggedid_4 taggedhold_0"> 
												<img src="images/x002.png" alt="handle"/>
											</span>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul> 
					If you take this article as an example you will see the 4 classes which are necessary to make any content taggable.<br/><br/>
					<ul>
						<li>1) <b>taggable</b></li>
						<li>2) <b>myid_[insert table <span class="dir">row</span> number]</b></li>
						<li>3) <b>myloc_[insert <span class="dir">table</span> number]</b></li>
						<li>4) <b>myhold_[insert <span class="dir">database</span> number]</b></li>
					</ul>
				<p>	
					<br/>
					So the HTML for an article like this one might look a little like :<br/>
				
				</p>
				<div class="code">
						&lt; li class="myid_4 anArticle myloc_1 myhold_0 taggable">&lt;/li>
					</div>
				<p>
					<br/>
					After you have used the installer you will be able to use the <span class="dir">simple_tagger_php/settings.php</span> file as reference
					or the sidebar here will come in handy too! <br/><br/>
					You have referenced <?php echo(count($GLOBALS["taggableDataTables"]));?> tables and <?php echo(count($GLOBALS["taggableDataDB"]));?> databases.<br/><br/>
					So if , for example; you wanted to tag an item that is stored in the <b><?php echo($GLOBALS["taggableDataTables"][0]); ?> </b> table within your <b><?php echo($GLOBALS["taggableDataDB"][count($GLOBALS["taggableDataDB"])-1]); ?> </b>database,
					you would use the following classes on that piece of content : <b>myloc_<?php echo(count($GLOBALS["taggableDataDB"])-1);?></b>, <b>myhold_0</b> and <b>myid_<em>"my_row_position_in_the_database_table"</em></b>.<br/><br/> Don't forget to add <b>"taggable"</b> as a class too!<br/><br/>
					The numbers following <b>myloc_</b> and <b>myhold_</b> simply reflect that table / database's index in the corresponding array in the <span class="dir">settings.php</span> file.
				</p>		
				<br/>
				<br/>
				<h4 class="dir">3. Calling the tags</h4><br/>
				<p>	Now that you have your content ready to be tagged, you need somewhere to create your tags!<br/>
				You simply need to have a text input field on your page with the ID attribute of <b>"tagMaker"</b> :
				</p>
				<div class="code">
				&lt;div id="tags"&gt;<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&lt;div id="tag_maker_holder"&gt;<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;h3>Create a tag.&lt;/h3&gt;<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;label class="instruction">Separate keywords with a coma(,).&lt;/label&gt;<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="text" id="<span class="dir">tagMaker</span>"&gt;<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;
					&lt;/div&gt;<br/>

					&lt;/div&gt;<br/>
				</div>
				<br/>
				
				<p>
					Now that you have a way of creating keyword text, you need to load the keywords previously made by the currently logged in user. You do this by calling the javascript
					<b>loadKeywords()</b> function and passing it the ID of the element you want to hold the keywords! Something like <b>loadKeywords("#tags")</b>.<br/><br/>
					If you want to display the tags that a piece of content already has assigned to it , you just call the <b>loadTags()</b> function, passing in the jQuery object
					holding the this list of tags and the jQuery object of the content which has been tagged. Use something like this to show a list of items and their tags :
					<br/>
				</p>
				
				<div class="code">	
					$(".taggable").each(function(){<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;	myTagList = $(this).parent().find(".itemTags");<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;	loadTags(myTagList,$(this));<br/>
					});
				</div>
				<br/>
				<h4 class="dir">4. Complete!</h4>
				<br/>
				<p>
					Thats all there is to it, you can use the sidebar on the right of this page to work out what classes to give your own content
					or if you remove this page for security reasons you can read and edit the <span class="dir">setting.php</span> file directly.
				</p>
				<br/><br/>
				<h3 id="themeHeader">Themes and Animations</h3><br/>
				<p id="theme_intro">
					If you wish to add a little colour to your tags there are 4 themes set up and ready to go out the box. The system has been split into separate
					CSS files so if you wish to create your own, just make a copy and edit the <span class="dir">tag_styles.css</span> file. To call one of the preset 
					themes all you need to do is add this javascript function call to the bottom of your page (or after page load)!
				</p>
				<div class="code">
					setTheme("#tag_maker_holder","darkTheme");<br/><br/>
					//The first argument represents the item holding the tag list and the second is the theme name
				</div>
				<p>
					There are 4 possible string arguments for this call which are : <b>"darkTheme","blueTheme", "greenTheme"</b>and<b>"pastelTheme"</b>.
				</p><br/>
				<p>
					You can also have the tags animate either upon creation or once they are dropped on a target. To set the type of animation upon creating a tag 
					just call the below javascript function, passing in the name of the animation :
				</p>
				<div class="code">
					setcreateTagAnimation("slowFade");
					// The only argument required is the animation name 
				</div><br/>
				<p>
				The available animations are ; <b>"sneak","flash","bounce","bubble","quickFade"</b> and <b>"slowFade"</b>.
				To change the animations used when adding a tag to an element, just use one of the same arguments with the following function :
				</p><br/>
				<div class="code">
						setTagItemAnimation("sneak");	// The only argument required is the animation name 		
				</div>
				<br/><br/>
			</div>
		</div>
		<div id="sidebar_right">
			<div id="readMeSettings">
			<h3>Your Database ID's</h3><label>myhold_</label>
			<?php
				for($i=0; $i<count($GLOBALS["taggableDataDB"]); $i++){
					echo('<span class="dir">'.$GLOBALS["taggableDataDB"][$i]." = ".$i."</span><br/>");
					}
			?>
			<br/>
			<h3>Your Table ID's</h3><label>myloc_</label>
			<?php
				for($i=0; $i<count($GLOBALS["taggableDataTables"]); $i++){
					echo('<span class="dir">'.$GLOBALS["taggableDataTables"][$i]." = ".$i."</span><br/>");
					}
			?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>








