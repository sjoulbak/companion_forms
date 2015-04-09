<?php

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