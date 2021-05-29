<?php
	get_header();

	$page = get_page_by_path( 'blog', 'OBJECT', 'page' );
	$page_title = get_the_title( $page->ID );

	$paged = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
	$post_per_page = get_option( 'posts_per_page' );

	$args = array(
        'post_type'         => array( 'post', 'news', 'actu' ),
        'post_status'       => 'publish',
        'posts_per_page'    => $post_per_page,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'paged'             => $paged
    );
    $the_query = new WP_Query( $args );

	get_template_part( 'parts/posts-list-view' );

	get_footer();
?>