<?php
	session_start();
	$_SESSION['s_UserID'] = "1"; 
	include 'simple_tagger_php/functions.php';
	include 'simple_tagger_php/example_functions.php';

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
		
</head>

<body>

<div id="header">
	<div id="header_inner">
	</div>
</div>


<div id="content" class="<?php if($GLOBALS['setup_run']==0){echo("noInstall");} ?>">
	<div id="content_inner">
		<div id="content_area">
		
		<ul id="nav">
			<li ><a href="index.php">Examples</a></li>
			<li class="active"><a href="installer.php">Installer</a></li>
			<li><a href="readme.php">Read me</a></li>
		</ul>
		
		
			<div class="intro_text">


							<?php
				if($GLOBALS['setup_run']==0)
				{
					echo('
					
					<div class="blueTheme" id="dummyimages">
						<div class="returnedData2">
							<img class="dummyImage" src="example images/raspberrys.png" alt="Tag">
								<ul class="dummyItemTags">
									<li class="itemTag">
										<span class="keywordHeader">
											<img alt="pix" src="simple_tagger_scripts/pix.gif">
										</span>
										<span class="keyword myhold_0 dtbl_0 taggedid_1">
											Tag
										</span>
										<span class="keywordHandle myhold_0 dtbl_0 taggedid_1" alt="Delete Keyword" onclick="removeTag($(this))">
											<img src="images/x002.png" alt="handle">
										</span>
									</li>
									<li class="itemTag">
										<span class="keywordHeader">
											<img alt="pix" src="simple_tagger_scripts/pix.gif">
										</span>
										<span class="keyword myhold_0 dtbl_0 taggedid_1">
											Absolutely
										</span>
										<span class="keywordHandle myhold_0 dtbl_0 taggedid_1" alt="Delete Keyword" onclick="removeTag($(this))">
											<img src="images/x002.png" alt="handle">
										</span>
									</li>
									<li class="itemTag">
										<span class="keywordHeader">
											<img alt="pix" src="simple_tagger_scripts/pix.gif">
										</span>
										<span class="keyword myhold_0 dtbl_0 taggedid_1">
											Anything
										</span>
										<span class="keywordHandle myhold_0 dtbl_0 taggedid_1" alt="Delete Keyword" onclick="removeTag($(this))">
											<img src="images/x002.png" alt="handle">
										</span>
									</li>
								</ul>
							</div>
						</div>
						
						
						
						
						<div id="product_description">
					<h3>Simple Content Tagger</h3>
					<ul id="feature_list">
						<li>Drag and drop tags onto any content on your site.</li>
						<li>6 Animations ready to use out of the box.</li>
						<li>4 Ready to go design themes.</li>
						<li>100% Customisable. </li>
						<li>Ajax driven for realtime tagging. </li>
					</ul>
				</div>
						
						
					<br/><br/>
					
					It looks as though you have not run the <a href="installer.php">installer</a> yet. This will help you get up to date,
					or if you prefer to install your tagger manually you can go ahead and edit the <span class="dir">simple_tagger_php/settings.php</span>
					yourself.<br/><br/>
					Click <a href="installer.php">here</a> to run the installer.
					');
				}
				else{
			?>

			</div>
			
			
			<div id="top_content">
				<div id="images" class="blueTheme">
					<?php
						printTaggableData1(0,0); 
					?>
				</div>
			
				<div id="product_description">
					<h3>Simple Content Tagger</h3>
					<ul id="feature_list">
						<li>Drag and drop tags onto any content on your site.</li>
						<li>6 Animations ready to use out of the box.</li>
						<li>4 Ready to go design themes.</li>
						<li>100% Customisable. </li>
						<li>Ajax driven for realtime tagging. </li>
					</ul>
				</div>
			</div>		
			
			<div id="articles">
				<ul class="articleList">
					<li>
						<ul class="returnedData blueTheme">
							<li class="myid_1 anArticle myloc_1 myhold_0 taggable ui-droppable">
								<h3>Simple Setup!</h3>
								<br/>
								Once you have installed the package with the installer, all you need to do is include the script libraries and call a few lines of code!
							</li>
						</ul>
						<ul class="returnedData greenTheme">
							<li class="myid_2 anArticle myloc_1 myhold_0 taggable ui-droppable">
								<h3>Customisable</h3>
								<br/>
								The code has been split into chunks for easy customisation. No advanced PHP knowledge is needed to get started, but you have full control!							</li>
						</ul>
						<ul class="returnedData pastelTheme">
							<li class="myid_3 anArticle myloc_1 myhold_0 taggable ui-droppable">
								<h3>Ajax based!</h3>
								<br/>
								Creating keywords and tags happens on the fly. There is no need to reload the page as all the work is done in the background!
							</li>
						</ul>
						<ul class="returnedData darkTheme">
							<li class="myid_4 anArticle myloc_1 myhold_0 taggable ui-droppable">
								<h3>Database Driven!</h3>
								<br/>The tags are stored in their own local database on your system, so you can plug them into any content already existing on your site!
							</li>
						</ul>
					</li>
				</ul>
			</div>
			
			<?php
			
					}	
			?>
		</div>
		<div id="sidebar_right" class="<?php if($GLOBALS['setup_run']==0){echo("noInstall");} ?>">
			<div id="alltags">
				<div id="tag_maker_holder">
					<h3>Create a tag.</h3>
					<label class="instruction">Separate keywords with a comma(,)</label>
					<input type="text" id="tagMaker"/>
						<div id="tags">		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">

	loadKeywords("#tags");

	$(".taggable").each(function(){
		var tagList = createMyTagList($(this));
	});

	$(".taggable").each(function(){
		myTagList = $(this).parent().find(".itemTags");
		loadTags(myTagList,$(this));
	});
	
	setTheme("#tag_maker_holder","darkTheme");
	setTheme(".articleList .pastelTheme","pastelTheme");

	setcreateTagAnimation("sneak");
	setTagItemAnimation("bounce");

	
</script>
</body>
</html>








