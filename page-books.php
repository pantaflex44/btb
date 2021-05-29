<?php
	get_header();

	global $wp_query, $numpages, $multipage, $more;


	$q_by = 'date-desc';
	if( isset( $wp_query->query_vars['by'] ) )
		$q_by = trim( strip_tags( $wp_query->query_vars['by'] ) );
	$order_by = 'date';
	$order = 'DESC';
	$q_by_array = explode( '-', $q_by );
	if( count( $q_by_array ) == 2 ) {
		$q_by_array[0] = trim( strtolower( $q_by_array[0] ) );
		if( $q_by_array[0] == 'name' || $q_by_array[0] == 'rand' )
			$order_by = $q_by_array[0];
		else
			$order_by = 'date';
		$q_by_array[1] = trim( strtolower( $q_by_array[1] ) );
		if( $q_by_array[1] == 'asc' )
			$order = 'ASC';
		else
			$order = 'DESC';
	}
	if( $order_by == 'rand' )
		$order = '';

	$q_category = '';
	if( isset( $wp_query->query_vars['category'] ) )
		$q_category = trim( strip_tags( $wp_query->query_vars['category'] ) );
	$fcid_cat = get_term_by( 'slug', $q_category, 'category' );
	$fcid = 0;
	if( $fcid_cat ) {
		_make_cat_compat( $fcid_cat );
		$fcid = $fcid_cat->cat_ID;
	}


	$page = get_page_by_path( 'books', 'OBJECT', 'page' );
	$page_title = get_the_title( $page->ID );
	if( $fcid_cat && !is_wp_error( $fcid_cat ) )
		$page_title = $fcid_cat->name;

	$paged = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
	$post_per_page = wp_is_mobile() ? 6 : 12;
	$args = array(
		'post_type'         => array( 'book' ),
		'post_status'       => 'publish',
		'posts_per_page'    => $post_per_page,
		'orderby'           => $order_by,
		'order'             => $order,
		'paged'             => $paged
	);
	if( $fcid > 0 )
		$args['category__in'] = array( strval( $fcid ) );

	$the_query = new WP_Query( $args );

	$startpost = 1;
	$startpost = $post_per_page * ( $paged - 1 ) + 1;
	$endpost = ( $post_per_page * $paged < $the_query->found_posts ? $post_per_page * $paged : $the_query->found_posts );
?>

<div class="boxed">
    <div class="article-list-header bottom-separator" style="margin-top:1.0em;">
        <div class="article-list-title">
            <h1>
            	<?php echo $page_title; ?>
            </h1>
        </div>
        <div class="article-list-numbers">
            <?php
				echo sprintf(
					_n(
						__( 'contient %s livre', 'BTB' ),
						__( 'contient %s livres', 'BTB' ),
						( $the_query->found_posts < 2 ? 1 : $the_query->found_posts ),
						'BTB'
					),
					$the_query->found_posts
				);
            ?>
        </div>
    </div>
</div>

<?php
    if (have_posts()) :
        while (have_posts()) : the_post();
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
			<div class="thumbnail-box">
				<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" style="width: 100%; height: auto;" src="<?php echo get_template_directory_uri(); ?>/assets/img/page-books.jpg" />
			</div>
		<?php } ?>

		<div class="article-content">
			<div class="boxed boxedmerge">
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
				<div style="height:48px;"></div>
				<?php
					}
				?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

				<div class="columns" style="margin-top: 1.0em;">

					<div class="column column13 book-list-sidebar">

						<div class="single-box book">
							<div class="book-categories">
								<h3><?php echo __( 'Naviguer dans les rayons', 'BTB' ); ?></h3>
								<ul class="cpt-cat-header">
									<li class="cpt-cat">
										<span class="cat-content">
											<a class="<?php if( !$fcid_cat || is_wp_error( $fcid_cat ) ) { echo 'current-cat'; } ?>" href="<?php echo get_permalink( get_page_by_path( 'books' ) ) . ( strtolower( $order_by ) ) . '-' . ( strtolower( $order ) ) . '/'; ?>" title="<?php echo __( 'Toute la bibliothèque', 'BTB' ); ?>"><span><?php echo __( 'Toute la bibliothèque', 'BTB' ); ?></span></a>
										</span>
										<?php cpt_categories_tree_view( get_cpt_categories( 'book', true, true ) ); ?>
									</li>
								</ul>
							</div>
							<div class="book-order">
								<div class="book-order-choice">
									<!-- by date -->
									<a <?php echo ( $order_by == 'date' && strtoupper( $order ) == 'ASC' ? 'class="current-choice"' : '' ); ?> href="<?php echo get_permalink( get_page_by_path( 'books' ) ) . 'date-asc' . ( $fcid_cat ? '/' . $fcid_cat->slug : '' ) . '/'; ?>" title="<?php echo __( 'Par date', 'BTB' ); ?>"><span><i class="fas fa-sort-amount-down-alt"></i></span></a>
									<a <?php echo ( $order_by == 'date' && strtoupper( $order ) == 'DESC' ? 'class="current-choice"' : '' ); ?> href="<?php echo get_permalink( get_page_by_path( 'books' ) ) . 'date-desc' . ( $fcid_cat ? '/' . $fcid_cat->slug : '' ) . '/'; ?>" title="<?php echo __( 'Par date', 'BTB' ); ?>"><span><i class="fas fa-sort-amount-down"></i></span></a>
									<!-- by name -->
									<a <?php echo ( $order_by == 'name' && strtoupper( $order ) == 'ASC' ? 'class="current-choice"' : '' ); ?> href="<?php echo get_permalink( get_page_by_path( 'books' ) ) . 'name-asc' . ( $fcid_cat ? '/' . $fcid_cat->slug : '' ) . '/'; ?>" title="<?php echo __( 'Par ordre alphabétique', 'BTB' ); ?>"><span><i class="fas fa-sort-alpha-down"></i></span></a>
									<a <?php echo ( $order_by == 'name' && strtoupper( $order ) == 'DESC' ? 'class="current-choice"' : '' ); ?> href="<?php echo get_permalink( get_page_by_path( 'books' ) ) . 'name-desc' . ( $fcid_cat ? '/' . $fcid_cat->slug : '' ) . '/'; ?>" title="<?php echo __( 'Par ordre alphabétique', 'BTB' ); ?>"><span><i class="fas fa-sort-alpha-down-alt"></i></span></a>
									<!-- randomly -->
									<a <?php echo ( $order_by == 'rand' ? 'class="current-choice"' : '' ); ?> href="<?php echo get_permalink( get_page_by_path( 'books' ) ) . 'rand-' . strtolower( $order ) . ( $fcid_cat ? '/' . $fcid_cat->slug : '' ) . '/'; ?>" title="<?php echo __( 'Par ordre alphabétique', 'BTB' ); ?>"><span><i class="fas fa-random"></i></span></a>
								</div>
							</div>
						</div>

						<div class="single-box blank book-author">
							<h4><?php echo __( 'A la découverte de...', 'BTB' ); ?></h4>
							<?php
								$random_author = get_random_book_author();
								if( $random_author ) {
							?>
							<div style="font-size: smaller; font-weight: bold; width: 100%; text-align: center; margin-top: 1.5em;">
								<?php
									$term = get_term_by( 'name', $random_author['author'], 'post_tag' );
									if( is_wp_error( $term ) || !$term ) {
										echo esc_html( $random_author['author'] );
									} else {
										echo '<a href="' . esc_url( get_term_link( $term ) ) . '" title="' . esc_attr( $random_author['author'] ) . '">' . esc_html( $random_author['author'] ) . '</a>';
									}
								?>
							</div>
							<div style="font-size: small; margin-top: 1.0em;">
									<?php echo esc_html( $random_author['author_bio'] ); ?>
								</div>
							<?php } ?>
						</div>

						<div class="single-box blank book-random">
							<h4><?php echo __( 'Au hasard d\'une oeuvre', 'BTB' ); ?></h4>
							<?php
								$random_book = get_random_book( 'small' );
								if( $random_book ) {
							?>
							<div style="font-size: smaller; font-weight: bold; width: 100%; text-align: center; margin-top: 1.5em;">
								<a href="<?php echo esc_attr( $random_book['permalink'] ); ?>" title="<?php echo esc_attr( $random_book['title'] ); ?>">
									<?php echo esc_html( $random_book['title'] ); ?>
								</a>
							</div>
							<div class="columns" style="justify-content: center; margin-top: 0.5em;">
								<div class="column column50">
									<div style="padding: 0.5em;">
										<?php echo $random_book['thumbnail']; ?>
									</div>
									<div style="font-size: smaller; margin: 0em 0.5em;">
										<div class="book-list-meta">
											<span class="book-author">
												<?php
													$term = get_term_by( 'name', $random_book['author'], 'post_tag' );
													if( is_wp_error( $term ) || !$term ) {
														echo __( 'de', 'BTB' ) . ' ' . esc_html( $random_book['author'] );
													} else {
														echo __( 'de', 'BTB' ) . ' <a href="' . esc_url( get_term_link( $term ) ) . '" title="' . esc_attr( $random_book['author'] ) . '">' . esc_html( $random_book['author'] ) . '</a>';
													}
												?>
											</span>
											<span class="book-editor">
												<?php
													$term = get_term_by( 'name', $random_book['editor'], 'post_tag' );
													if( is_wp_error( $term ) || !$term ) {
														echo __( 'chez', 'BTB' ) . esc_html( $random_book['editor'] );
													} else {
														echo __( 'chez', 'BTB' ) . ' <a href="' . esc_url( get_term_link( $term ) ) . '" title="' . esc_attr( $random_book['editor'] ) . '">' . esc_html( $random_book['editor'] ) . '</a>';
													}
												?>
											</span>
										</div>
										<div class="book-list-meta">
											<span class="book-editor">
												<?php
													echo sprintf( __( 'Publié le %s', 'BTB' ),
														date_i18n( get_option( 'date_format' ), strtotime( $random_book['date'] ) )
													);
												?>
											</span>
											<span class="book-editor">
												<?php
													echo _n(
														sprintf( __( '%s page', 'BTB' ), $random_book['pagecount'] ),
														sprintf( __( '%s pages', 'BTB' ), $random_book['pagecount'] ),
														( $random_book['pagecount'] < 2 ? 1 : $random_book['pagecount'] ),
														'BTB'
													);
												?>
											</span>
										</div>
									</div>
								</div>
								<div class="column column50">
									<div style="font-size: small; margin-top: 0.5em;">
										<?php echo esc_html( $random_book['excerpt'] ); ?>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>


					</div>

					<div class="column column23">
						<div class="pagination" style="margin-top: 0; margin-bottom: 3.0em; width: 90%;">
							<?php numeric_posts_nav( $the_query, $startpost, $endpost ); ?>
						</div>

						<?php
							if( $the_query->have_posts() ) :
								echo '<div class="columns book">';

								while ( $the_query->have_posts() ) :
									$the_query->the_post();
						?>
							<div class="column column25 book">
								<div class="single-box blank book-list" style="margin: 0em;">
									<div>
										<a href="<?php echo get_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
											<div class="book-list-img">
												<?php the_post_thumbnail( 'small-book-cover', array( 'class' => 'zoom-effect-small' ) ); ?>
											</div>
											<span class="book-list-title"><?php echo esc_html( get_post_meta( get_the_ID(), 'book_title', true ) ); ?></span>
										</a>
									</div>
									<div class="book-list-meta">
										<span class="book-author">
											<?php
												$author = get_post_meta( get_the_ID(), 'book_author', true );
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
												$editor = get_post_meta( get_the_ID(), 'book_editor', true );
												$term = get_term_by( 'name', $editor, 'post_tag' );
												if( is_wp_error( $term ) || !$term ) {
													echo __( 'chez', 'BTB' ) . esc_html( $editor );
												} else {
													echo __( 'chez', 'BTB' ) . ' <a href="' . esc_url( get_term_link( $term ) ) . '" title="' . esc_attr( $editor ) . '">' . esc_html( $editor ) . '</a>';
												}
											?>
										</span>
									</div>
									<div class="book-list-meta">
										<span class="book-editor">
											<?php
												echo sprintf( __( 'Publié le %s', 'BTB' ),
													date_i18n( get_option( 'date_format' ), strtotime( get_post_meta( get_the_ID(), 'book_date', true ) ) )
												);
											?>
										</span>
										<span class="book-editor">
											<?php
												$nbp = intval( get_post_meta( get_the_ID(), 'book_pagecount', true ) );
												echo _n(
													sprintf( __( '%s page', 'BTB' ), $nbp ),
													sprintf( __( '%s pages', 'BTB' ), $nbp ),
													( $nbp < 2 ? 1 : $nbp ),
													'BTB'
												);
											?>
										</span>
									</div>
									<div class="book-list-meta">
										<span class="book-editor">
											<?php
												echo sprintf( __( 'Note: %s', 'BTB' ),
													get_rating_star_font( true, get_the_ID() )
												);
											?>
										</span>
									</div>


								</div>
							</div>
						<?php
								endwhile;
								wp_reset_postdata();

								echo '</div>';
							else :
								echo '<div style="font-size: 1.0em; width: 100%; text-align: center;">' . __( 'Aucune publication de ce type n\'a été trouvée.', 'BTB' ) . '</div>';
							endif;
						?>

						<div class="pagination" style="margin-top: 1.5em; margin-bottom: 0; width: 90%;">
							<?php numeric_posts_nav( $the_query, $startpost, $endpost ); ?>
						</div>
					</div>

				</div>



			</div>
		</div>
	</article>
</div>

<?php
        endwhile;
	endif;

	if( $multipage ) {
		echo '<div class="boxed">';
		wp_link_pages();
		echo '</div>';
	}

?>

<?php
	get_footer();
?>