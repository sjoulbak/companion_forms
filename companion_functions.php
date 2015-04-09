<?php
/*
	Companion Forms Functions File
	All functions used by this plugin are located here
*/
 
// function to create the DB / Options / Defaults					
global $c_forms_version;
$c_forms_version = '0.0.2';

function c_forms_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'companionforms';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title varchar(255),
		content varchar(255),
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'c_forms_version', $c_forms_version );
}

function c_forms_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'companionforms';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		) 
	);
}

register_activation_hook( __FILE__, 'c_forms_install' );
register_activation_hook( __FILE__, 'c_forms_install_data' );

// Now we set that function up to execute
add_option( 'companion_forms' );

// Add a shortcode
add_shortcode( 'companionformulier' , 'companion_forms' );


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