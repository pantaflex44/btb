<?php
	$args = array(
        'post_type'         => array( 'news', 'actu' ),
        'post_status'       => 'publish',
        'posts_per_page'    => 1,
        'orderby'           => 'date',
        'order'             => 'DESC'
    );
    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) :
			$the_query->the_post();

			global $first_news_actu_id;
			$first_news_actu_id = get_the_ID();

?>
		<article id="post-<?php the_ID(); ?>">
			<?php if( has_post_thumbnail() ) { ?>
				<a href="<?php echo get_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
					<div class="thumbnail-box">
						<?php the_post_thumbnail( 'top-wide' ); ?>
					</div>
				</a>
			<?php } else { ?>
				<div class="wide-no-thumbnail"></div>
			<?php } ?>
			<div class="article-content">
				<div class="boxed boxedmerge">
					<div style="position: absolute; top: -2.5em; left: 1.0em; background: rgba( 200, 0, 0, 0.90 ); padding: 0.5em; margin: 1.0em; border-radius: 8px; z-index: 999999;">
						<span style="display: block; color: #fff; font-size: 1.0em; font-weight: bold;"><?php echo __( 'Le point d\'exclamation !', 'BTB' ); ?></span>
					</div>
					<a href="<?php echo get_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
						<h2 style="font-size:2.5em;">
							<?php esc_html( the_title() ); ?>
						</h2>
					</a>

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

                    <p class="chapo">
                    	<?php
                    		echo wp_strip_all_tags( get_the_excerpt(), true );
                    	?>
                    </p>

                    <hr class="space" />

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

                                echo sprintf( __( 'Publi??e le %s par %s</span>', 'BTB' ),
                                    sprintf( __( '<a href="%s" class="date" title="%s"><b>%s</b> ?? <b>%s</b></a>', 'BTB' ),
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
				<hr class="space" />
			</div>
		</article>
<?php
		endwhile;
		wp_reset_postdata();
	endif;
?>