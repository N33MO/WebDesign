$.getJSON("js/data.json", function(data) {
    $(".gallery").empty();
    $.each(data, function(key, value) {
        var id = value['id'];
        var title = value['title'];
        var imgPath = value['path'];
        var path = "./images/square/" + imgPath;
        $(".gallery").append('<li><img id="' + id + '" name="' + imgPath + '" src="' + path + '" alt="' + title + '"></li>');
    });
})
.fail(function() { alert("getJSON error"); });


$(document).ready(function() {
    
    $("img").mouseenter(function(e) {
        $(this).addClass("gray");
        var id = $(this).attr('id');
        var imgPath = $(this).attr('name');
        var title = $(this).attr('alt');
        var path = "./images/medium/" + imgPath;
        
        $('body').append('<div id="preview"></div>');
        var large = "";
        large += '<img name="' + imgPath + '" src="' + path + '" alt="' + title + '">';
        large += '<p>' + title + '</p>';
        
//        $('#preview').append('<img name="' + imgPath + '" src="' + path + '" alt="' + title + '">');
//        $('#preview').append('<p>' + title + '</p>');
        $('#preview').append(large);
        $.getJSON("js/data.json", function(data) {
            $.each(data, function(key, value) {
                if(value['id'] == id) {
                    var info = value['city'] + ", " + value['country'] + " (" + value['taken'] + ")";
                    $('#preview').append('<p>' + info + '</p>');
                }
            });
        });
//        $('#preview').css({'top': e.pageY, 'left':e.pageX});
        $('#preview').fadeIn(1000);
        
    });
    
    $("img").mouseleave(function() {
        $(this).removeClass("gray");
        $('#preview').remove();
    });
    
    $("img").mousemove(function(e) {
        $('#preview').css({'top': e.pageY+20, 'left':e.pageX+20});
    })
    
});