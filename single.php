<?php
	get_header();
?>

<?php
	$post_id = -1;

    if (have_posts()) :
        while (have_posts()) : the_post();

        seo_get_article_metadatas();

        $post_id = get_the_ID();
        $terms = wp_get_post_terms( $post_id );
        $terms = !is_wp_error( $terms ) ? $terms : array();

        global $authordata, $page, $numpages, $multipage, $more;

?>

<?php
	$art_img = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : false;
	$art_keywords = false;
	if( get_the_tags() ) {
		$art_keywords = array();
		foreach( get_the_tags() as $tag ) {
			$art_keywords[] = $tag->name;
		}
		$art_keywords = implode( ',', $art_keywords );
	}
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
							<a href="<?php echo get_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
								<h1 style="font-size:3.0em;">
									<?php esc_html( the_title() ); ?>
								</h1>
							</a>
							<?php
								if( $multipage ) {
							?>
							<div class="article-pagination">
								<?php
									echo sprintf(
										'%s %s <span style="font-size:small;">/ %s</span>',
										__( 'page', 'BTB' ),
										$page,
										$numpages
									);
								?>
							</div>
							<?php
								}
							?>

							<div class="meta-box" style="margin: 0; margin-top: 2.0em;">
								<span class="meta-plus">
									<?php
										$postTypeSlug = get_post_type();
										$postType = get_post_type_object( $postTypeSlug );
										if( $postType ) {
											$name = esc_html( $postType->labels->singular_name );
											$link = get_post_type_archive_link( $postTypeSlug );
											if( $link ) {
												echo '<a href="'.$link.'" title="'.$name.'">'.$name.'</a>';
											}
										}
									?>
								</span>
								<span class="meta-plus">
									<?php
										echo sprintf( __( '<b>Temps de lecture:</b> %s', 'BTB' ),
											get_reading_time_in_minutes()
										);
									?>
								</span>
								<?php if( get_theme_mod( 'display_views_counter_on_posts', false ) ) { ?>
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
								<span class="meta-plus">
									<?php
										echo sprintf( __( '<b>Note:</b> %s', 'BTB' ),
											get_rating_star_font(),
											get_post_rating()
										);
									?>
								</span>
							</div>
							<div class="meta-box" style="margin: 0;">
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

							<div class="columns">

								<div class="column column75">

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

									<?php
										if( get_theme_mod( 'view_toc', true )
											&& get_post_meta( $post->ID, 'view_toc_checkbox', true ) == 'yes' ) {
									?>
									<div class="headings-box" style="margin: 0; padding: 0; width: 100%; margin-bottom: 2.0em;">
										<div class="head" onclick="toggleHeadingsBox( this );">
											<span><?php echo __( 'Au sommaire ...', 'BTB' ); ?></span>
											<i class="fas fa-chevron-down"></i>
										</div>
										<div class="content">
											<div class="single-toc-container">
												<?php echo get_toc( get_the_ID() ); ?>
											</div>
										</div>
									</div>
									<?php } ?>



									<div class="entry-content">
										<?php
											global $more;
											$more = 0;
											echo '<div class="excerpt">' . get_the_content( '' ) . '</div>';
											$more = 1;

											$content = get_the_content( null, true );
											$content = apply_filters( 'the_content', $content );
											$paragraphs = explode('</p>', $content);

											$paragraphs_count = count( $paragraphs );
											if( $paragraphs_count > 8 )
												$paragraphs_count = 8;

											$middle = floor( $paragraphs_count / 2 );
											if( $middle > 0 && $page >= 1 ) {
												$ts = [];
												foreach( $terms as $term )
													$ts[] = $term->term_id;

												if( count( $ts ) > 0 ) {
													$terms_args = array(
														'post_type'         => array( 'post', 'news', 'actu' ),
														'post__not_in' 		=> array( $post_id ),
														'post_status'       => 'publish',
														'posts_per_page'    => 1,
														'orderby'           => 'rand',
														'tax_query' => array(
															array(
																'taxonomy'  => 'post_tag',
																'field'     => 'term_id',
																'terms'     => $ts,
															)
														)
													);
													$terms_query = new WP_Query( $terms_args );
													if( $terms_query->have_posts() ) :
														while ( $terms_query->have_posts() ) :
															$terms_query->the_post();

															array_splice( $paragraphs, $middle, 0, array( '<p>&nbsp;</p><div class="same-topic"><span>' . __( 'Sur le même sujet', 'BTB' ) . '</span><a target="_blank" href="' . get_the_permalink() . '" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</a></div><p>&nbsp;</p>' ) );

														endwhile;
														wp_reset_postdata();
													endif;
												}
											}

											echo implode( '</p>', $paragraphs );

											if( $page == $numpages ) {

												//echo '<p><span class="author-sign">' . get_the_author() . '</span></p>';
												echo '<p><a class="author-sign" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . esc_attr( get_the_author() ) . '">';
												echo ucwords( esc_html( get_the_author() ) );
												echo '</a></p>';

												$sources_list = array();
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source1_title', true ), 'url' => get_post_meta( $post_id, 'source1_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source2_title', true ), 'url' => get_post_meta( $post_id, 'source2_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source3_title', true ), 'url' => get_post_meta( $post_id, 'source3_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source4_title', true ), 'url' => get_post_meta( $post_id, 'source4_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source5_title', true ), 'url' => get_post_meta( $post_id, 'source5_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source6_title', true ), 'url' => get_post_meta( $post_id, 'source6_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source7_title', true ), 'url' => get_post_meta( $post_id, 'source7_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source8_title', true ), 'url' => get_post_meta( $post_id, 'source8_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source9_title', true ), 'url' => get_post_meta( $post_id, 'source9_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source10_title', true ), 'url' => get_post_meta( $post_id, 'source10_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source11_title', true ), 'url' => get_post_meta( $post_id, 'source11_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source12_title', true ), 'url' => get_post_meta( $post_id, 'source12_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source13_title', true ), 'url' => get_post_meta( $post_id, 'source13_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source14_title', true ), 'url' => get_post_meta( $post_id, 'source14_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source15_title', true ), 'url' => get_post_meta( $post_id, 'source15_url', true ) );
												$sources_list[] = array( 'title' => get_post_meta( $post_id, 'source16_title', true ), 'url' => get_post_meta( $post_id, 'source16_url', true ) );

												$links = '';
												foreach( $sources_list as $sources ) {
														$title = trim( !$sources['title'] ? '' : $sources['title'] );
														$link = trim( !$sources['url'] ? '' : $sources['url'] );

														if( $link != '' ) {
															$title = $title == '' ? $link : $title;
															$links .= '<p><span>' . esc_html( $title ) . ':</span><a href="' . esc_url( $link ) . '" title="' . esc_attr( $title ) . '">' . esc_url( $link ) . '</a></p>';
														}
												}
												if( $links != '' ) {
													echo '<div class="sources">';
													echo '<h4>' . __( 'Sources / En savoir plus', 'BTB' ) . '</h4>';
													echo $links;
													echo '</div>';
												}



											}
										?>
									</div>
									<div style="width:100%;">
										<?php if( $multipage ) { wp_link_pages(); } ?>
									</div>
								</div>

								<div class="column column25">

									<div class="single-box">
										<?php
											echo '<div class="avatar-container">' . get_avatar(
												$authordata->ID,
												72,
												get_template_directory_uri() . '/assets/img/default_avatar.png',
												esc_attr( get_the_author() ),
												array( 'class' => 'avatar' )
											) . '</div>';
										?>
										<div class="author">
											<h3>
												<a href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
													<?php echo ucwords( esc_html( get_the_author() ) ); ?>
												</a>
											</h3>
											<div class="description">
												<?php echo get_the_author_meta( 'description' ); ?>
											</div>
											<div class="last-post">
												<h3><?php echo __( 'Du même auteur', 'BTB' ); ?></h3>
												<?php
													$author_args = array(
														'post_type'			=> array( 'actu', 'news', 'post' ),
														'author__in'		=> array( $authordata->ID ),
														'post_status'       => 'publish',
														'posts_per_page'    => 5,
														'orderby'			=> 'date',
														'order'				=> 'DESC'
													);
													$author_query = new WP_Query( $author_args );
													if( $author_query->have_posts() ) :
														while ( $author_query->have_posts() ) :
															$author_query->the_post();
												?>
												<a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>"><?php the_title(); ?></a>
												<?php
														endwhile;
														wp_reset_postdata();
													endif;
												?>
												<div>
													<a href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php echo __( 'Toutes ses contributions', 'BTB' ); ?>"><?php echo __( 'Toutes ses contributions', 'BTB' ); ?></a>
												</div>
											</div>
										</div>
									</div>

									<div class="single-box blank">
										<div class="last-post cats">
											<h3><?php echo __( 'Catégories relatives', 'BTB' ); ?></h3>
											<?php
												foreach( get_the_category() as $cat ) {
													$c_ts = get_terms( array(
														'taxonomy'		=> 'category',
														'orderby'		=> 'count',
														'name__like'	=> $cat->cat_name
													));
													$c = 0;
													if( !is_wp_error( $c_ts ) && is_array( $c_ts ) )
														foreach( $c_ts as $c_t )
															$c += $c_t->count;

													echo '<a class="term" href="' . get_category_link( $cat->cat_ID ) . '" title="' . esc_attr( $cat->cat_name ) . '">' . esc_html( $cat->cat_name ) . '</a>';
													echo '<span>';
														echo sprintf( __( '%s %s', 'BTB' ),
															$c,
															_n(
																'publication',
																'publications',
																( $c < 2 ? 1 : $c ),
																'BTB'
															)
														);
													echo '</span>';
												}
											?>
										</div>
									</div>

									<div class="single-box blank">
										<div class="last-post tags">
											<h3><?php echo __( 'Les points abordés', 'BTB' ); ?></h3>
											<?php
												if( is_array( $terms ) && count( $terms ) > 0 ) {
													foreach( $terms as $term ) {
														$c_ts = get_terms( array(
															'taxonomy'		=> 'post_tag',
															'orderby'		=> 'count',
															'name__like'	=> $term->name
														));
														$c = 0;
														if( !is_wp_error( $c_ts ) && is_array( $c_ts ) )
															foreach( $c_ts as $c_t )
																$c += $c_t->count;

														$link = get_term_link( $term );

														echo '<a class="term" href="' . $link . '" title="' . esc_attr( $term->name ) . '">' . esc_html( $term->name ) . '</a>';
														echo '<span>';
															echo sprintf( __( 'sujet abordé %s fois', 'BTB' ),
																$c
															);
														echo '</span>';
													}
												} else {
													echo '<span style="font-size: small; color: #555;">' . __( 'aucuns points précis!', 'BTB' ) . '</span>';
												}
											?>
										</div>
									</div>

									<?php if( $post_id > -1 ) { ?>
									<div class="single-box blank">
										<div class="last-post">
											<h3><?php echo __( 'Lire aussi', 'BTB' ); ?></h3>
											<?php
												$cat_id = wp_get_post_categories( $post_id );
												$author_args = array(
													'post_type'			=> array( 'actu', 'news', 'post' ),
													'category__in' 		=> $cat_id,
													'post__not_in' 		=> array( $post_id ),
													'post_status'       => 'publish',
													'posts_per_page'    => 5,
													'orderby'			=> 'date',
													'order'				=> 'DESC',
												);
												$author_query = new WP_Query( $author_args );
												if( $author_query->have_posts() ) :
													while ( $author_query->have_posts() ) :
														$author_query->the_post();
											?>

											<a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>"><?php the_title(); ?></a>

											<span>
												<?php
													echo sprintf( __( 'par %s', 'BTB' ),
														ucwords( esc_html( get_the_author() ) )
													);
												?>
											</span>

											<?php
													endwhile;
													wp_reset_postdata();
												endif;
											?>
											<div>
												<a href="<?php echo get_category_link( $cat_id ); ?>" title="<?php echo __( 'Dans la même catégorie', 'BTB' ); ?>"><?php echo __( 'Dans la même catégorie', 'BTB' ); ?></a>
											</div>
										</div>
									</div>
									<?php } ?>


								</div>

							</div>

		                </div>
		            </div>
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