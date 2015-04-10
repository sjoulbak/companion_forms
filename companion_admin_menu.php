<!-- 
	Companion Forms Settings Page
	This is the settings page for the plugin, located under Settings > Companion Forms
-->
<p style="position: fixed; right: 25px; top: 40px;">
	<a href="http://dakeldesigns.nl" target="_blank">More Plugins/Themes</a> | <a href="https://github.com/DakelNL/companion_forms" target="_blank">GitHub Page :)</a>
</p>
<script>
function copyToClipboard(text) {
  window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
}
</script>


<?php if (isset($_GET['addnew'])) { ?>
	<h2><?php _e( 'Add', 'textdomain' ) ?>  Companion Forms 
	<a href="admin.php?page=companionforms" class="add-new-h2">Main Page</a> 
	<a onclick="copyToClipboard('[companionform]');" class="add-new-h2"><?php _e( 'Get Shortcode', 'textdomain' ) ?></a></h2>
	<hr>
	<!-- Add New Step -->
	<h3><?php _e( 'Add Step', 'textdomain' ) ?></h3>

	<?php if(isset($_POST['submit'])) {
		if(!isset($_POST['title']) || trim($_POST['title']) == '') {
			echo '<div id="message" class="error"><p><b>Title</b> cannot be empty!</p></div>';
		} else {
			echo '<div id="message" class="updated"><p>Step <b>'.$_POST['title'].'</b> added to the form</p></div>';
		}
		global $wpdb;
		$table_name = $wpdb->prefix . 'cforms';

		mysql_query("INSERT INTO $table_name (title, content) VALUES ('$_POST[title]', '$_POST[content]')")or die(mysql_error());
	} ?>

	<form method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
		<?php settings_fields( 'companion_forms_group' );
		do_settings_sections( 'companion_forms_group' ); ?>

		<input type="text" placeholder="<?php _e( 'Title', 'textdomain' ) ?>" name="title"><br>
		<i style="color: #424242;">The step title (e.g. Step 1 or Personal Info)</i><br><br>

		<input type="text" placeholder="<?php _e( 'Content', 'textdomain' ) ?>" name="content"><br>
		<i style="color: #424242;">Still thinking on how I'm going to do this</i><br><br>

		<?php submit_button(); ?>
	</form>

<?php } elseif (isset($_GET['settings'])) { ?>

	<h2>Companion Forms <?php _e( 'Settings', 'textdomain' ) ?>  
	<a href="admin.php?page=companionforms" class="add-new-h2">Main Page</a> 
	<a onclick="copyToClipboard('[companionform]');" class="add-new-h2"><?php _e( 'Get Shortcode', 'textdomain' ) ?></a></h2>
	<hr>
	<p>Here I will make some settings</p>


<?php } else { ?>

	<h2><?php _e( 'Edit', 'textdomain' ) ?>  Companion Forms 
	<a href="<?php echo $_SERVER['REQUEST_URI'];?>&addnew" class="add-new-h2">Add New Step</a>
	<a onclick="copyToClipboard('[companionform]');" class="add-new-h2"><?php _e( 'Get Shortcode', 'textdomain' ) ?></a></h2>

	<!-- Show Created Step -->
	<hr>
	<h3><?php _e( 'Created Steps', 'textdomain' ) ?></h3>

	<?php cforms_steps() ?>

<? } ?>