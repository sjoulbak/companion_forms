<h2>Companion Forms <?php _e( 'Settings', 'textdomain' ) ?>  
<a href="admin.php?page=companionforms" class="add-new-h2">Main Page</a> 
<a onclick="copyToClipboard('[companionform]');" class="add-new-h2"><?php _e( 'Get Shortcode', 'textdomain' ) ?></a></h2>
<hr>
<?php
	global $wpdb;
	$table_name = $wpdb->prefix . 'cformsettings';

	if(isset($_POST['submit'])) {
		if(!isset($_POST['email']) || trim($_POST['email']) == '') {
			echo '<div id="message" class="error"><p><b>Email</b> cannot be blank!</p></div>';
		} else {
			echo '<div id="message" class="updated"><p>Jeej, you\'ve updated the settings!</div>';
			mysql_query("UPDATE $table_name SET mail='$_POST[email]', sccsmsg='$_POST[succesmsg]', navtabs='$_POST[navtabs]' WHERE id = '1'")or die(mysql_error());
		}
	}

	$setssql = mysql_query("SELECT * FROM $table_name WHERE id = '1'")or die(mysql_error());
	$ressets = mysql_fetch_assoc($setssql);

?>
<h3>Contact Info</h3>
<form method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">

	<i style="color: #424242;">To:</i><br>
	<input type="text" placeholder="Email Adres" name="email" value="<?php echo $ressets['mail']; ?>"><br>
	<br>

	<i style="color: #424242;">Succes Message:</i><br>
	<input type="text" placeholder="Your mail has been send" name="succesmsg" value="<?php echo $ressets['sccsmsg']; ?>"><br>
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