<?php
/**
 * @package Howdy_Partner
 * @version 1.2
 */
/*
Plugin Name: Howdy Partner
Plugin URI: http://wordpress.org/extend/plugins/howdy-partner/
Description: This is based on the Hello Dolly plugin that comes as a standard install of all WordPress installations. Instead of lyrics to the song Hello, Dolly, this plugin will display a a lyric from Jamiroquai's Space Cowboy aka the greatest song of all time.
Author: Eva Dowling
Version: 1.0
Author URI: N/A
*/

function howdy_partner_get_quote() {
	/** These are the lyrics to I love your smile and some random quotes*/
	$lyrics = "Everything is good and brown,
	With a sunshine smile upon my face,
	And all my inhibitions have disappeared without a trace,
	This is the return of the space cowboy,
	I can see clearly! so high in sky,
	Oh, good times, hard times, good vibes, hey!
	At the speed of cheeba,
        Gotta go, gotta go, got to go,";
	
	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function howdy_partner() {
	$chosen = howdy_partner_get_quote();
	echo "<p id='cowboy'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'howdy_partner' );

// We need some CSS to position the paragraph
function partner_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#partner {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 13px;
	}
	</style>
	";
}

add_action( 'admin_head', 'partner_css' );

?>
