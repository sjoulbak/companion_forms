<?php
/*
	Plugin Name: Companion Forms
	Plugin URI: https://github.com/DakelNL/companion_forms
	Description: Create a multi page form and add it to any page using shortcodes.
	Author: Papin Schipper
	Version: 0.6.6
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

	$table_name = $wpdb->prefix . 'cforms';
	$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name")or die(mysql_error());

	$table_nameSETS = $wpdb->prefix . 'cformsettings';
	$setssql = $wpdb->get_results("SELECT * FROM $table_nameSETS WHERE id = '1'")or die(mysql_error());

	foreach ( $setssql as $setssql )  {
		$tabinfo = $setssql->navtab;
		$mail = $setssql->mail;
		$succesmsg = $setssql->sccsmsg;
		$failmsg = $setssql->failmsg;
		$sender = $setssql->sender;
		$sender_name = $setssql->sender_name;
		$header = $setssql->header;
		$mailcontent = $setssql->mailcontent;
		$CC = $setssql->CC;
		$CC_text = $setssql->CC_text;
		$bottom = $setssql->bottom;
		$steps = $setssql->steps;
		$progress = $setssql->progress;
	}

	if(isset($_POST['submit'])){ 
		$fields = array();
		if (isset($_POST) && !empty($_POST)) {
		    foreach ($_POST as $name => $val) {
		        //Do not send the submit, subject and email value (these are send in the header)
		        if ($name != 'submit' && $name != $header && $name != $sender && $val != '----------') {
		        	$fields[] = $name. ": " .$val;
		        } elseif ($val == '----------') {
		        	$fields[] = $val;
		        	$fields[] = "\n";
		        }
		    }
		}

		$formfields = implode("\n", $fields);

		// Header information
		$name 			= $_POST[$sender_name];
		$email 			= $_POST[$sender];
		$message 		= $_POST[$sender_name].": ".$_POST[$header]. "\n\n" .$formfields. " " .$mailcontent;
		$formcontent	= $message;
		$recipient 		= $mail;
		$subject 		= $_POST[$header];
		$mailheader 	= "From: $email \r\n";

		if($name != "" && $email != "" && $subject != "") { 
			mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
			echo "<p class='succesMSG'>";
			echo $succesmsg;
			echo "</p>";

			if($CC == 0) {
				$email2 		= $mail;
				$message2 		= $CC_text;
				$recipient2 	= $mail;
				$subject2 		= "Autoreply: ".$_POST[$header];
				$mailheader2 	= "From: $email2 \r\n";

				mail($recipient2, $subject2, $message2, $mailheader2) or die("Error!");
			}

		}  else  { 
			echo "<p class='errorMSG'>";
			echo $failmsg;
			echo "</p>";
		} 

	}

	?>
	<form method='post' action='<?php $_SERVER['REQUEST_URI']; ?>'>
		<ul class="tabs top_page_navigation">
			<?php

			$key = 0;
			$keylast = 0;

			foreach ( $sqlcforms as $sqlcforms )  {
				$key++;
				$keylast++;

				$width = 100/$keylast;

				echo"<li><a href='#".$sqlcforms->id."'>";
				if($tabinfo == 0 OR $tabinfo == 2) {
					echo $key.". ";
				} 
				if($tabinfo == 0 OR $tabinfo == 1) {
				 echo $sqlcforms->title;
				}
				echo"</a></li>";
			} 
		?>
		<style>
		@media screen and (min-width: 901px) {
			ul.top_page_navigation li {
				width: <?=$width;?>%;
			}
			ul.top_page_navigation li a {
				width: 100%;
			}
		}
		</style>
        </ul>
        <div class="tabcontents">
        	<?php 

			$table_name = $wpdb->prefix . 'cforms';
			$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name")or die(mysql_error());

			$key = 0;

	        foreach ( $sqlcforms as $sqlcforms ) {
	        	$key++;

            echo"<div id='".$sqlcforms->id."'>";
            if($progress == 0) {
            	echo"<div class='progressbar'>
        			<div style='width:".($width * $key)."%;' class='progress'><span style='left: ".($width * $key)."%; margin-left: -20px;'>".($width * $key)."%</span></div>
        		</div>";
        	}
            echo"<div class='inner_tabcontent'>
            		<input type='hidden' name='".$key."' value='".$sqlcforms->title."'>
            		".$sqlcforms->content."
            		<input type='hidden' name='break".$key."' value='----------'>
	            </div>";

	        if($bottom == 0) {
	            echo"<ul class='tabs bottom_page_navigation'>";
					$table_name = $wpdb->prefix . 'cforms';

					$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name")or die(mysql_error());

					$counting = 0;

					foreach ( $sqlcforms as $sqlcforms )  {
						$counting++;
						echo"<a href='#".$sqlcforms->id."'";

						if($counting <= $key - 2) {
							echo" style='display: none;'";
						}
						else if($counting == $key) {
							echo" style='display: none;'";
						} 
						else if($counting >= $key + 2) {
							echo" style='display: none;'";
						}
						echo ">";

						if($counting <= $key - 1) {
							echo" <i class='fa fa-angle-left'></i> ";
						} 
						echo $sqlcforms->title;

						if($counting >= $key + 1) {
							echo" <i class='fa fa-angle-right'></i> ";
						} 
						echo"</a>";

					}
		        echo"</ul>";
		    }
		    if($steps == 0) {
            	echo"<p class='page_counter'>".$key."/".$keylast."</p>";
            }
            echo"</div>";
		} ?>
        </div>
    </form>
<?php } ?>