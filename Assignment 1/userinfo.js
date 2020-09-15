var currentTime = new Date();
var month = currentTime.getMonth() + 1;
var day = currentTime.getDate();
var year = currentTime.getFullYear();
var HH = currentTime.getHours();
var MM = currentTime.getMinutes();
var timeStamp = month + "/" + day + "/" + year + " " + HH + ":" + MM;

$.getJSON('https://ipinfo.io/json', function(data) {
    var log = JSON.stringify(data, null, 2);
    
    var datum = timeStamp + "/" + data.ip + "/"
                + data.city + "/" + data.region + "/" + data.country + "/" + data.postal + "/"
                + data.org + "\n\n";
    
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/~dxc190002/cgi-bin/userinfo.php?q="+encodeURIComponent(datum), true);
    xhttp.send();

});