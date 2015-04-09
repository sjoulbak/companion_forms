<a href="https://github.com/DakelNL/multistepform" target="_blank" style="position: fixed; right: 25px; top: 50px;">Help developing this plugin on GitHub :)</a>

<h2><?php _e( 'Edit', 'textdomain' ) ?>  Companion Forms</h2>
<p>Working on it...</p>

<h3><?php _e( 'Add Step', 'textdomain' ) ?></h3>

<?php if(isset($_POST['submit'])) {
	array_push($pages, "apple", "raspberry");
	echo "Succes";
} ?>

<form method="post" action="options.php">
	<?php settings_fields( 'companion_forms_group' );
	do_settings_sections( 'companion_forms_group' ); ?>
	<input type="text" placeholder="<?php _e( 'Title', 'textdomain' ) ?>">
	<?php submit_button(); ?>
</form>

<hr>
<h3><?php _e( 'Created Steps', 'textdomain' ) ?></h3>

<?php 
$pages = array(
	1 => 'Klantgegevens',
	2 => 'Betalingsgegevens',
	3 => 'VOiP Gegevens',
	4 => 'Uw Situatie/Wensen',
	5 => 'Overzicht/Verzenden',
);
foreach ($pages as $key => $value) {
	echo"<li>".$key.". ".$value."</li>";
} ?>

<hr>
<b>Shortcode:</b> [companionformulier]<br>
<i>De shortcode werkt momenteel nog maar met 1 formulier...</i>