<?php
	get_header();

	$page = NULL;
	$page_title = __( 'Résultats de la recherche', 'BTB' );

	$paged = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
	$post_per_page = get_option( 'posts_per_page' );

	global $wp_query;
	$the_query = $wp_query;

	get_template_part( 'parts/posts-list-view' );

	get_footer();
?>