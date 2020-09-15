window.onload = function(){

    // there will be one span element for each input field
    // when the page is loaded, we create them and append them to corresponding input element 
	// they are initially hidden

    // span1 for username
    var span1 = document.createElement("span");
	span1.style.display = "none"; //hide the span element
    // span 2 for password
    var span2 = document.createElement("span");
    span2.style.display = "none";
    // span3 for email
    var span3 = document.createElement("span");
    span2.style.display = "none";
    
    // set var for easy access element
	var username = document.getElementById("username");
    username.parentNode.appendChild(span1);
    
    var password = document.getElementById("password");
    password.parentNode.appendChild(span2);
    
    var email = document.getElementById("email");
    email.parentNode.appendChild(span3);
    
    // set regular expressions rules for username and email
    let re_username = /[^A-Za-z0-9]+/;
    let re_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    // username field
    username.onfocus = function(){
        span1.textContent = "(username should contain only alphanumeric characters.)";
        span1.className = "";
        span1.style.display = "inline-block";
    }
    username.onblur = function(){
        var valid1 = re_username.test(username.value);
        if(valid1 == false) {
            span1.textContent = "Ok";
            span1.className = "ok";
        }
        else {
            span1.textContent = "Error";
            span1.className = "error";
        }
        if(username.value === ""){
            span1.className = "";
            span1.style.display = "none";
        }
    }
    
    // pasword field
    password.onfocus = function(){
        span2.textContent = "(password should contain at least six characters)";
        span2.className = "";
        span2.style.display = "inline-block";
    }
    password.onblur = function(){
        if(password.value.length >= 6) {
            span2.textContent = "Ok";
            span2.className = "ok";
        }
        else {
            span2.textContent = "Error";
            span2.className = "error";
        }
        if(password.value.length == 0) {
            span2.className = "";
            span2.style.display = "none";
        }
    }
    
    // email field
    email.onfocus = function(){
        span3.textContent = "(e.g. abc@def.xyz)";
        span3.className = "";
        span3.style.display = "inline-block";
    }
    email.onblur = function(){
        var valid3 = re_email.test(email.value);
        if(valid3 == true) {
            span3.textContent = "Ok";
            span3.className = "ok";
        }
        else {
            span3.textContent = "Error";
            span3.className = "error";
        }
        if(email.value === "") {
            span3.className = "";
            span3.style.display = "none";
        }
    }
    
}


