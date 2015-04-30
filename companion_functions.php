<?php
/*
	Companion Forms Functions File
	All functions used by this plugin are located here
*/

// Create datbase table
global $cforms_db_version;
$cforms_db_version = '1.0';

function cforms_install(){
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();

	$table_name = $wpdb->prefix . 'cforms';
	$table_settings = $wpdb->prefix . 'cformsettings';
	$table_message = $wpdb->prefix . 'cformsmessage';

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id int(6) NOT NULL AUTO_INCREMENT,
		title varchar(255) NOT NULL,
		content varchar(5000) DEFAULT '' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	$sql2 = "CREATE TABLE IF NOT EXISTS $table_settings (
		id int(11) NOT NULL AUTO_INCREMENT,
		name varchar(255) NOT NULL,
		mail varchar(255) NOT NULL,
		sccsmsg varchar(255) NOT NULL,
		failmsg varchar(255) NOT NULL,
		navtab int(1) NOT NULL,
		CC int(1),
		CC_text varchar(255),
		mailcontent varchar(5000),
		sender varchar(255),
		sender_name varchar(255),
		header varchar(255),
		UNIQUE KEY id (id)
	) $charset_collate;";

	// set-up some basic info
	$wpdb->query("INSERT INTO $table_settings ( id, name, mail, sccsmsg, failmsg, navtab ) VALUES ( '1', 'Companion Form 1', 'mail@website.com', 'Mail was sent succesfully', 'Oops! Your mail hasnt been send', '0' )");

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php');

	dbDelta( $sql );
	dbDelta( $sql2 );

	add_option( 'cforms_db_version', $cforms_db_version );
}



// Show the exisitin steps
function cforms_steps() {

	echo '<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">';

	if (isset($_GET['editcform'])) {
		cforms_edit_step();
	} else {

		// For more forms
		$form_name = "Companion Form 1";

		global $wpdb;
		$table_name = $wpdb->prefix . 'cforms';
		$table_settings = $wpdb->prefix . 'cformsettings';

		$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name")or die(mysql_error());
		$sqlcsets = $wpdb->get_results("SELECT * FROM $table_settings")or die(mysql_error());

		foreach ( $sqlcsets as $sqlcsets )  {
			$name = $sqlcsets->name;
		} ?>

		<h2>Companion Forms</h2>
		<hr>
		<style>
			.companion a {
				width: 100%;
				display: block;
				font-size: 15px;
			}
			.companion a.fullfalse {
				display: inline-block;
				width: auto;
			}
		</style>
		<div id="welcome-panel" class="welcome-panel companion" style="overflow: hidden;">
			<div style='width: 31%; float: left; margin: 1%;'>
				<?php if(!isset($_GET['name'])) {
					echo"<h2>".$name." <a href='admin.php?page=companionforms&name=edit' class='fullfalse'> &nbsp; <i class='fa fa-pencil'></i> Change Name</a></h2>";
				} else {
					echo"<form method='post' action='".$_SERVER['REQUEST_URI']."'>";
					echo"<input type='text' name='formname' value='".$name."'> <input type='submit' name='submit' value='Save' class='button button-primary'><br>";
					echo"</form>";
				}
				if(isset($_POST['submit'])) {
					global $wpdb;
					$table_settings = $wpdb->prefix . 'cformsettings';
					$wpdb->query("UPDATE $table_settings SET name = '".$_POST['formname']."' WHERE id = '1'")or die(mysql_error());
					echo "<i class='fa fa-check'></i> Name changed to: <b>".$_POST['formname']."</b>!<br>";
				} ?>
				<i>Copy and paste this code on any page to display this plugin.</i><br>
				<input type='text' value='[companionform]' style="width: 99%;"><br><br>
			</div>
			<div style='width: 31%; float: left; margin: 1%;'>
				<h3>Mail Settings</h3>
				<i>Set up mail info ,auto-reply &amp; more</i><br>
				<a href='admin.php?page=companionforms-settings&messageinfo'><i class='fa fa-envelope-o'></i> Message Content</a>
				<a href='admin.php?page=companionforms-settings&messageinfo'><i class='fa fa-reply-all'></i> Auto Response</a>
				<br><br>
			</div>
			<div style='width: 31%; float: left; margin: 1%;'>
				<h3>General Options</h3>
				<i>Turn on/off options.</i><br>
				<a href='admin.php?page=companionforms-settings'><i class='fa fa-cog'></i> Settings</a>
				<br><br>
			</div>

			<i class='fa fa-cube' style='position: absolute; bottom: -20px; right: -20px; font-size: 100px; opacity: 0.5; color: #DDD; transform: rotate(330deg);'></i>
		</div>

		<?php 
		echo '<div id="welcome-panel" class="welcome-panel" style="overflow: hidden;">';
			echo "<h2>Steps <a href='admin.php?page=companionforms&addnew' style='font-size: 15px;'> &nbsp; <i class='fa fa-plus'></i> Add New &nbsp; </a></h2>";

			echo "<ol class='boxed_list'>";
			foreach ( $sqlcforms as $sqlcforms )  {
				echo'<li><b>'.$sqlcforms->title.'</b>

				<a href="admin.php?page=companionforms&editcform='.$sqlcforms->id.'"><i class="fa fa-pencil"></i></a> | 
				<a href="admin.php?page=companionforms&deletecform='.$sqlcforms->id.'" style="color: red;"><i class="fa fa-trash-o"></i></a></li>';
			}
			echo "</ol>";

			echo"<i class='fa fa-exchange' style='position: absolute; bottom: -20px; right: -20px; font-size: 100px; opacity: 0.5; color: #DDD; transform: rotate(330deg);'></i>";

		echo "</div>";
	}
}

//Edit steps
function cforms_edit_step() {
	include('companion_edit_steps.php');
}

//Add steps
function cforms_add_step() {
	include('companion_add_steps.php');
}

function addForms() { ?>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<i>required to make this field work! <b title="Because it's still BETA, these fields are required or your form won't work at all." style="text-decoration: underline; cursor: pointer;">?</b></i><br>
	<a onClick="add('<label>Name:</label>\n<input type=\'text\' name=\'sender\'><br>\n\n')" class="button button-small"><i class="fa fa-user"></i> Name</a>
	<a onClick="add('<label>Email:</label>\n<input type=\'email\' name=\'email\'><br>\n\n')" class="button button-small"><i class="fa fa-envelope-o"></i> E-Mail Address</a>
	<br>
	<i>One of these is required!</i><br>
	<a onClick="add('<label>Subject:</label>\n<input type=\'text\' name=\'subject\'><br>\n\n')" class="button button-small" title="Let the user decide what the subject should be"><i class="fa fa-info"></i> Subject Input (?)</a>
	<a onClick="add('<input type=\'hidden\' name=\'subject\' value=\'FILL IN A SUBJECT HERE\'><br>\n\n')" class="button button-small" title="this subject title can not be changed by the user!"><i class="fa fa-info"></i> Subject Sticky (?)</a>

	<hr>
	<i>Additional Forms</i><br>
	<a onClick="add('<label>LABEL</label>\n<input type=\'text\' name=\'NAAM\'><br>\n\n')" class="button button-small"><i class="fa fa-font"></i> Text Input</a>
	<a onClick="add('<label>LABEL</label>\n<input type=\'email\' name=\'NAAM\'><br>\n\n')" class="button button-small"><i class="fa fa-envelope-o"></i> Email Input</a>
	<a onClick="add('<label>LABEL</label>\n<input type=\'checkbox\' name=\'NAAM\'><br>\n\n')" class="button button-small"><i class="fa fa-check-square-o"></i> Checkbox</a>
	<a onClick="add('<label>LABEL</label>\n<input type=\'radio\' name=\'NAAM\'><br>\n\n')" class="button button-small"><i class="fa fa-dot-circle-o"></i> Radio</a>
	<a onClick="add('<label>LABEL</label>\n<select name=\'NAAM\'>\n\n<option value=\'0\'>Optie 1</option>\n<option value=\'1\'>Optie 2</option>\n\n</select><br>\n\n')" class="button button-small"><i class="fa fa-angle-down"></i> Select</a>

	<hr>
	<i>Send button, recommended to place at the end of your form</i><br>
	<a onClick="add('<input type=\'submit\' name=\'submit\' value=\'Send Email\'><br>\n\n')" class="button button-small"><i class="fa fa-check-circle"></i> Submit Button</a>
<? }

// Deletes steps
function cforms_delete_step($id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'cforms';
	$wpdb->query("DELETE FROM $table_name WHERE id=$id")or die(mysql_error());
}
echo'<style>
	.cforms_popup {
		position: fixed;
		background: #FFF;
		border-radius: 5px;
		box-shadow: 1px 1px 8px #424242;
		top: 50px;
		left: calc(50% - 125px);
		width: 250px;
		padding: 20px;
		z-index: 99999;
	}
</style>';

if (isset($_GET['deletecform'])) {
	echo '<div class="cforms_popup">';
		echo "<b>You are about to delete something!</b><br>";
		echo "Are you sure?<br><br>";
	    echo'<a href="admin.php?page=companionforms&true-delete='.$_GET['deletecform'].'" class="button button-primary">Yes!</a>';
	    echo'&nbsp;&nbsp;<a href="admin.php?page=companionforms" class="button">Neh</a>';
	echo '</div>';
}
if (isset($_GET['true-delete'])) {
	cforms_delete_step($_GET['true-delete']);
}

// Now we set that function up to execute
add_option( 'companion_forms' );

// Add a shortcode
add_shortcode( 'companionform' , 'companion_forms' );

//Add plugin to menu
add_action( 'admin_menu', 'register_cforms_menu_page' );

function register_cforms_menu_page(){
	add_menu_page( 'Companion Forms', 'Companion Forms', 'manage_options', 'companionforms', 'cforms_menu_page', 'dashicons-format-aside', 6 );
	add_submenu_page( 'companionforms', 'Settings', 'Settings', 'manage_options', 'companionforms-settings', 'cforms_settings_page' );
	// add_submenu_page( 'companionforms', 'Add Forms', 'Add Forms', 'manage_options', 'companionforms-add-forms', 'cforms_add_page' );
}

// Create Pages
function cforms_menu_page(){
	echo '<div class="wrap">';
		include('companion_admin_menu.php');
	echo '</div>';
}

function cforms_settings_page(){
	echo '<div class="wrap">';
		include('companion_settings.php');
	echo '</div>';
}


function cforms_add_page(){
	echo '<div class="wrap">';
		include('companion_forms_add.php');
	echo '</div>';
}

?>