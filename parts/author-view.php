<?php
	global $page, $page_title, $paged, $post_per_page, $the_query;

    $startpost = 1;
    $startpost = $post_per_page * ( $paged - 1 ) + 1;
    $endpost = ( $post_per_page * $paged < $the_query->found_posts ? $post_per_page * $paged : $the_query->found_posts );

    $article_counter = $startpost;
    $article_prefix = strlen( strval( intval( $the_query->found_posts ) ) );
    $article_prefix = ( $article_prefix >= 2) ? $article_prefix : 2;
?>
<div class="boxed">

    <div class="article-list-header bottom-separator" style="margin-top:-1.0em;">

	    <?php
	    	$author_infos = [];
		    if( $the_query->have_posts() ) {
			    $author = get_queried_object();
			    if( $author ) {
			    	$author_infos['id'] = $author->ID;
			    	$author_infos['description'] = get_user_meta( $author_infos['id'], 'description', true );
				    $author_infos['registered'] = date_i18n( get_option( 'date_format' ), strtotime( $author->user_registered ) );
				    $author_infos['avatar'] = '<div class="avatar-container large">' . get_avatar(
						$author_infos['id'],
						300,
						get_template_directory_uri() . '/assets/img/default_avatar.png',
						esc_attr( esc_html( $author->display_name ) ),
						array( 'class' => 'avatar' )
					) . '</div>';

				    $lastest_post = get_posts( array( 'post_status' => 'publish', 'post_type' => array( 'post', 'news'), 'author' => $author_infos['id'], 'orderby' => 'date', 'numberposts' => 1 ) );
				    if( count( $lastest_post ) == 1 ) {
				    	$author_infos['last_post_date'] = date_i18n( get_option( 'date_format' ), strtotime( $lastest_post[0]->post_date ) );
				    }

				    set_query_var( 'author_infos', $author_infos );
				}
			}
		?>

        <div class="article-list-title">
        	<?php
	        	if( isset( $author_infos['avatar'] ) && $author_infos['avatar'] != '' ) {
					echo $author_infos['avatar'];
	        	}
        	?>
            <h1>
            	<?php echo ucwords( $author->display_name ); ?>
            </h1>
        </div>

        <div class="article-list-numbers">
            <?php

			    if( isset( $author_infos['registered'] ) && $author_infos['registered'] != '' ) {

			    	echo sprintf(
			    		__( 'Membre depuis le %s', 'BTB' ),
			    		$author_infos['registered']
			    	) . '<br /><br />';

			    	//echo '<div class="author-description">' . $author_infos['description'] . '</div>';

			    }

			    echo sprintf( __( 'A son actif, un total de <b>%s</b>', 'BTB' ), sprintf(
                    _n(
                        __( '%s publication', 'BTB' ),
                        __( '%s publications', 'BTB' ),
                        $the_query->found_posts,
                        'BTB'
                    ),
                    $the_query->found_posts
                ) );

                if( isset( $author_infos['last_post_date'] ) ) {

						echo '<br />' . sprintf( __( 'Sa dernière contribution remonte au %s', 'BTB' ),
								$author_infos['last_post_date']
							);


			    }

            ?>
        </div>

        <div style="line-height:2.0em;font-size:2.0em;position:relative;width:100%;left:50%;-webkit-transform: translateX(-50%);transform: translateX(-50%);margin-top:1.0em;">
            <a style="margin-right:1.0em;" href="<?php echo $author->facebook; ?>" target="_blank" title="Facebook" <?php echo ( $author->facebook == '' ? 'disabled' : '' ); ?>><i class="fab fa-facebook-f zoom-effect"></i></a>
            <a style="margin-right:1.0em;" href="<?php echo $author->twitter; ?>" target="_blank" title="Twitter" <?php echo ( $author->twitter == '' ? 'disabled' : '' ); ?>><i class="fab fa-twitter zoom-effect"></i></a>
            <a style="margin-right:1.0em;" href="<?php echo $author->instagram; ?>" target="_blank" title="Instagram" <?php echo ( $author->instagram == '' ? 'disabled' : '' ); ?>><i class="fab fa-instagram zoom-effect"></i></a>
            <a style="margin-right:1.0em;" href="<?php echo $author->youtube; ?>" target="_blank" title="YouTube" <?php echo ( $author->youtube == '' ? 'disabled' : '' ); ?>><i class="fab fa-youtube zoom-effect"></i></a>
            <a style="margin-right:1.0em;" href="<?php echo $author->linkedin; ?>" target="_blank" title="LinkedIn" <?php echo ( $author->linkedin == '' ? 'disabled' : '' ); ?>><i class="fab fa-linkedin zoom-effect"></i></a>
            <a style="margin-right:1.0em;" href="<?php echo $author->user_url; ?>" target="_blank" title="Site Internet" <?php echo ( $author->user_url == '' ? 'disabled' : '' ); ?>><i class="fas fa-globe-europe zoom-effect"></i></a>
		</div>

    </div>

	<?php
		if( $paged == 1 && isset( $author_infos['id'] ) ) {
			get_template_part( 'parts/best-posts-3-columns-author' );
		}
	?>

    <div class="article-list-header">
        <div class="article-list-title">
            <h2><?php echo __( 'Toutes ses publications', 'BTB' ); ?></h2>
        </div>
    </div>
    <div style="clear:both;height:24px;"></div>

    <?php
        if( $the_query->have_posts() ) :

        	while ( $the_query->have_posts() ) :
        		$the_query->the_post();

				$article_idstring = '#'.str_pad( $article_counter, $article_prefix, '0', STR_PAD_LEFT );

    ?>
        <article id="post-<?php the_ID(); ?>" class="list">

			<?php if( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
                    <span style="display:block;font-size:3em;text-align:right;color:#ddd;margin-bottom:0.5em;"><?php echo $article_idstring; ?></span>
                    <?php the_post_thumbnail( 'large' ); ?>

                </a>
            <?php endif; ?>

            <div class="article-content article">
                <div class="boxed">

                    <a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
                        <h2>
                        	<?php the_title(); ?>
                        </h2>
                    </a>

                    <div class="meta-box">
                    	<span class="meta-plus">
                        	<?php
                        		$postTypeSlug = get_post_type();
                            	$postType = get_post_type_object( $postTypeSlug );
								if( $postType ) {
									$name = esc_html( $postType->labels->singular_name );
									$link = get_post_type_archive_link( $postTypeSlug );
									if( $link ) {
										echo '<a href="'.$link.'" title="'.$name.'">'.$name.'</a>';
									} else {
										echo $name;
									}
								}
                        	?>
                        </span>
                        <span class="meta-plus">
                            <?php
                                echo sprintf( __( '<b>Temps de lecture:</b> %s', 'BTB' ),
                                    get_reading_time_in_minutes( get_the_content() )
                                );
                            ?>
                        </span>
                        <?php if( get_theme_mod( 'display_views_counter_on_post_list', false ) ) { ?>
                        <span class="meta-plus">
                            <?php
                            	$views = get_post_visits( get_the_ID() );
                                echo sprintf(
                                	_n(
                                		__( '<b>Vue:</b> %s', 'BTB' ),
                                		__( '<b>Vues:</b> %s', 'BTB' ),
                                		$views,
                                		'BTB'
                                	),
                                    $views
                                );
                            ?>
                        </span>
                        <?php } ?>
                        <span class="meta-plus">
                            <?php
                                comments_number(
                                    __( '<b>Commentaire:</b> aucun', 'BTB' ),
                                    __( '<b>Commentaire:</b> 1', 'BTB' ),
                                    __( '<b>Commentaires:</b> %', 'BTB' )
                                );
                            ?>
                        </span>
                        <span class="meta-plus">
                            <?php
                                echo sprintf( __( '<b>Note:</b> %s', 'BTB' ), get_rating_star_font( true, get_the_ID() ) );
                            ?>
                        </span>
                        <br />
                        <br />
                    </div>

                    <p class="chapo"><?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?></p>
                    <p>&nbsp;</p>

                    <div class="meta-box">
                        <?php
                            foreach( get_the_category() as $cat )
                                echo '<span class="meta-categorie"><a href="'.get_category_link( $cat->cat_ID ).'" title="'.$cat->cat_name.'">'.$cat->cat_name.'</a></span>';
                        ?>

                        <span class="meta-author">
                            <?php
                            	$author_id = get_the_author_meta( 'ID' );
                            	$author_name = get_the_author_meta( 'display_name' , $author_id );
                            	$author_link = get_author_posts_url( $author_id );

                                echo sprintf( __( 'Publié le %s par %s</span>', 'BTB' ),
                                    sprintf( __( '<a href="%s" class="date" title="%s"><b>%s</b> à <b>%s</b></a>', 'BTB' ),
                                        get_current_post_archive_date_link(),
                                        get_the_date(),
                                        get_the_date(),
                                        get_the_time()
                                    ),
                                    sprintf( __( '<a href="%s" class="date" title="%s"><b>%s</b></a>', 'BTB' ),
                                        $author_link,
                                        $author_name,
                                        $author_name
                                    )
                                );
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </article>
    <?php

    			$article_counter++;

            endwhile;
            wp_reset_postdata();
        else :
            echo _e( 'Aucune publication de ce type n\'a été trouvée.' );
        endif;
    ?>

    <div class="pagination">
        <?php numeric_posts_nav( $the_query, $startpost, $endpost ); ?>
    </div>

</div>
<!-- fin boxed section - liste des articles -->