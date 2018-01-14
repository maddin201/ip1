/* The variable theDOM1 will be true for modern browsers. */
var theDOM1 = (document.getElementById) ? true : false;

/* theApp will contain the browser name */
var theApp = navigator.appName.toLowerCase();

/* UA (user agent) contains detailed browser info. For example, 
UA for Internet Explorer on Mac would be 'mozilla/4.0 (compatible; 
msie 5.0; mac_powerpc)' */
var UA = navigator.userAgent.toLowerCase();

/* variables for the two major browsers in existence today. */
var isIE = (UA.indexOf('msie') >= 0) ? true : false;
var isNS = (UA.indexOf('mozilla') >= 0) ? true : false;

/* 'compatible' text string is only in non-Netscape browsers */
if (UA.indexOf('compatible')>0){
    isNS = false;
}

/* platform */
var thePlatform = navigator.platform.toLowerCase();
var isMAC = (UA.indexOf('mac') >= 0) ? true : false;
var isWIN = (UA.indexOf('win') >= 0) ? true : false;

/* Most UNIX users use X-Windows so this detects UNIX most of the time.*/
var isUNIX = (UA.indexOf('x11') >= 0) ? true : false;

/* browser version */
var version = navigator.appVersion;
var isMajor = parseInt( version );
/* Internet Explorer version 5 on the Mac reports itself as version 4. 
This code corrects the problem. */
if(isIE && isMAC) {
    if(UA.indexOf("msie 5")) {
        isMajor = 5;
        var stringLoc = UA.indexOf("msie 5");
        version = UA.substring(stringLoc + 5, stringLoc + 8);
    }
}
/* Internet Explorer version 6 on Windows reports itself as version 4. 
This code corrects the problem. */
if(isIE && isWIN) {
    if(UA.indexOf("msie 6")) {
        isMajor = 6;
        var stringLoc = UA.indexOf("msie 6");
        version = UA.substring(stringLoc + 5, stringLoc + 8);
    }
    if(UA.indexOf("msie 5.5")) {
        isMajor = 5;
        var stringLoc = UA.indexOf("msie 5.5");
        version = UA.substring(stringLoc + 5, stringLoc + 8);
    }
}
/* Netscape 6 reports itself as version 5 on all platforms.
   This code corrects the problem. */
if(isNS && isMajor>4) {
    if(UA.indexOf("netscape6")) {
        isMajor = 6;
        var stringLoc = UA.indexOf("netscape6");
        version = UA.substring(stringLoc + 10, stringLoc + 14);
    }
}
var isMinor = parseFloat( version );

/* a function to report browser info */
function getBrowserInfo(){
    var temp="<p>";
    temp += "User Agent: " + UA + "<br>";
    temp += "Platform: " + thePlatform + "<br>";
    temp += "Macintosh: " + isMAC + "<br>";
    temp += "Windows: " + isWIN + "<br>";
    temp += "Application: " + theApp + "<br>";
    temp += "Version: " + version + "<br>";
    temp += "Netscape: " + isNS + "<br>";
    temp += "Internet Explorer: " + isIE + "<br>";
    temp += "Major Version: " + isMajor + "<br>";
    temp += "Full Version: " + isMinor + "<br>";
    temp += "<br>";
    
    if (theDOM1){
		temp += "You appear to have a modern browser.<br>";
            temp += "Netscape 6, IE 6, or IE5Mac are recommended.";
    }
    else{
        temp += "Alert! Your browser is obsolete.<br>";
        temp += "You may enjoy the Web more if you upgrade.";        
    }
    temp +="<\/p>";
    return temp;
}
/* End of browser detection code */
