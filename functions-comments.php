<?php

/*******************************************************************************
 * COMMENTS CALLBACK
 ******************************************************************************/
function comments_callback( $comment, $args, $depth ) {
	$tag = ( $args['style'] === 'div' ) ? 'div' : 'li';

	$class_args = get_comment_class( $args['has_children'] ? 'parent' : '', $comment );

	$author['name'] = esc_attr( get_comment_author( $comment ) );
	$author['link'] = get_comment_author_link( $comment );

	$parent_comment = get_comment( $comment->comment_parent );
	$parent_comment_author_link = ( $parent_comment ) ? get_comment_author_link( $parent_comment ) : '';

	echo sprintf( '<%s id="comment-%s" class="%s" style="margin:2.0em auto;margin-left:' . ( $depth > 1 ? '3.0' : '0' ) . 'em;margin-bottom:' . ( $args['has_children'] ? '4.0' : '-1.0' ) . 'em;">',
		$tag,
		get_comment_ID(),
		implode( ' ', $class_args ),
		( ( $depth - 1 < 0 ) ? 0 : $depth - 1 )
	);

		echo '<div id="comment-' . get_comment_ID() . '-body" class="speech-bubble-' . ( $depth > 1 ? 'response' : 'message' ) . '">';
			echo '<div class="speech-bubble-meta">' . sprintf(
				__( 'le %s à %s, %s %s', 'BTB' ),
				get_comment_date( '', $comment ),
				get_comment_time(),
				$author['link'],
				( $depth <= 1 ) ? 'a commenté:' : 'a répondu' . ( $parent_comment_author_link != '' ? ' à ' . $parent_comment_author_link : '' )
			) . '</div>';
			echo '<div class="speech-bubble-content">';
				echo '<div style="position:absolute;right:1%;bottom:1%;font-size:1.5em;color:#ccc;"><i class="far fa-comments"></i></div>';
				if( $comment->comment_approved ) {
					echo '<p>' . wp_strip_all_tags( get_comment_text() ) . '</p>';
				} else {
					echo '<p><span style="font-style: italic;">' . __( 'Commentaire en cours d\'approbation.', 'BTB' ) . '</span></p>';
				}
			echo '</div>';
			echo '<div class="speech-bubble-meta" style="margin-top: 2.0em;">';

				echo '<span>';
				comment_reply_link( array_merge( $args, array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth']
				) ) );
				echo '</span>';

				echo '<span>';
				edit_comment_link( __( 'Modifier ce commentaire', 'BTB' ) );
				echo '</span>';

			echo '</div>';
		echo '</div>';

}

?>