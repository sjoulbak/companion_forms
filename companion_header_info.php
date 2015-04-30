<h2>Email Message
<a href="admin.php?page=companionforms-settings" class="add-new-h2">General Settings</a></h2>
<i>Choose what to send in the email.</i>
<hr>
<?php 
global $wpdb;
$table_name = $wpdb->prefix . 'cformsettings';

$id = '1';

$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$id")or die(mysql_error());
foreach ( $sqlcforms as $sqlcforms ) { 

	$mail = $sqlcforms->mail;
	$sender = $sqlcforms->sender;
	$sender_name = $sqlcforms->sender_name;
	$header = $sqlcforms->header;

	if ($sqlcforms->mailcontent != NULL) {
		$mailcontent = $sqlcforms->mailcontent;
	} else {
		$mailcontent = "Someone has sent you an email:

Message Content:


----------
This mail was sent using Companion Forms Wordpress Plugin";
	}
} ?>
<form method='post' action='<?=$_SERVER['REQUEST_URI'];?>'>
	<?php if(isset($_POST['submit'])) {
		echo '<div id="message" class="updated"><p>Settings Saved!</p></div>';
		global $wpdb;
		$table_name = $wpdb->prefix . 'cformsettings';

		$id = '1';

		$wpdb->query("UPDATE $table_name SET 
			mail='$_POST[mail]', 
			sender='$_POST[sender]',
			sender_name='$_POST[sender_name]', 
			header='$_POST[header]',
			mailcontent='$_POST[mailcontent]'
		WHERE id = $id")or die(mysql_error());
	} ?>

	<div id="welcome-panel" class="welcome-panel">
		<b style="text-transform: uppercase;">Header Info</b> <i style="color: #424242;"> basic info</i><br>

		<table>
			<tr>
				<td width="150">
					<b>To:</b>
				</td>
				<td width="600">
					<input type='email' name='mail' placeholder='Field Name' value="<?=$mail;?>">
				</td>
			</tr>
			<tr>
				<td width="150">
					<b>From (name):</b>
				</td>
				<td width="600">
					<input type='text' name='sender_name' placeholder='Field Name' value="<?=$sender_name;?>"><i style='font-size: 12px;'>Fill in the field name.</i>
				</td>
			</tr>
			<tr>
				<td width="150">
					<b>From (email):</b>
				</td>
				<td width="600">
					<input type='text' name='sender' placeholder='Field Name' value="<?=$sender;?>"><i style='font-size: 12px;'>Fill in the field name.</i>
				</td>
			</tr>
			<tr>
				<td width="150">
					<b>Subject:</b>
				</td>
				<td width="600">
					<input type='text' name='header' placeholder='Field Name' value="<?=$header;?>"><i style='font-size: 12px;'>Fill in the field name.</i>
				</td>
			</tr>
		</table>

		<br>
	</div>

	<div id='welcome-panel' class='welcome-panel'>
		<div style='width: 48%; float: left; margin: 1%;'>
			<b style='text-transform: uppercase;'>Message</b> <i style='color: #424242;'> fill in all the info shown in the email</i><br>
			<textarea name="mailcontent" id="content" style="height: 500px; width: 99%; float: left;" placeholder="Message"><?=$mailcontent;?></textarea><br>
		</div>

		<div style='width: 48%; float: left; margin: 1%;'>
			<b style='text-transform: uppercase;'>Exisiting Fields</b> <i style='color: #424242;'> these are the fields shown in your form</i><br>
		</div>
	</div>

	<? submit_button(); ?>
</form>