
$(document).ready(function(){
    $("i").click(function(){
        $("#addNew").fadeToggle(200);
        $("#newItem").fadeToggle(200);
//        $("#addNew").toggleClass("active");
    });
    
    $("#newItem").hover(function(){
        $("input").css("border-color", "dodgerblue");
        $("input").css("border-width", "2px");
        },function(){
        $("input").css("border-color", "lightgray");
        $("input").css("border-width", "1px");
    });
    
    $("#addNew").keypress(function(event){
        if(event.which === 13) {
            var $newRow = '<tr class="active unselectable" style="display: none"><td><span class="col-11">' + $("#newItem").val() + '</span>' + '<span name="delete" class="col-1 float-right" style="display: none"><i class="fa fa-trash"></i></span></td></tr>';
            $("tbody").append($newRow);
            $(".active").show(200);
            $("#newItem").val("");
        }
    });
    
//    $("tbody").on("hover", "tr > td", function() {
//        $(this).css("background-color", "dodgerblue");
//        }, function() {
//        $(this).css("background-color", "white");
//    });

    
    $("tbody").on("click", "tr", function(){
        $(this).toggleClass("done");
    });
    
    $("tbody").on("mouseover mouseout", "tr", function(e){
        if(e.type == "mouseover") {
            $(this).css("background-color", "lightblue");
//            $('span[name$="delete"]').show();
            $(this).find('span[name$="delete"]').show();
        }
        if(e.type == "mouseout") {
            $(this).css("background-color", "white");
//            $('span[name$="delete"]').hide();
            $(this).find('span[name$="delete"]').hide();
        }
    });
    $('tbody').on("click", 'tr td span[name$="delete"]', function(){
//        alert(1);
        $(this).parentsUntil("tr").remove();
    });
    
});