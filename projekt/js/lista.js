function initialize() {

// WRAP LIST TEXT IN A SPAN, AND APPLY FUNCTIONALITY TABS
  $("#list li")
    .wrapInner("<span>")
    .append("<div class='draggertab tab'></div><div class='colortab tab'></div></div><div class='deletetab tab'></div><div class='donetab tab'></div>");



};

// AJAX style adding of list items
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