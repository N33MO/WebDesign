$(document).ready(function(){
    
    console.log("document ready.");
    
    $("#myForm").submit(function(event) {
        
        console.log("form submitted.");
        
        var ajaxRequest;
        
        event.preventDefault();
        
        $(".result").html('');
        var values = $(this).serialize();
        
        ajaxRequest = $.ajax({
            url: "babynames.php",
            type: "post",
            data: values
        });
        
        ajaxRequest.done(function(response, textStatus, jqXHR) {
            $(".result").html(response);
            console.log("success.");
        });
        
        ajaxRequest.fail(function() {
            $(".result").html("There is error while submit");
            console.log("failed.");
        });
    });
});