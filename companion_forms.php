<?php
/*
	Plugin Name: Companion Forms
	Plugin URI: https://github.com/DakelNL/companion_forms
	Description: Create a multi page form and add it to any page using shortcodes.
	Author: Papin Schipper
	Version: 0.2.1
	Author URI: http://papinschipper.nl
	License: GPL2
*/

/* 
	Companion Forms Main Plugin File
	This is the page that shows the plugin on the website
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once('companion_functions.php');

register_activation_hook( __FILE__, 'cforms_install' );

// The Main function that displays the form
function companion_forms() { 
	// Include layout stuff (css, javascript)
	include('layout.php');

	global $wpdb;
	$table_nameSETS = $wpdb->prefix . 'cformsettings';

	$setssql = $wpdb->get_results("SELECT * FROM $table_nameSETS WHERE id = '1'")or die(mysql_error());
	foreach ( $setssql as $setssql )  {
		$tabinfo = $setssql->navtab;
		$mail = $setssql->mail;
		$succesmsg = $setssql->sccsmsg;
		$sender = $setssql->sender;
		$sender_name = $setssql->sender_name;
		$header = $setssql->header;
	}

	if(isset($_POST['submit'])){ 

		// Header information
		$name 			= $_POST[$sender_name];
		$email 			= $_POST[$sender];
		$message 		= "Test";
		$formcontent	="From: $name \n Message: $message";
		$recipient 		= $mail;
		$subject 		= $_POST[$header];
		$mailheader 	= "From: $email \r\n";

		if($name != "" && $email != "" && $subject != "") { 
			mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
			echo "<p class='succesMSG'>";
			echo $succesmsg;
			echo "</p>";
		}  else  { 
			echo"<p>Er is iets fout gegaan, waarschijnlijk bent u vergeten iets in te vullen.</p>"; 
		} 
	}

	?>
	<form method='post' action='<?php $_SERVER['REQUEST_URI']; ?>'>
		<ul class="tabs top_page_navigation" data-persist="true">
			<?php  global $wpdb;
			$table_name = $wpdb->prefix . 'cforms';

			$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name")or die(mysql_error());

			global $key;
			$key = 0;

			global $keylast;
			$keylast = 0;

			foreach ( $sqlcforms as $sqlcforms )  {
				$key++;
				$keylast++;
				echo"<li><a href='#".$sqlcforms->id."'>";
				if($tabinfo == 0 OR $tabinfo == 2) {
					echo $key;
					echo ". ";
				} 
				if($tabinfo == 0 OR $tabinfo == 1) {
				 echo $sqlcforms->title;
				}
				echo"</a></li>";

			} ?>
        </ul>

        <div class="tabcontents">
        <?php 
        global $wpdb;
		$table_name = $wpdb->prefix . 'cforms';

		$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name")or die(mysql_error());

		global $key;
		$key = 0;

        foreach ( $sqlcforms as $sqlcforms ) {
        	$key++;
            echo"<div id='".$sqlcforms->id."'>
            	<div class='inner_tabcontent'>

            		".$sqlcforms->content."

	            </div>
            	<p class='page_counter'>Step: ".$key." / ".$keylast."
            </div>";
		} ?>
        </div>
    </form>
<?php } ?>