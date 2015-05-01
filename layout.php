<style>
ul.top_page_navigation {
	background: #F5F5F5;
	display: block;
	width: 100%;
	margin-left: 0px;
	border: 1px solid #DDD;
	border-radius: 10px;
	overflow: hidden;
}
ul.top_page_navigation li {
	float: left;
	list-style-type: none;
	display: block;
}
ul.top_page_navigation li a {
	padding: 10px 0px;
	border-right: 1px solid #DDD;
	color: #424242;
	display: block;
	text-align: center;
	overflow: hidden;
	white-space: nowrap;
}
ul.top_page_navigation li a:hover {
    background: #FFF;
    color: #424242;
	border-left: 1px solid #DDD;
	margin-left: -1px;
    text-decoration: none;
}
@media screen and (max-width: 900px) {
	ul.top_page_navigation li {
		width: 100%;
		display: block;
		float: none;
	}
	ul.top_page_navigation li a {
		border-right-width: 0px;
	}	
}
.progressbar {
	height: 5px;
	padding: 3px;
	margin-bottom: 25px;
	background: #DDD;
	border-radius: 50px;
	position: relative;
}
.progress {
	height: 5px;
	background: #95C93E;
	border-radius: 50px;
	transition: 0.3s;
}
.progressbar span {
	opacity: 0.0;
	position: absolute;
	top: -4px;
	color: #FFF;
	background: #95C93E;
	border-radius: 100px;
	padding: 2px 5px;
	text-align: center;
	transition: 0.5s;
	font-size: 10px;
}
.progressbar:hover .progress {
	height: 10px;
	margin: -3px 0px;
}
.progressbar:hover span {
	opacity: 1.0;
}

.bottom_page_navigation {
	text-align: center;
	position: relative;
	z-index: 100;
}
.bottom_page_navigation a {
	display: inline-block;
	text-decoration: none;
	font-size: 13px;
	line-height: 26px;
	height: 28px;
	margin: 0;
	padding: 0 10px 1px;
	cursor: pointer;
	border-width: 1px;
	border-style: solid;
	-webkit-appearance: none;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	white-space: nowrap;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	color: #555;
	border-color: #cccccc;
	background: #f7f7f7;
	-webkit-box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba( 0, 0, 0, 0.08 );
	box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba( 0, 0, 0, 0.08 );
	vertical-align: top;
	margin: 0px 5px;
}

.tabcontents{
	border-bottom: 1px solid #DDD;
	padding: 10px;
	position: relative;
	overflow: hidden;
	width: calc(100% - 20px);
}
.inner_tabcontent {
	padding-bottom: 25px;
}
.page_counter {
	right: -14px;
	opacity: 0.5;
	font-size: 55px;
	font-weight: bold;
	bottom: -18px;
	position: absolute;
	color: #DDD;
	text-shadow: 1px 1px 8px #F5F5F5;
}

.succesMSG {
	border: 1px solid #DDD;
	border-left: 3px solid green;
	padding: 10px;
	margin-bottom: 10px;
}
.errorMSG {
	border: 1px solid #DDD;
	border-left: 3px solid red;
	padding: 10px;
	margin-bottom: 10px;
}
</style>
<script>
/* http://www.menucool.com/tabbed-content Free to use. v2013.7.6 */
(function(){var g=function(a){if(a&&a.stopPropagation)a.stopPropagation();else window.event.cancelBubble=true;var b=a?a:window.event;b.preventDefault&&b.preventDefault()},d=function(a,c,b){if(a.addEventListener)a.addEventListener(c,b,false);else a.attachEvent&&a.attachEvent("on"+c,b)},a=function(c,a){var b=new RegExp("(^| )"+a+"( |$)");return b.test(c.className)?true:false},j=function(b,c,d){if(!a(b,c))if(b.className=="")b.className=c;else if(d)b.className=c+" "+b.className;else b.className+=" "+c},h=function(a,b){var c=new RegExp("(^| )"+b+"( |$)");a.className=a.className.replace(c,"$1");a.className=a.className.replace(/ $/,"")},e=function(){var b=window.location.pathname;if(b.indexOf("/")!=-1)b=b.split("/");var a=b[b.length-1]||"root";if(a.indexOf(".")!=-1)a=a.substring(0,a.indexOf("."));if(a>20)a=a.substring(a.length-19);return a},c="mi"+e(),b=function(b,a){this.g(b,a)};b.prototype={h:function(){var b=new RegExp(c+this.a+"=(\\d+)"),a=document.cookie.match(b);return a?a[1]:this.i()},i:function(){for(var b=0,c=this.b.length;b<c;b++)if(a(this.b[b].parentNode,"selected"))return b;return 0},j:function(b,d){var c=document.getElementById(b.TargetId);if(!c)return;this.l(c);for(var a=0;a<this.b.length;a++)if(this.b[a]==b){j(b.parentNode,"selected");d&&this.d&&this.k(this.a,a)}else h(this.b[a].parentNode,"selected")},k:function(a,b){document.cookie=c+a+"="+b+"; path=/"},l:function(b){for(var a=0;a<this.c.length;a++)this.c[a].style.display=this.c[a].id==b.id?"block":"none"},m:function(){this.c=[];for(var c=this,a=0;a<this.b.length;a++){var b=document.getElementById(this.b[a].TargetId);if(b){this.c.push(b);d(this.b[a],"click",function(b){var a=this;if(a===window)a=window.event.srcElement;c.j(a,1);g(b);return false})}}},g:function(f,h){this.a=h;this.b=[];for(var e=f.getElementsByTagName("a"),i=/#([^?]+)/,a,b,c=0;c<e.length;c++){b=e[c];a=b.getAttribute("href");if(a.indexOf("#")==-1)continue;else{var d=a.match(i);if(d){a=d[1];b.TargetId=a;this.b.push(b)}else continue}}var g=f.getAttribute("data-persist")||"";this.d=g.toLowerCase()=="true"?1:0;this.m();this.n()},n:function(){var a=this.d?parseInt(this.h()):this.i();if(a>=this.b.length)a=0;this.j(this.b[a],0)}};var k=[],i=function(e){var b=false;function a(){if(b)return;b=true;setTimeout(e,4)}if(document.addEventListener)document.addEventListener("DOMContentLoaded",a,false);else if(document.attachEvent){try{var f=window.frameElement!=null}catch(g){}if(document.documentElement.doScroll&&!f){function c(){if(b)return;try{document.documentElement.doScroll("left");a()}catch(d){setTimeout(c,10)}}c()}document.attachEvent("onreadystatechange",function(){document.readyState==="complete"&&a()})}d(window,"load",a)},f=function(){for(var d=document.getElementsByTagName("ul"),c=0,e=d.length;c<e;c++)a(d[c],"tabs")&&k.push(new b(d[c],c))};i(f);return{}})()
</script>