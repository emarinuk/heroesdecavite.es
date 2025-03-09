<?php

function qcld_sliderhero_sessions_license_callback(){
	?>

	<?php qc_sliderhero_display_license_section(); ?>
	
	<div id="help_section">
		<h1>Help Section</h1>
		<h3>General Settings</h3>
		<p>
			<strong><u>Custom:</u></strong>
			<br>
				This option will allow you to provide custom width and height for your slider.
			<br>
			<br>
			<strong><u>Full Width:</u></strong>
			<br>
			Provide a custom height in px for your slider. Width will be automatically calculated depending on your screen size.
			<br>
			<br>
			<strong><u>Full Screen:</u></strong>
			<br>
			
			No need to provide any width & height. It will automatically fit any screen size and auto-calculate necessary width and height.
			<br>
			<br>
			<strong><u>Auto:</u></strong>
			<br>
			
			Slider size will fit according to container width. You can define custom height.
		</p>
		<h3>Shortcode Options</h3>
		<p>
			<strong><u>preloader</u></strong>
			<br>
				This option will allow you to enable/disable preloader for a slider
			<br>
			Example: preloader="on"
			
		</p>

		<h3>Supported Variables</h3>
		<p>
			<strong>{user}</strong> or <strong>{user|Default Name}</strong><br>
			<br>
			You can use any of the above variables in Slider Title & Description section.<br>
			{user} will be replaced by logged in user's nickname. If the user is not logged in then nothing will be printed for {user}.<br>
			You can pass a default name along with the varialbe like this {user|Default Name}. Default Name will be printed when user not logged in.
		</p>

	</div>
	
	<?php
}
