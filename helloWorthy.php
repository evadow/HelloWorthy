<?php
/**
 * @package Hello_Worthy
 * @version 1.2
 */
/*
Plugin Name: Hello Worthy
Plugin URI: http://wordpress.org/extend/plugins/hello-worthy/
Description: This is based on the Hello Dolly plugin that comes as a standard install of all WordPress installations. Instead of lyrics to the song Hello, Dolly, this plugin will display a quote, reminder or other comment.
Author: Claire Worthington
Version: 1.0
Author URI: http://worthyontheweb.co.uk
*/

function hello_worthy_get_quote() {
	/** These are the lyrics to I love your smile and some random quotes*/
	$lyrics = "Hello, Worthy,
	Be ready to evolve,
	Always work as a team,
	Improvement is necessary,
	Ask the dumb question,
	Don't underestimate the power of design skills,
	Work closely with your customers,
	Go beyond just writing code,
	Pay close attention to the architecture,
	Consider accessibility,
	A cup of tea makes everything better,
	Smile and the whole world smiles with you,
	Why fit in when you were born to stand out - Dr Seuss,";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_worthy() {
	$chosen = hello_worthy_get_quote();
	echo "<p id='worthy'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_worthy' );

// We need some CSS to position the paragraph
function worthy_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#worthy {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 13px;
	}
	</style>
	";
}

add_action( 'admin_head', 'worthy_css' );

?>
