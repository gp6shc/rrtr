function JBWeather(e){var e="."+e,t={params:null,tries:3};this.init=function(e){t.params=e,i.setColor(),i.adjustSize(),i.show(),a.bindControls(),n.autoComplete(),n.gatherData()};var a={bindControls:function(){jQuery(e+" .jbww_head_search a").on("click",function(e){i.searchBar.show(),e.stopPropagation(),e.preventDefault()}),jQuery(".jbmww_wrapper").on("click",function(e){i.searchBar.hide(),e.stopPropagation()}),jQuery(e+" .jbww_search_bar").on("click",function(e){e.stopPropagation()}),jQuery(e+" .jbww_search_bar input").on("keydown",function(e){if(13==e.which){var a=jQuery(this).val();""!=a&&(t.params.location=a,n.gatherData(),i.searchBar.hide()),e.stopPropagation()}}),jQuery(e+" .jbww_search_bar a.searchButton").on("click",function(e){var a=jQuery(this).parent().find("input").val();""!=a&&(t.params.location=a,n.gatherData(),i.searchBar.hide()),e.stopPropagation()})}},n={gatherData:function(){var e="location="+t.params.location;e+="&apiKey="+t.params.apiKey,e+="&curl="+t.params.curl,jQuery.ajax({async:!0,type:"POST",url:t.params.url+"/xml/xml.php",data:e,error:function(e,a,r){console.log(r),t.tries<=0?i.notFound():(t.tries--,setTimeout(function(){n.gatherData()},3e3))},success:function(e){if(!jQuery(e).find("location").text())return void i.notFound();var t,a;t={location:jQuery(e).find("location").text(),date:jQuery(e).find("current date").text(),time:jQuery(e).find("current time").text(),temperature:{c:jQuery(e).find("current temperature c").text(),f:jQuery(e).find("current temperature f").text()},code:jQuery(e).find("current code").text(),description:jQuery(e).find("current description").text(),wind:{speed:{m:jQuery(e).find("current wind windSpeed m").text(),k:jQuery(e).find("current wind windSpeed k").text()},direction:jQuery(e).find("current wind direction").text()}},a={},a.day=[],jQuery(e).find("day").each(function(e){a.day[e]={date:jQuery(this).find("date").text(),time:jQuery(this).find("time").text(),temperature:{max:{c:jQuery(this).find("temperature max c").text(),f:jQuery(this).find("temperature max f").text()},min:{c:jQuery(this).find("temperature min c").text(),f:jQuery(this).find("temperature min f").text()}},code:jQuery(this).find("code").text(),description:jQuery(this).find("description").text(),wind:{speed:{m:jQuery(this).find("wind windSpeed m").text(),k:jQuery(this).find("wind windSpeed k").text()},direction:jQuery(this).find("wind direction").text()}}}),i.data(t,a)},dataType:"xml"})},autoComplete:function(){return;jQuery(".jbww_search_bar input").autocomplete({appendTo:".jbww_search_bar",source:function(e,t){jQuery.ajax({url:"http://api.geonames.org/search",dataType:"jsonp",data:{username:"",type:"json",featureClass:"P",style:"full",maxRows:5,q:e.term},success:function(e){t(jQuery.map(e.geonames,function(e){return{label:e.name+", "+e.countryName}}))}})},minLength:3,select:function(e,a){var r=a.item.value;""!=r&&(t.params.location=r,n.gatherData(),i.searchBar.hide())},open:function(){},close:function(){}})}},i={show:function(){jQuery(e+" .jbmww_wrapper").show()},setColor:function(){""!=t.params.basicColor&&(jQuery(e+" .jbww_head").css({backgroundColor:t.params.basicColor}),jQuery(e+" .jbmww_wrapper .jbww_search_bar a.searchButton").css({backgroundColor:t.params.basicColor}))},adjustSize:function(){parseInt(t.params.width,10)<280&&(t.params.width=280),jQuery(e+" .jbmww_wrapper").width(t.params.width),jQuery(e+" .jbww_head").width(t.params.width),jQuery(e+" .jbww_head_top").width(t.params.width),jQuery(e+" .jbww_head_today_forecast").width(t.params.width-45),jQuery(e+" .jbww_weekly_forecast_icon").css({marginLeft:t.params.width/2-jQuery(e+" .jbww_weekly_forecast_date").width()-jQuery(e+" .jbww_weekly_forecast_icon").width()/2})},data:function(a,n){jQuery(e+" .jbww_head_location p").text(a.location),jQuery(e+" .jbww_head_location span").text(a.date),jQuery(e+" .jbww_head_today_forecast_digit p").text("C"==t.params.degreesUnits?a.temperature.c+"°":a.temperature.f+"°"),jQuery(e+" .jbww_head_today_wind_speed p").text("M"==t.params.windUnits?a.wind.speed.m+" MPH":a.wind.speed.k+" KMH"),jQuery(e+" .jbww_head_today_wind_direction p").text(r.windDirection(a.wind.direction)),jQuery(e+" .jbww_head_today_forecast_icon > div").attr("class",r.codeToClass(a.code)),jQuery(e+" .jbww_weekly_forecast_day").each(function(e){jQuery(this).find(".jbww_weekly_forecast_date").text(n.day[e].date),jQuery(this).find(".jbww_weekly_forecast_deg").text("C"==t.params.degreesUnits?n.day[e].temperature.min.c+"°C / "+n.day[e].temperature.max.c+"°C":n.day[e].temperature.min.f+"°F / "+n.day[e].temperature.max.f+"°F"),jQuery(this).find(".jbww_weekly_forecast_icon > div").attr("class",r.codeToClass(n.day[e].code))})},searchBar:{show:function(){jQuery(e+" .jbww_search_bar").fadeIn(150)},hide:function(){jQuery(e+" .jbww_search_bar").fadeOut(150)}},notFound:function(){jQuery(e+" .jbww_head_location p").text("Unable to find location"),jQuery(e+" .jbww_head_location span").text("N/A"),jQuery(e+" .jbww_head_today_forecast_digit p").text(""),jQuery(e+" .jbww_head_today_wind_speed p").text("N/A"),jQuery(e+" .jbww_head_today_wind_direction p").text("N/A"),jQuery(e+" .jbww_head_today_forecast_icon > div").attr("class","n-a"),jQuery(e+" .jbww_weekly_forecast_day").each(function(e){jQuery(this).find(".jbww_weekly_forecast_date").text("N/A"),jQuery(this).find(".jbww_weekly_forecast_deg").text("N/A"),jQuery(this).find(".jbww_weekly_forecast_icon > div").attr("class","n-a")})}},r={windDirection:function(e){switch(e){case"N":return"North";break;case"NNE":return"North-East";break;case"NE":return"North-East";break;case"ENE":return"North-East";break;case"E":return"East";break;case"ESE":return"South-East";break;case"SE":return"South-East";break;case"SSE":return"South-East";break;case"S":return"South";break;case"SSW":return"South-West";break;case"SW":return"South-West";break;case"WSW":return"South-West";break;case"W":return"West";break;case"WNW":return"North-West";break;case"NW":return"North-West";break;case"NNW":return"North-West"}},codeToClass:function(e){switch(parseInt(e,10)){case 113:return"sunny";break;case 116:return"partlycloudy";break;case 119:return"cloudy";break;case 122:return"cloudy";break;case 143:return"fog";break;case 176:return"rainy";break;case 179:return"snowly";break;case 182:return"snowly";break;case 185:return"snowly";break;case 200:return"thunder";break;case 227:return"snowly";break;case 230:return"snowly";break;case 248:return"fog";break;case 260:return"fog";break;case 263:return"cloudy";break;case 266:return"rainy";break;case 281:return"sleet";break;case 284:return"sleet";break;case 293:return"rainy";break;case 296:return"rainy";break;case 299:return"rainy";break;case 302:return"rainy";break;case 305:return"rainy";break;case 308:return"rainy";break;case 311:return"rainy";break;case 314:return"rainy";break;case 317:return"sleet";break;case 320:return"sleet";break;case 323:return"snowly";break;case 326:return"snowly";break;case 329:return"snowly";break;case 332:return"snowly";break;case 335:return"snowly";break;case 338:return"snowly";break;case 350:return"snowly";break;case 353:return"rainy";break;case 356:return"rainy";break;case 359:return"rainy";break;case 362:return"sleet";break;case 365:return"sleet";break;case 368:return"sleet";break;case 371:return"snowly";break;case 374:return"snowly";break;case 377:return"snowly";break;case 386:return"thunder";break;case 389:return"thunder";break;case 392:return"thunder";break;case 395:return"snowly"}}}}!function(){var e,t,a;if(e=document.getElementById("site-navigation"),e&&(t=e.getElementsByTagName("h1")[0],"undefined"!=typeof t)){if(a=e.getElementsByTagName("ul")[0],"undefined"==typeof a)return void(t.style.display="none");-1===a.className.indexOf("nav-menu")&&(a.className+="nav-menu"),t.onclick=function(){e.className=-1!==e.className.indexOf("main-small-navigation")?e.className.replace("main-small-navigation","main-navigation"):e.className.replace("main-navigation","main-small-navigation")}}}(),function(e){e.flexslider=function(t,a){var n=e(t),i=e.extend({},e.flexslider.defaults,a),r=i.namespace,o="ontouchstart"in window||window.DocumentTouch&&document instanceof DocumentTouch,s=o?"touchend":"click",c="vertical"===i.direction,l=i.reverse,u=i.itemWidth>0,d="fade"===i.animation,p=""!==i.asNavFor,m={};e.data(t,"flexslider",n),m={init:function(){n.animating=!1,n.currentSlide=i.startAt,n.animatingTo=n.currentSlide,n.atEnd=0===n.currentSlide||n.currentSlide===n.last,n.containerSelector=i.selector.substr(0,i.selector.search(" ")),n.slides=e(i.selector,n),n.container=e(n.containerSelector,n),n.count=n.slides.length,n.syncExists=e(i.sync).length>0,"slide"===i.animation&&(i.animation="swing"),n.prop=c?"top":"marginLeft",n.args={},n.manualPause=!1,n.transitions=!i.video&&!d&&i.useCSS&&function(){var e=document.createElement("div"),t=["perspectiveProperty","WebkitPerspective","MozPerspective","OPerspective","msPerspective"];for(var a in t)if(void 0!==e.style[t[a]])return n.pfx=t[a].replace("Perspective","").toLowerCase(),n.prop="-"+n.pfx+"-transform",!0;return!1}(),""!==i.controlsContainer&&(n.controlsContainer=e(i.controlsContainer).length>0&&e(i.controlsContainer)),""!==i.manualControls&&(n.manualControls=e(i.manualControls).length>0&&e(i.manualControls)),i.randomize&&(n.slides.sort(function(){return Math.round(Math.random())-.5}),n.container.empty().append(n.slides)),n.doMath(),p&&m.asNav.setup(),n.setup("init"),i.controlNav&&m.controlNav.setup(),i.directionNav&&m.directionNav.setup(),i.keyboard&&(1===e(n.containerSelector).length||i.multipleKeyboard)&&e(document).bind("keyup",function(e){var t=e.keyCode;if(!n.animating&&(39===t||37===t)){var a=39===t?n.getTarget("next"):37===t?n.getTarget("prev"):!1;n.flexAnimate(a,i.pauseOnAction)}}),i.mousewheel&&n.bind("mousewheel",function(e,t,a,r){e.preventDefault();var o=n.getTarget(0>t?"next":"prev");n.flexAnimate(o,i.pauseOnAction)}),i.pausePlay&&m.pausePlay.setup(),i.slideshow&&(i.pauseOnHover&&n.hover(function(){n.manualPlay||n.manualPause||n.pause()},function(){n.manualPause||n.manualPlay||n.play()}),i.initDelay>0?setTimeout(n.play,i.initDelay):n.play()),o&&i.touch&&m.touch(),(!d||d&&i.smoothHeight)&&e(window).bind("resize focus",m.resize),setTimeout(function(){i.start(n)},200)},asNav:{setup:function(){n.asNav=!0,n.animatingTo=Math.floor(n.currentSlide/n.move),n.currentItem=n.currentSlide,n.slides.removeClass(r+"active-slide").eq(n.currentItem).addClass(r+"active-slide"),n.slides.click(function(t){t.preventDefault();var a=e(this),r=a.index();e(i.asNavFor).data("flexslider").animating||a.hasClass("active")||(n.direction=n.currentItem<r?"next":"prev",n.flexAnimate(r,i.pauseOnAction,!1,!0,!0))})}},controlNav:{setup:function(){n.manualControls?m.controlNav.setupManual():m.controlNav.setupPaging()},setupPaging:function(){var t="thumbnails"===i.controlNav?"control-thumbs":"control-paging",a=1,c;if(n.controlNavScaffold=e('<ol class="'+r+"control-nav "+r+t+'"></ol>'),n.pagingCount>1)for(var l=0;l<n.pagingCount;l++)c="thumbnails"===i.controlNav?'<img src="'+n.slides.eq(l).attr("data-thumb")+'"/>':"<a>"+a+"</a>",n.controlNavScaffold.append("<li>"+c+"</li>"),a++;n.controlsContainer?e(n.controlsContainer).append(n.controlNavScaffold):n.append(n.controlNavScaffold),m.controlNav.set(),m.controlNav.active(),n.controlNavScaffold.delegate("a, img",s,function(t){t.preventDefault();var a=e(this),o=n.controlNav.index(a);a.hasClass(r+"active")||(n.direction=o>n.currentSlide?"next":"prev",n.flexAnimate(o,i.pauseOnAction))}),o&&n.controlNavScaffold.delegate("a","click touchstart",function(e){e.preventDefault()})},setupManual:function(){n.controlNav=n.manualControls,m.controlNav.active(),n.controlNav.live(s,function(t){t.preventDefault();var a=e(this),o=n.controlNav.index(a);a.hasClass(r+"active")||(n.direction=o>n.currentSlide?"next":"prev",n.flexAnimate(o,i.pauseOnAction))}),o&&n.controlNav.live("click touchstart",function(e){e.preventDefault()})},set:function(){var t="thumbnails"===i.controlNav?"img":"a";n.controlNav=e("."+r+"control-nav li "+t,n.controlsContainer?n.controlsContainer:n)},active:function(){n.controlNav.removeClass(r+"active").eq(n.animatingTo).addClass(r+"active")},update:function(t,a){n.pagingCount>1&&"add"===t?n.controlNavScaffold.append(e("<li><a>"+n.count+"</a></li>")):1===n.pagingCount?n.controlNavScaffold.find("li").remove():n.controlNav.eq(a).closest("li").remove(),m.controlNav.set(),n.pagingCount>1&&n.pagingCount!==n.controlNav.length?n.update(a,t):m.controlNav.active()}},directionNav:{setup:function(){var t=e('<ul class="'+r+'direction-nav"><li><a class="'+r+'prev" href="#">'+i.prevText+'</a></li><li><a class="'+r+'next" href="#">'+i.nextText+"</a></li></ul>");n.controlsContainer?(e(n.controlsContainer).append(t),n.directionNav=e("."+r+"direction-nav li a",n.controlsContainer)):(n.append(t),n.directionNav=e("."+r+"direction-nav li a",n)),m.directionNav.update(),n.directionNav.bind(s,function(t){t.preventDefault();var a=n.getTarget(e(this).hasClass(r+"next")?"next":"prev");n.flexAnimate(a,i.pauseOnAction)}),o&&n.directionNav.bind("click touchstart",function(e){e.preventDefault()})},update:function(){var e=r+"disabled";1===n.pagingCount?n.directionNav.addClass(e):i.animationLoop?n.directionNav.removeClass(e):0===n.animatingTo?n.directionNav.removeClass(e).filter("."+r+"prev").addClass(e):n.animatingTo===n.last?n.directionNav.removeClass(e).filter("."+r+"next").addClass(e):n.directionNav.removeClass(e)}},pausePlay:{setup:function(){var t=e('<div class="'+r+'pauseplay"><a></a></div>');n.controlsContainer?(n.controlsContainer.append(t),n.pausePlay=e("."+r+"pauseplay a",n.controlsContainer)):(n.append(t),n.pausePlay=e("."+r+"pauseplay a",n)),m.pausePlay.update(i.slideshow?r+"pause":r+"play"),n.pausePlay.bind(s,function(t){t.preventDefault(),e(this).hasClass(r+"pause")?(n.manualPause=!0,n.manualPlay=!1,n.pause()):(n.manualPause=!1,n.manualPlay=!0,n.play())}),o&&n.pausePlay.bind("click touchstart",function(e){e.preventDefault()})},update:function(e){"play"===e?n.pausePlay.removeClass(r+"pause").addClass(r+"play").text(i.playText):n.pausePlay.removeClass(r+"play").addClass(r+"pause").text(i.pauseText)}},touch:function(){function e(e){n.animating?e.preventDefault():1===e.touches.length&&(n.pause(),m=c?n.h:n.w,h=Number(new Date),p=u&&l&&n.animatingTo===n.last?0:u&&l?n.limit-(n.itemW+i.itemMargin)*n.move*n.animatingTo:u&&n.currentSlide===n.last?n.limit:u?(n.itemW+i.itemMargin)*n.move*n.currentSlide:l?(n.last-n.currentSlide+n.cloneOffset)*m:(n.currentSlide+n.cloneOffset)*m,o=c?e.touches[0].pageY:e.touches[0].pageX,s=c?e.touches[0].pageX:e.touches[0].pageY,t.addEventListener("touchmove",a,!1),t.addEventListener("touchend",r,!1))}function a(e){f=c?o-e.touches[0].pageY:o-e.touches[0].pageX,v=c?Math.abs(f)<Math.abs(e.touches[0].pageX-s):Math.abs(f)<Math.abs(e.touches[0].pageY-s),(!v||Number(new Date)-h>500)&&(e.preventDefault(),!d&&n.transitions&&(i.animationLoop||(f/=0===n.currentSlide&&0>f||n.currentSlide===n.last&&f>0?Math.abs(f)/m+2:1),n.setProps(p+f,"setTouch")))}function r(e){if(t.removeEventListener("touchmove",a,!1),n.animatingTo===n.currentSlide&&!v&&null!==f){var c=l?-f:f,u=n.getTarget(c>0?"next":"prev");n.canAdvance(u)&&(Number(new Date)-h<550&&Math.abs(c)>50||Math.abs(c)>m/2)?n.flexAnimate(u,i.pauseOnAction):d||n.flexAnimate(n.currentSlide,i.pauseOnAction,!0)}t.removeEventListener("touchend",r,!1),o=null,s=null,f=null,p=null}var o,s,p,m,f,h,v=!1;t.addEventListener("touchstart",e,!1)},resize:function(){!n.animating&&n.is(":visible")&&(u||n.doMath(),d?m.smoothHeight():u?(n.slides.width(n.computedW),n.update(n.pagingCount),n.setProps()):c?(n.viewport.height(n.h),n.setProps(n.h,"setTotal")):(i.smoothHeight&&m.smoothHeight(),n.newSlides.width(n.computedW),n.setProps(n.computedW,"setTotal")))},smoothHeight:function(e){if(!c||d){var t=d?n:n.viewport;e?t.animate({height:n.slides.eq(n.animatingTo).height()},e):t.height(n.slides.eq(n.animatingTo).height())}},sync:function(t){var a=e(i.sync).data("flexslider"),r=n.animatingTo;switch(t){case"animate":a.flexAnimate(r,i.pauseOnAction,!1,!0);break;case"play":a.playing||a.asNav||a.play();break;case"pause":a.pause()}}},n.flexAnimate=function(t,a,s,f,h){if(p&&1===n.pagingCount&&(n.direction=n.currentItem<t?"next":"prev"),!n.animating&&(n.canAdvance(t,h)||s)&&n.is(":visible")){if(p&&f){var v=e(i.asNavFor).data("flexslider");if(n.atEnd=0===t||t===n.count-1,v.flexAnimate(t,!0,!1,!0,h),n.direction=n.currentItem<t?"next":"prev",v.direction=n.direction,Math.ceil((t+1)/n.visible)-1===n.currentSlide||0===t)return n.currentItem=t,n.slides.removeClass(r+"active-slide").eq(t).addClass(r+"active-slide"),!1;n.currentItem=t,n.slides.removeClass(r+"active-slide").eq(t).addClass(r+"active-slide"),t=Math.floor(t/n.visible)}if(n.animating=!0,n.animatingTo=t,i.before(n),a&&n.pause(),n.syncExists&&!h&&m.sync("animate"),i.controlNav&&m.controlNav.active(),u||n.slides.removeClass(r+"active-slide").eq(t).addClass(r+"active-slide"),n.atEnd=0===t||t===n.last,i.directionNav&&m.directionNav.update(),t===n.last&&(i.end(n),i.animationLoop||n.pause()),d)o?(n.slides.eq(n.currentSlide).css({opacity:0,zIndex:1}),n.slides.eq(t).css({opacity:1,zIndex:2}),n.animating=!1,n.currentSlide=n.animatingTo):(n.slides.eq(n.currentSlide).fadeOut(i.animationSpeed,i.easing),n.slides.eq(t).fadeIn(i.animationSpeed,i.easing,n.wrapup));else{var y=c?n.slides.filter(":first").height():n.computedW,w,g,b;u?(w=i.itemWidth>n.w?2*i.itemMargin:i.itemMargin,b=(n.itemW+w)*n.move*n.animatingTo,g=b>n.limit&&1!==n.visible?n.limit:b):g=0===n.currentSlide&&t===n.count-1&&i.animationLoop&&"next"!==n.direction?l?(n.count+n.cloneOffset)*y:0:n.currentSlide===n.last&&0===t&&i.animationLoop&&"prev"!==n.direction?l?0:(n.count+1)*y:l?(n.count-1-t+n.cloneOffset)*y:(t+n.cloneOffset)*y,n.setProps(g,"",i.animationSpeed),n.transitions?(i.animationLoop&&n.atEnd||(n.animating=!1,n.currentSlide=n.animatingTo),n.container.unbind("webkitTransitionEnd transitionend"),n.container.bind("webkitTransitionEnd transitionend",function(){n.wrapup(y)})):n.container.animate(n.args,i.animationSpeed,i.easing,function(){n.wrapup(y)})}i.smoothHeight&&m.smoothHeight(i.animationSpeed)}},n.wrapup=function(e){d||u||(0===n.currentSlide&&n.animatingTo===n.last&&i.animationLoop?n.setProps(e,"jumpEnd"):n.currentSlide===n.last&&0===n.animatingTo&&i.animationLoop&&n.setProps(e,"jumpStart")),n.animating=!1,n.currentSlide=n.animatingTo,i.after(n)},n.animateSlides=function(){n.animating||n.flexAnimate(n.getTarget("next"))},n.pause=function(){clearInterval(n.animatedSlides),n.playing=!1,i.pausePlay&&m.pausePlay.update("play"),n.syncExists&&m.sync("pause")},n.play=function(){n.animatedSlides=setInterval(n.animateSlides,i.slideshowSpeed),n.playing=!0,i.pausePlay&&m.pausePlay.update("pause"),n.syncExists&&m.sync("play")},n.canAdvance=function(e,t){var a=p?n.pagingCount-1:n.last;return t?!0:p&&n.currentItem===n.count-1&&0===e&&"prev"===n.direction?!0:p&&0===n.currentItem&&e===n.pagingCount-1&&"next"!==n.direction?!1:e!==n.currentSlide||p?i.animationLoop?!0:n.atEnd&&0===n.currentSlide&&e===a&&"next"!==n.direction?!1:n.atEnd&&n.currentSlide===a&&0===e&&"next"===n.direction?!1:!0:!1},n.getTarget=function(e){return n.direction=e,"next"===e?n.currentSlide===n.last?0:n.currentSlide+1:0===n.currentSlide?n.last:n.currentSlide-1},n.setProps=function(e,t,a){var r=function(){var a=e?e:(n.itemW+i.itemMargin)*n.move*n.animatingTo,r=function(){if(u)return"setTouch"===t?e:l&&n.animatingTo===n.last?0:l?n.limit-(n.itemW+i.itemMargin)*n.move*n.animatingTo:n.animatingTo===n.last?n.limit:a;switch(t){case"setTotal":return l?(n.count-1-n.currentSlide+n.cloneOffset)*e:(n.currentSlide+n.cloneOffset)*e;case"setTouch":return l?e:e;case"jumpEnd":return l?e:n.count*e;case"jumpStart":return l?n.count*e:e;default:return e}}();return-1*r+"px"}();n.transitions&&(r=c?"translate3d(0,"+r+",0)":"translate3d("+r+",0,0)",a=void 0!==a?a/1e3+"s":"0s",n.container.css("-"+n.pfx+"-transition-duration",a)),n.args[n.prop]=r,(n.transitions||void 0===a)&&n.container.css(n.args)},n.setup=function(t){if(d)n.slides.css({width:"100%","float":"left",marginRight:"-100%",position:"relative"}),"init"===t&&(o?n.slides.css({opacity:0,display:"block",webkitTransition:"opacity "+i.animationSpeed/1e3+"s ease",zIndex:1}).eq(n.currentSlide).css({opacity:1,zIndex:2}):n.slides.eq(n.currentSlide).fadeIn(i.animationSpeed,i.easing)),i.smoothHeight&&m.smoothHeight();else{var a,s;"init"===t&&(n.viewport=e('<div class="'+r+'viewport"></div>').css({overflow:"hidden",position:"relative"}).appendTo(n).append(n.container),n.cloneCount=0,n.cloneOffset=0,l&&(s=e.makeArray(n.slides).reverse(),n.slides=e(s),n.container.empty().append(n.slides))),i.animationLoop&&!u&&(n.cloneCount=2,n.cloneOffset=1,"init"!==t&&n.container.find(".clone").remove(),n.container.append(n.slides.first().clone().addClass("clone")).prepend(n.slides.last().clone().addClass("clone"))),n.newSlides=e(i.selector,n),a=l?n.count-1-n.currentSlide+n.cloneOffset:n.currentSlide+n.cloneOffset,c&&!u?(n.container.height(200*(n.count+n.cloneCount)+"%").css("position","absolute").width("100%"),setTimeout(function(){n.newSlides.css({display:"block"}),n.doMath(),n.viewport.height(n.h),n.setProps(a*n.h,"init")},"init"===t?100:0)):(n.container.width(200*(n.count+n.cloneCount)+"%"),n.setProps(a*n.computedW,"init"),setTimeout(function(){n.doMath(),n.newSlides.css({width:n.computedW,"float":"left",display:"block"}),i.smoothHeight&&m.smoothHeight()},"init"===t?100:0))}u||n.slides.removeClass(r+"active-slide").eq(n.currentSlide).addClass(r+"active-slide")},n.doMath=function(){var e=n.slides.first(),t=i.itemMargin,a=i.minItems,r=i.maxItems;n.w=n.width(),n.h=e.height(),n.boxPadding=e.outerWidth()-e.width(),u?(n.itemT=i.itemWidth+t,n.minW=a?a*n.itemT:n.w,n.maxW=r?r*n.itemT:n.w,n.itemW=n.minW>n.w?(n.w-t*a)/a:n.maxW<n.w?(n.w-t*r)/r:i.itemWidth>n.w?n.w:i.itemWidth,n.visible=Math.floor(n.w/(n.itemW+t)),n.move=i.move>0&&i.move<n.visible?i.move:n.visible,n.pagingCount=Math.ceil((n.count-n.visible)/n.move+1),n.last=n.pagingCount-1,n.limit=1===n.pagingCount?0:i.itemWidth>n.w?(n.itemW+2*t)*n.count-n.w-t:(n.itemW+t)*n.count-n.w-t):(n.itemW=n.w,n.pagingCount=n.count,n.last=n.count-1),n.computedW=n.itemW-n.boxPadding},n.update=function(e,t){n.doMath(),u||(e<n.currentSlide?n.currentSlide+=1:e<=n.currentSlide&&0!==e&&(n.currentSlide-=1),n.animatingTo=n.currentSlide),i.controlNav&&!n.manualControls&&("add"===t&&!u||n.pagingCount>n.controlNav.length?m.controlNav.update("add"):("remove"===t&&!u||n.pagingCount<n.controlNav.length)&&(u&&n.currentSlide>n.last&&(n.currentSlide-=1,n.animatingTo-=1),m.controlNav.update("remove",n.last))),i.directionNav&&m.directionNav.update()},n.addSlide=function(t,a){var r=e(t);n.count+=1,n.last=n.count-1,c&&l?void 0!==a?n.slides.eq(n.count-a).after(r):n.container.prepend(r):void 0!==a?n.slides.eq(a).before(r):n.container.append(r),n.update(a,"add"),n.slides=e(i.selector+":not(.clone)",n),n.setup(),i.added(n)},n.removeSlide=function(t){var a=isNaN(t)?n.slides.index(e(t)):t;n.count-=1,n.last=n.count-1,isNaN(t)?e(t,n.slides).remove():c&&l?n.slides.eq(n.last).remove():n.slides.eq(t).remove(),n.doMath(),n.update(a,"remove"),n.slides=e(i.selector+":not(.clone)",n),n.setup(),i.removed(n)},m.init()},e.flexslider.defaults={namespace:"flex-",selector:".slides > li",animation:"fade",easing:"swing",direction:"horizontal",reverse:!1,animationLoop:!0,smoothHeight:!1,startAt:0,slideshow:!0,slideshowSpeed:7e3,animationSpeed:600,initDelay:0,randomize:!1,pauseOnAction:!0,pauseOnHover:!1,useCSS:!0,touch:!0,video:!1,controlNav:!0,directionNav:!0,prevText:"Previous",nextText:"Next",keyboard:!0,multipleKeyboard:!1,mousewheel:!1,pausePlay:!1,pauseText:"Pause",playText:"Play",controlsContainer:"",manualControls:"",sync:"",asNavFor:"",itemWidth:0,itemMargin:0,minItems:0,maxItems:0,move:0,start:function(){},before:function(){},after:function(){},end:function(){},added:function(){},removed:function(){}},e.fn.flexslider=function(t){if(void 0===t&&(t={}),"object"==typeof t)return this.each(function(){var a=e(this),n=t.selector?t.selector:".slides > li",i=a.find(n);1===i.length?(i.fadeIn(400),t.start&&t.start(a)):void 0===a.data("flexslider")&&new e.flexslider(this,t)});var a=e(this).data("flexslider");switch(t){case"play":a.play();break;case"pause":a.pause();break;case"next":a.flexAnimate(a.getTarget("next"),!0);break;case"prev":case"previous":a.flexAnimate(a.getTarget("prev"),!0);break;default:"number"==typeof t&&a.flexAnimate(t,!0)}}}(jQuery),jQuery(document).ready(function(e){e(".flexslider").flexslider({animation:"slide",start:function(t){e("#containerFlexDiv").height("auto"),e(".loading_rsSlider").hide()}})});