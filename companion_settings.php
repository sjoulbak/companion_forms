<script>
function copyToClipboard(text) {
  window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
}
</script>

<h2>Companion Forms <?php _e( 'Settings', 'textdomain' ) ?></h2>
<hr>
<?php
	global $wpdb;
	$table_name = $wpdb->prefix . 'cformsettings';

	if(isset($_POST['submit'])) {
		if(!isset($_POST['email']) || trim($_POST['email']) == '') {
			echo '<div id="message" class="error"><p><b>Email</b> cannot be blank!</p></div>';
		} else {
			echo '<div id="message" class="updated"><p>Jeej, you\'ve updated the settings!</div>';
			$wpdb->query("UPDATE $table_name SET mail='$_POST[email]', sccsmsg='$_POST[succesmsg]', navtab='$_POST[navtabs]' WHERE id = '1'")or die(mysql_error());
		}
	}

	$setssql = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '1'")or die(mysql_error());
	foreach ( $setssql as $setssql )  {
		$mail = $setssql->mail;
		$sccsmsg = $setssql->sccsmsg;
	}

?>
<form method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">

	<i style="color: #424242;">To:</i><br>
	<input type="text" placeholder="Email Adres" name="email" value="<?php echo $mail; ?>"><br>
	<br>

	<i style="color: #424242;">Succes Message:</i><br>
	<input type="text" placeholder="Your mail has been send" name="succesmsg" value="<?php echo $sccsmsg; ?>"><br>
	<br>

	<i style="color: #424242;">Navigation Tabs</i><br>
		<select name="navtabs">
			<option value="0">Show all</option>
			<option value="1">Show name only</option>
			<option value="2">Show number only</option>
		</select>
	<br>

	<?php submit_button(); ?>
</form>