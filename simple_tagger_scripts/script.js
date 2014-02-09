/***********SystemVariables*************/
var tagMakerInput_id = "#tagMaker"; // THIS ELEMENT (DIV) HOLDS THE INPUT FIELD FOR TYPING IN A NEW KEYWORD
var currentDragTag;
var activationKey = ","; // THE BUTTON PRESSED TO CREATE A NEW KEY


var pastelColor = [];
pastelColor[0] = "pastelYellow";
pastelColor[1] = "pastelGreen";
pastelColor[2] = "pastelBlue";
pastelColor[3] = "pastelYellow";
pastelColor[4] = "pastelPink";

var tagItemAnimationName = "";
var createTagAnimationName = "";

/**************************************/

$(document).ready(function() {
  docRefresh();

});

function docRefresh()
{
	createDragDrop("");

	$(tagMakerInput_id).keyup(function() { // LOOK FOR THE USER TYPING IN A KEYWORD

		var typed=$(tagMakerInput_id).val();
		var isUnique = 1;
		
		if(typed.indexOf(activationKey) != -1  ) // WHEN THE COMMA KEY IS PRESSED
		{
			var idText = typed;
			idText=idText.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, "");
			
			$("#tagList .tagListItem").each(function(index) {
				if($(this).find(".keyword").text() == idText.slice(0,(typed.length)-1))
				{
					isUnique = 0;
					$(tagMakerInput_id).val("");
					return false;
				} else
				{
					isUnique = 1;
				}
			});
			
			if(isUnique == 1)
			{
				typed=$.trim(typed.replace(activationKey,""));
				$("#tagList").append('<li id="myKeyword_'+idText+'" class="tagListItem"><span class="keywordHeader"><img src="simple_tagger_scripts/pix.gif" alt="pix"/></span><span class="keyword">'+idText+'</span><span onClick="deleteKeyword($(this))" class="keywordHandle"><img src="images/x002.png" alt="Delete Keyword"></span></li>');
				$(tagMakerInput_id).val("");
				createDragDrop(typed);
				createTagAnimation($("#tagList").find("li").last());
			}
		}
	});
}
function createDragDrop(dataToSend) // MAKE A KEYWORD ITEM IN THE DB AND CREATE THE JQUERY PROPERTYS OF DRAGGABLE / DROPPABLE
{
	if(dataToSend == "")
	{
	}else{
		$.ajax({
		type: "POST",
		url: "simple_tagger_php/simpleTagger_makeTag.php",
		data: {
			action: dataToSend
		},
           async: false,
            success: function (data) {
          }
        });
	}
		   
$( ".tagListItem" ).draggable({
				revert: true  ,
			  start: function(event, ui) {
		  		
		  		$('#pageMain_inner').find('.taggable').each(function(){
		  			$(this).addClass("displayTaggable");
		  		});
				currentDragTag = $(this);
		  	  },
		  	
		  	stop: function(event, ui) {
		  		$('#pageMain_inner').find('.taggable').each(function(){
		  			$(this).removeClass("displayTaggable");
		  		});
		  		currentDragTag = "";
		  	  }
			}); 
	
	$( ".taggable" ).droppable ({
    	drop: function() 
	    {
			var isUnique = 1;
	    	$(this).parent().find(".itemTags .itemTag").each(function()
		    {
				if($.trim($(this).text()) == $.trim($(currentDragTag).find('.keyword').text()))
				{
					isUnique = 0;
					return false;
				}
				else{
					isUnique = 1;
				}
			});
	     
		     if(isUnique == 1)
		     {
		    
	    	 	if(addTag(currentDragTag,$(this)).indexOf("task_success") >= 0)
				{
					tagAdded($(this),currentDragTag);
				}
	     	}	
    	}
	});
}

function loadKeywords(tagListHolder){ // WILL LOAD TAGS INTO AN UNORDERED LIST WITH THE ID OF "tagListHolder"

	var dataToSend =[];
	dataToSend[0] = "loadKeywords";
	
	var result = $.ajax({
		type: "POST",
		url: "simple_tagger_php/functions.php",
		data: {
			action: dataToSend
		},
           async: false,
            success: function (data) {
			$(tagListHolder).append(data);
          }
        }) .responseText ;

        return  result;
}

function loadTags(holdingElement,taggedElement){ 
	var attribs = $(taggedElement).attr("class").split(" ");
	
	for (i=0; i<attribs.length; i++)
	{
		if (attribs[i].indexOf("myid_") >= 0)
		{
			var tempStr = attribs[i].split("myid_");
			toTagID = tempStr[1];
		}
			
		if (attribs[i].indexOf("myloc_") >= 0)
		{
			var tempStr = attribs[i].split("myloc_");
			toTagTable = tempStr[1];
		}
			
		if (attribs[i].indexOf("myhold") >= 0)
		{
			var tempStr = attribs[i].split("myhold_");
			locTagHold = tempStr[1];		
		}
}
			

	var dataToSend =[];
	dataToSend[0] = "loadTags";
	dataToSend[1] = toTagID;
	dataToSend[2] = toTagTable;
	dataToSend[3] = locTagHold;
	
	var result = $.ajax({
		type: "POST",
		url: "simple_tagger_php/functions.php",
		data: {
			action: dataToSend
		},
           async: false,
            success: function (data) {
			$(holdingElement).append(data);
          }
        }) .responseText ;

        return  result;
}


function createMyTagList(myObject)
{
	$(myObject).parent().append('<ul class="itemTags"></ul>');
}

function addTag(theTag,theDestination) // SPLITS THE CLASS ELEMENTS OF A KEYWORD DOWN AND ASSOCIATES THE KEYWORD WITH A PAGE ELEMENT
{

		var dataToSend =[];
		var attribs = $(theDestination).attr("class").split(" ");
		var toTagID="";
		var toTagTable = "";
		var locTagHold = "0";
		for (i=0; i<attribs.length; i++)
		{
			if (attribs[i].indexOf("myid_") >= 0)
			{
				var tempStr = attribs[i].split("myid_");
				toTagID = tempStr[1];
			}
			
			if (attribs[i].indexOf("myloc_") >= 0)
			{
				var tempStr = attribs[i].split("myloc_");
				toTagTable = tempStr[1];
			}
			
			if (attribs[i].indexOf("myhold") >= 0)
			{
				var tempStr = attribs[i].split("myhold_");
				locTagHold = tempStr[1];		
			}
		}
		
		dataToSend[0] = $(theTag).text();
 		dataToSend[1] = toTagID;
 		dataToSend[2] = toTagTable;
 		dataToSend[3] = locTagHold;
 		
		var result = $.ajax({
		type: "POST",
		url: "simple_tagger_php/simpleTagger_tagItem.php",
		data: {
			action: dataToSend
		},
           async: false,
            success: function (data) {

          }
        }) .responseText ;
        
        return  result;
}


function deleteKeyword(itemObject) // DELETE A KEYWORD AND REMOVES ALL OCCURANCES OF IT IN THE TAG TABLE
{
		
		var dataToSend =[];

		theKeyword = $(itemObject).parent().find(".keyword").text();
		dataToSend[0] = "keyword";
		dataToSend[1] = theKeyword;
	
		$.ajax({
		type: "POST",
		url: "simple_tagger_php/simpleTagger_delete.php",
		data: {
			action: dataToSend
		},
    	    async: false,
        	success: function (data) 
        	{
				if(data.indexOf("task_success") >= 0)
	    	    {
        			keywordDeleted(itemObject);
	        	}
	    	}
    		});
}

function removeTag(itemObject){ // UNLINK A TAG FROM ITS ASSOCIATED ELEMENT IN THE TABLE BUT LEAVE THE KEYWORD INTACT 

	var dataToSend =[];

	theKeyword  = $(itemObject).parent().find(".keyword").text();
	
	var attribs = $(itemObject).attr("class").split(" ");
	var taggedID = "";
	var dataTable = "";
	var locTagHold = "0";
	for (i=0; i<attribs.length; i++)
	{
		if (attribs[i].indexOf("taggedid_") >= 0)
		{
			var tempStr = attribs[i].split("taggedid_");
			taggedID = tempStr[1];
		}
		
		if (attribs[i].indexOf("dtbl_") >= 0)
		{
			var tempStr = attribs[i].split("dtbl_");
			dataTable = tempStr[1];
		}
		
		if (attribs[i].indexOf("myhold_") >= 0)
		{
			var tempStr = attribs[i].split("myhold_");
			locTagHold = tempStr[1];		
		}
	}
	
	dataToSend[0] = "tag";
	dataToSend[1] = taggedID;
 	dataToSend[2] = theKeyword;
 	dataToSend[3] = dataTable;
 	dataToSend[4] = locTagHold;
 		
	$.ajax({
		type: "POST",
		url: "simple_tagger_php/simpleTagger_delete.php",
		data: {
			action: dataToSend
		},
	    async: false,
        success: function (data) {
	    	if(data.indexOf("task_success") >= 0)
	        {	
        		tagRemoved(itemObject);
    	    }
	    }
    });
}

function tagRemoved(toRemove) // DELETE A TAG FROM THE INTERFACE
{
	$(toRemove).parent().remove();
}

function keywordDeleted(toDelete) // DELETE A KEYWORD FROM THE INTERFACE
{

	$(".itemTags").find('.itemTag').each(function(){
	
		if(toDelete.parent().find(".keyword").text()==$(this).find(".keyword").text())
		{
			$(this).remove();
		}
	});
	
	$(toDelete).parent().remove();
}

function tagAdded(theTaggedItem,curDragTag) // UPDATE THE INTERFACE TO DISPLAY THE NEWLEY ADDED TAG
{
				
	var attribs = $(theTaggedItem).attr("class").split(" ");
	
	var locTagText = $(curDragTag).find('.keyword').text();
	var locTagDtbl = "";
	var locTaggedID = "";
	var locTagHold = "0";
	
	for (i=0; i<attribs.length; i++)
	{
		if (attribs[i].indexOf("myid_") >= 0)
		{
			var tempStr = attribs[i].split("myid_");
			locTaggedID = tempStr[1];
		}
		
		if (attribs[i].indexOf("myloc_") >= 0)
		{
			var tempStr = attribs[i].split("myloc_");
			locTagDtbl = tempStr[1];		
		}
		
		if (attribs[i].indexOf("myhold_") >= 0)
		{
			var tempStr = attribs[i].split("myhold_");
			locTagHold = tempStr[1];		
		}
	}
	
	var newTagItem  = '<li class="itemTag" >';
	
	newTagItem=newTagItem+'<span class="keywordHeader"><img src="simple_tagger_scripts/pix.gif" alt="pix"/></span><span class="keyword '+"dtbl_"+locTagDtbl+' taggedid_'+locTaggedID+'">'+locTagText+"</span>";
	newTagItem=newTagItem+'<span onClick="removeTag($(this))" class="keywordHandle '+"dtbl_"+locTagDtbl+' taggedid_'+locTaggedID+' taggedhold_'+locTagHold+'"> <img src="images/x002.png" alt="Delete Keyword"></span>'
	newTagItem=newTagItem+"</li>";
	
	$(theTaggedItem).parent().find(".itemTags").append(newTagItem);
	
	tagItemAnimation($(theTaggedItem).parent().find(".itemTags li").last());
	
}

/*Themeing and Animating*/

function setTheme(holder, themeName){



	if (themeName == "blueTheme"){$(holder).addClass("blueTheme");}
	if (themeName == "greenTheme"){$(holder).addClass("greenTheme");}
	if (themeName == "darkTheme"){$(holder).addClass("darkTheme");}
	
	if (themeName == "pastelTheme"){
		$(holder).addClass("pastelTheme");
		$(holder).find(".itemTags").addClass("pastels");
		$(holder).find(".itemTags li").each(function() {
			 var rnd = Math.ceil(Math.random()*4);
			 $(this).addClass(pastelColor[rnd]);
		});
		
		$(holder).find(".tagListItem").each(function() {
			 var rnd = Math.ceil(Math.random()*4);
			 $(this).addClass(pastelColor[rnd]);
		});	
	}
}


/*ANIMATION*/

function setcreateTagAnimation(theAnimation){
	createTagAnimationName = theAnimation;
}

function setTagItemAnimation(theAnimation){
	tagItemAnimationName = theAnimation;	
}

function createTagAnimation(theObject){
	if(createTagAnimationName == "bubble" || createTagAnimationName == "Bubble"){bounceAnim(theObject);}
	if(createTagAnimationName == "bounce" || createTagAnimationName == "Bounce"){bounceAnim(theObject);}
	if(createTagAnimationName == "sneak" || createTagAnimationName == "Sneak"){sneakAnim(theObject);}
	if(createTagAnimationName == "flash" || createTagAnimationName == "Flash"){flashAnim(theObject);}

		
	if(createTagAnimationName == "quickFade" || createTagAnimationName == "quickfade")
	{
		$(theObject).hide();
		$(theObject).fadeIn(400);
	}
	
	if(createTagAnimationName == "slowFade" || createTagAnimationName == "slowfade")
	{
		$(theObject).hide();
		$(theObject).fadeIn(1200);
	}
	
	var testClass=$(theObject).parent().parent().attr("class");
	
	if((testClass.indexOf("pastels") >= 0))
	{
		var rnd = Math.ceil(Math.random()*4);
		$(theObject).addClass(pastelColor[rnd]);
	}
	
}

function tagItemAnimation(theObject){

	if(tagItemAnimationName == "bubble" || tagItemAnimationName == "Bubble"){bounceAnim(theObject);}
	if(tagItemAnimationName == "bounce" || tagItemAnimationName == "Bounce"){bounceAnim(theObject);}
	if(tagItemAnimationName == "sneak" || tagItemAnimationName == "Sneak"){sneakAnim(theObject);}
	if(tagItemAnimationName == "flash" || tagItemAnimationName == "Flash"){flashAnim(theObject);}
		
	if(tagItemAnimationName == "quickFade" || tagItemAnimationName == "quickfade")
	{
		$(theObject).hide();
		$(theObject).fadeIn(400);
	}
	
	if(tagItemAnimationName == "slowFade" || tagItemAnimationName == "slowfade")
	{
		$(theObject).hide();
		$(theObject).fadeIn(1200);
	}
	
	var testClass=$(theObject).parent().parent().attr("class");
	
	if((testClass.indexOf("pastels") >= 0))
	{
		var rnd = Math.ceil(Math.random()*4);
		$(theObject).addClass(pastelColor[rnd]);
	}
	
}

function bubbleAnim(theObject){

	$(theObject).show();

	$(theObject).find('span').each(function(){
       $(this).animate({ 
			padding:"8px"			
		}, 100); 	
	});


	$(theObject).find('span').each(function(){
       $(this).animate({ 
			padding:"4px"
		}, 120); 	
	});	
	
	$(theObject).find('span').each(function(){
       $(this).animate({ 
			padding:"5px"
		}, 160); 	
	});		
	$(theObject).find('span').each(function(){
       $(this).animate({ 
			padding:"4px"
		}, 160); 	
	});	

}

function bounceAnim(theObject)
{
	$(theObject).effect("bounce", { times:2 }, 250);
}

function sneakAnim(theObject){
	$(theObject).show("drop", { direction: "down" }, 200);
}

function flashAnim(theObject){
	$(theObject).effect("pulsate", { times:2 }, 300);
}


