<?php
	get_header();
?>

<?php
    if (have_posts()) :
        while (have_posts()) : the_post();

        $post_id = get_the_ID();
        $terms = wp_get_post_terms( $post_id );
        $terms = !is_wp_error( $terms ) ? $terms : array();

        global $authordata, $page, $numpages, $multipage, $more;
?>

			<div class="wide">
		        <article>
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
							<div class="meta-box" style="margin: 0;">
								<?php if( get_theme_mod( 'display_views_counter_on_posts', false ) ) { ?>
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
										echo sprintf( __( 'Publiée le %s', 'BTB' ),
											sprintf( __( '<a href="%s" class="date" title="%s">%s à %s</a>', 'BTB' ),
												get_current_post_archive_date_link(),
												get_the_date(),
												get_the_date(),
												get_the_time()
											)
										);
									?>
								</span>
								<span class="meta-plus">
									<?php
										echo sprintf( __( 'Modifiée le %s', 'BTB' ),
											get_the_modified_date()
										);
									?>
								</span>
							</div>

							<hr class="space" />
		                    <div style="height:24px;"></div>

							<div class="share-container">
								<div class="share">
									<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo esc_html( get_the_title() ); ?>&url=<?php echo esc_url( get_the_permalink() ); ?>&via=<?php echo get_theme_mod( 'twitter_username' ); ?>" title="<?php echo __( 'Partager sur Tweeter', 'BTB' ); ?>">
										<i class="fab fa-twitter"></i>
										<span>Partager sur twitter</span>
									</a>
									<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_the_permalink() ); ?>&t=<?php echo esc_html( get_the_title() ); ?>" title="<?php echo __( 'Partager sur Facebook', 'BTB' ); ?>">
										<i class="fab fa-facebook-f"></i>
										<span>Partager sur facebook</span>
									</a>
									<a target="_blank" href="mailto:?subject=<?php echo esc_html( get_the_title() ); ?>body=<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo __( 'Partager par email', 'BTB' ); ?>">
										<i class="fas fa-envelope-open-text"></i>
										<span>Par email</span>
									</a>
									<a href="javascript: window.print();" title="<?php echo __( 'Imprimer', 'BTB' ); ?>">
										<i class="fas fa-print"></i>
										<span>Imprimer</span>
									</a>
								</div>
							</div>
							<hr />

							<hr class="space" />
		                    <div style="height:24px;"></div>

							<div class="columns" >
								<div class="column column13 book">
									<div class="book-cover">
										<?php the_post_thumbnail( 'large-book-cover', array( 'class' => 'book-cover-img' ) ); ?>
									</div>
									<div class="book-ref">
										<?php
											$isbn10 = trim( get_post_meta( $post_id, 'book_isbn10', true ) );
											$isbn13 = trim( get_post_meta( $post_id, 'book_isbn13', true ) );
											$asin = trim( get_post_meta( $post_id, 'book_asin', true ) );
											if( $isbn10 != '' )
												echo '<span>ISBN10: <a href="https://www.abebooks.fr/servlet/SearchResults?pics=on&sortby=0&sts=t&an=' . $isbn10 . '" target="_blank">' . $isbn10 . '</a></span>';
											if( $isbn13 != '' )
												echo '<span>ISBN13: <a href="https://www.abebooks.fr/servlet/SearchResults?pics=on&sortby=0&sts=t&an=' . $isbn13 . '" target="_blank">' . $isbn13 . '</a></span>';
											if( $asin != '' )
												echo '<span>ASIN: <a href="https://www.amazon.fr/s?k=ASIN%3A+' . $asin . '" target="_blank">' . $asin . '</a></span>';
										?>
									</div>

									<div class="single-box" style="margin:0;margin-top:2.0em;">
										<h4><?php echo __( 'Acheter en ligne', 'BTB' ); ?></h4>
										<?php
											$lalibrairiecom = esc_url( trim( get_post_meta( $post_id, 'book_lalibrairie_link', true ) ) );
											$rakuten = esc_url( trim( get_post_meta( $post_id, 'book_rakuten_link', true ) ) );
											if( $lalibrairiecom != '' )
												echo '<div class="book-vendor"><a href="' . $lalibrairiecom . '" target="_blank" title="LaLibrairie.com"><img alt="LaLibrairie.com" src="' . get_template_directory_uri() . '/assets/img/lalibrairiecom.jpg" style="width:250px;height:88px;" class="zoom-effect-small" /></a></div>';
											if( $rakuten != '' )
												echo '<div class="book-vendor"><a href="' . $rakuten . '" target="_blank" title="Rakuten"><img alt="Rakuten" src="' . get_template_directory_uri() . '/assets/img/rakuten.png" style="width:250px;height:88px;" class="zoom-effect-small" /></a></div>';
										?>
									</div>
									<hr class="space" />

									<?php
										foreach( get_the_category() as $cat ) {
									?>
									<div class="single-box blank" style="margin:0;">
										<div class="last-post">
											<h3><?php echo esc_html( $cat->name ); ?></h3>
											<?php
													$cat_args = array(
														'post_type'			=> 'book',
														'category__in' 		=> array( $cat->cat_ID ),
														'post__not_in' 		=> array( $post_id ),
														'post_status'       => 'publish',
														'posts_per_page'    => 3,
														'orderby'			=> 'rand'
													);
													$cat_query = new WP_Query( $cat_args );
													if( $cat_query->have_posts() ) :
														while ( $cat_query->have_posts() ) :
															$cat_query->the_post();
											?>
											<a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>"><?php the_title(); ?></a>
											<span>
												<?php
													echo sprintf( __( 'chez %s', 'BTB' ),
														esc_html( get_post_meta( get_the_ID(), 'book_editor', true ) )
													);
												?>
											</span>
											<?php
														endwhile;
														wp_reset_postdata();
													endif;
											?>
											<div>
												<a href="<?php echo get_permalink( get_page_by_path( 'books' ) ) . 'date-desc/' . $cat->category_nicename . '/'; ?>" title="<?php echo __( 'Dans la même catégorie', 'BTB' ); ?>"><?php echo __( 'Dans la même catégorie', 'BTB' ); ?></a>
											</div>
										</div>
									</div>
									<?php
										}
									?>


								</div>
								<div class="column column23 book">
									<div class="book-content">
										<span class="book-title">
											<h1 style="margin-top: 0;width:100%;font-size:1.8em;"><?php echo esc_html( get_post_meta( $post_id, 'book_title', true ) ); ?></h1>
										</span>
										<span class="book-author">
											<?php
												$author = get_post_meta( $post_id, 'book_author', true );
												$term = get_term_by( 'name', $author, 'post_tag' );
												if( is_wp_error( $term ) || !$term ) {
													echo __( 'de', 'BTB' ) . ' ' . esc_html( $author );
												} else {
													echo __( 'de', 'BTB' ) . ' <a href="' . esc_url( get_term_link( $term ) ) . '" title="' . esc_attr( $author ) . '">' . esc_html( $author ) . '</a>';
												}
											?>
										</span>
										<span class="book-editor">
											<?php
												$editor = get_post_meta( $post_id, 'book_editor', true );
												$term = get_term_by( 'name', $editor, 'post_tag' );
												if( is_wp_error( $term ) || !$term ) {
													echo __( 'chez', 'BTB' ) . esc_html( $editor );
												} else {
													echo __( 'chez', 'BTB' ) . ' <a href="' . esc_url( get_term_link( $term ) ) . '" title="' . esc_attr( $editor ) . '">' . esc_html( $editor ) . '</a>';
												}
											?>
										</span>
										<div class="meta-box">
											<span class="meta-plus">
												<?php
													echo sprintf( __( 'Livre publié le %s', 'BTB' ),
														date_i18n( get_option( 'date_format' ), strtotime( get_post_meta( $post_id, 'book_date', true ) ) )
													);
												?>
											</span>
											<span class="meta-plus">
												<?php
													$nbp = intval( get_post_meta( $post_id, 'book_pagecount', true ) );
													echo _n(
														sprintf( __( 'Formé de %s page', 'BTB' ), $nbp ),
														sprintf( __( 'Formé de %s pages', 'BTB' ), $nbp ),
														( $nbp < 2 ? 1 : $nbp ),
														'BTB'
													);
												?>
											</span>
											<span class="meta-plus">
												<?php
													echo sprintf( __( 'Note des lecteurs: %s', 'BTB' ),
														get_rating_star_font( false, get_the_ID() )
													);
												?>
											</span>
										</div>
										<hr class="space middle" />
										<div class="entry-content">
											<?php
												$book_redac = trim( get_the_content() );
												$book_redac = apply_filters( 'the_content', $book_redac );

												$book_excerpt = esc_html( trim( get_post_meta( $post_id, 'book_excerpt', true ) ) );
												$book_editor = esc_html( trim( get_post_meta( $post_id, 'book_editor_text', true ) ) );
												$book_author = esc_html( trim( get_post_meta( $post_id, 'book_author_bio', true ) ) );

												if( $book_redac != '' ) {
													echo '<h2>' . __( 'Le mot de la rédaction', 'BTB' ) . '</h2>';
													echo '<span class="book-info">' . $book_redac . '</span>';
												}
												if( $book_excerpt != '' ) {
													echo '<h2>' . __( 'Résumé de l\'oeuvre', 'BTB' ) . '</h2>';
													echo '<span class="book-info"><p>' . $book_excerpt . '</p></span>';
												}
												if( $book_editor != '' ) {
													echo '<h2>' . __( 'L\'éditeur vous en parle', 'BTB' ) . '</h2>';
													echo '<span class="book-info"><p>' . $book_editor . '</p></span>';
												}
												if( $book_author != '' ) {
													echo '<h2>' . __( 'Biographie de l\'auteur', 'BTB' ) . '</h2>';
													echo '<span class="book-info"><p>' . $book_author . '</p></span>';
												}
											?>
										</div>


									</div>
								</div>
							</div> <!-- fin columns -->

							<div class="single-box blank same-book" style="margin:0;padding:0;margin-top:4.0em;border-bottom:none;width:100%;">
								<h4 style="color: #555;"><?php echo sprintf( __( 'Dans la bibliothèque, retrouvez d\'autres oeuvres de %s', 'BTB' ), get_post_meta( $post_id, 'book_author', true ) ); ?></h4>
								<hr style="margin:0;width:100%;" />
								<div class="books-same-author-container">
									<div class="columns">
									<?php
										$same_args = array(
											'post_type'			=> 'book',
											'post__not_in' 		=> array( $post_id ),
											'post_status'       => 'publish',
											'posts_per_page'    => ( wp_is_mobile() ? 1 : 4 ),
											'orderby'			=> 'rand',
											'tax_query' => array(
												array(
													'taxonomy'	=> 'post_tag',
													'field'		=> 'name',
													'terms'		=> array( get_post_meta( $post_id, 'book_author', true ) ),
												),
											)
										);
										$same_query = new WP_Query( $same_args );

										if( $same_query->have_posts() ) :
											while ( $same_query->have_posts() ) :
												$same_query->the_post();
									?>
										<div class="column column25">
											<div style="width:100%;text-align:center;font-size:1.0em;">
												<div>
													<a style="font-size:1.0em;" href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
														<div class="book-cover">
															<?php the_post_thumbnail( 'normal-book-cover', array( 'class' => 'book-same-author-img' ) ); ?>
														</div>
														<?php the_title(); ?>
													</a>
													<span style="display:block;font-size:small;">
														<?php
															echo sprintf( __( 'chez %s', 'BTB' ),
																esc_html( get_post_meta( get_the_ID(), 'book_editor', true ) )
															);
														?>
													</span>
												</div>
											</div>
										</div>
									<?php
											endwhile;
											wp_reset_postdata();
										else:
											echo __( 'Nous n\'avons pas encore ajouté d\'autres oeuvres de cet auteur dans la bibliothèque!', 'BTB' );
										endif;
									?>
									</div>
								</div>
							</div>

		                </div> <!-- fin boxed boxedmerge -->
		            </div> <!-- fin article-content -->
		        </article>
			</div> <!-- fin section wide -->

<?php
        endwhile;
	endif;
?>

<?php
	comments_template();

	get_footer();
?>