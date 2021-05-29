<?php

/*******************************************************************************
 * PROTECTION
 ******************************************************************************/
global $user_ID;
if( $user_ID ) {
	if( !current_user_can( 'administrator' ) ) {
		if( strlen( $_SERVER['REQUEST_URI'] ) > 255 ||
			stripos( $_SERVER['REQUEST_URI'], "eval(" ) ||
			stripos( $_SERVER['REQUEST_URI'], "CONCAT" ) ||
			stripos( $_SERVER['REQUEST_URI'], "UNION+SELECT" ) ||
			stripos( $_SERVER['REQUEST_URI'], "base64" ) ) {
			@header( "HTTP/1.1 414 Request-URI Too Long" );
			@header( "Status: 414 Request-URI Too Long" );
			@header( "Connection: Close" );
			@exit;
		}
	}
}
function get_the_user_ip()
{
    if( !empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif( !empty($_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/*******************************************************************************
 * HIDE ADMIN BAR
 ******************************************************************************/
function hide_admin_bar_prefs() {
	echo '<style type="text/css">';
	echo '.show-admin-bar { display: none; }';
	echo '</style>';
}
add_action( 'admin_print_scripts-profile.php', 'hide_admin_bar_prefs' );
add_filter( 'show_admin_bar', '__return_false' );

?>