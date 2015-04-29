<h2>Email Message</h2>
<i>Choose what to send in the email.</i>
<hr>
<?php 
global $wpdb;
$table_name = $wpdb->prefix . 'cformsettings';

$id = '1';

$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$id")or die(mysql_error());
foreach ( $sqlcforms as $sqlcforms ) { 

	$mail = $sqlcforms->mail;

} ?>
<form method='post' action='<?=$_SERVER['REQUEST_URI'];?>'>
	<div id="welcome-panel" class="welcome-panel">
		<b style="text-transform: uppercase;">Header Info</b> <i style="color: #424242;"> basic info</i><br>

		<table>
			<tr>
				<td width="100">
					<b>To:</b>
				</td>
				<td width="200">
					<input type='text' name='mail' placeholder='Field Name' value="<?=$mail;?>">
				</td>
			</tr>
			<tr>
				<td width="75">
					<b>From:</b>
				</td>
				<td width="200">
					<input type='text' name='sender' placeholder='Field Name'>
				</td>
			</tr>
			<tr>
				<td width="75">
					<b>Subject:</b>
				</td>
				<td width="200">
					<input type='text' name='header' placeholder='Field Name'>
				</td>
			</tr>
		</table>

		<br>
	</div>

	<div id='welcome-panel' class='welcome-panel'>
	<div style='width: 48%; float: left; margin: 1%;'>
		<b style='text-transform: uppercase;'>Message</b> <i style='color: #424242;'> fill in all the info shown in the email</i><br>
		<textarea name="content" id="content" style="height: 500px; width: 99%; float: left;" placeholder="Message">
Someone has sent you an email:

Message Content:


----------
This mail is sent using Companion Forms Wordpress Plugin
</textarea><br>
	</div>
	<div style='width: 48%; float: left; margin: 1%;'>
		<b style='text-transform: uppercase;'>Exisiting Fields</b> <i style='color: #424242;'> these are the fields shown in your form</i><br>

		
	</div>
</div>
</form>