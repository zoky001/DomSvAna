function initialize() {

// WRAP LIST TEXT IN A SPAN, AND APPLY FUNCTIONALITY TABS
  $("#list li")
    .wrapInner("<span>")
    .append("<div class='draggertab tab'></div><div class='colortab tab'></div></div><div class='deletetab tab'></div><div class='donetab tab'></div>");



};



$("#list").sortable({
    handle   : ".draggertab",
    update   : function(event, ui){
       
        // Developer, this function fires after a list sort, commence list saving!

    },
    forcePlaceholderSize: true
});

$(".donetab").live("click", function() {

    if(!$(this).siblings('span').children('img.crossout').length) {
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
            function() {
                           
                // DEVELOPER, the user has marked this item as done, commence saving!

            })
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
                function() {
                           
                // DEVELOPER, the user has UNmarked this item as done, commence saving!

            })
            
    }
});



$(".colortab").live("click", function(){

    $(this).parent().nextColor();

    $.ajax({
       
        // DEVELOPER, the user has toggled the color on this list item, commence saving!

    });
});

jQuery.fn.nextColor = function() {

    var curColor = $(this).attr("class");

    if (curColor == "colorBlue") {
        $(this).removeClass("colorBlue").addClass("colorYellow").attr("color","2");
    } else if (curColor == "colorYellow") {
        $(this).removeClass("colorYellow").addClass("colorRed").attr("color","3");
    } else if (curColor == "colorRed") {
        $(this).removeClass("colorRed").addClass("colorGreen").attr("color","4");
    } else {
        $(this).removeClass("colorGreen").addClass("colorBlue").attr("color","1");
    };

};


$(".deletetab").live("click", function(){

    var thiscache = $(this);
            
    if (thiscache.data("readyToDelete") == "go for it") {
        $.ajax({
          
              // DEVELOPER, the user wants to delete this list item, commence deleting!

              success: function(r){
                    thiscache
                            .parent()
                                .hide("explode", 400, function(){$(this).remove()});

                    // Make sure to reorder list items after a delete!

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
   
    $(editableTarget).editable("/path/for/DEVELOPER/to/save.php", {
        id        : 'listItemID',
        indicator : 'Saving...',
        tooltip   : 'Double-click to edit...',
        event     : 'dblclick',
        submit    : 'Save',
        submitdata: {action : "update"}
    });
    
}


bindAllTabs("#list li span");

('#add-new').submit(function(){

    var $whitelist = '<b><i><strong><em><a>',
        forList = $("#current-list").val(),
        newListItemText = strip_tags(cleanHREF($("#new-list-item-text").val()), $whitelist),
        URLtext = escape(newListItemText),
        newListItemRel = $('#list li').size()+1;
    
    if(newListItemText.length > 0) {
        $.ajax({
           
                // DEVELOPER, save new list item!

            success: function(theResponse){
              $("#list").append("<li color='1' class='colorBlue' rel='"+newListItemRel+"' id='" + theResponse + "'><span id=""+theResponse+"listitem" title='Click to edit...'>" + newListItemText + "</span><div class='draggertab tab'></div><div class='colortab tab'></div><div class='deletetab tab'></div><div class='donetab tab'></div></li>");
              bindAllTabs("#list li[rel='"+newListItemRel+"'] span");
              $("#new-list-item-text").val("");
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

$('#add-new').submit(function(){
    // HTML tag whitelist. All other tags are stripped.
    var $whitelist = '<b><i><strong><em><a>',
        forList = $("#current-list").val(),
        newListItemText = strip_tags(cleanHREF($("#new-list-item-text").val()), $whitelist),
        URLtext = escape(newListItemText),
        newListItemRel = $('#list li').size() 1;
 
    if(newListItemText.length > 0) {
        $.ajax({
            type: "POST",
            url: "db-interaction/lists.php",
            data: "action=add&list="   forList   "&text="   URLtext   "&pos="   newListItemRel,
            success: function(theResponse){
              $("#list").append("<li color='1' class='colorBlue' rel='" newListItemRel "' id='"   theResponse   "'><span id="" theResponse "listitem" title='Click to edit...'>"   newListItemText   "</span><div class='draggertab tab'></div><div class='colortab tab'></div><div class='deletetab tab'></div><div class='donetab tab'></div></li>");
              bindAllTabs("#list li[rel='" newListItemRel "'] span");
              $("#new-list-item-text").val("");
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

function saveListOrder(itemID, itemREL){
    var i = 1,
        currentListID = $('#current-list').val();
    $('#list li').each(function() {
        if($(this).attr('id') == itemID) {
            var startPos = itemREL,
                currentPos = i;
            if(startPos < currentPos) {
                var direction = 'down';
            } else {
                var direction = 'up';
            }
            var postURL = "action=sort&currentListID=" currentListID
                 "&startPos=" startPos
                 "&currentPos=" currentPos
                 "&direction=" direction;
 
            $.ajax({
                type: "POST",
                url: "db-interaction/lists.php",
                data: postURL,
                success: function(msg) {
                    // Resets the rel attribute to reflect current positions
                    var count=1;
                    $('#list li').each(function() {
                        $(this).attr('rel', count);
                        count  ;
                    });
                },
                error: function(msg) {
                    // error handling here
                }
            });
        }
        i  ;
    });
}

// MAKE THE LIST SORTABLE VIA JQUERY UI
// calls the SaveListOrder function after a change
// waits for one second first, for the DOM to set, otherwise it's too fast.
$("#list").sortable({
    handle   : ".draggertab",
    update   : function(event, ui){
        var id = ui.item.attr('id');
        var rel = ui.item.attr('rel');
        var t = setTimeout("saveListOrder('" id "', '" rel "')",500);
    },
    forcePlaceholderSize: true
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
    });
 
}

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

// AJAX style deletion of list items
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