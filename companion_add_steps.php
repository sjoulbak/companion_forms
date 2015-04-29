<?php
	//Add steps page
?>
<h2>Add Step</h2>
<hr>
<!-- Add New Step -->

<?php if(isset($_POST['submit'])) {
	if(!isset($_POST['title']) || trim($_POST['title']) == '') {
		echo '<div id="message" class="error"><p><b>Title</b> cannot be empty!</p></div>';
	} else {
		echo '<div id="message" class="updated"><p>Step <b>'.$_POST['title'].'</b> added to the form</p></div>';
		global $wpdb;
		$table_name = $wpdb->prefix . 'cforms';

		$wpdb->query("INSERT INTO $table_name (title, content) VALUES ('$_POST[title]', '$_POST[content]')")or die(mysql_error());
	}
} ?>

<script language="javascript">
function add(code) {
    var myQuery = document.getElementById("content");
    
    var chaineAj = code;

    //IE support
    if (document.selection) {
        myQuery.focus();
        sel = document.selection.createRange();
        sel.text = chaineAj;
    }
    //MOZILLA/NETSCAPE support
    else if (document.getElementById("content").selectionStart || document.getElementById("content").selectionStart == "0") {
        var startPos = document.getElementById("content").selectionStart;
        var endPos = document.getElementById("content").selectionEnd;
        var chaineSql = document.getElementById("content").value;

        myQuery.value = chaineSql.substring(0, startPos) + chaineAj + chaineSql.substring(endPos, chaineSql.length);
    } else {
        myQuery.value += chaineAj;
    }
    myQuery.focus();
}
</script>

<form method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
	<?php settings_fields( 'companion_forms_group' );
	do_settings_sections( 'companion_forms_group' ); ?>

	<div id="welcome-panel" class="welcome-panel">
		<b style='text-transform: uppercase;'>Title</b> <i style="color: #424242;">e.g. Step 1 or Personal Info</i><br>
		<input type="text" placeholder="<?php _e( 'Title', 'textdomain' ) ?>" name="title" style="width: 99%;"><br><br>
	</div>

	<div id="welcome-panel" class="welcome-panel">
		<div style="width: 48%; float: left; margin: 1%;">
			<b style='text-transform: uppercase;'>Form</b> <i style="color: #424242;">the form/content from this step</i><br>
			<textarea name="content" id="content" placeholder="<?php _e( 'Content', 'textdomain' ) ?>" style="height: 500px; width: 99%; float: left;"></textarea><br>
		</div>
		<div style="width: 48%; float: left; margin: 1%;">
			<b style='text-transform: uppercase;'>Add Field</b> <i style="color: #424242;">Still thinking on how I'm going to do this</i><br>

			<br>
			<? addForms(); ?>

		</div>
	</div>
	<?php submit_button(); ?>
</form>