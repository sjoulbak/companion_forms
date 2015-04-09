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

	$sql = "CREATE TABLE $table_name (
		id int(6) NOT NULL AUTO_INCREMENT,
		title varchar(255) NOT NULL,
		content varchar(255) DEFAULT '' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta( $sql );
	
	add_option( 'cforms_db_version', $cforms_db_version );
}

register_activation_hook( __FILE__, 'cforms_install' );


// Show the exisitin steps
function cforms_steps() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'cforms';

	$sqlcforms = mysql_query("SELECT * FROM $table_name")or die(mysql_error());

	echo "<ol class='boxed_list'>";
	while($rescforms = mysql_fetch_assoc($sqlcforms)) {
		echo'<li><b>'.$rescforms['title'].'</b><br>
		<a href="options-general.php?page=companion_forms_settings&editcform='.$rescforms['id'].'">Edit</a> | 
		<a href="options-general.php?page=companion_forms_settings&deletecform='.$rescforms['id'].'">Delete</a></li><br>';
	}
	echo "</ol>";

	if (isset($_GET['editcform'])) {
		cforms_edit_step( $_GET['editcform'] );
	}
}

//Edit steps
function cforms_edit_step($id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'cforms';

	$sqlcforms = mysql_query("SELECT * FROM $table_name WHERE id=$id")or die(mysql_error());
	$rescforms = mysql_fetch_assoc($sqlcforms);

	echo"<hr>";
	echo"<h3>Edit <i>".$rescforms['title']."</i></h3>";

	echo"<form method='post' action='".$_SERVER['REQUEST_URI']."'>";

   		echo"<input type='text' name ='title' value='".$rescforms['title']."'>";
   		echo"<input type='text' name ='content' value='".$rescforms['content']."'>";
   		echo submit_button();

   	echo"</form>";

   	if(isset($_POST['submit'])) {
		if(!isset($_POST['title']) || trim($_POST['title']) == '') {
			echo '<div id="message" class="error"><p><b>Title</b> cannot be empty!</p></div>';
		} else {
			echo '<div id="message" class="updated"><p>Step <b>'.$_POST['title'].'</b> updated</p></div>';
		}
		global $wpdb;
		$table_name = $wpdb->prefix . 'cforms';

		mysql_query("UPDATE $table_name SET title='$_POST[title]', content='$_POST[content]' WHERE id=$id")or die(mysql_error());
	}
}

// Deletes steps
function cforms_delete_step($id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'cforms';
	$sqlcforms = mysql_query("DELETE FROM $table_name WHERE id=$id")or die(mysql_error());
}
if (isset($_GET['deletecform'])) {
    cforms_delete_step($_GET['deletecform']);
}


// Now we set that function up to execute
add_option( 'companion_forms' );

// Add a shortcode
add_shortcode( 'companionform' , 'companion_forms' );

//Add plugin to menu
add_action( 'admin_menu', 'companion_forms_menu' );

function companion_forms_menu() {
	add_options_page( 'Companion Forms Options', 'Companion Forms', 'manage_options', 'companion_forms_settings', 'companion_forms_options' );
}

function companion_forms_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
		include('companion_admin_menu.php');
	echo '</div>';
}

function companion_forms_setting() {
	register_setting( 'companion_forms_group', 'Companion Forms', 'intval' ); 
} 
add_action( 'admin_init', 'companion_forms_setting' );

?>
