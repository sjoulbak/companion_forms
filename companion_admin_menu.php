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
<h2><?php _e( 'Edit', 'textdomain' ) ?>  Companion Forms <a onclick="copyToClipboard('[companionform]');" class="add-new-h2"><?php _e( 'Get Shortcode', 'textdomain' ) ?></a></h2>

<!-- Add New Step -->
<h3><?php _e( 'Add Step', 'textdomain' ) ?></h3>

<?php if(isset($_POST['submit'])) {
	echo "Succes";
} ?>

<form method="post" action="options.php">
	<?php settings_fields( 'companion_forms_group' );
	do_settings_sections( 'companion_forms_group' ); ?>

	<input type="text" placeholder="<?php _e( 'Title', 'textdomain' ) ?>"><br>
	<i style="color: #424242;">The step title (e.g. Step 1 or Personal Info)</i><br><br>
	<input type="text" placeholder="<?php _e( 'Content', 'textdomain' ) ?>"><br>
	<i style="color: #424242;">Still thinking on how I'm going to do this</i><br><br>

	<?php submit_button(); ?>
</form>

<!-- Show Created Step -->
<hr>
<h3><?php _e( 'Created Steps', 'textdomain' ) ?></h3>

<?php cforms_steps() ?>
