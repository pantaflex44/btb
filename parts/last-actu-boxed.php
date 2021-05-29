<?php
	global $first_news_actu_id;
	$args = array(
        'post_type'         => array( 'actu' ),
        'post_status'       => 'publish',
        'posts_per_page'    => 4,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'post__not_in'		=> array( $first_news_actu_id )
    );
    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) :
			$the_query->the_post();

?>
		<article id="post-<?php the_ID(); ?>" style="margin-top: 1.0em; padding-top: 0;">

            <div class="article-content article">
                <div class="boxed">

                    <a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
                        <h2>
                        	<?php
                        		echo get_the_title();
                        	?>
                        </h2>
                    </a>

				<div class="actu-boxed">

                    <?php if( has_post_thumbnail() ) { ?>
					<div class="ab-img">
						<a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
							<?php the_post_thumbnail( '446p' ); ?>
						</a>
					</div>
					<?php } ?>

					<div class="ab-content">
						<p class="chapo">
							<?php
								echo wp_strip_all_tags( get_the_excerpt(), true );
							?>
						</p>
						<div class="meta-box">
							<span class="meta-plus">
								<?php
									echo sprintf( __( '<b>Temps de lecture:</b> %s', 'BTB' ),
										get_reading_time_in_minutes()
									);
								?>
							</span>
							<?php if( get_theme_mod( 'display_views_counter_on_post_list', false ) ) { ?>
							<span class="meta-plus">
								<?php
									$views = get_post_visits();
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
							<hr class="space" />
						</div>
					</div>

				</div>

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
		endwhile;
		wp_reset_postdata();
	endif;
?>