<? if (isset($_GET['messageinfo'])) { 
	include('companion_header_info.php');
} else { ?>
	<h2>General Settings
	<a href="admin.php?page=companionforms-settings&messageinfo" class="add-new-h2">Message Content</a></h2>
	<i>Companion Forms General Settings.</i>
	<hr>
	<?php
		global $wpdb;
		$table_name = $wpdb->prefix . 'cformsettings';

		if(isset($_POST['submit'])) {
			if(!isset($_POST['email']) || trim($_POST['email']) == '') {
				echo '<div id="message" class="error"><p><b>Email</b> cannot be blank!</p></div>';
			} else {
				echo '<div id="message" class="updated"><p>Jeej, you\'ve updated the settings!</div>';
				$wpdb->query("UPDATE $table_name SET mail='$_POST[email]', sccsmsg='$_POST[succesmsg]', failmsg='$_POST[failmsg]', navtab='$_POST[navtab]', bottom='$_POST[bottom]', steps='$_POST[steps]' WHERE id = '1'")or die(mysql_error());
			}
		}

		$setssql = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '1'")or die(mysql_error());
		foreach ( $setssql as $setssql )  {
			$mail = $setssql->mail;
			$sccsmsg = $setssql->sccsmsg;
			$failmsg = $setssql->failmsg;
			$navtab = $setssql->navtab;
			$bottom = $setssql->bottom;
			$steps = $setssql->steps;

			if($navtab == 0) {
				$currenttab = "Show All";
			} else if($navtab == 1) { 
				$currenttab = "Show Name Only";
			} else if($navtab == 2) { 
				$currenttab = "Show Number Only";
			}

			if($bottom == 0) {
				$currentbottom = "Show";
			} else if($bottom == 1) { 
				$currentbottom = "Hide";
			}

			if($steps == 0) {
				$currentsteps = "Show";
			} else if($steps == 1) { 
				$currentsteps = "Hide";
			}
		}

	?>
	<form method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
		<div id="welcome-panel" class="welcome-panel">

			<table>
				<tr>
					<td width="200">
						<b>To:</b>
					</td>
					<td width="400">
						<input type="text" placeholder="Email Adres" name="email" value="<?php echo $mail; ?>" style="width: 100%;">
					</td>
				</tr>
				<tr>
					<td width="75">
						<b>Succes Message:</b>
					</td>
					<td width="200">
						<input type="text" placeholder="Your mail has been send" name="succesmsg" value="<?php echo $sccsmsg; ?>" style="width: 100%;">
					</td>
				</tr>
				<tr>
					<td width="75">
						<b>Error Message:</b>
					</td>
					<td width="200">
						<input type="text" placeholder="Have you filled in all required fields?" name="failmsg" value="<?php echo $failmsg; ?>" style="width: 100%;">
					</td>
				</tr>
				<tr>
					<td width="75">
						<b>Navigation Tabs:</b>
					</td>
					<td width="200">
						<select name="navtab" style="width: 100%;">
							<option value="<?=$navtab; ?>">Currently: <?=$currenttab; ?></option>
							<option value="0">Show all</option>
							<option value="1">Show name only</option>
							<option value="2">Show number only</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="75">
						<b>Bottom Buttons:</b>
					</td>
					<td width="200">
						<select name="bottom" style="width: 100%;">
							<option value="<?=$bottom; ?>">Currently: <?=$currentbottom; ?></option>
							<option value="0">Show</option>
							<option value="1">Hide</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="75">
						<b>Step Counter:</b>
					</td>
					<td width="200">
						<select name="steps" style="width: 100%;">
							<option value="<?=$steps; ?>">Currently: <?=$currentsteps; ?></option>
							<option value="0">Show</option>
							<option value="1">Hide</option>
						</select>
					</td>
				</tr>
			</table><br>
		</div>

		<?php submit_button(); ?>
	</form>
<? } ?>