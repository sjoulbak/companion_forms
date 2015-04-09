<!-- 
	Companion Forms Settings Page
	This is the settings page for the plugin, located under Settings > Companion Forms

	Ideas:
	use contact form 7 to create the forms?
-->
<?php 
$pages = array(
	1 => 'Klantgegevens',
	2 => 'Betalingsgegevens',
	3 => 'VOiP Gegevens',
	4 => 'Uw Situatie/Wensen',
	5 => 'Overzicht/Verzenden',
);
?>

<p style="position: fixed; right: 25px; top: 40px;">
	<a href="http://dakeldesigns.nl" target="_blank">More Plugins/Themes</a> | <a href="https://github.com/DakelNL/companion_forms" target="_blank">GitHub Page :)</a>
</p>
<script>
function copyToClipboard(text) {
  window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
}
</script>


<?php if (isset($_GET['addnew'])) { ?>
	<h2><?php _e( 'Add', 'textdomain' ) ?>  Companion Forms <a href="options-general.php?page=companion_forms_settings" class="add-new-h2">Edit</a> <a onclick="copyToClipboard('[companionform]');" class="add-new-h2"><?php _e( 'Get Shortcode', 'textdomain' ) ?></a></h2>
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

		mysql_query("INSERT INTO $table_name (title, content) VALUES (".$_POST['title'].", ".$_POST['content'].")")or die(mysql_error());
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

<? } else { ?>

<h2><?php _e( 'Edit', 'textdomain' ) ?>  Companion Forms <a href="<?php echo $_SERVER['REQUEST_URI'];?>&addnew" class="add-new-h2">Add New</a> <a onclick="copyToClipboard('[companionform]');" class="add-new-h2"><?php _e( 'Get Shortcode', 'textdomain' ) ?></a></h2>

<!-- Show Created Step -->
<hr>
<h3><?php _e( 'Created Steps', 'textdomain' ) ?></h3>

<?php cforms_steps() ?>

<? } ?>
