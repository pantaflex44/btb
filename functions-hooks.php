<?php

/*******************************************************************************
 * UPDATE QUERY FOR POST TYPES
 ******************************************************************************/
function query_post_type( $query ) {
	if( ( is_archive() || is_home() ) && empty( $query->query_vars['suppress_filters'] ) ) {
		$post_type = get_query_var( 'post_type' );

		if( $post_type )
			$post_type = $post_type;
		else
			$post_type = array( 'post', 'news', 'actu', 'book' );

		$query->set( 'post_type', $post_type );

		return $query;
	}
}
add_filter( 'pre_get_posts', 'query_post_type' );

/*******************************************************************************
 * FIX WP_GET_ARCHIVES WITH CUSTOM POST TYPES
 ******************************************************************************/
function get_archives_with_ctp( $where , $r ) {
	$args = array( 'public' => true , '_builtin' => false );
	$output = 'names'; $operator = 'and';
	$post_types = get_post_types( $args , $output , $operator );
	$post_types = array_merge( $post_types , array( 'post' ) );
	$post_types = "'" . implode( "' , '" , $post_types ) . "'";

	return str_replace( "post_type = 'post'" , "post_type IN ( $post_types )" , $where );
}
add_filter( 'getarchives_where' , 'get_archives_with_ctp', 10, 2);

/*******************************************************************************
 * ADD SOCIAL LINKS TO USER'S PROFILE
 ******************************************************************************/
function add_user_social_links( $user_contact ) {
   $user_contact['facebook'] = __( 'Lien Facebook', 'BTB' );
   $user_contact['twitter'] = __( 'Lien Twitter', 'BTB' );
   $user_contact['instagram'] = __( 'Lien Instagram', 'BTB' );
   $user_contact['youtube'] = __( 'Lien YouTube', 'BTB' );
   $user_contact['linkedin'] = __( 'Lien LinkedIn', 'BTB' );

   return $user_contact;
}
add_filter('user_contactmethods', 'add_user_social_links');

/*******************************************************************************
 * REWRITE ARCHIVE TITLE
 ******************************************************************************/
function rewrite_archive_title( $title = 'Archives' ) {
	if ( is_category() ) {
		$title = sprintf( __( '<span style="font-size:0.5em;font-weight:normal;"> Dans la catégorie </span><br />%s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( '<span style="font-size:0.5em;font-weight:normal;"> Sur le sujet </span><br />%s' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( '%s' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( '%s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( '%s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( '%s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'A part', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Gallerie d\'images', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Citations', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Liens web', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Status', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Conversations', 'post format archive title' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( '%s' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		$title = sprintf( __( '%1$s: %2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'rewrite_archive_title' );

/*******************************************************************************
 * RESIZE / CROP AVATAR ON UPLOAD TO SQUARE 300px x 300px
 ******************************************************************************/
function crop_resize_avatar( $avatar, $id_or_email, $size, $default, $alt )
{
	$newAvatar = wp_get_image_editor( $avatar );
	if ( is_wp_error( $newAvatar ) )
		return $avatar;

	$newAvatar->resize( 300, 300, true );
	$info = pathinfo( $avatar );
	$newAvatar->save( $info['filename'] . $info['extension'] );

	return $newAvatar;
}
add_filter( 'get_avatar', 'crop_resize_avatar', 10, 5 );









?>