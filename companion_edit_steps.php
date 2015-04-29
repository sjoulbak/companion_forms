<?php 
	//Edit steps page

	$id = $_GET['editcform'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'cforms';

	$sqlcforms = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$id")or die(mysql_error());
	foreach ( $sqlcforms as $sqlcforms ) { ?>

	<h2>Edit <i>"<?=$sqlcforms->title;?>"</i></h2>
	<hr>

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

	<form method='post' action='<?=$_SERVER['REQUEST_URI'];?>'>

   		<div id="welcome-panel" class="welcome-panel">
			<b style="text-transform: uppercase;">Title</b> <i style="color: #424242;">e.g. Step 1 or Personal Info</i><br>
			<input type="text" placeholder="Title" value="<?=$sqlcforms->title;?>" name="title" style="width: 99%;"><br><br>
		</div>

   		<div id='welcome-panel' class='welcome-panel'>
			<div style='width: 48%; float: left; margin: 1%;'>
				<b style='text-transform: uppercase;'>Form</b> <i style='color: #424242;'>the form/content from this step</i><br>
				<textarea name='content' id='content' value='' placeholder='voeg een formulier toe' style='height: 400px; width: 100%;'><?=$sqlcforms->content;?></textarea><br>
			</div>
			<div style='width: 48%; float: left; margin: 1%;'>
				<b style='text-transform: uppercase;'>Add Field</b> <i style='color: #424242;'>Still thinking on how I'm going to do this</i><br>

				<br><? addForms(); ?>
			</div>
		</div>

   		<? submit_button(); ?>

   	</form>

   	<?php if(isset($_POST['submit'])) {
		if(!isset($_POST['title']) || trim($_POST['title']) == '') {
			echo '<div id="message" class="error"><p><b>Title</b> cannot be empty!</p></div>';
		} else {
			echo '<div id="message" class="updated"><p>Step <b>'.$_POST['title'].'</b> updated</p></div>';
		}
		global $wpdb;
		$table_name = $wpdb->prefix . 'cforms';

		$wpdb->query("UPDATE $table_name SET title='$_POST[title]', content='$_POST[content]' WHERE id=$id")or die(mysql_error());
	}

} ?>