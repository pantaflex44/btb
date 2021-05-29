<div class="boxed">

<?php
	if( comments_open() ) {
?>

            <div class="article-list-header top-separator"  id="comments">
                <div class="article-list-title">
                    <h2><?php echo __( 'Les commentaires', 'BTB' ); ?></h2>
                </div>
                <div class="article-list-numbers">
                    <?php
                        if( get_comments_number() < 1 ) {
                            echo 'Ce contenu n\'a pas encore suscité de réaction';
                        } else {
                            echo sprintf(
                                _n(
                                    __( 'Ce contenu a provoqué %s réaction', 'BTB' ),
                                    __( 'Ce contenu a provoqué %s réactions', 'BTB' ),
                                    ( get_comments_number() > 1 ) ? get_comments_number() : 1,
                                    'BTB'
                                ),
                                get_comments_number()
                            );
                        }
                    ?>
                </div>
            </div>

<?php
        $comment_form_args = array(
            'comment_notes_before'          => __( '<span class="comment-note">Votre adresse email ne sera pas diffusée.</span>', 'BTB' ),
            'comment_notes_after'           => __( '<span class="comment-note">Balises HTML non acceptée.</span>', 'BTB' ),
            'title_reply'                   => __( 'Laisser un commentaire', 'BTB' ),
            'title_reply_to'                => __( 'Répondre à %s', 'BTB' ),
            'cancel_reply_before'           => '',
            'cancel_reply_after'            => '',
            'cancel_reply_link'             => __( 'Annuler', 'BTB' ),
            'label_submit'                  => __( 'Poster le commentaire', 'BTB' ),
            'format'                        => 'html5'

        );

        if( get_comments_number() < 1 ) {

            echo '<div class="comments-closed"><i class="far fa-comment-dots"></i><br />' . __( 'Soyez le premier à commenter ce contenu !', 'BTB' ) . '</div>';

            comment_form( $comment_form_args );

        } else {

            echo '<div class="comments-closed"><a href="#" onclick="scrollToAnchor( \'#respond\' );event.preventDefault();"><i class="far fa-comment-dots"></i><br />' . __( 'Cliquez ici pour laisser un commentaire', 'BTB' ) . '</a></div>';

            echo '<div class="comment-list-box">';
            wp_list_comments( array(
                'style'         => 'div',
                'type'          => 'comment',
                'callback'      => 'comments_callback'
            ) );
            echo '</div>';

			if( get_comment_pages_count() > 1 ) {
				echo '<p class="post-nav-links comm">Commentaires:';
				paginate_comments_links(
					array(
						'prev_text'     => '←',
						'next_text'     => '→',
						'prev_next'     => false
					)
				);
				echo '<p>';
			}

            comment_form( $comment_form_args );

        }

	} else {
		//echo '<div class="comments-closed"><i class="fas fa-comments"></i><br />' . __( 'Les commentaires sont fermés pour ce contenu.', 'BTB' ) . '</div>';
	}
?>

</div>
