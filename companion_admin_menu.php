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

<a href="https://github.com/DakelNL/companion_forms" target="_blank" style="position: fixed; right: 25px; top: 50px;">Help developing this plugin on GitHub :)</a>

<h2><?php _e( 'Edit', 'textdomain' ) ?>  Companion Forms <!--<a href="?page=companion_forms_settings&c_form=new" class="add-new-h2">Add New</a>--></h2>
<p>Working on it...</p>

<!-- Add New Step -->
<h3><?php _e( 'Add Step', 'textdomain' ) ?></h3>

<?php if(isset($_POST['submit'])) {
	array_push($pages, "apple", "raspberry");
	echo "Succes";
} ?>

<form method="post" action="options.php">
	<?php settings_fields( 'companion_forms_group' );
	do_settings_sections( 'companion_forms_group' ); ?>

	<input type="text" placeholder="<?php _e( 'Title', 'textdomain' ) ?>"><br>
	<i style="color: #424242;">The step title (e.g. Step 1 or Personal Info)</i><br><br>
	<input type="text" placeholder="<?php _e( 'Content', 'textdomain' ) ?>"><br>
	<i style="color: #424242;">Use another plugin to make the forms</i><br><br>

	<?php submit_button(); ?>
</form>

<!-- Show Created Step -->
<hr>
<h3><?php _e( 'Created Steps', 'textdomain' ) ?></h3>

<?php 
foreach ($pages as $key => $value) {
	echo"<li>".$key.". ".$value." <a href=''>Edit</a> | <a href=''>Delete</a></li>";
} ?>

<!-- Show Shortcode -->
<hr>
<h3><?php _e( 'Shortcode', 'textdomain' ) ?></h3>
<b>Shortcode:</b> [companionformulier]<br>
<i>De shortcode werkt momenteel nog maar met 1 formulier...</i>