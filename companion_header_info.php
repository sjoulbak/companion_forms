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
	$CC =  $sqlcforms->CC;

	if ($sqlcforms->mailcontent != NULL) {
		$mailcontent = $sqlcforms->mailcontent;
	} else {
		$mailcontent = "----------
This mail was sent using Companion Forms Wordpress Plugin";
	}

	if ($sqlcforms->CC_text != NULL) {
		$CC_text = $sqlcforms->CC_text;
	} else {
		$CC_text = "Thank you for emailing us,

We will try to respond to you as soon as possible!

Sincerely,

Companion Forms";}

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
			mailcontent='$_POST[mailcontent]',
			CC='$_POST[CC]',
			CC_text='$_POST[CC_text]'
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
				<tr>
					<td width="150">
						<b>Send Auto Reply:</b>
					</td>
					<td width="600">
						<select name="CC">
							<option value="0">Yes</option>
							<option value="1">No</option>
						</select>
					</td>
				</tr>
		</table>

		<br>
	</div>

	<div id='welcome-panel' class='welcome-panel'>
		<div style='width: 48%; float: left; margin: 1%;'>
			<b style='text-transform: uppercase;'>Signature</b> <i style='color: #424242;'> This will be show at the bottom of the email</i><br>
			<textarea name="mailcontent" id="content" style="height: 500px; width: 99%; float: left;" placeholder="Message"><?=$mailcontent;?></textarea><br>
		</div>

		<div style='width: 48%; float: left; margin: 1%;'>
			<?php if($CC == 0) { ?>
				<b style='text-transform: uppercase;'>Reply Mail</b> <i style='color: #424242;'> What should we sent as a reply?</i><br>
				<textarea style='height: 500px; width: 100%;' name='CC_text'><?=$CC_text; ?></textarea>
			<? }; ?>
		</div>
	</div>

	<? submit_button(); ?>
</form>