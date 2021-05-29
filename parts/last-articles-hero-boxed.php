<?php
	$args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 10,
        'orderby'           => 'date',
        'order'             => 'DESC'
    );
    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ) :

		$post_counter = 0;

		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$post_counter++;

?>


<?php if( $post_counter == 1 ) { ?>
	<div class="wide">
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
					<div style="position: absolute; top: -2.5em; left: 1.0em; background: rgba( 0, 100, 150, 0.95 ); padding: 0.5em; margin: 1.0em; border-radius: 8px; z-index: 999999;">
						<span style="display: block; color: #fff; font-size: 1.0em; font-weight: bold;"><?php echo __( 'Le point d\'interrogation ?', 'BTB' ); ?></span>
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

                                echo sprintf( __( 'Publiée le %s par %s</span>', 'BTB' ),
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
	</div>
<?php } else { ?>

	<div class="boxed home">
		<article id="post-<?php the_ID(); ?>" class="list">
			<?php if( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
					<?php the_post_thumbnail( '268p' ); ?>
				</a>
			<?php endif; ?>
            <div class="article-content article">
                <div class="boxed">

                    <a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
                        <h2>
                        	<?php
                        		echo esc_html( get_the_title() );
                        	?>
                        </h2>
                    </a>

                    <div class="meta-box">
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

	</div>


		<?php if( $post_counter == 4 ) { ?>
			<div class="wide hero books">
                <div class="hero-content" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/books.jpg');">
                    <div class="hero-content-filter">
					<?php
						$same_args = array(
							'post_type'			=> 'book',
							'post_status'       => 'publish',
							'posts_per_page'    => ( wp_is_mobile() ? 1 : 4 ),
							'orderby'			=> 'rand'
						);
						$same_query = new WP_Query( $same_args );

						if( $same_query->have_posts() ) :
							while ( $same_query->have_posts() ) :
								$same_query->the_post();
								if( !has_post_thumbnail() ) continue;
					?>
                        <div class="book">
                            <a href="<?php echo esc_attr( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
								<?php the_post_thumbnail( 'large', array( 'class' => 'hero-book-img' ) ); ?>
							</a>
                        </div>
					<?php
							endwhile;
							wp_reset_postdata();
						else:
							echo __( 'Nous n\'avons pas encore ajouté de livres dans la bibliothèque!', 'BTB' );
						endif;
					?>
						<div class="hero-flag">
                            <a href="<?php echo get_home_url() . '/books/'; ?>">Littérature</a>
                        </div>
                        <div class="hero-flag2">
                            <a href="<?php echo get_home_url() . '/books/'; ?>">Tous les bouquins</a>
                        </div>
                    </div>
                </div>
            </div>
		<?php } ?>



<?php } ?>

<?php
		endwhile;
		wp_reset_postdata();
	endif;
?>