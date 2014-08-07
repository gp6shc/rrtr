
// vars
var current_page = document.URL; 
var sourceConfirm = current_page.indexOf("?utm_source=google");
var phone_num="844-439-7663"; 

// google
if (sourceConfirm != -1) { 
	document.cookie = "_phone-track-utm=GA"; 
} else { }

var cookieCheck=document.cookie.indexOf("_phone-track-utm=GA");
if (cookieCheck != -1) { 
	phone_num="1-800-GOOGLE"; 
	getElementById("num").href=phone_num; 
} else { }

// facebook
var sourceConfirm = current_page.indexOf("?utm_source=facebook");
if (sourceConfirm != -1) { 
	document.cookie = "_phone-track-utm=FB"; 
} else { }

var cookieCheck=document.cookie.indexOf("_phone-track-utm=FB");
if (cookieCheck != -1) { 
	phone_num="1-800-FACEBOOK"; 
	getElementById("num").href=phone_num; 
} else { }

// outbrain
var sourceConfirm = current_page.indexOf("?utm_source=outbrain");
if (sourceConfirm != -1) { 
	document.cookie = "_phone-track-utm=OB"; 
} else { }

var cookieCheck=document.cookie.indexOf("_phone-track-utm=OB");
if (cookieCheck != -1) { 
	phone_num="1-800-OUTBRAIN"; 
	getElementById("num").href=phone_num; 
} else { }




// show variable as tel:link
document.write('<a href="tel:'+phone_num+'">'+phone_num+'</a>');



//original 1 condition w/ cookie session storage 
var current_page = document.URL; 
var sourceConfirm = current_page.indexOf("?utm_source=facebook");
var phone_num="844-439-7663"; 

if (sourceConfirm != -1) { document.cookie = "Track this Source"; } else { }

var cookieCheck=document.cookie.indexOf("Track this Source");
if (cookieCheck != -1) { phone_num="1-800-FACEBOOK"; } else { }


