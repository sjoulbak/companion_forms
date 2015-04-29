<!-- 
	Companion Forms Settings Page
	This is the settings page for the plugin, located under Settings > Companion Forms
-->
<p style="position: fixed; right: 25px; top: 40px;">
	<a href="https://github.com/DakelNL/companion_forms" target="_blank" style="text-decoration: none; ">GitHub Page :)</a>
</p>

<?php if (isset($_GET['addnew'])) { 

	cforms_add_step() ;

} else { 

	cforms_steps();

} ?>