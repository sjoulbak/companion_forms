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

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id int(6) NOT NULL AUTO_INCREMENT,
		title varchar(255) NOT NULL,
		content varchar(255) DEFAULT '' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta( $sql );

	add_option( 'cforms_db_version', $cforms_db_version );
}




// Show the exisitin steps
function cforms_steps() {
	echo '<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">';
	global $wpdb;
	$table_name = $wpdb->prefix . 'cforms';

	$sqlcforms = mysql_query("SELECT * FROM $table_name")or die(mysql_error());

	echo "<ol class='boxed_list'>";
	while($rescforms = mysql_fetch_assoc($sqlcforms)) {
		echo'<li><b>'.$rescforms['title'].'</b> 

		<b><a href="admin.php?page=companionforms&mvup='.$rescforms['id'].'" title="move up"><i class="fa fa-angle-up"></i></a> 
		<a href="admin.php?page=companionforms&mvdown='.$rescforms['id'].'" title="move down"><i class="fa fa-angle-down"></i></a></b><br>

		<a href="admin.php?page=companionforms&editcform='.$rescforms['id'].'"><i class="fa fa-pencil"></i></a> | 
		<a href="admin.php?page=companionforms&deletecform='.$rescforms['id'].'"><i class="fa fa-trash-o"></i></a></li><br>';
	}
	echo "</ol>";

	if (isset($_GET['editcform'])) {
		cforms_edit_step( $_GET['editcform'] );
	}

	if (isset($_GET['mvup'])) {
		cforms_move_up( $_GET['mvup'] );
	}

	if (isset($_GET['mvdown'])) {
		cforms_move_down( $_GET['mvdown'] );
	}
}

// Move up
function cforms_move_up($id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'cforms';

	echo "Ahh man, you broke it!<br>";
	echo "You are moving #".$id." up";

	$nextid = ($id-1);

	//First clear the current ID
	mysql_query("UPDATE $table_name SET id='0' WHERE id=$id")or die(mysql_error());

	//Then Move the next item up
	mysql_query("UPDATE $table_name SET id=$id WHERE id=$nextid")or die(mysql_error());

	//Then Move current down
	mysql_query("UPDATE $table_name SET id=$nextid WHERE id=$id")or die(mysql_error());
}

function cforms_move_down($id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'cforms';

	echo "Ahh man, you broke it!<br>";
	echo "You are moving #".$id." down";

	$nextid = ($id+1);

	//First clear the current ID
	mysql_query("UPDATE $table_name SET id='0' WHERE id=$id")or die(mysql_error());

	//Then Move the next item up
	mysql_query("UPDATE $table_name SET id=$id WHERE id=$nextid")or die(mysql_error());

	//Then Move current down
	mysql_query("UPDATE $table_name SET id=$nextid WHERE id=$id")or die(mysql_error());

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

	echo"<input type='text' name ='title' value='".$rescforms['title']."' style='width: 100%;'><br>";
	echo"<textarea name ='content' value='' placeholder='voeg een formulier toe' style='height: 400px; width: 100%;'>".$rescforms['content']."</textarea>";
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
	add_menu_page( 'Companion Forms', 'Companion Forms', 'manage_options', 'companionforms', 'cforms_menu_page', plugins_url( '/companion_forms/c_icon.png' ), 6 );
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