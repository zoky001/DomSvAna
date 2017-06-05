function initialize() {

// WRAP LIST TEXT IN A SPAN, AND APPLY FUNCTIONALITY TABS
  $("#list li")
    .wrapInner("<span>")
    .append("<div class='draggertab tab'></div><div class='colortab tab'></div></div><div class='deletetab tab'></div><div class='donetab tab'></div>");



};

$('#add-new').submit(function(){

    var $whitelist = '<b><i><strong><em><a>',
        forList = $("#current-list").val(),
        newListItemText = strip_tags(cleanHREF($("#new-list-item-text").val()), $whitelist),
        URLtext = escape(newListItemText),
        newListItemRel = $('#list li').size()+1;
    
    if(newListItemText.length > 0) {
        $.ajax({
           
               type: "POST",
            url: "db-interaction/lists.php",
            data: {"action":"add",
					"list":forList,
					"text":URLtext,   
					"pos":newListItemRel
					},

            success: function(theResponse){
             // $("#list").append("<li color='1' class='colorBlue' rel='"+newListItemRel+"' id='" + theResponse + "'>  <span id=""+theResponse+"listitem"  title='Click to edit...'>" + newListItemText + "</span><div class='draggertab tab'></div><div class='colortab tab'></div><div  class='deletetab tab'></div><div class='donetab tab'></div></li>");
			  
            //  bindAllTabs("#list li[rel='"+newListItemRel+"'] span");
             // $("#new-list-item-text").val("");
            },
            error: function(){
                // uh oh, didn't work. Error message?
            }
        });
    } else {
        $("#new-list-item-text").val("");
    }
    return false; // prevent default form submission
});
$(".deletetab").live("click", function(){
    var thiscache = $(this),
        list = $('#current-list').val(),
        id = thiscache.parent().attr("id"),
        pos = thiscache.parents('li').attr('rel');
 
    if (thiscache.data("readyToDelete") == "go for it") {
        $.ajax({
            type: "POST",
            url: "db-interaction/lists.php",
            data: {
                    "list":list,
                    "id":id,
                    "action":"delete",
                    "pos":pos
                },
            success: function(r){
                    var $li = $('#list').children('li'),
                        position = 0;
                    thiscache
                        .parent()
                            .hide("explode", 400, function(){$(this).remove()});
                    $('#list')
                        .children('li')
                            .not(thiscache.parent())
                            .each(function(){
                                    $(this).attr('rel',   position);
                                });
                },
            error: function() {
                $("#main").prepend("Deleting the item failed...");
            }
        });
    }
    else
    {
        thiscache.animate({
            width: "44px",
            right: "-64px"
        }, 200)
        .data("readyToDelete", "go for it");
    }
});

function bindAllTabs(editableTarget) {
 
    // CLICK-TO-EDIT on list items
    $(editableTarget).editable("db-interaction/lists.php", {
        id        : 'listItemID',
        indicator : 'Saving...',
        tooltip   : 'Double-click to edit...',
        event     : 'dblclick',
        submit    : 'Save',
        submitdata: {action : "update"}
});}

$("#list").sortable({
    handle   : ".draggertab",
    update   : function(event, ui){
        var id = ui.item.attr('id');
        var rel = ui.item.attr('rel');
        var t = setTimeout("saveListOrder('" id "', '" rel "')",500);
    },
    forcePlaceholderSize: true
});

// COLOR CYCLING
// Does AJAX save, but no visual feedback
$(".colortab").live("click", function(){
    $(this).parent().nextColor();
 
    var id = $(this).parent().attr("id"),
        color = $(this).parent().attr("color");
 
    $.ajax({
        type: "POST",
        url: "db-interaction/lists.php",
        data: "action=color&id="   id   "&color="   color,
        success: function(msg) {
            // error message
        }
    });
});
function toggleDone(id, isDone)
{
    $.ajax({
        type: "POST",
        url: "db-interaction/lists.php",
        data: "action=done&id=" id "&done=" isDone
    })
}


$(".donetab").live("click", function() {
    var id = $(this).parent().attr('id');
    if(!$(this).siblings('span').children('img.crossout').length)
    {
        $(this)
            .parent()
                .find("span")
                .append("<img src='/images/crossout.png' class='crossout' />")
                .find(".crossout")
                .animate({
                    width: "100%"
                })
                .end()
            .animate({
                opacity: "0.5"
            },
            "slow",
            "swing",
            toggleDone(id, 1));
    }
    else
    {
        $(this)
            .siblings('span')
                .find('img.crossout')
                    .remove()
                    .end()
                .animate({
                    opacity : 1
                },
                "slow",
                "swing",
                toggleDone(id, 0));
 
    }
});