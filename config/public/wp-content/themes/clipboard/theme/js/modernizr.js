window.Modernizr=function(e,t,n){function i(e){b.cssText=e}function r(e,t){return i(k.join(e+";")+(t||""))}function a(e,t){return typeof e===t}function o(e,t){return!!~(""+e).indexOf(t)}function s(e,t){for(var i in e){var r=e[i];if(!o(r,"-")&&b[r]!==n)return"pfx"==t?r:!0}return!1}function l(e,t,i){for(var r in e){var o=t[e[r]];if(o!==n)return i===!1?e[r]:a(o,"function")?o.bind(i||t):o}return!1}function c(e,t,n){var i=e.charAt(0).toUpperCase()+e.slice(1),r=(e+" "+$.join(i+" ")+i).split(" ");return a(t,"string")||a(t,"undefined")?s(r,t):(r=(e+" "+S.join(i+" ")+i).split(" "),l(r,t,n))}function u(){f.input=function(n){for(var i=0,r=n.length;r>i;i++)D[n[i]]=!!(n[i]in w);return D.list&&(D.list=!(!t.createElement("datalist")||!e.HTMLDataListElement)),D}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),f.inputtypes=function(e){for(var i,r,a,o=0,s=e.length;s>o;o++)w.setAttribute("type",r=e[o]),i="text"!==w.type,i&&(w.value=x,w.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(r)&&w.style.WebkitAppearance!==n?(g.appendChild(w),a=t.defaultView,i=a.getComputedStyle&&"textfield"!==a.getComputedStyle(w,null).WebkitAppearance&&0!==w.offsetHeight,g.removeChild(w)):/^(search|tel)$/.test(r)||(i=/^(url|email)$/.test(r)?w.checkValidity&&w.checkValidity()===!1:w.value!=x)),A[e[o]]=!!i;return A}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var d,h,p="2.6.1",f={},m=!0,g=t.documentElement,v="modernizr",y=t.createElement(v),b=y.style,w=t.createElement("input"),x=":)",_={}.toString,k=" -webkit- -moz- -o- -ms- ".split(" "),C="Webkit Moz O ms",$=C.split(" "),S=C.toLowerCase().split(" "),T={svg:"http://www.w3.org/2000/svg"},E={},A={},D={},P=[],I=P.slice,M=function(e,n,i,r){var a,o,s,l=t.createElement("div"),c=t.body,u=c?c:t.createElement("body");if(parseInt(i,10))for(;i--;)s=t.createElement("div"),s.id=r?r[i]:v+(i+1),l.appendChild(s);return a=["&#173;",'<style id="s',v,'">',e,"</style>"].join(""),l.id=v,(c?l:u).innerHTML+=a,u.appendChild(l),c||(u.style.background="",g.appendChild(u)),o=n(l,e),c?l.parentNode.removeChild(l):u.parentNode.removeChild(u),!!o},N=function(t){var n=e.matchMedia||e.msMatchMedia;if(n)return n(t).matches;var i;return M("@media "+t+" { #"+v+" { position: absolute; } }",function(t){i="absolute"==(e.getComputedStyle?getComputedStyle(t,null):t.currentStyle).position}),i},j=function(){function e(e,r){r=r||t.createElement(i[e]||"div"),e="on"+e;var o=e in r;return o||(r.setAttribute||(r=t.createElement("div")),r.setAttribute&&r.removeAttribute&&(r.setAttribute(e,""),o=a(r[e],"function"),a(r[e],"undefined")||(r[e]=n),r.removeAttribute(e))),r=null,o}var i={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return e}(),O={}.hasOwnProperty;h=a(O,"undefined")||a(O.call,"undefined")?function(e,t){return t in e&&a(e.constructor.prototype[t],"undefined")}:function(e,t){return O.call(e,t)},Function.prototype.bind||(Function.prototype.bind=function(e){var t=this;if("function"!=typeof t)throw new TypeError;var n=I.call(arguments,1),i=function(){if(this instanceof i){var r=function(){};r.prototype=t.prototype;var a=new r,o=t.apply(a,n.concat(I.call(arguments)));return Object(o)===o?o:a}return t.apply(e,n.concat(I.call(arguments)))};return i}),E.flexbox=function(){return c("flexWrap")},E.flexboxlegacy=function(){return c("boxDirection")},E.canvas=function(){var e=t.createElement("canvas");return!(!e.getContext||!e.getContext("2d"))},E.canvastext=function(){return!(!f.canvas||!a(t.createElement("canvas").getContext("2d").fillText,"function"))},E.webgl=function(){return!!e.WebGLRenderingContext},E.touch=function(){var n;return"ontouchstart"in e||e.DocumentTouch&&t instanceof DocumentTouch?n=!0:M(["@media (",k.join("touch-enabled),("),v,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(e){n=9===e.offsetTop}),n},E.geolocation=function(){return"geolocation"in navigator},E.postmessage=function(){return!!e.postMessage},E.websqldatabase=function(){return!!e.openDatabase},E.indexedDB=function(){return!!c("indexedDB",e)},E.hashchange=function(){return j("hashchange",e)&&(t.documentMode===n||t.documentMode>7)},E.history=function(){return!(!e.history||!history.pushState)},E.draganddrop=function(){var e=t.createElement("div");return"draggable"in e||"ondragstart"in e&&"ondrop"in e},E.websockets=function(){return"WebSocket"in e||"MozWebSocket"in e},E.rgba=function(){return i("background-color:rgba(150,255,150,.5)"),o(b.backgroundColor,"rgba")},E.hsla=function(){return i("background-color:hsla(120,40%,100%,.5)"),o(b.backgroundColor,"rgba")||o(b.backgroundColor,"hsla")},E.multiplebgs=function(){return i("background:url(https://),url(https://),red url(https://)"),/(url\s*\(.*?){3}/.test(b.background)},E.backgroundsize=function(){return c("backgroundSize")},E.borderimage=function(){return c("borderImage")},E.borderradius=function(){return c("borderRadius")},E.boxshadow=function(){return c("boxShadow")},E.textshadow=function(){return""===t.createElement("div").style.textShadow},E.opacity=function(){return r("opacity:.55"),/^0.55$/.test(b.opacity)},E.cssanimations=function(){return c("animationName")},E.csscolumns=function(){return c("columnCount")},E.cssgradients=function(){var e="background-image:",t="gradient(linear,left top,right bottom,from(#9f9),to(white));",n="linear-gradient(left top,#9f9, white);";return i((e+"-webkit- ".split(" ").join(t+e)+k.join(n+e)).slice(0,-e.length)),o(b.backgroundImage,"gradient")},E.cssreflections=function(){return c("boxReflect")},E.csstransforms=function(){return!!c("transform")},E.csstransforms3d=function(){var e=!!c("perspective");return e&&"webkitPerspective"in g.style&&M("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(t){e=9===t.offsetLeft&&3===t.offsetHeight}),e},E.csstransitions=function(){return c("transition")},E.fontface=function(){var e;return M('@font-face {font-family:"font";src:url("https://")}',function(n,i){var r=t.getElementById("smodernizr"),a=r.sheet||r.styleSheet,o=a?a.cssRules&&a.cssRules[0]?a.cssRules[0].cssText:a.cssText||"":"";e=/src/i.test(o)&&0===o.indexOf(i.split(" ")[0])}),e},E.generatedcontent=function(){var e;return M(['#modernizr:after{content:"',x,'";visibility:hidden}'].join(""),function(t){e=t.offsetHeight>=1}),e},E.video=function(){var e=t.createElement("video"),n=!1;try{(n=!!e.canPlayType)&&(n=new Boolean(n),n.ogg=e.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),n.h264=e.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),n.webm=e.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,""))}catch(i){}return n},E.audio=function(){var e=t.createElement("audio"),n=!1;try{(n=!!e.canPlayType)&&(n=new Boolean(n),n.ogg=e.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),n.mp3=e.canPlayType("audio/mpeg;").replace(/^no$/,""),n.wav=e.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),n.m4a=(e.canPlayType("audio/x-m4a;")||e.canPlayType("audio/aac;")).replace(/^no$/,""))}catch(i){}return n},E.localstorage=function(){try{return localStorage.setItem(v,v),localStorage.removeItem(v),!0}catch(e){return!1}},E.sessionstorage=function(){try{return sessionStorage.setItem(v,v),sessionStorage.removeItem(v),!0}catch(e){return!1}},E.webworkers=function(){return!!e.Worker},E.applicationcache=function(){return!!e.applicationCache},E.svg=function(){return!!t.createElementNS&&!!t.createElementNS(T.svg,"svg").createSVGRect},E.inlinesvg=function(){var e=t.createElement("div");return e.innerHTML="<svg/>",(e.firstChild&&e.firstChild.namespaceURI)==T.svg},E.smil=function(){return!!t.createElementNS&&/SVGAnimate/.test(_.call(t.createElementNS(T.svg,"animate")))},E.svgclippaths=function(){return!!t.createElementNS&&/SVGClipPath/.test(_.call(t.createElementNS(T.svg,"clipPath")))};for(var L in E)h(E,L)&&(d=L.toLowerCase(),f[d]=E[L](),P.push((f[d]?"":"no-")+d));return f.input||u(),f.addTest=function(e,t){if("object"==typeof e)for(var i in e)h(e,i)&&f.addTest(i,e[i]);else{if(e=e.toLowerCase(),f[e]!==n)return f;t="function"==typeof t?t():t,m&&(g.className+=" "+(t?"":"no-")+e),f[e]=t}return f},i(""),y=w=null,function(e,t){function n(e,t){var n=e.createElement("p"),i=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",i.insertBefore(n.lastChild,i.firstChild)}function i(){var e=v.elements;return"string"==typeof e?e.split(" "):e}function r(e){var t=g[e[f]];return t||(t={},m++,e[f]=m,g[m]=t),t}function a(e,n,i){if(n||(n=t),u)return n.createElement(e);i||(i=r(n));var a;return a=i.cache[e]?i.cache[e].cloneNode():p.test(e)?(i.cache[e]=i.createElem(e)).cloneNode():i.createElem(e),a.canHaveChildren&&!h.test(e)?i.frag.appendChild(a):a}function o(e,n){if(e||(e=t),u)return e.createDocumentFragment();n=n||r(e);for(var a=n.frag.cloneNode(),o=0,s=i(),l=s.length;l>o;o++)a.createElement(s[o]);return a}function s(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return v.shivMethods?a(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+i().join().replace(/\w+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'})+");return n}")(v,t.frag)}function l(e){e||(e=t);var i=r(e);return!v.shivCSS||c||i.hasCSS||(i.hasCSS=!!n(e,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),u||s(e,i),e}var c,u,d=e.html5||{},h=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,p=/^<|^(?:a|b|button|code|div|fieldset|form|h1|h2|h3|h4|h5|h6|i|iframe|img|input|label|li|link|ol|option|p|param|q|script|select|span|strong|style|table|tbody|td|textarea|tfoot|th|thead|tr|ul)$/i,f="_html5shiv",m=0,g={};!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",c="hidden"in e,u=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return"undefined"==typeof e.cloneNode||"undefined"==typeof e.createDocumentFragment||"undefined"==typeof e.createElement}()}catch(n){c=!0,u=!0}}();var v={elements:d.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:d.shivCSS!==!1,supportsUnknownElements:u,shivMethods:d.shivMethods!==!1,type:"default",shivDocument:l,createElement:a,createDocumentFragment:o};e.html5=v,l(t)}(this,t),f._version=p,f._prefixes=k,f._domPrefixes=S,f._cssomPrefixes=$,f.mq=N,f.hasEvent=j,f.testProp=function(e){return s([e])},f.testAllProps=c,f.testStyles=M,f.prefixed=function(e,t,n){return t?c(e,t,n):c(e,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(m?" js "+P.join(" "):""),f}(this,this.document);