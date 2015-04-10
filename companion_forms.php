<?php
/*
	Plugin Name: Companion Forms
	Plugin URI: http://callprofit.nl
	Description: Create a multi page form and add it to any page using shortcodes.
	Author: Service ICT, Papin
	Version: 0.0.8
	Author URI: http://service-ict.nl
	License: GPL2
*/

/* 
	Companion Forms Main Plugin File
	This is the page that shows the plugin on the website
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// The Main function that displays the form
function companion_forms() { 
	// Include layout stuff (css, javascript)
	include('layout.php');

	$functie = "Contact Formulier";
	$emailadres = "info@dakel.eu"; // let's make this a variable
	$headers = "From: Test (test@test.com) \r\n"; 
	$message = "Testing \n\n"; 

	if(isset($_POST['submit'])){ 
		// if($_POST["login"] != "" && $_POST["email"] != "" && $_POST["totslot"] != "") { 
			mail($emailadres, $headers, $message, $headers);
			echo"<p>Uw Email is verzonden.</p>"; 
		// }  else  { 
		// 	echo"<p>Er is iets fout gegaan, waarschijnlijk bent u vergeten iets in te vullen.</p>"; 
		// } 
	} 

	?>
	<form method='post' action='<?php $_SERVER['REQUEST_URI']; ?>'>
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
            	<p class='page_counter'>Step: ".$key." / ".$keylast."
            </div>";
		} ?>
        </div>
    </form>
<?php }

include('companion_functions.php');

?>