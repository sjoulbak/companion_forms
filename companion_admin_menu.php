<!-- 
	Companion Forms Settings Page
	This is the settings page for the plugin, located under Settings > Companion Forms
-->
<p style="position: fixed; right: 25px; top: 40px;">
	<a href="https://github.com/DakelNL/companion_forms" target="_blank">GitHub Page :)</a>
</p>

<?php if (isset($_GET['addnew'])) { ?>

	<?php cforms_add_step() ?>

<?php } else { ?>

	<?php cforms_steps() ?>

<? } ?>