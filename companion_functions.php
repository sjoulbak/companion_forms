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
		mail varchar(255) NOT NULL,
		sccsmsg varchar(255) NOT NULL,
		navtab int(1) NOT NULL,
		mailcontent varchar(5000),
		sender varchar(255),
		header varchar(255),
		UNIQUE KEY id (id)
	) $charset_collate;";

	// set-up some basic info
	$wpdb->query("INSERT INTO $table_settings ( id, mail, sccsmsg, navtab ) VALUES ( '1', 'mail@website.com', 'Mail was sent succesfully', '0' )");

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

		$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name")or die(mysql_error()); ?>

		<h2>Companion Forms
		<a href="<?php echo $_SERVER['REQUEST_URI'];?>&addnew" class="add-new-h2">Add New Step</a></h2>

		<hr>
		<div id="welcome-panel" class="welcome-panel">
			<h3><?=$form_name; ?></h3>
			<i>Copy and paste this code on any page to display this plugin.</i><br>
			<input type='text' value='[companionform]' style="width: 99%;"><br><br>
		</div>

		<div id="welcome-panel" class="welcome-panel">
			<h3>Mail Content</h3>
			<i>What should we send you in the email?.</i><br>
			<a href="admin.php?page=companionforms&messageinfo">Tell us here!</a>
			<br><br>
		</div>

		<?php echo '<div id="welcome-panel" class="welcome-panel">';
			echo "<ol class='boxed_list'>";
			foreach ( $sqlcforms as $sqlcforms )  {
				echo'<li><b>'.$sqlcforms->title.'</b>

				<a href="admin.php?page=companionforms&editcform='.$sqlcforms->id.'"><i class="fa fa-pencil"></i></a> | 
				<a href="admin.php?page=companionforms&deletecform='.$sqlcforms->id.'" style="color: red;"><i class="fa fa-trash-o"></i></a></li><br>';
			}
			echo "</ol>";
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
	<a onClick="add('<label>LABEL</label>\n<input type=\'text\' name=\'NAAM\'><br>\n\n')" class="button button-small">Text Input</a>
	<a onClick="add('<label>LABEL</label>\n<input type=\'email\' name=\'NAAM\'><br>\n\n')" class="button button-small">Email Input</a>
	<a onClick="add('<label>LABEL</label>\n<input type=\'checkbox\' name=\'NAAM\'><br>\n\n')" class="button button-small">Checkbox</a>
	<a onClick="add('<label>LABEL</label>\n<input type=\'radio\' name=\'NAAM\'><br>\n\n')" class="button button-small">Radio</a>

	<hr>
	<a onClick="add('<input type=\'submit\' name=\'submit\' value=\'Submit\'><br>\n\n')" class="button button-small">Submit Button</a>
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