<?php

/*******************************************************************************
 * COUNT EACH POST VISIT AND UPDATE CUSTUM FIELD
 ******************************************************************************/
function count_post_visits() {
	if( is_single() ) {
		global $post;
		$id = $post->ID;

		if( !isset( $_COOKIE['btbviewedpost'] ) || !isset( $_COOKIE['btbviewedpost']['post' . $id] ) ) {
			$views = get_post_meta( $id, 'post_viewed', true );
			if( $views == '' ) {

				update_post_meta( $id, 'post_viewed', '1' );

			} else {

				$views_no = intval( $views );
				update_post_meta( $id, 'post_viewed', strval( ++$views_no ) );

			}

			setcookie( 'btbviewedpost[post' . $id . ']', date_i18n( get_option( 'date_format' ), current_datetime( 'timestamp' ) ), time() + 31556926 );
		}
	}
}

/*******************************************************************************
 * GET CURRENT POST VISIT COUNTER VALUE
 ******************************************************************************/
function get_post_visits( $id = -1 ) {
	if( $id == -1 ) {
		global $post;
		$id = $post->ID;
	}

	$views = get_post_meta( $id, 'post_viewed', true );
	if( $views == '' ) { $views = '0'; }

	return intval( $views );
}

/*******************************************************************************
 * GET CURRENT POST RATING VALUE
 ******************************************************************************/
function get_post_rating( $id = -1 ) {
	if( $id == -1 ) {
		global $post;
		$id = $post->ID;
	}

	$rate = get_post_meta( $id, 'post_rating', true );
	if( $rate == '' ) { $rate = '0'; }

	return round( round( floatval( $rate ) * 2 ) / 2, 1 );
}

/*******************************************************************************
 * GET CURRENT POST RATTING IMAGES STARS
 ******************************************************************************/
function get_rating_star( $id = -1 ) {
	$value = str_replace( ',', '', str_replace( '.', '', strval( get_post_rating( $id ) ) ) );
	$img = get_template_directory_uri() . '/assets/img/star' . $value . '.png';

	if( !file_exists( $img ) )
		$img = get_template_directory_uri() . '/assets/img/star0.png';

	return $img;
}

/*******************************************************************************
 * GET CURRENT POST RATTING FONTAWESOME STARS
 ******************************************************************************/
function get_rating_star_font( $noclick = false, $id = -1 ) {
	if( $id == -1 ) {
		global $post;
		$id = $post->ID;
	}

	$voted = isset( $_COOKIE['BtbPost' . $id . 'Rating'] );

	$value = get_post_rating( $id );
	$fv = floor( $value );
	$stars = array( 5 );
	for( $i = 0; $i < 5; $i++ )
		$stars[$i] = '<i class="far fa-star"></i>';

	for( $i = 0; $i < $fv; $i++ )
		$stars[$i] = '<i class="fas fa-star"></i>';

	if( ( $value - $fv ) != 0 )
		$stars[ $fv ] = '<i class="fas fa-star-half-alt"></i>';

	$str = '';
	for( $i = 0; $i < count( $stars ); $i++ ) {
		if( $voted || $noclick ) {
			$str .= $stars[$i];
		} else {
			$str .= '<a href="' . esc_url( add_query_arg( array( 'rateValue' => strval( $i + 1 ), 'ratePostId' => strval( $id ) ) ) ) . ( '#post-' . $id ) . '" class="stars" title="' . sprintf( __( 'Attribuer la note: %s/%s', 'BTB' ), $i + 1, count( $stars ) ) . '">' . $stars[$i] . '</a>';
		}
	}

	if( $voted ) {
		$rv = intval( $_COOKIE['BtbPost' . $id . 'Rating'] );
		$str = '<span style="cursor: default; ' . ($noclick ? 'font-size: smaller;' : '' ) . '" title="' . sprintf( __( 'Vous avez déja attribué la note de %s/5', 'BTB' ), $rv ) . '">' . $str . ' <span style="font-size:smaller;">(' . sprintf( __( '%s/5', 'BTB' ), $value ) . ')</span></span>';
	} else {
		$str = '<span style="cursor: default; ' . ($noclick ? 'font-size: smaller;' : '' ) . '" title="' . sprintf( __( '%s/5', 'BTB' ), $value ) . '">' . $str . ' <span style="font-size:smaller;">(' . sprintf( __( '%s/5', 'BTB' ), $value ) . ')</span></span>';
	}

	return $str;
}


/*******************************************************************************
 * UPDATE RATING BY SPECIFIC QUERY ARGS rateValue AND ratePostId
 ******************************************************************************/
function verify_and_set_rating() {
	if ( isset( $_GET['rateValue'] ) && isset( $_GET['ratePostId'] ) ) {
		$rate = intval( $_GET['rateValue'] );
		$postId = intval( $_GET['ratePostId'] );

		$value = get_post_meta( $postId, 'post_rating', true );

		if( $value != '' && !isset( $_COOKIE['BtbPost' . $postId . 'Rating'] ) ) {
			$value = ( intval( $value ) + $rate ) / 2;

			update_post_meta( $postId, 'post_rating', strval( $value ) );

			setCookie( 'BtbPost' . $postId . 'Rating', $rate, time() + 31556926 );

			$url = esc_url( remove_query_arg( array( 'rateValue', 'ratePostId' ) ) );
			wp_redirect( $url );
			exit;
		}
	}

	return false;
}


?>