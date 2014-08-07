// PHONE TRACKING SCRIPT
var current_page = document.URL; 
var sourceConfirm = current_page.indexOf("?utm_source=google&utm_medium=cpc");
var phone_num="844-439-7663"; 

// google
if (sourceConfirm != -1) { 
	document.cookie = "_phone-track-utm=GA"; 
} else { }

var cookieCheck=document.cookie.indexOf("_phone-track-utm=GA");
if (cookieCheck != -1) { 
	phone_num="844-575-7663"; 
} else { }

// facebook
var sourceConfirm = current_page.indexOf("?utm_source=facebook");
if (sourceConfirm != -1) { 
	document.cookie = "_phone-track-utm=FB"; 
} else { }

var cookieCheck=document.cookie.indexOf("_phone-track-utm=FB");
if (cookieCheck != -1) { 
	phone_num="844-987-7663"; 
} else { }

// outbrain
var sourceConfirm = current_page.indexOf("?utm_source=outbrain");
if (sourceConfirm != -1) { 
	document.cookie = "_phone-track-utm=OB"; 
} else { }

var cookieCheck=document.cookie.indexOf("_phone-track-utm=OB");
if (cookieCheck != -1) { 
	phone_num="844-567-7663"; 
} else { }