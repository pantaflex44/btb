<?php

/*******************************************************************************
 * AUTO ADD IDs TO ALL HEADINGS IN POST CONTENTS
 ******************************************************************************/
function auto_id_headings( $content ) {
	$content = preg_replace_callback( '/(\<h[1-7](.*?))\>(.*)(<\/h[1-7]>)/i', function( $matches ) {
		if ( !stripos( $matches[0], 'id=' ) ) :
			$matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
		endif;

		return $matches[0];
	}, $content );

	return $content;
}
add_filter( 'the_content', 'auto_id_headings' );

/*******************************************************************************
 * ADD CUSTUM FIELD FOR NEW POST
 ******************************************************************************/
function btb_add_custom_fields( $post_id ) {
	add_post_meta( $post_id, 'post_viewed', '0', true );
	add_post_meta( $post_id, 'post_rating', '2.5', true );

	return true;
}
add_action( 'wp_insert_post', 'btb_add_custom_fields' );

/*******************************************************************************
 * GET THE CURRENT POST DATE LINK
 ******************************************************************************/
function get_current_post_archive_date_link() {
	$archive_year  = get_the_time('Y');
	$archive_month = get_the_time('m');
	$archive_day   = get_the_time('d');

	return esc_url( get_day_link( $archive_year, $archive_month, $archive_day) );
}

/*******************************************************************************
 * GET READING TIME IN MINUTES
 ******************************************************************************/
function get_reading_time_in_minutes() {
	global $post;

	$content = strip_tags( $post->post_content );
	$cnt = count( explode( ' ', $content ) );

	$s = ( $cnt * 60 ) / 200; // 200 mots par minute
	$m = round( $s / 60 % 60, 0 );
	$m = ($m <= 1) ? 1 : $m;

	return sprintf(
		_n(
			__( '%s min', 'BTB' ),
			__( '%s mins', 'BTB' ),
			$m,
			'BTB'
		),
		$m
	);
}

/*******************************************************************************
 * GET NUMERIC PAGINATION TYPE
 ******************************************************************************/
function numeric_posts_nav( $wp_query, $start = 0, $end = 0 ) {

	if( $wp_query->max_num_pages <= 0 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	if( $paged >= 1 )
		$links[] = $paged;

	if( $paged >= 2 )
		$links[] = $paged - 1;

	if( ( $paged + 1 ) <= $max )
		$links[] = $paged + 1;

	$se = '';
	if( $end > 0 ) {
		$se = sprintf(
			__( '&nbsp;<span class="navi-infos" style="font-size: small; color: #999;">(%s à %s)</span>', 'BTB' ),
			$start,
			$end
		);
	}

	echo '<ul>' . "\n";

	if( $paged > 1 && $max > 1 ) {
		printf( '<li><a href="%s" title="%s">%s</a></li>' . "\n",
			esc_url( get_pagenum_link( $paged - 1 ) ),
			__( 'Page précédente', 'BTB' ),
			__( '←', 'BTB' )
		);
	}

	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="on"' : '';
		printf( '<li%s><a href="%s" title="%s">%s</a>%s</li>' . "\n",
				$class,
				esc_url( get_pagenum_link( 1 ) ),
				sprintf( '%s %s', __( 'Page', 'BTB' ), '1' ),
				'1',
				($class == '' ? '' : $se)
		);

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="on"' : '';
		printf( '<li%s><a href="%s" title="%s">%s</a>%s</li>' . "\n",
				$class,
				esc_url( get_pagenum_link( $link ) ),
				sprintf( '%s %s', __( 'Page', 'BTB' ), $link ),
				$link,
				($class == '' ? '' : $se)
		);
	}

	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="on"' : '';
		printf( '<li%s><a href="%s" title="%s">%s</a>%s</li>' . "\n",
				$class,
				esc_url( get_pagenum_link( $max ) ),
				sprintf( '%s %s', __( 'Page', 'BTB' ), $max ),
				$max,
				($class == '' ? '' : $se)
		);
	}

	if( $paged < $max && $max > 1 ) {
		printf( '<li><a href="%s" title="%s">%s</a></li>' . "\n",
			esc_url( get_pagenum_link( $paged + 1 ) ),
			__( 'Page suivante', 'BTB' ),
			__( '→', 'BTB' )
		);
	}

	echo '</ul>' . "\n";
}

?>