<h2>Companion Forms <?php _e( 'Settings', 'textdomain' ) ?>  
<a href="admin.php?page=companionforms" class="add-new-h2">Main Page</a> 
<a onclick="copyToClipboard('[companionform]');" class="add-new-h2"><?php _e( 'Get Shortcode', 'textdomain' ) ?></a></h2>
<hr>

<h3>Contact Info</h3>
<form method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">

	<i style="color: #424242;">To:</i><br>
	<input type="text" placeholder="Email Adres" name="email"><br>
	<br>

	<?php submit_button(); ?>
</form>