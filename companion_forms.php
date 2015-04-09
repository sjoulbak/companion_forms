<?php
/*
	Plugin Name: Companion Forms
	Plugin URI: http://callprofit.nl
	Description: Create a multi page form and add it to any page using shortcodes.
	Author: Service ICT, Papin
	Version: 0.0.2
	Author URI: http://service-ict.nl
	License: GPL2
*/

/* 
	Comapion Forms Main Plugin File
	This is the page that shows the plugin on the website
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// The Main function that displays the form
function companion_forms() { ?>

	<style>
		ul.top_page_navigation {
			background: #F5F5F5;
			display: inline-block;
			padding: 10px 0px;
			width: 100%;
			margin-left: 0px;
			border: 1px solid #DDD;
			border-bottom: 0px;
		}
		ul.top_page_navigation li {
			float: left;
			list-style-type: none;
		}
		ul.top_page_navigation li a {
			padding: 10px 15px;
			border-right: 1px solid #DDD;
			color: #424242;
		}
		ul.top_page_navigation li a:hover {
		    text-decoration: none;
		    color: #95C93E;
		}
		ul.top_page_navigation li.selected a {
		    background: #FFF;
		    color: #424242;
		    padding-bottom: 12px;
		}
		.tabcontents{
			border: 1px solid #DDD;
			padding: 10px;
		}
		.inner_tabcontent {
			padding-bottom: 25px;
		}
		.page_counter {
			text-align: right;
			opacity: 0.5;
		}
		.half {
			width: 50%;
			float: left;
		}

	</style>
	<script>
	/* http://www.menucool.com/tabbed-content Free to use. v2013.7.6 */
	(function(){var g=function(a){if(a&&a.stopPropagation)a.stopPropagation();else window.event.cancelBubble=true;var b=a?a:window.event;b.preventDefault&&b.preventDefault()},d=function(a,c,b){if(a.addEventListener)a.addEventListener(c,b,false);else a.attachEvent&&a.attachEvent("on"+c,b)},a=function(c,a){var b=new RegExp("(^| )"+a+"( |$)");return b.test(c.className)?true:false},j=function(b,c,d){if(!a(b,c))if(b.className=="")b.className=c;else if(d)b.className=c+" "+b.className;else b.className+=" "+c},h=function(a,b){var c=new RegExp("(^| )"+b+"( |$)");a.className=a.className.replace(c,"$1");a.className=a.className.replace(/ $/,"")},e=function(){var b=window.location.pathname;if(b.indexOf("/")!=-1)b=b.split("/");var a=b[b.length-1]||"root";if(a.indexOf(".")!=-1)a=a.substring(0,a.indexOf("."));if(a>20)a=a.substring(a.length-19);return a},c="mi"+e(),b=function(b,a){this.g(b,a)};b.prototype={h:function(){var b=new RegExp(c+this.a+"=(\\d+)"),a=document.cookie.match(b);return a?a[1]:this.i()},i:function(){for(var b=0,c=this.b.length;b<c;b++)if(a(this.b[b].parentNode,"selected"))return b;return 0},j:function(b,d){var c=document.getElementById(b.TargetId);if(!c)return;this.l(c);for(var a=0;a<this.b.length;a++)if(this.b[a]==b){j(b.parentNode,"selected");d&&this.d&&this.k(this.a,a)}else h(this.b[a].parentNode,"selected")},k:function(a,b){document.cookie=c+a+"="+b+"; path=/"},l:function(b){for(var a=0;a<this.c.length;a++)this.c[a].style.display=this.c[a].id==b.id?"block":"none"},m:function(){this.c=[];for(var c=this,a=0;a<this.b.length;a++){var b=document.getElementById(this.b[a].TargetId);if(b){this.c.push(b);d(this.b[a],"click",function(b){var a=this;if(a===window)a=window.event.srcElement;c.j(a,1);g(b);return false})}}},g:function(f,h){this.a=h;this.b=[];for(var e=f.getElementsByTagName("a"),i=/#([^?]+)/,a,b,c=0;c<e.length;c++){b=e[c];a=b.getAttribute("href");if(a.indexOf("#")==-1)continue;else{var d=a.match(i);if(d){a=d[1];b.TargetId=a;this.b.push(b)}else continue}}var g=f.getAttribute("data-persist")||"";this.d=g.toLowerCase()=="true"?1:0;this.m();this.n()},n:function(){var a=this.d?parseInt(this.h()):this.i();if(a>=this.b.length)a=0;this.j(this.b[a],0)}};var k=[],i=function(e){var b=false;function a(){if(b)return;b=true;setTimeout(e,4)}if(document.addEventListener)document.addEventListener("DOMContentLoaded",a,false);else if(document.attachEvent){try{var f=window.frameElement!=null}catch(g){}if(document.documentElement.doScroll&&!f){function c(){if(b)return;try{document.documentElement.doScroll("left");a()}catch(d){setTimeout(c,10)}}c()}document.attachEvent("onreadystatechange",function(){document.readyState==="complete"&&a()})}d(window,"load",a)},f=function(){for(var d=document.getElementsByTagName("ul"),c=0,e=d.length;c<e;c++)a(d[c],"tabs")&&k.push(new b(d[c],c))};i(f);return{}})()
	</script>

		<ul class="tabs top_page_navigation" data-persist="true">
			<?php  global $wpdb;
			$table_name = $wpdb->prefix . 'cforms';

			$sqlcforms = mysql_query("SELECT * FROM $table_name")or die(mysql_error());

			global $key;
			$key = 0;

			global $keylast;
			$keylast = 0;

			while($rescforms = mysql_fetch_assoc($sqlcforms)) {
				$key++;
				$keylast++;
				echo"<li><a href='#".$rescforms['id']."'>".$key.". ".$rescforms['title']."</a></li>";

			} ?>
        </ul>

        <div class="tabcontents">
        <?php 
        global $wpdb;
		$table_name = $wpdb->prefix . 'cforms';

		$sqlcforms = mysql_query("SELECT * FROM $table_name")or die(mysql_error());

		global $key;
		$key = 0;

        while($rescforms = mysql_fetch_assoc($sqlcforms)) {
        	$key++;
            echo"<div id='".$rescforms['id']."'>
            	<div class='inner_tabcontent'>

            		".$rescforms['content']."

	            </div>
            	<p class='page_counter'>Stap: ".$key." / ".$keylast."
            </div>";
		} ?>
        </div>

<?php }

include('companion_functions.php');

?>